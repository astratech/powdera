<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title> VerveFunds</title>
      <!--internet Explorer Meta-->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--First Mobile Meta-->

      <!-- favicon -->  
      <link rel="shortcut icon" href="<?php echo $this->config->item('assets_url'); ?>/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo $this->config->item('assets_url'); ?>/favicon.ico" type="image/x-icon">
      <!-- Font icons -->
      <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/css/vendor/font-awesome.min.css">
      <!-- stylesheet -->
      <link href="<?php echo $this->config->item('assets_url'); ?>/css/vendor/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo $this->config->item('assets_url'); ?>/css/light-pink.css" rel="stylesheet">
      <link href="<?php echo $this->config->item('assets_url'); ?>/css/custom.css" rel="stylesheet">

        <script src="<?php echo $this->config->item('assets_url'); ?>/jquery.js"></script>
        <!-- <script src="<?php echo $this->config->item('assets_url'); ?>/js/vendor/jquery-3.1.0.min.js"></script> -->
      <script src="<?php echo $this->config->item('assets_url'); ?>/js/vendor/jquery.easing.min.js"></script>
      <script src="<?php echo $this->config->item('assets_url'); ?>/js/vendor/bootstrap.min.js"></script>
      <script src="<?php echo $this->config->item('assets_url'); ?>/js/plugins.js"></script>
      <!--
         [if lt IE 9]>
              <script type="text/javascript" src="js/vendor/html5shiv.min.js"></script>
          <![endif]
         -->
   </head>
   <body data-spy="scroll" data-target=".navbar-fixed-top">
      <!--main navbar-->
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="light-pink.html#"><span>VerveCash</span></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $this->config->base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo $this->config->base_url(); ?>#a">About us</a></li>
                    <li><a href="<?php echo $this->config->base_url(); ?>#f">Features</a></li>
                    <li><a href="<?php echo $this->config->base_url(); ?>#p">Packages</a></li>
                    <li><a href="<?php echo $this->config->base_url(); ?>login">Login</a></li>
                    <li><a href="<?php echo $this->config->base_url(); ?>register">Register</a></li>
            </div>
            <!-- /.navbar-collapse -->
         </div>
      </nav>
      <!--/main navbar-->

