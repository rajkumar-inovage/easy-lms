<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			
			<div class="card-body">
				<?php echo form_open('coaching/announcements/create_announcement/', array('class'=>'form-horizontal row-border', 'class'=>'validate-form')); ?>		
					<div class="form-group">
						<input type="hidden" class="form-control required" name="coaching_id" value="" />
					</div>
					<div class="form-group">
						<?php echo form_label('Title<span class="required">*</span>', '', array('class'=>'control-label')); ?>
						<input type="text" class="form-control required" name="title" />
					</div>

					<div class="form-group row">
						<div class="col-md-12">
							<?php echo form_label('Description', '', array('class'=>'control-label')); ?>
							<input class="form-control required" name="description" />
							
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<?php echo form_label('Start Date<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<input name="start_date" type="text" class="form-control required "/>
						</div>
						<div class="col-md-6">
							<?php echo form_label('End Date<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<input name="end_date" type="text" class="form-control required "  />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<?php echo form_label('Status<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<input name="status" type="text" class="form-control required " />
						</div>
						<div class="col-md-6">
							<?php echo form_label('Created By<span class="required">*</span>', '', array('class'=>'control-label')); ?>
							<input name="created_by" type="text" class="form-control required " />
						</div>
					</div>
					
					

					<div class="form-group">
					</div>
					
					<hr>
					
					<p class="btn-toolbar">
						<input type="submit" name="submit" value="<?php echo ('Save'); ?>" class="btn btn-primary " accesskey="s" />
					</p>
				</form>
			</div>
		</div>
	</div>
</div>