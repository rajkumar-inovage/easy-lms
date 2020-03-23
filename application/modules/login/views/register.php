<div class="row">
	<div class="col-md-4 ">
		<div class="card card-default paper-shadow bg-primary" data-wow-delay="0.3s">

			<div class="card-body">
				
				<h3 class="card-title">Steps To Register</h3>
				<hr>
				<ol>
					<li>Fill up the registration form with required data</li>
					<li>You will receive an email containing your User-id and a link to create your password. So please be sure to provide a valid and working email-id</li>
					<li>Click on the link provided in the email to create your password</li>
					<li>Once you have created your password, use your User-id and password to login</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="col-md-4 ">
	
		<div class="card card-default paper-shadow " data-wow-delay="0.3s">
			<div class="card-header ">
				<h3 class="card-title">Register As Student</h3>
			</div>
			
			<?php echo form_open ('login/functions/register/'.$coaching_id, array('class'=>'form-horizontal ', 'id'=>'register-form')); ?> 
				<div class="card-body">
							
					<div class="form-group">
						<label class="control-label ">First Name</label>
						<input type="text" name="first_name" class="form-control required"  value="<?php echo set_value ('first_name'); ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label ">Last Name</label>
						<input type="text" name="last_name" class="form-control required"  value="<?php echo set_value ('last_name'); ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label ">Email</label>
						<input type="text" name="email" class="form-control email required" value="<?php echo set_value ('email'); ?>">	
					</div>
					
					<div class="form-group">
						<label class="control-label ">Mobile No.</label>
						<input type="text" name="primary_contact" class="form-control digits required" value="<?php echo set_value ('primary_contact'); ?>">
					</div>
				
					<div class="text-center">
						<input type="submit" class="btn btn-success btn-lg" value="Create Account">
					</div>
					
					<hr>

					<div class="inline-ul text-center d-flex justify-content-center">
						<a href="<?php echo site_url ('login/page/login/'.$coaching_id); ?>" class="">Already have an account? <strong>Sign In</strong></a>
					</div>
					
				</div>
			</form>
		</div>
	</div>
</div>
