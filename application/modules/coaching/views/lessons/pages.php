
<h3><?php echo $lesson['title']; ?></h3>
			
<div class="row">
	<?php 
	$i = 1;
	if ( ! empty ($pages)) { 
		foreach ($pages as $row) { 
			?>
			<div class="col-12 col-lg-6 mb-5">
                <div class="card flex-row listing-card-container">                   
                    <div class="d-flex align-items-center">
                        <div class="card-body">
                            <a href="<?php echo site_url ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']); ?>">
                                <h5 class=" ellipsis"><?php echo $row['title']; ?></h5>
                            </a>
                            <p class=" text-muted ellipsis">
                                <?php 
	                                $content = strip_tags($row['content']);
                                	echo character_limiter ($content, 250); 
                                ?>
                            </p>
		                    <div class="mt-2">
								<div class="btn-group">
									<?php 
										echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id'], '<i class="fa fa-edit"></i>', ['class'=>'btn btn-primary btn-xs']);
									?>
									<?php 
										echo anchor ('coaching/lessons/view_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id'], '<i class="simple-icon-eye"></i>', ['class'=>'btn btn-info btn-xs']);
									?>
									<?php
									$msg = 'Delete this page?';
									$url = site_url ('coaching/lesson_actions/delete_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']);
									?>
									<a href="javascript: void ()" onclick="show_confirm ('<?php echo $msg; ?>', '<?php echo $url; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
								</div>
		                    </div>
                        </div>
                    </div>
                </div>				
			</div>
			<?php 
			$i++; 
		} 
	} else {
		?>
		<div class="col-12">
			<div class="alert alert-danger ">
				<span class="">No pages found</span>
			</div>
		</div>
		<?php
	}
	?>
</div>

<div class="row mb-2">
	<div class="col-12">
		<?php echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id, 'Add Page', ['class'=>'btn btn-primary btn-lg']); ?>
	</div>
</div>