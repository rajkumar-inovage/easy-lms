<div class="row justify-content-center ">
	<?php
	if (! empty ($dashboard_menu)) {
		foreach ($dashboard_menu as $menu) {
			$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
			?>
			<div class="col ">
				<div class="card mb-3 ">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-center">
							<p class="d-block d-sm-none text-center ">
								<a href="<?php echo site_url ($link); ?>" class="text-decoration-none stretched-link text-reset">
									<span class="d-block"><?php echo $menu['icon_img']; ?></span>
									<span><?php echo $menu['menu_desc']; ?></span>
									<span class="absolute top right m-4 d-none">
										<span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle height-30 width-30 m-n1"><?php echo count($tests); ?></span>
									</span>
								</a>
							</p>
							<!--
							<h4 class="d-none d-lg-block card-title text-center text-primary ">
								<a href="<?php echo site_url ($link); ?>" class="text-decoration-none stretched-link text-reset">
									<span class="d-block"><?php echo $menu['icon_img']; ?></span>
									<span><?php echo $menu['menu_desc']; ?></span>
									<span class="absolute top right m-4 d-none">
										<span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle height-30 width-30 m-n1"><?php echo count($tests); ?></span>
									</span>
								</a>
							</h4>
							-->
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
	?>
</div>


<div class="row justify-content-center mx-n2">
	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-danger my-3">
						<a href="<?php echo site_url ('coaching/subscription/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset">
							<span class="position-relative d-inline-block">
								<i class="fas fa-cubes fa-2x"></i>
								<i class="fa fa-calendar-check position-absolute mt-2" style="right: 0;font-size: .5em;"></i>
							</span>
							<span class="d-block">Subscription</span>
						</a>
					</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card border-primary">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-danger my-3">
						<a href="<?php echo site_url ('coaching/plans/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset">
							<i class="fas fa-cart-plus d-inline-block fa-2x"></i>
							<span class="d-block">Buy Tests</span>
						</a>
					</h4>
				</div>
			</div>
		</div>
	</div>
</div>