<div class="card card-default">
	<div class="card-footer border-top-0 border-bottom">
		<div class="d-flex justify-content-between text-center">			
			<p class="nav-link mb-0">
				<span class="badge bg-info rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['answered']; ?></span>
				<span class="display mt-4">Answered</span>
			</p>		
			<p class="nav-link mb-0">
				<span class="badge bg-success rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['correct']; ?></span>
				<span class="display mt-4">Correct</span>
			</p>		
			<p class="nav-link mb-0">
				<span class="badge bg-danger rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['wrong']; ?></span>
				<span class="display mt-4">Wrong</span>
			</p>		
			<p class="nav-link mb-0">
				<span class="badge bg-secondary rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['not_answered']; ?></span>
				<span class="display mt-4">Not Answered</span>
			</p>		
		</div>
	</div>
	<div class="card-bodys">
		<div class="table-responsive">
			<table class="table table-bordered mb-0">
				<thead>
					<tr>
						<th width="2%">#</th>  
						<th width="70%"><?php echo 'Questions'; ?></th>
						<th><?php echo 'Score'; ?></th>  
						<th><?php echo 'Response'; ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				if ( ! empty($response)) {
					foreach ($response as $type=>$row) {
						foreach ($row as $question) {					
							?>
							<tr>
								<td>
									<?php echo $i; ?>
								</td>
								<td>
									<?php echo $question['question']; ?>
								</td>
								<td>
									<?php 
									if ($type == TQ_CORRECT_ANSWERED) {
										echo $question['marks'].'/'.$question['marks'];
									} else if ($type == TQ_WRONG_ANSWERED) {
										echo '0/'.$question['marks'];
									} else {
										echo '0/'.$question['marks'];
									}
									?>
								</td>
								<td>
								<?php
									if ($type == TQ_CORRECT_ANSWERED) {
										echo '<span class="badge badge-success"><i class="fa fa-check fa-1x"></i></span>';
									} else if ($type == TQ_WRONG_ANSWERED) {
										echo '<span class="badge badge-danger"><i class="fa fa-times fa-1x"></i></span>';
									} else {
										echo '<span class="badge badge-light">Not Answered</span>';
									}
								?>
								</td>
							</tr>
							<?php
							$i++;
						}
					}
				} 
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>