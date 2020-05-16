<div class="row justify-content-center">
	
	<div class="col-md-12">
		<div class="card card-default">
			
			<div class="card-body">

				<?php echo form_open('coaching/tests_actions/validate_question_group_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$question_id, array('class'=>'form-horizontal row-border', 'id'=>'validate-1')); ?> 			
					<div class="form-group">
						<?php echo form_label('Question Type', '', array('class'=>' control-label'));?>
						<div class="">
							<?php if ($question_id > 0) { ?>
								<p class="form-control-static"><?php echo $question_type['paramval']; ?></p>
								<input type="hidden" name="type" value="<?php echo $result['type']; ?>" >
							<?php } else { ?>
								<select name="type" class="form-control">
								<?php foreach ($question_types as $qt_items) { ?>
									<option value="<?php echo $qt_items['paramkey'];?>" <?php if ($result['type'] == $qt_items['paramkey']) echo "selected='selected'"; ?> /><?php echo $qt_items['paramval']; ?></option>
								<?php } ?>
								</select>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group">
						<?php echo form_label('Question Group Title<span class="required">*</span>', '', array('class'=>' control-label'));	?>                
						<div class="">
							<?php echo form_textarea(array('name'=>'question', 'class'=>'form-control required tinyeditor','rows'=>'5', 'value'=>set_value ('question', $result['question']), 'autofocus'=>true )); ?>
							<p class="help-block">Example: Answer the following questions </p>
						</div>
					</div>
					
					<!-- override time -->
					<?php echo form_hidden (array('name'=>'time', 'value'=>'0')); ?>

					<!-- override negative marks -->
					<?php echo form_hidden (array('name'=>'negmarks', 'value'=>'0')); ?>
				
					<div class="form-group">
						<?php echo form_label('Marks per question<span class="required">*</span>', '', array('class'=>'control-label')); ?>
						<div class="w-25">
							<?php echo form_input(array('type'=>'number', 'name'=>'marks', 'class'=>'form-control required input-width-mini digits', 'min'=>0, 'maxlength'=>'3', 'value'=>set_value('marks', $result['marks']) ));?>
						</div>
					</div>
					
					<hr>
					
					<div class="btn-toolbar">
						<?php
							echo form_submit (array ('name'=>'submit', 'value'=>'Save', 'class'=>'btn btn-primary')); 
						?>
					</div>
				<?php echo form_close() ?>
			</div>
		</div>
</section>