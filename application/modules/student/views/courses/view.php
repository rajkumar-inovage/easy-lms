<?php if(!empty($course) && ($lesson_id == 0) ): ?>
<div class="card mb-3">
	<div class="card-body">
		<h5 class="card-title"><?php echo $course['title']; ?></h5>
		<div class="row">
			<div class="col-12 col-sm order-2 order-sm-1 text-justify">
				<div class="d-flex flex-column h-100">
					<div class="description">
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
							<div class="col-12">
								<h1 class="mb-3"><strong>Price: &#8377;</strong><?php echo $course['price']; ?></h1>
							</div>
							<div class="col">
								<a class="btn btn-info shadow-sm mt-3" href="<?php echo site_url('student/courses_actions/buy_course/'.$coaching_id.'/'.$member_id.'/'.$course_id); ?>">Buy Now <i class="fa fa-shopping-cart"></i>
								</a>
							</div>
							<?php endif; ?>
							<div class="col">
								<a class="btn btn-info shadow-sm mt-3" href="">View Chapters <i class="fa fa-eye"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if($course['feat_img']!=''): ?>
			<div class="col-12 col-sm order-1 order-sm-2">
				<img src="<?php echo site_url( $course['feat_img'] ); ?>" class="img-fluid" />
			</div>
			<?php else: ?>
			<div class="col-12 col-sm order-1 order-sm-2">
				<img src="<?php echo site_url('contents/system/default_course.jpg'); ?>" class="img-fluid" />
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php
if ($page_id > 0) {
	?>
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
	<?php
} else if ($lesson_id > 0) {
	?>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title"><?php echo $lesson['title']; ?></h5>
			<?php echo $lesson['description']; ?>
		</div>
	</div>

	<div class="mt-4">
		<?php 
		$i = 1;
		if ( ! empty ($pages)) { 
			foreach ($pages as $row) { 
				?>
					<div class="card mb-2">
						<div class="card-body position-relative">
							<div class="d-flex">
								<div class="flex-shrink-0"><?php echo $i; ?></div>
								<div class="flex-grow-1 ml-2">
				                  	<a class="stretched-link" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>">
										<?php echo $row['title']; ?>
									</a>
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
	<?php
} else {
	if ( ! empty ($lessons)) { 
		foreach ($lessons as $i => $row) { 
			?>
			<div class="card mb-3 shadow-sm">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<strong class="text-muted">Chapter <?php echo $i + 1; ?></strong>
							<h4><?php echo $row['title']; ?></h4>
						</div>
						<div class="flex-shrink-0 my-auto">
							<a href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View Chapter <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
?>