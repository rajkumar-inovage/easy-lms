<div class="row">
	<div class="col-lg-12 col-xl-6">
		<div class="card mb-4 shadow-sm">
			<div class="card-body">
				<h5 class="card-title">My Courses</h5>
				<?php 
				if (! empty ($courses)) {
					foreach($courses as $i => $row) {
						extract($row['progress']);
						?>
						<div class="d-flex flex-row justify-content-between<?php echo (count($courses) - 1 !== $i)?' border-bottom pb-3 mb-3':''; ?>">
							<div class="pr-3 flex-grow-1">
								<h4 class="text-left"><?php echo $row['title']; ?></h4>
								<p class="text-justify"><?php echo excerpt($row['description'], 15); ?></p>
							</div>
							<div class="align-middle text-center flex-shrink-0">
								<div role="progressbar" class="progress-bar-circle mx-auto position-relative" data-color="#5b87ac" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="<?php echo $total_progress; ?>" aria-valuemax="<?php echo $total_pages; ?>" data-show-percent="false"></div>
								<a class="btn btn-xs btn-outline-primary border-primary shadow-sm mt-3 d-block" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$row['course_id']); ?>">View <i class="fa fa-eye"></i>
								</a>
							</div>
						</div>
						<?php
						if ($i >= 2) {
							break;
						}
					}
				} else {
		        	?>
		            <div class="alert alert-danger mb-0">
		                You are not enroled in any courses
		            </div>
		            <?php
		        }
				?>
			</div>
			<div class="card-footer text-right">
				<?php echo anchor ('student/courses/index/'.$coaching_id.'/'.$member_id, '<i class="fa fa-book"></i> All Courses', ['class'=>'btn btn-link mr-1']); ?>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-xl-6">
		<div class="card mb-4 shadow-sm">
			<div class="card-body">
				<h5 class="card-title">My Classrooms</h5>
				<?php
				if (! empty ($my_classrooms)) {
					foreach($my_classrooms as $i => $row) { 
						?>
						<div class="d-flex flex-row pb-3 mb-3 justify-content-between<?php echo (count($courses) - 1 !== $i)?' border-bottom':''; ?>">
							<div class="media-left">
								<?php if ($row['running'] == 'true') { ?>
									<span class="icon-block half rounded-circle bg-success">
										<i class="fa fa-video"></i>
									</span>
								<?php } else { ?>
									<span class="icon-block half rounded-circle bg-grey-200">
										<i class="fa fa-video"></i>									
									</span>
								<?php } ?>
							</div>
							<div class="pl-3 flex-grow-1">
								<h4 class=""><?php echo $row['class_name']; ?></h4>
								<?php if ($row['running'] == 'true') { ?>
									<span class="badge badge-success">Class has started</span>
								<?php } else { ?>
									<span class="badge badge-default bg-grey-200">Class not started</span>
								<?php } ?>							
								<?php //echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?>
								<div class="mt-2">
									<?php 
									if ($row['running'] == 'true') {
										echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-success mr-1']);
									} else {
										echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-default mr-1']);
									}
									?>
								</div>
							</div>
						</div>
						<?php
						if ($i >= 2) {
							break;
						}
					}
				} else {
		        	?>
		            <div class="alert alert-danger mb-0">
		                You are not enroled in any class
		            </div>
		            <?php
		        }
				?>
			</div>
			<div class="card-footer text-right">
				<?php echo anchor ('student/virtual_class/index/'.$coaching_id.'/'.$member_id, '<i class="fa fa-video"></i> All Classrooms', ['class'=>'btn btn-link mr-1']); ?>
			</div>
		</div>
		<div class="card mb-4 shadow-sm">
			<div class="card-body">
				<h5 class="card-title">My Tests</h5>
				<?php
				$now = time ();
			    if (! empty ($enrolments)) {
			            foreach ($enrolments as $i => $row) {
			                ?>
			                <div class="d-flex flex-row pb-3 mb-3 justify-content-between<?php echo (count($courses) - 1 !== $i)?' border-bottom':''; ?>">
			                      <div class="media-left">
					                <?php if ( $now >= $row['start_date'] && $now <= $row['end_date']) { ?>
			                            <span class="icon-block half bg-success rounded-circle ">
				                          <i class="fa fa-superscript"></i>
				                        </span>
				                	<?php } else if ($now < $row['start_date'] && $now < $row['end_date']) { ?>
			                            <span class="icon-block half bg-warning rounded-circle ">
				                          <i class="fa fa-superscript"></i>
				                        </span>
			                        <?php } else { ?>
			                            <span class="icon-block half bg-grey-200 rounded-circle">
				                          <i class="fa fa-superscript"></i>
				                        </span>
				                    <?php } ?>
			                      </div>
			                      <div class="pl-3 flex-grow-1">
			                        <h4 class=""><?php echo $row['title']; ?></h4>
			                        <div class="">
						                <?php if ( $now >= $row['start_date'] && $now <= $row['end_date']) { ?>
				                            <span class="badge badge-success">Ongoing Test</span>
					                	<?php } else if ($now < $row['start_date'] && $now < $row['end_date']) { ?>
				                            <span class="badge badge-warning">Upcoming Test</span>
				                        <?php } else { ?>
				                            <span class="badge badge-default bg-grey-200">Archived Test</span>
				                        <?php } ?>
				                        <div>
				                        	QUESTIONS: <?php echo $row['num_test_questions']; ?><br>
				                        	MM: <?php echo $row['test_marks']; ?>
				                        </div>

			                            <div class="text-muted">
			                            	Started On: <?php echo date ('d M, Y H:i A', $row['start_date']); ?><br>
			                            	Ending On: <?php echo date ('d M, Y H:i A', $row['end_date']); ?>
			                            </div>
			                        </div>
			                        <?php 
					                if ( ($now >= $row['start_date'] && $now <= $row['end_date']) && ($row['attempts'] == 0  || $row['num_attempts'] < $row['attempts']) ) {
					                	// Ongoing Tests
				                        echo anchor ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], 'Take Test', ['class'=>'btn btn-success']);
					                } else if ($now < $row['start_date'] && $now < $row['end_date']) {
						                // Up coming tests
					                } else if ($row['release_result'] == RELEASE_EXAM_IMMEDIATELY) {
					                }
					                ?>
			                      </div>
			                </div>
			                <?php
							if ($i >= 2) {
								break;
							}		
				        }
				} else {
			        ?>
			        <div class="alert alert-danger mb-0">No tests right now</div>
			        <?php
			    }
			    ?>
			</div>
			<div class="card-footer text-right">
				<?php echo anchor ('student/tests/index/'.$coaching_id.'/'.$member_id.'/'.TEST_TYPE_PRACTICE, '<i class="fa fa-superscript"></i> Practice Tests', ['class'=>'btn btn-primary mr-1']); ?>
				<?php echo anchor ('student/tests/index/'.$coaching_id.'/'.$member_id, '<i class="fa fa-superscript"></i> All Tests', ['class'=>'btn btn-link mr-1']); ?>
			</div>
		</div>
	</div>
</div>
<div class="row no-gutters mx-n2 flex-nowrap overflow-auto">
	<?php
		if (! empty ($dashboard_menu)) {
			foreach ($dashboard_menu as $i => $menu) {
				$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;				
				?>
				<div class="col-7 col-sm px-2 mb-4">
					<div class="card progress-banner h-auto">
						<div class="card-body text-center <?php echo strtolower(str_replace(" ","-",$menu['menu_desc']));?>">
							<a href="<?php echo site_url ($link); ?>" class="text-white text-decoration-none stretched-link">
								<?php echo $menu['icon_img']; ?>
								<span class="d-block"><?php echo $menu['menu_desc'];?></span>
							</a>
						</div>
					</div>
				</div>	
				<?php
			}
		}
	?>
</div>