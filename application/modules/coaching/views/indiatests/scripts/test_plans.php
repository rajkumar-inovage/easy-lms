<script type="text/javascript">
	
	$(document).ready (function () {
		$('#categories').on ('change', function () {
			var category_id = $(this).val ();
			var url = '<?php echo site_url ('coaching/indiatests/test_plans/'.$coaching_id.'/'.$course_id); ?>/'+category_id;
			$(location).attr('href', url);
		});

		$('#amount').on ('change', function () {
			var amount = $(this).val ();
			var url = '<?php echo site_url ('coaching/indiatests/test_plans/'.$coaching_id.'/'.$course_id.'/'.$category_id); ?>/'+amount;
			$(location).attr('href', url);
		});
	});

</script>