<?php

class Application_Model_Affiliate // named after folder models affiliate
{

	private $_dbTable; // create private variable
	
	public function __construct() // function which runs throughout site when called
	{
		$this->_dbTable = new Application_Model_DbTable_Affiliate(); // new instance of DB Table 
	}
	
	public function getAffiliates() // retrieve data
	{   
    $arr = $this->_dbTable->fetchAll(); // fetch all data from table
    
    $group = ""; // set var
    $group .= "<ul class='group'>"; // concantonate var
		foreach ($arr as $row){ // loop
		  $group .= "<li> &bull; ".$row->company."</li>"; // call data
		}
		$group .= "</ul>";
		return $group; // return data object
  }
	
	public function createAffiliate($array) // create array function
	{
		$this->_dbTable->insert($array); // insert array into database
	}
	
	public function updateAffiliate($array, $id) // update function
	{
		$this->_dbTable->update($array, "id = $id"); // update array based on id
	}
	
	public function deleteAffiliate($array, $id) // delete function
	{
		$this->_dbTable->delete($array, "id = $id"); // delete array function
	}
	
}

