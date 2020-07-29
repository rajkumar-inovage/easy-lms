<div class="row">
    <div class="col-12 list" data-check-all="checkAll">	
		<?php 
		$i = 1;
		if ( ! empty ($lessons)) { 
			foreach ($lessons as $row) { 
				?>
				<div class="card d-flex flex-row mb-3">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id']); ?>">
								<div class="text-muted">Chapter <?php echo $i; ?></div>
                                <h4><?php echo $row['title']; ?></h4>
		                    </a>
                            <p class="mb-0 text-muted text-small w-15 w-xs-100"></p>
                            <p class="mb-0 text-muted text-small w-15 w-xs-100"></p>
                            <div class="w-15 w-xs-100">
	                        	<?php 
								if ($row['status'] == LESSON_STATUS_PUBLISHED) {
									echo '<span class="badge badge-primary badge-pill">Published</span>';
								} else {
									echo '<span class="badge badge-secondary badge-pill">Un-Published</span>';
								}
								?>
                            </div>
	                        <div class="btn-group">
								<?php echo anchor ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], '<i class="fa fa-search"></i>', ['class'=>'btn btn-primary btn-sm']); ?>
								<?php echo anchor ('coaching/lessons/pages/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id'], '<i class="fa fa-file-alt"></i>', ['class'=>'btn btn-primary btn-sm']); ?>
							</div>
                        </div>
                    </div>
                </div>
				<?php 
				$i++; 
			} 
		} else {
			?>
			<div class="alert alert-danger" role="alert">
				No lessons found
				<?php echo anchor ('coaching/lessons/create/'.$coaching_id.'/'.$course_id, 'Create Lesson'); ?>
			</div>
			<?php
		}
		?>
	</div>
</div>
