<script type="text/javascript">

	localStorage.clear ();

	setCookie ('easy_coaching_app', '', '-200');

	if ('caches' in window) {
	    caches.delete('EasyCoaching-V1');
	    caches.delete('EasyCoaching-V1-dynamic');
	} 	
</script>