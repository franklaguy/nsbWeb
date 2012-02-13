<?php

class Application_Model_Accounts
{
		protected $_dbTable;
		
		public function __construct()
		{
			$this->_dbTable = new Application_Model_DbTable_Users();
		}
		
		public function verifyAccount() {

			// Begin - new Auth
			$login = new Application_Model_FormLogin(array(  // instantiate model
        		'legend' => 'Login',   // option - legend
        		'name'   => 'login',   // option - id
        		'method' => 'post',    // option - method
        		'action' => ''));      // option - action
			
			$db = Zend_Db_Table::getDefaultAdapter();
			$authAdapter = new Zend_Auth_Adapter_DbTable($db);
			$authAdapter->setTableName('users');
			$authAdapter->setIdentityColumn('username');
			$authAdapter->setCredentialColumn('password');
			// $authAdapter->setCredentialTreatment('MD5(?) and confirmed = 1');
			
			$authAdapter->setIdentity($login->getValue('username'));
			$authAdapter->setCredential($login->getValue('password'));
			
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($authAdapter);
			
			if($result->isValid()){
				$account = new Application_Model_Accounts();
				$lastLogin = $account->findByUsername($this->_dbTable->getValue('username'));
				$lastLogin->last_login = date('Y-m-H:i:s');
				$lastLogin->save();
				$this->_helper->flashMessenger->addMessage('Logged in');
				$this->_helper->redirector('index', 'index');
			} else {
				$this->view->errors["form"] = array("Login failed");		
			}
			// End - new Auth
			
					/* Begin - Auth
					 $db = Zend_Db_Table::getDefaultAdapter();
					$authAdapter = new Zend_Auth_Adapter_DbTable($db);
					$authAdapter->setTableName('accounts');
					$authAdapter->setIdentityColumn('username');
					$authAdapter->setCredentialColumn('password');
					$authAdapter->setCredentialTreatment('MD5(?) and confirmed = 1');
					$authAdapter->setIdentity($this->_dbTable->getValue('username'));
					$authAdapter->setCredential($this->_dbTable->getValue('password'));
					$auth = Zend_Auth::getInstance();
					$result = $auth->authenticate($authAdapter);
						
					if($result->isValid()){
					$account = new Application_Model_Accounts();
					$lastLogin = $account->findByUsername($this->_dbTable->getValue('username'));
					$lastLogin->last_login = date('Y-m-H:i:s');
					$lastLogin->save();
					$this->_helper->flashMessenger->addMessage('Logged in');
					$this->_helper->redirector('index', 'index');
					} else {
					$this->view->errors["form"] = array("Login failed");
						
					}
					// End Auth */
						
					// Begin - Hello
					//$data = $this->_request->getParams(); 									// request form post data
					//foreach($data as $row => $value){ 											// loop
						//if($row === "username"){  														// if row is username
							//echo "<p class='helloAdmin'>Hello ".$value."</p>";  // print
						//}
					//}
					// End Hello
		}

}

