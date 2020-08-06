<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<?php echo form_open_multipart ('coaching/user_actions/import_from_csv/'.$coaching_id.'/'.$role_id, array ('class'=>'form-horizontal', 'id'=>'validate-1') ); ?>
                <div class="card-body">
                	<div class="form-group row">
                		<div class="col-md-3 mb-2">
                			<label class="control-label">Select Role</label>
							<select name="role" class="form-control" id="search-role">
								<?php foreach ($roles as $role) { ?>
									<option value="<?php echo $role['role_id']; ?>" <?php if ($role_id ==$role['role_id']) echo 'selected="selected"'; ?> ><?php echo $role['description']; ?></option>
								<?php } ?>
							</select>
						</div>

                	</div>

					<div class="form-group ">
						<label class="control-label">Browse CSV File</label>
						<input type="file" name="userfile" size="20" class="form-control" />
						<p class="help-text">.csv files only</p>
					</div> 
					<div class="alert alert-info" role="alert">
						<span><i class="fa fa-exclamation"></i></span> Upload students list in given format. Contact No., First Name and Last Name should not be left blank.
					</div>
					<a href="<?php echo site_url ('coaching/users/download_file')?>" class="btn btn-link">Download sample file</a> 

				</div>
				<div class="card-footer">
					<input type="submit" id="" class="btn btn-primary" value="Import ">
				</div>
			<?php echo form_close (); ?>
		</div>
	</div>
</div>