<div class="card mb-4">

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
						<a data-toggle="collapse" href="#page<?php echo $row['page_id']; ?>" role="button" aria-expanded="false" aria-controls="page<?php echo $row['page_id']; ?>">
							<?php echo $row['title']; ?>
						</a>
						<div class="collapse" id="page<?php echo $row['page_id']; ?>">
						    <?php echo $row['content']; ?>
						</div>
						<?php 
						?>
					</div>
					<div class="media-right">
						<div class="btn-group">
							<?php 
								echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id'], '<i class="fa fa-edit"></i>', ['class'=>'btn btn-default btn-xs']);
							?>
							<?php
							$msg = 'Delete this page?';
							$url = site_url ('coaching/lesson_actions/delete_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$row['page_id']);
							?>
							<a href="javascript: void ()" onclick="show_confirm ('<?php echo $msg; ?>', '<?php echo $url; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</div>
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
	<div class="card-footer">
		<?php echo anchor ('coaching/lessons/add_page/'.$coaching_id.'/'.$course_id.'/'.$lesson_id, 'Add Page', ['class'=>'btn btn-success']); ?>
	</div>
</div>