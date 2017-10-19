<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
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
        $this->module = "Sales Personnel";

        
    }

    public function index($id = null){
        if(is_null($id)){
            header("Location: $this->full_url"."dashboard");
            exit();
        }

        $r = $this->db->query("SELECT * FROM customer_requests WHERE id='$id'");
        if($r->num_rows() > 0){


            $data['page_title'] = "Invoice";
            $data['id'] = $id;

            $this->load->view("$this->mod_dir"."header",$data);
            $this->load->view("$this->mod_dir"."invoice",$data);
            $this->load->view("$this->mod_dir"."footer",$data);
            unset($_SESSION['notification']);
        }
        else{
            header("Location: $this->full_url"."dashboard");
            exit();
        }
    }
}
