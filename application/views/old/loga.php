<section id="home" style="padding-top:70px; padding-bottom:170px;">

        <div class="container">

            <div class="row text-center">

                <h3 class="title-border">

                    

                    <!-- <span>Members Login</span> -->

                </h3>

            </div><!--/ Title row end -->



            <div class="gap-40"></div>



            <div class="row">

                <div class="col-md-6 col-xs-12 col-md-offset-3`">

                    <?php 

                        if(isset($_SESSION['notification'])){

                            echo $_SESSION['notification'];

                        }

                    ?>

                    <div class="appointment">
                            <form action="" method="post">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margins">
                                    <label>Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margins">
                                    <label>Password</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margins">
                                    <div class="g-recaptcha" data-sitekey="6LekTCAUAAAAAOIGtJUVDJkUg25FApp3bhjHo8c0"></div>
                                </div>
                                
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="bttn bttn-round bttn-solid" type="submit" name="login" value="Login">
                                    <!-- <p>WE WILL BE BACK ON MONDAY 6AM USE YOUR SUNDAY TO REST AND WORSHIP GOD</p> -->
                                </div>
                            </form>
                        </div>

                </div><!-- 1st post col end -->

            </div><!--/ Content row end -->

        </div><!--/ Container end -->

    </section><!--/ News end -->