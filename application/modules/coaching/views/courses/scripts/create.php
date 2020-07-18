<script>
$(document).ready(function() {
	$('#feat_img').on('change',(e) => {
        var thisElement = $(e.target);
        var files = thisElement.prop('files');
        var file = files[0];
        var fileName = file.name;
        thisElement.next('label').text(fileName);
    });
});
</script>