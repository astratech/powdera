<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Reset extends CI_Controller {



	public function __construct(){

        parent::__construct();

        $url = $this->config->base_url();

   	}

    public function admin_logout(){

      if(isset($_POST['admin_logout'])){

        unset($_SESSION['powdera_logged']);
        session_destroy();

        $url = $this->config->base_url();

        header("Location: $url"."login");

        exit();

      }

    }


   	public function all(){

   		session_destroy();

   		$url = $this->config->base_url();

   	 	header("Location: $url"."login");

        exit();

   	}

}

