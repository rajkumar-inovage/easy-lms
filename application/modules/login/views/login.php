<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<?php if (is_file ($logo)) { ?>
			<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
		<?php } else { ?>
		    <h4 class="text-center">Registered User</h4>
		<?php } ?>
	    <h6 class="text-center">Sign in with your credentials</h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5">
		<?php echo form_open ('login/login_actions/validate_login/'.$slug, array('id'=>'login-form')); ?>
		  <input type="hidden" name="coaching_id" value="<?php echo $coaching_id; ?>">
		  <div class="form-group mb-3">
			<div class="input-group input-group-alternative">
			  <div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-user"></i></span>
			  </div>
			  <input class="form-control" placeholder="User-id OR Email-id" type="text" name="username">
			</div>
		  </div>
		  <div class="form-group">
			<div class="input-group input-group-alternative">
			  <div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-lock"></i></span>
			  </div>
			  <input class="form-control" placeholder="Password" type="password" name="password">
			</div>
		  </div>
		  <div class="media">
		  	<div class="media-body">
		  		<a href="<?php echo site_url ('login/login/forgot_password/?sub='.$slug); ?>" class="text">Forgot password?</a>
		  	</div>
		  	<div class="media-right">
		  		<a href="<?php echo site_url ('login/login/otp_request/?sub='.$slug); ?>" class="text">Sign in with OTP</a>
		  	</div>
		  </div>
		  <div class="text-center">
			<button type="submit" name="submit" class="btn btn-success my-4">Sign in</button>
		  </div>
		</form>
	  </div>

	  <div class="card-footer">
	  	<h5 class="text-center">Don't have an account with <?php echo $page_title;?></h5>
		<a href="<?php echo site_url ('login/login/register/?sub='.$slug.'&role='.USER_ROLE_TEACHER); ?>" class="btn btn-block btn-primary">Create Teacher Account</a>
		<a href="<?php echo site_url ('login/login/register/?sub='.$slug.'&role='.USER_ROLE_STUDENT); ?>" class="btn btn-block btn-info">Create Student Account</a>

        <div class="mt-4" id="installBanner" >
            <button class="btn btn-success " id="installBtn"><i class="fab fa-android"></i> Install App</button> 
        </div>


	  </div>

	  <div class="card-footer d-none">

		<p class="">
			<h5 class="text-center"></h5>
			<?php echo anchor('student/login/install_app/?sub='.$slug, '<i class="fab fa-android"></i> Install Student App', ['class'=>'btn btn-success btn-block']); ?>
		</p>

	  </div>
  </div>
</div>