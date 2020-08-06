<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4 progress-banner">
            <a href="<?php echo site_url ('coaching/subscription/index/'.$coaching_id.'/'.$subscription['sp_id']); ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                <div>
					<?php if ($subscription['ending_on'] > time ()) { ?>
						<i class="iconsminds-yes mr-2 text-white align-text-bottom d-inline-block"></i>
					<?php } else { ?>
						<i class="iconsminds-close-check mr-2 text-white align-text-bottom d-inline-block"></i>
					<?php } ?>
                    <div>
                        <p class="lead text-white"><?php echo $subscription['title']; ?></p>
                        <p class="text-small text-white">Ending On: <?php echo date ('d M, Y', $subscription['ending_on']); ?></p>
                    </div>
                </div>

                <div>
					<button class="btn btn-light btn-lg">Details</button>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4 progress-banner">
            <a href="<?php echo site_url ('coaching/users/index/'.$coaching_id); ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                <div>
                    <i class="simple-icon-people mr-2 text-white align-text-bottom d-inline-block"></i>
                    <div>
                        <p class="lead text-white"><?php echo $users['total']; ?> Users</p>
                        <p class="text-small text-white"></p>
                    </div>
                </div>
                <div>
                    <div role="progressbar"
                        class="progress-bar-circle progress-bar-banner position-relative" data-color="white"
                        data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="<?php echo $users['total']; ?>" aria-valuemax="<?php echo $subscription['max_users']; ?>"
                        data-show-percent="false">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4 progress-banner">
            <a href="<?php echo site_url ('coaching/courses/index/'.$coaching_id); ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                <div>
                    <i class="iconsminds-books mr-2 text-white align-text-bottom d-inline-block"></i>
                    <div>
                        <p class="lead text-white"><?php echo $num_courses; ?> Courses</p>
                        <p class="text-small text-white"></p>
                    </div>
                </div>
                <div>
                	<button class="btn btn-light btn-lg">View Courses</button>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row ">
	<!-- // Col-md-6 -->
	<div class="col-md-6">
				<!----// Class //-->
				<div class="card mb-4 shadow">
					<div class="card-body">
						<h4 class="card-title d-flex justify-content-between">
							<span>User Registration This Week</span>
							<span class="badge badge-primary"><?php //echo $num_courses; ?></span>
						</h4>
						<div class="separator mb-5"></div>
					</div>
					 <div class="chart-container chart">
                        <canvas id="user-registered"></canvas>
                    </div>
				</div>
		<!----// Users //-->
		<div class="card mb-3 ">
			<div class="card-body ">
				<h4 class="card-title d-flex justify-content-between">
					<span><i class="simple-icon-people "></i> Users</span>
					<span class="badge badge-primary"><?php echo $users['total']; ?></span>
				</h4>
				<div class="separator mb-5"></div>

				<div class="d-flex flex-row justify-content-between mb-3 pb-3 border-bottom">                    
                    <div class="">
                        <a href="<?php echo site_url ('coaching/users/index/'.$coaching_id.'/'.USER_ROLE_STUDENT); ?>">
                            <p class="font-weight-medium mb-0 ">Students</p>
                            <p class="text-muted mb-0 text-small"></p>
                        </a>
                    </div>
                    <span class="badge badge-pill badge-primary"><?php echo $users['num_students']; ?></span>
                </div>
				<div class="d-flex flex-row justify-content-between mb-3 pb-3 border-bottom">                    
                    <div class="">
                        <a href="<?php echo site_url ('coaching/users/index/'.$coaching_id.'/'.USER_ROLE_TEACHER); ?>">
                            <p class="font-weight-medium mb-0 ">Teachers</p>
                            <p class="text-muted mb-0 text-small"></p>
                        </a>
                    </div>
                    <span class="badge badge-pill badge-primary"><?php echo $users['num_teachers']; ?></span>
                </div>
				<div class="d-flex flex-row justify-content-between mb-3 pb-3 border-bottom">                    
                    <div class="">
                        <a href="<?php echo site_url ('coaching/users/index/'.$coaching_id.'/0/'.USER_STATUS_UNCONFIRMED); ?>">
                            <p class="font-weight-medium mb-0 ">Pending For Approval</p>
                            <p class="text-muted mb-0 text-small"></p>
                        </a>
                    </div>
                    <span class="badge badge-pill badge-danger"><?php echo $users['num_pending']; ?></span>
                </div>

			</div>
		</div>
	</div>
	<!-- // Col-md-6 -->
	<div class="col-md-6">
				<!----// Class //-->
				<div class="card mb-4 shadow">
					<div class="card-body">
						<h4 class="card-title d-flex justify-content-between">
							<span><i class="iconsminds-books "></i> Courses</span>
							<span class="badge badge-primary"><?php echo $num_courses; ?></span>
						</h4>
						<div class="separator mb-5"></div>
						<?php
						$i = 0;
						if (! empty($courses)) {
							foreach ($courses as $row) {
								?>
								 <div class="d-flex flex-row justify-content-between mb-3 pb-3 border-bottom">  
				                  <a class="list-item-heading mb-0 w-50 w-xs-100 mt-0" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$row['course_id']); ?>">
				                      <?php 
				                      if ($row['status'] == LESSON_STATUS_PUBLISHED) {
				                        echo '<i class="simple-icon-check heading-icon"></i>';
				                      } else {
				                        echo '<i class="simple-icon-refresh heading-icon"></i>';
				                      }
				                      ?>
				                      <span class="align-middle d-inline-block"><?php echo $row['title']; ?></span>
				                  </a>
				                  <div class="">
				                    <a class="btn btn-outline-primary btn-sm" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$row['course_id']); ?>"><i class="fa fa-cog"></i> Manage </a>

				                  </div>
				                </div>
								<?php
								$i++;
								if ($i >= 3) {
									break;
								}
							}
						} else {
							?>
							<div class="alert alert-danger">
								No class created
							</div>
							<?php
						}
						?>
					</div>
				</div>
		<!----// Announcements //-->
		<div class="card dashboard-progress">
            <div class="position-absolute card-top-buttons">
                <button class="btn btn-header-light icon-button">
                </button>
            </div>
            <div class="card-body">
                <h5 class="card-title">Announcements</h5>
				<div class="separator mb-5"></div>
                <?php 
                if (! empty($announcements)) {
					foreach ($announcements as $row) {
						?>
		                <div class="mb-4">
		                    <p class="mb-2">
		                        <a href="<?php echo site_url ('coaching/announcements/create_announcement/'.$coaching_id.'/'.$row['announcement_id']); ?>"><span><?php echo $row['title']; ?></span></a>
		                        <span class="float-right text-muted"><?php echo date ('j/M', $row['start_date']); ?></span>
		                    </p>
		                </div>
		                <?php
					}
				}
				?>
            </div>
        </div>
	</div>
</div>

<div class="card fixed d-none">
	<ul class="nav nav-pills nav-fill">
		<?php
		if (! empty ($dashboard_menu)) {
			foreach ($dashboard_menu as $menu) {
				$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
				?>
				<li class="nav-item">					
					<a href="<?php echo site_url ($link); ?>" class="nav-link text-grey-600">
						<span class="d-block"><?php echo $menu['icon_img']; ?></span>
						<span><?php echo $menu['menu_desc']; ?></span>
					</a>
				</li>
				<?php
				}
			}
		?>
	</nav>
</div>