<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Catalog extends CI_Controller {
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

    public function index(){

        if(isset($_POST['req_product'])){

            $sales_product_id =  $this->site_model->fil_string($this->input->post("sales_product_id"));
            $quantity =  $this->site_model->fil_string($this->input->post("quantity"));
            $amount =  $this->site_model->fil_string($this->input->post("amount"));
            $customer_id =  $this->site_model->fil_num($this->input->post("customer_id"));
            $uq_id =  $this->site_model->gen_uq_id("REQ");


            //check for empty fields
            if (empty($sales_product_id) OR empty($quantity) OR empty($amount) OR empty($customer_id)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."catalog");
                exit();
            }

            if ($quantity <= 0 OR $amount <= 0) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Amount cant be zero.
                        </div>";
                header("Location: $url".$mod_dir."catalog");
                exit();
            }


            $date = date("Y-m-d H:i:s");

            $this->db->insert('customer_requests', ['quantity'=>$quantity, 
                    'amount'=>$amount, 
                    'sales_product_id'=>$sales_product_id, 
                    'customer_id'=>$customer_id, 
                    'uq_id'=>$uq_id, 
                    'date_created'=>$date]);


            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."pending_request");
            exit();
            
        }

        $data['page_title'] = "Product Catalog";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."catalog",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
