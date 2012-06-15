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
	 * loads: question_model, answer_model
	 */

	public function __construct() {
		parent::__construct();
		$this -> load -> model('question_model');
		$this -> load -> model('answer_model');
	}

	/**
	 * private helper function to build view
	 *
	 * every complete html-page sent to the client is constructed here.
	 * currently, mostly defaults are sent and only the body is changed dynamically.
	 *
	 * The following parts are sent in order:
	 *
	 * * _templates/header.php_
	 * * _header/default.php_ : the default content appearing in the header
	 * * _leftnav/default.php_: the default content of the navigation bar
	 * * _body_/$body_view_: the body content given as a parameter
	 * * _templates/footer.php_
	 *
	 * @param string $body_view what should appear in the body
	 * @param array $data The data array to pass on to the views
	 * @return void
	 *
	 */

	public function _loadviews($body_view, $data) {
		if (!file_exists('application/views/body/' . $body_view . '.php')) {
			show_404();
		}

		$this -> load -> view('templates/header', $data);
		$this -> load -> view('header/default');
		$this -> load -> view('leftnav/default');
		$this -> load -> view('body/' . $body_view, $data);
		$this -> load -> view('templates/footer');
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
		$data['title'] = 'Goftogo: Recommended Questions';
		$this -> _loadviews('qlist', $data);
		$this -> session -> set_userdata('backlink', anchor('main/questions/' . $offset, "back", "class=backlink"));
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
		$data['title'] = 'Goftogo: ' . $data['question'] -> title;
		$data['answers'] = $this -> answer_model -> get_answers($qid);
		$data['backlink'] = $this -> session -> userdata('backlink');
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
		$data['title'] = ucfirst($page);
		$this -> _loadviews($page, $data);
	}
}
