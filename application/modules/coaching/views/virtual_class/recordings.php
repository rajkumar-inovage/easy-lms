<div class="card">
	<ul class="list-group">
	<?php
	$i = 0;
	if ($response == 'SUCCESS') {
		foreach ($recordings->recording as $recording) {
			$i++;
			$start_time = $recording->startTime;
			$end_time = $recording->endTime;
			$url = $recording->playback->format->url;
			?>
			<li class="list-group-item media">
				<div class="media-left">
					<span class="icon-block half rounded-circle ">
						<i class="fa fa-play"></i>
					</span>
				</div>
				<div class="media-body">
					<a href="<?php echo $url; ?>" target="_blank">Recording <?php echo $i; ?></a>
					<p><?php //$start_time =  intdiv($start_time, 1000); ?></p>
					<p><?php //echo date ('d M, Y', $start_time); ?></p>
				</div>

			</li>
			<?php
		}
	} 
	if ($i == 0) {
		?>
		<li class="list-group-item text-danger">No rcordings found</li>
		<?php
	}
	?>
	</ul>
</div>