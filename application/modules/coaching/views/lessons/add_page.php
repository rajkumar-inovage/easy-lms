<div class="card">
	<?php echo form_open ('coaching/lesson_actions/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id, array('class'=>'validate-form')); ?>
	<div class="card-body">
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" name="title" placeholder="Title of the page" value="<?php echo set_value ('title', $page['title']); ?>" required>
		</div>

		<div class="form-group">
			<label for="content">Content</label>
			<textarea class="form-control tinyeditor" name="description" rows="4" placeholder="Add your content..."><?php echo set_value ('content', $page['content']); ?></textarea>
		</div>

		<div class="form-group">
			<label for="price">Status</label>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" name="status" id="status" value="1" <?php if ($page['status'] == 1) echo 'checked'; ?> >
				<label class="custom-control-label" for="status">Publish</label>
			</div>
		</div>

	</div>

	<div class="card-body">
		<h4>Attachments</h4>
		<ul class="list-group">
			<?php
			if (! empty ($attachments)) {
				foreach ($attachments as $att) {
					?>
					<li class="list-group-item media">
						<div class="media-body">
							<?php echo $att['title']; ?><br>
							<a href="<?php echo $att['att_url']; ?>"><?php echo $att['att_url']; ?></a>
						</div>
						<div class="media-right">
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<hr>

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-link" data-toggle="modal" data-target="#add_attachment">
		  Add Attachment
		</button>

	</div>

	<div class="card-footer">
		<input type="submit" name="submit" class="btn btn-success" value="Save" data-toggle="tooltip" data-placement="right" title="Save">
	</div>
	<?php echo form_close (); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="add_attachment" tabindex="-1" role="dialog" aria-labelledby="add_attachment_label" aria-hidden="true">
	<?php echo form_open_multipart ('coaching/lesson_actions/add_attachment/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id, array('class'=>'validate-form')); ?>
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
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="att_type" id="att-type-youtube" value="<?php echo LESSON_ATT_YOUTUBE; ?>" checked>
				  <label class="form-check-label" for="att-type-youtube">Youtube URL</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="att_type" id="att-type-external" value="<?php echo LESSON_ATT_EXTERNAL; ?>">
				  <label class="form-check-label" for="att-type-external">External Resource URL</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="att_type" id="att-type-upload" value="<?php echo LESSON_ATT_UPLOAD; ?>" >
				  <label class="form-check-label" for="att-type-upload">Upload File</label>
				</div>
			</div>

			<div class="form-group attachments" id="att-youtube">
				<input type="text" class="form-control" name="att_url_youtube" placeholder="https://youtube.com/video_url">
			</div>

			<div class="form-group attachments" id="att-external">
				<input type="text" class="form-control" name="att_url_external" placeholder="External resource link">
			</div>

			<div class="form-group attachments" id="att-upload">
				<input type="file" class="form-control" name="userfile" placeholder="Select file to upload">
			</div>

	      </div>

	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success">Save</button>
	      </div>
	    </div>
	  </div>
	<?php echo form_close (); ?>
</div>
<!-- Modal -->