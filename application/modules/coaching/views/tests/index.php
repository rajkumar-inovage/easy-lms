<div class="row justify-content-center"> 
	<div class="col-md-8"> 
	</div>
</div>

<div class="row">

	<div class="col-md-3">
	    
        <div class="card mb-2"> 
			<div class="card-body ">
				<strong>Search</strong>
				<?php echo form_open('coaching/tests_actions/search_tests', array('class'=>"", 'id'=>'search-form')); ?>
					<div class="form-group row mb-2">
						<div class="col-md-6 mb-2">						
							<select name="search_status" class="form-control" id="search-status" >
								<option value="-1">All Status</option>
								<option value="<?php echo TEST_STATUS_PUBLISHED; ?>">Published</option>
								<option value="<?php echo TEST_STATUS_UNPUBLISHED; ?>">Unpublished</option>
							</select>
						</div>
						<div class="col-md-6">
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
	    
	    <div class="card card-default mb-2">
          <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Categories</h4>
            <small><a class="" href="<?php echo site_url ('coaching/tests/categories/'.$coaching_id); ?>">Edit</a></small>
          </div>

          <ul class="list-group list-group-menu">
            <?php
              if (!empty($categories)) {
                foreach ($categories as $cat) {
                 ?>
        	     <li class="list-group-item <?php if ($category_id == $cat['id']) echo 'active'; ?>">
                  <a href="<?php echo site_url ('coaching/tests/index/'.$coaching_id.'/'.$cat['id']); ?>"><i class="fa fa-chevron-right fa-fw"></i> <?php echo $cat['title']; ?> </a>
                 </li>
                <?php
                }
              } else {
                  ?>
        	      <li class="list-group-item ">
                    <a href="<?php echo site_url ('coaching/tests/categories/'.$coaching_id); ?>" class="list-group-item"> Add category </a>
                  </li>
                  <?php
              }
            ?>
          </ul>

		</div>		
	    

        <?php
          if (!empty($plans)) {
            foreach ($plans as $plan) {
             ?>
             <div class="card card-default mb-2">
                <div class="card-header d-flex justify-content-between">
                  <h4 class="card-title"><?php echo $plan['title']; ?></h4>
                </div>
                <div style="height:200px; overflow-y:auto">
                  <ul class="list-group list-group-menu">
                    <?php
     		          $cats = $this->test_plans_model->categories_in_plan ($coaching_id, $plan['plan_id']);
                      if (!empty($cats)) {
                        foreach ($cats as $cat) {
                          ?>
                	      <li class="list-group-item <?php if ($category_id == $cat['id']) echo 'active'; ?>">
                            <a href="<?php echo site_url ('coaching/tests/index/'.$coaching_id.'/'.$cat['id']); ?>"><i class="fa fa-chevron-right fa-fw"></i> <?php echo $cat['title']; ?> </a>
                          </li>
                          <?php
                        }
                      }
                    ?>
                  </ul>
                </div>
             </div>
            <?php
            }
          }
        ?>
     </div>

	<div class="col-md-9">
		<div class="card card-default mb-4">
			<div class="table-responsive" id="test-lists">
				<table class="table mb-0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th width="50%">Test Name</th>
							<th>Test Type</th>
							<th>Duration</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i = 1;
					if ( ! empty ($tests)) { 
						foreach ($tests as $row) { 
							?>
							<tr>
								<td><?php echo $i; ?>
								<td>
									<?php echo anchor('coaching/tests/manage/'.$coaching_id.'/'.$row['category_id'].'/'.$row['test_id'], $row['title'], array('title'=>'Plans', 'class'=>'btn-link')); ?><br>
									<?php echo $row['unique_test_id']; ?>
								</td>
								<td>
									<?php 
									$param = $this->common_model->sys_parameter_name(SYS_TEST_TYPE, $row['test_type']);
									echo $param['paramval'];
									?>
								</td>
								<td>
									<?php echo $duration = $row['time_min'] . ' mins'; ?>
								</td>
								<td>
									<?php 
									if ($row['finalized'] == 1) {
										echo '<span class="badge badge-primary">Published</span>';
									} else {
										echo '<span class="badge badge-light">Un-published</span>';
									}
									?>
								</td>
							</tr>
							<?php 
							$i++; 
						} 
					} else {
						?>
						<tr>
							<td colspan="5" >
								<div>
									<span class="text-danger">No tests found</span>									
								</div>
								<?php echo anchor ('coaching/tests/create_test/'.$coaching_id.'/'.$category_id, 'Create Test'); ?>
							</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>