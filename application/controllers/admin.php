<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));		
		// load helper
		$this->load->helper('url');		
		// load model
		$this->load->model('Person_model','',TRUE);
		$this->load->library('session');
		//$this->load->library('UsersOnline');
		//$userdata['username'] = $this->session->username;
		//$userdata['id']=$this->session->userID;
		//$this->onlineusers->set_data($userdata);
	}
	
	function index($offset = 0)
	{
		$data['loginbox'] = TRUE;
		$data['title'] = 'Admin View Users List';
		$data['navigation'][0] = anchor("admin/add/","Add new user",array('class'=>'add'));
		$data['navigation'][1] = anchor('admin/online/','Show online User',array('class'=>'user'));
		$data['content'] = 'content/personList';
		
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$persons = $this->Person_model->get_paged_list($this->limit, $offset)->result();
		
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/index/');
 		$config['total_rows'] = $this->Person_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
        $this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'User Name', 'Email', 'Orgonization','Degree','User Type','Study Field','  ');
		$i = 0 + $offset;
		     
		foreach ($persons as $person)
		{
		$type = $this->Person_model->get_type($person->userTypeID);
	        $field = $this->Person_model->get_feild($person->fieldID);
		$this->table->add_row(++$i,$person->fullName, $person->userName,$person->email,$person->organization,$person->degree,	$type[0]->userType,$field[0]->fieldName,
				anchor('admin/view/'.$person->userID,'view',array('class'=>'view')).' '.
				anchor('admin/update/'.$person->userID,'update',array('class'=>'update')).' '.
				anchor('admin/types/'.$person->userID,'upgrade',array('class'=>'upgrade')).' '.
				anchor('admin/delete/'.$person->userID,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this -> load -> view('main_view', $data);
		//$this->load->view('content/personList', $data);
	}
	function types(){
	$types = $this->Person_model->get_types()->result();
	// generate table data
		$this->load->library('table');
         	$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name');
	foreach ($types as $type){
		
		$this->table->add_row($type->userType);

		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('upgrade', $data);
	}
	function online(){
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		// load data
		$persons = $this->Person_model->get_paged_list($this->limit, $offset)->result();
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/index/');
 		$config['total_rows'] = $this->Person_model->count_all();
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
		$data['table'] = $this->table->generate();
		$this->load->view('content/onlineuser', $data);
	}
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new person';
		$data['message'] = '';
		$data['action'] = site_url('person/addPerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function addPerson()
	{
		// set common properties
		$data['title'] = 'Add new person';
		$data['action'] = site_url('person/addPerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$person = array('name' => $this->input->post('name'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$id = $this->Person_model->save($person);
			
			// set user message
			$data['message'] = '<div class="success">add new person success</div>';
		}
		
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Admin View Person Details';
		$data['link_back'] = anchor('admin/index/','Back to list of persons',array('class'=>'back'));
		
		// get person details
		$data['person'] = $this->Person_model->get_by_id($id)->row();
		
		// load view
		$data['content'] = 'content/personView';
		$this->load->view('main_view', $data);
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$person = $this->Person_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->name = $person->name;
		$this->form_data->gender = strtoupper($person->gender);
		$this->form_data->dob = date('d-m-Y',strtotime($person->dob));
		
		// set common properties
		$data['title'] = 'Update person';
		$data['message'] = '';
		$data['action'] = site_url('person/updatePerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		
		$this->load->view('personEdit', $data);
	}
	
	function updatePerson()
	{
		// set common properties
		$data['title'] = 'Update person';
		$data['action'] = site_url('person/updatePerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$person = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$this->Person_model->update($id,$person);
			
			// set user message
			$data['message'] = '<div class="success">update person success</div>';
		}
		
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function delete($id)
	{
		// delete person
		$this->Person_model->delete($id);
		
		// redirect to person list page
		redirect('person/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->gender = '';
		$this->form_data->dob = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
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
}
?>
