    <section class="features text-center" id="about" style="margin-top: 93px; padding-bottom: 600px; background-image: url(<?php echo $this->config->item('assets_url'); ?>/12.jpg); background-size: cover;">
        <div class="container" style="margin-top: 20px;">
            <div class="row">

                <div class="col-md-6 col-md-offset-3" style="background-color: #eee; padding: 50px;">
                    
                    <form class="sign-in-form" role="form" action="" method="POST">
                    <div class="col-md-6">
                        
                    </div>
                    
                    <div class="col-md-12">
                                                    
                        <?php 
                            if(isset($_SESSION['notification'])){

                                echo $_SESSION['notification'];

                            }
                        ?>
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" name="fullname" value="<?php echo isset($_SESSION['reg_form']['fullname']) ? $_SESSION['reg_form']['fullname'] : '' ?>">
                        </div>
                        <div class="form-group">
                           <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo isset($_SESSION['reg_form']['email']) ? $_SESSION['reg_form']['email'] : '' ?>">
                        </div>

                        <div class="form-group">
                           <label>Phone Number</label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo isset($_SESSION['reg_form']['mobile']) ? $_SESSION['reg_form']['mobile'] : '' ?>">
                        </div>
                        
                        <div class="form-group">
                           <label>Referral Username</label>
                            <input type="text" class="form-control" name="ref" value="<?php echo isset($_GET['ref']) ? $_GET['ref'] : '' ?>">
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

                    </div>


                    <input type="submit" class="btn btn-danger btn-block" name="reg_user" value="Register">
                </form>
                </div>
                
            </div>

        </div>
    </section>