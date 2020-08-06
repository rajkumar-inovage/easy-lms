<div class="row">
    <div class="col-12 list" >
		<?php 
		if ($page_id > 0) {
			?>
			<div class="card">
				<div class="list-group-item media">
					<div class="media-left">
					</div>

					<div class="media-body">
						<h4><?php echo $lesson['title']; ?></h4>
					</div>
					<div class="media-right">
						<a href="#" id="toggle_sidebar_right" class="btn btn-xs"><i class="fa fa-book"></i></a>
					</div>
				</div>
				<div class="card-body">
					<h4><?php echo $page['title']; ?></h4>
				</div>
				<div class="card-body">
					<?php echo $page['content']; ?>
				</div>

				<ul class="list-unstyled ">
					<?php
					//$attachments = $page['att'];
					if (! empty ($attachments)) {
						foreach ($attachments as $att) {
							?>
							<li class=" media">
								<div class="media-body">
									<?php if ($att['att_type'] == LESSON_ATT_YOUTUBE) { ?>
										<iframe width="100" height="80" src="<?php echo $att['att_url']; ?>">
										</iframe><br>
										<?php echo $att['title']; ?>
									<?php } else if ($att['att_type'] == LESSON_ATT_EXTERNAL) { ?>
				                        <a href="<?php echo $att['att_url']; ?>" target="_blank">
				                            <?php echo $att['title']; ?>
				                        </a>
									<?php } else { ?>
				                        <a href="<?php echo $att['att_url']; ?>" target="_blank">
				                            <?php echo $att['title']; ?>
				                        </a>
									<?php } ?>
								</div>
								<div class="media-right">
									<?php
									if ($att['att_type'] == LESSON_ATT_YOUTUBE) { 
										echo '<span class="badge badge-danger">Youtube</span>';
									} else if ($att['att_type'] == LESSON_ATT_EXTERNAL) { 
										echo '<span class="badge badge-info">External link</span>';
									} else {
										echo '<span class="badge badge-info">File</span>';
									}
									?>
								</div>
							</li>
							<?php
						}
					}
					?>
				</ul>
				<div class="card-footer">
					<?php ?>
				</div>
			</div>
			<?php
		} else if ($lesson_id > 0) {
			?>
			<div class="card">

				<div class="card-body">
					<h4 class="card-title"><?php echo $lesson['title']; ?></h4>
					<hr>
					<?php echo $lesson['description']; ?>
				</div>
			</div>

			<!--
			<div class="card dashboard-link-list mt-4">
			    <div class="card-body">
			        <h5 class="card-title">Categories</h5>
			        <div class="d-flex flex-row">
			            <div class="w-50">
			                <ul class="list-unstyled mb-0">
							<?php 
							$i = 1;
							if ( ! empty ($pages)) { 
								foreach ($pages as $row) { 
									?>
									<li class="mb-1">
				                        <a class="" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>" >
											<?php echo $row['title']; ?>
										</a>
				                    </li>
									<?php 
									$i++; 
								} 
							} else {
								?>
								<li class=" ">
									<span class="text-danger">No page found</span>
								</li>
								<?php
							}
							?>
							</ul>
			            </div>
			        </div>
			    </div>
			</div>	
			-->		
			<?php
		} else {

			$li = 1;
			$ti = 1;
			if ( ! empty ($contents)) { 
				foreach ($contents as $row) { 
					?>
					<div class="card d-flex flex-row mb-3">
			            <div class="d-flex flex-grow-1 min-width-zero">
			                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
			                    <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$row['id']); ?>">
				                    <?php if ($row['resource_type'] == COURSE_CONTENT_TEST) { ?>
					                    <p class="mb-0 text-muted text-small w-15 w-xs-100">
				                    		<span class="badge badge-pill badge-danger ">Test <?php echo $ti; ?></span>
					                    </p>
				                    <?php } else { ?>
					                    <p class="mb-0 text-muted text-small w-15 w-xs-100">
				                    		<span class="badge badge-pill badge-primary">Chapter <?php echo $li; ?></span>
				                    	</p>
				                    <?php } ?>				                   
			                        <h4><?php echo $row['title']; ?></h4>
			                    </a>
			                    <p class="mb-0 text-muted text-small w-15 w-xs-100"></p>
			                    <div class="w-20 w-xs-100">
				                    <?php if ($row['resource_type'] == COURSE_CONTENT_TEST) { ?>
										<a href="<?php echo site_url ('coaching/tests/manage/'.$coaching_id.'/'.$course_id.'/'.$row['id']); ?>" class="btn btn-outline-danger shadow-sm">Manage Test <i class="fa fa-arrow-right"></i></a>
				                    <?php } else { ?>
										<a href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$row['id']); ?>" class="btn btn-outline-primary shadow-sm">View Chapter <i class="fa fa-arrow-right"></i></a>
				                    <?php } ?>
			                    </div>
			                </div>
			            </div>
			        </div>

					<?php
					if ($row['resource_type'] == COURSE_CONTENT_TEST) {
						$ti++;;
                    } else {
                    	$li++;
                    }
				}
			}
		}
		?>