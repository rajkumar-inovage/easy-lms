<div class="row">
    <div class="col-12 list" >
    	<ul class="list-unstyled ">
			<li class="list-group-item list-group-header d-flex justify-content-between font-weight-bold">
				<div class="media-left">
					<i class="simple-icon-cursor-move "></i>
				</div>
				<div class="media-body ml-3">
					<span>Title</span>
				</div>
				<div class="media-body ml-3">
					Type
				</div>
				<div class="media-body ml-3">
					For Demo
				</div>
			</li>
		</ul>
    	<ul class="list-unstyled sortable serialization">
		<?php 
		$i = 1;
		$x = 1;

		if ( ! empty ($contents)) {
			foreach ($contents as $row) { 
				?>
				<li class="list-group-item d-flex justify-content-between" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['resource_type']; ?>">
					<div class="media-left">
						<i class="simple-icon-cursor-move "></i>
					</div>
					<div class="media-body ml-3">
						<span><?php echo $row['title']; ?></span>
					</div>
					<div class="media-body ml-3">
	                    <?php if ($row['resource_type'] == COURSE_CONTENT_CHAPTER) { ?>
							<span class="badge badge-pill badge-primary">Chapter</span>
						<?php } else { ?>
							<span class="badge badge-pill badge-danger">Test</span>
						<?php } ?>
					</div>
					<div class="media-body ml-3">
						<div class="form-group row mb-1">
                            <div class="col-12">
                                <div class="custom-switch custom-switch-primary mb-2 custom-switch-small">
                                    <input class="custom-switch-input" id="switchS" type="checkbox">
                                    <label class="custom-switch-btn" for="switchS"></label>
                                </div>
                            </div>
                        </div>	                    
					</div>
				</li>
				<?php 
				$i++; 
				$x++;
			} 
		} else {			

			if ( ! empty ($lessons)) {
				foreach ($lessons as $row) { 
					?>
					<li class="list-group-item d-flex justify-content-between" data-id="<?php echo $row['lesson_id']; ?>" data-name="<?php echo COURSE_CONTENT_CHAPTER; ?>">
						<div class="media-left">
							<i class="simple-icon-cursor-move "></i>
						</div>
						<div class="media-body ml-3">
							<span><?php echo $row['title']; ?></span>
						</div>
						<div class="media-body ml-3">
							<span class="badge badge-pill badge-primary">Chapter</span>
						</div>
					</li>
					<?php 
					$i++; 
					$x++;
				} 
			} 

			if ( ! empty ($tests)) { 
				foreach ($tests as $row) { 
					?>
					<li class="list-group-item d-flex justify-content-between" data-id="<?php echo $row['test_id']; ?>" data-name="<?php echo COURSE_CONTENT_TEST; ?>">
						<div class="media-left">
							<i class="simple-icon-cursor-move "></i>
						</div>
						<div class="media-body ml-3">
							<span><?php echo $row['title']; ?></span>
						</div>
						<div class="media-right ml-3">
							<span class="badge badge-pill badge-danger">Test</span>
						</div>
					</li>
					<?php 
					$x++;
				} 
			}
		}
		?>
		</ul>
	</div>
</div>