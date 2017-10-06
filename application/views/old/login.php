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
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group text-center">
                            <label class="i-checks">
                                <input type="checkbox">
                                <i></i>
                            </label>
                            Remember me
                        </div>
                        <input type="submit" class="btn btn-info btn-danger" name="login" value="Login"></input>

                    </form>
                </div>
                
            </div>

        </div>
    </section>