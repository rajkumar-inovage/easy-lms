<div class="row justify-content-center mt-4 align-middle v-middle">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	    <?php if ($coaching_slug != FALSE) { // This is coaching login ?>
			<img src="<?php echo $coaching_logo; ?>" height="50" title="<?php echo $coaching_name; ?>" class="text-center">
		<?php } else { ?>
			<img src="<?php echo base_url($this->config->item('system_logo')); ?>" height="50" title="<?php echo SITE_TITLE; ?>"  class="text-center">
		<?php } ?>
	      <h5 class="text-center">Sign in with your credentials</h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5">
		<?php echo form_open ('login/functions/validate_login', array('id'=>'login-form')); ?>
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
		  <a href="<?php echo site_url ('login/page/forgot_password'); ?>" class="text">Forgot password?</a>
		  
		  <div class="text-center">
			<button type="submit" name="submit" class="btn btn-primary my-4">Sign in</button>
		  </div>
		</form>
	  </div>
	</div>
	<div class="row mt-3">
	  <div class="col-12 ">
		<a href="<?php echo site_url ('login/page/register/'.$coaching_slug); ?>" class="btn btn-block btn-primary">Create New Account</a>
	  </div>
	</div>
  </div>
</div>