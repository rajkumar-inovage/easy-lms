<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Inovexia Software Services">
	<meta name="description" content="<?php //echo SITE_TITLE; ?> ">
	<meta name="theme-color" content="#FF9800">
	<title><?php if (isset($page_title)) echo $page_title . ': '; echo $this->session->userdata ('SITE_TITLE'); ?></title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font-awesome CSS -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/fontawesome.min.css'); ?>" rel="stylesheet">
    <!-- Chart-Js CSS -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/chart.min.css'); ?>" rel="stylesheet">
    <!-- Toastr CSS -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/toastr.min.css'); ?>" rel="stylesheet">
	<!--  Custom stylesheet -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/essentials.min.css'); ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/dropzone.min.css'); ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/style.css'); ?>" rel="stylesheet">
    <!-- Custom JS (Dynamically included) -->
	<?php
	if (isset ($script_header) && !empty ($script_header)) {
		foreach ($script_header as $script) {
		    echo '<script src="'.base_url($script).'" type="text/javascript"></script>';
		}
	}
	?>
	<link rel="icon" href="<?php echo base_url(THEME_PATH . 'assets/img/favico.png'); ?>" type="image/gif" sizes="512x512">
	<link rel="manifest" href="<?php //echo base_url ('manifest.json'); ?>">

</head>
<body class="<?php if (isset($body_class)) echo $body_class; ?>">
	
	<header class="">
		<nav class="navbar bg-white border-bottom py-1">
            <button type="button" class="navbar-toggle mr-2 p-1 rounded-circle" id="toggle_sidebar_right">
                <img src="<?php echo base_url ('contents/profile_images/default.png'); ?>" class="p-1" width="30"> 
            </button>
            <div class="dropdown d-none">
              <a href="#" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo base_url ('contents/profile_images/default.png'); ?>" class="rounded-circle img-thumbnail" width="30"> 
              </a>
              <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Super Admin</a>
                <a class="dropdown-item" href="#">Logout</a>
              </div>
            </div>
            <a class="navbar-brand mx-auto ml-md-0" href="<?php echo $this->session->userdata ('HOME_URL'); ?>" title="<?php echo $this->session->userdata ('SITE_TITLE'); ?>">
                <?php 
                $logo_path = $this->config->item ('system_logo');
                if (file_exists($logo_path)) {
                    echo '<img src="'.base_url($logo_path).'" alt="'.$this->session->userdata ('SITE_TITLE').'" class=" " width="120" height="" id="" />';
                } else {
                    echo $this->session->userdata ('SITE_TITLE');
                }
                ?>
            </a>
            <!-- Sidebar Toggler -->
            <button class="navbar-toggle" type="button" id="toggle_sidebar_left">
                <span class="icon-bar d-block bg-grey-500"></span>
                <span class="icon-bar d-block bg-grey-500"></span>
                <span class="icon-bar d-block bg-grey-500"></span>
            </button>
            <!-- /Sidebar Toggler -->
		</nav>
	</header>

    <div class="bg-white half shadow-sm sticky-top ">
        <div class="container-fluid">
            <div class="py-2 d-flex justify-content-between">
                <div class="">
                    <?php 
                      if (isset ($bc)) {
                          $bc_link = current ($bc);
                          $bc_title  = key ($bc);
                          echo anchor ($bc_link, '<i class="fa fa-arrow-left"></i> Back ', array('class'=>'btn btn-link', 'title'=>'Back To '.$bc_title)); 
                      }
                    ?>
                </div>

                <div class="">
                    <h4 class="h4"><?php if(isset($page_title)) echo $page_title; ?> </h4>
                </div>

                <div class="right-toolbar">
                    <?php if (! empty ($toolbar_buttons)) { ?>
                        <div class="dropdown show">
                          <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-plus-circle"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <?php foreach ($toolbar_buttons as $title=>$url) { ?>
                                <a class="dropdown-item" href="<?php echo site_url ($url); ?>"><?php echo $title; ?></a>
                            <?php } ?>
                          </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Sidebar left -->
	<div id="sidebar-left" class="sidebar left sidebar-skin-blue">
		<div class="sidebar-block">            
            <div class="profile">
    			<a class="mr-0 ml-0 " href="<?php echo $this->session->userdata ('HOME_URL'); ?>" title="<?php echo $this->session->userdata ('SITE_TITLE'); ?>">
    				<?php 
    				$logo_path = $this->config->item ('system_logo');
    				if (file_exists($logo_path)) {
    					echo '<img src="'.base_url($logo_path).'" alt="'.$this->session->userdata ('SITE_TITLE').'" class=" " width="120" height="" id="" />';
    				} else {
    					echo $this->session->userdata ('SITE_TITLE');
    				}
    				?>
    			</a>
            </div>
    	</div>

        <div class="sidebar-block">            
            <div class="profile">
                <a class="mr-0 ml-0 " href="" title="">
                    <?php echo $this->session->userdata ('user_name'); ?>
                </a>
            </div>
        </div>

		<ul class="sidebar-menu">
			<?php
			$main_menu = $this->session->userdata ('MAIN_MENU');
			$coaching_id = $this->session->userdata ('coaching_id');
            // Side-menu
            if (! empty ($main_menu)) {
                foreach ($main_menu as $menu) {
                    $link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
					?>
					<li class="">
						<a class="" href="<?php echo site_url($link); ?>">
							<?php echo $menu['icon_img']; ?>
							<?php echo $menu['menu_desc']; ?>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</div>
	<!--// Sidebar left -->
    <!-- Sidebar right -->
    <div id="sidebar-right" class="sidebar right sidebar-skin-blue">
        <div class="sidebar-block">            
            <div class="profile text-center">
                <a class="mx-auto" href="#">
                    <?php
                        echo '<img src="'.base_url ('contents/profile_images/default.png').'" class=" " width="120" height="" />';
                    ?>
                </a>
            </div>
        </div>

        <div class="sidebar-block">            
            <div class="profile text-white text-center">
                <a class="mr-0 ml-0 " href="" title="">
                    <?php echo $this->session->userdata ('user_name'); ?>
                </a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="">
                <a class="" href="#">My Account</a>
            </li>
            <li class="">
                <a class="" href="#">Notifications</a>
            </li>
            <li>
                <a class="" href="#">Logout</a>
            </li>
        </ul>
    </div>
    <!--// Sidebar right -->  

	<main id="content" role="main">
		<div class="container-fluid pt-4">          
	