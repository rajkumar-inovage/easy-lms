<?php
if ($test_type == TEST_TYPE_REGULAR) {
}else {
if (! empty ($tests)) {
?>
<script>
(function($){
	var win = $(window);
	var test_count = <?php echo count($tests);?>;
	var page_no = 2;
	var test_instructions_url = '<?php echo site_url('student/tests/test_instructions')?>';
	var member_id = <?php echo $member_id; ?>;
	$('#change-cat').change(function(event) {
		window.location.href = `<?php echo site_url ('student/tests/index/'.$coaching_id.'/'.$member_id.'/'.$test_type.'/'); ?>${$(this).val()}`;
	});
    win.scroll(function () {
    	if((win.height() + win.scrollTop() == $(document).height())&&($('.loader').hasClass('invisible'))){
    		if(!(test_count < 10)){
    			$('.loader').removeClass('invisible');
    			$('.loader>.spinner-border').removeClass('d-none');
	    		$.ajax ({ 
					type: 'GET',
					url: `<?php echo site_url ('student/tests_actions/get_all_tests_next/'.$coaching_id.'/'.$category_id.'/'.$test_type.'/'); ?>${page_no}`,
					beforeSend: function(){
					},
					complete: function(){
					},
					success: function(response) {
						if(response.status){
							console.log(response.data);
							page_no = response.next_page;
							$('.loader').addClass('invisible');
							$('.loader>.spinner-border').addClass('d-none');
							response.data.forEach(function(test){
								var list_group_item = $('<li/>', {'class': 'list-group-item'}).appendTo($('#tests-list'));
								var media = $('<div/>', {'class': 'media'}).appendTo(list_group_item);
								var mediaLeft = $('<div/>', {'class': 'media-left my-auto'}).appendTo(media);
								var iconBlock = $('<div/>', {'class': 'icon-block s30 bg-red-400 text-white', 'title': 'Report'}).appendTo(mediaLeft);
								var icon = $('<i/>', {'class': 'fa fa-file'}).appendTo(iconBlock);
								var mediaBody = $('<div/>', {'class': 'media-body my-auto'}).appendTo(media);
								var testLink = $('<a/>', {'href':`${test_instructions_url}/${test.coaching_id}/${member_id}/${test.test_id}`,'class': 'link-text-color stretched-link','text':test.title}).appendTo(mediaBody);
							});
						}else{
							$('.loader').remove();
						}
					}
				});
    		}
    	}
    });
})(jQuery);
</script>
<?php }
} ?>