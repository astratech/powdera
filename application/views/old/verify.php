
<section id="home" style="padding-top:70px; padding-bottom: 170px; background-size: cover;">

        <div class="container">

            <div class="row text-center">

                <h3 class="title-border">

                    

                    <span>Hello <?php echo $this->username; ?>, Verify your account to proceed.</span>
                    <p>
                        In case you didn't receive any code. For manual verification send "verify my account" to the following support line (Senator: 09074648372 or Jones: 07084331170). 
                        <br>
                        Note: Please send the SMS with the number you used to register the account only then can you be verified.
                    </p>


                </h3>


            </div><!--/ Title row end -->



            <div class="gap-40"></div>



            <div class="row">

                <div class="col-md-8 col-xs-12 col-md-offset-2">

                    <?php 

                        if(isset($_SESSION['notification'])){

                            echo $_SESSION['notification'];

                        }

                    ?>



                    <form action="" method="post" class="ss">

                       <div class="form-group">

                            <label>Enter Verification Code</label>

                             <input class="form-control" type="text" name="ver_code">

                       </div>

                       <div class="form-group">

                            <input class="btn btn-default pull-left" type="submit" name="verify_user" value="Submit">
                            

                       </div>

                       <!-- <input class="btn btn-default pull-left" type="submit" name="reset_code" value="Resend Code"> -->

                    </form>

                </div><!-- 1st post col end -->

            </div><!--/ Content row end -->

        </div><!--/ Container end -->

    </section><!--/ News end -->