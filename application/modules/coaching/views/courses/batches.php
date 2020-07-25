<div class="card">
	<ul class="list-group ">
	<?php
	if ($all_batches) {
		foreach ($all_batches as $row) { 
			?>
			<li class="list-group-item media">
				<div class="media-left">
				</div>
				<div class="media-body">
					<a href="<?php echo site_url ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id.'/'.$row['batch_id']); ?>"><?php echo $row["batch_name"];?></a><br>
					<?php 
					if ($row['start_date'] > 0 ) {
						echo '<div class="text-muted">Starting On: '. date('d M, Y', $row["start_date"]).'</div>';
					} 
					if ($row['end_date'] > 0 ) {
						echo '<div class="text-muted">Ending On: '.date('d M, Y', $row["end_date"]).'</div>';
					} 
					?>
					<?php if($is_admin): ?>
					<div class="btn-group">
						<a href="<?php echo site_url('coaching/enrolments/create_batch/'.$coaching_id.'/'.$course_id.'/'.$row["batch_id"]); ?>" class="btn btn-xs"><i class="fa fa-edit"></i> </a>	
						<a href="javascript:void(0);" onclick="show_confirm ('Are you sure delete this batch?', '<?php echo site_url('coaching/enrolment_actions/delete_batch/'.$coaching_id.'/'.$course_id.'/'.$row["batch_id"]); ?>')" class="btn btn-xs"><i class="fa fa-trash"></i> </a>
					</div>
					<?php endif; ?>
				</div>
				<div class="media-right">
					<a href="<?php echo site_url('coaching/enrolments/schedule/'.$coaching_id.'/'.$course_id.'/'.$row["batch_id"]); ?>" class="btn btn-info" ><i class="fa fa-calendar"></i> Schedule</a>	
				</div>
				<div class="media-right">
					<?php echo '<a href="'.site_url ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id.'/'.$row['batch_id']).'" class="btn btn-success">'.$row['num_users'].' Users</a>'; ?>
				</div>
			</li>
		<?php } 
		} else {
			?>
			<li class="list-group-item ">
				<div class="text-danger">No batches found. <?php echo anchor ('coaching/users/create_batch/'.$coaching_id, 'Create Batch'); ?></div>
			</li>
			<?php
		}
		?>
	</ul>
</div>