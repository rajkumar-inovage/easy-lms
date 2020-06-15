<div class="card card-default">
	<div class="table-responsive">
        <?php echo form_open('coaching/reports/marking_reports/'.$class_id.'/'.$test_id, array('class'=>'form-horizontal row-border'));?>
        <table class="table table-bordered table-hover table-checkable datatable mb-0">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th><?php echo 'Name'; ?></th>
					<th><?php echo 'Last Submitted'; ?></th>
					<th><?php echo 'Max Score'; ?></th>
					<th class="d-none d-block-sm"><?php echo 'Actions'; ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			if  ( ! empty ($submissions) ) {
				$i = 1;
				foreach($submissions as $row) {
					?>
					<tr>                    
						<td><?php echo $i; ?></td>
						<td>
							<?php echo anchor('coaching/reports/all_reports/'.$coaching_id.'/0/'.$row['member_id'].'/'.$test_id, $row['first_name'] . ' ' .$row['last_name']);?><br>
							<?php echo $row['adm_no'];?> 
						</td>
						<td><?php echo date('d F, Y  H:i a', $row['loggedon']);?> </td>
						<td>
							<?php 
								$row['ob_marks'];
								$pass_marks = ($test['pass_marks'] * $test_marks) / 100;
								
								if ($row['ob_marks'] < $pass_marks) {
									$result_class = 'text-danger';
									$result_text = 'Fail';
								} else {
									$result_class = 'text-success';
									$result_text = 'pass';
								}
								?>
								<div class="text-display-1 <?php echo $result_class; ?>"><?php echo $row['ob_marks']; ?></div>
								<span class="caption <?php echo $result_class; ?>"><?php echo $result_text; ?></span>
						</td>
						<td class="d-none d-block-sm">
						<?php 
							echo anchor('coaching/reports/all_reports/'.$coaching_id.'/0/'.$row['member_id'].'/'.$test_id, 'Report', array('title'=>'Report', 'class'=>''));
						?>
						</td>
					</tr>
					<?php 
					$i++;
				}
			} else {
				?>
				<tr>
					<td colspan="4" class="text-danger">No submissions yet</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php echo form_close();?>
	</div>
</div>