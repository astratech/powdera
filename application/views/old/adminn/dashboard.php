                <!-- Main Container -->
                <div id="main-container" style="margin-top:70px;">
                    <!-- Header -->
                    <!-- In the PHP version you can set the following options from inc/config file -->
                    <!--
                        Available header.navbar classes:

                        'navbar-default'            for the default light header
                        'navbar-inverse'            for an alternative dark header

                        'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                            'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                        'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                            'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
                    -->
                   

                    <!-- Page content -->
                    <div id="page-content">
                        <?php 
                            if(isset($_SESSION['notification'])){
                                echo $_SESSION['notification'];
                            }
                        ?>
                        <!-- First Row -->
                        <div class="row">
                            <!-- Simple Stats Widgets -->
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background">
                                            <i class="gi gi-cardio text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3">
                                            <strong><span data-toggle="counter" data-to="2835"></span></strong>
                                        </h2>
                                        <span class="text-muted">SALES</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-success">
                                            <i class="gi gi-user text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-success">
                                            <strong>+ <span data-toggle="counter" data-to="2862"></span></strong>
                                        </h2>
                                        <span class="text-muted">NEW USERS</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-warning">
                                            <i class="gi gi-briefcase text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-warning">
                                            <strong>+ <span data-toggle="counter" data-to="75"></span></strong>
                                        </h2>
                                        <span class="text-muted">PROJECTS</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-danger">
                                            <i class="gi gi-wallet text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-danger">
                                            <strong>$ <span data-toggle="counter" data-to="820"></span>80000</strong>
                                        </h2>
                                        <span class="text-muted">EARNINGS</span>
                                    </div>
                                </a>
                            </div>
                            <!-- END Simple Stats Widgets -->
                        </div>
                        <!-- END First Row -->

                        <!-- PH GH Row -->
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <a href="#modal-ph" class="widget" data-toggle="modal">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-dark"">
                                            <i class="fa fa-angle-double-right text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3">
                                            <strong>Provide Help</strong>
                                        </h2>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-6 col-lg-6">
                                <a href="/ffd" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-success">
                                            <i class="fa fa-angle-double-left text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3">
                                            <strong>Get Help</strong>
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- PH GH Row -->

                        <!-- DASHBOARD CONTENT ROW -->
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <!-- Stats User Widget -->
                                <a href="page_ready_profile.html" class="widget">
                                    <div class="widget-content border-bottom text-dark">
                                        Welcome <?php echo $this->admin_model->get_user($this->username)->fullname;?>
                                    </div>
                                    <div class="widget-content border-bottom text-center themed-background-muted">
                                        <img src="<?php echo $this->config->item("assets_url"); ?>/img/avatar.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                                        <div class="text-left">
                                            <h2 class="widget-heading h4 text-dark">Username : <?php echo $this->username;?></h2>
                                            <h2 class="widget-heading h4 text-dark">Phone Number: <?php echo $this->admin_model->get_user($this->username)->mobile;?></h2>
                                            <span class="text-muted">
                                                <strong>Edit Profile</strong>
                                            </span>
                                        </div>
                                    </div>
                                
                                </a>
                                <!-- END Stats User Widget -->
                            </div>

                            <div class="col-lg-8">
                                <div class="col-sm-6 col-lg-12">
                                    <div class="widget">
                                        <div class="widget-content border-bottom text-light themed-background-dark">
                                            <span class="pull-right text-light">TIME LEFT: 40hours</span>
                                            #1 You've been Merged to Pay <strong>₦20,000</strong>
                                        </div>
                                        <div class="widget-content border-bottom text-center">
                                           <div class="text-left">
                                                <p class="widget-heading h4 text-dark"><strong>TO: </strong> SANGOSANYA SEGUn</p>
                                                <p class="widget-heading h4 text-dark"><strong>PHONE: </strong> 08011298383</p>
                                                <p class="widget-heading h4 text-dark"><strong>BANK NAME: </strong> ZENITH BANK</p>
                                                <p class="widget-heading h4 text-dark"><strong>ACCUNT NAME: </strong> GOODWIN</p>
                                                <p class="widget-heading h4 text-dark"><strong>ACCUNT NUMBER: </strong> 023843834</p>
                                                <span class="text-muted">
                                                    <strong>STATUS: </strong>
                                                </span>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger">I Cant Pay</button>
                                                <button class="btn btn-info">Upload POP</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-12">
                                    <div class="widget">
                                        <div class="widget-content border-bottom text-dark themed-background-success">
                                            <span class="pull-right text-light">TIME LEFT: 40hours</span>
                                            #1 You've been Merged to Receive <strong>₦200,000</strong>
                                        </div>
                                        <div class="widget-content border-bottom text-center">
                                           <div class="text-left">
                                                <p class="widget-heading h4 text-dark"><strong>FROM: </strong> SANGOSANYA SEGUn</p>
                                                <p class="widget-heading h4 text-dark"><strong>PHONE: </strong> 08011298383</p>
                                                <p class="widget-heading h4 text-dark"><strong>BANK NAME: </strong> ZENITH BANK</p>
                                                <p class="widget-heading h4 text-dark"><strong>ACCUNT NAME: </strong> GOODWIN</p>
                                                <p class="widget-heading h4 text-dark"><strong>ACCUNT NUMBER: </strong> 023843834</p>
                                                <span class="text-muted">
                                                    <strong>NOTE: </strong> Ensure You have received your payment before you click the CONFIRM button.
                                                </span>
                                            </div>
                                            <div class="text-left">
                                                <img src="<?php echo $this->config->item("assets_url"); ?>/img/avatar.jpg" class="img-responsive img-thumbnail" width='100' height='100'>
                                                <button class="btn btn-info">Confirm</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- PH Modal -->
                            <div id="modal-ph" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong>Provide Help</strong></h3>
                                        </div>
                                        <form action="" method="post" class="form-horizontal">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <p>Note: Amount Must be between ₦5,000 to ₦100,000</p>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label>Amount</label>
                                                        <input type="number" name="ph_amount" class="form-control">
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-effect-ripple btn-primary" name="reg_ph" value="Submit"/>
                                            <button class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>   
                                    </div>
                                </div>
                            </div>
                            <!-- END PH Modal -->
                                    
                        <!-- END DASHBOARD CONTENT ROW -->
                    </div>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->

                </div>