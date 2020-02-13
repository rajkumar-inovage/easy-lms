<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<?php echo form_open_multipart ('coaching/user_actions/import_from_csv/'.$coaching_id.'/'.$role_id, array ('class'=>'form-horizontal', 'id'=>'upload-user') ); ?>
				<div class="card-header bg-white">
					<h4 class="card-title">Import Users</h4> 
				</div>
                <div class="card-body">
					<div class="row">
						<label class="col-md-3">Browse CSV File</label>
						<div class="col-md-9">
							<input type="file" name="userfile" size="20" class="form-control" />
							<p class="help-text">.csv files only</p>
						</div>
					</div> 
					<p><small class="text-danger">Please upload students list in prescribed csv format. Note that Email, First Name and Last Name should not be left blank.</small></p>
					<a href="<?php echo site_url ('users/admin/download_file/users_sample')?>" class="btn btn-link">Download sample file</a>
				</div>
				<div class="card-footer">
					<input type="submit" id="" class="btn btn-primary" value="Import ">
				</div>
			<?php echo form_close (); ?>
		</div>
	</div>
</div>