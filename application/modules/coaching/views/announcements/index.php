<div class="row">
	<div class="col-12 list" >
	<?php
$i = 1;
if (!empty($results)) {
	foreach ($results as $row) {
		
		?>
		<div class="card d-flex flex-row mb-3 ">
			<div class="d-flex flex-grow-1 min-width-zero">
				<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
					<div class="media-body w-35 w-xs-100 pr-3">
						<span class="heading-icon"><?php echo $i; ?>-</span>
						<?php echo anchor('coaching/announcements/create_announcement/' . $coaching_id . '/' . $row['announcement_id'], $row['title'], array('class'=>'heading-icon')); ?>
						<div>
							<?php 
								$description = strip_tags ($row['description']);
								$description = character_limiter ($description, 100);
								echo $description;
							?>						
						</div>
					</div>
					<p class="mb-0 text-muted text-small w-15 w-xs-100">
						From <br>
						<?php echo date('d M, Y', $row['start_date']); ?>
					</p>
					<p class="mb-0 text-muted text-small w-15 w-xs-100">
						To <br>
						<?php echo date('d M, Y', $row['end_date']); ?>
					</p>
					<div class="mb-1 w-15 mt-3 mt-md-0 d-flex d-lg-block text-left text-md-right">
						<a href="javascript:void(0)" class="badge badge-pill badge-outline-info mb-1" data-toggle="tooltip" data-placement="left" title="Send Notification">
							<i class="simple-icon-bell"></i>
						</a>
						<a href="javascript:void(0)" class="badge badge-pill badge-outline-danger mb-1 ml-2"  data-toggle="tooltip" data-placement="left" title="Delete Notification" onclick="show_confirm ('<?php echo 'Are you sure want to delete this announcement?'; ?>', '<?php echo site_url('coaching/announcement_action/delete/' . $coaching_id . '/' . $row['announcement_id']); ?>' )">
							<i class="simple-icon-trash"></i>
						</a>
						
					</div>
				</div>
			</div>
		</div>
		<?php
		$i++;
			}
		} else {
			?>
					<div class="list-group-item text-danger">No announcements</div>
					<?php
		}
		?>

	</div>
</div>

