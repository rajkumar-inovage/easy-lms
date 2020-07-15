<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Lessons <span class="badge badge-primary"><?php echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/lessons/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-book-open"></i> Chapters</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Create Chapter</a>
	      </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/plans/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-shopping-cart"></i> Import From Indiatests</a>
	      </li>

		</ul>
	</div>
</div>

<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Tests <span class="badge badge-primary"><?php //echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/tests/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-puzzle-piece"></i> Tests</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/tests/create_test/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Create Test</a>
	      </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/plans/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-shopping-cart"></i> Import From Indiatests</a>
	      </li>

		</ul>
	</div>
</div>

<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Teachers <span class="badge badge-primary"><?php //echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-user-tie"></i> Teachers</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/courses/add_teachers/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Add Teacher</a>
	      </li>

		</ul>
	</div>
</div>

<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Scheduler <span class="badge badge-primary"><?php //echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-user-tie"></i> Schedules</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/courses/add_teachers/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Create Schedule</a>
	      </li>

		</ul>
	</div>
</div>

<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Settings <span class="badge badge-primary"><?php //echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item ">
		  	<a class="" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-search"></i> Preview</a>
		  </li>

		  <li class="list-inline-item ml-4">
		  	<a class="" href="<?php echo site_url ('coaching/courses/create/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-edit"></i> Edit</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/courses/add_teachers/'.$coaching_id.'/'.$course_id); ?>" class="text-danger"><i class="fa fa-trash"></i> Delete Course</a>
	      </li>
		</ul>
	</div>
</div>

