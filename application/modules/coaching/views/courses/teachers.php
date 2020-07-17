<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="users" role="tablist">
		  <li class="nav-item">
			<a class="nav-link <?php if ($type==TEACHERS_ASSIGNED) echo 'active'; ?>" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id.'/'.TEACHERS_ASSIGNED ) ?>" title="Teachers In Course">Teachers Assigned <span class="badge badge-primary"><?php echo $num_assigned; ?></span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link <?php if ($type==TEACHERS_NOT_ASSIGNED) echo 'active'; ?>" href="<?php echo site_url ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id.'/'.TEACHERS_NOT_ASSIGNED) ?>" title="Teachers Not In Course">Teachers Not Assigned <span class="badge badge-primary"><?php echo $num_not_assigned; ?></span></a>
		  </li>
		</ul>
	</div>
</div>

<div class="card mb-2"> 
	<div class="card-body ">
		<strong>Search</strong>
		<?php echo form_open('coaching/courses_actions/search_teachers/', array('class'=>"", 'id'=>'search-form')); ?>
			<div class="form-group row mb-2">
				<div class="col-md-3 mb-2">
					<select name="search_status" class="form-control" id="search-status" >
						<option value="-1">All Status</option>
						<option value="<?php echo USER_STATUS_DISABLED; ?>" <?php if ($status==USER_STATUS_DISABLED) echo 'selected="selected"'; ?> >Disabled</option>
						<option value="<?php echo USER_STATUS_ENABLED; ?>" <?php if ($status==USER_STATUS_ENABLED) echo 'selected="selected"'; ?> >Enabled</option>
						<option value="<?php echo USER_STATUS_UNCONFIRMED; ?>" <?php if ($status==USER_STATUS_UNCONFIRMED) echo 'selected="selected"'; ?> >Pending</option>
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
		</form>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php 
		if ($type == TEACHERS_ASSIGNED) {
			$this->load->view ('inc/teachers_assigned', $data);
		} else if ($type == TEACHERS_NOT_ASSIGNED) {
			$this->load->view ('inc/teachers_not_assigned', $data);
		}
		?>
	</div>
</div>