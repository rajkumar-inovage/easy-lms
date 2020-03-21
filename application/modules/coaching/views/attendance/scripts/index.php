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

var dateString = '<?php echo $dt_string; ?>';
function mark_attendance (btn_id, member_id, att_status) {
	console.log(dateString);
	var formURL = '<?php echo site_url ('coaching/attendance_actions/mark_attendance'); ?>/'+member_id+'/'+att_status+'/'+dateString;
	var disabledBtn = $('#'+btn_id).parent().find('.btn.disabled');
	disabledBtn.removeClass('disabled btn-success').addClass('btn-light');
	$('#'+btn_id).removeClass('btn-light').addClass('disabled');
	fetch (formURL, {
		method : 'POST',
	}).then (function (response) {
		return response.json ();
	}).then(function(result) {
		if (result.status == true) {
			$('#'+btn_id);
			$('#'+btn_id).addClass ('btn-success');
			toastr.success(result.message);
		}
	});
	
	return true;
}
$('#date').on ('change', function () {
	var string = $(this).val();
	var attendanceDateURL = '<?php echo site_url ('coaching/attendance_actions/get_attendance/'.$coaching_id.'/'); ?>' + string;
	$(this).trigger('blur');
	$('body').addClass('loading');
	$('.btn.disabled').removeClass('btn-success').addClass('btn-light');
	$('.btn.btn-light').addClass('disabled');
	fetch (attendanceDateURL, {
		method : 'GET',
	}).then (function (response) {
		return response.json ();
	}).then(function(result) {
		if (result.status == true) {
			$('body.loading').removeClass('loading');
			$('.btn.disabled').removeClass('disabled');
			dateString = result.date;
			Object.keys(result.attendance).forEach((member_id) => {
				if(result.attendance[member_id] !== null){
					var member_attendance = parseInt(result.attendance[member_id].attendance);
					switch(member_attendance){
						case 1:
							$(`#present${member_id}`).removeClass('btn-light').addClass('btn-success');
						break;
						case 2:
							$(`#leave${member_id}`).removeClass('btn-light').addClass('btn-success');
						break;
						case 3:
							$(`#absent${member_id}`).removeClass('btn-light').addClass('btn-success');
						break;
						default:
					}
					$('.btn.btn-success').addClass('disabled');
				}
		    });
		}
	});
});
</script>