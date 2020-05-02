<script type="text/javascript">
	/* 
		update_session, logout_user defined in app.js
	*/

	const loaderSelector = document.getElementById('loader');
	const access_code = <?php echo ($ac!='')?"'$ac'":"localStorage.getItem ('access_code')?localStorage.getItem ('access_code'):'';"; ?>

	loaderSelector.style.display = 'block';

	if (typeof(Storage) !== "undefined") {

		localStorage.setItem ('access_code', access_code);
		
		const user_token = localStorage.getItem ('user_token');
		if (user_token == null || user_token == 'null' || user_token == 'NULL' || user_token == 'undefined') {
			logout_user ();
		} else {
			update_session (user_token);
		}
	}
</script>