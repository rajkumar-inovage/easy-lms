<div class="card card-default">
	<ul class="list-group">	
		<?php 
			$i=1;
			if (! empty ($class)) {
				foreach($class as $row) { 
					?>
					<li class="list-group-item media">
						<div class="media-left">
							<?php if ($row['running'] == 'true') { ?>
								<span class="icon-block half bg-green-200 rounded-circle" title="Meeting is running">
								</span>
							<?php } else { ?>
								<span class="icon-block half bg-grey-200 rounded-circle" title="Meeting is not running">
								</span>
							<?php } ?>
						</div>

						<div class="media-body">
							<h4><?php echo anchor ('coaching/virtual_class/create_class/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?></h4>
							<p class=""><?php echo character_limiter ($row['description'], 250); ?></p>
							<p>
								<?php
								if ($row['start_date'] > 0) {
									echo 'Start Date: '. date ('d F, Y', $row['start_date']);
									echo ' at  '. date ('h:i A', $row['start_date']);
								}
								?>
								<?php
								if ($row['end_date'] > 0) {
									echo 'End Date: '. date ('d F, Y', $row['end_date']);
									echo ' at  '. date ('h:i A', $row['end_date']);
								}
								?>
							</p>
							<hr>
							<div class="">
								<?php 
								$member_id = $this->session->userdata ('member_id');
								echo anchor ('coaching/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Start and Join', ['class'=>'btn btn-primary mr-1']); 
								echo anchor ('coaching/virtual_class/participants/'.$coaching_id.'/'.$row['class_id'], '<i class="fa fa-users"></i> Participants', ['class'=>'btn btn-info']); 
								echo anchor ('coaching/virtual_class/recordings/'.$coaching_id.'/'.$row['class_id'].'/'.$row['meeting_id'], '<i class="fa fa-play"></i> Recordings', ['class'=>'btn btn-info-outline']); 
								if ($this->session->userdata ('role_id') == USER_ROLE_TEACHER) {
								} else {
									?>
									<a onclick="show_confirm ('Delete this virtual classroom?', '<?php echo site_url ('coaching/virtual_class_actions/delete_class/'.$coaching_id.'/'.$row['class_id']); ?>')" class="btn btn-link text-danger">Delete Classroom</a>
									<?php
								}
								?>
							</div>
						</div>
					</li>
					<?php
					$i++; 
				}

			} else {
				?>
				<li class="list-group-item">
					<td colspan="6"><span class="text-danger">No classroom created yet</span> <?php echo anchor ('coaching/virtual_class/create_class/'.$coaching_id, 'Create Class'); ?></td>
					</td>
				</li>
				<?php
			}
		?> 
		</ul> 
	</div>
</div>

