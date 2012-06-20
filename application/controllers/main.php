
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
		// if no language defined in session, load default language.
		if (! $this -> session -> userdata('language')) $this->lang->load('main');
		else $this->lang->load('main', $this -> session -> userdata('language'));
	}

	/**
	 * private helper function to build view
	 *
	 * every complete html-page sent to the client is constructed here.
	 * currently, header and body are choosen dynamically.
	 *
	 * The following parts are sent in order:
	 *
	 * * _include/header.php_
	 * * _header/loginbox | loggedin : a header with loginbox or with logout button

	 * * _leftnav/_:
	 * * ***If the user type is known, show specific leftnav bar depending on usertype.
	 * ***usertype 1 for confirmed user
	 * ***usertype 2 for editor
	 * ***usertype 3 for admin
	 * ***usertype 0 or else for unconfirmed user
	 * * ***If the user type is unknown, show default or unconfirmed user leftnav bar.
	 * ******************************************************************

	 * * _body_/$body_view_: the body content given as a parameter
	 * * _include/footer.php_
	 *
	 * @param string $body_view what should appear in the body
	 * @param array $data The data array to pass on to the views
	 * @return void
	 *
	 */

	
	public function _loadviews($body_view, $data) {
		// remember the current URL for creating backlinks
		$this -> session -> set_userdata('last_visited', current_url());
		$this -> load -> view('include/header', $data);
		if ($this -> session -> userdata('login'))
		{ // user is logged in
			$data['username'] = $this -> session -> userdata('username');
			$this -> load -> view('header/loggedin',$data);
		}
		else {
			$data['username'] = $this -> input -> cookie('username');
			$this -> load -> view('header/loginbox',$data);
		}
<<<<<<< HEAD
		
		if(isset($this -> session -> userdata('usertype'))){
=======

		$this -> load -> view('leftnav/default');

		if($this -> session -> userdata('usertype')){
>>>>>>> a7eb895f8ab20439d44438eb01d497c0c84ae4d1
		
			if ($this -> session -> userdata('usertype') == 1)
			{
				$this -> load -> view('leftnav/user');
			}
			elseif ($this -> session -> userdata('usertype') == 2)
			{
				$this -> load -> view('leftnav/editor');
			}
			elseif ($this -> session -> userdata('usertype') == 3)
			{
				$this -> load -> view('leftnav/admin');
			}
			else
			{
				$this -> load -> view('leftnav/default');
			}
		}
		else{
			$this -> load -> view('leftnav/default');
		}
		

		$this -> load -> view('body/' . $body_view, $data);
		$this -> load -> view('include/footer');
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
	*shows a list of paginated questions
	*
        * which they belong to specific category.
	* get the list of question(4 questions per page) wich they corrospond the specific fieldID 
	* @param int $fid the ID of field
	* @param int $offset the pagination offset
	* @return void
	 *
	*Author Somaia Zabihi
        */
	
	public function field($fid,$offset = 0) {
		// TODO: implement field($fid,$offset). It should display a paginated view of all the questions that belong to categories in a field. use the already documented $filter feature of the question_model. You only need to make changes in the body of this function.
		//Author Somaia Zabihi
		$config['base_url'] = site_url("main/field/$fid/");
		$config['per_page'] = 4;
		$config['uri_segment'] = 4;
		$filter=array('fieldID'=>$fid);
		$data['questions'] = $this -> question_model -> get_list($offset, $config['per_page'],$filter);
		$config['total_rows'] = $this -> question_model -> get_count($filter);
		$this -> pagination -> initialize($config);
		$data['pagelinks'] = $this -> pagination -> create_links();
		$data['title'] = lang('title_recent_questions');
		$this -> _loadviews('qlist', $data);
	}
	
	public function search($term,$offset) {
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
		$data['title'] =lang('title_main').': '.$data['question'] -> title;
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
		// if no view to show for $page, show 404 now.
		if (! file_exists('application/views/body/' . $page . '.php')) show_404();
		// try to translate the title, then capitalize it.
		$data['title'] = mb_convert_case(lang('w_'.$page),MB_CASE_TITLE);
		$this -> _loadviews($page,$data);
	}

}

