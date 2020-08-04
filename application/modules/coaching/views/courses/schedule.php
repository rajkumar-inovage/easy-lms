<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label class="form-label font-weight-bold">Title</label>
			<p class="form-control-static"><?php echo $batch['batch_name']; ?></p>
		</div>

		<div class="form-group row">
			<div class="col-md-6">
				<label class="form-label font-weight-bold">Start Date</label>
				<p class="form-control-static"><?php echo date ('d M, Y', $batch['start_date']); ?></p>
			</div>
			<div class="col-md-6">
				<label class="form-label font-weight-bold">End Date</label>
				<p class="form-control-static"><?php echo date ('d M, Y', $batch['end_date']); ?></p>
			</div>
		</div>

	</div>
</div>

<div class="card">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Date</th>
				<?php
				$count = 0;
				$next = 0;
				for ($i=$start_date; $i<=$end_date; $i=$i+$interval) { 
					?>
					<th><?php echo date ('D, d M y', $i); ?></th>
					<?php 
					$count++;
					if ($count >= 7) {
						$next = $i + $interval;
						break;
					}
				}
				?>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<th valign="middle">Timing</th>
				<?php
				unset ($i);
				$count = 0;
				for ($i=$start_date; $i<=$end_date; $i=$i+$interval) { 
					?>
					<td align="center">
						<?php 
						$scd = $schedule[$i];
						if (! empty ($scd)) {
							foreach ($scd as $row) {
								?>
								<div><?php echo $row['start_time']; ?>-<?php echo $row['end_time']; ?></div>
								<div><?php echo $row['name']; ?></div>
								<hr>
								<?php
							}
						}
						?>
							
					</td>
					<?php 
					$count++;
					if ($count >= 7) {
						break;
					}
				}
				?>
			</tr>
		</tbody>
	</table>
	<div class="card-body">
	</div>
	<div class="card-footer">
		<?php echo anchor ('coaching/enrolments/schedule/'.$coaching_id.'/'.$course_id.'/'.$batch_id.'/'.$next, 'Next', ['class'=>'btn btn-primary']); ?>
		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-backdrop="static" data-target="#addSchedule">Add Schedule</button>
	</div>
</div>



<div class="modal fade modal-right" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="addSchedule" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<?php echo form_open ('coaching/enrolment_actions/add_schedule/'.$coaching_id.'/'.$course_id.'/'.$batch_id, ['id'=>'validate-']); ?>
	            <div class="modal-header">
	                <h5 class="modal-title">Add Schedule</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">					

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
						<div>
							<input type="radio" name="repeat" id="repeat-daily" value="1" checked>
							<label class="form-label" for="repeat-daily">Repeat Daily</label>
						</div>

						<div>
							<input type="radio" name="repeat" id="repeat-weekly" value="2">
							<label class="form-label" for="repeat-weekly">Repeat Weekly</label>
						</div>
						<div>
							<label><input type="checkbox" name="dow[]" value="1"> Monday</label>
							<label><input type="checkbox" name="dow[]" value="2"> Tuesday</label>
							<label><input type="checkbox" name="dow[]" value="3"> Wednesday</label>
							<label><input type="checkbox" name="dow[]" value="4"> Thursday</label>
							<label><input type="checkbox" name="dow[]" value="5"> Friday</label>
							<label><input type="checkbox" name="dow[]" value="6"> Saturday</label>
							<label><input type="checkbox" name="dow[]" value="7"> Sunday</label>
						</div>
					</div>					
			
            	</div>
	
	            <div class="modal-footer">
	                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary">Submit</button>
	            </div>
	        </form>
        </div>
    </div>
</div>