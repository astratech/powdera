<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor_payment extends CI_Controller {
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
        $this->module = "Account Manager";
   	}

	public function index(){

        if(isset($_POST['create_payment'])){

            $vendor_id =  $this->site_model->fil_string($this->input->post("vendor_id"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $purpose =  $this->site_model->fil_string($this->input->post("purpose"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                // echo "$key == $val <br>";
                // $_SESSION['reg_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."vendor_payment");
                    exit();
                }

            }           

            $date = date("Y-m-d H:i:s");

            $this->db->insert('vendor_payment', ['vendor_id'=>$vendor_id, 
                    'quantity'=>$quantity, 
                    'amount'=>$amount, 
                    'purpose'=>$purpose, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendor_payment");
            exit();
            
        }

        if(isset($_POST['update_payment'])){

            $payment_id =  $this->site_model->fil_string($this->input->post("payment_id"));
            $vendor_id =  $this->site_model->fil_string($this->input->post("vendor_id"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $purpose =  $this->site_model->fil_string($this->input->post("purpose"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                echo "$key == $val <br>";
                // $_SESSION['reg_form'][$key] = $val;
                if (empty($val) OR empty($payment_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."vendor_payment");
                    exit();
                }
            }   
            

            $date = date("Y-m-d H:i:s");

            $up_data = ['quantity'=>$quantity, 
                    'vendor_id'=>$vendor_id, 
                    'quantity'=>$quantity, 
                    'amount'=>$amount, 
                    'purpose'=>$purpose,  
                    'date_created'=>$date];

            $where = "id = $payment_id";

            $str = $this->db->update_string('vendor_payment', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendor_payment");
            exit();
            
        }

        if(isset($_POST['delete_payment'])){

            $payment_id =  $this->site_model->fil_num($this->input->post("payment_id"));
            
            if(empty($payment_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."vendor_payment");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM vendor_payment WHERE id='$payment_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendor_payment");
            exit();
            
        }

        if(isset($_POST['add_item'])){

            $vendor_id =  $this->site_model->fil_num($this->input->post("vendor_id"));
            $item_name =  $this->site_model->fil_string($this->input->post("item_name"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));


            if (empty($vendor_id) AND empty($item_name)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."vendors");
                exit();
            }

            $r = $this->db->query("SELECT * FROM vendor_items WHERE vendor_id='$vendor_id' AND item='$item_name'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Item Already exist for $uq_id.
                            </div>";

                    header("Location: $url".$mod_dir."vendors");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('vendor_items', ['vendor_id'=>$vendor_id, 
                    'item'=>$item_name, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendors");
            exit();
            
        }

        $data['page_title'] = "Vendors Payment";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."vendor_payment",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
