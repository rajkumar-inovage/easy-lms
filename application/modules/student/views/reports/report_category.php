<div class="card">
	<?php 
	$i			   = 1;	
	$right_answers = 0;
	$wrong_answers = 0;
	$not_answered  = 0;
	$answered	   = 0;
	$total  	   = 0;
	if ( ! empty ($cat_response)) {
		foreach ($cat_response as $cat_title=>$data) {
			?>
			<div class="card-header">
				<h4><?php echo $cat_title; ?> </h4>
			</div>
			<div class="card-body">
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
				<div class="d-flex justify-content-between text-center">
					<p class="nav-link mb-0">
						<span class="badge bg-success rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $right_answers; ?></span>
						<span class="d-none d-sm-block mt-3">Correct Answers</span>
					</p>
					<p class="nav-link mb-0">
						<span class="badge bg-danger rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $wrong_answers; ?></span>
						<span class="d-none d-sm-block mt-3">Wrong Answers</span>
					</p>
					<p class="nav-link mb-0">
						<span class="badge bg-secondary rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $not_answered; ?></span>
						<span class="d-none d-sm-block mt-3">Not Answered</span>
					</p>
				</div>
			</div>
			<?php
		$i++;
	}
}
$answered = $right_answers + $wrong_answers;
?>
</div>