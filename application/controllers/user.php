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
		// if no language defined in session, load default language.
		if (! $this -> session -> userdata('language')) $this->lang->load('main');
		else $this->lang->load('main', $this -> session -> userdata('language'));
		
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
		$data['loginbox']=FALSE;
		$data['content']="content/$content";
		$this -> load -> view('main_view',$data);
	}

	//TODO: Document the login(), logout() and failed() function. Change the implementation of failed() so it accepts only 3 failed password logins. After the third failed login the user should be sent to the recover page (user/recover/$username).
	
	/**
	* function for user login:
	* 
	* This function check the following condition, and perform the task
	*  <ul><li> Getting values (username, password) from login form and checking it in database
	*    also login form have an optional checkbox field (remember) this function also check
	*    if someone checked this remember  checkbox, so it will create a cookie on client computer
	*    which will be exist till 3 days, otherwise cookies will be delete </li>
	*  <li>if user login failed so a failed(username) function will be called and this failed fuction 
	*    is counting that how much time login is failed if it was more than 3 times and new recover page
	*    wil open to user.</li> 
	*  <li>if user login successfully session data will be set for this user where 
	*    userid, username, usertype, login(true, false) will store </li>
	*  <li>when user data set in the sessioin the user will be redirect to the last visiting place
	*    which will take from session data. (last_visited)</li></ul>
	*
	* @return void
	*/
	public function login()
	{
		$username = $this -> input -> post('username');
		$password = md5($this -> input -> post('password'));
		
		if ($this -> input -> post('remember')=='yes') {
			// set a cookie with the username. It will expire in 269200 seconds(3 days).
			$cookie = array('name'=>'username', 'value' => $username, 'expire' => 259200);
			$this->input->set_cookie($cookie);
		}
		else {
			// delete the cookie
			$cookie = array('name'=>'username', 'value' => NULL, 'expire' => NULL);
			$this->input->set_cookie($cookie);
		}
		
		$uid = ($this -> user_model -> login($username, $password));
		if (!$uid) 
			redirect(site_url('user/failed/'.$username));
		// login successful
		$this -> session -> unset_userdata('failed_logins');
		$this -> session -> set_userdata('uid',$uid);
		$this -> session -> set_userdata('usertype',$this-> user_model -> get_usertype($uid));
		$this -> session -> set_userdata('login', true);
		$this -> session -> set_userdata('username', $username);
		redirect($this -> session -> userdata('last_visited'));
	}
	
	/**
	* Fuction for loging out:
	* 
	* Session data of the current user will unset here:
	* <ul><li>login</li> <li>userid(uid)</li> <li>usertype</li> <li>username</li></ul>
	* will redirect after loging out, to the last visited place
	* 
	* @param: void
	* @return: void
	*/
	public function logout()
	{
		$this -> session -> unset_userdata('login');
		$this -> session -> unset_userdata('uid');
		$this -> session -> unset_userdata('usertype');
		$this -> session -> unset_userdata('username');
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
	public function failed($user='')
	{
		if (!$this -> session -> userdata('failed_logins')) $data['failed_logins']=1;
		else $data['failed_logins'] = $this -> session -> userdata('failed_logins')+1;
	    $this -> session -> set_userdata('failed_logins', $data['failed_logins']);
		$data['title']=lang('msg_login_failed');
		$data['username']=$user;
		//if($this -> session -> userdata('failed_logins') < 3)
			$this -> _loadviews('login_failed', $data);
		//else 
			//redirect(site_url('user/recover/'. $user));
	}
	
	public function register()
	{
		
	}
	
	public function recover($user='')
	{
	
	}
	
}
