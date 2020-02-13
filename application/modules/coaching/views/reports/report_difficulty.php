<div class="card">
<?php 
$i			   = 1;	
$right_answers = 0;
$wrong_answers = 0;
$not_answered  = 0;
$answered	   = 0;
$total  	   = 0;
if ( ! empty ($dif_response)) {
	foreach ($dif_response as $cat_title=>$data) {
		?>
		<div class="card-body">
			<h4><?php echo $cat_title; ?> </h4>
			<canvas id="chart_pie<?php echo $i; ?>" width="100%" ></canvas>
			<?php
				if (! empty ($data)) {
					foreach ($data as $type=>$questions) {
						if ($type == TQ_CORRECT_ANSWERED) { 
							$right_answers = $right_answers + 1;
						} 
						if ($type == TQ_WRONG_ANSWERED) { 
							$wrong_answers = $wrong_answers + 1;
						} 
						if ($type == TQ_NOT_ANSWERED) { 
							$not_answered = $not_answered + 1;
						} 
					}
				}
			?>
		</div>
		<div class="card-footer">
			<ul class="nav nav-pills nav-fill" id="tabs_2" >
				<li class="nav-item">
					<h4 class="nav-link mb-0">
						<span class="nav-link-icon d-block"> <?php echo $right_answers; ?></span>
						<span class="d-none d-sm-block mt-3">Correct Answers</span>
					</h4>
				</li>
				<li class="nav-item">
					<h4 class="nav-link mb-0">
						<span class="nav-link-icon d-block"> <?php echo $wrong_answers; ?></span>
						<span class="d-none d-sm-block mt-3">Wrong Answers</span>
					</h4>
				</li>
				<li class="nav-item">
					<h4 class="nav-link mb-0">
						<span class="nav-link-icon d-block"> <?php echo $not_answered; ?></span>
						<span class="d-none d-sm-block mt-3">Not Answered</span>
					</h4>
				</li>
			</ul>
		</div>
		<script>
			show_pie_chart (<?php echo $right_answers; ?>, <?php echo $wrong_answers; ?>, <?php echo $not_answered; ?>, 'chart_pie<?php echo $i; ?>');
		</script>

		<?php
		$i++;
	}
}
$answered = $right_answers + $wrong_answers;
?>
</div>