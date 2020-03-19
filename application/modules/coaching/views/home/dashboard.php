<div class="row justify-content-center mx-n2">
	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('coaching/tests/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset"><i class="fa fa-puzzle-piece fa-2x d-block"></i>
							<span>Tests</span>
							<span class="absolute top right m-4">
								<span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle height-30 width-30 m-n1"><?php echo count($tests); ?></span>
							</span>
						</a>
					</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('coaching/users/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset"><i class="fas fa-users fa-2x d-block"></i>
							<span>Users</span>
							<span class="absolute top right m-4">
								<span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle height-30 width-30 m-n1"><?php echo count($users); ?></span>
							</span>
						</a>
					</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('coaching/attendance/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset">
							<span class="position-relative d-inline-block">
								<i class="fas fa-user fa-2x"></i>
								<i class="fa fa-check-circle text-white position-absolute m-1" style="left: 0;bottom: 0;font-size: .5em;"></i>
								<i class="fa fa-times-circle text-white position-absolute m-1" style="right: 0;bottom: 0;font-size: .5em;"></i>
							</span>
							<span class="d-block">Attendance</span>
						</a>
					</h4>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
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
		<div class="card mb-3">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('coaching/announcements/index/'.$coaching_id); ?>" class="text-decoration-none stretched-link text-reset">
							<span class="position-relative d-inline-block">
								<i class="fas fa-bullhorn fa-2x"></i>
								<i class="fa fa-calendar-check position-absolute mt-2" style="right: 0;font-size: .5em;"></i>
							</span>
							<span class="d-block">Announcements</span>
							<span class="absolute top right m-4">
								<span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle height-30 width-30 m-n1"><?php echo count($announcements); ?></span>
							</span>
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
					<h4 class="card-title text-center text-primary my-3">
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