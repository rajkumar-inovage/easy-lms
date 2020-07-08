<div class="card">
	<?php echo form_open ('coaching/lesson_actions/create_lesson/'.$coaching_id.'/'.$course_id.'/'.$lesson_id, array('class' => 'card', 'id' => 'validate-')); ?>
		<div class="card-body">
			<div class="form-group">
				<label for="title">Title<span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="title" placeholder="Title of the Lesson" required value="<?php echo set_value ('title', $lesson['title']); ?>">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control tinyeditor" name="description" rows="4" placeholder="How you describe this lesson?" value="<?php echo set_value ('description', $lesson['description']); ?>"></textarea>
			</div>

			<div class="form-group">
				<div class="custom-control custom-switch">
					<input type="checkbox" name="status" class="custom-control-input" id="status" value="1" <?php if ($lesson['status'] == 1 ) echo 'checked';?>  >
				  	<label class="custom-control-label" for="status">Publish </label>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<input type="submit" name="submit" class="btn btn-primary" value="Save" data-toggle="tooltip" data-placement="right" title="Save">
		</div>
	<?php echo form_close(); ?>
</div>