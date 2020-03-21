<div class="row">
	<div class="col-md-9">
		<?php 
		echo form_open_multipart('student/tests_actions/submit_test/'.$coaching_id.'/'.$member_id.'/'.$test_id, array('id'=>'test_form', 'name'=>'forms', 'enctype'=>'multipart/form-data', 'class' => 'h-100') ); 
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
							<div style="display: none" id="page<?php echo $num_question; ?>" class="pages page<?php echo $num_question; ?> " >
				
								<div class="card card-default paper-shadow ">
									<div class="card-header">
										<h4>Question <?php echo $num_question; ?> of <?php echo $total_questions; ?></h4>
									</div>
									<div class="card-body ">
										<?php echo $heading['question']; ?>
										<?php echo $row_items['question']; ?>
										<?php
											$data['num'] = $num_question; 
											$data['row'] = $row_items; 
											$this->load->view ('include/answer_choices', $data);
										?> 
									</div>

									<div class="card-footer bg-white d-flex justify-content-between fixed-bottom">
										<input type="submit" name="submitBtn" value="Submit Test" class="btn btn-success btn-sm" >
										<button type="button" class="btn btn-primary btn-sm previous"><i class="fa fa-arrow-left"></i> Previous </button>
										<button type="button" class="btn btn-primary btn-sm next">Next <i class="fa fa-arrow-right"></i> </button>
									</div>
								</div>
							</div>
							<?php 
						} // end foreach question_id
					} // end foreach question
					$count_tabs++;
				}
			}
			$confirm_div = $num_question + 1;
			?> 
			<div style="display: none" id="page<?php echo $confirm_div; ?>" class="pages page<?php echo $confirm_div; ?>" >
				
				<div class="card bg-info paper-shadow">
					<div class="card-header">
						<h4>Test Complete</h4>
					</div>
					<div class="card-body">
						<p>No more questions in this test. You can review your questions or sumbit the test.</p>
					</div>
					<div class="card-footer d-flex justify-content-between">								
						<input type="submit" name="submitBtn" value="Submit Test" class="btn btn-success">
						<button type="button" class="btn btn-secondary" onclick="show_first ();">REVIEW TEST</button>
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
	</div>

	<div class="col-md-3">
		<div class="card mt-2">
	        <div class="card-header">
	            <h4 class="card-title category">Questions</h4>
	        </div>
	    	<div class="card-body max-height-150 height-150-lg overflow-auto">
	    		<?php
	    		if ( ! empty ($all_questions)) {
	    			$count_tabs = 1;
	    			$y = 0;
	    			foreach ( $all_questions as $subject_id=>$question_group ) {
	    				//echo heading ($subject_wise[$subject_id], 5);
	    				foreach ($question_group as $group_id=>$questions) {
	    					foreach ($questions as $question_id) {
	    						$y++;
	    					if (strlen ($y) < 2) {
	    							$y_text = '0'.$y;
	    						} else {
	    							$y_text = $y;
	    						}
	    						?>
	    						<a class="btn btn-sm btn-secondary text-white" href="javascript:void(0)" onclick="display_question (<?php echo $y; ?>)" style="margin-top:5px" id="btn_<?php echo $y; ?>"><?php echo $y_text; ?></a> 
	    						<?php 
	    					}
	    				}
	    			}
	    		}
	    		?>
	    	</div>
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