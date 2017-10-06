<!DOCTYPE html>

<html lang="">

<head>

    <meta charset="utf-8">

    <title>KashOut Office</title>



    <!-- Begin Vendor CSS -->

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/components-font-awesome/css/font-awesome.css" />

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" />

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/nvd3/build/nv.d3.min.css">

    <!-- End Vendor CSS -->



    <!-- Begin XPLOIT CSS -->

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/styles/xploit.css">

    <!-- End XPLOIT CSS -->



    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>

        .nv-x .tick {

          opacity: 0 !important;

        }



        .nv-y path {

            display: none;

        }



        .nv-y text {

            fill: #aaa;

            font-weight: normal !important;

        }



        .highcharts-tooltip > path{

            fill: #000 !important;

            stroke: transparent;

        }

        .highcharts-tooltip > text {

            fill: #fff !important;

        }



        .highcharts-tooltip > text > tspan:first-child {

            text-transform: uppercase;

            font-size: 14px !important;

            margin-bottom: 15px;

        }

    </style>

</head>

<body class="navbar-collapsed">



    <!-- Begin Content Wrapper -->

    <div class="content-wrapper">

        <!-- Begin Page Content -->

        <main id="page-content">

            <h1 class="text-center">KashOut Office Security</h1>

            <div class="modal-dialog modal-md">

                <div class="modal-content-container">

                    <!-- Begin Modal Content -->

                    <div class="modal-content">

                        <!-- Begin Modal Header -->

                        <div class="modal-header">

                            <p><a href="https://kashout.biz"><i class="fa fa-home"></i> Return Home</a></p>

                        </div>

                        <!-- End Modal Header -->



                        <!-- Begin Modal Body -->

                        <div class="modal-body">

                            <?php 



                                if(isset($_SESSION['notification'])){



                                    echo $_SESSION['notification'];



                                }



                            ?>

                            <!-- Begin Form -->

                            <form id="form-one" class="m-md-t" method="POST" action="">



                                <!-- Begin Form Group -->

                                <div class="form-group">

                                    <!-- <label for="exampleInputPassword1"><i class="fa fa-lock m-xs-r"></i>Password</label> -->

                                    <div class="g-recaptcha" data-sitekey="6LcFoSMUAAAAAOfl-gn6CPoRvT6YRr-VUlievfTD"></div>

                                </div>

                                <!-- End Form Group -->



                                    <!-- End Form Group -->

                                    <input class="btn btn-primary w-150 m-sm-t pull-right" type="submit" name="sub_secure" value="Submit">



                                    <div class="clearfix"></div>

                                <p></p>

                            </form>

                            <!-- End Form -->



                        </div>

                        <!-- End Modal Body -->

                    </div>

                    <!-- End Modal Content -->  

                </div>

            </div>

        </main>

        <!-- End Page Content -->



        <!-- Begin Page Footer -->

        <footer id="page-footer">

            <p class="m-n text-center">KashOut</p>

        </footer>

        <!-- End Page Footer -->

    </div>

    <!-- End Content Wrapper -->





    <!-- Begin Vendor JS -->

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/jquery/jquery.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/bootstrap/dist/js/bootstrap.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/kapusta-jquery.sparkline/dist/jquery.sparkline.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/d3/d3.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/nvd3/build/nv.d3.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/raphael/raphael.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/jquery-mapael/js/jquery.mapael.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/jquery-mapael/js/maps/usa_states.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/highcharts/highcharts.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/plugins/rickshaw/rickshaw.min.js"></script>

    <!-- End Vendor JS -->





    <!-- Begin XPLOIT JS -->

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/xploit.js"></script>

    <!-- End XPLOIT JS -->



    <!-- Begin Page Level JS -->

    <script src="<?php echo $this->config->item('assets_url'); ?>/scripts/pages/dashboard.js"></script>

    <!-- End Page Level JS -->

</body>

</html>

