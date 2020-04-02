<div class="row mb-4 justify-content-center align-middle v-middle ">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 text-center">
    <img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center mr-auto ml-auto">
  </div>
</div>


<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<h4 class="text-center">Not found</h4>
		<h6 class="text-center">We cannot find your coaching</h6>
	  </div>
	  <div class="card-body ">
	  	<p>If you want to set-up account for your own coaching please click the button below</p>
	  	<?php echo anchor('coaching/login/create_coaching', 'Set-up a new coaching account', ['class'=>'btn btn-success btn-block']); ?>
	  	<p><small>You can set-up account for your institute, coaching or organisation using the above button</small></p>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5 text-info">
		<p class="mt-4 text-info font-weight-bold">Note: If you are a student or employee looking for your organisation, you must use the link/URL shared by your Admin </p>
	  </div>
	</div>
  </div>
</div>
