<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends CI_Controller {
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

        if(isset($_POST['change_status'])){

            $sales_product_id =  $this->site_model->fil_string($this->input->post("sales_product_id"));
            $request_uq_id =  $this->site_model->fil_string($this->input->post("request_id"));
            $status =  $this->site_model->fil_string($this->input->post("status"));


            //check for empty fields
            if (empty($sales_product_id) OR empty($request_uq_id) OR empty($status)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."pending_request");
                exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("UPDATE customer_requests SET status='$status' WHERE uq_id='$request_uq_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."pending_request");
            exit();
            
        }


        if(isset($_POST['decline_request'])){

            $request_id =  $this->site_model->fil_string($this->input->post("request_id"));


            //check for empty fields
            if (empty($request_id)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."pending_request");
                exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM customer_requests WHERE id='$request_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."pending_request");
            exit();
            
        }

        $data['page_title'] = "Sales Records";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."sales",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
