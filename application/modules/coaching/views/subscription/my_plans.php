<div class="row justify-content-center">
  <div class="col-md-8">
	<div class="card d-none">
		<div class="card-header p-3">
			<h4 class="card-title"><?php echo $coaching['title']; ?></h4>
		</div>
		<div class="card-body">
			<p class="card-text"><?php echo $coaching['description']; ?></p>
			<ul class="list-group list-group-flush ">
				<li class="list-group-item">
					<div class="media">
						<div class="media-body">
							<p class="mb-0"><i class="fa fa-calendar fa-fw"></i> Date of Joining: <?php echo date ('F d, Y', $coaching['starting_from']); ?></p>
							<p class="mb-0"><i class="fa fa-calendar fa-fw"></i> Valid Till: <?php echo date ('F d, Y', $coaching['ending_on']); ?></p>
						</div>
						<div class="media-right">
							<label>Status: <?php if ($coaching['ending_on'] < time()) echo '<span class="badge badge-danger">Expired</span>'; else echo '<span class="badge badge-success">Active</span>'; ?></label>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="card-footer">
			<a href="<?php echo site_url ('coaching/subscription/browse_plans/'.$coaching_id.'/'.$coaching['sp_id']); ?>" class="btn btn-primary" >Change My Plan</a>
		</div>
	</div>
	<div class="card mb-4 progress-banner h-auto">
		<div class="card-body justify-content-between d-flex flex-row align-items-center">
			<div class="pr-3">
				<i class="iconsminds-financial mr-2 text-white align-text-bottom d-inline-block"></i>
				
				<div>
					<p class="lead text-white"><?php echo $coaching['title']; ?></p>
					<p class="text-white">Status:<?php if ($coaching['ending_on'] < time()) echo '<span class="badge badge-danger ml-3">Expired</span>'; else echo '<span class="badge badge-success ml-3">Active</span>'; ?></p>
					<p class="text-white"><?php echo $coaching['description']; ?></p>
				</div>
				<div class="justify-content-between d-block d-lg-flex">
					<p class="mb-0 text-white mb-2 mb-md-0"><i class="fa fa-calendar fa-fw"  style="font-size:1rem;"></i> Date of Joining: <?php echo date ('F d, Y', $coaching['starting_from']); ?></p>
					<p class="mb-0 text-white"><i class="fa fa-calendar fa-fw" style="font-size:1rem;"></i> Valid Till: <?php echo date ('F d, Y', $coaching['ending_on']); ?></p>
				</div>
				<div class="text-white mt-3" style="font-size:1rem;"> 
					<i class="simple-icon-bell" style="font-size:1rem;"></i> 6 Days Left.
				</div>
			</div>
			
			<div>
				<div role="progressbar"
					class="progress-bar-circle progress-bar-banner position-relative"
					data-color="white" data-trail-color="rgba(255,255,255,0.2)"
					aria-valuenow="4" aria-valuemax="6" data-show-percent="true">
				</div>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-12">
			<a href="<?php echo site_url ('coaching/subscription/browse_plans/'.$coaching_id.'/'.$coaching['sp_id']); ?>" class="btn btn-primary" >Change My Plan</a>
		</div>
	</div>
  </div>
</div>