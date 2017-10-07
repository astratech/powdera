<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title><?php if(isset($page_title)){ echo $page_title; }else{ };?></title>

        <!-- inject:css -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/dist/css/main.css">

        <!-- Rickshaw Chart Depencencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/rickshaw/rickshaw.min.css">

        <!--easypiechart-->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/assets/js/jquery-easy-pie-chart/easypiechart.css">

        <!--horizontal-timeline-->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/assets/js/horizontal-timeline/css/style.css">

        <!-- Switchery Dependencies -->
        <!-- iOS 7 style switches for your checkboxes  -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/switchery/dist/switchery.min.css">

        <!-- Bootstrap Date Range Picker Dependencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css">

        <!-- Bootstrap DatePicker Dependencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">

        <!-- Bootstrap TimePicker Dependencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

        <!-- Bootstrap ColorPicker Dependencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">


        <!-- FOR TABLE -->
        <!--Data Table-->
        <link href="<?php echo $this->config->item('assets_url'); ?>/bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('assets_url'); ?>/bower_components/datatables-tabletools/css/dataTables.tableTools.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('assets_url'); ?>/bower_components/datatables-colvis/css/dataTables.colVis.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('assets_url'); ?>/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
        <link href="<?php echo $this->config->item('assets_url'); ?>/bower_components/datatables-scroller/css/scroller.dataTables.scss" rel="stylesheet">


        <!-- Select2 Dependencies -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/select2/dist/css/select2.min.css">

        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
         <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        
        <!-- Select2 Dependencies -->
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/select2/dist/js/select2.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/assets/js/init-select2.js"></script>

         <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/assets/js/init-daterangepicker.js"></script>

        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


    </head>
    <body>
        <script type="text/javascript">
            $(function() {
                $(".s2").select2({
                     placeholder: "",
                 });

                $('#pick-date1').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true
                });

                $('#pick-date2').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true
                });
            });
        </script>

        <style type="text/css">
            .dform input{
                margin-bottom: 0px;
            }

            a, h1,h2,h3,h4,h5,h6{
                    color: #000!important;
                }

            .select2{
                width: 100%!important;
            }
        </style>

        <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header" style="background-color: #62549a; color: #fff;">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="<?php echo $this->full_url; ?>dashboard" class="navbar-brand">
                         <span class="logo"><img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" alt="" class="img-responsive" /></span>
                        <span class="logo-compact">P</span>
                    </a>
                    <!--logo end-->
                </div>

                <div class="search-dropdown dropdown pull-right visible-xs">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                    <div class="dropdown-menu">
                        <form >
                            <input class="form-control" placeholder="Search here..." type="text">
                        </form>
                    </div>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav" style="background-color: #7a5796;">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->

                    <!--search start-->
                    <form class="search-content hidden-xs" >
                       <!--  <button type="submit" name="search" class="btn srch-btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" class="form-control" name="keyword" placeholder="Search here..."> -->
                    </form>
                    <!--search end-->

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-usermenu">
                            <a href="index.html#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="user-avatar"><img src="<?php echo $this->config->item('assets_url'); ?>/imgs/a0.jpg" alt="..."></div>
                                <span class="hidden-sm hidden-xs" style="color: #fff;">Welcome</span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs" style="color: #fff;"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li>
                                <button type='submit' name='admin_logout' form='form-logout' class="btn btn-sm btn-link" style="margin-left: 20px; margin-top: 0px; color: #000;"><i class="fa fa-power-off"></i> LOG OUT</button>
                                 <form action='<?php echo $this->config->base_url() ;?>reset/admin_logout' method='POST' id='form-logout'></form>
                            </li>
                            </ul>
                        </li>
                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->

             <style type="text/css">

            </style>
            <!--sidebar start-->
            <!-- <aside id="aside" class="ui-aside" style="background-color: #cc4aa3;"> -->
            <aside id="aside" class="ui-aside" style="background-color: #fafafa; color: #000;">
                <ul class="nav" ui-nav="">
                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">WareHouse Manager</h5>
                    </li>

                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>dashboard.php"><i class="fa fa-circle-o"></i><span>Dashboard </span></a>
                    </li>

                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>inventory.php"><i class="fa fa-circle-o"></i><span>Production Inventory </span></a>
                    </li>

                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>requests.php"><i class="fa fa-circle-o"></i><span>Approve Requests </span></a>
                    </li>


                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>leave.php">
                            <i class="fa fa-bookmark-o"></i><span>Create Leave </span>
                        </a>
                    </li>

                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>payslip.php"><i class="fa fa-credit-card"></i><span>Pay Slip </span></a>
                    </li>

                    <li class="active">
                        <a href="<?php echo $this->full_url; ?>profile.php"><i class="fa fa-user"></i><span>Profile </span></a>
                    </li>
                </ul>
                <div>
                    <img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" alt="" class="img-responsive" style="margin-top: 80%; width: 100%; opacity: .3;" />
                </div>
            </aside>
            <!--sidebar end-->

