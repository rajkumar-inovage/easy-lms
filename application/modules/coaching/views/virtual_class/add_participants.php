<div class="row">
	
	<div class="col-md-9">
		<div class="card">
			<?php echo form_open ('coaching/virtual_class_actions/add_participants/'.$coaching_id.'/'.$class_id, ['id'=>'validate-1']); ?>
				<table class="table">
					<thead>
						<tr>
							<th width="10"><input id="checkAll" type="checkbox" ></th>
							<th>User Name/ID</th>
							<th class="d-none d-sm-table-cell">Email</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (! empty ($users)) {
						foreach ($users as $user) {
						  if ($this->virtual_class_model->participants_added ($coaching_id, $class_id, $user['member_id']) > 0) {
						  } else {
								$full_name = $user['first_name'].'+'.$user['last_name'];
								?>
								<tr>
									<td>
										<input type="checkbox" name="users[<?php echo $user['member_id']; ?>]" value="<?php echo $full_name; ?>" class="checks">
									</td>
									<td>
										<?php echo $user['first_name'].' '.$user['last_name']; ?><br>
										<?php echo $user['adm_no']; ?>
									</td>
									<td class="d-none d-sm-table-cell"><?php echo $user['email']; ?></td>
								</tr>
								<?php
							}
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
					Add as: 
					<select name="participant_role">
						<option value="<?php echo VM_PARTICIPANT_ATTENDEE; ?>">Attendee</option>
						<option value="<?php echo VM_PARTICIPANT_MODERATOR; ?>">Moderator</option>
					</select>
					<input type="submit" name="">
				</div>
			</form>
		</div>
	</div>

	<div class="col-md-3">
		
		<div class="card mb-3">
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
		
		<div class="card mb-2">
			<div class="card-header">
				<h4 class="">Roles</h4>
			</div>
			<div class="list-group list-group-flush">
				<?php 
				if (! empty ($roles)) {
					foreach ($roles as $role) {	
						if ($role_id == $role['role_id']) {
							$class = 'active';
						} else {
							$class = '';
						}
						echo anchor ('coaching/virtual_class/add_participants/'.$coaching_id.'/'.$class_id.'/'.$role['role_id'].'/'.$batch_id, $role['description'], ['class'=>'list-group-item '.$class]);
					}
				}
				?>
			</div>
		</div>

		<div class="card mb-2">
			<div class="card-header">
				<h4 class="">Batches</h4>
			</div>
			<div class="list-group list-group-flush">
				<?php 
				if (! empty ($batches)) {
					foreach ($batches as $batch) {
						if ($batch_id == $batch['batch_id']) {
							$class = 'active';
						} else {
							$class = '';
						}
						echo anchor ('coaching/virtual_class/add_participants/'.$coaching_id.'/'.$class_id.'/'.$role_id.'/'.$batch['batch_id'], $batch['batch_name'], ['class'=>'list-group-item '.$class]);
					}
				} else {
					?>
					<li class="list-group-item text-danger">No groups created</li>
					<?php
				}
				?>
			</div>
		</div>

	</div>

</div>