<?php echo form_open ('coaching/indiatest_actions/import_tests/'.$coaching_id.'/'.$course_id.'/'.$plan_id, ['id'=>'validate-1']) ;?>
	<?php if ($course_id > 0) { ?>
		<div class="row mb-4">
			<div class="col-12 text-right">
					<input type="submit" name="" value="Add Tests" class="btn btn-primary">
			</div>
		</div>
	<?php } ?>
	<div class="row">
	    <div class="col-12 list" data-check-all="checkAll">
			<?php
			$i = 1;
			if ( ! empty($tests)) {
				foreach ($tests as $row) {
					$courses = $row['courses'];
					?>
		            <div class="card mb-3">
		                <div class="d-flex flex-grow-1 min-width-zero">
		                    <span class="align-self-center pl-4">
		                        <?php echo $i; ?> -
		                    </span>
		                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
		                        <div class="list-item-heading mb-0 w-60 w-xs-100">
									<div class="">
										<?php echo $row['title']; ?>
									</div>
									<div class="">
										<?php
											if (! empty ($courses)) {
												foreach ($courses as $course) {
													echo '<span class="badge badge-pill badge-info mr-2 pb-1 mt-2">'.$course['title'].'</span>';
												}
											} 
										?>
									</div>
								</div>
		                        <p class="mb-0 text-muted text-small w-20 w-xs-100 mt-2 mt-md-0">
		                        	<?php echo $row['time_min'] . ' mins'; ?>
		                        </p>		                        
		                    </div>
		                    <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
		                        <input type="checkbox" class="custom-control-input" name="tests[]" value="<?php echo $row['test_id']; ?>">
		                        <span class="custom-control-label">&nbsp;</span>
		                    </label>
		                </div>
		            </div>
					<?php
					$i++;
				}
			} else {
				?>
				<div class="col-12">
					<div class="alert alert-danger ">
						<span class="">No tests found</span>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<?php if ($course_id > 0) { ?>
		<div class="row my-3">
			<div class="col-12 text-right">
					<input type="submit" name="" value="Add Tests" class="btn btn-primary">
			</div>
		</div>
	<?php } ?>
<?php echo form_open (); ?>