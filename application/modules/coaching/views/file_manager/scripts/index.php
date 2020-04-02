<script type="text/javascript">
$(function() {
	$('.file').on( "contextmenu", function(event){
		event.preventDefault();
		$(this).find('.options').trigger('click');
	});
	$('.delete-file').click(function(event) {
		var file = $(this).parents('.file');
		var file_id = file.data('file_id');
		var file_path = file.data('path');
		var filename = file.data('filename');
		var file_path = `${file_path+filename}`;
		var confirm = window.confirm("This will permanentaly delete your file. Are you sure?");
		if(confirm){
			console.log(file_id, file_path);
			$.ajax ({ 
				type: 'POST',
				data: {
					'file_id': file_id,
					'file_path': file_path
				},
				url: `<?php echo site_url('coaching/file_actions/delete_file/'); ?>`,
				beforeSend: function(){
				},
				complete: function(){
				},
				success: function(response) {
					console.log(response);
					if(response.status){
						file.remove();
						toastr.success(response.message);
					}
				}
			});
		}
	});
	$('.rename-file').click(function(event) {
		var file_id = $(this).parents('.file').data('file_id');
		var file_path = $(this).parents('.file').data('path');
		var old_file = $(this).parents('.file').data('filename');
		var old_file_name = old_file.split(".")[0];
		var file_ext = old_file.split(".").pop();
		var new_file_name = window.prompt(`Please enter new file name for ${old_file}`, old_file_name);
		if (new_file_name !== null) {
			var old_file_path = `${file_path+old_file}`;
			var new_file_path = `${file_path+new_file_name}.${file_ext}`;
			var new_fileName = `${new_file_name}.${file_ext}`;
		    $.ajax ({ 
				type: 'POST',
				data: {
					'file_id': file_id,
					'old_path': old_file_path,
					'new_path': new_file_path,
					'new_file_name': new_fileName
				},
				url: `<?php echo site_url('coaching/file_actions/rename_file/'); ?>`,
				beforeSend: function(){
				},
				complete: function(){
				},
				success: function(response) {
					console.log(response);
					if(response.status){
						$(`#file_id_${file_id}`).html(new_fileName);
						toastr.success(response.message);
					}
				}
			});
		}
	});
});
</script>