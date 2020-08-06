<div class="row">
	<div class="col-md-9">
		<div class="card">
			<?php echo form_open ('coaching/user_actions/my_account/'.$coaching_id.'/'.$member_id, array ('class'=>'form-horizontal', 'id'=>'validate-1')); ?>
				
				<input type="hidden" name="user_role" value="<?php echo $result['role_id']; ?>" >
			
				<div class="card-body ">
				
					<div class="form-group row">
						<div class="col-md-6">
							<label class="form-label"><?php echo 'Role'; ?>	</label>
							<p class="form-control-static "><?php echo $roles['description']; ?></p>
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
							<?php echo form_input(array('name'=>'sr_no', 'class'=>'form-control', 'id'=>'sr_no', 'value'=>set_value('sr_no', $result['sr_no']), 'readonly'=>true));?>
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
							<?php echo form_label('Contact No<span class="text-danger">*</span>', '', array('class'=>'')); ?>															  
							<?php echo form_input(array('name'=>'primary_contact', 'class'=>'form-control digits ', 'value'=>set_value('primary_contact', $result['primary_contact']) ));?>
						</div>

						<div class="col-md-6">
							<?php echo form_label('E-mail', '', array('class'=>'', 'for' =>"email")); ?>
							<?php
							  echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>set_value('email', $result['email']), 'id'=>'email')); 
							?>
						</div>
						
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<?php echo form_label('Date Of Birth', '', array('class'=>'')); ?>
							<?php  
							if ($result['dob'] != '' ) {
								$dob = date('Y-m-d', strtotime($result["dob"]));
							} else {
								$dob = date('Y-m-d');
							}
							echo form_input(array('type'=>'date', 'name'=>'dob', 'class'=>'form-control input-width-small', 'value'=>set_value('dob', $dob)));
							?>
						</div>

						<div class="col-md-6">
							<?php echo form_label('Gender', '', array('class'=>'mt-2 mt-md-0')); ?>
							
							    
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
							

							<div class="d-block">
								<div class="btn-group-toggle gender-toggle" data-toggle="buttons">
									<label class="btn position-relative btn-light default p-1 mb-1<?php echo ($status_male)?" active":""; ?>"><?php echo form_radio(array('name'=>'gender', 'value'=>'m', 'checked'=>$status_male, 'class'=>'')); ?><i class="iconsminds-male pr-2"></i><?php echo ('Male'); ?></label>
									<label class="btn position-relative btn-light default p-1 mb-1<?php echo ($status_female)?" active":""; ?>"><?php echo form_radio(array('name'=>'gender', 'value'=>'f', 'checked'=>$status_female, 'class'=>'radio-primary form-check-input')); ?><i class="iconsminds-female pr-2"></i><?php echo ('Female'); ?></label>
									<label class="btn position-relative btn-light default p-1 mb-1<?php echo ($status_none)?" active":""; ?>"><?php echo form_radio(array('name'=>'gender', 'value'=>'n', 'checked'=>$status_none, 'class'=>'radio-primary form-check-input')); ?><i class="iconsminds-woman-man pr-2"></i><?php echo ('Not Specified'); ?></label>
								</div>
							</div>


						</div>
					</div>
					
							
					
				</div>
				
				<div class="card-footer">
					<div class="btn-toolbar">
						<?php
						echo form_submit ( array ('name'=>'submit', 'value'=>'Save ', 'class'=>'btn btn-primary pull-right')); 
						?>
					</div>	
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	
	<div class="col-md-3 mb-3 mb-md-0">

		        
				<?php if ($member_id > 0) { ?>
					<div class="card-body ">
						<?php $this->load->view('inc/my_account_menu', $data); ?>
					</div>
				<?php } ?>
	

	</div>
</div>



