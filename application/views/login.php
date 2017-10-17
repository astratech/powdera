<body style="background-color: #62549a;">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" width="130px" alt=""/></h2>
                    <h4>Login to Powdera</h4>
                </div>

                 <?php 
                    if(isset($_SESSION['notification'])){

                        echo $_SESSION['notification'];

                    }
                ?>
                <form class="sign-in-form" role="form" action="" method="POST">
                    <div class="form-group">
                        <label>Select Department</label>
                        <select class="form-control" name="dept">
                            <?php
                                $list = $this->site_model->get_dept_list();
                                foreach ($list->result() as $d) {
                                   echo "<option value='$d->id'>$d->title</option>";
                                }
                            ?>
                           <!--  <option value="store_keeper">Store Keeper</option>
                            <option value="account_manager">Account Manager</option>
                            <option value="hr">Human Resource Manager</option>
                            <option value="op_supervisor">Operations Supervisor</option>
                            <option value="op_manager">Operations Manager</option>
                            <option value="pa">Personal Assistance</option>
                            <option value="qaqc">Qa/Qc</option>
                            <option value="warehouse_manager">WareHouse Manager</option>
                            <option value="sales_personnel">Sales Personnel</option>
                            <option value="customer">Customer</option>
                            <option value="ceo">CEO</option>
                            <option value="support_staff">Support Staff</option> -->
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    </div>
                    <div class="form-group text-center">
                        <label class="i-checks">
                            <input type="checkbox">
                            <i></i>
                        </label>
                        Remember me
                    </div>
                    <input type="submit" class="btn btn-info btn-block" value="Login" name="login" />
                    <div class="form-group text-center" style="margin-top: 30px;">
                        <a href="<?php echo $this->config->base_url(); ?>forgot">Forgot Password??</a>
                    </div>
                </form>
                   
                <div class="text-center copyright-txt" style="color: #fff;">
                    <small>Powdera - Copyright © <?php echo date("Y"); ?></small>
                </div>
            </div>
        </div>

        

    </body>
</html>
