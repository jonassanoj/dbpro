<?php

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->library("form_validation");
		$this->form_validation->set_message('min_length', "* more than 5 characters");
		$this->form_validation->set_message('max_length', "* loess than 20 characters");
		$this->form_validation->set_message('alpha_dash', "* only alphabets, _,and -");
		$this->form_validation->set_message('matches', "* enter the same password");
		$this->form_validation->set_message('valid_email', "* correct email e.g. abc@abc.com");
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}

	/**
		index funtion
	*/
	public function index() {
		
		$this->view_login();	
	}
	
	/**
		logout funtion
	*/
	public function logout() {
		
		$this->session->sess_destroy();
		$this->view_login();
		
	}
	
	/**
		function to show a page when user login
	*/
	public function update_profile() {
		//$this->session->unset_userdata("login");
		if(!$this->session->userdata("login")) {
			//$data['loginfail'] = true;
			//$this->load->view("userlogin/view_login", $data);
			$this->view_login();
				
		}
		else {
			
			$query_res = $this->user_model->get_userdata($this->session->userdata('userid'));
			$data['fullName'] = $query_res[0]['fullName'];
			$data['dateOfBirth'] = $query_res[0]['dateOfBirth'];
			$data['location'] = $query_res[0]['location'];
			$data['organization'] = $query_res[0]['organization'];
			$data['imagePath'] = $query_res[0]['imagePath'];
			$data['fieldID'] = $query_res[0]['fieldID'];
			$data['allfields'] = $this->user_fields();
			$data['detail'] = $query_res[0]['detail'];
			$this->load->view("userlogin/view_user_update", $data);
		}
		
	}
	
	public function view_login() {
		
		$this->form_validation->set_rules('nickname', 'Nick name', 'required|xss_clean|alpha_dash_space');
		$this->form_validation->set_rules('userpass', 'Password', 'required|md5');
		if($this->form_validation->run() == false) {
			//$data['title'] = "Login";
			$this->load->view("userlogin/view_login");
		}
		else {
			
			//$userData = array( "userName" => $_POST['txtName'], "password" => $_POST['pwdPass']);
			$return = $this->user_model->get_user($_POST['nickname'], $_POST['userpass']);
			if(count($return) > 0) {
				
				$date = $this->get_date();
				$update_info = array("lastLogin" => $date);
				$where = "userName = '$_POST[nickname]'";
				$this->user_model->update_user($update_info, $where); // this line will update date
				$userData = array("login" => true, 
								  "userid" => $return[0]['userID'],
								  "username" => $return[0]['userName'], 
								  "usertype" => $return[0]['userTypeID'], 
								  "email" => $return[0]['email']); 
								  
				$this->session->set_userdata($userData);
				$this->update_profile(); // for now just calling the update page
			}
			else {
				$data["message"] = "Wrong user name or password";
				$this->load->view("userlogin/view_login", $data);
				
			}
			// it will go to another page (successmessagePage)
		}
		
	}
	
	/**
	     funtion to show registration form
	*/
	public function view_registration_form() {
		
		$data['title'] = "User Registration";
		$this->load->view("userlogin/view_reg_user", $data);
	}
	
	/**
		funtion that have success message for user registration
	*/
	public function register() {
		$this->form_validation->set_message('required', "* required");
		$this->form_validation->set_rules('name', 'User name', 'required|min_length[6]|max_length[20]
																|trim|xss_clean|alpha_dash');
		$this->form_validation->set_rules('email', 'Email Address' , 'required|trim|valid_email');
		$this->form_validation->set_rules('userpass', 'Password', 'required|min_length[5]|max_length[15]|matches[userpassconf]|md5');
		$this->form_validation->set_rules('userpassconf', 'Confirm Password','required');
		$data['title'] = "User Registration";
		if($this->form_validation->run() == false) {
			$this->load->view("userlogin/view_reg_user", $data);
		}
		else {
			
			$date = $this->get_date();
			$userData = array( "userName" => $_POST['name'], "password" => $_POST['userpass'], 
							   "email" => $_POST['email'], "acountCreationDate" => $date,
							   "imagePath" => "/uploads/default_user.png");
			
			$userid = $this->user_model->add_user($userData);
			$userData['userid'] = $userid;
			// -------------------------- Here we have create email text ---------------------------------------------------------
			$encode_userid = base64_encode($userid);
			$message = "<div style=\"color:#666; width:70%; padding:5px;font-family:Verdana, Geneva, sans-serif; line-height:1.5\">";
			$message .= "<p style='padding-top:5px;'><span style='color:green'><strong>
						Congratulation!</strong> $_POST[name] </span><br>
	  					 Your goftogo account has been created, please click the following link to confirm
	  					 your account, 
						 ".anchor(base_url()."user_controller/reg_confirm/".$encode_userid, 	
						 "www.guftogo.com?a=$encode_userid&u=ukdKjap392KJKJFK" , array("target" => "_blank"))."
	  					 <br><br>Gofogto.com,<hr>
	  					<span style='font-size:80%;'> Note: you have to confirm your account before 5 
						days otherwise your account will delete</span>";
			$message .="</div>";
		    $this->send_mail($_POST['email'], $message);
			//---------------------------------------------------------------------------------------------------------------------
			
			$this->load->view("userlogin/view_reg_succ", $userData);
			// it will go to another page (successmessagePage)
		}
		
		
	}
	
	public function forget_pass() {
		$data['sent'] = true;
		$this->load->view("userlogin/view_forget_pass", $data);
	}
	
	public function user_update() {
		
		$this->form_validation->set_message('required', "* required");
		$this->form_validation->set_rules('nickname', 'Nick name', 'required|min_length[5]|max_length[20]
																|trim|xss_clean|alpha_dash');
		$this->form_validation->set_rules('email', 'Email Address' , 'required|trim|valid_email');
		//$this->form_validation->set_rules('dateofbirth', 'Date of birth' , 'trim|valid_email');
		//$this->form_validation->set_rules('location', 'Location' , '');
		//$this->form_validation->set_rules('aboutme', 'About Me' , 'xss_clean');
		if($this->form_validation->run() == false) {
			$data['allfields'] = $this->user_fields();
			$this->load->view("userlogin/view_user_update", $data);
		}
		else {
			$image = $_POST['hidden_image']; // store the previous path of image
			//if(isset($_POST['file_image']))
			//$image = $_POST['file_image'];
			/*
			if( $_FILES["file_image"]["name"]) {
				//$this->forget_pass();
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1024';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
		
				$this->load->library('upload', $config);
		
				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
		
					$this->load->view('userlogin/view_forget_pass', $error);
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
		
					$this->load->view('userlogin/view_forget_pass', $data);
				}
				
			} */
			
			$userData = array( "userName" => $_POST['nickname'], "fullName" => $_POST['realname'], 
								"email" => $_POST['email'], "dateOfBirth" => $_POST['dateofbirth'], 
								"organization" => $_POST['organization'],
								"location" => $_POST['location'], "fieldID" => $_POST['fieldofstudy'],
								"imagePath" => $image, "detail" => $_POST['aboutme']);
			$where = "userID = '".$this->session->userdata('userid')."'";
			$this->user_model->update_user($userData, $where);
			$userData['allfields'] = $this->user_fields();
			$this->load->view("userlogin/view_user_update", $userData);
			// it will go to another page (successmessagePage)*/
		}
		//$this->load->view("userlogin/view_user_update");
	}
	
	// helper function just to load all fields from table field
	function user_fields() {
		$this->load->model("field_model");
		return $this->field_model->get_field_data();
	}
	
	// This function is for resending the registration email to the user
	function resend_email() {
		$email = $_POST['email'];
		$username = $_POST['username'];
		$userid = $_POST['userid'];
		$encode_userid = base64_encode($userid);
		$data['userName'] = $username;
		$data['email'] = $email;
		$data['userid'] = $userid;
		$message = "<div style=\"color:#666; width:70%; padding:5px;font-family:Verdana, Geneva, sans-serif; line-height:1.5\">";
		$message .= "<p style='padding-top:5px;'><span style='color:green'><strong>
						Congratulation!</strong> $username </span><br>
	  					 Your goftogo account has been created, please click the following link to confirm
	  					 your account, 
						 ".anchor(base_url()."user_controller/reg_confirm/".$encode_userid, 
						 "www.guftogo.com?a=$encode_userid&u=ukdKjap392KJKJFK" , array("target" => "_blank"))."
	 					 <br/><br>Gofogto.com<hr>
	  					<span style='font-size:80%;'> Note: you have to confirm your account before 5 
						days otherwise your account will delete</span>";
		$message .="</div>";
		$this->send_mail($email, $message);
		$this->load->view("userlogin/view_reg_succ", $data);
	}
	
	function send_mail($email = '', $message = '') {
		
		$this->load->library("email");
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);
		$this->email->subject('Goftogo Account Confirmation');
		$this->email->from('noreply@goftogo.com', 'Goftogo.com');
		$this->email->to($email); 
		
		//$this->email->bcc('them@their-example.com');
		
		$this->email->message($message);	
			
		return $this->email->send();
		
	}
	
	// This function is for registration confermation 
	
	function reg_confirm($userid) {
			
			$userid = base64_decode($userid); // just to get normal text
			$where = "userID = $userid";
			if($this->user_model->check_user($where)) { // if user exists
				
				
				$userData = $this->user_model->get_userdata($userid);
				$reg_date = $userData[0]['acountCreationDate'];
				$is_active = $userData[0]['accountActivate'];
				if($is_active == 1) {
					// just we whill redirect to the view page and will show that ur account is already activated	
					$data['activate'] = 2; // 2 mean account was activated already
					$data['userName'] = $userData[0]['userName'];
				}
				elseif($is_active == 0) {
					// here we will check the expiration 
					if($this->check_expiry($reg_date)) {
						$data['userName'] = $userData[0]['userName'];
						$data['userid'] = $userid;
						$data['activate'] = 1; // 1 mean account activated now
						
						$updateArray = array("lastLogin" => $this->get_date(), "accountActivate" => "1");
						$this->user_model->update_user($updateArray, $where);
					}
					else {
						$data['activate'] = 0; // 0 mean link is expired
						
					}
				}
				
			}
			else // if user doesn't exists
			$data['activate'] = -1; // 2 mean account deleted already
			$data['userid'] = $userid;
			$this->load->view("userlogin/view_user_conf", $data);
			
		
	}
	
	// funtion for getting date just for simplicity 
	function get_date() {
		return date("Y-m-d");
	}
	
	// this function we will use if a user registration not activate more than 5 days
	function check_expiry($date) {
		list($y, $m, $d) = preg_split("/[-]/", $date);
		list($c_y, $c_m, $c_d) = preg_split("/[-]/", $this->get_date());
		if($y != $c_y) return false;
		if($m != $c_m) return false;
		$dif = $c_d - $d; 
		if($dif > 5) return false;
		return true;
	}
	
	
	
}