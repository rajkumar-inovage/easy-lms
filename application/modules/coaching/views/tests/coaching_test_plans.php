<div class="row justify-content-center" >
	<div class="col-md-10">
	  <div class="card">
		 <ul class="list-group">
			<?php 
			if ( ! empty ($plans)) {
				foreach ($plans as $row) {
					?>
					<li class="list-group-item media">
						<div class="media-left"></div>
						<div class="media-body">
							<h4><?php echo anchor ('coaching/plans/tests_in_plan/'.$coaching_id.'/'.$row['plan_id'], $row['plan_name'], array ('class'=>'link-text-color', 'title'=>'Browse all tests in this plan ')); ?></h4>
						</div>
						<div class="media-right">
							<?php echo anchor ('coaching/indiatests_import/tests_in_plan/'.$coaching_id.'/0/'.$row['plan_id'], 'Tests', array ('class'=>'btn btn-primary', 'title'=>'Browse all tests in this plan ')); ?>
						</div>
					</li>
					<?php 
				}
			} else { 
			?>
			<li class="list-group-item">
				<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
			</li>
		    <?php } // if result ?>
		  </ul>

		  <div class="card-footer">
		  	<?php //echo anchor ('coaching/indiatests_import/test_plan_categories/'.$coaching_id, '<i class="fa fa-shopping-cart"></i> Buy Test Plan', ['class'=>'btn btn-danger']); ?> 	
		  </div>
	  </div>
	</div>
</div>
