<script type="text/javascript" src="<?php echo base_url (THEME_PATH. 'assets/js/jquery-sortable.js'); ?>"></script>
<script type="text/javascript">	
	$(function  () {
	  //$("ul.content").sortable();
	});
	var group = $("ul.serialization").sortable({
	  group: 'serialization',
	  delay: 500,
	  onDrop: function ($item, container, _super) {
	    var data = group.sortable("serialize").get();

	    var jsonString = JSON.stringify(data, null, ' ');

	    $('#serialize_output2').text(jsonString);
	    _super($item, container);
	  }
	});
</script>

