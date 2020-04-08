<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<?php if (is_file ($logo)) { ?>
			<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
		<?php } else { ?>
		    <h4 class="text-center"><?php echo $page_title; ?></h4>
		<?php } ?>
	    <h6 class="text-center">Install Student App</h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5">
	  	<div class="card-text text-center mb-2">
	  		Click on the below button to install student mobile app for <strong><?php echo $page_title; ?></strong>
	  	</div>
	  	<div class="" id="installBanner" >
            <button class="btn btn-success btn-block" id="installBtn"><i class="fab fa-android"></i> Install App</button>
        </div>
        <p class="text-center mt-4">
			<a href="<?php echo site_url ('student/login/index/?sub='.$slug); ?>" class="mt-4">Already have an account? <strong>Sign In</strong></a>
        </p>
	  </div>
	</div>
  </div>
</div>
