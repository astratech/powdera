    <section class="features text-center" id="about" style="margin-top: 93px; padding-bottom: 600px; background-image: url(<?php echo $this->config->item('assets_url'); ?>/12.jpg); background-size: cover;">
        <div class="container" style="margin-top: 20px;">
            <div class="row">

                <div class="col-md-6 col-md-offset-3" style="background-color: #eee; padding: 50px;">
                    
                    <form class="sign-in-form" role="form" action="" method="POST">
                        <?php 
                            if(isset($_SESSION['notification'])){

                                echo $_SESSION['notification'];

                            }
                        ?>
                        <div class="form-group" style="font-size: 20px;">
                            <p>Welcome, <?php echo $this->username; ?></p>
                            <p>To continue operations, you are to pay ₦1,000 activation fee to the details below.</p>
                        </div>

                        <div class="form-group">
                            <?php
                                $ref = $this->admin_model->get_user($this->username)->ref;

                                $fullname = $this->admin_model->get_user($ref)->account_name;
                            ?>
                        </div>
                        <div class="form-group" style="font-size: 18px;">
                            <p>Fullname: <?php echo $fullname; ?></p>
                            <p>Mobile: <?php echo $this->admin_model->get_user($ref)->mobile; ?></p>
                            <p>Bank Name: <?php echo $this->admin_model->get_user($ref)->bank_name; ?></p>
                            <p>Account Number: <?php echo $this->admin_model->get_user($ref)->account_number; ?></p>
                            <p>Account Type: <?php echo $this->admin_model->get_user($ref)->account_type; ?></p>
                        </div>
                    </form>
                </div>
                
            </div>

        </div>
    </section>