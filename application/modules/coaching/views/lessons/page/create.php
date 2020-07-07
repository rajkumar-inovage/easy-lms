<div class="row">
	<div class="col-md-12">
		<?php echo form_open('', array('class' => 'card', 'id' => 'validate-1')); ?>
			<div class="card-header">
				<h4 class="card-title text-center mb-0"><?php echo $sub_title; ?></h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" placeholder="Title of the Page" required>
				</div>
				<div class="form-group">
					<label>Content Type</label>
					<div class="d-block mb-3">
						<div class="btn-group btn-group-toggle" data-toggle="buttons" role="tablist">
							<label class="btn btn-primary content_type active" data-target="#tab-html">
								<input type="radio" name="content_type" id="html" value="html" data-target="#tab-html" checked> Plain Text/HTML
							</label>
							<label class="btn btn-primary content_type" data-target="#tab-media">
								<input type="radio" name="content_type" id="media" data-target="#tab-media" value="media"> Media
							</label>
						</div>
					</div>
					<div class="tab-content p-0" id="content_type">
						<div class="tab-pane fade show active" id="tab-html" role="tabpanel" aria-labelledby="tab-html">
							<div class="form-group">
								<label for="content">Content</label>
								<textarea class="form-control" id="content" rows="4" placeholder="Add your page content here..."></textarea>
							</div>
						</div>
						<div class="tab-pane fade" id="tab-media" role="tabpanel" aria-labelledby="tab-media">
							<div class="form-group">
								<label for="mdeia_type">Media Type</label>
								<select class="custom-select" id="mdeia_type">
									<option value="pdf">PDF</option>
									<option value="images">Images</option>
									<option value="youtube">Youtube Video</option>
									<option value="external_video">External Video</option>
								</select>
							</div>
							<div class="form-group">
								<label>Content</label>
								<div class="tab-content p-0" id="mdeia_type_tab">
									<div class="tab-pane fade show active" id="tab-pdf" role="tabpanel" aria-labelledby="tab-pdf">
										<label for="youtube">PDF file</label>
										<div class="custom-file mb-3">
											<input type="file" class="custom-file-input" name="content" id="content-file">
											<label class="custom-file-label" for="content-file">Select PDF file to upload...</label>
										</div>
									</div>
									<div class="tab-pane fade" id="tab-images" role="tabpanel" aria-labelledby="tab-images">
										<label for="youtube">Images</label>
										<div class="custom-file mb-3">
											<input type="file" class="custom-file-input" name="content" id="content-file">
											<label class="custom-file-label" for="content-file">Select Images to upload...</label>
										</div>
									</div>
									<div class="tab-pane fade" id="tab-youtube" role="tabpanel" aria-labelledby="tab-youtube">
										<div class="form-group">
											<label for="youtube">Youtube Video URL</label>
											<input type="text" class="form-control" id="youtube" name="content" placeholder="Title of the Page">
										</div>
									</div>
									<div class="tab-pane fade" id="tab-external_video" role="tabpanel" aria-labelledby="tab-external_video">
										<div class="form-group">
											<label for="external">External Video URL</label>
											<input type="text" class="form-control" id="external" name="content" placeholder="Title of the Page">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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