<?php
/**
 * the edit controller
 *
 * Handles forms to ask, answer and edit questions, answers and comments
 *
 *
 * @package controllers 
 */

class Edit extends CI_Controller {

	/**
	 * constructor
	 *
	 * loads question_model, answer_model, comment_model, main_lang.
	 *
	 */

	public function __construct() {
		parent::__construct();
		$this -> load -> model('question_model');
		$this -> load -> model('answer_model');
		$this -> load -> model('comment_model');
		// load category model 
		$this->load->model('category_model');	
		$this->load->library('form_validation');	
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
		$data['loginbox']=TRUE;
		$this -> load -> view('main_view',init_view_data($content,$data));
	}
	
	/**
	 * Create a new question or edit an existing one
	 * 
	 * This Method is used to  checke the user questions, if the question  belongs to the current user, then the form will display with content of current quesiton 
	 * The form will contain Question Title, Question Body and a drop down list for choosing category of the question
	 * if the user update the question the form first would be validated according to the pre existed rules of the form validation 
	 * if the user entered valid data then the quesiton will be created or edited. 
	 * If the quesiton does not belongs to the user the user will be redirected to the last visited page
	 * 
	 * @author Abdulaziz Akbary and Hamidullah Khanzai
	 * @param int $qid the id of the question to edit. if left blank, create a new question.
	 * @retrun void The user will redirecte to the new edited or inserted question to qshow page.
	 */
	public function question($qid=0){
		
		
		// setting validation rules for form_question
		$this->form_validation->set_rules('title','Question Title','trim|required|min_length[4]');
		$this->form_validation->set_rules('body','Question Body','trim|required|min_length[10]');
		$this->form_validation->set_rules('catID','Category','trim|required');
		
		// This method run only if validation rules have been followed 
		if($this->form_validation->run()){		
				
				if($_POST['btn']=="Save Changes"){
					//echo	$this->session->userdata('qid').'hi';
					if(isset($_POST['btn'])) unset($_POST['btn']);
					
					$Eqid=$_POST['qid'];
					unset($_POST['qid']);
					if($this->question_model->update_question($Eqid,$_POST)){
						//echo "Your Question successfully updated";
						redirect('main/qshow/'.$Eqid); 
					
					}
				
				}
				else{
					
					if(($Iqid=$this->question_model->create_question($_POST['title'],$this->session->userdata('uid'),$_POST['catID'],$_POST['body']))!=0){
						//echo "Your Question have been successfully created";
						redirect('main/qshow/'.$Iqid); 
					}
				}
			
		}
		// read all categories for the pupose of filling dropdownlist
		$data['catList']=$this->category_model->get_categories(0,Category_model::FLAT_ARRAY);
		// if quesiton id is greater then zero then it means to perform edite action 
		if($qid>0){
			// load a question from question table 
			$data['question']=$this->question_model->get_details($qid);
			// checak if the $qid exist question table 
			if($data){
				// check if the question belong to the current user
				if(true){ //$question->userID==$this->session->userdata('uid')
						$_POST['btn']='Save Changes';
						$data['title']='Edit Question';
						$this->_loadviews('form_question',$data);
					}
				
				}
				else{
					// if the question does not belongs to the current user redirect the user to back to the last page
					redirect($this->session->userdata('last_visited'));
				}
			}
			// if the $qid is 0 then we diplay the form for creation fo question 
			else{
				
				$data['title']='Create Question';
				$data['question']=null; 
				$_POST['btn']='Save Question';
				$this->_loadviews('form_question',$data);
			} 
		
		}
		
		
	
	/**
	 * 
	 * creation and edition of answer
	 *
	 * create a new answer or edit an existing one
	 * 
	 * @param int $qid the id of the question to answer. 
	 * @param int $aid optional, the id of the answer, if left blank, create a new answer.
	 * 
	 * @author Wazir khan Ahmadzai,
	 * @author Sameen ullah sameen
	 */
	public function answer($qid,$aid=0){
		
		if (!$this->session->userdata('login')) redirect('main/home');
		$this->form_validation->set_message('required', 'Please write answer than submit');
		// here we are loading question for which user will write an answer
		$question = $this -> question_model -> get_details($qid);
		$data['questiontitle'] = $question -> title;
		$data['question'] = $question -> body;
		
		// checking if one of the form submit button clicked or just page refereshed
		$check_for_submit = $this-> input -> post('btn_submit');
		if($check_for_submit != 'Save' && $check_for_submit != 'Delete' && $check_for_submit != 'Cancel')
			$this -> session -> unset_userdata('form');
		if($check_for_submit == 'Cancel') {
			$this -> session -> unset_userdata('form');
			redirect('main/qshow/'.$qid);
		}
		// if form was created for new answer
		if($this -> session -> userdata('form') == 'new') {
			
			
			$this -> form_validation -> set_rules('answer_body','Your answer', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$data['title'] = 'Add New Answer';
				$data['qid'] = $qid;
				$data['aid'] = $aid;
				$this -> _loadviews('form_answer', $data);
			}
			else
			{
				unset($data['questiontitle']);
				unset($data['question']);
				$body = $this -> input -> post('answer_body');
		 		$flag = $this -> answer_model -> add_answer($qid, $this -> session -> userdata('uid'), $body);
				$this->session->set_flashdata('add_message','Answer added successfully');
				if(!$flag)
				$this->session->set_flashdata('add_message','Answer did not save, please try later again');
				$this -> session -> unset_userdata('form');
				redirect('main/qshow/'.$qid);
			}	 		
	 		
		// if form was created for update answer	
		} else if($this -> session -> userdata('form') == 'update') {
			// both button have the same name but different value
			$btn = $this-> input -> post('btn_submit');
			if($btn == 'Delete') {
				// call the delete function if delete button was clicked 
				$this -> delete_answer($aid);
			}
			else {
				$this -> form_validation -> set_rules('answer_body', 'Your answer', 'required|xss_clean');	
				if ($this->form_validation->run() == FALSE)
				{
					$data['title'] = 'Editing answer';
					$data['qid'] = $qid;
					$data['aid'] = $aid;
					$this -> _loadviews('form_answer', $data);
				}
				else
				{
					unset($data['questiontitle']);
					unset($data['question']);
					$body = $this -> input -> post('answer_body');
					$flag = $this -> answer_model -> update_answer($aid, $body);
					$this->session->set_flashdata('update_message', 'Answer updated successfully');
					if(!$flag)
					$this->session->set_flashdata('update_message','Answer did not update, please try later again');
					$this -> session -> unset_userdata('form'); 
					redirect('main/qshow/'.$qid);
					
				}
			}
			
		}
		// if these session were not set it mean for the first time request come to this function 
		else {
			
			$data['qid'] = $qid;
			$data['aid'] = $aid;
			// if aid was not set
			if($aid == 0 || $aid == '') {
				$data['title'] = 'Add New Answer';
				$this -> session -> set_userdata('form', 'new');
				$this -> _loadviews('form_answer', $data);
			}
			else {
				
				$answer = $this -> answer_model -> is_user_answer($aid, $this -> session -> userdata('uid'));
				if(!$answer 
				   && ($this->session->userdata('user')->userTypeID != 2)
				   && ($this->session->userdata('user')->userTypeID != 3)) {
					redirect('main/home');
				}
				// if previous answer was false
				// than reload answer by answer id
				if(!$answer) {
					$answer = $this -> answer_model -> get_answer($aid);
				}
				$this -> session -> set_userdata('form', 'update');
				$data['title'] = 'Editing answer';
				$data['body'] = $answer -> body;
				$this -> _loadviews('form_answer', $data);		
			}	
		}	
	}
	/**
	* delete user's answer
	*
	* This function is for deleting a login user's answer
	* 
	* @param int $aid the id of the answer 
	* 
	* @author Wazir khan Ahmadzai,
	* @author Sameen ullah sameen
	*/
	public function delete_answer($aid = 0) {
		
		if(!$this-> session -> userdata('login') || $aid == 0 )
		redirect('main/home');
		$this -> session -> unset_userdata('form');
		// here it check for user if answer related to user or admin, editor want to delte it
		if(!$this -> answer_model -> is_user_answer($aid, $this -> session -> userdata('uid'))
		   && ($this->session->userdata('user')->userTypeID != 2)
		   && ($this->session->userdata('user')->userTypeID != 3))
		redirect('main/home');
		$flag = $this -> answer_model -> delete_answer($aid, $this -> session -> userdata('uid'));
		$this->session->set_flashdata('delete_message', 'Your answer deleted successfully');
		if(!$flag) {
			$this->session->set_flashdata('delete_message', 'Sorry! your answer did not delete, tray again later');
		}
		
		redirect($this -> session -> userdata('last_visited'));
		
	}
/**
	 * 
	 * Creates a new comment or edits an existing one
	 * 
	 * This function will be run ,if the user in logged in 
	 * 
	 * @param int $qid the id of the question to comment on
	 * @param int $aid the id of the answer
	 * @param int $cid optional, the commentID, if left blank, create a new comment
	 * @return void
	 */
	public function comment($qid,$aid,$cid=0){
		
		if (!$this->session->userdata('login')) redirect('main/home');
		$data['aid'] = $aid;
		$data['qid'] = $qid;
		if ($cid==0){
				if($qid && !$aid) {
					$result = $this -> question_model -> get_details($qid);
					$data['source_of_comment'] = $result -> body;
				}
				else if($aid && !$qid) {
					$result = $this -> answer_model -> get_details($aid);
					$data['source_of_comment'] = $result -> body;
				}
				$data['cid'] = 0;
				$data['title']= lang('tittle_comment_create');   
		}
		else {
				// if $comment is false (not found in db), send user back
				$comment = $this -> comment_model -> get_comment($cid);
				if (!$comment) redirect('main/home'); 
				// if the editor is not the owner of the comment,send him back	
				$data['cid'] = $cid;
				if(($comment -> questionID) && (!$comment -> answerID)) {
					$result = $this -> question_model -> get_details($comment->questionID);
					$data['source_of_comment'] = $result -> body;
				}
				else if(($comment -> answerID) && (!$comment -> questionID)) {
					$result = $this -> answer_model -> get_details($comment -> answerID);
					$data['source_of_comment'] = $result -> body;
				}
				$data['title']= lang('tittle_existing_comment'); 
				$data['comment'] = $comment -> body;
		}
		$this->_loadviews('form_comment',$data);
	}
	/**
	 *
	 * Processes the create, update and delete functionalities
	 *
	 * It updates If comment is already there,else creates new one
	 * This function is run,if the user is logged in and is the owner of the comment
	 *
	 * @return void
	 */
	
	public function process_comment() {
		
		$cid = $this -> input -> post('cid');
		$aid = $this -> input -> post('aid');
		$qid = $this -> input -> post('qid');
		$body = $this -> input -> post('comment_body');
		$uid = $this -> session -> userdata('uid');
		$data['qid'] = $qid;
		$data['aid'] = $aid;
		$data['cid'] = $cid;
		$data['title'] = lang('tittle_update_comment'); 
		// Creates new comment.
		if($this -> input -> post('btn_add')){
			if($cid == 0) {
				$return = -1;
				if($aid)$return = $this -> comment_model -> create_acomment($aid, $uid, $body);
				else$return = $this -> comment_model -> create_qcomment($qid, $uid, $body);
				if($return > 0) $data['msg'] = lang('msg_inserted_comment');
				else $data['msg'] = lang('msg_sorry_comment');
			}
		}
		//Updates an existing comment.
		else if($this -> input -> post('btn_update')){
				$comment = $this -> comment_model -> get_comment($cid);
				if ($this->session->userdata('uid')!=$comment->userID) redirect('main/home');
			 	$return = $this -> comment_model -> update_comment($cid, $body);
			 	if($return) $data['msg'] = lang('msg_update_commnet');
			 	else $data['msg'] = lang('msg_notUpdated_comment');
		}
					redirect('main/qshow/'. $qid);
	}
	/**
	 *
	 *  Processes the deletion functionality
	 *
	 * Deletes the comment which the ID is passed as a parameter
	 * 
	 * @param int $cid the id of the comment
	 * @return void
	 */
	public function delete_comment($cid){
		$comment = $this -> comment_model -> get_comment($cid);
		$return = $this -> comment_model-> delete_comment($cid);
		if($return) $data['msg'] = lang('msg_delete_comment');
	  	else $data['msg'] = lang('msg_notFound_comment');
		redirect('main/qshow/'. $comment->questionID);
		
	
	}
}
