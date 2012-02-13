<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initViewHelpers() {
		// Create Layout view
		$this->bootStrap('layout'); // Call this boot strap
		$layout = $this->getResource('layout'); // Get layout resource from application.ini
		$view = $layout->getView(); // Send resource out as view
		
		// Set meta data
		$view->headMeta()->prependName('keywords', 'novelty Soundbytes, nsb, blogOsphere, tech')
									 ->prependName('Description', 'Tech stuffs by nSb web')
									 ->prependName('viewport', 'width=device-width, initial-scale=1.0')
									 ->prependHttpEquiv('X-UA-Compatible','IE=Edge;chrome=1');
		
		// Set title data
		$view->headTitle()->setSeparator(' - '); // Separate titles with this
		$view->headTitle('Tech Stuffs by nSb web'); // Main title
		
		define('BASEURL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
}