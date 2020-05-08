<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card mb-4 shadow-sm">
			<div class="card-header ">
				<h4>My Classrooms</h4>
			</div>
			<ul class="list-group ">
				<?php 
				$i=1;
				if (! empty ($my_classrooms)) {
					foreach($my_classrooms as $row) { 
						?>
						<li class="list-group-item media">
							<div class="media-left">
								<?php if ($row['running'] == 'true') { ?>
									<span class="icon-block half rounded-circle bg-success">
										<i class="fa fa-video"></i>
									</span>
								<?php } else { ?>
									<span class="icon-block half rounded-circle bg-grey-200">
										<i class="fa fa-video"></i>									
									</span>
								<?php } ?>
							</div>
							<div class="media-body">
								<h4 class=""><?php echo $row['class_name']; ?></h4>
								<?php if ($row['running'] == 'true') { ?>
									<span class="badge badge-success">Class has started</span>
								<?php } else { ?>
									<span class="badge badge-default bg-grey-200">Class not started</span>
								<?php } ?>
								<?php if ($row['role'] == VM_PARTICIPANT_MODERATOR) { ?>
									<span class="badge badge-default bg-blue-200">Moderator</span>
								<?php } else { ?>
									<span class="badge badge-default bg-blue-200">Attendee</span>
								<?php } ?>
								<?php //echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?>
								<div class="mt-2">
									<?php 
									if ($row['role'] == VM_PARTICIPANT_MODERATOR) {
										$button_text = 'Start and Join';
									} else {
										$button_text = 'Join';
									}
									if ($row['running'] == 'true') {
										$class = 'btn-success';
									} else {
										$class = 'btn-default';
									}
									echo anchor ('coaching/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> '.$button_text, ['class'=>'btn mr-1 '.$class]);
									echo anchor ('coaching/virtual_class/participants/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Participants', ['class'=>'btn btn-info mr-1 ']);
									?>
								</div>
							</div>

							<div class="media-right">
							</div>
						</li>
						<?php
						$i++;
						if ($i >= 3) {
							break;
						}
					}
				} else {
		        	?>
		            <div class="text-danger my-4 mx-2">
		                You are not in any class
		            </div>
		            <?php
		        }
				?>
			</ul>
		</div>
	</div>
</div>
