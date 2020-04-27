<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card card-default">
			<div class="card-body">
				<?php echo form_open('coaching/virtual_class_actions/create_classroom/'.$coaching_id.'/'.$class_id, array('class'=>'form-horizontal row-border', 'id'=>'validate-1')); ?>

					<div class="form-group ">
						<?php echo form_label('Classroom Name<span class="required">*</span>', '', array('class'=>'control-label')); ?>
						<input type="text" class="form-control required" name="class_name" value="<?php echo set_value('class_name', $class['class_name']); ?>" />
					</div>
					
					<div class="form-group ">
						<?php echo form_label('Description (Optional)','', array('class'=>'control-label')); ?>
						<textarea name="description" class="form-control" rows="3" max_length="200"><?php echo set_value('description', $class['description']); ?></textarea>
						<div class="text-muted">Short desciption of the class. Maximum length can be 200 characters, including SPACES</div>
					</div>

					<div class="form-group ">
						<?php echo form_label('Welcome Message (Optional)', '', array('class'=>'control-label')); ?>
						<textarea name="welcome_message" class="form-control" rows="3" max_length="100"><?php echo set_value('welcome_message', $class['welcome_message']); ?></textarea>
						<div class="text-muted">This will be displayed to users in class. Maximum length can be 100 characters, including SPACES</div>
					</div>

					<div class="form-group row">
						<?php
						if ($class['moderator_pwd']) {
							$moderator_pwd = $class['moderator_pwd'];
						}
						if ($class['attendee_pwd']) {
							$attendee_pwd = $class['attendee_pwd'];
						}
						?>
						<input type="hidden" name="moderator_pwd" class="form-control" value="<?php echo set_value('moderator_pwd', $moderator_pwd); ?>" >
						<input type="hidden" name="attendee_pwd" class="form-control" value="<?php echo set_value('attendee_pwd', $attendee_pwd); ?>" >
						<div class="col-md-6 d-none">
							<?php echo form_label('Moderator Password<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<span class="text-muted">Change this to any password you want (Numeric, 4 digits) or leave as is</span>
						</div>
					
						<div class="col-md-6 d-none">
							<?php echo form_label('Attendee Password<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<span class="text-muted">Change this to any password you want (Numeric, 4 digits) or leave as is</span>
						</div>
					</div>
					
					<div class="form-group ">
						<?php echo form_label('Student must wait for moderator to join: ', '', array('class'=>'control-label')); ?>
						<label for="checkbox1">
							<input name="wait_for_moderator" id="checkbox1" type="checkbox" value="1" <?php echo set_checkbox('wait_for_moderator', $class['wait_for_moderator']); ?> checked="checked" > Yes
						</label>
					</div>

					<input type="hidden" class="form-control required" name="max_participants" value="<?php echo set_value('max_participants', $class['max_participants']); ?>" placeholder="<?php echo VC_MAX_PARTICIPANTS; ?>" />
					<div class="form-group row d-none">
						<div class="col-md-6"> 
							<?php echo form_label('Max Participant', '', array('class'=>'control-label')); ?>
							<div class="text-muted">Between 1 and <?php echo VC_MAX_PARTICIPANTS; ?></div>
						</div>
					</div>

					<input type="hidden" class="form-control required" name="duration" value="<?php echo set_value('duration', $class['duration']); ?>" placeholder="<?php echo VC_DURATION; ?>" />
					<div class="form-group row d-none">
						<div class="col-md-6"> 
							<?php echo form_label('Duration (minutes)', '', array('class'=>'control-label')); ?>
							<div class="text-muted">Between 1 and <?php echo VC_DURATION; ?></div>
						</div>
					</div>					
					
					<h5 class="card-title border-bottom mt-4 d-none">Schedule</h5>

					<div class="form-group row d-none">
						<?php
							if ($class['start_date']) {
								$start_date = date ('Y-m-d', $class['start_date']);
							} else {
								$start_date = date ('Y-m-d');
							}
						?>
						<div class="col-md-6">
							<?php echo form_label('Class start on<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<input type="date" class="form-control required" name="start_date" value="<?php echo set_value('start_date', $start_date); ?>" />
						</div>

						<div class="col-md-3">						
							<?php echo form_label('Time (HH)', '', array('class'=>'control-label')); ?>
							<select name="start_time_hh " class="form-control">
								<option value="-1">HH</option>
								<?php for ($i=0; $i<=23; $i++) { ?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('h', $class['start_date'])) echo 'selected="selected"'; ?> ><?php echo str_pad($i, 1, '0', STR_PAD_LEFT); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-md-3">
							<?php echo form_label('Time (MM)', '', array('class'=>'control-label')); ?>
							<select name="start_time_mm " class="form-control">
								<option value="-1">MM</option>
								<?php for ($i=0; $i<=59; $i++) { ?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('i', $class['start_date'])) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group row d-none">
						<?php
							if ($class['end_date']) {
								$end_date = date ('Y-m-d', $class['end_date']);
							} else {
								$end_date = date ('Y-m-d');
							}
						?>
						<div class="col-md-6">
							<?php echo form_label('Class ends on', '', array('class'=>'control-label')); ?>
							<input type="date" class="form-control required" name="end_date" value="<?php echo set_value('end_date', $end_date); ?>" />
						</div>

						<div class="col-md-3">
							<?php echo form_label('Time (HH)', '', array('class'=>'control-label')); ?>
							<select name="end_time_hh " class="form-control">
								<option value="-1">HH</option>
								<?php for ($i=0; $i<=23; $i++) { ?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('h', $class['end_date'])) echo 'selected="selected"'; ?> ><?php echo $i; ?></option>
								<?php } ?>
							</select>						
						</div>

						<div class="col-md-3">
							<?php echo form_label('Time (MM)', '', array('class'=>'control-label')); ?>
							<select name="end_time_mm " class="form-control">
								<option value="-1">MM</option>
								<?php for ($i=0; $i<=59; $i++) { ?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('i', $class['end_date'])) echo 'selected="selected"'; ?> ><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>					

					<h5 class="card-title border-bottom mt-4">Recording</h5>

					<div class="form-group row ">
						<div class="col-md-6"> 
							<?php echo form_label('Record classroom', '', array('class'=>'control-label')); ?>
							<label for="checkbox2">
								<input name="record_class" id="checkbox2" type="checkbox" value="1" <?php echo set_checkbox('record', $class['record']); ?> > Yes
							</label>
						</div>
					</div>

					<div class="form-group row d-none">
						<div class="col-md-12"> 
							<?php echo form_label('Recording Description', '', array('class'=>'control-label')); ?>
							<textarea name="record_description" class="form-control" rows="3"><?php echo set_value('record_description', $class['record_description']); ?></textarea>
						</div>
					</div>

				</div>
				
				<div class="card-footer">
					<input type="submit" name="submit" value="<?php echo ('Save'); ?>" class="btn btn-primary " accesskey="s" />
				</div>		
			</form>	
		</div>
	</div>
</div>