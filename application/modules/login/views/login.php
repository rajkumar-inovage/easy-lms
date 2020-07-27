<div class="row h-100">
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card shadow">
            <div class="position-relative image-side text-center">

                <p class=" text-white h2">DON'T HAVE AN ACCOUNT? <br>SIGN-UP</p>

                <p class="white mb-0">
                    <br> 
                    <a href="#" class="btn btn-light ">Register as a student</a>
                </p>
            </div>
            <div class="form-side">
                <?php if ( is_file ($logo)) { ?>
                    <img src="<?php echo $logo; ?>" height="50" title="<?php echo $page_title; ?>" class="text-center">
                <?php } else { ?>
                    <h4 class="text-center"><?php echo $page_title; ?></h4>
                <?php } ?>
                <h6 class="text-center">Sign in with your credentials</h6>
                <?php echo form_open ('login/login_actions/validate_login', array('id'=>'login-form')); ?>
                    <label class="form-group has-float-label mb-4">
                        <input class="form-control" placeholder="Mobile No/Email-id/User-ID" type="text" name="username">
                        <span>Mobile/Email/User-id</span>
                    </label>

                    <label class="form-group has-float-label mb-4">
                        <input class="form-control" placeholder="Password" type="password" name="password">
                        <span>Password</span>
                        <a href="<?php echo site_url ('login/user/reset_password'); ?>" class="text">Reset password</a>
                    </label>
                    <?php if ($access_code != '' && $found == true) { ?>
                        <label class="form-group has-float-label mb-4">
                          <input class="form-control" placeholder="Access Code" type="text" name="access_code" value="<?php echo $access_code; ?>" readonly>
                            <span>Access Code</span>
                        </label>
                    <?php } else { ?>
                        <label class="form-group has-float-label mb-4">
                            <input class="form-control" placeholder="Access Code" type="text" name="access_code" value="<?php echo $access_code; ?>" >
                            <span>Access Code</span>
                            <a href="<?php echo site_url ('login/user/get_access_code'); ?>" class="text">Get Access Code</a>
                        </label>
                    <?php } ?>

                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>