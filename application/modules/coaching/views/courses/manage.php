<div class="card mb-3 ">
	<div class="card-header">
		<h4 class="card-title d-flex justify-content-between">Lessons <span class="badge badge-primary"><?php echo $num_lessons; ?></span></h4>
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/lessons/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-book-open"></i> Lessons</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Add Lesson</a>
	      </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-shopping-cart"></i> Buy Lesson</a>
	      </li>

		  <li class="list-inline-item ml-4">
		  	<a class="" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-search"></i> Preview</a>
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
		  	<a class="" href="<?php echo site_url ('coaching/lessons/index/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-book-open"></i> Lessons</a>
		  </li>

		  <li class="list-inline-item ml-4">
	      	<a class="" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-plus"></i> Add Lesson</a>
	      </li>

		  <li class="list-inline-item ml-4">
		  	<a class="" href="<?php echo site_url ('coaching/lessons/preview/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-preview"></i> Preview</a>
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

