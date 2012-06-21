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
		$this -> session -> set_userdata('last_visited', current_url());
		$data['loginbox'] = TRUE;
		$this -> load -> view('main_view', init_view_data($content, $data));	}

	/**
	 * 
	 * create a new question or edit an existing one
	 * 
	 * @param int $qid the id of the question to edit. if left blank, create a new question.
	 * 
	 */
	public function question($qid=0){
		
		//TODO: check if $qid is the user's question, otherwise send the user back where he came from (hint: see controllers/user.php for how to do this)
		// show a form to edit a question if $qid does not exist it's empty, otherwise it should already contain the question's data
		// create the form to show as /views/content/form_question.php. It should contain fields for title, body and a drop-down list with all the names of the categories to choose from.
		// use form validation to make sure all required fields are entered. if everything is okay, update the database.
		
	}
	
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
	 * create a new comment or edit an existing one
	 * 
	 * @param int $qid the id of the question to comment on
	 * @param int $aid the id of the answer
	 * @param int $cid optional, the commentID, if left blank, create a new comment
	 */
	public function comment($qid,$aid,$cid=0){
		
		//TODO: check if $cid is the user's comment, otherwise send the user back where he came from
		// show a form to edit or create a comment, if $cid does exist it should already be filled with the comment's text. 
		// create the form to show as /views/content/form_comment.php. 
		// The form should have the functionality to create, update and delete a comment using the already implemented functions in the model.
		
	}


}
