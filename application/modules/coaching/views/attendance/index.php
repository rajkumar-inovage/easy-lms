<div class="card mb-2"> 
	<div class="card-body ">
		<strong>Search</strong>
		<?php echo form_open('coaching/attendance_actions/search_users/'.$coaching_id, array('class'=>"", 'id'=>'search-form')); ?>
			<div class="form-group row mb-2">
				<div class="col-md-3 mb-2">
					<select name="search_status" class="form-control" id="search-status" >
						<option value="-1">All Status</option>
						<option value="<?php echo USER_STATUS_DISABLED; ?>" <?php if ($status==USER_STATUS_DISABLED) echo 'selected="selected"'; ?> >Disabled</option>
						<option value="<?php echo USER_STATUS_ENABLED; ?>" <?php if ($status==USER_STATUS_ENABLED) echo 'selected="selected"'; ?> >Enabled</option>
						<option value="<?php echo USER_STATUS_UNCONFIRMED; ?>" <?php if ($status==USER_STATUS_UNCONFIRMED) echo 'selected="selected"'; ?> >Pending</option>
					</select>
				</div>
				<div class="col-md-3 mb-2">
					<select name="search_role" class="form-control" id="search-role">
						<option value="0">All Roles</option>
						<?php foreach ($roles as $role) { ?>
							<option value="<?php echo $role['role_id']; ?>" <?php if ($role_id ==$role['role_id']) echo 'selected="selected"'; ?> ><?php echo $role['description']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3 mb-2">
					<select name="search_batch" class="form-control" id="search-batch">
						<option value="0">All Batches</option>
						<?php /* foreach ($batches as $batch) { ?>
							<option value="<?php echo $batch['id']; ?>"><?php echo $batch['title']; ?></option>
						<?php } */ ?>
					</select>
				</div>
				<div class="col-md-3">
					<div class="input-group ">
						<input name="search_text" class="form-control " type="search" placeholder="Search" aria-label="Search Test" aria-describedby="search-button">
						<div class="input-group-append">
							<button class="btn btn-sm btn-primary " type="submit" id="search-button"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row mb-2">
				<div class="col-md-3 mb-2">
					<input type="date" id="date" value="<?php echo $date; ?>" class="form-control"  > 
				</div>
			</div>
		</form>				
		
	</div>
</div>
<div class="card card-default">
	<div class="card-body table-responsive" id="users-list">
		<table class="table table-bordered v-middle" id="data-tables">
			<thead>
				<tr>
					<th width="5%">
						<input id="checkAll" type="checkbox" >
					</th>
					<th width="25%"><?php echo 'Name'; ?></th>
					<th width=""><?php echo 'Email'; ?></th>
					<th width=""><?php echo 'Role'; ?></th>
					<th width=""><?php echo 'Status'; ?></th>
					<th width=""><?php echo 'Actions'; ?></th>
				</tr>
			</thead>
			
			<tbody id="">
			<?php
			$i = 0 ;
			if ( ! empty ($results)) {
				foreach ($results as $row) {
					?>
					<tr>
						<td>
							<input id="" type="checkbox" name="mycheck[]" value="<?php echo $row['member_id']; ?>" class="checks">
						</td>
						<td>
							<a class="" href="<?php echo site_url ('users/admin/create/'.$coaching_id.'/'.$row['role_id'].'/'.$row['member_id']); ?>"> 
								<?php echo ($row['first_name']) .' '. ($row['second_name']) .' '. ($row['last_name']); ?>
							</a> <br> 
							<?php echo $row['adm_no']; ?>
						</td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['role_id']; ?></td>
						<td><?php echo $row['status']; ?></td>
						<td> 
							<div class="btn-group">									
								<a href="javascript: _void()" onclick="mark_attendance (this.id, <?php echo $row['member_id']; ?>, <?php echo ATTENDANCE_PRESENT; ?>, '<?php echo $dt_string; ?>');" class="btn <?php if ($attendance[$row['member_id']]['attendance'] == ATTENDANCE_PRESENT) echo 'btn-success'; else echo 'btn-light' ?>" id="present<?php echo $row['member_id']; ?>" >Present</a>
								
								<a href="javascript: _void()" onclick="mark_attendance (this.id, <?php echo $row['member_id']; ?>, <?php echo ATTENDANCE_LEAVE; ?>, '<?php echo $dt_string; ?>');" class="btn <?php if ($attendance[$row['member_id']]['attendance'] == ATTENDANCE_LEAVE) echo 'btn-success'; else echo 'btn-light' ?>" id="leave<?php echo $row['member_id']; ?>" >Leave</a>
								
								<a href="javascript: _void()" onclick="mark_attendance (this.id, <?php echo $row['member_id']; ?>, <?php echo ATTENDANCE_ABSENT; ?>, '<?php echo $dt_string; ?>');" class="btn <?php if ($attendance[$row['member_id']]['attendance'] == ATTENDANCE_ABSENT) echo 'btn-success'; else echo 'btn-light' ?>" id="absent<?php echo $row['member_id']; ?>" >Absent</a>
								
								<a href="<?php echo site_url ('attendance/reports/member_report/'.$row['member_id']); ?>" class="float-right btn btn-dark">Report</a>
							</div>
						</td>
					</tr>
					<?php 
				} // foreach 
			} else {
				?>
				<tr>
					<td colspan="6">No users found</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div> 
</div>
