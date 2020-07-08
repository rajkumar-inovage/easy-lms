<script>
(function( $ ){
	$(document).ready (function () {
		$('.content_type').click((event) => {
			$('#content_type > .tab-pane.show.active').removeClass('show active');
			$($(event.target).data('target')).tab('show');
		});
		$('#mdeia_type').change((event) => {
			$('#mdeia_type_tab > .tab-pane.show.active').removeClass('show active');
			$(`#tab-${$(event.target).val()}`).tab('show');
		});
	});
})( jQuery );
</script>