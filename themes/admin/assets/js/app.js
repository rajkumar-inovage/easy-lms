const appPath = 'https://indiatests.in/staging/app/';
const sidebarSection = document.getElementById("sidebar");
const mainSection = document.getElementById("content");
const outputDiv = document.getElementById("response"); 
const loader = document.getElementById("loader");

window.addEventListener ('load', async e => {
	// Register Servie-worker
	if ('serviceWorker' in navigator) {
		try {
			//navigator.serviceWorker.register (appPath + 'sw.js');
			//console.log ('ServiceWorker registered');
		} catch (error) {
			//console.log ('ServiceWorker registration failed');		
		}
	}
	//validate_session ();
});


var submitFormSelector = document.getElementById ('validate-1');
if (submitFormSelector) {	
	submitFormSelector.addEventListener ('submit', e => {
		e.preventDefault ();
		const formURL = submitFormSelector.getAttribute ('action');
		var formData = new FormData(submitFormSelector);
		toastr.info ('Please wait...');
		fetch (formURL, { 
			method : 'POST',
			body: formData,
		}).then (function (response) {
			return response.json ();
		}).then(function(result) {
			toastr.clear ();
			if (result.status == true) {
				toastr.success (result.message);
				document.location = result.redirect;
			} else {
				var message = result.error.replace('/[\n\r]/g', '');
				toastr.error (message);
			}
		});
	});
}


var submitFormSelectors = document.getElementsByClassName ('validate-form');
var i;
for (i = 0; i < submitFormSelectors.length; i++) {
	const submitFormSelector = submitFormSelectors[i];
	if (submitFormSelector) {	
		submitFormSelector.addEventListener ('submit', e => {
			e.preventDefault ();
			const formURL = submitFormSelector.getAttribute ('action');
			var formData = new FormData(submitFormSelector);
			toastr.info ('Please wait...');
			fetch (formURL, { 
				method : 'POST',
				body: formData,
			}).then (function (response) {
				return response.json ();
			}).then(function(result) {
				console.log (result);
				toastr.clear ();
				if (result.status == true) {
					toastr.success (result.message);
					document.location = result.redirect;
				} else {
					var message = result.error.replace('/[\n\r]/g', '');
					toastr.error (message);
				}
			});
		});
	}
}

/* Upload Image */
const uploadFormSelector = document.getElementById ('upload_image');
if (uploadFormSelector) {
	uploadFormSelector.addEventListener ('submit', e => {
		e.preventDefault ();
		const formURL = uploadFormSelector.getAttribute ('action');
		var formData = new FormData(uploadFormSelector);
		toastr.info ('Please wait...');
		fetch (formURL, { 
			method : 'POST',
			body: formData,
		}).then (function (response) {
			return response.json ();
		}).then(function(result) {
			console.log (result);
			if (result.status == true) {
				toastr.success (result.message);
				document.location = result.redirect;
			} else {
				var message = result.error.replace('/[\n\r]/g', '');
				toastr.error (message);
			}
		});
	});
}

async function fetchPage (url = defaultPage) {
	try {
		const response = await fetch (url);
		const json = await response.json (); 
		if (json.status == true) {
			outputDiv.innerHTML = json.message;
			loader.style.display = 'none';
		} else if (json.status == false) {
		}
	} catch (error) {
		outputDiv.innerHTML = 'No internet connection';
		loader.style.display = 'none';
	}
}

/* JS Confirmation dialog */
function show_confirm (msg, url) {
	var k = confirm (msg);	
	if (k) {
		toastr.success ('Action completed successfully');
		document.location = url;
	} 
}

function show_confirm_ajax (msg, url, redirect) {
	var k = confirm (msg);	
	if (k) {
		fetch (url, { 
			method : 'POST',
		}).then (function (response) {
			toastr.info ('Please wait...');
			return response.json ();
		}).then(function(result) {
			if (result.status == true) {
				toastr.success (result.message);
				document.location = redirect;
			} else {
				var message = result.error.replace('/[\n\r]/g', '');
				toastr.error (message);
			}
		});
	}
}


function validate_session () {
	var url = appPath + 'login/page/login';
    var is_logged_in = localStorage.getItem ('is_logged_in');
	if (is_logged_in == 1) {
		// Check session
		
	} else {
		document.location = url;
	}
	/*
	//alert (url);
	fetch (url, {
		method : 'POST',
	}).then (function (response) {
		toastr.info ('Validating session...');
		return response.json ();
	}).then(function(result) {
		if (result.status == 1) {
			toastr.success (result.message);
			document.location = result.redirect;
			//alert ('logged in');
		} else if (result.status == '-1') {
			//alert ('Not logged in');
			toastr.error (result.error);
			document.location = result.redirect;
		}
		alert (result.module);
	});
	if (is_logged_in == 1) {
	}
	/*
	*/
}


/*----==== Aotu Login User ====----*/
function set_login_session (session) {
	if (! localStorage.getItem ('is_logged_in') || localStorage.getItem ('is_logged_in') == false) {	
	   localStorage.setItem('is_logged_in', session.is_logged_in );
	   localStorage.setItem('member_id', session.member_id );
	   localStorage.setItem('is_admin', session.is_admin );
	   localStorage.setItem('token', session.token );
	   localStorage.setItem('user_name', session.user_name);
	   localStorage.setItem('role_id', session.role_id);
	   localStorage.setItem('role_lvl', session.role_lvl);
	   localStorage.setItem('profile_image', session.profile_image);
	   localStorage.setItem('dashboard_url', session.dashboard_url);
	   localStorage.setItem('myaccount_url', session.my_account_url);
	   localStorage.setItem('logout_url', session.logout_url );
	}
}

/*----==== Logout User ====----*/
function logout_user () {
	window.localStorage.clear ();
	document.location = appPath + 'login/page/logout';
}

/* ===== Populate Menu ===== */
function create_menus () {
}

function _void () {
	return false;
}

/* ===== Side Menu Toggler ===== */ 
$('#toggle_sidebar').on ('click', function (e) {
    e.stopPropagation ();
	$('#sidebar').toggleClass ('sidebar-open');
});

$('html, body').click(function(e) {
   if ($('#sidebar').hasClass ('sidebar-open')) {
     $('#sidebar').removeClass('sidebar-open');
   }
});

/* ===== Tooltips Init ===== */ 
$(function () {
  $('[data-toggle="tooltip"]').tooltip(); 
});

/* ===== Password  ===== */
$(document).ready(function() {
    $('#password').on('keyup',function(){		
        checkStrength(this.value);			
		matchPassword($("#conf_password").val());	 
	});    
	$('#conf_password').on('keyup',function(){		
			matchPassword(this.value);	
	});      
	//If confirm_password didn't match.
	function matchPassword(conf_password){
		if (conf_password === $("#password").val() && ($("#conf_password").val().length !=0)) {            
			$('#re_pass').removeClass();            
			$('#re_pass').addClass('fa fa-check text-success');
		}
		else{
			$('#re_pass').removeClass();            
			$('#re_pass').addClass('fa fa-exclamation-triangle  text-danger');
		}	
	}
    function checkStrength(password){
        var strength = 0;
        //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
             strength += 1 ;
			 $('#letter').removeClass();
             $('#letter').addClass('fa fa-check text-success');
        }
        else{
            $('#letter').removeClass();
			$('#letter').addClass('fa fa-exclamation-triangle  text-danger');
        }	
        //If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)){
            strength += 1;
			$('#number').removeClass();
            $('#number').addClass('fa fa-check text-success'); 
        } else{
            $('#number').removeClass();            
			$('#number').addClass('fa fa-exclamation-triangle  text-danger');
        } 
        //If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
			$('#spcl_char').removeClass();            
            $('#spcl_char').addClass('fa fa-check text-success');
        }
        else{
            $('#spcl_char').removeClass();            
			$('#spcl_char').addClass('fa fa-exclamation-triangle  text-danger');
        }
        if (password.length > 7){
         strength += 1;
		 $('#length').removeClass();            
         $('#length').addClass('fa fa-check text-success');
        }
        else{
            $('#length').removeClass();            
			$('#length').addClass('fa fa-exclamation-triangle  text-danger');
        }
       // If value is less than 2
        if (strength < 2 )
		{
            $('#password-strength').removeClass();
            $('#password-strength').addClass('progress-bar progress-bar-danger');            
            $('#password-strength').css('width', '20%');
            $('#password-strength').html('Very Weak');
            $("input[type=submit]").attr("disabled",true);
        }
        else if (strength == 2 )
        {
            $('#password-strength').removeClass();
            $('#password-strength').addClass('progress-bar progress-bar-warning');                                    
            $('#password-strength').css('width', '60%');
            $('#password-strength').html('Week');
			$("input[type=submit]").attr("disabled",true);
        }
        else if (strength == 4)
        {
            $('#password-strength').removeClass();
            $('#password-strength').addClass('progress-bar progress-bar-success');
            $('#password-strength').css('width', '100%');
            $('#password-strength').html('Strong');
            $("input[type=submit]").attr("disabled",false);            
        }
    }	
});
/*
 * Cookie Functions
 *
 * @setCookie Create a new cookie, Change or Delete cookie
 * @getCookie Get the value of a cookie
 * @checkCookie To check if a cookie is set
 *
 */
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie(cname) {
  var name = getCookie(cname);
  if (name != "") {
   return true;
  } else {
   return false;
  }
}