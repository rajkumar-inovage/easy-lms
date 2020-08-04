<div class="card">
	<?php echo form_open ('coaching/lesson_actions/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id, array('class'=>'validate-form')); ?>
	<div class="card-body">
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" name="title" placeholder="Title of the page" value="<?php echo set_value ('title', $page['title']); ?>" required>
		</div>

		<div class="form-group">
			<label for="content">Content</label>
			<textarea class="form-control tinyeditor" name="description" rows="10" placeholder="Add your content..."><?php echo set_value ('content', $page['content']); ?></textarea>
		</div>
		
		
		<div class="form-group row mb-1">
			<label class="col-12 col-form-label">Publish</label>
            <div class="col-12">
            	<?php
					if ($page_id == 0) {
						$checked = 'checked';
					} else if ($page_id > 0 && $page['status'] == 1) {
						$checked = 'checked';
					} else {
						$checked = '';
					}
				?>
                <div class="custom-switch custom-switch-primary mb-2 custom-switch-small">
                    <input name="status" class="custom-switch-input" id="status" type="checkbox" <?php echo $checked; ?> value="1" >
                    <label class="custom-switch-btn" for="status"></label>
                </div>
            </div>
        </div>

	</div>

	<div class="card-body">
		<?php if ($page_id > 0) { ?>
	        <h5 class="card-title">Attachments</h5>
	        <?php
			if (! empty ($attachments)) {
				foreach ($attachments as $att) {
					?>
					<div class="d-flex flex-row mb-3 border-bottom justify-content-between">
						<span class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
	                    <?php
							if ($att['att_type'] == LESSON_ATT_YOUTUBE) { 
								echo '<i class="text-danger fab fa-youtube "></i>';
							} else if ($att['att_type'] == LESSON_ATT_EXTERNAL) { 
								echo '<i class="fa fa-link "></i>';
							} else {
								echo '<i class="fa fa-file "></i>';
							}
						?>
						</span>
	                    <div class="pl-3 flex-grow-1">
	                        <a href="#">
	                            <p class="font-weight-medium mb-0"><?php echo $att['title']; ?></p>
	                        </a>
	                    </div>
	                    <div class="comment-likes">
	                        <?php
								$msg = 'Delete this attachment?';
								$url = site_url ('coaching/lesson_actions/delete_attachment/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page_id.'/'.$att['att_id'].'/'.$att['att_type']);
							?>
							<a href="javascript: void ()" onclick="show_confirm ('<?php echo $msg; ?>', '<?php echo $url; ?>')"><i class="fa fa-trash"></i></a>
	                    </div>
	                </div>
					<?php
				}
			} else {
				?>
				<div class="d-flex flex-row mb-3 border-bottom justify-content-between">
					<div class="text-danger">None</div>
				</div>
				<?php
			}
			?>

			<!-- Button trigger modal -->
			<?php if ($page_id > 0) { ?>
				<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#add_attachment" data-backdrop="static">
				  Add Attachment
				</button>
			<?php } else { ?>
				<button type="button" class="btn btn-link" data-toggle="" disabled="">Add Attachment</button>
			<?php } ?>
		<?php } ?>
	</div>	


	<div class="card-footer">
		<input type="submit" name="submit" class="btn btn-primary" value="Save" data-toggle="tooltip" data-placement="bottom" title="Save">
		<?php echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id, 'Add New Page', ['class'=>'btn btn-outline-secondary ml-2']); ?>
	</div>
	<?php echo form_close (); ?>
</div>

<!-- Modal -->
<div class="modal fade " id="add_attachment" tabindex="-1" role="dialog" aria-labelledby="add_attachment_label" aria-hidden="true">
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
			<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
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