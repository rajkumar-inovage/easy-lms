<h2 class="text-center mb-4">Purchased Test Plans</h2>
<div class="row justify-content-center" >
	<div class="col-md-10">
	  <div class="card">
		 <ul class="list-group">
			<?php 
			if ( ! empty ($test_plans)) {
				foreach ($test_plans as $row) {
					?>
					<li class="list-group-item media">
						<div class="media-left">
							<span class=""></span>
						</div>
						<div class="media-body">
							<h4><?php echo anchor ('coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], $row['plan_name'], array ('class'=>'link-text-color', 'title'=>'Browse all tests in this plan ')); ?></h4>
						</div>
						<div class="media-right">
							<?php echo anchor ('coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Tests', array ('class'=>'btn btn-primary', 'title'=>'Browse all tests in this plan ')); ?>
						</div>
					</li>
					<?php 
				}
			} else { 
				?>
				<li class="list-group-item">
					<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
				</li>
		   	 	<?php 
		   	} // if result 
		   	?>
		  </ul>

		  <div class="card-footer">
		  	<?php echo anchor ('coaching/indiatests/test_plan_categories/'.$coaching_id, '<i class="fa fa-shopping-cart"></i> Review Available Plans', ['class'=>'btn btn-danger']); ?> 	
		  </div>
	  </div>
	</div>
</div>

<h2 class="text-center mt-4 mb-4">Purchased Lesson Plans</h2>
<div class="row justify-content-center mt-4"  >
	<div class="col-md-10">
	  <div class="card">
		 <ul class="list-group">
			<?php 
			if ( ! empty ($lesson_plans)) {
				foreach ($lesson_plans as $row) {
					?>
					<li class="list-group-item media">
						<div class="media-left">
							<span class=""></span>
						</div>
						<div class="media-body">
							<h4><?php echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], $row['plan_name'], array ('class'=>'link-text-color', 'title'=>'Browse all tests in this plan ')); ?></h4>
						</div>
						<div class="media-right">
							<?php echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Lessons', array ('class'=>'btn btn-primary', 'title'=>'Browse all tests in this plan ')); ?>
						</div>
					</li>
					<?php 
				}
			} else { 
				?>
				<li class="list-group-item">
					<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
				</li>
		   	 	<?php 
		   	} // if result 
		   	?>
		  </ul>

		  <div class="card-footer">
		  	<?php echo anchor ('coaching/indiatests/lesson_plan_categories/'.$coaching_id, '<i class="fa fa-shopping-cart"></i> Review Available Plans', ['class'=>'btn btn-success']); ?> 	
		  </div>
	  </div>
	</div>
</div>
