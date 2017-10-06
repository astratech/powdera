<!DOCTYPE html>



<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->



<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->



    <head>



        <meta charset="utf-8">



        <title><?php if(isset($page_title)){echo $page_title;} ?></title>



        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



        <meta http-equiv="refresh" content="300">



        <!-- Icons -->



        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->



        <link rel="shortcut icon" href="<?php echo $this->config->item("admin_assets_url"); ?>/img/favicons/fav.png">



        <!-- END Icons -->



        <!-- Stylesheets -->



        <!-- Web fonts -->



        <!-- Bootstrap and OneUI CSS framework -->



        <link rel="stylesheet" href="<?php echo $this->config->item("admin_assets_url"); ?>/css/bootstrap.min.css">



        <link rel="stylesheet" href="<?php echo $this->config->item("admin_assets_url"); ?>/css/font-awesome.min.css">



        <link rel="stylesheet" id="css-main" href="<?php echo $this->config->item("admin_assets_url"); ?>/css/oneui.css">



        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->



        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->



        <!-- END Stylesheets -->



        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/bootstrap.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.slimscroll.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.scrollLock.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.appear.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.countTo.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.placeholder.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/js.cookie.min.js"></script>



        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/app.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    </head>



    <body>



        <!-- Page Container -->



        <div id="page-container" class="side-scroll header-navbar-fixed header-navbar-transparent">



            <!-- Header -->



            <header id="header-navbar" class="content-mini content-mini-full">



                <div class="content-boxed">



                    <!-- Header Navigation Right -->



                    <ul class="nav-header pull-right">



                        <li>



                            <!-- Themes functionality initialized in App() -> uiHandleTheme() -->



                            <div class="btn-group">



                                <form action='<?php echo $this->config->base_url() ;?>/reset/admin_logout' method='POST' id='form-logout'>



                                </form>



                                <button class="btn btn-danger" type='submit' name='admin_logout' form='form-logout'><i class="si si-logout"></i> Logout</button>



                            </div>



                        </li>



                        <li class="hidden-md hidden-lg">



                            <!-- Toggle class helper (for main header navigation below in small screens), functionality initialized in App() -> uiToggleClass() -->



                            <button class="btn btn-link text-white pull-right" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">



                                <i class="fa fa-navicon"></i>



                            </button>



                        </li>



                    </ul>



                    <!-- END Header Navigation Right -->



                    <!-- Main Header Navigation -->



                    <ul class="js-nav-main-header nav-main-header pull-right">



                        <li class="text-right hidden-md hidden-lg">



                            <!-- Toggle class helper (for main header navigation in small screens), functionality initialized in App() -> uiToggleClass() -->



                            <button class="btn btn-link text-white" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">



                                <i class="fa fa-times"></i>



                            </button>



                        </li>
                        <li>



                            <a class="active" href="<?php echo $this->config->base_url(); ?>admin/stats">Stats</a>



                        </li>


                        <li>



                            <a class="active" href="<?php echo $this->config->base_url(); ?>admin/users">Users</a>



                        </li>



                        <li>



                            <a class="nav-submenu active" href="javascript:void(0)">Power House</a>



                            <ul>



                                <li>



                                    <a href="<?php echo $this->config->base_url(); ?>admin/ph">PH List</a>



                                </li>



                                <li>



                                    <a href="<?php echo $this->config->base_url(); ?>admin/gh">GH List</a>



                                </li>



                                <li>



                                    <a href="<?php echo $this->config->base_url(); ?>admin/merge">Merge List</a>



                                </li>



                                <li> <a href="<?php echo $this->config->base_url(); ?>admin/testimony">My Testimony List</a></li>



                            </ul>



                        </li>



                        <!-- <li>



                            <a class="nav-submenu active" href="javascript:void(0)">Scale</a>



                            <ul>



                                <li>



                                    <a href="<?php echo $this->config->base_url(); ?>admin/scale/ph">PH Scale</a>



                                </li>



                                <li>



                                    <a href="<?php echo $this->config->base_url(); ?>admin/scale/gh">GH Scale</a>



                                </li>



                            </ul>



                        </li> -->



                        <li><a class="active" href="<?php echo $this->config->base_url(); ?>admin/news">News Center</a></li>



                    </ul>



                    <!-- END Main Header Navigation -->



                    <!-- Header Navigation Left -->



                    <ul class="nav-header pull-left">



                        <li class="header-content">



                            <a class="h5" href="index.html">



                            <img src="<?php echo $this->config->item("assets_url"); ?>/images/logo/logo.png">

                            </a>



                        </li>



                    </ul>



                    <!-- END Header Navigation Left -->



                </div>



            </header>



            <!-- END Header -->



            



            