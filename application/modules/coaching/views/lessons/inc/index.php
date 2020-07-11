<div class="card card-default mb-4">

	<ul class="list-group" >
		<?php 
		$i = 1;
		if ( ! empty ($lessons)) { 
			foreach ($lessons as $row) { 
				?>
				<li class="list-group-item media">
					<div class="media-left"><?php echo $i; ?></div>
					<div class="media-left">
						<?php 
							if ($row['status'] == LESSON_STATUS_PUBLISHED) {
								echo '<i class="fa fa-circle text-success"></i>';
							} else {
								echo '<i class="fa fa-circle text-secondary"></i>';
							}
						?>						
					</div>
					<div class="media-body">
						<?php echo anchor('coaching/lessons/create/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], $row['title'], array('title'=>$row['title'], 'class'=>'')); ?>
						<?php 
						$description = character_limiter ($row['description'], 50);
						echo $description;
						?>
					</div>
					<div class="media-right">
					</div>
					<div class="media-right">
						<?php echo anchor ('coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], 'Content', ['class'=>'btn btn-info btn-sm']); ?>
					</div>
				</li>
				<?php 
				$i++; 
			} 
		} else {
			?>
			<li class="list-group-item media">
				<div class="media-body" >
					<span class="text-danger">No lessons found</span>
					<?php echo anchor ('coaching/lessons/create/'.$coaching_id.'/'.$course_id, 'Create Lesson'); ?>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
</div>
