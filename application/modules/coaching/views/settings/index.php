<div class="row justify-content-center mb-4">
	<div class="col-md-6 ">
		<div class="card shadow-sm bg-green-200">
			<div class="card-body">
				<h4 class="text-primary">ACESSS CODE</h4>
				<?php echo $coaching['reg_no']; ?>
			</div>
		</div>
	</div>

	<div class="col-md-6 mt-2 mt-md-0">
		<div class="card shadow-sm bg-green-200">
			<div class="card-body">
				<h4 class="text-primary">ACESSS URL</h4>
				<?php echo site_url('/?sub='.$coaching['reg_no']); ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 ">
		<?php echo form_open ('coaching/setting_actions/update_account/'.$coaching_id, array('class'=>'form-horizontal row-border', 'id'=>'validate-1')); ?>
			<div class="card py-3">
				<div class="card-header">
					<h4 class="text-primary">Coaching Details </h4>
				</div>

				<div class="card-body">
					<div class="form-group">
						<label class="control-label">Coaching Name<span class="text-danger">*</span></label>
						<div class="">
							<input type="text" name="coaching_name" class="form-control required" value = "<?php echo set_value('coaching_name', $coaching['coaching_name']) ; ?>">
						</div>
					</div>
					
					<div class="form-group ">					
						<label class="control-label">Address<span class="text-danger">*</span></label>
						<div class="">
							<input type="text" name="address" class="form-control required" value = "<?php echo set_value('address', $coaching['address']) ; ?>">
						</div>
					</div>
					
					<div class="form-group ">					
						<label class="control-label">City<span class="text-danger">*</span></label>
						<div class="">
							<input type="text" name="city" class="form-control required" value = "<?php echo set_value('city', $coaching['city']) ; ?>">
						</div>
					</div> 

					<div class="form-group ">					
						<label class="control-label">State<span class="text-danger">*</span></label>
						<div class="">
							<input type="text" name="state" class="form-control required" value = "<?php echo set_value('state', $coaching['state']) ; ?>">
						</div>
					</div> 

					<div class="form-group ">
						<label class="control-label">PIN Code<span class="text-danger">*</span></label>
						<div class="">
							<input type="text" name="pin" class="form-control required" value = "<?php echo set_value('pin', $coaching['pin']) ; ?>">
						</div>
					</div>

					<div class="form-group ">
						<label class="control-label">Website</label>
						<div class="">
							<input type="text" name="website" class="form-control " value = "<?php echo set_value('website', $coaching['website']) ; ?>">
						</div>
					</div>
				</div>
				
				<div class="card-footer border-top-0 pt-0 bg-transparent">
					<input type="submit" name="submit" value="Save" class="btn btn-primary">
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-6 mt-3 mt-md-0">
        <div class="card card-primary py-3">
			<div class="card-header">
				<h4 class="text-primary"><i class="fa fa-picture-o"></i> Logo </h4>
			</div>

			<?php echo form_open_multipart('coaching/setting_actions/upload_logo/'.$coaching_id, array('class'=>'', 'id'=>'upload_image')); ?>					
	            <div class="card-body py-0">
				
					<div class="form-group">
						<?php if ($is_logo) { ?>
							<img src="<?php echo $logo . '?'.$rand_str; ?>" alt="Logo" class="" width="80px" height="80" />
						<?php } ?>
					</div>

					<div class="form-group">
						<?php if ($is_logo) { ?>
							<?php echo form_label('Change Logo', '', array('class'=>'control-label')); ?>
						<?php } else { ?>
							<?php echo form_label('Upload Logo', '', array('class'=>'control-label')); ?>
						<?php } ?>
						<div class="">
							<input type="file" name="userfile" size="20" />	<br />
							<p class="text-muted">Desired image size 240x80 px</p>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="upload" value="<?php echo ('Upload'); ?>" class="btn btn-info " />
					</div>
				</div>

			</form>	
		</div>

		<div class="card card-primary py-3 my-2">
			<div class="card-header">
				<h4 class="text-primary">User Account Settings </h4>
			</div>

            <div class="card-body py-0">
				<?php echo form_open ('coaching/setting_actions/user_account/'.$coaching_id, array('class'=>'validate-form', 'id'=>'')); ?>				

					<div class="form-group pl-4 my-0 ml-1">
						<?php echo form_label('', '', array('class'=>'control-label')); ?>
						<div class="custom-control custom-switch">
						  <input type="checkbox" name="approve_student" class="custom-control-input" id="approve_students" value="1" <?php if ($settings['approve_student'] == 1 ) echo 'checked';?> >
						  <label class="custom-control-label" for="approve_students">Auto Approve New Students </label>
						</div>
					</div>
					<div class="form-group pl-4 my-0 ml-1">
						<?php echo form_label('', '', array('class'=>'control-label')); ?>
						<div class="custom-control custom-switch">
						  <input type="checkbox" name="approve_teacher" class="custom-control-input" id="approve_teachers" value="1" <?php if ($settings['approve_teacher'] == 1 ) echo 'checked';?> >
						  <label class="custom-control-label" for="approve_teachers">Auto Approve New Teachers </label>
						</div>
					</div>
					<div class="form-group mt-4">
						<input type="submit" name="save" value="Save" class="btn btn-primary " />
					</div>

				</form>	
			</div>
		</div>

	</div>

</div><!-- // row -->

