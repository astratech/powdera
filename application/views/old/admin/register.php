<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php if(isset($page_title)){echo $page_title;} ?></title>

        <meta name="description" content="">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo $this->config->item("assets_url"); ?>/backend/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo $this->config->item("assets_url"); ?>/backend/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo $this->config->item("assets_url"); ?>/backend/css/main.css">

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo $this->config->item("assets_url"); ?>/backend/css/themes.css">
        <!-- END Stylesheets -->

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/plugins.js"></script>
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/app.js"></script>

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/vendor/modernizr-3.3.1.min.js"></script>
    </head>
    <body>
    <script type="text/javascript">
        //Ajax
        $(document).ready(function () {
            //check mismatch password
            $("#rpassword").keyup(function(){
                if($(this).val() != $("#password").val()){
                    $("#pass-err").show();
                    $("#sub-btn").hide();
                }
                else{
                    $("#pass-err").hide();
                    $("#sub-btn").show();
                }
            });
        });
    </script>
        <!-- Login Container -->
        <div id="login-container">
            <!-- Register Header -->
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
                <i class="fa fa-plus"></i> <strong>Create Account</strong>
            </h1>
            <!-- END Register Header -->
            <?php 
                if(isset($_SESSION['notification'])){
                    echo $_SESSION['notification'];
                }
            ?>

            <!-- Register Form -->
            <div class="block animation-fadeInQuickInv">

                <!-- Register Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="<?php echo $this->config->base_url(); ?>login" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Back to login"><i class="fa fa-user"></i> Login</a>
                    </div>
                    <h2>Register</h2>
                </div>
                <!-- END Register Title -->


                <!-- Register Form -->
                <form id="form-register" action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="fullname" class="form-control" placeholder="Fullname">
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="mobile" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="city" class="form-control" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            <p class="help-block" id="pass-err" style="display:none;">Password Mismatch</p>
                        </div>
                        <div class="col-xs-6">
                            <input type="password" id="rpassword" name="rpassword" class="form-control" placeholder="Retype Password">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-xs-6">
                            <select name="bank" class="form-control">
                                <option>Select Bank</option>
                                <?php 
                                    foreach ($this->admin_model->get_banks()->result() as $r) {
                                        echo "<option value='$r->id'>$r->name</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-xs-6">
                            <select name="bank_type" class="form-control">
                                <option>Bank Type</option>
                                <option value="saving">Saving</option>
                                <option value="current">Current</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="account_name" class="form-control" placeholder="Bank Account Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="account_number" class="form-control" placeholder="Bank Account Number">
                        </div>
                    </div>
                    
                    <div class="form-group form-actions">
                        <div class="col-xs-12">
                            <label class="csscheckbox csscheckbox-primary" data-toggle="tooltip" title="Agree to the terms">
                                <input type="checkbox">
                                <span></span>
                            </label>
                            I agree with the <a href="#modal-terms" data-toggle="modal">Terms</a>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <input type="submit" id="sub-btn" class="btn btn-effect-ripple btn-success" name="reg_user" value="Create Account"/>
                        </div>
                    </div>
                </form>
                <!-- END Register Form -->
            </div>
            <!-- END Register Block -->

            <!-- Footer -->
            <footer class="text-muted text-center animation-pullUp">
                <small> &copy;<?php echo date("Y");?></small>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Login Container -->

        <!-- Modal Terms -->
        <div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center"><strong>Terms and Conditions</strong></h3>
                    </div>
                    <div class="modal-body">
                        <h4 class="page-header">1. <strong>General</strong></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                        <h4 class="page-header">2. <strong>Account</strong></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                        <h4 class="page-header">3. <strong>Service</strong></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                        <h4 class="page-header">4. <strong>Payments</strong></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-effect-ripple btn-sm btn-primary" data-dismiss="modal">I've read them!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Terms -->

        <!-- Load and execute javascript code used only in this page -->
        <script src="<?php echo $this->config->item("assets_url"); ?>/backend/js/pages/readyLogin.js"></script>
        <script>$(function(){ ReadyLogin.init(); });</script>
    </body>
</html>