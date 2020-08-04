<script type="text/javascript" src="<?php echo base_url (THEME_PATH. 'assets/js/vendor/jquery-sortable.js'); ?>"></script>

<script type="text/javascript">	
	var group = $("ul.sortable").sortable({
	  group: 'serialization',
	  delay: 500,
	  onDrop: function ($item, container, _super) {
	    var data = group.sortable("serialize").get(0);
	    var jsonString = JSON.stringify(data);

	    _super($item, container); 

	    fetch ('<?php echo base_url ('coaching/lesson_actions/organize/'.$coaching_id.'/'.$course_id.'/'.$batch_id); ?>', {
	    	method: 'POST',
	    	body: jsonString,
	    });

	  }
	});

	$('.switch_demo').on ('change', function () {
		
		if ($(this).is(':checked')) {
			var data = 1;
		} else {
			var data = 0;			
		}

		var id = $(this).attr ('data-id');
		
		fetch ('<?php echo site_url ('coaching/courses_actions/mark_for_demo'); ?>/'+id+'/'+data, {
			method: 'POST',
		}).then (function (response){
			return response.json ();
		}).then (function (result) {

		});
	});
</script>