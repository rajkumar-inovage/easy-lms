<script type="text/javascript" src="<?php echo base_url (THEME_PATH. 'assets/js/jquery-sortable.js'); ?>"></script>
<script type="text/javascript">	
	var group = $("ul.sortable").sortable({
	  group: 'serialization',
	  delay: 500,
	  onDrop: function ($item, container, _super) {
	    var data = group.sortable("serialize").get(0);
	    var jsonString = JSON.stringify(data);
	    $('#serialize_output').val (jsonString);
	    _super($item, container); 

	    fetch ('<?php echo base_url ('coaching/lesson_actions/organize/'.$coaching_id.'/'.$course_id); ?>', {
	    	method: 'POST',
	    	body: jsonString,
		    headers: { "Content-type": "application/json; charset=UTF-8" } 
	    }).then (function (response) {
			return response.json ();
		}).then (function (result) {
			if (result.status == true) {
				alert(JSON.stringify(result.message));
			} else {
				alert ('NOT OK')
			}
		});

	  }
	});

</script>

