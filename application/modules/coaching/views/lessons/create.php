<div class="row">
	<div class="col-md-12">
		<?php echo form_open('', array('class' => 'card', 'id' => 'validate-1')); ?>
			<div class="card-header">
				<h4 class="card-title text-center mb-0"><?php echo $sub_title; ?></h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" placeholder="Title of the Lesson" required>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" rows="4" placeholder="How you describe this Lesson?"></textarea>
				</div>
				<div class="form-group">
					<label for="price">Status</label>
					<div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="status">
						<label class="custom-control-label" for="status">Change Status</label>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<input type="submit" name="submit" class="btn btn-primary" value="<?php echo $submit_label; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $submit_title; ?>">
			</div>
		<?php echo form_close(); ?>
	</div>
</div>