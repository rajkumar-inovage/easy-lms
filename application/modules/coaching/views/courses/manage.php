<div class="row mb-4">
    <!-- Chapters -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">
                	<span><i class="simple-icon-notebook pr-3"></i></span>Chapters <span class="badge badge-primary float-right"><?php echo $num_lessons; ?></span>
                </h5>
                <div class="separator mb-5"></div>
                <div class="card-body p-0 align-self-center justify-content-between min-width-zero align-items-md-center">
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/lessons/index/'.$coaching_id.'/'.$course_id); ?>">
	                    <i class="simple-icon-book-open heading-icon"></i>
	                    <span class="align-middle d-inline-block">Chapters</span>
	                </a>
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/lessons/create/'.$coaching_id.'/'.$course_id); ?>">
	                    <i class="simple-icon-plus heading-icon"></i>
	                    <span class="align-middle d-inline-block">Create Chapter</span>
	                </a>
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/indiatests/lesson_plans/'.$coaching_id.'/'.$course_id.'/0/0'); ?>">
	                    <i class="simple-icon-arrow-down-circle heading-icon"></i>
	                    <span class="align-middle d-inline-block">Import Free Lessons</span>
	                </a>

			      	<a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/indiatests/lesson_plans/'.$coaching_id.'/'.$course_id.'/0/1'); ?>">
			      		<i class="fa fa-shopping-cart"></i>
	                    <span class="align-middle d-inline-block">Buy From IndiaTests</span>
			      	</a>
                
	            </div>
            </div>
        </div>
    </div>
    
    <!-- Tests -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">
                	<span><i class="simple-icon-notebook pr-3"></i></span>Tests <span class="badge badge-primary float-right"><?php echo $num_tests; ?></span>
                </h5>
                <div class="separator mb-5"></div>
                <div class="card-body p-0 align-self-center justify-content-between min-width-zero align-items-md-center">
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/tests/index/'.$coaching_id.'/'.$course_id); ?>">
	                    <i class="simple-icon-book-open heading-icon"></i>
	                    <span class="align-middle d-inline-block">Tests</span>
	                </a>
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/tests/create_test/'.$coaching_id.'/'.$course_id); ?>">
	                    <i class="simple-icon-plus heading-icon"></i>
	                    <span class="align-middle d-inline-block">Create Test</span>
	                </a>
	                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/indiatests/test_plans/'.$coaching_id.'/'.$course_id.'/0/0'); ?>">
	                    <i class="simple-icon-arrow-down-circle heading-icon"></i>
	                    <span class="align-middle d-inline-block">Import Free Tests</span>
	                </a>

			      	<a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/indiatests/test_plans/'.$coaching_id.'/'.$course_id.'/0/1'); ?>">
			      		<i class="fa fa-shopping-cart"></i>
	                    <span class="align-middle d-inline-block">Buy From IndiaTests</span>
			      	</a>
                
	            </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <!-- Teachers -->
	<?php if ($is_admin) { ?>
	    <div class="col-lg-6 col-md-12 mb-4">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title text-primary">
	                	<span><i class="simple-icon-notebook pr-3"></i></span>Teachers <span class="badge badge-primary float-right"><?php echo $num_lessons; ?></span>
	                </h5>
	                <div class="separator mb-5"></div>
	                <div class="card-body p-0 align-self-center justify-content-between min-width-zero align-items-md-center">
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id); ?>">
		                    <i class="simple-icon-book-open heading-icon"></i>
		                    <span class="align-middle d-inline-block">Teachers</span>
		                </a>
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id.'/'.TEACHERS_NOT_ASSIGNED); ?>">
		                    <i class="simple-icon-plus heading-icon"></i>
		                    <span class="align-middle d-inline-block">Add Teacher</span>
		                </a>
		            </div>
	            </div>
	        </div>
	    </div>
	<?php } ?>
    
    <!-- Organize -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">
                	<span><i class="simple-icon-notebook pr-3"></i></span>Organize <span class="badge badge-primary float-right"></span>
                </h5>
                <div class="separator mb-5"></div>
                <div class="card-body p-0 align-self-center justify-content-between min-width-zero align-items-md-center">
                	<?php if ($course['enrolment_type'] == COURSE_ENROLMENT_DIRECT) { ?>
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/courses/organize/'.$coaching_id.'/'.$course_id); ?>">
		                    <i class="simple-icon-book-open heading-icon"></i>
		                    <span class="align-middle d-inline-block"> Organize Contents </span>
		                </a>
					  	<a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/enrolments/batch_users/'.$coaching_id.'/'.$course_id); ?>"><i class="fa fa-users"></i> Enrolments</a>
					<?php } else { ?>
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/enrolments/batches/'.$coaching_id.'/'.$course_id); ?>">
		                    <i class="simple-icon-book-open heading-icon"></i>
		                    <span class="align-middle d-inline-block">Batches and Schedules</span>
		                </a>
					<?php } ?>
                
	            </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <!-- Settings -->
	<?php if ($is_admin) { ?>
	    <div class="col-lg-6 col-md-12 mb-4">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title text-primary">
	                	<span><i class="simple-icon-notebook pr-3"></i></span>Settings <span class="badge badge-primary float-right"></span>
	                </h5>
	                <div class="separator mb-5"></div>
	                <div class="card-body p-0 align-self-center justify-content-between min-width-zero align-items-md-center">
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id); ?>">
		                    <i class="simple-icon-book-open heading-icon"></i>
		                    <span class="align-middle d-inline-block">Preview</span>
		                </a>
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="<?php echo site_url ('coaching/courses/edit/'.$coaching_id.'/'.$cat_id.'/'.$course_id); ?>">
		                    <i class="simple-icon-plus heading-icon"></i>
		                    <span class="align-middle d-inline-block">Edit</span>
		                </a>
		                <a class="list-item-heading mb-0 truncate w-100 mt-0 d-inline-block" href="#">
		                    <i class="simple-icon-plus heading-icon"></i>
		                    <span class="align-middle d-inline-block">Delete</span>
		                </a>
		            </div>
	            </div>
	        </div>
	    </div>
	<?php } ?>    
   
</div>