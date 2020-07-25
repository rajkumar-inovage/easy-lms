<script>
$(document).ready(() => {
    $(".edit-category").hide();
    $('#edit-categories').click(() => {
        $(".edit-category").toggle("slide").toggleClass('px-2').prev().toggleClass('border-right');
    });
    $('.edit-cat').click((event) => {
    	$('#editCategories').find('form').attr('action', `<?php echo site_url('coaching/courses_actions/category_action/' . $coaching_id . '/'); ?>${$(event.currentTarget).data('id')}/`);
    	$('#editCategories').find('#title').val($(event.currentTarget).data('value'));
    	$('#editCategories').find('#delete-cat').data('id', $(event.currentTarget).data('id'));
    });
    $('#editCategories').find('#delete-cat').click((event) => {
    	show_confirm('This will delete this category, Are you sure?', `<?php echo site_url('coaching/courses_actions/delete_category/' . $coaching_id . '/'); ?>${$(event.currentTarget).data('id')}/`);
    });
    $('.toggle-status').change((event) => {
        $(event.currentTarget).prop('disabled', true);
        window.location.href = $(event.currentTarget).data('href');
    });
});
</script>