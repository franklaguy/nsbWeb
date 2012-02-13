<?php

class Application_Model_Users
{
	
	private $_dbTable;
	
	public function verifyUsers()													// function
	{
		$db = Zend_Db_Table::getDefaultAdapter();						// connect to application.ini adapter
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);	// new instance of db table
		$authAdapter->setTableName('users')									// db table name
								->setIdentityColumn('username')					// this column
								->setCredentialColumn('password');			// this column
		return $authAdapter;																// return data
	}
	
	public function createUsers($array) 												// create users
	{
		$this->_dbTable = new Application_Model_DbTable_Users();  // users db
		$this->_dbTable->insert($array);													// insert users
	}

}

