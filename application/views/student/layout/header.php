<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Inovexia Software Services">    
    <meta name="description" content="<?php echo SITE_TITLE; ?> ">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Easy Coaching App">
    <meta name="apple-mobile-web-app-title" content="Easy Coaching App">
    <meta name="theme-color" content="#4285F4">
    <meta name="msapplication-navbutton-color" content="#4285F4">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="<?php echo site_url (''); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--==== Apple Touch Icons ====-->
    <link rel="icon" sizes="128x128" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon128.png'); ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon128.png'); ?>">
    <link rel="icon" sizes="192x192" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon192.png'); ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon192.png'); ?>">
    <link rel="icon" sizes="256x256" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon256.png'); ?>">
    <link rel="apple-touch-icon" sizes="256x256" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon256.png'); ?>">
    <link rel="icon" sizes="384x384" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon384.png'); ?>">
    <link rel="apple-touch-icon" sizes="384x384" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon384.png'); ?>">
    <link rel="icon" sizes="512x512" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon512.png'); ?>">
    <link rel="apple-touch-icon" sizes="512x512" href="<?php echo base_url(THEME_PATH . 'assets/img/touch/app-icon512.png'); ?>">

    <!--==== Fav-icon ====-->
    <link rel="icon" href="<?php echo base_url(THEME_PATH . 'assets/img/fav-icon.png'); ?>" type="image/png" sizes="512x512">
    <!--==== Manifest JSON ====-->
    <link rel="manifest" href="<?php echo base_url ('manifest.json'); ?>">

    <title><?php if (isset($page_title)) echo $page_title . ': '; echo $this->session->userdata ('site_title'); ?></title>

    <!--==== Core CSS ====-->
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/font/iconsmind-s/css/iconsminds.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/font/simple-line-icons/css/simple-line-icons.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/font/fontawesome/fontawesome.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/bootstrap.rtl.only.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/bootstrap-datepicker3.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/perfect-scrollbar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/baguetteBox.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/glide.core.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/select2.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/jquery.contextMenu.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/vendor/component-custom-switch.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(THEME_PATH . 'assets/css/main.css'); ?>" />
    <!--==== Other CSS ====-->
    <!-- Toastr CSS -->
    <link type="text/css" href="<?php echo base_url(THEME_PATH . 'assets/css/toastr.min.css'); ?>" rel="stylesheet">

    <!-- Custom JS (Dynamically included) -->
    <?php
    if (isset ($script_header) && !empty ($script_header)) {
        foreach ($script_header as $script) {
            echo '<script src="'.base_url($script).'" type="text/javascript"></script>';
        }
    }
    ?>

</head>

<body id="app-container" class="menu-sub-hidden show-spinner <?php if (isset ($right_sidebar) && $right_sidebar == true) { echo 'right-menu'; } ?>">
    <?php
        $coaching_id = $this->session->userdata ('coaching_id');
        $member_id = $this->session->userdata ('member_id');
    ?>
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>           
            <a class="btn btn-sm btn-outline-primary ml-3 d-none d-md-inline-block" href="<?php echo site_url('student/courses/index/'.$coaching_id. '/'.$this->session->userdata ('member_id')); ?>" data-toggle="tooltip" data-placement="right" title="Buy Course"><i class="iconsminds-shopping-cart"></i> BUY</a>
        </div>


        <a class="navbar-logo" href="">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1" 
                        data-toggle="tooltip" data-placement="left" title="Dark Mode">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>

                <div class="position-relative d-none __d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-equalizer d-block"></i>
                            <span>Settings</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Users</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-puzzle d-block"></i>
                            <span>Components</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-bar-chart-4 d-block"></i>
                            <span>Profits</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-file d-block"></i>
                            <span>Surveys</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-suitcase d-block"></i>
                            <span>Tasks</span>
                        </a>

                    </div>
                </div>

                <div class="position-relative d-none __d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                        <div class="scroll">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/notification-thumb.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/notification-thumb-2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 ">
                                <a href="#">
                                    <img src="img/notification-thumb-3.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                        </p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name"><?php echo $this->session->userdata ('user_name'); ?></span>
                    <span>
                        <img alt="Profile Picture" src="<?php echo base_url ($this->session->userdata ('profile_image')); ?>" class="bg-white"/>
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item py-0" href="<?php echo site_url ('coaching/users/my_account/'.$coaching_id.'/'.$member_id); ?>">
                        <div class="d-flex">
                            <i class="flex-shrink-0 iconsminds-id-card fa-2x"></i>
                            <span class="flex-grow-1 my-auto ml-1">My Account</span>
                        </div>
                    </a>
                    <a class="dropdown-item py-0" href="<?php echo site_url ('coaching/users/my_password/'.$coaching_id.'/'.$member_id); ?>">
                        <div class="d-flex">
                            <i class="flex-shrink-0 iconsminds-type-pass fa-2x"></i>
                            <span class="flex-grow-1 my-auto ml-1">Change Password</span>
                        </div>
                    </a>
                    <a class="dropdown-item py-0" href="#" onclick="logout_user ()">
                        <div class="d-flex">
                            <i class="flex-shrink-0 iconsminds-lock-2 fa-2x"></i>
                            <span class="flex-grow-1 my-auto ml-1">Logout</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="menu">
        <div class="main-menu rounded-0">
            <div class="scroll">
                <ul class="list-unstyled">
                    <?php
                    $main_menu = $this->session->userdata ('MAIN_MENU');
                    $coaching_id = $this->session->userdata ('coaching_id');
                    // Side-menu
                    if (! empty ($main_menu)) {
                        foreach ($main_menu as $menu) {
                            $link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
                            $nameMatch = $this->uri->segment(2) == $menu['controller_nm'];
                            $actionMatch = $this->uri->segment(3) == $menu['action_nm'];
                            $active = ($nameMatch && $actionMatch)? ' class="active"':'';
                            if ($this->session->userdata ('role_id') == USER_ROLE_STUDENT) {
                                $link .= '/'.$this->session->userdata ('member_id');
                            }
                            ?>
                            <li<?php echo $active; ?>>
                                <a class="" href="<?php echo site_url($link); ?>">
                                    <?php echo $menu['icon_img']; ?>
                                    <span><?php echo $menu['menu_desc']; ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>                    
                </ul>

                <div class="sidebar-block">
                    <div class="" id="installBanner" style="visibility: hidden;">
                        <button class="btn btn-success " id="installBtn"><i class="fab fa-android"></i> Install App</button>
                    </div>
                </div>

            </div>
        </div>                
           
    </div>

    <main>
        <div class="container-fluid">
             <div class="row <?php if (isset ($right_sidebar)) echo 'app-row'; ?>">
                <div class="col-12">
                    <div class="d-flex mb-2">
                        <?php 
                            if (isset ($bc)) {
                                $bc_link = current ($bc);
                                $bc_title  = key ($bc);
                                echo anchor ($bc_link, '<i class="fa fa-long-arrow-alt-left"></i> ', array('class'=>'flex-shrink-0 my-auto btn btn-outline-primary icon-button mr-2', 'title'=>'Back To '.$bc_title)); 
                            }
                        ?>
                        <h1 class="flex-grow-1 my-auto py-0">
                            <?php if(isset($page_title)) echo $page_title; ?>
                        </h1>
                        <div class="flex-shrink-0 my-auto">
                        <?php if (! empty ($toolbar_buttons)) { ?>
                            <button type="button" class="btn btn-outline-primary icon-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php foreach ($toolbar_buttons as $title=>$url) { ?>
                                    <a class="dropdown-item" href="<?php echo site_url ($url); ?>"><?php echo $title; ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>
      
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4 col-sm-8">
                          <?php $this->message->display (); ?>
                        </div>
                    </div>