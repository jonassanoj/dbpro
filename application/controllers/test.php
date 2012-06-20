<?php

/**
 * the test controller
 *
 * A controller for testing model.
 * In the wiki there is a short howto that explains the testing process
 * The comments in this file however should be self-explanatory.
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
	
	// DO NOT CHANGE THIS FUNCTION
	public function _remap($method,$params = array()) 	{
		
		if (!method_exists($this, $method)) redirect('/test/test1');
	    call_user_func_array(array($this, $method), $params);
	    
	    $data=array('title'=>'Test Results','result'=>$this->result);
		$this -> load -> view('test', $data);
	}

	public function _report($result, $title='Unnamed'){
		$this->result[$title]=$result;
	}
/////////////////////////////////////////////////////////////////////////	
///  TEST AREA; Here you can write test functions
///
///  you can give them any name and call them with localhost/test/name
///  It's recommended not to push changes to this controller to the repository.
/// 
	
<<<<<<< HEAD
	public function test1()
	{
		// this calls a function from usermodel. 
		// the resuts are reported by calling the $this->_report function.
		
		$this->_report( 
=======
	public function gut()
	{$this->_report( 
>>>>>>> 790cc173d628cdc5425520b2c1b81ad511ae3e9e
			    // the return value will be shown in the test report:
		 		$this -> user_model -> get_usertypes(),
				// the second parameter will give a title to the report:
				'Test of user_model -> get_usertypes()'
		 		);
<<<<<<< HEAD
	}
=======
		}
>>>>>>> 790cc173d628cdc5425520b2c1b81ad511ae3e9e


	public function test2() {
		$this->_report("Hello I am test2"); // replace the string with a call to your model
	}
	
	
	
	public function multitest() { 
		// You can run more than one test in one function.
		// But make sure all the tests you call give different titles to the result
		$this->$test1();
		$this->$test2();
	}
	

}

