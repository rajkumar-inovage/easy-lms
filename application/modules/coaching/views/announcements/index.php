<div class="card card-default">
	<ul class="list-group">
	<?php 
		$i = 1;
		if ( ! empty ($results)) {
			foreach ($results as $row) {
				?>
				<li class="list-group-item media">
					<div class="media-left"><?php echo $i; ?></div>
					<div class="media-body">
						<?php echo anchor ('coaching/announcements/create_announcement/'.$coaching_id.'/'.$row['announcement_id'], $row['title']); ?>
						<p class="text-muted">
							Availability: From <?php echo date ('d M, Y', $row['start_date']); ?> To <?php echo date ('d M, Y', $row['end_date']); ?>
						</p>
					</div>
					<div class="media-right">
						<?php 
							$status= $row['status'];
							if ($status == 1) {
								//echo '<span class="badge badge-success">Published</span>';
							} else {
								//echo '<span class="badge badge-default">Un-published</span>';
							}
						?>
					</div>
					<div class="media-right">
						<a href="javascript:void(0)" onclick="show_confirm ('<?php echo 'Are you sure want to delete this announcement?' ; ?>','<?php echo site_url('coaching/announcement_action/delete/'.$coaching_id.'/'.$row['announcement_id']); ?>' )">
							<i class="fa fa-trash"></i>
						</a>
					</div>
				</li>
				<?php
				$i++; 
			}
		} else {
			?>
			<li class="list-group-item text-danger">No announcements</li>
			<?php
		}
		?>
	</ul>
</div>
	
