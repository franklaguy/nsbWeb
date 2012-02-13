<?php

class LoginController extends Zend_Controller_Action // form controller
{

    public function init()
    {
        //
    }

    public function indexAction()
    {  	
    		if(Zend_Auth::getInstance()->hasIdentity()){     // if logged in
    			$this->_redirect('admin');										 // redirect
    		}
    	
        $login = new Application_Model_FormLogin(array(  // instantiate model
        		'legend' => 'Login',   // option - legend
        		'name'   => 'login',   // option - id
        		'method' => 'post',    // option - method
        		'action' => ''));      // option - action
        
        // Turn off unused form elements
        $login->getElement('fname')->setRequired(false);
       	$login->getElement('lname')->setRequired(false);
       	$login->getElement('phone')->setRequired(false);
       	$login->getElement('email')->setRequired(false);
       	$login->getElement('passwordConfirm')->setRequired(false);  
        
        if ($this->getRequest()->isPost()){ 												  // if form is submitted 
        	if($login->isValid($this->_request->getPost())) {   			  // if required fields are filled in  
        
		        $verify = new Application_Model_Users();                  // call model - database
        		$authAdapter = $verify->verifyUsers();									  // get function from model
        		
        		$authAdapter->setIdentity($login->getValue('username'))   // get form input value - set identity
        								->setCredential($login->getValue('password'));// get form input value - set credentials
        		$auth = Zend_Auth::getInstance();													// instantiate Zend Auth
        		$result = $auth->authenticate($authAdapter);							// get result of authAdatper
        		
        		if($result->isValid()){																		// if input matches database - login
        			$identity = $authAdapter->getResultRowObject();         // get row object from adapter
        			$username = $this->getRequest()->getPost('username');   // get post data
        			$auth->setStorage(new Zend_Auth_Storage_Session($username)); // send post data to storage
        			$authStorage = $auth->getStorage();                     // add storage var
        			$authStorage->write($identity);                         // write row object to storage
        			$this->_redirect('admin');                              // redirect
        		} else {
        			$this->view->errorMessage = "<ul class='errors'><li>Username or Password invalid.</li></ul>"; // else error
        		}
        		
        	}
        }
        
        $this->view->login = $login; 																	// view var
    }
    
    public function registerAction()
    {
    	$register = new Application_Model_FormLogin(array(
        		'legend' => 'register',   													// option - legend
        		'name'   => 'register',   													// option - id
        		'method' => 'post',    															// option - method
        		'action' => ''));      															// option - action
    	
    	if ($this->getRequest()->isPost()){												 // if form is submitted
    		if($register->isValid($this->_request->getPost())) {		 // if required fields are filled in
    			// get required fields
    			$fname 		= $this->getRequest()->getPost('fname');
    			$lname 		= $this->getRequest()->getPost('lname');
    			$email 		= $this->getRequest()->getPost('email');
    			$phone 		= $this->getRequest()->getPost('phone');
    			$username = $this->getRequest()->getPost('username');
    			$password = $this->getRequest()->getPost('password');
    			$role 		= 'admin';
    			
    			try {																									// try
	    			$newUser = new Application_Model_Users();						// call database
	    			$newUser->createUsers(array(												// db array
	    					'fname' 		=> $fname,
	    					'lname' 		=> $lname,
	    					'email' 		=> $email,
	    					'phone' 		=> $phone,
	    					'username' 	=> $username,
	    					'password' 	=> $password,
	    					'role' 			=> $role));
	    			
	    			$identity = Zend_Auth::getInstance()->getStorage(); // get storage
	    			$identity->write($username);												// write identity to storage
	    			
	    			$this->_redirect('admin');													// goto admin on submit
	    			
    			} catch (Exception $e) {															// catch
    				$this->view->errorMessage = "<ul class='errors'><li>Username or Password already in use.</li></ul>"; // catch error
    			}
    		}
    	}
    	
    	$this->view->register = $register; 													// view var
    }
}

