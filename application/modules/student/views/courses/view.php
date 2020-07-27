<?php if(!empty($course) && ($lesson_id == 0) ): ?>
<div class="card mb-3">
	<div class="card-header">
		<h4 class="card-title mb-0"><?php echo $course['title']; ?></h4>
	</div>
	<div class="card-body">
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
								<a class="btn btn-info shadow-sm mt-3" href="">Buy Now <i class="fa fa-shopping-cart"></i>
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
		<div class="card-header">
			<div class="media">
				<div class="media-body">
					<h4><?php echo $lesson['title']; ?></h4>
				</div>
				<div class="media-right">
					<a href="#" id="toggle_sidebar_right" class="btn btn-xs"><i class="fa fa-book"></i></a>
				</div>
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
							<a href="<?php echo $att['att_url']; ?>" target="_blank"><?php echo $att['title']; ?></a>
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
		<div class="card-header">
			<div class="media">
				<div class="media-body">
					<h4><?php echo $lesson['title']; ?></h4>
				</div>
				<div class="media-right">
					<a href="#" id="toggle_sidebar_right" class="btn btn-xs"><i class="fa fa-book"></i></a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<?php echo $lesson['description']; ?>
		</div>
	</div>

	<div class="mt-4 px-2">		
		<!--<ul class="list-group list-group-minimal" >-->
			<?php 
			$i = 1;
			if ( ! empty ($pages)) { 
				foreach ($pages as $row) { 
					?>
					<div class="media">
						<div class="media-left"><?php echo $i; ?></div>
						<div class="media-body">							

		                  	<a class="" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>" >
								<?php echo $row['title']; ?>
							</a>
						</div>
						<div class="collapse" id="page<?php echo $row['page_id']; ?>">
						</div>						
					</div>
					<?php 
					$i++; 
				} 
			} else {
				?>
				<li class="list-group-item ">
					<span class="text-danger">No page found</span>
				</li>
				<?php
			}
			?>
		<!--</ul>-->
	</div>
	<?php
} else {
	if ( ! empty ($lessons)) { 
		foreach ($lessons as $i => $row) { 
			?>
			<div class="card mb-3 shadow-sm">
				<div class="card-body">
					<strong class="text-muted">Chapter <?php echo $i + 1; ?></strong>
					<h4><?php echo $row['title']; ?></h4>

					<a href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View Chapter <i class="fa fa-arrow-right"></i></a>

				</div>
				<div class="card-body">
				</div>
			</div>
			<?php
		}
	}
}
?>