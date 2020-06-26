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
					$enrolment = $this->tests_model->get_enrolment_details ($coaching_id, $row['test_id'], $member_id); 
					if ( ! empty ($attempted)) {
						// This will calculate the marks obtained in latest attempt by the user (first item in the array)						
						$j = 1;		// Used to count first row 
						$num_attempts = 0;
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
							$num_attempts++;
						}
						$obtained_marks = max ($marks);

						$test_marks = $this->tests_model->getTestquestionMarks ($coaching_id, $row['test_id']);

						$i++;
						?>
						<li class="list-group-item media v-middle">
						  <div class="media-body">
							<h4 class="text-subhead margin-none">
							  <?php echo $row['title']; ?>
							</h4>
							<div class="caption">
							  <span class="text-grey-500">Taken On:</span>
							  <span class="text-grey-500"><?php echo date('d M, Y H:i A', $row['loggedon']); ?></span> 
							</div>
							<p class="_btn-group">
								<?php 
								if ($enrolment['release_result'] == RELEASE_EXAM_IMMEDIATELY) {
									echo anchor ('student/reports/test_report/'.$coaching_id.'/'.$member_id.'/'.$row['attempt_id'].'/'.$row['test_id'], 'Report', array ('class'=>'btn btn-danger btn-sm '));
								}
								if ($enrolment['attempts'] == 0  || $num_attempts < $enrolment['attempts'] ) {
									echo anchor ('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], 'Re-Take Test ', array('class'=>'btn btn-sm btn-primary ml-2'));
								}
								?>
							</p>
							<?php 
							if ($enrolment['release_result'] == RELEASE_EXAM_IMMEDIATELY) {
								$pass_marks = ($row['pass_marks'] * $test_marks) / 100;
								
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
								<?php
							} else {
								echo '<span class="badge badge-danger">Result will be release later</span>';
							}
							?>
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