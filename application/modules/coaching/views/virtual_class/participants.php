<div class="row justify-content-center">

	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				<h4>Class Details</h4>
			</div>
			<div class="card-body">
				<dl>
					<dt>Class Name</dt>
					<dd><?php echo $class['class_name']; ?></dd>

					<dt>Meeting ID</dt>
					<dd><?php echo $class['meeting_id']; ?></dd>

				</dl>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="card">
			<?php echo form_open ('coaching/virtual_class_actions/remove_participants/'.$coaching_id.'/'.$class_id, ['id'=>'validate-1']); ?>
				<table class="table">
					<thead>
						<tr>
							<th width="10">#</th>
							<th>User ID</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (! empty ($participants)) {
						foreach ($participants as $user) {
							$full_name = $user['first_name'].' '.$user['last_name'];
							?>
							<tr>
								<td><input type="checkbox" name="users[]" value="<?php echo $user['member_id']; ?>"></td>
								<td><?php echo $user['adm_no']; ?></td>
								<td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
								<td><?php echo $user['email']; ?></td>
								<td>
									<?php 
									if ($user['role'] == VM_PARTICIPANT_MODERATOR) 
										echo 'Moderator'; 
									else 
										echo 'Attendee';
									?>

									<?php if ($user['member_id'] == $this->session->userdata ('member_id')) { ?>
										<a href="<?php echo site_url ('coaching/virtual_class/join_class/'.$coaching_id.'/'.$class_id.'/'.$user['member_id']); ?>" class='btn btn-primary mr-1' target="_blank"><i class="fa fa-plus"></i> Join</a>
									<?php } ?>
								</td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan="4"><span class="text-danger">No users found</span></td>
						</tr>
						<?php
					}
					?> 
					</tbody>
				</table>

				<div class="card-footer">
					<input type="submit" name="" value="Remove Users" class="btn btn-danger">
					<?php echo anchor ('coaching/virtual_class/add_participants/'.$coaching_id.'/'.$class_id, 'Add Participants', ['class'=>'btn btn-link']); ?>
				</div>
			</form>
		</div>
	</div>
</div>