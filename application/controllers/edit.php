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
			$this->session->set_userdata('qid',$qid);
			$this->session->set_userdata('action',"edit");
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
		
		
		//TODO: check if $qid is the user's question, otherwise send the user back where he came from (hint: see controllers/user.php for how to do this)
		// show a form to edit a question if $qid does not exist it's empty, otherwise it should already contain the question's data
		// create the form to show as /views/content/form_question.php. It should contain fields for title, body and a drop-down list with all the names of the categories to choose from.
		// use form validation to make sure all required fields are entered. if everything is okay, update the database.
		
	
	/**
	 * 
	 * create a new answer or edit an existing one
	 * 
	 * @param int $qid the id of the question to answer. 
	 * @param int $aid optional, the id of the answer, if left blank, create a new answer.
	 * 
	 */
	public function answer($qid,$aid=0){
		
		//TODO: check if $aid is the user's answer, otherwise send the user back where he came from
		// show a form to edit an answer, if $aid does not exist display a form to answer question $qid instead.
		// create the form to show as /views/content/form_answer.php. It should contain a field for body
		// implement and document the missing functions to update and delete a question in the answer model. Use the question model as an example.
		
	}
	/**
	 * 
	 * Creates a new comment or edits an existing one
	 * 
	 * @author Foawziah and Huma
	 * @param int $qid the id of the question to comment on
	 * @param int $aid the id of the answer
	 * @param int $cid optional, the commentID, if left blank, create a new comment
	 * @return void
	 */
	public function comment($qid,$aid,$cid=0){
		
		$comment = $this -> comment_model -> get_comment($cid);
		//if (!$this->session->userdata('login')) redirect('main/home');	
			
			$data['aid'] = $aid;	
		if ($cid==0)
		{ 
				if(!empty($qid) || $qid != '') {
					$result = $this -> question_model -> get_details($qid);
					$data['source_of_comment'] = $result -> body;
				}
				else if(!empty($aid) || $aid != '') {
					$result = $this -> answer_model -> get_answers($qid);
					$data['source_of_comment'] = $result[0] -> body;
				}
			$data['cid'] = 0;
			$data['title']='You can create new comment !';       //TODO: localize	
		}
		else {
			
			
			// if $comment is false (not found in db), send user back
			if (!$comment) redirect('main/home'); 
			// if the editor is not the owner of the comment,send him back	
			//if ($this->session->userdata('uid')!=$comment->userID) redirect('main/home'); 
			$uid = 3;
			$data['cid'] = $cid;
			if(!empty($comment -> questionID) || $comment -> questionID != '') {
				$result = $this -> question_model -> get_details($comment->questionID);
				$data['source_of_comment'] = $result -> body;
			}
			else if(!empty($comment -> answerID) || $comment -> answerID != '') {
				
				$result = $this -> answer_model -> get_answers($qid);
				$data['source_of_comment'] = $result[0] -> body;
			}
			
			$data['title']='Edit an existing comment !';    //TODO: localize
			$data['comment'] = $comment -> body;
			// modify existing comment
		}
			
		$this->_loadviews('form_comment',$data);
		
	}
	/**
	 *
	 * Processes the 'create' and 'update' functionalities
	 *
	 * @author Foawziah and Huma
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
		$data['title'] = 'You can update or create a comment !';  //TODO: localize
			// Now it will create new comment.
		if($this -> input -> post('btn_save')){
			if($cid == 0) {
				$return = -1;
				if($aid != 0 && is_int($aid))
				$return = $this -> comment_model -> create_acomment($aid, $uid, $body);
				else
				$return = $this -> comment_model -> create_qcomment($qid, $uid, $body);
				
				if($return > 0) 
				$data['msg'] = 'Your comment is inserted successfully !';
				else 
				$data['msg'] = 'Sorry! try later';
			}
			else {
			 
			 	$return = $this -> comment_model -> update_comment($cid, $body);
			 	if($return)
			 	$data['msg'] = 'Comment is updated successfully !';
			 	else
			 	$data['msg'] = 'Comment did not updated please try later !';
			
			}
		}
		else if($this -> input -> post('btn_delete')){
			//$cid = $this -> input -> post('cid');
			$comment = $this -> comment_model -> get_comment($cid);
			//if ($this->session->userdata('uid')!=$comment->userID) redirect('main/home');
			$return = $this -> comment_model-> delete_comment($cid);
			$data['title'] = 'You can modify the comment !';
			if($return)
				$data['msg'] = 'Comment is deleted !';
			
			else
				$data['msg'] = 'Comment is not found to be deleted!';
			 
			$this -> _loadviews('form_comment', $data);
			
		}
		else redirect('main/home');
			$this -> _loadviews('form_comment', $data);
			
	}
	
	/**
	 *
	 *  Processes the deletion functionality
	 *  
	 * @author Foawziah and Huma
	 * @param int @cid the id of the comment 
	 * @return void
	 */

	/*public function delete_comment($cid){
		//if(!$this -> session -> userdata('login')) redirect('main/home');
		
		$comment = $this -> comment_model -> get_comment($cid);
		//if ($this->session->userdata('uid')!=$comment->userID) redirect('main/home');
		$return = $this -> comment_model-> delete_comment($cid);
		$data['title'] = 'You can modify the comment !';
		if($return)
			$data['msg'] = 'Comment is deleted !';

	        else 
	    		$data['msg'] = 'Comment is not found to be deleted!';
	    
		$this -> _loadviews('form_comment', $data);		
	}
*/

	/**
	 * 
	 * vote a question or answer up or down
	 * 
	 * @param int $qid the id of the question to vote on, can be 0 if $aid is given
	 * @param int $aid the id of the answer, can be 0 if $qid is given
	 * @param boolean $votedown optional, if set and true vote down, else vote up
	 */
	 
	public function vote($qid,$aid,$votedown=false){
		//TODO: implement this function and everything need for it to work
		// each user can vote exactly once for each question or answer
		// including a database table that records votes with uid and or ip adress
	}
}
