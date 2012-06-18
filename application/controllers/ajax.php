<?php
/**
 * controller for AJAX requests
 *
 * This controller will handle all AJAX requests up to now.
 * If more AJAX-functionality is added, this should be split into thematically
 * organized controllers.
 *
 * @package controllers
 */

class Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('comment_model');
	}

	/**
	 * asynchronously get comments for a question
	 *
	 * calls *get_qcomments* from the comment model.
	 * presents its data using the *ajax/comments* view.
	 *
	 * @param int $qid the questionID
	 * @return void
	 */

	public function qcomments($qid) {
		$data["comments"] = $this -> comment_model -> get_qcomments($qid);
		$this -> load -> view('ajax/comments', $data);
	}

}
