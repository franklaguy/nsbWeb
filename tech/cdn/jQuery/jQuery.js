/* Author: R. Lewis - Date: 1/18/12 - nSb web ****** */
/* Last modified -  Date: 2/9/12 ******************* */
/* ***************** JQuery ************************ */	

/* ***************** Begin Login ******************* */
var ADMINTAB = {					// namespace
		container: "#adminTab", // hidden div
		url: "/nsbWeb/tech/login", // ajaxify
		form: "form#login",     // form
		
		load: function(){       					// function
			
			var _adminTab = this;					// function scope
			
			$.ajaxSetup({cache:true});				// turn off caching
			$.ajax ({								// ajax
				type: "post",						// method
				url: this.url,						// scope
				beforeSend: function(){				// before send
					$(_adminTab.container)			// hidden div
						.load(this.url+' div.rightBox fieldset') // ajax load
						.addClass('adminTab')		// add class
						.toggle();			        // show / hide
				}
			});
		}
}

$('li#admin a').live('click', function(e){	// click admin tab
	ADMINTAB.load();						// load namespace function
	e.preventDefault();						// override href
});

var LOGIN = function (){					// onclick function
	var form = 'form#login';				// form
	var data = $(form).serialize();			// JSON
	
	// post json data - query database - check if exists - process form
	$.post('/nsbWeb/tech/login', data);
	$(form).attr('action', '/nsbWeb/tech/login');
}
/* ***************** End Login ********************* */

var LEFTNAV = function() { // namespace unique to left nav - keeps script from loading until needed
	$('[class^=leftNavContent]').hide(); // hide all left nav content - will show if no-js
	$('.leftNavContent0').show(); // except this left nav content
	
	$('[class^=toggleNav]').click(function(){ // click function - anything with class name that starts with toggleNav
		$(this).next().toggle();  // show whatever follows toggleNav
		return false;
	});
};
LEFTNAV(); // call this script

/* ***************** Begin Curve ******************* */
$(document).ready(function (){ // namespace - run on page load - Curve
	$("#main").scrollable({ // main vertical scroll
			vertical: true,// basic settings
			keyboard: 'static',  // up/down keys will always control this scrollable
			onSeek: function(event, i) {// assign left/right keys to the actively viewed scrollable
		horizontal.eq(i).data("scrollable").focus();
		}
	}).navigator("#main_navi");// main navigator (thumbnail images)
 
	var horizontal = $(".scrollable").scrollable({ circular: true }).navigator(".navi"); // horizontal scrollables. each one is circular and has its own navigator instance
 
 	horizontal.eq(0).data("scrollable").focus();// when page loads setup keyboard focus on the first horzontal scrollable
});

var HINT = function() { // namespace - Show / Hide function
	$('#answer').hide(); // hide div - no-js rule
	$('#hint').click(function (){ // click function - id hint
		$('#answer').toggle('slow'); // toggle - id answer
	});
};
HINT(); // call
/* ***************** End Curve ********************* */ 		 
