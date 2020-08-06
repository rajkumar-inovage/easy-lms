<div class="card">
	<div class="card-body">
		<div class="form-group">
			<p class="form-control-static"><?php echo $page['title']; ?></p>
		</div>

		<div class="form-group">
			<p class="form-control-static"><?php echo $page['content']; ?></p>
		</div>
		
		
		<div class="form-group row mb-1">
            <div class="col-12">
            	<?php if ($page['status'] == 1) { ?>
	                <span class="badge badge-pill badge-primary">Published</span>
				<?php } else { ?>
	                <span class="badge badge-pill badge-light">Un-Published</span>						
				<?php } ?>
            </div>
        </div>

	</div>

	<div class="card-body">
        <?php
		if (! empty ($attachments)) {
			foreach ($attachments as $att) {
				?>
				<div class="d-flex flex-row mb-3 border-bottom justify-content-between">
					<span class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                    <?php
						if ($att['att_type'] == LESSON_ATT_YOUTUBE) { 
							echo '<i class="text-danger fab fa-youtube "></i>';
						} else if ($att['att_type'] == LESSON_ATT_EXTERNAL) { 
							echo '<i class="fa fa-link "></i>';
						} else {
							echo '<i class="fa fa-file "></i>';
						}
					?>
					</span>
                    <div class="pl-3 flex-grow-1">
                    	<?php if ($att['att_type'] == LESSON_ATT_YOUTUBE) { ?>
                    		<h3 class="mb-2 flex-grow-1"><?php echo $att['title']; ?></h3>
                    		<?php $youtubeURL = getYoutubeEmbedUrl($att['att_url']); ?>
							<?php if ($youtubeURL !== null): ?>
							<iframe class="w-100" src="<?php echo $youtubeURL; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php else : ?>
							<div class="alert alert-info">Invalid YouTube URL.</div>
							<?php endif; ?>
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
                </div>
				<?php
			}
		}
		?>
	</div>
	
</div>