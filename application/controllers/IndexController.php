<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    		$auth = Zend_Auth::getInstance();           // instantiate auth
    		
        if($auth->hasIdentity()){										// if user has identity in storage
        	$layout = $this->_helper->layout();       // get layout helper
        	$layout->setLayout('admin_layout');       // set to layout 2
        	$this->view->adminTab = "<script type='text/javascript'>$(document).click(function LOGIN() { xhr.abort() });</script>";
        }
    }

    public function indexAction()
    {
        // below - updates database based on id
        //$affiliate->updateAffiliate(array(
        		//'company' => 'Zend Yellow Pages', 
        		//'base' => 'GLOBAL'
        		//), 3);
    }

}