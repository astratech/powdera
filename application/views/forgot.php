<body style="background-color: #62549a;">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" width="130px" alt=""/></h2>
                    <h4>Reset Password</h4>
                </div>

                 <?php 
                    if(isset($_SESSION['notification'])){

                        echo $_SESSION['notification'];

                    }
                ?>
                <form class="sign-in-form" role="form" action="" method="POST">

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="" name="email">
                    </div>

                    <input type="submit" class="btn btn-info btn-block" value="submit" name="reset_password" />
                    <div class="form-group text-center" style="margin-top: 30px;">
                        <a href="<?php echo $this->config->base_url(); ?>login">Login</a>
                    </div>
                </form>
                   
                <div class="text-center copyright-txt" style="color: #fff;">
                    <small>Powdera - Copyright © <?php echo date("Y"); ?></small>
                </div>
            </div>
        </div>

        <div style='width: 400px; height: 700px; background-color: #62549a; text-align: center;'>
           <img src='<?php echo $this->config->item('assets_url'); ?>/images/logo.png' width='130px' alt=''/>

           <h3>Hello, Below are your Login Details</h3>
           <div style="color: #eee;">
               <p>Email: </p>
               <p>Password: </p>
               <p>Department: </p>
           </div>
        </div>

        

    </body>
</html>
