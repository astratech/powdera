<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory extends CI_Controller {
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

        if(isset($_POST['add_product'])){

            $prod_output_item_id =  $this->site_model->fil_string($this->input->post("prod_output_item_id"));
            
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $unit =  $this->site_model->fil_string($this->input->post("unit"));
            $price =  $this->site_model->fil_string($this->input->post("price"));
            $uq_id =  $this->site_model->gen_uq_id("POW");
            


            //check for empty fields
            foreach ($_POST as $key => $val) {
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."inventory");
                    exit();
                }

            }     

            $prod_batch_id =  $this->site_model->get_prod_output_item($prod_output_item_id)->prod_batch_id;


            $date = date("Y-m-d H:i:s");

            $this->db->insert('sales_product', ['prod_output_item_id'=>$prod_output_item_id, 
                    'prod_batch_id'=>$prod_batch_id, 
                    'unit'=>$unit, 
                    'quantity'=>$quantity, 
                    'uq_id'=>$uq_id, 
                    'price'=>$price, 
                    'date_created'=>$date]);


            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."inventory");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."inventory");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM sales_product WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."inventory");
            exit();
            
        }

        $data['page_title'] = "Product Inventory";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."inventory",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
