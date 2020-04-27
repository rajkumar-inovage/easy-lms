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
								<span class="icon-block s25 rounded-circle bg-success">
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
							<?php //echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?>
							<div class="mt-2">
								<?php 
								if ($row['running'] == 'true') {
									echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-success mr-1']);
								} else {
									echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-default mr-1']);
								}
								?>
							</div>
						</div>

						<div class="media-right">
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
		</ul> 
	</div>
</div>