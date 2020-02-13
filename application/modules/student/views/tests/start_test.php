<div class="mb-4">
	<div class="row">
		<div class="col-md-9">
			<div class="card mb-4 mobile-timer">
		        <?php $this->load->view ('tests/ajax/start_test_mob', $data);	?>
		    </div>
			<?php 
			echo form_open_multipart('student/tests_actions/submit_test/'.$coaching_id.'/'.$member_id.'/'.$category_id.'/'.$test_id, array('id'=>'test_form', 'name'=>'forms', 'enctype'=>'multipart/form-data', 'class' => 'h-100') ); 

			if ( ! empty ($all_questions)) {
				$count_tabs = 1;
				$num_question = 0;
				$num_heading  = 0;
				
				foreach ( $all_questions as $subject_id=>$question_group ) {
					//shuffle ($question_group);
					foreach ($question_group as $group_id=>$questions) {
						$heading = $this->qb_model->getQuestionDetails ($group_id);
						$num_heading++;
						foreach ($questions as $question_id) {
							
							// Get question details
							$row_items = $this->qb_model->getQuestionDetails ($question_id );
							
							$num_question++;
							?>
							<div style="display: none" id="page<?php echo $num_question; ?>" class="pages page<?php echo $num_question; ?> h-100" >
				
								<div class="card card-default paper-shadow h-100">
									<div class="card-body overflow-auto max-height-460">
								        <div class="text-subhead-2 ">Question <?php echo $num_question; ?> of <?php echo $total_questions; ?></div>
								        <div class="row">
											<div class="col-md-12">
												<?php echo $heading['question']; ?>
												<?php echo $row_items['question']; ?>
												<?php
													$data['num'] = $num_question; 
													$data['row'] = $row_items; 
													$this->load->view (INCLUDE_PATH . 'answer_choices', $data);
												?> 
											</div>
										</div>
									</div>

									<div class="card-footer">
										<div class="media">
											<div class="media-left">
												<input type="submit" name="submitBtn" value="Submit Test" class="btn btn-success " >
											</div>
											<div class="media-body"></div>
											<div class="media-right">
												<button type="button" class="btn btn-primary next pull-right">Save & Next <i class="fa fa-arrow-right"></i> </button>
											</div>
										</div>
									</div>	<!-- /panel-footer -->

								</div>
								<?php if (isset($sidebar)) { ?>
									<div class="right-sidebar-mob right sidebar-size-3 sidebar-offset-0 sidebar-visible-desktop sidebar-skin-white" id="sidebar-library">
										<?php //echo $sidebar; ?>
									</div>
								<?php } ?>
							</div>
							<?php 
						} // end foreach question_id
					} // end foreach question
					$count_tabs++;
				}
			}
			$confirm_div = $total_questions + 1;
			?> 
			<div style="display: none" id="page<?php echo $confirm_div; ?>" class="pages h-100 end page<?php echo $confirm_div; ?>" >
			<div class="row h-100 justify-content-center">
				<div class="col-md-8 align-self-center">
						<div class="card card-primary paper-shadow">
							<div class="card-header">
								<h4>Test Complete</h4>
							</div>
							<div class="card-body">
								<p>This is the end of the test. You can review your questions or sumbit the test.</p>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-left">
										<input type="submit" name="submitBtn" value="Submit Test" class="btn btn-success">
									</div>
									<div class="media-body"></div>
									<div class="media-right">
										<button type="button" class="btn btn-light" onclick="show_first ();">REVIEW TEST</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="num_question" value="1">
			<input type="hidden" id="num-answered" value="0">
			<input type="hidden" id="num-not-answered" value="0">
			<input type="hidden" id="num-for-review" value="0">
			<input type="hidden" id="num-not-visited" value="0">
			<input type="hidden" id="attempt_id" name="attempt_id" value="<?php echo $attempt_id; ?>">
			<?php echo form_close(); ?>
		</div>

		<div class="col-md-3">
			<?php $this->load->view ('tests/ajax/start_test', $data);	?>
		</div>
	</div>
</div>

<?php 
//FUNCTION FOR SHUFFLE THE OPTION OF QUESTION 
function shuffle_assoc($list) { 
	if (!is_array($list)) {
		return $list; 
	}
	$keys = array_keys($list); 
	shuffle($keys); 
	$random = array(); 
	foreach ($keys as $key) { 
		$random[$key] = $list[$key]; 
	}
	return $random; 
}
?>