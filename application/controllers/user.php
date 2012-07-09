<?php
/**
 * the user controller
 *
 * Handles logging in and registering users.
 *
 *
 * @package controllers
 */

class User extends CI_Controller {

	/**
	 * constructor
	 *
	 * loads: user_model, main_lang
	 */

	public function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');
		$this -> load -> helper(array('form', 'url'));
		// if no language defined in session, load default language.
		if (!$this -> session -> userdata('language'))
			$this -> lang -> load('main');
		else
			$this -> lang -> load('main', $this -> session -> userdata('language'));

	}

	/**
	 * private helper function to build view
	 *
	 * This loads views for the registration, failed-login, etc. screens
	 *
	 * @param string $content what should appear as content
	 * @param array $data The data array to pass on to the views
	 * @return void
	 *
	 */

	public function _loadviews($content, $data) {
		$data['loginbox'] = FALSE;
		$data['content'] = "content/$content";
		$this -> load -> view('main_view', $data);
	}

	//TODO: Document the login(), logout() and failed() function. Change the implementation of failed() so it accepts only 3 failed password logins. After the third failed login the user should be sent to the recover page (user/recover/$username).

	/**
	 * function for user login:
	 *
	 * This function check the following condition, and perform the task
	 * Getting values (username, password) from login form and checking it in database
	 * also login form have an optional checkbox field (remember) this function also check
	 * if someone checked this remember  checkbox, so it will create a cookie on client computer
	 * which will be exist till 3 days, otherwise cookies will be delete
	 * if user login failed so a failed(username) function will be called and this failed fuction
	 * is counting that how much time login is failed if it was more than 3 times and new recover page
	 * will open to user.
	 * if user login successfully session data will be set for this user where
	 * userid, username, usertype, login(true, false) will store
	 * when user data set in the sessioin the user will be redirect to the last visiting place
	 * which will take from session data. (last_visited)
	 *
	 * @return void
	 */
	public function login() {
		$username = $this -> input -> post('username');
		$password = md5($this -> input -> post('password'));

		if ($this -> input -> post('remember') == 'yes') {
			// set a cookie with the username. It will expire in 269200 seconds(3 days).
			$cookie = array('name' => 'username', 'value' => $username, 'expire' => 259200);
			$this -> input -> set_cookie($cookie);
		} else {
			// delete the cookie
			$cookie = array('name' => 'username', 'value' => NULL, 'expire' => NULL);
			$this -> input -> set_cookie($cookie);
		}

		$uid = ($this -> user_model -> login($username, $password));
		if (!$uid)
			redirect(site_url('user/failed/' . $username));
		// login successful
		$this -> session -> unset_userdata('failed_logins');
		$this -> session -> set_userdata('uid', $uid);
		$this -> session -> set_userdata('user', $this -> user_model -> get_userdata($uid));
		$this -> session -> set_userdata('login', true);
		redirect($this -> session -> userdata('last_visited'));
	}

	/**
	 * Function for logging out:
	 *
	 * Session data of the current user will unset here:
	 * login userid(uid) usertype username
	 * will redirect after loging out, to the last visited place
	 *
	 * @param: void
	 * @return: void
	 */
	public function logout() {
		$this -> session -> unset_userdata('login');
		$this -> session -> unset_userdata('user');
		$this -> session -> unset_userdata('uid');

		redirect($this -> session -> userdata('last_visited'));
	}

	/**
	 * Function to count userlogin failing:
	 *
	 * This funciton is for counting user login failing and to show login failed page, or account recover page
	 * It checks wheather the failed_logins variable set in the session data or not if not,
	 * it make a failed_logins index and storing 1st time login fail or if the failed_logins
	 * was already set in the session data it just increment it (last_value + 1)
	 * than it set a data array to store error and username there,
	 * This function also check if the user login failed less than 3 times it will redirect to the login_failed page
	 * and if the login failed 3 times it will redirect user to recover page, where he/she can recoreved his/her password
	 * @Note: Error message taken from Language helper class, lang('message_index'); it return the specified error
	 * message in current language.
	 *
	 * @param String $user it represent username default-value = ''
	 * @return void
	 */
	public function failed($user = '') {
		if (!$this -> session -> userdata('failed_logins'))
			$data['failed_logins'] = 1;
		else
			$data['failed_logins'] = $this -> session -> userdata('failed_logins') + 1;
		$this -> session -> set_userdata('failed_logins', $data['failed_logins']);
		$data['title'] = lang('msg_login_failed');
		$data['username'] = $user;
		if ($this -> session -> userdata('failed_logins') < 3)
			$this -> _loadviews('login_failed', $data);
		else
			redirect(site_url('user/recover/' . $user));
	}

	function index() {
		$this -> load -> view('upload_form', array('error' => ' '));
	}

	public function update_user() {

		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('fullName', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		//$this->form_validation->set_rules('degree','Degree','alpha');
		//	if($this->form_validation->run() == false) {
		//		$this->view_account();
		//		}
		//		else {
		if ($this-> input -> post('delete')=='delete') redirect('user/delete');
		$data['fullName'] = $this -> input -> post('fullName');
		$data['email'] = $this -> input -> post('email');
		$data['dateOfBirth'] = $this -> input -> post('dateOfBirth');
		$data['organization'] = $this -> input -> post('organization');
		$data['location'] = $this -> input -> post('location');
		$data['imagePath'] = "/uploads/" . $_FILES['userfile']['name'];
		$data['degree'] = $this -> input -> post('degree');
		$data['fieldID'] = $this -> input -> post('fieldID');
		//$this -> load -> model('user_model');
		//echo $data['imagePath'];
		$this -> user_model -> update_user($this -> session -> userdata('uid'), $data);
		//$this -> do_upload();
		redirect('main/home');
		//		}
	}

	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';

		$this -> load -> library('upload', $config);

		if (!$this -> upload -> do_upload()) {

			$error = array('error' => $this -> upload -> display_errors());
			$error['title'] = 'File upload error';
			$this -> _loadviews('my_account', $error);
			//$this -> view_account();
			//	$this -> load -> view('upload_success', $error);
		} else {
			$data = array('upload_data' => $this -> upload -> data());
			//$this -> _loadviews('upload_success', $data);
			$this -> update_user();
			//$this -> load -> view('upload_success', $data);
		}
	}

	public function register() {

	}

	/**
	 * shows the User Account Information
	 *
	 * this function will retreive account data from the database about the logged in user
	 * first it will check if the user is logged in or not and than will retrieve each field into the array
	 * this will than load the my_account form and pass the array created from the user account data
	 *
	 * @param
	 * @return void
	 * Author Sayed Ahmad
	 *
	 */
	public function view_account() {
		
		$this -> load -> model('user_model');
		$userdata = $this -> user_model -> get_userdata($this -> session -> userdata('uid'));
		//$this -> session -> userdata('uid'));
		if (!$userdata)
			redirect('main/home');
		$this -> load -> model('field_model');
		$data['fields'] = $this -> field_model -> get_fields();
		$data['title'] = 'My profile';
		$data['fullName'] = $userdata -> fullName;
		$data['email'] = $userdata -> email;
		$data['imagePath'] = $userdata -> imagePath;
		$data['organization'] = $userdata -> organization;
		$data['location'] = $userdata -> location;
		$data['dateOfBirth'] = $userdata -> dateOfBirth;
		$data['degree'] = $userdata -> degree;
		$data['detail'] = $userdata -> detail;
		$data['fieldID'] = $userdata -> fieldID;

		$this -> _loadviews('my_account', $data);

	}

	public function recover($user = '') {

	}
	
	function delete(){
		//common properties
		$uid=$this -> session -> userdata('uid');
		$data['message'] ='';
		
		$data['title'] = 'Delete User';
		$data['action'] = site_url('user/delete_user');
		//load user model
		$deletionID='';
		$person = $this->user_model->get_userdata($uid);
		$this->form_data->id = $uid;
		//take parmeter from data base
		$this->form_data->deletionID = $deletionID;
		$this->form_data->userName = $person->userName;
		$data['deletion_types']=array('DEACTIVATE','ANONYMIZE','CASCADE');	
		//load view
		//$this -> load -> view('delete_user', $data);
		$this->_loadviews('delete_user', $data);
		//$this->User_model->delete_user($uid);
		//redirect('admin/index/','refresh');
	}
	/**
	 * delete user
	 *
	 * this function delete the user with _$id_from user table
	 *
	 * @author ashuqullah alizai
	 * @param int_type $id is user ID
	 * @return void
	 */
	function delete_user(){
	
		$uid = $this->input->post('id');
	
		$deletionID = $this->input->post('deletionID');
		//exicute function from user model
		if($deletionID == 0){
			$this->User_model->delete($uid, $deletion_type = User_model::DEACTIVATE);
		} elseif ($deletionID ==1){
			$this->User_model->delete($uid,$deletion_type = User_model::ANONYMIZE);
	
		}elseif ($deletionID ==2){
			$this->User_model->delete($uid,$deletion_type = User_model::CASCADE);
		}
	
	
		//$this->User_model->delete_user($id,$deletionID);
		redirect('main/home/','refresh');
	}

}
