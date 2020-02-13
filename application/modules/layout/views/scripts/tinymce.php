<script src="<?php echo base_url (THEME_PATH.'assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
<script>
$(document).ready (function () {
	tinymce.init({
		selector: "textarea.tinyeditor",
		menubar: false,
		inline: true,
		plugins: [
			'advlist autolink lists link image charmap print preview anchor textcolor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table paste code wordcount'
		],
		toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright 	alignjustify | bullist numlist outdent indent | removeformat | help',		
	});
});
</script>