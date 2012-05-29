<?php
class User extends CI_Controller {
// Number of records per page:
private $nbrOfLines = 6;
function __construct(){
parent::__construct();
	// Load libraries:
	$this->load->library(array('table', 'form_validation', 'pagination'));
	// Load helpers:
	$this->load->helper('url');
	// Load Site model with Activ Record activated:
	$this->load->model('user_model','',TRUE);
	// Redefine certain error messages:
	$this->form_validation->set_message('required', '* required');
	// We define a delimiter and a css class for error messages:
	$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
   } // end constructor
function index($offset = 0){
/**
* @Goal: Display the records list, according to offset.
* Offset represent the number of the first line to be displayed.
* @param: offset.
*/
// Offset provided by URI:
$uriSegment = 3;
$offset = $this->uri->segment($uriSegment);
// Load data:
$sites = $this->siteModel->get_paged_records($this->nbrOfLines, $offset)->result();
// Configure and generate pagination:
$config['base_url'] = site_url('site/index/');
$config['total_rows'] = $this->siteModel->count_all();
$config['per_page'] = $this->nbrOfLines;
$config['uri_segment'] = $uriSegment;
$this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();
// Generate data table:
$this->table->set_empty("&nbsp;");
$this->table->set_heading('Line', 'ID', 'Name', 'Cost ' . $this->curency, 'Progress %', 'Type', 'Is started', 'Is
Suspended', 'Actions');
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 21 / 46
$i = 0 + $offset;
foreach ($sites as $site){
$deleteMessage = 'Do you really want to delete this record: ' . $site->name . ' ?';
$this->table->add_row(
++$i,
$site->id,
anchor('site/getDetail/'.$site->id, $site->name, array('class'=>'simple_link')),
$site->cost,
$site->progress,
$site->type,
$site->isstarted,
$site->issuspended,
anchor('site/getDetail/'.$site->id,'view',array('class'=>'view')).' '.
anchor('site/getUpdate/'.$site->id,'update',array('class'=>'update')).' '.
anchor('site/delete/'.$site->id,'delete',array('class'=>'delete','onclick'=>"return confirm('" . $deleteMessage .
"')"))
); // end add_row
} // end foreach
$data['table'] = $this->table->generate();
// Load view:
$this->load->view('siteList_tpl', $data);
} // end function
function getAdd(){
/**
* @Goal: Provide the form to create a new record.
*/
//*************************************
// BEGIN data preparation for the view.
//*************************************
// We have to complete $data[] to reach the same perimeter as Update action.
// This is necessary for we use the same form for both actions.
// To do so we fetch an empty record object. This object will not be used

// by the view, but must be present:
$objSite = $this->siteModel->getEmptyRecordAsObject();
$data['site'] = $objSite;
// Idem for site type:
$data['typePublic'] = FALSE;
$data['typePrivate'] = FALSE;
// Get progress table as an array:
$progress_array = $this->progressModel->get_all_clean_array();
// Construct the progress drop down list:
$indice = 0;
$data['selectList'] = form_dropdown('progress', $progress_array, $indice);
// Set some basic properties for the view:
$data['title'] = 'Add new record';
$data['okMessage'] = '';
$data['action'] = site_url('site/submitAdd');
$data['link_back'] = anchor('site/index/','Back',array('class'=>'back'));
$data['curency'] = $this->curency;
$data['isStartedCheck'] = FALSE;
$data['isSuspendedCheck'] = FALSE;
//***********************************
// END data preparation for the view.
//***********************************
// Load view:
$this->load->view('siteEdit_frm', $data);
} // end function
function submitAdd(){
/**
* @Goal: Handle the submited form to create a new record.
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 23 / 46
* @param: several params provided by URI.
*/
/*
print_r($_REQUEST);
echo '</br>';
*/
// Run validation.
// form_validation object automatically fetch data provided by URI,
// and can transform it directly according your rules.
// The rules are in form_validation.php
if ($this->form_validation->run() == FALSE){
$data['okMessage'] = '';
}else{
// Prepare new record for the INSERT.
// $this->input->post('xxxxx') return the data that has been
// controled and/or trnsformed by form_validation:
$arrNewRecord = array('name' => $this->input->post('name'),
'cost'=> $this->input->post('cost'),
'progress'=> $this->input->post('progress'),
'type'=> $this->input->post('type'),
'isstarted' => $this->input->post('isstarted'),
'issuspended' => $this->input->post('issuspended'),
);
/*
echo '</br>';
print_r($arrNewRecord);
echo '</br>';
*/
// Trigger INSERT:
$idNewRecord = $this->siteModel->save($arrNewRecord);
// Set user message:
$data['okMessage'] = '<div class="success">Add new record: success</div>';
} // end if

//*************************************
// BEGIN data preparation for the view.
//*************************************
// set common properties for the view:
$data['title'] = 'Add new record';
$data['action'] = site_url('site/submitAdd');
$data['link_back'] = anchor('site/index/','Back',array('class'=>'back'));
$data['curency'] = $this->curency;
// We have to complete $data[] to reach the same perimeter as Update action.
// This is necessary for we use the same form for both actions.
// To do so we fetch an empty record object. This object will not be used
// by the view, but must be present:
$objSite = $this->siteModel->getEmptyRecordAsObject();
$data['site'] = $objSite;
// Set 'type' field for the view:
if (strtoupper($this->input->post('type')) == 'PUBLIC') {
$data['typePublic'] = TRUE;
$data['typePrivate'] = FALSE;
}else{
$data['typePublic'] = FALSE;
$data['typePrivate'] = TRUE;
}
// Get progress table as an array:
$progress_array = $this->progressModel->get_all_clean_array();
// Construct the progress drop down list:
$indice = $this->input->post('progress');
$data['selectList'] = form_dropdown('progress', $progress_array, $indice);
// Set default boolean values for the check boxes (necessary for the view):
$data['isStartedCheck'] = FALSE;
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 25 / 46
$data['isSuspendedCheck'] = FALSE;
//***********************************
// END data preparation for the view.
//***********************************
// Load view.
// Success or not: we re-display the form:
$this->load->view('siteEdit_frm', $data);
} // end function
function getDetail($id){
/**
* @Goal: display a detail view of the record.
* @param: site ID: provided by URI.
*/
/*
print_r($_REQUEST);
echo '</br>';
*/
//*************************************
// BEGIN data preparation for the view.
//*************************************
// set common properties
$data['title'] = 'Site detail';
$data['link_back'] = anchor('site/index/','Back',array('class'=>'back'));
$data['curency'] = $this->curency;
// Get site record:
$data['site'] = $this->siteModel->get_by_id($id)->row();
//***********************************
// END data preparation for the view.
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 26 / 46
//***********************************
// Load view:
$this->load->view('siteDetail_tpl', $data);
} // end function
function getUpdate($id){
/**
* @Goal: Provide the form to update a record.
* @param: site id: provided by URI.
* @comment: For this getUpdate() action, the form fields can't be setted
* with form_validation methods like set_value(), because here we don't
* submit the form, we get it, and at this time form_validation doesn't
* know a thing about our fields.
* Fortunately we can use default values with form_validation methods.
* With set_value() for example, the second parameter (optional) can
* define a default value.
* That's why each form field is defined, in the view, with a form_validation
* method witch includes something for a default value.
*/
//*************************************
// BEGIN data preparation for the view.
//*************************************
// We fetch the site object from the model, and put it in the data[]
// table for the view:
$objSite = $this->siteModel->get_by_id($id)->row();
$data['site'] = $objSite;
/*
echo '</br>';
print_r($objSite);
echo '</br>';
*/

// Set some basic properties for the view:
$data['title'] = 'Update a record';
$data['okMessage'] = '';
$data['action'] = site_url('site/submitUpdate');
$data['link_back'] = anchor('site/index/', 'Back', array('class'=>'back'));
$data['curency'] = $this->curency;
// Set 'type' field for the view:
if (strtoupper($objSite->type) == 'PUBLIC') {
$data['typePublic'] = TRUE;
$data['typePrivate'] = FALSE;
}else{
$data['typePublic'] = FALSE;
$data['typePrivate'] = TRUE;
}
// Get progress table as an array:
$arrProgress = $this->progressModel->get_all_clean_array();
// Construct the progress drop down list for the view:
$indice = $objSite->progress;
$data['selectList'] = form_dropdown('progress', $arrProgress, $indice);
// Set default boolean values for the check boxes (necessary for the view):
if( $objSite->isstarted == 1 ){
$data['isStartedCheck'] = TRUE;
} else {
$data['isStartedCheck'] = FALSE;
}
if( $objSite->issuspended == 1 ){
$data['isSuspendedCheck'] = TRUE;
} else {
$data['isSuspendedCheck'] = FALSE;
}
//***********************************
// END data preparation for the view.
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 28 / 46
//***********************************
// load view:
$this->load->view('siteEdit_frm', $data);
} // end function
function submitUpdate(){
/**
* @Goal: Handle the submited form.
* @param: several params provided with URI.
*/
/*
print_r($_REQUEST);
echo '</br>';
*/
// Run validation.
// form_validation object automatically fetch data provided by URI,
// and can transform it directly according your rules.
// The rules are in form_validation.php
if ($this->form_validation->run() == FALSE){
// Error messages will be provided by form_validation.
// We just set a general user message:
$data['okMessage'] = '<div class="nosuccess">Something is wrong</div>';
}else{
// All is well: we can update the record.
// We take data that have been
// securised and/or preped by form_validation, according your rules.
// Note: each field must have a rule defined (even an empty
// rule), otherwise the field will stay unknown from form_validation.
$id = set_value('id');
$arrSite = array('name' => $this->input->post('name'),
'cost'=> $this->input->post('cost'),
'progress'=> $this->input->post('progress'),
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 29 / 46
'type'=> $this->input->post('type'),
'isstarted' => $this->input->post('isstarted'),
'issuspended' => $this->input->post('issuspended'),
);
/*
echo '</br>';
print_r($arrSite);
echo '</br>';
*/
// We trigger UPDATE:
$this->siteModel->updateRecord($id, $arrSite);
// Set user message:
$data['okMessage'] = '<div class="success">Update record: success</div>';
} // end if
//*************************************
// BEGIN data preparation for the view.
//*************************************
// Set some basic properties for the view:
$data['title'] = 'Update record';
$data['action'] = site_url('site/submitUpdate'); // we will re-submit the form.
$data['link_back'] = anchor('site/index/', 'Back', array('class'=>'back'));
$data['curency'] = $this->curency;
// We have to complete $data[] to reach the same perimeter as Add action.
// This is necessary for we use the same form for both actions.
// To do so we fetch an empty record object. This object will not be used
// by the view, but must be present:
$objSite = $this->siteModel->getEmptyRecordAsObject();
$data['site'] = $objSite;
// Set 'type' field for the view, even if it's not used by the view.
$data['typePublic'] = FALSE;
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma
Page 30 / 46
$data['typePrivate'] = FALSE;
// Get progress table as an array:
$progress_array = $this->progressModel->get_all_clean_array();
// Construct the progress drop down list.
// We use the form_dropdown helper:
$indice = $this->input->post('progress');
$data['selectList'] = form_dropdown('progress', $progress_array, $indice);
// Set default boolean values for the check boxes (necessary for the view):
$data['isStartedCheck'] = FALSE;
$data['isSuspendedCheck'] = FALSE;
//***********************************
// END data preparation for the view.
//***********************************
// Load view:
$this->load->view('siteEdit_frm', $data);
} // end function
function delete($id){
/**
* @Goal: Delete the record according ID.
* @param: record ID.
*/
// Delete record:
$this->siteModel->delete($id);
// Redirect to list page:
redirect('site/index/','refresh');
CRUD with CodeIgniter 2.0
V1.0 Sept 12-2011
Maxime Keltsma

} // end function
} // end class
?>

