<div class="row">
	<div class="col-12 col-md-12 col-xl-8 col-left">
		<div class="card mb-4">
		    <div class="lightbox">
		    <?php if($course['feat_img']!=''): ?>
		    	<a href="<?php echo site_url('contents/system/default_course.jpg'); ?>">
		    		<img src="<?php echo site_url( $course['feat_img'] ); ?>" class="responsive border-0 card-img-top mb-3" />
		    	</a>
		    <?php else: ?>
		    	<a href="<?php echo site_url('contents/system/default_course.jpg'); ?>">
		    		<img src="<?php echo site_url('contents/system/default_course.jpg'); ?>" class="responsive border-0 card-img-top mb-3" />
		    	</a>
			<?php endif; ?>
		    </div>
		    <div class="card-body">
		    	<div class="mb-5">
		    		<div class="card-title">
		    			<div class="d-sm-flex">
		    				<div class="flex-grow-1">
		    					<h5 class=""><?php echo $course['title']; ?></h5>
		    				</div>
		    				<div class="flex-shrink-0 pl-0 pl-sm-3">
		    					<p class="mb-1 text-muted text-small"><strong>Date:</strong> <?php echo date('j<\s\up>S</\s\up> F, Y', $course['created_on']); ?></p>
		    					<p class="mb-1 text-muted text-small"><strong>Author:</strong> <?php echo $course['created_by']; ?></p>
		    				</div>
		    			</div>
		    		</div>
		    		<div class="description d-flex flex-column flex-grow-1 flex-shrink-1">
			        	<?php
			        	echo ($course['description']!='')?
			        	$course['description']
			        	:
			        	'<p class="text-muted">No Description.</p>';
			        	?>
			        </div>
			    </div>
			    <?php if ($course['curriculum']!=null && $course['curriculum']!=''): ?>
			    <div class="mb-5">
			    	<h5 class="card-title">Curricullum</h5>
			    	<?php echo $course['curriculum']; ?>
			    </div>
				<?php endif; ?>
			</div>
		</div>
		<div class="card mb-4">
			<div class="card-body">
				<div class="d-flex mb-3">
            		<div class="flex-grow-1 my-auto">
            			<h5 class="card-title text-primary mb-0">Schedule</h5>
            		</div>
	            	<div class="flex-shrink-0 my-auto">
	            		<h5 class="card-title text-primary mb-0">
	            			<span class="d-inline-block position-relative">
	            				<i class="iconsminds-calendar-1 fa-2x"></i>
	            			</span>
	            		</h5>
	            	</div>
            	</div>
                <div class="separator mb-5"></div>
                <div class="scroll" style="height: 270px;">
                	Schedule Content Goes Here;
                </div>
            </div>
        </div>
	</div>
	<div class="col-12 col-md-12 col-xl-4 col-right">
		<?php if ($course['in_my_course']): ?>
			<div class="mb-4">
				<div class="card progress-banner h-auto" style="cursor:default;">
					<div class="card-body">
						<h5 class="card-title text-white mb-3">Course Progress</h5>
						<div class="row justify-content-center">
							<div class="col-6">
								<div role="progressbar" class="progress-bar-circle progress-bar-banner mx-auto mb-4 position-relative" data-color="#5b87ac" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="<?php echo $progress['total_progress']; ?>" aria-valuemax="<?php echo $progress['total_pages']; ?>" data-show-percent="true"></div>
							</div>
						</div>
		            </div>
		        </div>
		        <div class="card">
		        	<div class="card-footer text-center">
		        		<?php if ($progress['total_progress'] > 0 ): ?>
		            	<a class="btn btn-outline-secondary" href="<?php echo site_url('student/courses/continue/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>">
		            		<i class="simple-icon-control-play align-middle"></i><span class="ml-2 align-middle">Continue</span>
						</a>
						<?php else: ?>
						<a class="btn btn-outline-primary" href="<?php echo site_url('student/courses/begin/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>">
		            		<i class="simple-icon-control-play align-middle"></i><span class="ml-2 align-middle">Begin</span>
						</a>
						<?php endif;?>
		            </div>
		        </div>
			</div>
        <?php else : ?>
        	<div class="card mb-4">
        		<div class="card-body">
        			<div class="d-flex mb-3">
	            		<div class="flex-grow-1 my-auto">
	            			<h5 class="card-title text-primary mb-0">Purchase Course</h5>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-add-cart fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            	</div>
	            	<div class="separator mb-3"></div>
	            	<div class="d-flex">
	            		<div class="flex-grow-1 my-auto">
	            			<h3 class="mb-0"><strong class="mr-1">Price: &#8377;</strong><?php echo $course['price']; ?></h3>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<a class="btn btn-outline-secondary shadow-sm" href="<?php echo site_url('student/courses_actions/buy_course/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>">Buy Now</a>
	            		</div>
	            	</div>
        		</div>
        	</div>
        <?php endif; ?>
		<?php if ( ! empty ($lessons)): ?>
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Chapters</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($lessons); ?></small>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-books fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php foreach ($lessons as $i => $row): ?>
							<div class="d-flex pb-3">
								<div class="flex-grow-1 pr-3 my-auto">
									<h3 class="d-flex mb-0">
										<strong class="flex-grow-1 my-auto">Chapter <?php echo $i + 1; ?></strong>
										<strong class="flex-shrink-0 my-auto"><?php echo ($row['progress'])?'<i class="fas fa-check text-primary align-middle"></i>':''; ?></strong>
									</h3>
								</div>
								<div class="flex-shrink-0 my-auto">
									<a href="<?php echo site_url ('student/courses/content/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View <i class="fa fa-eye"></i></a>
								</div>
							</div>
							<div class="separator mb-3"></div>
						<?php endforeach; ?>
	                </div>
	            </div>
	        </div>
		<?php endif; ?>
		<?php if ( ! empty ($tests)): ?>
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Tests</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($tests); ?></small>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-puzzle fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php foreach ($tests as $i => $row): extract($row); ?>
							<div class="d-flex pb-3">
								<div class="flex-grow-1 my-auto">
									<h3 class="mb-0"><a href="<?php echo site_url('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$test_id); ?>"><?php echo $title; ?></a></h3>
								</div>
								<div class="flex-shrink-0 my-auto">
									<span><?php echo "$time_min Min"; ?></span>
								</div>
							</div>
							<div class="separator mb-3"></div>
						<?php endforeach; ?>
	                </div>
	            </div>
	            <div class="card-footer text-center">
	            	<a href="<?php echo site_url('student/tests/index/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>" class="btn btn-outline-primary">Show All</a>
	            </div>
	        </div>
		<?php endif; ?>
		<?php if ( ! empty ($teachers)): ?>
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Teachers</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($teachers); ?></small>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-male-female fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php foreach ($teachers as $i => $row): extract($row); ?>
							<div class="d-flex pb-3">
								<div class="flex-grow-1 my-auto">
									<h3 class="mb-0"><strong><?php echo "$first_name $last_name"; ?></strong></h3>
								</div>
								<div class="flex-shrink-0 my-auto">
									<?php if($email != '' ): ?>
									<a href="<?php echo "mailto:$email"; ?>" class="btn btn-outline-primary mr-2 icon-button"><i class="iconsminds-mail"></i></a>
									<?php endif; ?>
									<?php if($primary_contact != '' ): ?>
									<a href="<?php echo "tel:$primary_contact"; ?>" class="btn btn-xs btn-outline-secondary icon-button"><i class="simple-icon-phone"></i></a>
									<?php endif; ?>
								</div>
							</div>
							<div class="separator mb-3"></div>
						<?php endforeach; ?>
	                </div>
	            </div>
	        </div>
		<?php endif; ?>
	</div>
</div>