<div class="card card-default mb-4">

	<ul class="list-group" >
		<?php 
		$i = 1;
		if ( ! empty ($pages)) { 
			foreach ($pages as $row) { 
				?>
				<li class="list-group-item media">
					<div class="media-left"><?php echo $i; ?></div>
					<div class="media-body">
						<a data-toggle="collapse" href="#page<?php echo $row['page_id']; ?>" role="button" aria-expanded="false" aria-controls="page<?php echo $row['page_id']; ?>">
							<?php echo $row['title']; ?>
						</a>
						<div class="collapse" id="page<?php echo $row['page_id']; ?>">
						  <div class="card card-body">
						    page<?php echo $row['page_id']; ?>
						  </div>
						</div>
						<?php 
						?>
					</div>
					<div class="media-right">
						<?php 
							//if ($row['status'] == LESSON_STATUS_PUBLISHED) {
							//	echo '<span class="badge badge-primary">Published</span>';
							//} else {
							//	echo '<span class="badge badge-secondary">Un-published</span>';
							//}
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
					<span class="text-danger">No page found</span>
					<?php echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id, 'Add Page'); ?>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
</div>