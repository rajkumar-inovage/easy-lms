<div class="row">
	<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
		<div class="card card-default paper-shadow" data-z="0.5">
			<div class="card-header">
				<h4 class="card-title"><?php echo $page_title; ?></h4>
			</div>
			<div class="card-body">
				<?php echo form_open ('login/functions/update_password/'.$member_id, array('class'=>'form-horizontal','role'=>'form', 'id'=>'validate-1')); ?>
				
					<div class="form-group">
						<label class="col-md-3" for="password">User-id</label>
						<div class="col-md-9">
							<p class="form-control-static" ><?php echo $result['adm_no']; ?></p>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3" for="password">Password</label>
						<div class="col-md-9">
							<input type="password" name="password" id='password' class="form-control required" placeholder="Password">
							<div id="password-strength"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="conf_password">Confirm Password</label>
						<div class="col-md-9">
							<input type="password" name="confirm_password" class="form-control required" id="conf_password"  placeholder="Re-enter password" >

						</div>
					</div>

					
					<div class="form-group">
					
						<div id="pswd_info" class="col-md-12">
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
					<div class="btn-toolbar">
						<a href="<?php echo site_url ('login/page/login/'.$coaching_id); ?>" class="pull-left">Already have an account? <strong>Sign In</strong></a>									
						<?php
							//echo anchor('users/admin/index/'.$class_id.'/'.$role_id, 'Cancel',array('class'=>'btn btn-default pull-right')); 
						?>
						<input type="submit" name="submit" value="<?php echo ('Save'); ?>" class="btn btn-success pull-right" />
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>