<<<<<<< HEAD
<?php 
$str = "createname=Test+Meeting&meetingID=abc123&attendeePW=111222&moderatorPW=333444LF41LYJm5X0p4PlzPl8LK34gckQu9LUhHs5pURP2cc";
//echo sha1($str); 
?>
=======
>>>>>>> d4f33db5c242c4801957521fca672bd0b5c09f2c
<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
		<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
	    <h5 class="text-center">Sign in with your credentials</h6>
	  </div>
	  <div class="card-body px-lg-5 py-lg-5">
		<?php echo form_open ('login/functions/validate_login/'.$slug, array('id'=>'login-forms')); ?>
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
		  <a href="<?php echo site_url ('login/page/forgot_password/?sub='.$slug); ?>" class="text">Forgot password?</a>
		  
		  <div class="text-center">
			<button type="submit" name="submit" class="btn btn-primary my-4">Sign in</button>
		  </div>
		</form>
	  </div>
	</div>
	<?php if (! empty ($slug)) { ?>
		<div class="row mt-3">
		  <div class="col-12 ">
			<a href="<?php echo site_url ('login/page/register/?sub='.$slug); ?>" class="btn btn-block btn-primary">Create New Account</a>
		  </div>
		</div>
	<?php } ?>
  </div>
</div>