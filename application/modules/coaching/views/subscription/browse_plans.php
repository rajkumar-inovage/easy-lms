<?php
if ( ! empty($all_plans)) {
	foreach ($all_plans as $plan) {
		$plan_id = $plan['id'];
		//if ($current_plan <> $plan_id) {
			?>			
			<div class="row justify-content-center mb-4 d-none">
			  <div class="col-sm-6">
				<div class="card my-2 "> 
				  <div class="card-header">
					<h4 class="card-title"><?php echo $plan['title']; ?></h4>
				  </div>
				  <div class="card-body">
					<?php
					$price = $plan['price'];
					if ($price > 0) {
						$amount = $price;
						$amount = round ($amount);
						echo '<h5 class="card-price"> <i class="fa fa-rupee-sign"></i> '. $amount. ' per month  </h5>';
					} else {
						echo '<h5 class="card-price"> Free </h5>';
					}
					?>
					<h6 class="card-price"> <i class="fa fa-user"></i> User Limit <?php echo $plan['max_users']; ?></h6>
					<p class="card-text"><?php echo $plan['description']; ?></p>
					<span class="tag tag-pill tag-info"></span>
					<span class="tag tag-pill tag-info"></span>
				  </div>
				  <div class="card-footer">
				  	<?php if ($plan['id'] == $current_plan) { ?>
				  		<span class="badge badge-success">Current Plan</span>
				  	<?php } ?>
					<a href="<?php echo site_url ('coaching/cart_actions/add_item/'.$coaching_id.'/'.$plan['id']); ?>" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Select Plan</a>
				  </div>
				</div>
			  </div>
			</div>
			<?php
		//}
	}
}
?>

<div class="row equal-height-container">
	<?php
	if ( ! empty($all_plans)) {
		foreach ($all_plans as $plan) {
			$plan_id = $plan['id'];
			//if ($current_plan <> $plan_id) {
				?>			
	<div class="col-md-6 col-lg-4 mb-4 col-item">
		<div class="card">
			<div
				class="card-body pt-5 pb-5 text-center">
				<div class="price-top-part text-center w-100">
					<i class="iconsminds-mens large-icon"></i>
					<h5 class="mb-0 font-weight-semibold color-theme-1 mb-4"><?php echo $plan['title']; ?></h5>
					<?php
					$price = $plan['price'];
					if ($price > 0) {
						$amount = $price;
						$amount = round ($amount);
						echo '<p class="card-price"> <i class="fa fa-rupee-sign"></i> '. $amount. ' per month  </p>';
					} else {
						echo '<p class="card-price"> Free </p>';
					}
					?>
					<h6 class="card-price text-muted"> <i class="fa fa-user"></i> User Limit <?php echo $plan['max_users']; ?></h6>
				</div>
				<div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
					<ul class="list-unstyled">
						<li>
							<p class="card-text"><?php echo $plan['description']; ?></p>
							<span class="tag tag-pill tag-info"></span>
							<span class="tag tag-pill tag-info"></span>
						</li>
						
					</ul>
					<?php if ($plan['id'] == $current_plan) { ?>
				  		<span class="badge badge-success">Current Plan</span>
				  	<?php } ?>
					<div class="text-center">
						
								<a href="<?php echo site_url ('coaching/cart_actions/add_item/'.$coaching_id.'/'.$plan['id']); ?>" class="btn btn-link btn-empty btn-lg"> Select Plan <i class="fa fa-shopping-basket"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		//}
	}
}
?>


</div>