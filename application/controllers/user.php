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
	 * The following parts are sent in order:
	 *
	 * * _include/header.php_
	 * * _header/simple.php_ : no login box
	 * * _leftnav/default.php_: the default content of the navigation bar
	 * * _body_/$body_view_: the body content given as a parameter
	 * * _include/footer.php_
	 *
	 * @param string $body_view what should appear in the body
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

	public function logout()
	{
		$this -> session -> unset_userdata('login');
		$this -> session -> unset_userdata('uid');
		$this -> session -> unset_userdata('usertype');
		$this -> session -> unset_userdata('username');
		redirect($this -> session -> userdata('last_visited'));
	}
	
	public function failed($user='')
	{
		if (!$this -> session -> userdata('failed_logins')) $data['failed_logins']=1;
		else $data['failed_logins'] = $this -> session -> userdata('failed_logins')+1;
	    $this -> session -> set_userdata('failed_logins', $data['failed_logins']);
		$data['title']=lang('msg_login_failed');
		$data['username']=$user;
		$this -> _loadviews('login_failed', $data);
	}
	
	public function register()
	{
		
	}
	
	public function recover($user='')
	{
	
	}
	
}