<script>
$(document).ready (function () {
	$('.attachments').hide ();
	$('#att-youtube').show ();

	$('#att-type-youtube').on ('click', function () {
		$('.attachments').hide ();
		$('#att-youtube').show ();
	});

	$('#att-type-external').on ('click', function () {
		$('.attachments').hide ();
		$('#att-external').show ();
	});

	$('#att-type-upload').on ('click', function () {
		$('.attachments').hide ();
		$('#att-upload').show ();
	});
});
</script>