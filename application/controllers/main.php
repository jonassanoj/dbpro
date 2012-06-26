<?php
/**
 * the main controller
 *
 * Handles the basic site functionality. Browsing questions and answers, etc.
 *
 *
 * @package controllers
 */

class Main extends CI_Controller {

	/**
	 * constructor
	 *
	 * loads question_model, answer_model, main_lang.
	 *
	 */

	public function __construct() {
		parent::__construct();
		$this -> load -> model('question_model');
		$this -> load -> model('answer_model');
		$this -> load -> model('category_model');
		// if no language defined in session, load default language.
		if (!$this -> session -> userdata('language'))
			$this -> lang -> load('main');
		else
			$this -> lang -> load('main', $this -> session -> userdata('language'));
	}

	/**
	 * private helper function to build view
	 *
	 * every complete html-page sent to the client is constructed here.
	 * for the documentation of the $data array contents that are passed to the view
	 * see the comments in views/main_view.php
	 *
	 * @param string $content what should appear in the body
	 * @param array $data The data array to pass on to the views
	 * @return void
	 *
	 */

	public function _loadviews($content, $data) {
		$this -> session -> set_userdata('last_visited', current_url());
		$data['loginbox'] = TRUE;
		$this -> load -> view('main_view', init_view_data($content, $data));
	}

	/**
	 * home view
	 *
	 * this is where the default route and the home links will point to.
	 * it just calls an appropriate function.
	 */

	public function home() {
		$this -> questions();
	}

	/**
	 * show a list of questions
	 *
	 * the paginated _qlist_ view is shown, representing a clickable list of questions.
	 * clicking on a question will display its details (answers, etc.)
	 *
	 * @param int $offset the pagination offset
	 * @return void
	 *
	 */

	public function questions($offset = 0) {
		$config['base_url'] = site_url('main/questions/');
		$config['per_page'] = 5;
		$data['questions'] = $this -> question_model -> get_list($offset, $config['per_page']);
		$config['total_rows'] = $this -> question_model -> get_count();
		$this -> pagination -> initialize($config);
		$data['pagelinks'] = $this -> pagination -> create_links();
		$data['title'] = lang('title_recent_questions');
		$this -> _loadviews('qlist', $data);
	}

	/**
	 * shows a list of questions filtered after one condition
	 *
	 * show the paginated _qlist_ view with the questions matching a filter.  
	 *
	 * @param string $filter the filter name can be userID, catID or search
	 * @param string|int $param the parameter of the filter, can be userID, fieldID, catID or searchTerm   
	 * @param int $offset the pagination offset
	 * @return void
	 *
	 */

	public function filter($filter,$param, $offset=0) {
		$config['base_url'] = site_url("main/filter/$filter/$param/"); 
		$config['per_page'] = 5;
		$config['uri_segment'] = 5;
		$filter = array($filter => $param);
		$data['questions'] = $this -> question_model -> get_list($offset, $config['per_page'], $filter);
		$config['total_rows'] = $this -> question_model -> get_count($filter);
		$this -> pagination -> initialize($config);
		$data['pagelinks'] = $this -> pagination -> create_links();
		$data['title'] = lang('title_search_questions');
		$this -> _loadviews('qlist', $data);
	}

	/**
	 * show one question
	 *
	 * the _qdetails_ view is shown, representing a question and its answers.
	 *
	 * @param int $qid the questionID
	 * @return void
	 *
	 */

	public function qshow($qid) {
		$data['question'] = $this -> question_model -> get_details($qid);
		$data['title'] = lang('title_main') . ': ' . $data['question'] -> title;
		$data['answers'] = $this -> answer_model -> get_answers($qid);
		$data['backlink'] = anchor($this -> session -> userdata('last_visited'), lang('w_back'), "class=backlink");
		$this -> _loadviews('qdetails', $data);

	}

	/**
	 * show a certain body page
	 *
	 * this function shows a certain (static) page from the views/body directory.
	 * use this for static content like: about, contact, terms-of-use, etc.
	 *
	 * @param string $page the name of the page (without extension) in views/body
	 * @return void
	 *
	 */

	public function view($page) {
		// if no content to show for $page, show 404 now.
		if (!file_exists('application/views/content/' . $page . '.php'))
			show_404();
		// try to translate the title, then capitalize it.
		$data['title'] = mb_convert_case(lang('title_' . $page), MB_CASE_TITLE);
		$this -> _loadviews($page, $data);
	}

}
