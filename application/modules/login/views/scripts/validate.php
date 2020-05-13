<script type="text/javascript">
	/* 
		update_session, logout_user defined in app.js
	*/

	const loaderSelector = document.getElementById('loader');
	const access_code = '<?php echo $ac; ?>';
	
	loaderSelector.style.display = 'block';

	if (typeof(Storage) !== "undefined") {		
		
		const user_token = localStorage.getItem ('user_token');
		if (user_token == null || user_token == 'null' || user_token == 'NULL' || user_token == 'undefined') {
			logout_user (access_code);
		} else {
			update_session (user_token);
		}
	}
</script>