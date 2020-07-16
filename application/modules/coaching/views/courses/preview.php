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
		<ul class="list-unstyled">
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
	
	</div>
	<?php
} else if ($lesson_id > 0) {
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
			<?php echo $lesson['description']; ?>
		</div>

		<ul class="list-group" >
			<?php 
			$i = 1;
			if ( ! empty ($pages)) { 
				foreach ($pages as $row) { 
					?>
					<li class="list-group-item media">
						<div class="media-left"><?php echo $i; ?></div>
						<div class="media-body">							

		                  	<a class="" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>" >
								<?php echo $row['title']; ?>
							</a>
						</div>
						<div class="collapse" id="page<?php echo $row['page_id']; ?>">
						</div>
						
					</li>
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
		</ul>
	</div>
	<?php
} else {

	$i = 1;
	if ( ! empty ($lessons)) { 
		foreach ($lessons as $row) { 
			?>
			<div class="card mb-3 shadow-sm">
				<div class="card-body">
					<strong class="text-muted">Chapter <?php echo $i; ?></strong>
					<h4><?php echo $row['title']; ?></h4>

					<a href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View Chapter <i class="fa fa-arrow-right"></i></a>

				</div>
				<div class="card-body">
				</div>
			</div>
			<?php
			$i++;
		}
	}
}
?>