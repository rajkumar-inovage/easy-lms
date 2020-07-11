<div class="card mb-3 ">
	<div class="card-header">
		<p class="card-title font-weight-bold d-flex justify-content-between">Lessons <span class="badge badge-primary"><?php echo $num_lessons; ?></span></p>
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
		  	<a class="" href="<?php echo site_url ('coaching/lessons/preview/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-search"></i> Preview</a>
		  </li>

		</ul>
	</div>
</div>

<div class="card mb-3 ">
	<div class="card-header">
		<p class="card-title font-weight-bold justify-content-between">Tests <span class="badge badge-primary"><?php echo $num_lessons; ?></span></p>
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

