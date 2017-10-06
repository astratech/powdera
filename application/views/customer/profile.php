<!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title">
                                    <?php echo "$page_title"; ?>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li><?php echo "$this->module"; ?></li>
                                    <li><?php echo "$page_title"; ?></li>
                                </ul>

                            </div>
                        </div>
                        <!--page title and breadcrumb end -->


                        <div class="row">
                            <?php 
                                if(isset($_SESSION['notification'])){

                                    echo $_SESSION['notification'];

                                }
                            ?>
                            

                            <div class="col-md-6">
                                <section class="panel">
                                   
                                    <div class="panel-body">
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#pick-date1').datepicker({
                                                    singleDatePicker: true,
                                                    showDropdowns: true
                                                });

                                                $('#pick-date2').datepicker({
                                                    singleDatePicker: true,
                                                    showDropdowns: true
                                                });
                                            });
                                        </script>
                                        

                                        <div class="col-md-12">
                                            
                                            
                                            <form class="form-horizontal dform" action="" method="POST">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Customer ID</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_customer($this->customer_id)->uq_id; ?>" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Full Name</label>
                                                            <input type="text" name="name" value="<?php echo $this->site_model->get_customer($this->customer_id)->name; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Email</label>
                                                            <input type="email" name="email" value="<?php echo $this->site_model->get_customer($this->customer_id)->email; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="mobile" value="<?php echo $this->site_model->get_customer($this->customer_id)->mobile; ?>" class="form-control">
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-5">
                                                            <label>City</label>
                                                            <input type="text" name="city" value="<?php echo $this->site_model->get_customer($this->customer_id)->city; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label>State</label>
                                                            <input type="text" name="state" value="<?php echo $this->site_model->get_customer($this->customer_id)->state; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Address</label>
                                                            <textarea name="address" class="form-control"><?php echo $this->site_model->get_customer($this->customer_id)->address; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                               <div class="form-group">
                                                   <input type="submit" name="update_profile" class="btn btn-primary" value="Update Profile">
                                               </div>
                                           </form>
                                       </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-md-6">
                                <section class="panel">
                                   
                                    <div class="panel-body">


                                        <div class="col-md-12">
                                            
                                            <form class="form-horizontal dform" action="" method="POST">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>New Password</label>
                                                            <input type="password" name="password"  class="form-control">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Retype New Password</label>
                                                            <input type="password" name="rpassword"  class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                               <div class="form-group">
                                                   <input type="submit" name="change_password" class="btn btn-primary" value="Change Password">
                                               </div>
                                           </form>
                                       </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--main content end-->


