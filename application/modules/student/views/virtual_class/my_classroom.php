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
								<span class="icon-block rounded-circle bg-success"></span>
							<?php } else { ?>
								<span class="icon-block rounded-circle bg-grey-200"></span>
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
							echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-primary mr-1']);
							//echo anchor ('coaching/virtual_class/recordings/'.$coaching_id.'/'.$row['class_id'].'/'.$row['meeting_id'], '<i class="fa fa-play"></i> Recordings', ['class'=>'btn btn-info-outline d-none']); 
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


<div class="card card-default">
	<div class="-table-responsive" id="users-list">
		<table class="table table-bordered v-middle mb-0" id="data-tables">
			<thead>
				<tr>
					<th width="">#</th>
					<th width="">Class Name</th>
					<th width="">Meeting ID</th>
					<th width="" class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
			<?php 
				$i=1;
				if (! empty ($class)) {
					foreach ($class as $row) { 
						?>
						<tr>
							<td class=""><?php echo $i; ?></td>
							<td><?php echo $row['class_name']; ?></td>
							<td><?php echo $row['meeting_id']; ?></td>
							<td class="text-center">
								<a href="<?php echo site_url ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id); ?>" class='btn btn-primary mr-1' ><i class="fa fa-plus"></i> Join</a>

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

