<div class="row justify-content-center">
	<div class="col-md-4">
		<div class="card card-default paper-shadow" data-z="0.5">
			<div class="card-header">
				<h4 class="card-title text-center"><i class="fa fa-sync-alt"></i> Reset Password</h4>
			</div>
			<div class="card-body px-lg-5 py-lg-5">
				<div class="text-danger">We'll send you an email on your registered email-id with a link to create your new password.</div> <br>
				<!-- Login Formular -->  
				<?php echo form_open ('login/functions/reset_link', array ('class'=>'form-vertical', 'id'=>'validate-1') ); ?>
					<div class="form-group">
						<div class="">
							<label for="userid">User-id/Login<span class="required">*</span></label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-user"></i></span>
								</div>
								<input name="userid" class="form-control required" placeholder="User-id/Login" autofocus="autofocus" id="userid">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="">
							<label for="email">Email<span class="required">*</span></label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-at"></i></span>
								</div>
								<input name="email" class="form-control required" placeholder="youremail@example.com" autofocus="autofocus" id="email">
							</div>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary" >Send Email</button>
						<a href="<?php echo site_url('login/page/login'); ?>" class="pull-right" ><strong>Log In!</strong></a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	$('.login-form').validate({
		invalidHandler: function (event, validator) { // display error alert on form submit
			//$('.login-form .alert-danger').show();
		},

		submitHandler: function (form) {
			//
			// In reality, you want to remove this submitHandler
			// to use the native browser submitting
			// window.location.href = "index.html";
			var formURL = $('.login-form').attr ("action");
			$.ajax ({ 
				type: 'POST',
				data: $(form).serialize(),
				url: formURL,
				beforeSend: function(){
					$('#validation-message').html ('<div class="alert alert-warning">Verifying...Please wait.</div>');
					NProgress.start();
				},
				complete: function(){
					NProgress.done();
				},
				success: function(response) { 
					if( response.status === true ) {						
						$('#validation-message').html ('<div class="alert alert-success">'+response.message+'</div>');						
					} else {
						$('#validation-message').html ('<div class="alert alert-danger">'+response.error+'</div>');
					}
				}
			});
			
		}
	});
	</script>
</div>