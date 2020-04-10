const appPath = 'http://localhost/repos/easycoachingapp/';
const sidebarSection = document.getElementById("sidebar");
const mainSection = document.getElementById("content");
const outputDiv = document.getElementById("response"); 
const loader = document.getElementById("loader");

window.addEventListener ('load', async e => {
	// Register Servie-worker
	if ('serviceWorker' in navigator) {
		try {
			navigator.serviceWorker.register (appPath + 'sw.js');
		} catch (error) {
			console.log ('ServiceWorker registration failed');		
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



/*----==== Logout User ====----*/
function logout_user () {
	const slug = localStorage.getItem ('slug');
	window.localStorage.clear ();
	localStorage.setItem ('slug', slug);
	document.location = appPath + 'login/login/logout/'+slug;
}

/*
 * Interactive App install button
*/
let deferredPrompt;
window.addEventListener('beforeinstallprompt', event => {

	// Prevent Chrome 67 and earlier from automatically showing the prompt
	event.preventDefault();

	// Stash the event so it can be triggered later.
	deferredPrompt = event;

	// Update UI notify the user they can add to home screen
	document.querySelector('#installBanner').style.visibility = 'visible';

	// Attach the install prompt to a user gesture
	document.querySelector('#installBtn').addEventListener('click', event => {

		// Show the prompt
		deferredPrompt.prompt();

		// Wait for the user to respond to the prompt
		deferredPrompt.userChoice
		  .then((choiceResult) => {
		    if (choiceResult.outcome === 'accepted') {
				// Update UI notify the user they can add to home screen
				document.querySelector('#installBanner').style.visibility = 'hidden';
				const slug = localStorage.getItem ('slug');
				document.location.href = appPath + 'student/login/index/?sub='+slug;
		    } else {
		      console.log('User dismissed the A2HS prompt');
		    }
		    deferredPrompt = null;
		});
	});


});

// Check if app was successfully installed
window.addEventListener('appinstalled', (evt) => {
	app.logEvent ('a2hs', 'installed');
	document.querySelector('#installBanner').style.display = 'none';
	document.querySelector('#installBanner').style.visibility = 'hidden';
	$('#installBanner').hide ();
});

/* ===== Side Menu Toggler ===== */ 
$('#toggle_sidebar').on ('click', function (e) {
    e.stopPropagation ();
	$('#sidebar').toggleClass ('sidebar-open');
});
$('#toggle_sidebar_left').on ('click', function (e) {
    e.stopPropagation ();
	$('#sidebar-left').toggleClass ('sidebar-open');
});
$('#toggle_sidebar_right').on ('click', function (e) {
    e.stopPropagation ();
	$('#sidebar-right').toggleClass ('sidebar-open');
});
$('html, body').click(function(e) {
   if ($('#sidebar').hasClass ('sidebar-open')) {
     $('#sidebar').removeClass('sidebar-open');
   }
   if ($('#sidebar-left').hasClass ('sidebar-open')) {
     $('#sidebar-left').removeClass('sidebar-open');
   }
   if ($('#sidebar-right').hasClass ('sidebar-open')) {
     $('#sidebar-right').removeClass('sidebar-open');
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
            $('#password-strength').addClass('progress-bar bg-danger');            
            $('#password-strength').css('width', '30%');
            $('#password-strength').html('Very Weak');
            $("input[type=submit]").attr("disabled",true);
        }
        else if (strength == 2 )
        {
            $('#password-strength').removeClass();
            $('#password-strength').addClass('progress-bar bg-warning');                                    
            $('#password-strength').css('width', '60%');
            $('#password-strength').html('Week');
			$("input[type=submit]").attr("disabled",true);
        }
        else if (strength == 4)
        {
            $('#password-strength').removeClass();
            $('#password-strength').addClass('progress-bar bg-success');
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