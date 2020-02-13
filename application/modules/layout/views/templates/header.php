<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Inovexia Software Services">
	<meta name="description" content="<?php //echo SITE_TITLE; ?> ">
	<meta name="theme-color" content="#FF9800">
	<title><?php if (isset($page_title)) echo $page_title . ': '; echo $this->session->userdata ('SITE_TITLE'); ?></title>
    
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
	
	<header>
		<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm">
				
			<!-- Sidebar Toggler -->
			<button class="mr-2 navbar-toggle" type="button" id="toggle_sidebar">
                <span class="icon-bar d-block bg-grey-500"></span>
                <span class="icon-bar d-block bg-grey-500"></span>
                <span class="icon-bar d-block bg-grey-500"></span>
            </button>
			<!-- /Sidebar Toggler -->
			
			<a class="navbar-brand" href="<?php echo $this->session->userdata ('HOME_URL'); ?>" title="<?php echo $this->session->userdata ('SITE_TITLE'); ?>">
				<?php 
				$logo_path = $this->config->item ('system_logo');
				if (file_exists($logo_path)) {
					echo '<img src="'.base_url($logo_path).'" alt="'.$this->session->userdata ('SITE_TITLE').'" class=" " width="120" height="" id="" />';
				} else {
					echo $this->session->userdata ('SITE_TITLE');
				}
				?>
			</a>
            
            <span class="navbar-text font-weight-bold d-none d-md-block mr-auto"><?php if(isset($page_title)) echo $page_title; ?></span>
            
            <div class="btn-group ml-auto">
	      
              <button type="button" class="btn btn-white dropdown-toggle rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Super
              </button>
              <div class="dropdown-menu dropdown-menu-right">
    			<a class="dropdown-item" href="#" onclick="logout_user ()"><i class="fa fa-sign-out-alt"></i> Sign-out</a>
              </div>
            </div>
		</nav>
	</header>
	
	<!-- Sidebar -->
	<div id="sidebar" class="sidebar sidebar-skin-white">
		<div class="">
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
	</div>
	<!--// Sidebar -->	

	<main id="content" role="main">
		<div class="container-fluid">			
            <div class="page-title">
				<h2 class="h2 mt-1"><?php if(isset($sub_title)) echo $sub_title; ?></h2>
			</div>
			
			<div class="btn-toolbar justify-content-between mb-2" role="toolbar" aria-label="Toolbar with button groups">
    		  <div class="">
    			  <?php 
    			  if (isset ($bc)) {
    			      $bc_link = current ($bc);
    			      $bc_title  = key ($bc);
    			      echo anchor ($bc_link, '<i class="fa fa-arrow-left"></i> Back ', array('class'=>'btn btn-link', 'title'=>'Back To '.$bc_title)); 
    			  }
    			  ?>
    		  </div>

			  <?php if (! empty ($toolbar_buttons)) { ?>
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                  
                  <div class="btn-group" role="group">
                    <button id="action_buttons" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="action_buttons">
                    <?php                 
            		  foreach ($toolbar_buttons as $title=>$url) {
            		    ?>
                        <a class="dropdown-item" href="<?php echo site_url ($url); ?>"><?php echo $title; ?></a>
                        <?php
            		  }
            		?>
                    </div>
                  </div>
				</div>
              <?php	} ?>
              
            </div>
	