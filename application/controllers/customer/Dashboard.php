<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $url = $this->config->base_url();

        if(!isset($_SESSION['powdera_customer_logged'])){
            header("Location: $url"."login");
            exit();
        } 

        $this->mod_dir = "customer/";
        $this->customer_id = $_SESSION['powdera_customer_logged']['customer_id'];
        $this->full_url = $this->config->base_url()."".$this->mod_dir;
        $this->module = "Customer";

        
    }

    public function index(){

        $data['page_title'] = "Dashboard";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."dashboard",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
