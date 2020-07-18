<div class="card">
	<?php echo form_open ('coaching/indiatest_actions/import_lessons/'.$coaching_id.'/'.$course_id.'/'.$plan_id, ['id'=>'validate-1']) ;?>
		<ul class="list-group">
			<?php if ($course_id > 0) { ?>
				<li class="list-group-item media">				
					<div class="media-body">
						<input type="submit" name="" value="Add Lesson" class="btn btn-success">
					</div>
				</li>
			<?php } ?>
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
					Lesson Name
				</div>
				<div class="media-right">
					Duration
				</div>
			</li>
			<?php
			$i = 1;
			if ( ! empty($lessons)) {
				foreach ($lessons as $row) {
					$courses = $row['courses'];
					?>
					<li class="list-group-item media">
						<div class="media-left">
							<?php echo $i; ?>
						</div>
						<?php if ($course_id > 0) { ?>
							<div class="media-left">
								<input type="checkbox" name="lessons[]" value="<?php echo $row['lesson_id']; ?>" class="checks" >
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
							<span><?php echo $row['duration'] . ' mins'; ?></span>
						</div>
					</li>
					<?php
					$i++;
				}
			} else {
				?>
				<li class="list-group-item">
					<span class="text-danger">No lesson added</span>
				</li>
				<?php
			}
			?>
		</ul>
		<?php if ($course_id > 0) { ?>
			<div class="card-footer">
				<input type="submit" name="" value="Add Lesson" class="btn btn-success">
			</div>
		<?php } ?>
	<?php echo form_open (); ?>
</div>