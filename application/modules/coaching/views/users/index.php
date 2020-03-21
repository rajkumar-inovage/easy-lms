<div class="card mb-2"> 
	<div class="card-body ">
		<strong>Search</strong>
		<?php echo form_open('coaching/user_actions/search_users/'.$coaching_id, array('class'=>"", 'id'=>'search-form')); ?>
			<div class="form-group row mb-2">
				<div class="col-md-3 mb-2">
					<select name="search_status" class="form-control" id="search-status" >
						<option value="-1">All Status</option>
						<option value="<?php echo USER_STATUS_DISABLED; ?>" <?php if ($status==USER_STATUS_DISABLED) echo 'selected="selected"'; ?> >Disabled</option>
						<option value="<?php echo USER_STATUS_ENABLED; ?>" <?php if ($status==USER_STATUS_ENABLED) echo 'selected="selected"'; ?> >Enabled</option>
						<option value="<?php echo USER_STATUS_UNCONFIRMED; ?>" <?php if ($status==USER_STATUS_UNCONFIRMED) echo 'selected="selected"'; ?> >Pending</option>
					</select>
				</div>

				<div class="col-md-3 mb-2">
					<select name="search_role" class="form-control" id="search-role">
						<option value="0">All Roles</option>
						<?php foreach ($roles as $role) { ?>
							<option value="<?php echo $role['role_id']; ?>" <?php if ($role_id ==$role['role_id']) echo 'selected="selected"'; ?> ><?php echo $role['description']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-md-3 mb-2">
					<select name="search_batch" class="form-control" id="search-batch">
						<option value="0">All Batches</option>
						<?php 
						if (! empty($batches)) {
						  foreach ($batches as $batch) { ?>
							<option value="<?php echo $batch['batch_id']; ?>" <?php if ($batch_id == $batch['batch_id']) echo 'selected="selected"'; ?>><?php echo $batch['batch_name']; ?></option>
						  <?php 
						  }      
						}  
						?>
					</select>
				</div>

				<div class="col-md-3">
					<div class="input-group ">
						<input name="search_text" class="form-control " type="search" placeholder="Search" aria-label="Search Test" aria-describedby="search-button">
						<div class="input-group-append">
							<button class="btn btn-sm btn-primary " type="submit" id="search-button"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>



<?php 
echo form_open('coaching/user_actions/confirm/'.$coaching_id.'/'.$role_id.'/'.$status, array('class'=>'form-horizontal row-border', 'id'=>'confirm') );
	?>
	<div class="card card-default">
		<div class="-table-responsive" id="users-list">
			<table class="table table-bordered v-middle mb-0" id="data-tables">
				<thead>
					<tr>
						<th width="3%">
							<input id="checkAll" type="checkbox" >
						</th>
						<th width="25%"><?php echo 'Name'; ?></th>
						<th width=""><?php echo 'Email'; ?></th>
						<th width=""><?php echo 'Role'; ?></th>
						<th width=""><?php echo 'Status'; ?></th>
						<th width=""><?php echo 'Actions'; ?></th>
					</tr>
				</thead>

				<tbody>
				<?php
				$i = 0 ;
				if ( ! empty ($results)) {
					foreach ($results as $row) {
						?>
						<tr>
							<td>
								<input id="" type="checkbox" name="mycheck[]" value="<?php echo $row['member_id']; ?>" class="checks">
							</td>

							<td>
								<a class="" href="<?php echo site_url ('student/home/dashboard/'.$coaching_id.'/'.$row['member_id']); ?>"> 
									<?php echo ($row['first_name']) .' '. ($row['second_name']) .' '. ($row['last_name']); ?>

								</a> <br> 
								<?php echo $row['adm_no']; ?>
							</td>
							<td><?php echo $row['email']; ?></td>
							<td>
								<?php 
								$config = $this->users_model->user_role_name ( $row['role_id']);
								echo $config['description']; 
								?>
							</td>
							<td>
								<?php 
								$config = $this->common_model->sys_parameter_name ( SYS_USER_STATUS, $row['status']);
								echo '<span class="font-weight-bold">'.$config['paramval'].'</span>'; 
								?>
							</td>
							<td> 
								<div class="dropdown">
									<a class="btn btn-outline dropdown-toggle" type="button" id="userMenu<?php echo $row['member_id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Edit</a>
									<div class="dropdown-menu " aria-labelledby="userMenu<?php echo $row['member_id'];?>">
										<?php echo anchor('coaching/users/edit/'.$coaching_id.'/'.$row['role_id'].'/'.$row['member_id'], '<i class="fa fa-edit"></i> Edit Account', array('title'=>'Edit', 'class'=>'dropdown-item')); ?>
										
										<?php if ( $row['status'] == USER_STATUS_ENABLED ) { ?>
											<a href="javascript:void(0)" onclick="javascript:show_confirm ( '<?php echo 'Do you want to disable this user?'; ?>', '<?php echo site_url('coaching/user_actions/disable_member/'.$coaching_id.'/'.$role_id.'/'.$row['member_id']); ?>' )" title="Disable" class="dropdown-item" ><i class="fa fa-times-circle"></i> Disable Account</a>
										<?php } else if ( $row['status'] == USER_STATUS_DISABLED ) { ?>
											<a href="javascript:void(0)" onclick="javascript:show_confirm ( '<?php echo 'Do you want to enable this user?'; ?>', '<?php echo site_url('coaching/user_actions/enable_member/'.$coaching_id.'/'.$role_id.'/'.$row['member_id']); ?>' )" class="dropdown-item"><i class="fa fa-check-circle"></i> Enable Account</a>
										<?php } ?>
										<?php //echo anchor('coaching/users/member_log/'.$coaching_id.'/'.$role_id.'/'.$row['member_id'], '<i class="fa fa-info-circle"></i> Member Log', array ('class'=>'dropdown-item') ); ?>
										
										<?php if ($row['status'] == USER_STATUS_UNCONFIRMED) { ?>
											<a href="javascript:show_confirm_ajax ('Send email verication link?', '<?php echo site_url ('coaching/user_actions/send_confirmation_email/'.$row['member_id']);?>')" class="dropdown-item"><i class="fa fa-link"></i> Resend Confirmation Email</a>
										<?php } else { ?>
											<?php echo anchor('coaching/users/change_password/'.$coaching_id.'/'.$role_id.'/'.$row['member_id'], '<i class="fa fa-key"></i> Change Password', array ('class'=>'dropdown-item')); ?>
										<?php } ?>									
										<a href="javascript:void(0)" onclick="show_confirm ('<?php echo 'Are you sure want to delete this users?' ; ?>','<?php echo site_url('coaching/user_actions/delete_account/'.$coaching_id.'/'.$role_id.'/'.$row['member_id']); ?>' )" class="dropdown-item"><i class="fa fa-trash"></i> Delete Account</a>
									</div>
								</div>
							</td>
						</tr>
						<?php 
					} // foreach 
				} else {
					?>
					<tr>
						<td colspan="6">No users found</td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table> 
		</div>
	</div>
</form>