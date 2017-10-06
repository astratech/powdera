<!DOCTYPE html>
<html>
    <head>
        <title>Register Account :: StanbicLife</title>
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <meta content="Get 100% in 10Days" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="<?php echo $this->config->item('assets_url'); ?>/images/favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/plugins/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/plugins/animate/animate.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/css/main.css"/>

        <script src="<?php echo $this->config->item('assets_url'); ?>/plugins/jquery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url'); ?>/js/app.js"></script>
    </head>
    <body>
        
        <div class="auth-wrapper col-md-12" style="">
            <div class="auth-header text-center" style="background-image: url();">
               <img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" class="img-responsive">
               <h2 style="color: #fff; text-align: center; font-size: 22px;">STANBIC LIFE</h2>
            </div>
            <div class="auth-body">
                <form action="" method="POST">

                    <div class="auth-content">
                        <div class="form-group">
                            <p class="text-center" style="font-size: 22px;"> Register </p>
                            <?php 
                                if(isset($_SESSION['notification'])){

                                    echo $_SESSION['notification'];

                                }
                            ?>
                        </div>
                        
                        <div class="col-md-12">

                            <div class="form-group">
                                <h3 style="font-size: 18px;">Personal Information</h3>
                            </div>

                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo isset($_SESSION['reg_form']['fullname']) ? $_SESSION['reg_form']['fullname'] : '' ?>">
                            </div>
                            <div class="form-group">
                               <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo isset($_SESSION['reg_form']['email']) ? $_SESSION['reg_form']['email'] : '' ?>">
                            </div>
                            <div class="form-group">
                               <label>State</label>
                                <input type="text" class="form-control" name="city" value="<?php echo isset($_SESSION['reg_form']['city']) ? $_SESSION['reg_form']['city'] : '' ?>">
                            </div>
                            <div class="form-group">
                               <label>Phone Number</label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo isset($_SESSION['reg_form']['mobile']) ? $_SESSION['reg_form']['mobile'] : '' ?>" placeholder="eg 08033334567">
                            </div>
                            
                            <div class="form-group">
                               <label>Referral Username</label>
                                <input type="text" class="form-control" name="ref" value="<?php echo isset($_GET['ref']) ? $_GET['ref'] : 'stanbiclife' ?>">
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Retype Password</label>
                                <input type="password" class="form-control" name="rpassword">
                            </div>

                            <div class="form-group">
                                <h3 style="font-size: 18px;">Bank Account Details</h3>
                            </div>
                            <div class="form-group">
                                <label>Select Bank </label>
                                <select name="bank" class="form-control">
                                    <option></option>
                                    <?php 
                                    foreach ($this->admin_model->get_banks()->result() as $r) {
                                        echo "<option value='$r->id'>$r->name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Account Type</label>
                                <select name="account_type" class="form-control">
                                    <option value="saving">Saving</option>
                                    <option value="current">Current</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" class="form-control" name="account_name">
                            </div>
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" class="form-control" name="account_number">
                            </div>
                            

                            <!-- <div class="form-group">
                                <label>Select Package</label>
                                <select name="package" class="form-control" style="color: #000;">
                                    <option value="10000">₦10,000</option>
                                    <option value="20000">₦20,000</option>
                                    <option value="50000">₦50,000</option>
                                </select>
                            </div> -->

                            
                            <!-- <div class="form-group">
                                <?php
                                $a = rand(1,8);
                                $b = rand(1,6);

                                $sum = $a + $b;
                                ?>
                                <label>Captcha</label>
                                <input type="text" class="form-control" name="capt_text" placeholder="what is <?php echo "$a + $b" ?>">
                                <input type="hidden" class="form-control" name="capt_ans" value="<?php echo $sum; ?>">
                            </div> -->
                        </div>
                    </div>
                    <div class="auth-footer sm-text-center">
                        <input class="btn btn-primary sm-max" type="submit" name="register" value="Register">
                        <div class="pull-right auth-link sm-max sm-mgtop-20">
                            <a href="<?php echo $this->config->base_url(); ?>login">Login Here</a>
                            <div class="devider"></div>
                            
                            <a href="<?php echo $this->config->base_url(); ?>">Goto Homepage</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <style type="text/css">
            .aa{
                max-width: auto!important;
            }
        </style>
    </body>
</html>