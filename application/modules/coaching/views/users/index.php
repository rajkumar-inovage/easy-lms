<div class=""> 
	<div class="">
		<strong>Search</strong>
		<?php echo form_open('coaching/user_actions/search_users/'.$coaching_id.'/'.$role_id.'/'.$status.'/'.$batch_id, array('class'=>"mt-3", 'id'=>'search-form')); ?>
			<div class="form-group row mb-2 d-flex">
				<div class="col-md-3 mb-2">
					<select name="search_status" class="custom-select rounded" id="search-status" >
						<option value="-1">All Status</option>
						<option value="<?php echo USER_STATUS_DISABLED; ?>" <?php if ($status==USER_STATUS_DISABLED) echo 'selected="selected"'; ?> >Disabled</option>
						<option value="<?php echo USER_STATUS_ENABLED; ?>" <?php if ($status==USER_STATUS_ENABLED) echo 'selected="selected"'; ?> >Enabled</option>
						<option value="<?php echo USER_STATUS_UNCONFIRMED; ?>" <?php if ($status==USER_STATUS_UNCONFIRMED) echo 'selected="selected"'; ?> >Pending</option>
					</select>
				</div>

				<div class="col-md-3 mb-2">
					<select name="search_role" class="custom-select rounded" id="search-role">
						<option value="0">All Roles</option>
						<?php foreach ($roles as $role) { ?>
							<option value="<?php echo $role['role_id']; ?>" <?php if ($role_id ==$role['role_id']) echo 'selected="selected"'; ?> ><?php echo $role['description']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-md-3">
					<select name="filter_sort" class="custom-select rounded" id="filter-sort" >
						<option value="<?php echo SORT_ALPHA_ASC; ?>" <?php if ($sort==SORT_ALPHA_ASC) echo 'selected="selected"'; ?> >Name: A to Z</option>
						<option value="<?php echo SORT_ALPHA_DESC; ?>" <?php if ($sort==SORT_ALPHA_DESC) echo 'selected="selected"'; ?> >Name: Z to A</option>
						<option value="<?php echo SORT_CREATION_ASC; ?>" <?php if ($sort==SORT_CREATION_ASC) echo 'selected="selected"'; ?> >Old to New</option>
						<option value="<?php echo SORT_CREATION_DESC; ?>" <?php if ($sort==SORT_CREATION_DESC) echo 'selected="selected"'; ?> >New to Old</option>
					</select>
				</div>
			</div>

			<div class="form-group row mb-2">
				<div class="col-md-6 mb-2">
					<div class="input-group position-relative">
						<input name="search_text" class="form-control rounded" type="search" placeholder="Search by name, mobile number, user-id" aria-label="Search Test" aria-describedby="search-button">
						<div class="input-group-append position-absolute" style="top:1px; right:0; z-index:99;">
							<button class="btn btn-sm btn-primary " type="submit" id="search-button"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
				
				
			</div>

		</form>
	</div>
</div>
<?php echo form_open('coaching/user_actions/confirm/'.$coaching_id.'/'.$role_id.'/'.$status, array('class'=>'form-horizontal row-border', 'id'=>'validate-1') ); ?>
	<div id="users-list">
		<?php $this->load->view ('users/inc/index', $data); ?>
		<div class="row my-3">
			<div class="col-12">
				<div class="btn-group" role="group" aria-label="Basic example">
					<div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
						<label class="custom-control custom-checkbox mb-0 d-inline-block">
							<input type="checkbox" class="custom-control-input" id="checkAll">
							<span class="custom-control-label">&nbsp;</span>
						</label>
					</div>
					<select name="action" class="custom-select w-auto">
						<option value="0">---With Selected---</option>
						<option value="delete">Delete</option>
						<option value="enable">Enable Account</option>
						<option value="disable">Disable Account</option>
					</select>
					<input type="submit" name="Submit" value="Change" class="btn btn-primary"/>
				</div>
			</div>
		</div>
	</div>
</form>

