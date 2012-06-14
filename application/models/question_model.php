<?php
class Question_model extends CI_Model {

	public function getlist($offset,$limit,$filter=array())
	{
	// TODO: implement Filter
	    $this->db->select('questionID,title');
	    $query = $this->db->get('Question',$limit,$offset);
	    return $query->result();
	}

	public function getcount($filter=array())
	{
	// TODO: implement Filter
	    $this->db->from('Question');
	return $this->db->count_all_results();
	}

	public function getdetails($qid)
	{
		$query = $this->db->get_where('Question', array('questionID' => $qid));
		return $query->first_row();
	}

}
