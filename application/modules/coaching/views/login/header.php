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
	<link rel="icon" href="<?php echo base_url(THEME_PATH . 'assets/img/fav-icon.png'); ?>" type="image/png" sizes="512x512">
	<link rel="manifest" href="<?php echo base_url ('manifest.json'); ?>">

</head>
<body class="<?php if (isset($body_class)) echo $body_class; ?>">

	<main id="content" role="main" class="mb-4">
		<div class="container pt-4">          
			<div class="row justify-content-center">
			   	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4 ">
				  <?php $this->message->display (); ?>
				</div>
		  	</div>