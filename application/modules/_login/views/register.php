<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<?php if (is_file ($logo)) { ?>
			<img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
		<?php } else { ?>
		    <h4 class="text-center"><?php echo $page_title; ?></h4>
		<?php } ?>
	    <h5 class="text-center">Join as <?php if ($role_id == USER_ROLE_TEACHER) echo 'employee'; else echo 'student'; ?></h5>
	  </div>
		<?php echo form_open ('login/functions/register/'.$slug, array('class'=>'form-horizontal ', 'id'=>'validate-1')); ?> 
	  	  <div class="card-body px-lg-5 py-lg-5">
	  	  	<input type="hidden" name="user_role" value="<?php echo USER_ROLE_STUDENT; ?>">
	  	  	<input type="hidden" name="sr_no" value="">
	  	  	<input type="hidden" name="second_name" value="">
							
			<div class="form-group">
				<label class="control-label ">First Name<span class="text-danger">*</span></label>
				<input type="text" name="first_name" class="form-control required"  value="<?php echo set_value ('first_name'); ?>">
			</div>
			
			<div class="form-group">
				<label class="control-label ">Last Name</label>
				<input type="text" name="last_name" class="form-control required"  value="<?php echo set_value ('last_name'); ?>">
			</div>
			
			<div class="form-group">
				<label class="control-label ">Email<span class="text-danger">*</span></label>
				<input type="text" name="email" class="form-control email required" value="<?php echo set_value ('email'); ?>">	
			</div>
			
			<div class="form-group">
				<label class="control-label ">Mobile <span class="text-danger">*</span></label>
				<input type="text" name="primary_contact" class="form-control digits required" value="<?php echo set_value ('primary_contact'); ?>">
			</div>

			<div class="form-group">
				<label class="control-label" for="password">Password</label>
				<input type="password" name="password" id='password' class="form-control required" placeholder="Password">
				<div id='password-strength'></div>				
			</div>

			<div class="form-group">
				<label class="control-label" for="conf_password">Confirm Password</label>
				<input type="password" name="confirm_password" class="form-control required" id="conf_password"  placeholder="Re-enter password" >
			</div>
			
			<div class="form-group">			
				<div id="pswd_info" >
					<label class="">Password must meet the following requirements</label>
					<div><i id="letter"></i>       <span>At least one capital and small letter</span></div>
					<div><i id="number"></i>       <span>At least one number</span></div>
					<div><i id="spcl_char"></i>    <span>At least one special character</span></div>
					<div><i id="length"></i>       <span>Be at least 8 characters</span></div>
					<div><i id="re_pass"></i>      <span>"Confirm Password" should match "Password".</span></div>
				</div>
			</div>
		  </div>

		  <div class="card-footer">
			
			<div class=" text-center ">
				<input type="submit" name="save" class="btn btn-success" value="Create Account"><br>
				<a href="<?php echo site_url ('login/page/index/?sub='.$slug); ?>" class="mt-4">Already have an account? <strong>Sign In</strong></a>
			</div>
	  	  </div>
	  	</form>
	</div>
  </div>
</div>

<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	<div class="card card-default paper-shadow border-primary" data-wow-delay="0.3s">
		<div class="card-header">
			<h4 class="card-title">Steps To Register</h4>
		</div>
		<div class="card-body">
			<ol>
				<li>Fill up the registration form with required data</li>
				<li>You will receive an email containing your User-id and a link to create your password. So please be sure to provide a valid and working email-id</li>
				<li>Click on the link provided in the email to create your password</li>
				<li>Once you have created your password, use your User-id and password to login</li>
			</ol>
		</div>
	</div>
  </div>
</div>
