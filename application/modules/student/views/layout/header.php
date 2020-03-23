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
        <div class="container-sm">
    		<nav class="navbar bg-white border-bottom py-0 d-flex justify-content-between">
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
	       	</nav>
        </div>
	</header>
	
	<!-- Sidebar -->
	<div id="sidebar" class="sidebar left sidebar-skin-blue">
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
			// Side-menu
			if (! empty ($main_menu)) {
				foreach ($main_menu as $menu) {
					$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'];
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
	