<script type="text/javascript">
	const loginURL 		= 'coaching/login/index';
	const loaderSelector = document.getElementById('loader');
	
	loaderSelector.style.display = 'block';

	<?php if ( ! $this->session->has_userdata ('is_logged_in')) { ?>
		if (typeof(Storage) !== "undefined") {
			
			const userToken = localStorage.getItem ('user_token');
			const slug = localStorage.getItem ('slug');

		    if (userToken == 'null' || userToken == null || userToken == '' || userToken == 'undefined') {
		   		document.location = appPath + loginURL + '?sub='+slug;
		    } else {
		    	const member_id = localStorage.getItem ('member_id');
		    	const role_id = localStorage.getItem ('role_id');
		    	const dashboard = localStorage.getItem ('dashboard');
		    	const is_logged_in = localStorage.getItem ('is_logged_in');
		    	const is_admin = localStorage.getItem ('is_admin');
		    	const user_token = localStorage.getItem ('user_token');
		    	const user_name = localStorage.getItem ('user_name');
		    	const role_lvl = localStorage.getItem ('role_lvl');
		    	const slug = localStorage.getItem ('slug');
		    	const coaching_id = localStorage.getItem ('coaching_id');
		    	const profile_image = localStorage.getItem ('profile_image');
		    	const logo = localStorage.getItem ('logo');
		    	const site_title = localStorage.getItem ('site_title');

		    	const set_session = '<?php echo site_url ('coaching/login_actions/update_session'); ?>/'+member_id+'/'+role_id+'/'+role_lvl+'/'+is_logged_in+'/'+is_admin+'/'+user_name+'/'+user_token+'/'+site_title+'/'+logo+'/'+profile_image+'/'+slug+'/'+coaching_id+'/'+dashboard;
		    	fetch (set_session, { 
					method : 'POST',
				}).then (function (response) {
					return response.json ();
				}).then (function(result) {
					if (result.status == true) {
						toastr.success (result.message);
						document.location = result.redirect;
					}
				});
		    }
		}
	<?php } else { ?>	
		if (typeof(Storage) !== "undefined") {

			const userToken = localStorage.getItem ('user_token');
			const slug = localStorage.getItem ('slug');

		    if (userToken == 'null' || userToken == null || userToken == '' || userToken == 'undefined') {
		   		document.location = appPath + loginURL + '?sub='+slug;
		    }
		}
	<?php } ?>
</script>