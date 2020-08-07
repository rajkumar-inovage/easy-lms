<script> 
$(document).ready (() => {
	$(window).bind('keydown', function(event) {
	    if (event.ctrlKey && !event.shiftKey || event.metaKey) {
	        switch (String.fromCharCode(event.which).toLowerCase()) {
	        case 's':
	            event.preventDefault();
	            $('#save').trigger('click');
	            break;
	        }
	    }
	    if (event.ctrlKey && event.shiftKey || event.metaKey) {
	        switch (String.fromCharCode(event.which).toLowerCase()) {
	        case 's':
	            event.preventDefault();
	            $('#save_new').trigger('click');
	            break;
	        }
	    }
	});
});
</script>