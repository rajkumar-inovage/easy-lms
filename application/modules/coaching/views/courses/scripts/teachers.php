 <script>
$(document).ready (function () {
	function toggleEnrolmentSetting(){
		if ($('.check:checked').length) {
			$('#set_enrolment').removeAttr('disabled');
		} else {
			$('#set_enrolment').attr('disabled', true);
		}
	}
	$("#check-all").click (function() {
		$('.check').not(this).prop('checked', this.checked);
		toggleEnrolmentSetting();
	});
	$(".check").click(function(){
		toggleEnrolmentSetting();
	});
});
</script>