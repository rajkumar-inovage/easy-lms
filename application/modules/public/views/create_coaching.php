<div class="row mb-4 justify-content-center align-middle v-middle ">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 text-center">
    <img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center mr-auto ml-auto">
  </div>
</div>

<div class="card paper-shadow" data-z="0.5">

    <?php echo form_open ('public/page_actions/create_coaching', array ('class'=>'', 'id'=>'validate-')); ?>
        <div class="card-header ">
    		<h4 class="">Basic Details</h4>
    		<p class="text-subhead ">Add your coaching name, location and other detail</p>
        </div>
    	<div class="card-body ">

            <div class="form-group ">
                <label class="control-label">Coaching Name<span class="required">*</span></label>
                <input type="text" name="coaching_name" class="form-control required" value = "<?php echo set_value('coaching_name', $coaching['coaching_name']) ; ?>">
                <p class="text-muted">Provide the name of your coaching or institute. Should be alpha-numeric.</p>
            </div>

			<div class="form-group ">
                <label class="control-label">Coaching Identifier<span class="required">*</span></label>
                <input type="text" name="coaching_url" class="form-control required" value = "<?php echo set_value('coaching_url', $coaching['coaching_url']) ; ?>" >
                <p class="text-muted">Should be unique, alpha-numeric. This will be used by your users to identify your coaching. <br> <span class="font-weight-bold">Example <strong>apexdelhi</strong>, <strong>sacademy</strong></span>
                </p>
			</div>

            <div class="form-group ">    			
				<label class=" control-label">City<span class="required">*</span></label>
				<input type="text" name="city" class="form-control required" value = "<?php echo set_value('city', $coaching['city']) ; ?>">
			</div>

			<div class="form-group ">				
                <label class=" control-label">Website (if any)</label>
				<input type="text" name="website" class="form-control " value = "<?php echo set_value('website', $coaching['website']) ; ?>">
			</div>
		</div>

        <div class="card-header ">
            <h4 class="">Create Admin Account</h4>
            <p class="text-subhead ">Add admin name, mobile and email</p>
        </div>
        <div class="card-body ">    		
            <div class="form-group ">
				<label>First Name<span class="required">*</span></label>
				<input type="text" name="first_name" class="form-control required" value = "<?php echo set_value('first_name', $coaching['fname']) ; ?>">
            </div>

            <div class="form-group ">
				<label>Last Name<span class="required">*</span></label>
				<input type="text" name="last_name" class="form-control required" value = "<?php echo set_value('last_name', $coaching['last_name']) ; ?>">
    		</div>
    			
    		<div class="form-group ">
				<?php echo form_label('Contact No<span class="required">*</span>', '', array('class'=>'control-label')); ?>
				<?php echo form_input(array('name'=>'primary_contact', 'class'=>'form-control digits required', 'value'=>set_value('primary_contact', $coaching['contact']) ));?>
			</div>

            <div class="form-group ">
				<?php echo form_label('E Mail<span class="required">*</span>', '', array('class'=>'control-label')); ?>
				<?php echo form_input(array('name'=>'email', 'class'=>'form-control email required', 'value'=>set_value('email', $coaching['email']), 'id'=>'email', 'onblur'=>'')); ?>
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
			<?php 
			echo form_submit ( array ('name'=>'submit', 'value'=>'Save ', 'class'=>'btn btn-primary ')); 
			?>
		</div>
	</form>
</div>