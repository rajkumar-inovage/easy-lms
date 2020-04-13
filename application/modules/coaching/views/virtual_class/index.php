<div class="card card-default">
	<ul class="list-group">
	
			<?php 
				$i=1;
				if (! empty ($class)) {
					foreach($class as $row) { 
						?>
						<li class="list-group-item">
							<p class="list-group-title">
								Name: <?php echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?><br>
								<span class="">Meeting ID: <?php echo $row['meeting_id']; ?></span>
							</p>
							<div class="">
								<?php 
								$member_id = $this->session->userdata ('member_id');
								echo anchor ('coaching/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Start and Join', ['class'=>'btn btn-primary mr-1']); 
								echo anchor ('coaching/virtual_class/participants/'.$coaching_id.'/'.$row['class_id'], '<i class="fa fa-users"></i> Participants', ['class'=>'btn btn-info']); 
								echo anchor ('coaching/virtual_class/recordings/'.$coaching_id.'/'.$row['class_id'].'/'.$row['meeting_id'], '<i class="fa fa-play"></i> Recordings', ['class'=>'btn btn-info-outline d-none']); 
								?>
								<a onclick="show_confirm ('Delete this virtual classroom?', '<?php echo site_url ('coaching/virtual_class_actions/delete_class/'.$coaching_id.'/'.$row['class_id']); ?>')" class="btn btn-link text-danger">Delete Classroom</a>
							</div>
						</li>
						<?php
						$i++; 
					}

				} else {
					?>
					<li class="list-group-item">
						<td colspan="6"><span class="text-danger">No classroom created yet</span></td>
						</td>
					</li>
					<?php
				}
			?> 
			</tbody>
		</ul> 
	</div>
</div>

