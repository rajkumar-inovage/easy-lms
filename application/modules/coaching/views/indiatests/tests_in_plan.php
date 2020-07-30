<div class="card">
	<?php echo form_open ('coaching/indiatest_actions/import_tests/'.$coaching_id.'/'.$course_id.'/'.$plan_id, ['id'=>'validate-1']) ;?>
		<ul class="list-group">
			<li class="list-group-item media">				
				<?php if ($course_id > 0) { ?>
					<div class="media-body">
						<input type="submit" name="" value="Add Tests" class="btn btn-success">
					</div>
				<?php } ?>
			</li>
			<li class="list-group-item media font-weight-bold d-inline-flex justify-content-between">
				<div class="media-left d-flex">
					<?php if ($course_id > 0) { ?>
						<div class="media-left pr-2">
							<input id="checkAll" type="checkbox" onchange="check_all()">
						</div>
					<?php } ?>
					#
				</div>
				
				<div class="media-body pl-2">
					Test Name
				</div>
				<div class="media-right float-right">
					Duration
				</div>
			</li>
			<?php
			$i = 1;
			if ( ! empty($tests)) {
				foreach ($tests as $row) {
					$courses = $row['courses'];					
					?>
					<li class="list-group-item media font-weight-bold d-inline-flex justify-content-between">
						<div class="media-left d-flex">
							<?php if ($course_id > 0) { ?>
								<div class="media-left pr-2">
									<input type="checkbox" name="tests[]" value="<?php echo $row['test_id']; ?>" class="checks" >
								</div>
							<?php } ?>
							<?php echo $i; ?>-
						</div>
						
						<div class="media-body pl-2">
							<?php echo $row['title']; ?>
							<div class="mt-2">
							<?php
							if (! empty ($courses)) {
								foreach ($courses as $course) {
									echo '<span class="badge badge-info mr-2 pb-1 mb-1">'.$course['title'].'</span>';
								}
							} 
							?>
							</div>
						</div>
						<div class="media-right float-right">
							<span class="text-info"><?php echo $row['time_min'] . ' mins'; ?></span>
						</div>
					</li>
					<?php
					$i++;
				}
			} else {
				?>
				<li class="list-group-item">
					<span class="text-danger">No tests added</span>
				</li>
				<?php
			}
			?>
		</ul>
		<div class="card-footer">
			<?php if ($course_id > 0) { ?>
				<input type="submit" name="" value="Add Tests" class="btn btn-success">
			<?php } ?>
		</div>
	<?php echo form_open (); ?>
</div>