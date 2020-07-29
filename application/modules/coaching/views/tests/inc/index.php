<div class="row">
	<div class="col-12 list" data-check-all="checkAll" id="test-lists">  
		<?php 
			$i = 1;
			if (! empty ($tests)) { 
				foreach ($tests as $row) {
					$courseId = isset($row['course_id'])?$row['course_id']:0;
					?>
		<div class="card d-flex flex-row mb-3">
			<div class="d-flex flex-grow-1 min-width-zero">
				<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
					<div class="w-5">
						<strong class="heading-icon" style="font-size:0.8rem;"><?php echo $i; ?> - </strong>
					</div>
					<div class=" w-40 w-xs-100 truncate">
						<a class="list-item-heading mb-0 truncate btn-link" href="<?php echo site_url ('coaching/tests/manage/'.$coaching_id.'/'.$courseId.'/'.$row['test_id']); ?>">
							<?php echo $row['title']; ?>
						</a>
						<p class="m-0"> <?php echo $row['unique_test_id']; ?></p>
					</div>
					<p class="mb-0 text-muted w-20 w-xs-100">
					<?php 
							$param = $this->common_model->sys_parameter_name(SYS_TEST_TYPE, $row['test_type']);
							echo $param['paramval'];
							?>
					</p>
					<p class="mb-0 text-muted w-15 w-xs-100 text-left text-md-right">
						<?php echo $duration = $row['time_min'] . ' mins'; ?>
					</p>
					<div class="w-15 w-xs-100 text-left text-md-right">
					<?php 
							if ($row['finalized'] == 1) {
								echo '<span class="badge badge-pill badge-success">Published</span>';
							} else {
								echo '<span class="badge badge-pill badge-danger">Un-published</span>';
							}
							?>
					</div>
				</div>
				<label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
					<input type="checkbox" class="custom-control-input">
					<span class="custom-control-label">&nbsp;</span>
				</label>
			</div>
			
		</div>
		<?php 
					$i++; 
				} 
			} else {
				?>
					<div class="alert alert-primary" role="alert">
						<div>
							<span class="text-danger">No tests found</span>									
						</div>
						<?php echo anchor ('coaching/tests/create_test/'.$coaching_id.'/'.$course_id, 'Create Test'); ?>
					</div>
				<?php
			}
			?>
	</div>
</div>
