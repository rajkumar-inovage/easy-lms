<div class="row justify-content-center mx-n2">
	<div class="col-md-4 col-lg-2 col-xs-12 px-2">
		<div class="card">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('student/tests/index/'.$coaching_id.'/'.$member_id); ?>" class="text-decoration-none stretched-link text-reset"><i class="fa fa-puzzle-piece fa-2x d-block"></i>
							<span>Browse Tests</span>
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
		<div class="card">
			<div class="card-body">
				<div class="height-80 d-flex align-items-center justify-content-center">
					<h4 class="card-title text-center text-primary my-3">
						<a href="<?php echo site_url ('student/tests/tests_taken/'.$coaching_id.'/'.$member_id); ?>" class="text-decoration-none stretched-link text-reset"><i class="fa fa-chart-line fa-2x d-block"></i>Tests Taken</a>
					</h4>
				</div>
			</div>
		</div>
	</div>
</div>