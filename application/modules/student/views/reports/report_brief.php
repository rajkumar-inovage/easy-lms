<div class="card card-default">	
	<div class="card-body">
		<div class="row">
			<div class="col-md-9">
				<canvas id="pieChart" width="100%" ></canvas>
			</div>
			<div class="col-md-3 align-self-center">
				<div class="progress-stats">
					<span class="title"><i class="icon-puzzle-piece"></i> Correct <span> <?php echo $brief['correct'].'/'.$num_questions; ?></span></span>
					<div class="progress height-10">
						<?php $correct_pc = ($brief['correct']/$num_questions) * 100; ?>
						<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: <?php echo round ($correct_pc); ?>%;"></div>
					</div>
				</div>
				<div class="progress-stats">
					<span class="title"> Wrong <span><?php echo $brief['wrong'].'/'.$num_questions; ?></span></span>
					<div class="progress height-10">
						<?php $wrong_pc = ($brief['wrong']/$num_questions) * 100; ?>
						<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width: <?php echo round ($wrong_pc); ?>%;"></div>
					</div>
				</div>
				<div class="progress-stats">
					<span class="title"><i class="icon-cloud"></i> Not Answered <span><?php echo $brief['not_answered'].'/'.$num_questions; ?></span></span>
					<div class="progress height-10">
						<?php $na_pc = ($brief['not_answered']/$num_questions) * 100; ?>
						<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width: <?php echo round ($na_pc); ?>%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-between text-center">
			<p class="nav-link mb-0">
				<?php 
				if ($brief['ob_perc'] >= $test['pass_marks']) {
					echo '<span class="badge bg-primary rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> Pass</span>';
				} else {
					echo '<span class="badge bg-danger rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto text-white"> Fail</span>';
				}
				?>
				<span class="d-block mt-2">Result</span>
			</p> 
			<p class="nav-link mb-0">
				<span class="badge bg-info rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $ob_marks[$attempt_id]['obtained']; ?></span>
				<span class="d-block mt-2">Score</span>
			</p>
			<p class="nav-link mb-0">
				<span class="badge bg-secondary rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $brief['accuracy']; ?></span>
				<span class="d-block mt-2">Accuracy</span>
			</p>
		</div> 
	</div>
</div>
