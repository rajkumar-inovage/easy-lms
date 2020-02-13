<div class="card card-default">
	<div class="card-footer border-top-0 border-bottom">
		<ul class="nav nav-pills nav-fill">
			<li class="nav-item">
				<h4 class="nav-link mb-0">
					<span class="badge bg-info rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['answered']; ?></span>
					<span class="display mt-4">Answered</span>
				</h4>
			</li>
			<li class="nav-item">
				<h4 class="nav-link mb-0">
					<span class="badge bg-success rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['answered']; ?></span>
					<span class="display mt-4">Correct</span>
				</h4>
			</li>
			<li class="nav-item">
				<h4 class="nav-link mb-0">
					<span class="badge bg-danger rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['answered']; ?></span>
					<span class="display mt-4">Wrong</span>
				</h4>
			</li>
			<li class="nav-item">
				<h4 class="nav-link mb-0">
					<span class="badge bg-secondary rounded-circle text-white height-30 width-30 d-flex align-items-center justify-content-center mx-auto"><?php echo $brief['not_answered']; ?></span>
					<span class="display mt-4">Not Answered</span>
				</h4>
			</li>
		</ul>
	</div>
	<div class="card-body">
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
						foreach ($row as $questions) {					
							?>
							<tr>
								<td>
									<?php echo $i; ?>
								</td>
								<td>
									<?php echo $questions['question']; ?>
								</td>
								<td>
									<?php echo $questions['om']; ?>/<?php echo $questions['marks']; ?>
								</td>
								<td>
								<?php
									if ($type == TQ_CORRECT_ANSWERED) {
										echo '<span class="badge badge-success"><i class="fa fa-times fa-2x"></i></span>';
									} else if ($type == TQ_WRONG_ANSWERED) {
										echo '<span class="badge badge-danger"><i class="fa fa-times fa-2x"></i></span>';
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