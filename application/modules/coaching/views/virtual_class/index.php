<div class="card card-default">
	<div class="-table-responsive" id="users-list">
		<table class="table table-bordered v-middle mb-0" id="data-tables">
			<thead>
				<tr>
					<th width="">#</th>
					<th width="">Class Name</th>
					<th width="">Meeting ID</th>
					<th width="" class="text-center">Moderator Password</th>
					<th width="" class="text-center">Attendee Password</th>
					<th width="" class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
			<?php 
				$i=1;
				if (! empty ($class)) {
					foreach($class as $row) { 
						?>
						<tr>
							<td class=""><?php echo $i; ?></td>
							<td><?php echo $row['class_name']; ?></td>
							<td><?php echo $row['meeting_id']; ?></td>
							<td><?php echo $row['moderator_pwd']; ?></td>
							<td><?php echo $row['attendee_pwd']; ?></td>
							<td class="text-center">
								<?php 
								// echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], '<i class="fa fa-plus"></i> Join', ['class'=>'btn btn-primary mr-1']); 
								echo anchor ('coaching/virtual_class/participants/'.$coaching_id.'/'.$row['class_id'], '<i class="fa fa-users"></i> Participants', ['class'=>'btn btn-info']); 
								?>
								<a onclick="show_confirm ('Delete this virtual classroom?', '<?php echo site_url ('coaching/virtual_class_actions/delete_class/'.$coaching_id.'/'.$row['class_id']); ?>')" class="btn btn-link text-danger">Delete Classroom</a>
							</td>
						</tr>
						<?php
						$i++; 
					}

				} else {
					?>
					<tr>
						<td colspan="6"><span class="text-danger">No classroom created yet</span></td>
						</td>
					</tr>
					<?php
				}
			?> 
			</tbody>
		</table> 
	</div>
</div>

