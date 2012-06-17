<?php

/**
* the test controller
*
* A controller for testing models. To test your model
*
*
* @package controllers
*/

class Test extends CI_Controller {

	
	private $result;
	
	/**
	 * constructor
	 *
	 * loads the model you want to test.
	 *
	 */
	public function __construct() {
		parent::__construct();
		//////////////////////////////////////////////////////////////
		//  Load here all the models you want to test.
		//  
		$this -> load -> model('user_model');
	}
	
	/////////////////////////////////////////////////////////////////////
	// DO NOT CHANGE THIS FUNCTION
	public function _remap($method) 	{
		if (!method_exists($this, $method)) $this->test1();
	    else $this->$method();
	    $data=array('title'=>'Test Results','result'=>$this->result);
		$this -> load -> view('test', $data);
	}

/////////////////////////////////////////////////////////////////////////	
///  TEST AREA; Here you can write test functions
///
///  you can give them any name and call them with localhost/test/name
///  
/// 
	
	public function test1()
	{
		// this calls a function from usermodel. everything in $this->result is then automatically shown.
		$this->result = $this -> user_model -> get_usertypes();
	}


	
	
	public function test2() {
		
		$this->result = 5;// assign here the result from the model.
	}
	
	
	
	public function test3() {
	
		$this->result = 10; // assign here the result from the model.
	}
	

}
