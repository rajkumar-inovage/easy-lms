<div class="card table-responsive">		
	<table class="table table-hover ">
		<thead>
			<th>Batch Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Users</th>
			<th>Actions</th>
		</thead>
		<tbody> 
		<?php
		if ($all_batches) {
			foreach ($all_batches as $row) { 
			?>
			<tr>
				<td>
					<?php echo $row["batch_name"];?><br>
					<?php echo $row["batch_code"];?>
				</td>
				<td>
				<?php 
				if ($row['start_date'] > 0 ) {
					echo date('d M, Y', $row["start_date"]);
				} 
				?>
				</td>
				<td>
				<?php 
				if ($row['end_date'] > 0 ) {
					echo date('d M, Y', $row["end_date"]);
				} 
				?>
				</td>
				<td>
					<?php 
					$num = 0;
					$users = $this->users_model->batch_users ($row['batch_id']);
					if ( ! empty ($users)) {
						$num = count ($users);
					}
						echo '<span class="label label-success">'.$num.'</span>';
					?>
					
				</td>
				
				<td> 
				    <div class="dropdown">
						<a class="btn btn-outline " type="button" id="userMenu<?php echo $row['batch_id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
						<div class="dropdown-menu " aria-labelledby="userMenu<?php echo $row['batch_id'];?>">
    						<a href="<?php echo site_url ('coaching/users/batch_users/'.$coaching_id.'/'.$row['batch_id']); ?>" class="dropdown-item"><i class="fa fa-user-plus"></i> Batch Users</a>
    						<!-- EDIT LOG  -->
    						<a href="<?php echo site_url ('coaching/users/create_batch/'.$coaching_id.'/'.$row['batch_id']); ?>" class="dropdown-item"><i class="fa fa-pencil-alt"></i> Edit Batch</a> 
    						<!-- DELETE LOG  -->
    						<a href="javascript:void(0);" onclick="show_confirm ('Are you sure delete this batch?', '<?php echo site_url('coaching/user_actions/delete_batch/'.$coaching_id.'/'.$row["batch_id"]); ?>')" class="dropdown-item"><i class="fa fa-trash"></i> Delete Batch</a>
					    </div>
					</div>
					
				</td>
			</tr>
			<?php } 
			} else { 
				echo '<tr><td colspan="6">No batches</td></tr>';
			}
			?>
		</tbody>			
	</table>
</div>

<!-- Create row -->
<div class="modal fade d-b" id="create_batch">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open("users/ajax_func/create_batch", array('class'=>'form-horizontal row-border', 'id'=>'validate-1')); ?>
				<div class="modal-header">
					<h4 class="modal-title">New Batch</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
					
					<div class="form-group">
						<?php echo form_label('Batch Code', '', array('class'=>'col-md-12 control-label text-left')); ?>
						<div class="col-md-10">
							<?php echo form_input ( array('name'=>'batch_code', 'class'=>'form-control required') );?>   
						</div>
					</div>	
					<div class="form-group">
						<?php echo form_label('Batch Name', '', array('class'=>'col-md-12 control-label text-left')); ?>
						<div class="col-md-10">
							<?php echo form_input ( array('name'=>'batch_name', 'class'=>'form-control required') );?>   
						</div>
					</div>	
					
					<div class="form-group">
						<?php echo form_label('Start Date', '', array('class'=>'col-md-12 control-label text-left')); ?>
						<div class="col-md-6">
							<?php echo form_input ( array('name'=>'start_date', 'type'=>'date', 'class'=>'form-control', 'placeholder'=>'DD/MM/YYYY') );?>   
						</div>
					</div>	
					<div class="form-group">
						<?php echo form_label('End Date', '', array('class'=>'col-md-12 control-label text-left')); ?>
						<div class="col-md-6">
							<?php echo form_input ( array('name'=>'end_date', 'type'=>'date', 'class'=>'form-control ', 'placeholder'=>'DD/MM/YYYY') );?>   
						</div>
					</div>	
				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<input type="submit" name="submit" value="<?php echo ('Save'); ?>" class="btn btn-primary " />
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->