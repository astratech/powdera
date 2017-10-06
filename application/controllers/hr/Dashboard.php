<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $url = $this->config->base_url();

        if(!isset($_SESSION['powdera_logged'])){
            header("Location: $url"."login");
            exit();
        } 

        $this->mod_dir = $this->site_model->get_dept($_SESSION['powdera_logged']['dept_id'])->url;
        $this->full_url = $this->config->base_url()."".$this->mod_dir;
   	}

	public function index(){
        $data['page_title'] = "HR";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."dashboard",$data);
        $this->load->view("$this->mod_dir"."footer",$data);

        unset($_SESSION['notification']);
	}
}
