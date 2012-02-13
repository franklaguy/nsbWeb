<?php

class Application_Model_FormLogin extends Zend_Form // Model uses native Zend Form stack
{
		public function __construct($options = null) 		// constructor
		{
			parent::__construct($options); 								// intialize constructor
			
			// Set Options
			$this->setLegend($options['legend']); // set legend
			$this->setName($options['name']);     // set name
			$this->setMethod($options['method']); // set method 
			$this->setAction($options['action']); // set action - for use in controller
			
			// Username Begin
			$username = new Zend_Form_Element_Text('username', array(             // new instance of form element text - name / id
			                'required'   => true,                                 // required field
			                'label'      => 'Username:',                          // label name
			                'filters'    => array('StringTrim', 'StringToLower'), //trim
											'validators' => array('alnum',array(
																						'regex', false, '/^[a-z]/i'))));// regex validate - alphanumeric
			$username->addErrorMessage('*Required field')                         // error message
			 				 //->setAttrib('size', 25)                                      // set attributes
			 				 ->setAttribs(array('size' => 25, 'required' => 'required'));
			
			// Email Begin
			$email = new Zend_Form_Element_Text('email', array( 									// instantiate email - name / id
											'required'   => true, 																// required field
											'label'      => 'Email', 															// label
											'filters'    => array('StringTrim', 'StringToLower'), // trim
											'validators' => array('emailAddress')));							// validate
			$email->addErrorMessage('Email address invalid')											// error message							
			      ->setAttribs(array('size' => 25, 'required' => 'required'));		// set attributes
			
			// Firstname Begin
			$fname = new Zend_Form_Element_Text('fname', array( 									// instantiate email - name / id
											'required'   => true, 																// required field
											'label'      => 'First Name:', 												// label
											'filters'    => array('StringTrim', 'StringToLower'), // trim
											'validators' => array('alpha')));							        // validate
			$fname->setAttribs(array('size' => 25, 'required' => 'required')) 		// set attributes
			      ->addErrorMessage('*Required field');                           // error message
			
			// Lastname Begin
			$lname = new Zend_Form_Element_Text('lname', array( 									// instantiate email - name / id
											'required'   => true, 																// required field
											'label'      => 'Last Name:', 												// label
											'filters'    => array('StringTrim', 'StringToLower'), // trim
											'validators' => array('alpha')));							        // validate
			$lname->setAttribs(array('size' => 25, 'required' => 'required')) 		// set attributes
			      ->addErrorMessage('*Required field');                           // error message
			
			// Phone Number Begin
			$phone = new Zend_Form_Element_Text('phone', array( 									// instantiate email - name / id
											'required'   => true, 																// required field
											'label'      => 'Phone:', 														// label
											'filters'    => array('StringTrim', 'StringToLower'))); // trim
			$phone->addValidator('regex', false, '/^(\()?([2-9]\d{2})(\)|-)?(\d{3})(-)?(\d{4})$/')// regex validate
			      ->addErrorMessage('*ex: 999-999-9999')                          // error message
			      ->setAttribs(array('size' => 25, 'required' => 'required'));		// set attributes
			
			// Password Begin
			$password = new Zend_Form_Element_Password('password',array( 					// instantiate - name / id
			                'required'   => true, 																// required field
			                'label'      => 'Password:', 													// label name
			                'filters'    => array('StringTrim', 'StringToLower'), // trim
											'validators' => array('alnum',array(
																			'regex', false, '/^[a-z]/i'))));      // regex validate - alphanumeric
			$password->addValidator('StringLength', false, array(6, 24))          // password must have at least 6 char
			         ->setAttribs(array('size' => 25, 'required' => 'required'));	// set attributes
			
			// Password Confirm Begin
			$passwordConfirm = new Zend_Form_Element_Password('passwordConfirm',array( 		// instantiate - name / id
			                'required'   => true, 																// required field
			                'label'      => 'ConfirmPassword:', 									// label name
			                'filters'    => array('StringTrim', 'StringToLower'), // trim
											'validators' => array('alnum',array(
																			'regex', false, '/^[a-z]/i'))));      // regex validate - alphanumeric
			$passwordConfirm->addValidator('StringLength', false, array(6, 24))   // password must have at least 6 char
											->addValidator(new Zend_Validate_Identical('password'))// make sure password is identical
											->addErrorMessage('*Must match password field')       // error message
											->setAttribs(array('size' => 25, 'required' => 'required'));	// set attributes
			
			// Submit Begin
			$submit = new Zend_Form_Element_Button('submit'); // new instance of submit element
			$submit->setLabel('Login') 												// label name
						 ->setAttrib('onClick', 'LOGIN();')					// jQuery login
						 ->setAttrib('type', 'submit')							// set button type
						 ->removeDecorator('DtDdWrapper'); 					// remove dt tags 
			
			// Add Elements
			$this->addElements(array($fname,$lname,$phone,$username,$email,$password,$passwordConfirm,$submit));  // add these elements

			// Add Form and Form Decorators
			$this->setDecorators(array(array('ViewScript', array('viewScript' => 'login/_formLogin.phtml')))); // form
			$this->addDecorator('HtmlTag', array('tag' => 'fieldset')); 																			 // add fieldset
		}
}

