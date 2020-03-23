	<div class="card card-default paper-shadow" data-z="0.5">
		  <div class="card-header">
				<h4 class="">Tests Taken</h4>
		  </div>
		  <ul class="list-group">
			<?php
			$i = 0;
			if ( ! empty ($test_taken)) {
				foreach ($test_taken as $row) {
					$attempted  = $this->tests_model->get_attempts ($member_id, $row['test_id']); 
					if ( ! empty ($attempted)) {
						// This will calculate the marks obtained in latest attempt by the user (first item in the array)
						$j = 1;		// Used to count first row 
						$marks = array ();
						$obtained_marks = 0;
						$pass_marks = 0;
						$latest_marks = 0;
						$attempt_id = 0;
						foreach ($attempted as $atm) {
							$ob = $this->tests_reports->calculate_obtained_marks ($row['test_id'], $atm['id'], $member_id);
							$marks[$i] = $ob;
							if ($j == 1) {
								$latest_marks = $ob;
								$attempt_id = $atm['id'];
							}
							$j++;
							$i++;
						}
						$obtained_marks = max ($marks);

						$test_marks = $this->tests_model->getTestquestionMarks ($coaching_id,$row['test_id']);

						$i++;
						?>
						<li class="list-group-item media v-middle">
						  <div class="media-body">
							<h4 class="text-subhead margin-none">
							  <a href="<?php echo site_url('student/reports/all_reports/'.$coaching_id.'/'.$row['attempt_id'].'/'.$member_id.'/'.$row['test_id']); ?>" class="list-group-link"><?php echo $row['title']; ?></a>
							</h4>
							<div class="caption">
							  <span class="text-grey-500">Taken On:</span>
							  <span class="text-grey-900"><?php echo date('d M Y', $row['loggedon']); ?></span> | 
							  <span class="text-grey-500">Max marks:</span>
							  <span class="text-grey-900"><?php echo $obtained_marks.'/'.$test_marks['marks']; ?></span>
							</div>
							<p class="_btn-group">
								<?php 
									echo anchor ('student/reports/test_report/'.$coaching_id.'/'.$member_id.'/'.$row['attempt_id'].'/'.$row['test_id'], 'Report', array ('class'=>'btn btn-danger btn-sm ')); 
									echo anchor ('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], 'Re-Take Test ', array('class'=>'btn btn-sm btn-primary ml-2'));
									// Report
								?>
							</p>
						  </div>
						  <div class="media-right text-center">
							<?php 
								$pass_marks = ($row['pass_marks'] * $test_marks['marks']) / 100;
								
								if ($obtained_marks < $pass_marks) {
									$result_class = 'text-danger';
									$result_text = 'Fail';
								} else {
									$result_class = 'text-success';
									$result_text = 'pass';
								}
							?>
							<div class="text-display-1 <?php echo $result_class; ?>"><?php echo $latest_marks; ?></div>
							<span class="caption <?php echo $result_class; ?>"><?php echo $result_text; ?></span>
						  </div>
						</li>
						<?php
						}
					}
				}
				?>
			</ul>
			<?php 
			if ($i == 0) {
				?>
				<div class="card-body">
					<div class="alert alert-danger">
						<p>You have not taken any tests yet</p>
					</div>
				</div>
				<?php
			}
			?>
		</div> 
	</div> 
</div>