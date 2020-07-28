            </div>
        </div>
    </div>

        <?php if (isset ($right_sidebar) && $right_sidebar == true) { ?>
            <div class="app-menu">
                <div class="p-4 h-100">
                    <div class="scroll">
                        <p class="text-muted text-small">Status</p>
                        <ul class="list-unstyled mb-5">
                            <li class="active">
                                <a href="#">
                                    <i class="simple-icon-refresh"></i>
                                    Active Surveys
                                    <span class="float-right">12</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="simple-icon-check"></i>
                                    Completed Surveys
                                    <span class="float-right">24</span>

                                </a>
                            </li>
                        </ul>

                        <p class="text-muted text-small">Categories</p>
                        <ul class="list-unstyled mb-5">
                            <li>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="category1">
                                    <label class="custom-control-label" for="category1">Development</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="category2">
                                    <label class="custom-control-label" for="category2">Workplace</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" class="custom-control-input" id="category3">
                                    <label class="custom-control-label" for="category3">Hardware</label>
                                </div>
                            </li>
                        </ul>




                        <p class="text-muted text-small">Labels</p>
                        <div>
                            <p class="d-sm-inline-block mb-1">
                                <a href="#">
                                    <span class="badge badge-pill badge-outline-primary mb-1">NEW FRAMEWORK</span>
                                </a>
                            </p>

                            <p class="d-sm-inline-block mb-1">
                                <a href="#">
                                    <span class="badge badge-pill badge-outline-theme-3 mb-1">EDUCATION</span>
                                </a>
                            </p>
                            <p class="d-sm-inline-block  mb-1">
                                <a href="#">
                                    <span class="badge badge-pill badge-outline-secondary mb-1">PERSONAL</span>
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
                <a class="app-menu-button d-inline-block d-xl-none" href="#">
                    <i class="simple-icon-options"></i>
                </a>
            </div>
        <?php } ?>
    </main>

    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted"><?php echo BRANDING_TEXT; ?></p>
                    </div>
                    <div class="col-sm-6 d-none">
                        <ul class="breadcrumb pt-0 pr-0 float-right">
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Review</a>
                            </li>
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Purchase</a>
                            </li>
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Docs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	<footer class="fixed-bottom mt-0 d-none">
		<nav class="bg-white border-top">
            <ul class="nav nav-tabs nav-justified ">
                <?php 
                $role_id = $this->session->userdata ('role_id');
                $footer_menu = $this->common_model->load_acl_menus ($role_id, 0, MENUTYPE_FOOTER);
                if (! empty ($footer_menu)) {
                    foreach ($footer_menu as $menu) {
                        $link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;
                        ?>
                        <li class="nav-item ">
                            <a class="nav-link px-0 border-top-0 rounded-0<?php echo ($this->router->fetch_class() == $menu['controller_nm'])?' active':'';?>" href="<?php echo site_url ($link); ?>">
                                <div class="<?php echo ($this->router->fetch_class() == $menu['controller_nm'])?'text-blue-400':'text-grey-600';?>"><?php echo $menu['icon_img']; ?></div>
                                <div class="<?php echo ($this->router->fetch_class() == $menu['controller_nm'])?'text-blue-400':'text-grey-600';?>"><?php echo $menu['menu_desc']; ?></div>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </nav>
	</footer>    

	<div id="loader">
		<!--<img src="<?php echo base_url (THEME_PATH . 'assets/img/loader.gif'); ?>" width="30" height="30">-->
	</div>    

    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/perfect-scrollbar.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/progressbar.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/select2.full.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/mousetrap.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/jquery.contextMenu.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/vendor/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/dore.script.js'); ?>"></script>

	<!-- Default JS (Must be loaded befaore app.js) -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/default.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/scripts.js'); ?>"></script>

	<!-- Toastr JS for notifications -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/toastr.min.js'); ?>"></script>
	<!-- ChartJS -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/chart.bundle.min.js'); ?>"></script>

	<!-- Application JS -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/app.js?ver=1.5'); ?>"></script>
	<!-- Custom JS (Dynamically included) -->
	<?php
	if (isset ($script)) {
		echo $script;	
	}

	$this->load->view ('templates/common/scripts');
	?>	

</body>

</html>