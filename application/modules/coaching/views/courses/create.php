<div class="row">
	<div class="col-md-12">
		<?php echo form_open ('', array('class' => 'card', 'id' => 'validate-1')); ?>
			<div class="card-header">
				<h4 class="card-title text-center mb-0"><?php echo $sub_title; ?></h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" placeholder="Title of the Course" required>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" rows="4" placeholder="Course overview"></textarea>
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<div class="input-group mb-2">
						<input type="number" class="form-control" id="price" min="0" step="1" placeholder="Course Price" required>
						<div class="input-group-append">
							<div class="input-group-text">.00</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Feauted Image</label>
					<div class="custom-file mb-3">
						<input type="file" class="custom-file-input" id="feat-image" required>
						<label class="custom-file-label" for="feat-image">Select file to upload...</label>
						<div class="invalid-feedback"></div>
					</div>
				</div>

			</div>
			<div class="card-footer">
				<input type="submit" name="submit" class="btn btn-primary" value="<?php echo $submit_label; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $submit_title; ?>">
			</div>
		<?php echo form_close(); ?>
	</div>
</div>