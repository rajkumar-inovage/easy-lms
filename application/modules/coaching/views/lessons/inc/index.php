<div class="card card-default mb-4">

	<ul class="list-group" >
		<li class="list-group-item media">
			<div class="media-left">#</div>
			<div class="media-body">Lesson Name</div>
			<div class="media-right">Status</div>
		</li>
		<?php 
		$i = 1;
		if ( ! empty ($lessons)) { 
			foreach ($lessons as $row) { 
				?>
				<li class="list-group-item media">
					<div class="media-left"><?php echo $i; ?></div>
					<div class="media-body">
						<?php echo anchor('coaching/lessons/create/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], $row['title'], array('title'=>$row['title'], 'class'=>'')); ?>
						<?php 
						$description = character_limiter ($row['description'], 50);
						echo $description;
						?>
						<hr>
						<?php echo anchor ('coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], 'Content', ['class'=>'btn btn-info btn-sm']); ?>
					</div>
					<div class="media-right">
						<?php 
							if ($row['status'] == LESSON_STATUS_PUBLISHED) {
								echo '<span class="badge badge-primary">Published</span>';
							} else {
								echo '<span class="badge badge-secondary">Un-published</span>';
							}
						?>
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
