<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Forgot Password</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/dist/css/main.css">

        <script src="<?php echo $this->config->item('assets_url'); ?>/js/modernizr-custom.js"></script>
    </head>
    <body style="background-color: #63a872;">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo $this->config->item('assets_url'); ?>/logo.png" width="130px" alt=""/></h2>
                    <h4></h4>
                </div>

                <form class="sign-in-form" role="form" action="" method="POST">
                    <?php 
                        if(isset($_SESSION['notification'])){

                            echo $_SESSION['notification'];

                        }
                    ?>
                     <div class="form-group">
                            <p>The Change Password link will be sent to your email.</p>
                            <label>Email</label>
                            <input class="form-control" type="type" name="email">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary sm-max" type="submit" name="forgot" value="Send Link">
                        </div>
                </form>
                <div class="text-center copyright-txt">
                    <small>Flex10ng - Copyright © 2017</small>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="<?php echo $this->config->item('assets_url'); ?>/dist/js/main.js"></script>

    </body>
</html>
