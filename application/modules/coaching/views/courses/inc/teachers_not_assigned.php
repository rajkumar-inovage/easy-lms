<?php echo form_open('coaching/courses_actions/assign_teachers/'.$coaching_id.'/'.$course_id, array('class'=>'form-horizontal row-border', 'id'=>'validate-1') ); ?>
	<div class="card ">
		<table class="table table-bordered table-hover table-checkable datatable mb-0">
			<thead>
				<tr>
					<th class="text-center" width="2%">
						<?php echo form_checkbox(array('name'=>'chk', 'class'=>'check-all', 'id'=>'check-all')); ?>
					</th>
					<th class="text-right" width="2%">#</th>
					<th width=""><?php echo 'Name'; ?></th>
					<th><?php echo 'Actions'; ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 1;
			if ( ! empty ($results)) { 
				foreach ($results as $row) {
					?>
					<tr>
						<td class="text-center" >
							<?php
							echo form_checkbox (array('name'=>'users[]', 'value'=>$row['member_id'], 'class'=>'check'));
							?>
						</td>
						<td class="text-right" ><?php echo $i++; ?></td>
						<td>
							<?php echo ($row['first_name']) .' '. ($row['second_name']) .' '. ($row['last_name']); ?><br>
							<?php echo $row['adm_no']; ?>
						</td>
						<td> 
							<a href="javascript: void ()" onclick="show_confirm ('This teacher will assigned to this course?', '<?php echo site_url ('coaching/courses_actions/assign_teacher/'.$coaching_id.'/'.$course_id.'/'.$row['member_id']); ?>')"><i class="fa fa-check"></i></a>
						</td>
					</tr>
					<?php 
				} // foreach
			}
			?>
			</tbody>
		</table>
		
		<?php if ($i > 1) { ?>
			<div class="card-footer">
				<div class="form-inline">
						<label>With selected</label>
						<input type="submit" value="Assign Now" class="btn btn-primary btn-sm ml-2">
				</div>
			</div>
		<?php } ?>
	</div>
<?php echo form_close();?>