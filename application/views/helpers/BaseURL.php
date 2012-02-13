<?php
	class Zend_View_Helper_BaseURL { // name class
		function baseURL(){ // name function
			$fc = Zend_Controller_Front::getInstance(); // get instance of front controller in Zend library
			return $fc->BaseURL(); // return this page in view
		}
	}
?>