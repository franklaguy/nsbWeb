<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->layout();       // get layout helper
        $layout->setLayout('admin_layout');       // set to layout 2
    }

    public function indexAction()									// index page
    { 
    	  $auth = Zend_Auth::getInstance();                 									// instantiate auth
    	  
    		if($auth->hasIdentity()){                         									// if user has logged in
    			$identity = $auth->getIdentity();																	// get identity from storage
        	$this->view->welcome = "<p>Hello ". ucfirst($identity)."</p>";    // welcome txt
        	$this->view->logout = "<p><a href='admin/logout'>log out</a></p>";// logout link to logout action
    		} else {
    			$this->_redirect(BASEURL."login");																 // else redirect
    		}
    }

    public function logoutAction()                  // logout page
    {
        Zend_Auth::getInstance()->clearIdentity();  // logout
        $this->_redirect(BASEURL);									// redirect
    }


}



