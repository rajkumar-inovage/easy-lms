<div class="row justify-content-center" >
	<div class="col-md-12">
	  <div class="card">
		<table class="table table-hover table-bordere">
			<thead>
				<tr>
					<th width="20%"><?php echo 'Plan Name'; ?></th>
					<th width=""><?php echo 'Description'; ?></th>
					<th width=""><?php echo 'Actions'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ( ! empty ($test_plans)) {
					foreach ($test_plans as $row) {
						$plan_exists = $this->plans_model->its_test_plan_exists ($row['plan_id']);
						?>
						<tr>
							<td>
								<?php if ( ! $plan_exists ) { ?>
									<span class="badge badge-success">New</span>
									<?php echo $row['title']; ?>
								<?php } else {
									// echo anchor ('admin/plans/its_tests_in_plan/'.$cat_id.'/'.$row['plan_id'], $row['title'], array ('title'=>'Tests in category')); 
									echo $row['title'];
								}
								?>
							</td>
							<td>
								<?php 
								$description = strip_tags($row['description']); 
								echo character_limiter ($description, 150);
								?>
							</td>
							<td>
								<?php if ( ! $plan_exists ) { ?>
									<a href="<?php echo site_url('admin/plan_actions/its_import_plan/'.$cat_id.'/'.$row['plan_id']); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" data-original-title="Import"><i class="fa fa-download"></i> Import Category</a>
								<?php } ?>
							</td> 
						</tr>
						<?php 
					}
				} else {
				?>
				<tr>
					<td colspan="3"><?php echo 'No Plans Found'; ?></td>
				</tr>
			<?php } // if result ?>		
			</tbody>
		</table>
	  </div>
	</div>
</div>