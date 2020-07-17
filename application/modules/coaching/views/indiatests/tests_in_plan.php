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
			<li class="list-group-item media font-weight-bold">
				<div class="media-left">
					#
				</div>
				<?php if ($course_id > 0) { ?>
					<div class="media-left">
						<input id="checkAll" type="checkbox" onchange="check_all()">
					</div>
				<?php } ?>
				<div class="media-body">
					Test Name
				</div>
				<div class="media-right">
					Duration
				</div>
			</li>
			<?php
			$i = 1;
			if ( ! empty($tests)) {
				foreach ($tests as $row) {
					$courses = $row['courses'];					
					?>
					<li class="list-group-item media">
						<div class="media-left">
							<?php echo $i; ?>
						</div>
						<?php if ($course_id > 0) { ?>
							<div class="media-left">
								<input type="checkbox" name="tests[]" value="<?php echo $row['test_id']; ?>" class="checks" >
							</div>
						<?php } ?>
						<div class="media-body">
							<?php echo $row['title']; ?>
							<div class="mt-2">
							<?php
							if (! empty ($courses)) {
								foreach ($courses as $course) {
									echo '<span class="badge badge-info mr-2 pb-1">'.$course['title'].'</span>';
								}
							} 
							?>
							</div>
						</div>
						<div class="media-right">
							<span><?php echo $row['time_min'] . ' mins'; ?></span>
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