<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>

<div class="card" >
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs " role="tablist">
		  <li class="nav-item">
			<a class="nav-link <?php if ($add_users == 0) echo 'active'; ?>" href="<?php echo site_url ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id.'/'.$batch_id )?>" >Users In Batch <span class="badge badge-primary"><?php echo $num_users_in; ?></span></a>
		  </li>
		  <?php if($is_admin): ?>
		  <li class="nav-item">
			<a class="nav-link <?php if ($add_users == USER_ROLE_STUDENT) echo 'active'; ?>" href="<?php echo site_url ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id.'/'.$batch_id.'/'.USER_ROLE_STUDENT )?>" >Add Users <span class="badge badge-primary"><?php echo $num_users_notin; ?></span></a>
		  </li>
		  <?php endif; ?>
		</ul>
	</div>

	<div class="card-body">
		<?php 
		if ($add_users > 0) {
			echo form_open ('coaching/enrolment_actions/add_users_to_batch/'.$coaching_id.'/'.$course_id.'/'.$batch_id, array ('id'=>'validate-1')); 
		} else {
			echo form_open ('coaching/enrolment_actions/remove_batch_users/'.$coaching_id.'/'.$course_id.'/'.$batch_id, array ('id'=>'validate-1'));
		}
		?>
			<table class="table table-hover ">
				<thead>
					<th width="1%">
						#
					</th>
					<?php if($is_admin): ?>
					<th width="1%">
						<input type="checkbox" id="checkAll" class="check" onchange="check_all ()">
					</th>
					<?php endif; ?>
					<th width="60%">Name</th>
					<th width="">Role</th>
					<?php if ($add_users == 0) { ?>
						<th width="">Action</th>
					<?php } ?>
				</thead>
				<tbody> 
				<?php
				$i = 1;
				if (! empty($result)) {
					foreach ($result as $item) {
						?>
						

						<tr class="check">
							<td>
								<?php echo $i; ?>.
							</td>
							<?php if($is_admin): ?>
							<td>
								<input type="checkbox" name="users[]" value="<?php echo $item['member_id']; ?>" class="checks">
							</td>
							<?php endif; ?>
							<td>
								<?php echo $item["first_name"].' '.$item["last_name"];?><br>
								<?php echo $item["adm_no"]; ?>
							</td>
							<td>
								<?php echo $item ["description"]; ?>
							</td>
							<?php if ($add_users == 0) { ?>
								<td>
									<!-- DELETE LOG  -->
									<a href="javascript:void(0);" onclick="show_confirm ('Remove this user ?', '<?php echo site_url("coaching/enrolment_actions/remove_batch_user/".$coaching_id.'/'.$course_id.'/'.$batch_id.'/'.$item['member_id'].'/'.$add_users); ?>')" class="btn btn-link" data-title="Remove User"><i class="fa fa-trash"></i></a>
								</td>
							<?php } ?>
						</tr>
						<?php 
						$i++;
					}
				} else { 
				?>
						<tr>
							<td colspan="4">
								<span  class="text-danger">No users in this batch.</span> <?php echo ($is_admin)? anchor ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id.'/'.$batch_id.'/'.USER_ROLE_STUDENT, 'Add Users'):''; ?>
								<?php if($is_admin): ?><?php else: ?><?php endif; ?>
							</td>
						</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<?php if($is_admin): ?>
			<div class="card-footer">
				<?php if ($add_users > 0) { ?>
					<input type="submit" value="Add Users" class="btn btn-primary"> 
				<?php } else { ?>
					<input type="submit" value="Remove" class="btn btn-danger"> 
				<?php } ?>
			</div>
		<?php endif; ?>
	</form>
</div>