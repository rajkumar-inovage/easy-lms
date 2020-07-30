<div class="row">
	<?php if(!empty($course) && ($lesson_id == 0) ): ?>
	<div class="col-12">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-sm order-2 order-sm-1 text-justify">
						<div class="d-flex flex-column overflow-hidden h-100">
							<div class="info">
								<div class="d-flex mb-3">
									<div class="flex-grow-1">
										<p class="mb-0 text-muted text-small"><strong>Date:</strong> <?php echo date('j<\s\up>S</\s\up> F, Y', $course['created_on']); ?></p>
									</div>
									<div class="flex-sm-grow-1 px-0 px-sm-3">
										<p class="mb-0 text-muted text-small"><strong>Author:</strong> <?php echo $course['created_by']; ?></p>
									</div>
									<div class="d-none d-sm-block flex-shrink-0 px-0 px-sm-3">
										<p class="mb-0 text-muted text-small"><strong>Lessons:</strong> <?php echo count($lessons); ?></p>
									</div>
									<div class="d-none d-sm-block flex-shrink-0">
										<p class="mb-0 text-muted text-small"><strong>Tests:</strong> <?php echo count($tests); ?></p>
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
							<div class="mt-auto text-center">
								<div class="row">
									<?php if(!$course['in_my_course']):?>
									<div class="col my-auto">
										<h3 class="mb-0"><strong>Price: &#8377;</strong><?php echo $course['price']; ?></h3>
									</div>
									<div class="col my-auto">
										<a class="btn btn-info shadow-sm" href="<?php echo site_url('student/courses_actions/buy_course/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>">Buy Now <i class="fa fa-shopping-cart"></i>
										</a>
									</div>
									<?php else: ?>
									<div class="col">
										<?php echo anchor ('', 'Continue Reading', ['class'=>'btn btn-info shadow-sm']); ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php if($course['feat_img']!=''): ?>
					<div class="col-12 col-sm order-1 order-sm-2">
						<img src="<?php echo site_url( $course['feat_img'] ); ?>" class="img-fluid mb-3 mb-sm-0" />
					</div>
					<?php else: ?>
					<div class="col-12 col-sm order-1 order-sm-2">
						<img src="<?php echo site_url('contents/system/default_course.jpg'); ?>" class="img-fluid mb-3 mb-sm-0" />
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($page_id > 0):?>
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title"><?php echo $lesson['title']; ?></h3>
				<h6><?php echo $page['title']; ?></h6>
				<?php echo $page['content']; ?>
				<?php if (! empty ($attachments)): ?>
				<div class="attachments-area">
					<h2 class="mb-2">Attachments</h2>
					<?php
						foreach ($attachments as $att) {
							?>
							<div class="d-flex flex-column mb-3 pb-3 border-bottom">
								<?php if ($att['att_type'] == LESSON_ATT_YOUTUBE): ?>
									<div class="d-flex">
										<h3 class="mb-2 flex-grow-1"><?php echo $att['title']; ?></h3>
										<div class="flex-shrink-0 my-auto">
											<span class="badge badge-danger">Youtube</span>
										</div>
									</div>
									<iframe class="w-auto" src="<?php echo getYoutubeEmbedUrl($att['att_url']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<?php elseif ($att['att_type'] == LESSON_ATT_EXTERNAL): ?>
									<div class="d-flex">
										<div class="flex-grow-1">
											<h3 class="mb-2"><?php echo $att['title']; ?></h3>
											<a href="<?php echo $att['att_url']; ?>" target="_blank" class="flex-shrink-0 btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="Click to Open"><i class="simple-icon-eye"></i> Open</a>
										</div>
										<div class="flex-shrink-0 my-auto">
											<span class="badge badge-primary">External link</span>
										</div>
									</div>
								<?php else: ?>
									<div class="d-flex">
										<div class="flex-grow-1">
											<h3 class="mb-2"><?php echo $att['title']; ?></h3>
											<a href="<?php echo $att['att_url']; ?>" download class="flex-shrink-0 btn btn-outline-secondary" data-toggle="tooltip" data-placement="right" title="Click to Download"><i class="iconsminds-data-download"></i> Download</a>
										</div>
										<div class="flex-shrink-0 my-auto">
											<span class="badge badge-secondary">File</span>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<?php
						}
					?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php elseif ($lesson_id > 0) : ?>
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?php echo $lesson['title']; ?></h5>
				<?php echo $lesson['description']; ?>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="mt-4">
			<?php 
			$i = 1;
			if ( ! empty ($pages)) { 
				foreach ($pages as $row) { 
					?>
						<div class="card mb-2">
							<div class="card-body position-relative">
								<div class="d-flex">
									<div class="flex-shrink-0  my-auto"><?php echo $i; ?></div>
									<div class="flex-grow-1 ml-2  my-auto">
					                  	<a class="stretched-link" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>">
											<?php echo $row['title']; ?>
										</a>
									</div>
									<div class="flex-shrink-0 my-auto">
										<strong><?php echo ($row['progress'])?'<i class="fas fa-check-double text-primary"></i>':'<i class="fas fa-check text-muted"></i>'; ?></strong>
									</div>
								</div>
							</div>
						</div>
					<?php 
					$i++; 
				} 
			} else {
			?>
				<div class="alert alert-info">No page added yet</div>
			<?php
			}
			?>
		</div>
	</div>
	<?php else :?>
		<?php if ($course['curriculum']!=null && $course['curriculum']!=''): ?>
		<div class="col-sm-6">
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-file fa-2x"></i>
			                		<i class="iconsminds-student-male fa-xs" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);"></i>
			                	</span>
			                </h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<h5 class="card-title text-primary mb-0">Curricullum</h5>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php echo $course['curriculum']; ?>
	                </div>
	            </div>
	        </div>
		</div>
		<?php endif; ?>
		<div class="col-sm-6">
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-calendar-1 fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<h5 class="card-title text-primary mb-0">Schedule</h5>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                </div>
	            </div>
	        </div>
		</div>
		<?php if ( ! empty ($lessons)): ?>
		<div class="col-sm-6">
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-books fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Chapters</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($lessons); ?></small>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php foreach ($lessons as $i => $row): ?>
							<div class="d-flex pb-3">
								<div class="flex-shrink-0 my-auto">
									<strong><?php echo ($row['progress'])?'<i class="fas fa-check-double text-primary"></i>':'<i class="fas fa-check text-muted"></i>'; ?></strong>
								</div>
								<div class="flex-grow-1 px-3 my-auto">
									<h3 class="mb-0"><strong class="text-muted">Chapter <?php echo $i + 1; ?></strong></h3>
									<h4 class="d-none"><?php echo $row['title']; ?></h4>
								</div>
								<div class="flex-shrink-0 my-auto">
									<a href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View <i class="fa fa-eye"></i></a>
								</div>
							</div>
							<div class="separator mb-3"></div>
						<?php endforeach; ?>
	                </div>
	            </div>
	        </div>
		</div>
		<?php endif; ?>
		<?php if ( ! empty ($tests)): ?>
		<div class="col-sm-6">
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-puzzle fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Practice Tests</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($tests); ?></small>
	            		</div>
	            	</div>
	                <div class="separator mb-5"></div>
	                <div class="scroll" style="height: 270px;">
	                	<?php foreach ($tests as $i => $row): extract($row); ?>
							<div class="d-flex pb-3">
								<div class="flex-grow-1 my-auto">
									<h3 class="mb-0"><a href="#"><?php echo $title; ?></a></h3>
								</div>
								<div class="flex-shrink-0 my-auto">
									<span><?php echo "$time_min Min"; ?></span>
								</div>
							</div>
							<div class="separator mb-3"></div>
						<?php endforeach; ?>
	                </div>
	            </div>
	        </div>
		</div>
		<?php endif; ?>
		<?php if ( ! empty ($teachers)): ?>
		<div class="col-sm-6">
			<div class="card mb-4">
	            <div class="card-body">
	            	<div class="d-flex mb-3">
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">
			                	<span class="d-inline-block position-relative">
			                		<i class="iconsminds-male-female fa-2x"></i>
			                	</span>
			                </h5>
	            		</div>
	            		<div class="flex-shrink-0 my-auto">
	            			<h5 class="card-title text-primary mb-0">Teachers</h5>
	            		</div>
	            		<div class="flex-grow-1 my-auto">
	            			<small class="badge badge-primary ml-1"><?php echo count($teachers); ?></small>
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
		</div>
		<?php endif; ?>
	<?php endif; ?>
</div>