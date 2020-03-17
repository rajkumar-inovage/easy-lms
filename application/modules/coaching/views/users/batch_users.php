<div class="card mb-2"> 
	<div class="card-body ">
		<strong>Search</strong>
		<?php echo form_open('coaching/user_actions/search_batch_users/'.$coaching_id, array('class'=>"", 'id'=>'search-form')); ?>
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
<div class="row" >
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="users" role="tablist">
		  <li class="nav-item">
			<a class="nav-link <?php if ($add_users == 0) echo 'active'; ?>" href="<?php echo site_url ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id )?>" >Users In Batch <span class="badge badge-primary"><?php echo $num_users_in; ?></span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link <?php if ($add_users == TRUE) echo 'active'; ?>" href="<?php echo site_url ('coaching/users/batch_users/'.$coaching_id.'/'.$batch_id.'/1' )?>" >Users Not In Batch <span class="badge badge-primary"><?php echo $num_users_notin; ?></span></a>
		  </li>
		</ul>
	</div>
</div>

<div class="row" >
	<div class="col-md-12 ">
		<div class="card">
			<?php 
			if ($add_users > 0) {
				echo form_open ('coaching/user_actions/save_batch_users/'.$coaching_id.'/'.$batch_id, array ('id'=>'validate-1'));
			} else {
				echo form_open ('coaching/user_actions/remove_batch_users/'.$coaching_id.'/'.$batch_id, array ('id'=>'validate'));
			}
			?>				
				<table class="table table-hover ">
					<thead>
						<th width="5%">#
							<?php //if ($add_users > 0) { ?>
								<input type="checkbox" name="" value="" class="check" id="check-all">
							<?php //} ?>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>Status</th>
						<th>Actions</th>
					</thead>
					<tbody> 
					<?php
					$i = 1;
					if (! empty($result)) {
						foreach ($result as $item) {
							?>
							<tr class="check">
								<td>
									<?php echo $i; ?>
									<?php //if ($add_users > 0) { ?>
										<input type="checkbox" name="users[]" value="<?php echo $item['member_id']; ?>" class="check">
									<?php //} ?>
								</td>
								<td>
									<?php echo $item["first_name"].' '.$item["last_name"];?><br>
									<?php echo $item["adm_no"]; ?>
								</td>
								<td><?php echo $item['email']; ?></td>
								<td>
									<?php 
										$config = $this->users_model->user_role_name($item['role_id']);
										echo $config['description']; 
									?>
								</td>
								<td>
									<?php 
									$config = $this->common_model->sys_parameter_name ( SYS_USER_STATUS, $item['status']);
									echo '<span class="font-weight-bold">'.$config['paramval'].'</span>'; 
									?>
								</td>
								<td>
									<?php //if ($add_users == 0) { ?>
										<!-- DELETE LOG  -->
										<a href="javascript:void(0);" onclick="show_confirm ('Remove this user from batch <?php echo $batch_title; ?>?', '<?php echo site_url("coaching/user_actions/remove_batch_user/".$coaching_id.'/'.$batch_id.'/'.$item['member_id'].'/'.$add_users); ?>')" class="btn btn-link" data-title="Remove User"><i class="fa fa-trash"></i></a>
									<?php //} ?>
								</td>
							</tr>
							<?php 
							$i++;
						}
						?>
						<tr>
							<td colspan="3">
								<?php if ($add_users > 0) { ?>
									<input type="submit" value="Add Users" class="btn btn-primary"> 
								<?php } else { ?>
									<input type="submit" value="Remove" class="btn btn-danger"> 
								<?php } ?>
							</td>
						</tr>
						<?php
					} else { 
						echo '<tr><td colspan="6">No users in this batch</td></tr>';
					}
					?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>