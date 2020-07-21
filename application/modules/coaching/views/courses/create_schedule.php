<div class="row">
	<div class="col-md-6">
		<?php echo form_open ('coaching/enrolment_actions/add_schedule/'.$coaching_id.'/'.$course_id.'/'.$batch_id, ['id'=>'validate-']); ?>
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-label">Title</label>
					<p class="form-control-static"><?php echo $batch['batch_name']; ?></p>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label class="form-label">Start Date</label>
						<p class="form-control-static"><?php echo $batch['start_date']; ?></p>
					</div>
					<div class="col-md-6">
						<label class="form-label">End Date</label>
						<p class="form-control-static"><?php echo $batch['end_date']; ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="form-label">Instructors</label>
					<select class="form-control" name="instructor">
						<?php
						if (! empty ($instructors)) {
							foreach ($instructors as $row) {
								$name = $row['first_name'] . ' ' . $row['last_name'];
								?>
								<option value="<?php echo $row['member_id']; ?>"><?php echo $name; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label class="form-label">Classrooms</label>
					<select class="form-control" name="classroom">
						<?php
						if (! empty ($classrooms)) {
							foreach ($classrooms as $row) {
								?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>

				<div class="form-group row d-none">
				  <div class="col-md-6">
					<?php echo form_label('Starting From', '', array('class'=>'control-label')); ?>
						<?php 
						if ($schedule['start_time'] > 0){
							$start_date = date ('Y-m-d', $schedule['start_time']); 
						} else {
							$start_date = date ('Y-m-d');
						}
						?>
						<?php echo form_input ( array('name'=>'start_time', 'class'=>'form-control datepicker', 'value'=>set_value('start_time', $start_date), 'type'=>'date') );?>   
				  </div>
				  <div class="col-md-6">
					<?php echo form_label('Ending On', '', array('class'=>'control-label')); ?>
						<?php 
						if ($schedule['end_time'] > 0){
							$end_date = date ('Y-m-d', $schedule['end_time']); 
						} else {
							$end_date = "";
						}
						?>

						<?php echo form_input ( array('name'=>'end_time', 'class'=>'form-control datepicker', 'value'=>set_value('end_time', $end_date), 'type'=>'date') );?>
				  </div>
				</div>

				<div class="form-group row">
				  <div class="col-md-6">
					<?php echo form_label('Start Time', '', array('class'=>'control-label')); ?>
						<?php 
						$start_time = "00:00";
						?>
						<?php echo form_input ( array('name'=>'start_time', 'class'=>'form-control datepicker', 'value'=>set_value('start_time', $start_time), 'type'=>'time') );?>   
				  </div>
				  <div class="col-md-6">
					<?php echo form_label('End Time', '', array('class'=>'control-label')); ?>
						<?php
						$end_time = "00:00";
						?>
						<?php echo form_input ( array('name'=>'end_time', 'class'=>'form-control', 'value'=>set_value ('end_time', $end_time), 'type'=>'time') );?>
				  </div>
				</div>

				<div class="form-group">
					<h4>Repeat</h4>
					<label class="form-label" for="repeat-daily">Repeat Daily</label>
					<input type="radio" name="repeat" id="repeat-daily" value="1">

					<label class="form-label" for="repeat-weekly">Repeat Weekly</label>
					<input type="radio" name="repeat" id="repeat-weekly" value="2">
				</div>
			</div>
			<div class="card-footer">
				<input type="submit" name="submit">
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
			<?php
			$start_date = $batch['start_date'];
			$end_date = $batch['end_date'];
			?>
			<table class="table">
				<thead>
				</thead>
				<tbody>					
					<?php foreach ($schedule as $row) { ?>
						<tr>
							<th><?php echo date ('D, d', $row['dow']); ?></th>
							<th><?php echo $row['start_time']; ?></th>
							<th><?php echo $row['end_time']; ?></th>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="card-body">
			</div>
		</div>
		<?php
		print_r ($schedule);
		?>
	</div>

</div>