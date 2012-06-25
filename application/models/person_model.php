<?php
class Person_model extends CI_Model {
	
	private $tbl_person= 'User';
	private $tbl_type ='UserType';
	private $tbl_feild ='Field';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('userID','asc');
		return $this->db->get($tbl_person);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_person);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('userID','asc');
		return $this->db->get($this->tbl_person, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('userID', $id);
		return $this->db->get($this->tbl_person);
	}
	
	function save($person){
		$this->db->insert($this->tbl_person, $person);
		return $this->db->insert_id();
	}
	
	function update($id, $person){
		$this->db->where('userID', $id);
		$this->db->update($this->tbl_person, $person);
	}
	
	function delete($id){
		$this->db->where('userID', $id);
		$this->db->delete($this->tbl_person);
	}
	function get_feild($fid){
		$this->db->select('fieldName');
		$this->db->where('fieldID', $fid);		
		$query = $this->db->get('Field');
		return $query -> result();		
	}
	function get_type($tid){
		$this->db->select('userType');
		$this -> db -> where('userTypeID' , $tid);
		$query = $this->db->get('UserType');
		return $query -> result();		
	}
	function get_types(){
		$this->db->select('userType','userTypeID');
		return $this->db->get('UserType');
		//return $query -> result();	
	
	}
}
?>
