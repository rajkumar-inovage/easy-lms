<?php 
if ($lesson_id > 0) {
	?>
	<div class="card">
		<ul class="list-group" >
			<li class="list-group-item media">
				<div class="media-left">
				</div>

				<div class="media-body">
					<h4><?php echo $lesson['title']; ?></h4>
				</div>
			</li>
			<?php 
			$i = 1;
			if ( ! empty ($pages)) { 
				foreach ($pages as $row) { 
					?>
					<li class="list-group-item media">
						<div class="media-left"><?php echo $i; ?></div>
						<div class="media-body">							

							<a data-toggle="collapse" href="#page<?php echo $row['page_id']; ?>" role="button" aria-expanded="false" aria-controls="page<?php echo $row['page_id']; ?>" class="link-text-color ">
								<?php echo $row['title']; ?>
							</a>
						</div>
						<div class="collapse" id="page<?php echo $row['page_id']; ?>">
							<?php echo $row['content']; ?>
							<ul class="list-unstyled">
							<?php
							$attachments = $row['att'];
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
					<strong class="text-muted">Lesson <?php echo $i; ?></strong>
					<h4><?php echo $row['title']; ?></h4>

					<a href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$row['lesson_id']); ?>" class="btn btn-outline-primary border-primary shadow-sm float-right">View Lesson <i class="fa fa-arrow-right"></i></a>

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