<div class="row justify-content-center">
	
	<div class="col-md-3">
		<div class="card">
		  <div class="card-header">
		  	Questions
		  </div>
		  <ul class="list-group">
			<?php 
			if (! empty ($questions)) {
				foreach ($questions as $q) {
					?>
					<li class="list-group-item <?php if ($q['question_id'] == $question_id) echo 'active'; ?>">
						<?php 
						$qn = strip_tags ($q['question']); 
						$qn = character_limiter ($qn, 150);
						echo anchor ('coaching/tests/question_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$q['parent_id'].'/'.$q['question_id'].'/'.$lang_id, $qn);
						?>
					</li>
					<?php
				}
				
			} else {
				?>
				<li class="list-group-item ">
					<span class="text-danger">No questions found</span>
				</li>
				<?php
			}
			?>
		  </ul>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<?php echo form_open ('coaching/tests_actions/validate_question_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$parent_id.'/'.$question_id, array('class'=>'form-horizontal row-border', 'id'=>'validate-1') ); ?>

					<!--== Question ==-->
					<div class="form-group">
						<label class=" control-label">Question <span class="required text-danger">*</span></label>
						<div class="">
							<textarea name="question" class="form-control required tinyeditor " rows="5"  autofocus="true"><?php echo set_value ('question', $result['question']); ?></textarea>
						</div>
						<input type="hidden" name="category" value="<?php echo $question_group['category_id']; ?>" >
					</div>
					
					<div class="form-group row">								
						<div class="col-md-6">
							<?php echo form_label ('Classification <span class="required text-danger">*</span>', '', array('class'=>' control-label')); ?>
							<select name="classification" class="browser-default form-control required">
								<?php
								if (is_array($question_categories)) {
									foreach ($question_categories as $items) { 
										if ($question_id > 0) {
											if ($result['clsf_id'] == $items['paramkey']) {
												$selected = "selected='selected'";
											} else {
												$selected = "";
											}
										} else {
											if ($items['paramkey'] == 5) {
												$selected = "selected='selected'";
											} else {
												$selected = "";
											}
										}
										?>
										<option value="<?php echo $items['paramkey'];?>" <?php echo $selected; ?>><?php echo $items['paramval'];?></option>
										<?php 
									}
								}
								?>
							</select> 
						</div>
						
						<div class="col-md-6">
							<?php echo form_label ('Difficulty ', '', array('class'=>' control-label')); ?>
							<select name="difficulty" class="browser-default form-control required"> 
								<?php
								if (is_array($question_difficulties)) {
									foreach ($question_difficulties as $items) { ?>                
										<option  value="<?php echo $items['paramkey'];?>" <?php if ($result['diff_id'] == $items['paramkey']) echo "selected='selected'"; ?> ><?php echo $items['paramval'];?></option>
									<?php }
								}
								?>
							</select> 
						</div>
					</div>
					
					<hr class="my-4">
					
					<h3 class="h6 display ml-1">Answer Choices</h3>
					
					<?php $this->load->view (INCLUDE_PATH . 'add_answer_choices'); ?>
					<!--== Feedback ==-->
					<hr class="my-4">
					
					<h3 class="h6 display ml-1">Feedbacks</h3>

					<div class="form-group">
						<?php echo form_label('Question Feedback ', '', array('class'=>' control-label')); ?>
						<div class="">
							<textarea name="question_feedback" class="form-control" rows="5"  autofocus=""><?php echo set_value ('question_feedback', $result['question_feedback']); ?></textarea>											
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Answer feedback ', '', array('class'=>' control-label')); ?>
						<div class="">
							<textarea name="answer_feedback" class="form-control" rows="5"  autofocus=""><?php echo set_value ('answer_feedback', $result['answer_feedback']); ?></textarea>
						</div>
					</div>
					<!--== ./Feedback ==-->
				</div>

				<div class="card-footer"> 
					<?php
						echo form_button (array ('name'=>'save', 'value'=>'save', 'type'=>'submit', 'class'=>'btn btn-primary ', 'accesskey'=>'s', 'content'=>'Save', 'id'=>'save' )); 
						echo form_button (array ('name'=>'save_new', 'value'=>'save_new', 'type'=>'submit', 'class'=>'btn btn-secondary mr-1', 'accesskey'=>'n', 'content'=>'Save As New', 'id'=>'save_new' )); 
					?>
					<input type="hidden" name="type_id" value="<?php echo $question_group['type']; ?>">
					<input type="hidden" name="marks" value="<?php echo $question_group['marks']; ?>">
					<input type="hidden" name="negmarks" value="<?php echo $question_group['negmarks']; ?>">
					<input type="hidden" name="time" value="<?php echo $question_group['time']; ?>">
					<input type="hidden" name="properties" value="<?php echo $question_group['properties']; ?>"> 
					<input type="hidden" name="save_type" id="save_type" value="save" > 
				</div>
			<?php echo form_close (); ?> 
		</div> <!-- /.widget .box -->
    </div>
</div>