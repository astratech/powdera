<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prod_details extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $url = $this->config->base_url();

        if(!isset($_SESSION['powdera_logged'])){
            header("Location: $url"."login");
            exit();
        } 

        $this->mod_dir = $this->site_model->get_dept($_SESSION['powdera_logged']['dept_id'])->url;
        $this->full_url = $this->config->base_url()."".$this->mod_dir;
        $this->staff_id = $_SESSION['powdera_logged']['staff_id'];
        $this->module = "CEO";

        
    }

    public function index(){

        $data['page_title'] = "Production Details";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."prod_details",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
