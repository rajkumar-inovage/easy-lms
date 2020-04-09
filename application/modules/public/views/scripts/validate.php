<script type="text/javascript">
	const loginURL 		= 'login/login/index';
	const loaderSelector = document.getElementById('loader');
	
	//loaderSelector.style.display = 'block';

	if (typeof(Storage) !== "undefined") {
		
		const user_token = localStorage.getItem ('user_token');
		
		<?php
		// Try to get slug from url
		if (isset($_GET['sub'])) {
			$slug = $_GET['sub'];
			?>
			const slug = '<?php echo $slug; ?>';
			<?php
		} else {
			?>
			// Alternatively, try to get slug from local-storage
			const slug = localStorage.getItem ('slug');
			<?php
		}
		?>


		if (slug == null || slug == 'null' || slug == 'NULL' || slug == 'undefined') {
		} else {
			if (user_token == null || user_token == 'null' || user_token == 'NULL' || user_token == 'undefined') {
				document.location = appPath + loginURL + '?sub='+slug;
			} else {
				update_session (user_token);
				const dashboard = localStorage.getItem ('dashboard');
				document.location = appPath + dashboard;
			}
		}
	}

	function update_session (user_token) {
		const updateURL = '<?php echo site_url ('login/login_actions/update_session'); ?>/'+user_token;
		fetch (updateURL, { 
			method : 'POST',
		}).then (function (response) {
			return response.json ();
		}).then (function(result) {
			if (result.status == true) {
				toastr.success (result.message);
				//document.location = result.redirect;
			}
		});
	}	
</script>