<style>p img{max-width: 100%;height: auto}</style>
<div class="row">
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
											<span class="badge badge-danger">YouTube</span>
										</div>
									</div>
									<?php $youtubeURL = getYoutubeEmbedUrl($att['att_url']); ?>
									<?php if ($youtubeURL !== null): ?>
									<iframe class="w-auto" src="<?php echo $youtubeURL; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									<?php else : ?>
									<div class="alert alert-info">Invalid YouTube URL.</div>
									<?php endif; ?>
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
			<?php $i=0;?>
			<?php if ( ! empty ($pages)): ?>
				<h3 class="mb-3">Pages</h3>
				<?php foreach ($pages as $row): $i += 1;?>
						<div class="card mb-2">
							<div class="card-body position-relative">
								<div class="d-flex">
									<div class="flex-shrink-0  my-auto"><?php echo $i; ?></div>
									<div class="flex-grow-1 ml-2  my-auto">
					                  	<a class="stretched-link" href="<?php echo site_url ('student/courses/content/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>">
											<?php echo $row['title']; ?>
										</a>
									</div>
									<div class="flex-shrink-0 my-auto">
										<strong><?php echo ($row['progress'])?'<i class="fas fa-check text-primary"></i>':''; ?></strong>
									</div>
								</div>
							</div>
						</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="alert alert-info">No page added yet</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>