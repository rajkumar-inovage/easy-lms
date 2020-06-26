<script>

$(document).ready (function () {

	$('#category').on ('change', function () {
		var category = $(this).val ();
		var url = '<?php echo site_url ('coaching/virtual_class/index/'.$coaching_id); ?>/'+category;
		$(location).attr('href', url);
	});
});

</script>