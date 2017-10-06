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

                            </div>
                        </div>
                        <!--page title and breadcrumb end -->


                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <section class="panel">
                                   
                                    <div class="panel-body">

                                        <div class="col-md-12">
                                            <?php 
                                                if(isset($_SESSION['notification'])){

                                                    echo $_SESSION['notification'];

                                                }
                                            ?>
                                            <form class="form-horizontal dform" action="" method="POST">
                                               <div class="row">
                                                    <div class="form-group col-xs-12">
                                                        <label>Department</label>
                                                        <select class="form-control s2" name="dept_id">
                                                           <?php
                                                                $list = $this->site_model->get_dept_list();
                                                                foreach ($list->result() as $d) {
                                                                   echo "<option value='$d->id'>$d->title</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">

                                                        <div class="col-xs-3">
                                                            <label>Title</label>
                                                            <select class="form-control s2" name="title">
                                                                <option value="master">Master</option>
                                                                <option value="miss">Miss</option>
                                                                <option value="mr">Mr</option>
                                                                <option value="mrs">Mrs</option>
                                                                <option value="dr">Dr</option>
                                                                <option value="prof">Prof</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-xs-9">
                                                            <label>Full Name</label>
                                                            <input type="text" class="form-control" name="fullname" />
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-xs-12">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email">
                                                    </div>

                                                    <div class="form-group col-xs-12">
                                                        <label>Mobile</label>
                                                        <input type="text" class="form-control" name="mobile">
                                                    </div>

                                                    <div class="form-group col-xs-12">
                                                        <label>Supervisor</label>
                                                        <select class="form-control s2" name="supervisor_staff_id">
                                                           <?php
                                                                $list = $this->site_model->get_all_staff_list();
                                                                foreach ($list->result() as $d) {
                                                                   echo "<option value='$d->id'>$d->title $d->fullname</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-xs-12">
                                                        <label>Staff ID</label>
                                                        <input type="text" class="form-control" name="uq_id" value="<?php echo $this->site_model->gen_uq_id("STF"); ?>" readonly>
                                                    </div>
                                                    
                                                    <div class="form-group col-xs-12">
                                                        <label>Password</label>
                                                        <input type="text" class="form-control" name="password" value="<?php echo $this->site_model->gen_token(); ?>" readonly="readonly">
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <!-- <input type="submit" name="create_leave" class="btn btn-primary" value="Send"> -->
                                                    </div>
                                                </div>

                                               <div class="form-group">
                                                   <input type="submit" name="create_staff" class="btn btn-primary" value="Send for Approval">
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


