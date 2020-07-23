<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label class="form-label">Title</label>
			<p class="form-control-static"><?php echo $batch['batch_name']; ?></p>
		</div>

		<div class="form-group row">
			<div class="col-md-6">
				<label class="form-label">Start Date</label>
				<p class="form-control-static"><?php echo date ('d M, Y', $batch['start_date']); ?></p>
			</div>
			<div class="col-md-6">
				<label class="form-label">End Date</label>
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
	</div>
</div>