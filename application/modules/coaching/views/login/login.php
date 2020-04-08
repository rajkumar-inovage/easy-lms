<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<?php if (is_file ($logo)) { ?>
			<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
		<?php } else { ?>
		    <h4 class="text-center"><?php echo $page_title; ?></h4>
		<?php } ?>
	    <h6 class="text-center">Sign in with your credentials</h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5">
		<?php echo form_open ('coaching/login_actions/validate_login/'.$slug, array('id'=>'login-form')); ?>
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

		  <a href="<?php echo site_url ('coaching/login/forgot_password/?sub='.$slug); ?>" class="text">Forgot password?</a>
		  
		  <div class="text-center">
			<button type="submit" name="submit" class="btn btn-primary my-4">Sign in</button>
		  </div>
		</form>
	  </div>

	  <div class="card-footer">
	  	<h5 class="text-center">If you are a teacher of <?php echo $page_title;?></h5>
		<a href="<?php echo site_url ('coaching/login/register/?sub='.$slug.'&role='.USER_ROLE_TEACHER); ?>" class="btn btn-block btn-secondary">Create Teacher Account</a>
	  </div>

	  <div class="card-footer">
	  	<h5 class="text-center">If you are a student of <?php echo $page_title;?></h5>
		<a href="<?php echo site_url ('student/login/register/?sub='.$slug.'&role='.USER_ROLE_STUDENT); ?>" class="btn btn-block btn-primary">Create Student Account</a>
		<a href="<?php echo site_url ('student/login/login/?sub='.$slug.'&role='.USER_ROLE_STUDENT); ?>" class="btn btn-block btn-info">Login As Student</a>
		<p class="mt-4 text-info font-weight-bold d-none">Note: Joining depends on admin approval ie, you will not be able to login until an admin approves your joining</p>

		<p class="">
			<h5 class="text-center"></h5>
			<?php echo anchor('student/login/install_app/?sub='.$slug, '<i class="fab fa-android"></i> Install Student App', ['class'=>'btn btn-success btn-block']); ?>
		</p>

		<!--
		<p class="d-none">
			<h5 class="text-center">---- OR ----</h5>
			<?php echo anchor('coaching/login/create_coaching', 'Set-up a new coaching account', ['class'=>'btn btn-success btn-block']); ?>
				
		</p>
		-->
	  </div>
  </div>
</div>