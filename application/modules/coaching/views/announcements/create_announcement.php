<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			
			<div class="card-body">
				<?php echo form_open('coaching/announcement_action/create/'.$coaching_id.'/'.$announcement_id, array('class'=>'form-horizontal row-border', 'class'=>'validate-form')); ?>		
					<div class="form-group">
						<input type="hidden" class="form-control" name="coaching_id" value="" />
					</div>
					<div class="form-group">
						<?php echo form_label('Title<span class="required">*</span>', '', array('class'=>'control-label')); ?>
						<input type="text" class="form-control required" name="title" value="<?php echo set_value('title', $result['title']); ?>" />
					</div>

					<div class="form-group row">
						<div class="col-md-12">
							<?php echo form_label('Description', '', array('class'=>'control-label')); ?>
							<textarea class="form-control required" name="description" placeholder="Write your announcement..." rows="5"><?php echo set_value('description', $result['description']); ?></textarea>
							
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<?php echo form_label('Start Date', '', array('class'=>'control-label')); ?>
							<?php $original_date_s=$result['start_date'];
							$new_date_s = date("Y-m-d", $original_date_s); ?>
							<input name="start_date" type="date" class="form-control required" value="<?php 
							
							echo set_value('start_date', $new_date_s); ?>"/>
						</div>
						<div class="col-md-6">
							<?php echo form_label('End Date', '', array('class'=>'control-label')); ?>
							<?php $original_date_e=$result['end_date'];
							$new_date_e = date("Y-m-d", $original_date_e); ?>
							<input name="end_date" type="date" class="form-control required "  value="<?php 
							
							echo set_value('end_date', $new_date_e); ?>"/>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 mt-3">
							<?php echo form_label('Status', '', array('class'=>'control-label pr-5')); ?>

							<input type="radio"
				                 name="status"
				                 id="active"
				                 value="1"
				                 <?php echo set_value('status', $result['status']) == 1 ? "checked" : ""; ?>
				  
				                 />
				          <label for="active">Active</label>
				          <input type="radio"
				                 name="status"
				                 id="inactive"
				                 class="ml-3"
				                 value="0"
				                 <?php echo set_value('status', $result['status']) == 0 ? "checked" : ""; ?> 
				  				
				                 />
				          <label for="inactive">Inactive</label>
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