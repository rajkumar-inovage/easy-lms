<?php if ($type == 1) { ?>
	<h2 class="text-center mb-4">Purchased Test Plans</h2>
	<div class="row justify-content-center" >

		<div class="col-12">
		<?php 
				if ( ! empty ($test_plans)) {
					foreach ($test_plans as $row) {
						?>
			<div class="card d-flex flex-row mb-3 active">
				<div class="d-flex flex-grow-1 min-width-zero">
					<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
						<?php echo anchor ('coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], $row['plan_name'], array ('class'=>'btn-link list-item-heading mb-0 truncate w-40 w-xs-100 heading-icon', 'title'=>'Browse all tests in this plan ')); ?>
						<div class="w-sm-30 w-xs-100 mt-2 mt-sm-0 text-md-right">
							<?php echo anchor ('coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Tests', array ('class'=>'btn btn-primary', 'title'=>'Browse all tests in this plan ')); ?>
						</div>
					</div>
				</div>
			</div>
			<?php 
					}
				} else { 
					?>
					<div class="list-group-item">
						<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
					</div>
			   	 	<?php 
			   	} // if result 
			   	?>
			<div class="mb-3">
			  	<?php echo anchor ('coaching/indiatests/test_plans/'.$coaching_id.'/'.$course_id.'/0/0', '<i class="fa fa-shopping-cart"></i> Review Available Plans', ['class'=>'btn btn-info']); ?> 	
			  </div>
		</div>

	</div>
<?php } ?>

<?php if ($type == 2) { ?>
	<h2 class="text-center mt-4 mb-4">Purchased Lesson Plans</h2>
	<div class="row justify-content-center" >

		<div class="col-12">
		<?php 
				if ( ! empty ($lesson_plans)) {
					foreach ($lesson_plans as $row) {
						?>
			<div class="card d-flex flex-row mb-3 active">
				<div class="d-flex flex-grow-1 min-width-zero">
					<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
						<?php echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], $row['plan_name'], array ('class'=>'btn-link list-item-heading mb-0 truncate w-40 w-xs-100 heading-icon', 'title'=>'Browse all tests in this plan ')); ?>
						<div class="w-sm-30 w-xs-100 mt-2 mt-sm-0 text-md-right">
							<?php echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Lessons', array ('class'=>'btn btn-primary', 'title'=>'Browse all tests in this plan ')); ?>
						</div>
					</div>
				</div>
			</div>
			<?php 
					}
				} else { 
					?>
					<div class="list-group-item">
						<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
					</div>
					<?php 
			   	} // if result 
			   	?>
			<div class="mb-3">
			  	<?php echo anchor ('coaching/indiatests/lesson_plans/'.$coaching_id.'/'.$course_id.'/0/0', '<i class="fa fa-shopping-cart"></i> Review Available Plans', ['class'=>'btn btn-info']); ?> 	
			  </div>
		</div>

	</div>
<?php } ?>
