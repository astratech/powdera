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
                                        <div class="col-md-12">
                                            <div class="col-md-12 text-center">
                                                <?php
                                                    if($this->site_model->get_staff($this->staff_id)->avatar == ""){
                                                ?>
                                                    <h2>No Profile Avatar</h2>
                                                    <form class="form-inline" role="form" method="post" action="" enctype="multipart/form-data">
                                                        
                                                        <div class="btn btn-success fileinput-button" style="height: 40px;">
                                                            <input type="file" name="avatar"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary" name="upload_avatar" value="Upload Avatar" style="margin-top: 8px;" />
                                                        </div>
                                                        
                                                    </form>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <img src="<?php echo $this->config->item('assets_url')."/site/staffs/avatar/".$this->site_model->get_staff($this->staff_id)->avatar; ?>" class="img-responsive img-circle img-thumbnail" style="width: 200px;">
                                                        <form class="form-inline" role="form" method="post" action="" enctype="multipart/form-data">
                                                        
                                                        <div class="btn btn-success fileinput-button" style="height: 40px;">
                                                            <input type="file" name="avatar"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary" name="upload_avatar" value="Upload Avatar" style="margin-top: 8px;" />
                                                        </div>
                                                        
                                                    </form>
                                                    <br>
                                                    <br>
                                                    <br>

                                                <?php
                                                    }
                                                ?>
                                                
                                            </div>
                                            <form class="form-horizontal dform" action="" method="POST">
                                                <div class="row">
                                                    <!-- <h4>Personal Details</h4> -->
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <label>Title</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_staff($this->staff_id)->title; ?>" class="form-control" readonly>
                                                        </div>

                                                        <div class="col-md-9">
                                                            <label>Full Name</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_staff($this->staff_id)->fullname; ?>" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Email</label>
                                                            <input type="email" name="email" value="<?php echo $this->site_model->get_staff($this->staff_id)->email; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-5">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="mobile" value="<?php echo $this->site_model->get_staff($this->staff_id)->mobile; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label>Department</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_dept($this->site_model->get_staff($this->staff_id)->dept_id)->title; ?>" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Address</label>
                                                            <textarea name="address" class="form-control"><?php echo $this->site_model->get_staff($this->staff_id)->address  ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Supervisor</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_staff($this->site_model->get_staff($this->staff_id)->supervisor_staff_id)->fullname; ?>" class="form-control" readonly>
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
                                                    <h4>Next of Kin Details</h4>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Full Name</label>
                                                            <input type="text" value="<?php echo $this->site_model->get_staff($this->staff_id)->next_of_kin_name; ?>" class="form-control" name="next_of_kin_name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Email</label>
                                                            <input type="email" name="next_of_kin_email" value="<?php echo $this->site_model->get_staff($this->staff_id)->next_of_kin_email; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-5">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="next_of_kin_mobile" value="<?php echo $this->site_model->get_staff($this->staff_id)->next_of_kin_mobile; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label>Occupation</label>
                                                            <input type="text" name="next_of_kin_occupation" value="<?php echo $this->site_model->get_staff($this->staff_id)->next_of_kin_occupation; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Address</label>
                                                            <textarea name="next_of_kin_address" class="form-control"><?php echo $this->site_model->get_staff($this->staff_id)->next_of_kin_address  ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                               <div class="form-group">
                                                   <input type="submit" name="update_kin" class="btn btn-primary" value="Update">
                                               </div>
                                           </form>
                                       </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-md-12">
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


