<?php

class ProfileController extends Zend_Controller_Action
{
    public function init()
    {
    		$auth = Zend_Auth::getInstance();
    		
        if($auth->hasIdentity()){
        	$layout = $this->_helper->layout();       // get layout helper
        	$layout->setLayout('admin_layout');       // set to layout 2
        }
    }

    public function indexAction() // Page - /tech/profile/
    {
        $this->view->headTitle('Company Profile'); // Set page title
        
        // retrieve data object from model and pass to view as variable
        $clients 						= new Application_Model_Clients(); // new instance of model
        $this->view->web 		= $clients->webClients(); // get web clients
    }

    public function marketingAction() // Page - /tech/profile/marketing/
    {
        $this->view->headTitle('Marketing Profile'); // Set - page title
        
        // retrieve data object from model and pass to view as variable
        $affiliates = new Application_Model_Affiliate(); // set var to model - new instance of model
        $this->view->companies = $affiliates->getAffiliates(); // set view var to model function
        
        
        $clients 						= new Application_Model_Clients(); // new instance of model
        $this->view->other 	= $clients->otherClients(); // get film/tv/music clients
    }


}