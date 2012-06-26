<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * the admin controller
 *
 * Handles the basic admin functionality. List Users,upgrade usere's privileges, delete users, update users data,add new user, list onsite users
 *
 *
 * @package controllers
 * @author Ashuqullah Alizai & Ghezal Ahmad Zai
 */

class Admin extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	/**
	 * constructor
	 *
	 * loads user_model, helper , main_lang, session library , table library
	 *
	 */
	
	function __construct(){
		parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));		
		// load helper
		$this->load->helper('url');		
		// load model
		$this->load->model('User_model','',TRUE);
		$this->load->library('session');
		if (!$this -> session -> userdata('language'))
			$this -> lang -> load('main');
		else
			$this -> lang -> load('main', $this -> session -> userdata('language'));
		
	}
	/**
	 * main function
	 *
	 * this funciton will check the userdata from session,if the user is admin it will access the admin table if not will redirect to main/home view
	 *
	 * @author Ashuqullah Alziai/ghezal
	 * @param unknown_type $offset
	 * @return void load views
	 */
	
	function index(){
		// we put the not sign now for checing the admin function because we dont have and session data it will always redirect us
		if(!$this->session->userdata('userTypeID' == 3)){
			$this->mainf();
		}
		else{
			redirect('main/home', 'refresh');
		}
		
	}
	
	/**
	 * list all user in the data base 
	 * 
	 * this function will list all user with it is premarly data('Name', 'User Name', 'Email', 'Orgonization','Degree','User Type','Study Field') in a table and will load the personList view  
	 * 
	 * @param int_type $offset
	 * @author Ashuqullah Alizai
	 * @return void load the personList view 
	 * 
	 */
	
	function mainf($offset = 0){

		$data['loginbox'] = false;
		$data['title'] = 'Admin View Users List';
		$data['navigation'][0] = anchor("main/home","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/online/','Show online User',array('class'=>'user'));
		$data['content'] = 'content/personList';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$persons = $this->User_model->get_paged_list($this->limit, $offset)->result();
		
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/index/');
 		$config['total_rows'] = $this->User_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
        $this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'User Name', 'Email', 'Orgonization','Degree','User Type','Study Field','  ');
		$i = 0 + $offset;
		     
		foreach ($persons as $person){
			$type = $this->User_model->get_type($person->userTypeID);
	        $field = $this->User_model->get_feild($person->fieldID);
			$this->table->add_row(++$i,$person->fullName, $person->userName,$person->email,$person->organization,$person->degree,	$type[0]->userType,$field[0]->fieldName,
				anchor('admin/view/'.$person->userID,'view',array('class'=>'view')).' '.
				anchor('admin/update/'.$person->userID,'update',array('class'=>'update')).' '.
				anchor('admin/upgrade/'.$person->userID,'upgrade',array('class'=>'upgrade')).' '.
				anchor('admin/delete/'.$person->userID,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')"))
			);
		}
		$data['table'] = $this->table->generate();		
		// load view
		$this -> load -> view('main_view', $data);
	}
	
	/**
	 * retrive current privileges for user
	 * 
	 * this function is for retreving the current privileges data of the user and will load the upgrade view 
	 * 
	 * @author alizai	
	 *@return void load upgrade view 
	 */
	function upgrade($uid){
		$person = $this->User_model->get_by_id($uid)->row();
		$this->form_data->id = $uid;
		$this->form_data->userName = $person->userName;
		$this->form_data->userType = $person->userTypeID;
		$data['action'] = site_url('admin/upgrade_user');
		$data['message'] ='';
		$data['navigation'][0] = anchor("main/home/","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/index/','Back to User list',array('class'=>'back'));
		$data['title'] = 'View Online User';
		$data['content'] = 'content/upgrade';
		$this->load->view('main_view', $data);
	}
	/**
	 * upgrade user privileges
	 * 
	 * this function is for upgrading user privileges as per admin decision from one level to other 
	 * 
	 * @author Alizai
	 * @return void
	 * 
	 */
	
	function ugrade_user(){
	
	
		// $uid = $this->input->post('id');
		// $userTypeID => $this->input->post('userType');
		 
		// $this->User_model->upgrade_user($uid,$userTypeID);
	
		$data['message'] = '<div class="success">upgrade person success</div>';
		$data['action'] = site_url('admin/upgrade_user');
		$data['navigation'][0] = anchor("main/home/","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/index/','Back to User list',array('class'=>'back'));
		$data['title'] = 'View Online User';
		$data['content'] = 'content/upgrade';
		$this->load->view('main_view', $data);
	}
	
	
	/**
	 * show onsite user 
	 * 
	 * this function will load the view that will show the user name of the online user and the ip fro un registerd user 
	 * 
	 * @return void
	 * @author ashuqullah alizai&ghezal Ahmadzai
	 */
	function online(){
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		// load data
		$persons = $this->User_model->get_paged_list($this->limit, $offset)->result();
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/index/');
 		$config['total_rows'] = $this->User_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->library('table');
         	$this->table->set_empty("&nbsp;");
		$this->table->set_heading( 'User Name', 'status ','');
		//$users = $this->onlineusers->get_info(); //prefer using reference to best memory usage
		//foreach($user as $users)
		  //{
		      //if(isset($user['data']['userName'])) { print $user['data']['userName']; }
		 // }
		
		foreach ($persons as $person)
		{
				$this->table->add_row($person->userName,'Online',
				anchor('admin/view/'.$person->userID,'view',array('class'=>'view')).' '.
				anchor('admin/delete/'.$person->userID,'delete',array('class'=>'delete','onclick'=>"return confirm 						('Are you sure want to delete this person?')"))
			);
		}
		$data['navigation'][0] = anchor("main/home/","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/index/','Back to User list',array('class'=>'back')); 
		$data['table'] = $this->table->generate();
		$data['title'] = 'View Online User';
		$data['content'] = 'content/onlineuser';
		$this->load->view('main_view', $data);
	}
	/**
	 * add new user view 
	 *
	 *this function will load the addUser view for adding user data and than load the addUser function to store the data in to the database 
	 *
	 *@author Ashuqullah Alizai
	 *@return void 
	 */
	function add(){
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new person';
		$data['message'] = '';
		$data['action'] = site_url('admin/addUser');
				// load view
		$data['navigation'][0] = anchor("main/home/","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/index/','Back to User list',array('class'=>'back'));
		$data['content'] = 'content/addUser';
		$this->load->view('main_view', $data);
	}
	/**
	 * add new user 
	 * 
	 * this function is to create new user it will get the data for user from the addUser view and send to data base 
	 * 
	 * @author alizai
	 * @return void
	 */
	function addUser(){
		// set common properties
		$data['title'] = 'Add new person';
		$data['action'] = site_url('admin/addUser');
			
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		/* run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
		*/	// save data
			$person = array('fullName' => $this->input->post('fullName'),
					'userName' => $this->input->post('userName'),
					'email' => $this->input->post('email'),
					'organization' => $this->input->post('orgonization'),
					'location' => $this->input->post('location'),
					'degree' => $this->input->post('degree'),
					'userTypeID' => $this->input->post('userType'),
					'fieldID' => $this->input->post('field'),
					'detail' => $this->input->post('details'),
					'dateOfBirth' => date('Y-m-d', strtotime($this->input->post('dob'))));
					$id = $this->User_model->save($person);
			
			// set user message
			$data['message'] = '<div class="success">add new person success</div>';
		//}
		
		// load view
			$this->mainf();

	}
	/**
	 * show user details 
	 * 
	 * this function will show details of the user with _id_ specifyed as parameter 
	 * 
	 * @author Ashuqullah Alizai
	 * @param int_type $id is user ID 
	 * 
	 */
	
	function view($id){
		// set common properties
		$data['title'] = 'Admin View User Details';
			
		// get person details
		$data['person'] = $this->User_model->get_by_id($id)->row();
		
		// load view
		//$data['title'] = 'User Details';
		$data['navigation'][0] = anchor("main/home/","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/index/','Back to User list',array('class'=>'back'));
		$data['content'] = 'content/personView';
		$this->load->view('main_view', $data);
	}
	/**
	 * retrive current data for update 
	 * 
	 * this function will retrive existing data for a user with given id _$id_ for updating and will load the data in the update view 
	 *  
	 * @param int_type $id is user ID 
	 * @author Alizai
	 * @return void
	 */
	function update($id){
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$person = $this->User_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->fullName = $person->fullName;
		$this->form_data->userName = $person->userName;
		$this->form_data->email = $person->email;
		$this->form_data->orgonization = $person->organization;
		$this->form_data->location = $person->location;
		$this->form_data->degree = $person->degree;
		$this->form_data->userType = $person->userTypeID;
		$this->form_data->field = $person->fieldID;
		$this->form_data->dob = $person->dateOfBirth;
		$this->form_data->details = $person->detail;
		//$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
		
		// set common properties
		$data['title'] = 'Update person';
		$data['message'] = '';
		$data['action'] = site_url('admin/updatePerson');
		$data['link_back'] = anchor('admin/index/','Back to Users List',array('class'=>'back'));
	
		// load view
		$data['navigation'][0] = anchor("main/home","Home",array('class'=>'home'));
		$data['navigation'][1] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][2] = anchor('admin/online/','Show online User',array('class'=>'user'));
		$data['content'] = 'content/addUser';
		$this->load->view('main_view', $data);
	}
	/**
	 * update the person information 
	 * 
	 * this function will update the information of the person with new inserted data from the view and save to the database 
	 * @author Alizai
	 * @return void
	 */
	function updatePerson(){
		// set common properties
		$data['title'] = 'Update person';
		$data['action'] = site_url('admin/updatePerson');
			
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		//$this->_set_rules();
		
		// run validation
		//if ($this->form_validation->run() == FALSE)
		//{
		//	$data['message'] = '';
		//}
		//else
		//{
			// save data
			$id = $this->input->post('id');
			$person = array('fullName' => $this->input->post('fullName'),
					'userName' => $this->input->post('userName'),
					'email' => $this->input->post('email'),
					'organization' => $this->input->post('orgonization'),
					'location' => $this->input->post('location'),
					'degree' => $this->input->post('degree'),
					'userTypeID' => $this->input->post('userType'),
					'fieldID' => $this->input->post('field'),
					'detail' => $this->input->post('details'),
					'dateOfBirth' => date('Y-m-d', strtotime($this->input->post('dob'))));
					
			$this->User_model->update_user($id,$person);
			
			// set user message
			$data['message'] = '<div class="success">update person success</div>';
		 //}
		
		// load view
		    $this->mainf();
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
	function delete($id){
		$this->User_model->delete_user($id);
		redirect('admin/index/','refresh');
	}
	/**
	 * set field value 
	 * 
	 * this private fuction will set the field value for other fuctions to be used 
	 * 
	 * @author Ashuqullah Alizai
	 * @return void
	 * 
	 */
	
	function _set_fields(){
		$this->form_data->id = '';
		$this->form_data->fullName = '';
		$this->form_data->userName = '';
		$this->form_data->email = '';
		$this->form_data->orgonization = '';
		$this->form_data->location = '';
		$this->form_data->degree = '';
		$this->form_data->userType = '';
		$this->form_data->field = '';
		$this->form_data->dob = '';
		$this->form_data->details = '';
		
	}
	
	/**
	 *set validation rules
	 * 
	 * set validation rule for inserted data in the text field of veiw 
	 * 
	 * @author Ashuqullah Alizai
	 * @return string message for required fields 
	 */
	function _set_rules(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	/**
	 * validate the data 
	 * fuction will validate the inserted data format 
	 * 
	 * @author Ashuqullah Alizai
	 * @return boolean true if match and false if not match 
	 * @param $str string 
	 */
	
	function valid_date($str){
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	/**
	 * List current onsite user 
	 *
	 * if users types [Admin | Normal | Editor ] are currently in the site return his name
	 *
	 * users types [Unconfirmed or logout] return his ip-address.
	 *
	 * @author  Ghezal Ahmad
	 * @return array string user name for current users on the site
	 * @return array string ip address fo unconfirmed users 
	 *
	 */
	function list_users(){
		if($this->session->userdata('userTypeID'== 1 | 2 | 3))
		{
			return $this->session->userdata('userName');
		}
		else
		{
				
			return $this->session->userdata('ip_address');
		}
	}
	

}

?>
