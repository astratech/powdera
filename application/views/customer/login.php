<body style="background-color: #62549a;">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" width="130px" alt=""/></h2>
                    <h4>Customer Login</h4>
                    <h4>Login to Powdera</h4>
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
                </form>
                   
                <div class="text-center copyright-txt" style="color: #fff;">
                    <small>Powdera - Copyright © <?php echo date("Y"); ?></small>
                </div>
            </div>
        </div>

        

    </body>
</html>
