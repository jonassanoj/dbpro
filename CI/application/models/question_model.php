<?php
class Question_model extends CI_Model {
	   
   
	 
	    function __construct()
   	 {
        parent::__construct();
   	 }
 function table_exists($table_name = null)
   	 {
    	return $this->db->table_exists($table_name);
   	 }
	   /**
* ask_question method creates a record in the Question table.
*
* Option: Values
* --------------
*questionID
*name
*postedDate
*body
*rank
*KEY catID
*KEY fieldID
*KEY userID
*KEY commentID
* 
* @param array $options
*/
function ask_question($data)
	{
    
   
    // Execute the query
    $this->db->insert('Questions',$data);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
	}

/**
* update_answer method alters a record in the Question table.
*
* Option: Values
* --------------
*questionID
*name
*postedDate
*body
*rank
*KEY catID
*KEY fieldID
*KEY userID
*KEY commentID
*
* @param array $options
* @return int affected_rows()
*/
function update_question($options = array())
{
    // required values
    if(!$this->_required(array('body'), $options)) return false;

    // qualification (we're not allowing to update data that it shouldn't)
    $qualificationArray = array('name','rank','body','catID','fieldID','userID');
    foreach($qualificationArray as $qualifier)
    {
        if(isset($options[$qualifier])) $this->db->set($qualifier, $options[$qualifier]);
    	}

    $this->db->where('questionID', $options['questionID']);

    
    // Execute the query
    $this->db->update('Question');

    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}

/**
*get_ten_recent_question_data will return 10 recent questions
* --------------------------
*questionID
*name
*postedDate
*body
*rank
*KEY catID
*KEY fieldID
*KEY userID
*KEY commentID
*
*SELECT * FROM table ORDER BY date DESC LIMIT 10;
* @return array result() 
*/
function get_ten_recent_question($limit,$offset)
	{	
	//$this->db->select(' body,postedDate');
    //$this->db->order_by('postedDate', 'desc');
	//$this->db->limit(10);
	$query = $this->db->get('Question',$limit, $offset);
	

   
        //  it will return  array of objects from question type 
        return $query->result_array();
    
	}

/**method search_question will return question near to search term 
* --------------------------
*SELECT * FROM table ORDER BY date DESC LIMIT 10;
* @return array result() 
* @parameter searchTerm
 * */

function search_question()
	{
	$term = $this->input->post('s');
	$this->db->select(' body');
	$this->db->like('body', $term);
	$query = $this->db->get('Question');
	return $query->result_array();

	}

/**
*get_relevant_answers_for_question will returns all relevent answers to the question with  given questionID 
* --------------------------
*
* @return array result() 
* @parameter questionID
*/

// delete from Answer where answer.UserID=userid and Answer.questionID=quid

function get_relevant_answers($questionID)
	{
	$this->db->select(' body');
	$this->db->where('questionID', $questionID); 
	$query = $this->db->get('Answer');
	return $query->result();
	}




/**
* delete_question method removes a record from the Question table
*
*/
function delete_question($questionID)
	{
        

    $this->db->where('questionID', $questionID);
    $this->db->delete('Question');
	}

function delete_own_question($questionID,$userID){
	$this->db->select('questoinID,userID');
	$this->db->where('questionID',$questionID );
 	$this->db->where('userID',$userID);
	$query->db->get('Question');
	if($query==null){
		return false;
		}
		else{
		delete_question($questionID);
		}

	}
		
		
		public function createQuestion()

		{
		$this->load->helper('url');
	
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
	
		$data = array(
		'name' => $this->input->post('title'),
		'body' => $this->input->post('text')
		);
	
	
		return $this->db->insert('Question', $data);

		}
		
		
	
	
}// end of file
