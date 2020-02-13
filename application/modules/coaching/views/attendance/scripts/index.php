<script>
$(document).ready (function () {
	$('#search-status').on ('change', function () {
		var status = $(this).val ();
		var url = '<?php echo site_url ('coaching/attendance/index/'.$coaching_id.'/'.$role_id); ?>/'+status+'/<?php echo $batch_id.'/'.$date; ?>';
		$(location).attr('href', url);
	});

	$('#search-role').on ('change', function () {
		var role_id = $(this).val ();
		var url = '<?php echo site_url ('coaching/attendance/index/'.$coaching_id); ?>/'+role_id+'/<?php echo $status.'/'.$batch_id.'/'.$date; ?>';
		$(location).attr('href', url);
	});
	
	$('#search-batches').on ('change', function () {
		var batch_id = $(this).val ();
		var url = '<?php echo site_url ('coaching/attendance/index/'.$coaching_id.'/'.$role_id.'/'.$status); ?>/'+batch_id+'<?php echo $date; ?>';
		$(location).attr('href', url);
	});
});


function mark_attendance (btn_id, member_id, att_status, date) {
	var formURL = '<?php echo site_url ('coaching/attendance_actions/mark_attendance'); ?>/'+member_id+'/'+att_status+'/'+date;
	
	fetch (formURL, {
		method : 'POST',
	}).then (function (response) {
		return response.json ();
	}).then(function(result) {
		if (result.status == true) {
			//loaderSelector.style.display = 'none';
			$('#present'+member_id).removeClass ('btn-success');
			$('#present'+member_id).addClass ('btn-light');
			
			$('#leave'+member_id).removeClass ('btn-success');
			$('#leave'+member_id).addClass ('btn-light');
			
			$('#absent'+member_id).removeClass ('btn-success');
			$('#absent'+member_id).addClass ('btn-light');
			
			$('#'+btn_id).removeClass ('btn-light');
			$('#'+btn_id).addClass ('btn-success');
			
			toastr.success (result.message);
		}
	});
	
	return true;
}

$('#date').on ('change', function () {
	var string = $(this).val ();
	var url = '<?php echo site_url ('coaching/attendance/index/'.$coaching_id.'/'.$role_id.'/'.$status.'/'.$batch_id); ?>/'+string;
	$(location).attr ('href', url);
});
</script>