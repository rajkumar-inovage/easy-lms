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
	
	<header class="sticky-top mb-2">
		<nav class="navbar bg-white border-bottom py-0 ">
            <div class="container-sm d-flex justify-content-between">
                <div class="">
                    <?php 
                      if (isset ($bc)) {
                          $bc_link = current ($bc);
                          $bc_title  = key ($bc);
                          echo anchor ($bc_link, '<i class="fa fa-arrow-left"></i> Back ', array('class'=>'btn btn-link', 'title'=>'Back To '.$bc_title)); 
                      }
                    ?>
                </div>

                <span class="navbar-brand"><?php if(isset($page_title)) echo $page_title; ?> </span>

                <!-- Sidebar Toggler -->
                <button class="navbar-toggle" type="button" id="toggle_sidebar">
                    <span class="icon-bar d-block bg-grey-500"></span>
                    <span class="icon-bar d-block bg-grey-500"></span>
                    <span class="icon-bar d-block bg-grey-500"></span>
                </button>
                <!-- /Sidebar Toggler -->
            </div>
       	</nav>
	</header>
	
	<!-- Sidebar -->
	<div id="sidebar" class="sidebar left sidebar-skin-blue">
		<div class="sidebar-block">            
            <div class="profile">
    			<a class="" href="<?php echo site_url ($this->session->userdata ('dashboard')); ?>" title="<?php echo $this->session->userdata ('site_title'); ?>">
                    <img src="<?php echo $this->session->userdata ('logo'); ?>" alt="<?php echo $this->session->userdata ('site_title'); ?>" class="mr-auto ml-auto" width="" height="40" >
    			</a>
            </div>
    	</div>

        <div class="sidebar-block">            
            <div class="py-2 text-white">
                <img src="<?php echo base_url($this->session->userdata ('profile_image')); ?>" alt="<?php echo $this->session->userdata ('user_name'); ?>" class="mr-auto ml-auto" width="" height="30" >
                <span class="mt-3"><?php echo $this->session->userdata ('user_name'); ?></span>
            </div>
        </div>

		<ul class="sidebar-menu">
			<?php
            $main_menu = $this->session->userdata ('MAIN_MENU');
            $coaching_id = $this->session->userdata ('coaching_id');
			$member_id = $this->session->userdata ('member_id');
            
			// Side-menu
			if (! empty ($main_menu)) {
				foreach ($main_menu as $menu) {
					$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;
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
	<!--// Sidebar -->	

	<main id="content" role="main" class="mb-4">
		<div class="container-sm">
	        <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 col-sm-8">
                  <?php $this->message->display (); ?>
                </div>
            </div>