<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<?php if (is_file ($logo)) { ?>
			<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
		<?php } else { ?>
		    <h4 class="text-center"><?php echo $page_title; ?></h4>
		<?php } ?>
	    <h6 class="text-center">Welcome </h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5 text-center">
	  	<p>If you already have an account with us <br> <?php echo anchor ('student/login/login/?sub='.$slug, 'Sign-In Here'); ?></p>
	  </div>

	  <div class="card-footer">
	  	<h5 class="text-center">Don't have an account? </h5>
		<a href="<?php echo site_url ('student/login/register/?sub='.$slug.'&role='.USER_ROLE_STUDENT); ?>" class="btn btn-block btn-primary">Join as student</a>

		<div id="installBanner">
			<a href="<?php echo site_url ('student/login/install_app/?sub='.$slug.'&role='.USER_ROLE_STUDENT); ?>" class="btn btn-block btn-success mt-3"><i class="fab fa-android"></i> Install Student App</a>
		</div>

		<p class="mt-4 text-info font-weight-bold d-none">Note: Joining depends on admin approval ie, you will not be able to login until an admin approves your joining</p>
	  </div>
  </div>
</div>