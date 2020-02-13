<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<?php echo form_open ('users/ajax_func/my_account/'.$member_id, array ('class'=>'form-horizontal', 'id'=>'validate-1')); ?>
					
						<div class="card-body ">
						
							<div class="form-group row">
								<div class="col-md-6">
									<label class="form-label"><?php echo 'User Role'; ?>	</label>
									<p class="form-control-static u-role"><?php echo $roles['description']; ?></p>
									<input type="hidden" name="user_role" value="<?php echo $result['role_id']; ?>" >
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-6">
									<?php echo form_label('User Id <span class="text-danger">*</span>', '', array('class'=>'', 'for' =>"adm_no"));?>			
									<?php 
									$option = array('name'=>'adm_no','class'=>'form-control', 'readonly'=>'true','id'=>'adm_no','value'=>set_value('adm_no', $result['adm_no']));
									echo form_input($option);
									?>	
								</div>
								
								<div class="col-md-6">							
									<?php echo form_label('Serial No', '', array('class'=>'', 'for' =>"sr_no")); ?>
									<?php echo form_input(array('name'=>'sr_no', 'class'=>'form-control', 'id'=>'sr_no', 'value'=>set_value('sr_no', $result['sr_no'])));?>
								</div>
							</div>
							
							<div class="form-group row">
							    
								<div class="col-md-4">
									<?php echo form_label('Name <span class="text-danger">*</span>', '', array('class'=>'', 'for' =>"name")); ?>
									<input name='first_name' class="form-control required " placeholder="First name" type="text" value="<?php echo set_value('first_name', $result['first_name']);?>">
								</div>
								<div class="col-md-4">
									<?php echo form_label('&nbsp;', '', array('class'=>'', 'for' =>"name")); ?>
									<input name='second_name' class="form-control" placeholder="Middle name" type="text" value="<?php echo set_value('second_name', $result['second_name']);?>">
								</div>
								<div class="col-md-4">
									<?php echo form_label('&nbsp;', '', array('class'=>'', 'for' =>"name")); ?>
							    <input name='last_name' class="form-control required " placeholder="Last name" type="text" value="<?php echo set_value('last_name', $result['last_name']);?>">
								</div>
							
							</div>					
							
							<div class="form-group row">
								<div class="col-md-6">
									<?php echo form_label('E-mail <span class="text-danger">*</span>', '', array('class'=>'', 'for' =>"email")); ?>
									<?php
									  echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>set_value('email', $result['email']), 'id'=>'email')); 
									?>			
								</div>
								
								<div class="col-md-6">
									<?php echo form_label('Contact No<span class="text-danger"></span>', '', array('class'=>'')); ?>
																	  
									<?php echo form_input(array('name'=>'primary_contact', 'class'=>'form-control digits ', 'value'=>set_value('primary_contact', $result['primary_contact']) ));?>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-6">
									<?php echo form_label('Date Of Birth', '', array('class'=>'')); ?>
									<?php  
									if ($member_id > 0 ) {
										$dob = date('Y-m-d', strtotime($result["dob"]));
									} else {
										$dob = '';
									}
									echo form_input(array('type'=>'date', 'name'=>'dob', 'class'=>'form-control input-width-small', 'value'=>set_value('dob', $dob)));
									?>
								</div>
								<div class="col-md-6">
									<?php echo form_label('Gender', '', array('class'=>'')); ?>
									<p>
									    
									<?php
										$status_none = false;
										$status_male = false;
										$status_female = false;
										if ($result['gender'] == 'm')
											$status_male = true;
										else if ($result['gender'] == 'f')
											$status_female = true;
										else
											$status_none = true;
									?> 
									<label class="form-check-label mr-3"><?php echo form_radio(array('name'=>'gender', 'value'=>'m', 'checked'=>$status_male, 'class'=>'radio-primary form-check-input')); ?><?php echo ('Male'); ?></label>
									<label class="form-check-label mr-3"><?php echo form_radio(array('name'=>'gender', 'value'=>'f', 'checked'=>$status_female, 'class'=>'radio-primary form-check-input')); ?><?php echo ('Female'); ?></label>
									<label class="form-check-label mr-3"><?php echo form_radio(array('name'=>'gender', 'value'=>'n', 'checked'=>$status_none, 'class'=>'radio-primary form-check-input')); ?><?php echo ('Not Specified'); ?></label>
									</p>

								</div>
							</div>
							
									
							
						</div>
						
						<div class="card-footer">
							<div class="btn-toolbar">
								<?php
								echo form_submit ( array ('name'=>'submit', 'value'=>'Save ', 'class'=>'btn btn-success pull-right')); 
								?>
							</div>	
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			
			<div class="col-md-3">
				<?php $this->load->view('ajax/user_menu', $data); ?>
			</div>
		</div>
	</div>
</section>
</div>
<!-- Add Image -->
<div class="modal fade" id="add_image">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open_multipart ('users/ajax_func/upload_profile_picture/'.$member_id, array ('class'=>'form-horizontal row-border', 'id'=>'upload_image')); ?>
				<div class="modal-header">
					<h4 class="modal-title">Profile Image</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group"> 
						<div class="col-md-12">
							<div id="profile_messages"></div>
							<div id="image_preview" class="text-center" >
								<img src="<?php echo $this->session->userdata ('profile_image'); ?>" alt="Profile Image" class="img-thumbnail rounded-circle ">
							</div>
							<br>
							<div class="align-center "><a class="" id="remove_image" href="#" onclick="show_confirm_ajax('Remove this image?', '<?php echo site_url('users/ajax_func/remove_profile_image/'.$member_id); ?>', '<?php echo site_url('users/admin/my_account'); ?>')">Remove Image</a></div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-12">
							<input type="file" name="userfile" class="required" accept="image/*" data-style="fileinput" data-inputsize="medium">
							<p class="help-block">Images only (image/*)</p>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<div class="btn-toolbar">
						<button type="button" class="btn btn-danger mrgn-r-10" data-dismiss="modal">Close</button>
						<input type="submit" name="submit" value="<?php echo ('Upload'); ?>" class="btn btn-primary pull-right" />
					</div>
				</div>
			<?php echo form_close (); ?>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
/*
// EMAIL AVAILABILITY
function check_email_availability () { 
	var email =   $("#email").val();
	var pageURL = '<?php echo site_url ('users/ajax_func/check_email_availability'); ?>/'+email;
	$.ajax ({ 
		beforeSend: function(){
		},
		complete: function(){
		},
		type: 'POST',
		url: pageURL,
		success: function(result) {
			$('#email_response').html (result);
		}
	});
}
/* Upload Profile Image * /
$( function() {
	$('#upload_image').validate({
		
		submitHandler: function (form) {
		
			var pageURL = $(form).attr ('action');
			var formData = new FormData($('#upload_image')[0]); // Create an arbitrary FormData instance
			$.ajax ({
				type: 'POST',
				url: pageURL,
				processData: false,
				contentType: false, 
				data: formData,
				beforeSend: function() {
					toastr.clear()
					toastr.info("Please wait...", "", {
						"timeOut": 0,
						"positionClass": "toast-top-right",
						"preventDuplicates": true,
					});	
				},
				complete: function(){
				},
				success: function(response) { 
					toastr.clear()
					if (response.status === true ) {
						toastr.success(response.message, "Done", {
							"timeOut": 0,
							"positionClass": "toast-top-right",
							"preventDuplicates": true,
						});
						document.location.href = '<?php echo site_url ('users/admin/my_account/'.$member_id); ?>';
					} else {
						toastr.error(response.error, "Error", {
							"timeOut": 0,
							"preventDuplicates": true,
							"closeButton":true,
							"positionClass": "toast-top-right",
						});
					}
				},
			});		
			
		}
	});
});
*/
</script>