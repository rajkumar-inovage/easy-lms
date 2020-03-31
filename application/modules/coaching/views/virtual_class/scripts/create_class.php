<script type="text/javascript">
	function create_meeting () {
		const meetingURL = document.getElementById ('meeting_url').value;
		fetch (meetingURL, {
			method: 'GET',
			mode: 'no-cors',
		}).then (function (response) {
			console.log (response);
		})
	}
</script>