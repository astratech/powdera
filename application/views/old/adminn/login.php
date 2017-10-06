<!DOCTYPE html>

<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->

<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">

        <title>Admin Login</title>

        <meta name="description" content="">

        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->

        <link rel="shortcut icon" href="<?php echo $this->config->item("admin_assets_url"); ?>/img/favicons/fav.png">

        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Web fonts -->

        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700"> -->

        <!-- Bootstrap CSS framework -->

        <link rel="stylesheet" href="<?php echo $this->config->item("admin_assets_url"); ?>/css/bootstrap.min.css">

        <link rel="stylesheet" id="css-main" href="<?php echo $this->config->item("admin_assets_url"); ?>/css/oneui.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->

        <!-- END Stylesheets -->

        <!-- Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/bootstrap.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.slimscroll.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.scrollLock.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.appear.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.countTo.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/jquery.placeholder.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/core/js.cookie.min.js"></script>

        <script src="<?php echo $this->config->item("admin_assets_url"); ?>/js/app.js"></script>

    </head>

    <body>

        <!-- Login Content -->

        <div class="content overflow-hidden">

            <div class="row">

                <div class="col-md-6 col-md-offset-3 ">

                    

                </div>

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

                    <!-- Login Block -->

                    <img src="<?php echo $this->config->item("assets_url"); ?>/img/logo.png" alt="">

                    <div class="block block-themed animated fadeIn">

                        <div class="block-header bg-danger">

                            <ul class="block-options">

                                

                            </ul>

                            <h3 class="block-title">Login</h3>

                        </div>

                        <div class="block-content block-content-full block-content-narrow">

                           

                            <!-- Login Form -->

                            <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->

                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->

                            <?php 

                                if(isset($_SESSION['notification'])){

                                    echo $_SESSION['notification'];

                                }

                            ?>

                            <form class="js-validation-login form-horizontal push-30-t push-50" action="" method="post">

                            <div class="form-group">

                                    <div class="col-xs-12">

                                        <a class="btn btn-block btn-primary pull-right" href="<?php echo $this->config->base_url(); ?>" style="text-align:center;"><i class="fa fa-home"></i> Home</a>

                                    </div>

                                </div>

                            

                                <div class="form-group">

                                    <div class="col-xs-12">

                                        <div class="form-material form-material-primary floating">

                                            <input class="form-control" type="text" name="email">

                                            <label>Email</label>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-xs-12">

                                        <div class="form-material form-material-primary floating">

                                            <input class="form-control" type="password" id="login-password" name="password">

                                            <label for="login-password">Password</label>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-xs-12">

                                        <label class="css-input switch switch-sm switch-success">

                                            <input type="checkbox" id="login-remember-me"><span></span> Remember Me?

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-xs-12 col-sm-6 col-md-4">

                                        <input type="submit" id="sub-btn" class="btn btn-effect-ripple btn-success" name="login" value="Login"/>

                                    </div>

                                </div>

                            </form>

                            <!-- END Login Form -->

                        </div>

                    </div>

                    <!-- END Login Block -->

                </div>

            </div>

        </div>

        <!-- END Login Content -->

        <!-- Login Footer -->

        <div class="push-10-t text-center animated fadeInUp">

            <small class="text-muted font-w600"><?php echo date("Y"); ?> &copy;</small>

        </div>

        <!-- END Login Footer -->

        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->

        <script src="assets/js/core/jquery.min.js"></script>

        <script src="assets/js/core/bootstrap.min.js"></script>

        <script src="assets/js/core/jquery.slimscroll.min.js"></script>

        <script src="assets/js/core/jquery.scrollLock.min.js"></script>

        <script src="assets/js/core/jquery.appear.min.js"></script>

        <script src="assets/js/core/jquery.countTo.min.js"></script>

        <script src="assets/js/core/jquery.placeholder.min.js"></script>

        <script src="assets/js/core/js.cookie.min.js"></script>

        <script src="assets/js/app.js"></script>

        <!-- Page JS Plugins -->

        <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->

        <script src="assets/js/pages/base_pages_login.js"></script>

    </body>

</html>