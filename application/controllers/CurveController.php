<?php
	class CurveController extends Zend_Controller_Action {
		
		public function init() 
		{
			$this->view->adminLogin = "<script type='text/javascript'>$(document).click(function LOGIN() { xhr.abort() });</script>";
		}		
		public function indexAction() { }	
		
	}
?>