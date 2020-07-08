<div class="card">
	<?php echo form_open('', array('class' => 'card', 'id' => 'validate-1')); ?>
	<div class="card-body">
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" name="title" placeholder="Title of the page" required>
		</div>

		<div class="form-group">
			<label for="content">Content</label>
			<textarea class="form-control tinyeditor" name="description" rows="4" placeholder="Add your content..."></textarea>
		</div>
	</div>

	<div class="card-body">
		<h4>Attachments</h4>
		<hr>

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_attachment">
		  Add Attachment
		</button>

		<div class="form-group">
			<label for="price">Status</label>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="status">
				<label class="custom-control-label" for="status">Change Status</label>
			</div>
		</div>
	</div>

	<div class="card-footer">
		<input type="submit" name="submit" class="btn btn-primary" value="Save" data-toggle="tooltip" data-placement="right" title="Save">
	</div>
	<?php echo form_close (); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="add_attachment" tabindex="-1" role="dialog" aria-labelledby="add_attachment_label" aria-hidden="true">
	<?php echo form_open('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id, array('class'=>'validate-form')); ?>
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="add_attachment_label">Add Attachment</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	
			<div class="form-group">
				<label for="youtube">Attachment Title</label>
				<input type="text" class="form-control" name="att_title" placeholder="Resource Title">
			</div>

			<div class="form-group">
				<label for="youtube">Youtube Video URL</label>
				<input type="text" class="form-control" name="youtube_url" placeholder="Youtube URL">
			</div>

			<div class="form-group">
				<label for="external">External Resource Link</label>
				<input type="text" class="form-control" name="content" placeholder="Title of the Page">
			</div>

	      </div>

	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	<?php echo form_close (); ?>
</div>
<!-- Modal -->