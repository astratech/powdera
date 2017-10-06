<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendors extends CI_Controller {
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

        if(isset($_POST['create_vendor'])){

            $company_name =  $this->site_model->fil_string($this->input->post("company_name"));
            $rep_name =  $this->site_model->fil_string($this->input->post("rep_name"));
            $rep_mobile =  $this->site_model->fil_num($this->input->post("rep_mobile"));
            $rep_email =  $this->site_model->fil_email($this->input->post("rep_email"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $category =  $this->site_model->fil_string($this->input->post("category"));
            $location =  $this->site_model->fil_string($this->input->post("location"));
            $address =  $this->site_model->fil_string($this->input->post("address"));
            $account_number =  $this->site_model->fil_num($this->input->post("account_number"));
            $bank_name =  $this->site_model->fil_string($this->input->post("bank_name"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                echo "$key == $val <br>";
                // $_SESSION['reg_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."vendors");
                    exit();
                }

            }            

            $r = $this->db->query("SELECT * FROM vendors WHERE uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Vendor ID already Used. 
                            </div>";

                    header("Location: $url".$mod_dir."vendors");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('vendors', ['company_name'=>$company_name, 
                    'rep_name'=>$rep_name, 
                    'rep_email'=>$rep_email, 
                    'rep_mobile'=>$rep_mobile, 
                    'uq_id'=>$uq_id, 
                    'category'=>$category, 
                    'address'=>$address, 
                    'location'=>$location, 
                    'account_number'=>$account_number, 
                    'bank_name'=>$bank_name, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendors");
            exit();
            
        }

        if(isset($_POST['update_vendor'])){

            $company_name =  $this->site_model->fil_string($this->input->post("company_name"));
            $rep_name =  $this->site_model->fil_string($this->input->post("rep_name"));
            $rep_mobile =  $this->site_model->fil_num($this->input->post("rep_mobile"));
            $rep_email =  $this->site_model->fil_email($this->input->post("rep_email"));
            $category =  $this->site_model->fil_string($this->input->post("category"));
            $location =  $this->site_model->fil_string($this->input->post("location"));
            $address =  $this->site_model->fil_string($this->input->post("address"));
            $account_number =  $this->site_model->fil_num($this->input->post("account_number"));
            $bank_name =  $this->site_model->fil_string($this->input->post("bank_name"));
            $vendor_id =  $this->site_model->fil_num($this->input->post("vendor_id"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                echo "$key == $val <br>";
                // $_SESSION['reg_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."vendors");
                    exit();
                }

            }  
            

            $date = date("Y-m-d H:i:s");

            $up_data = ['company_name'=>$company_name, 
                    'rep_name'=>$rep_name, 
                    'rep_email'=>$rep_email, 
                    'rep_mobile'=>$rep_mobile, 
                    'category'=>$category, 
                    'address'=>$address, 
                    'location'=>$location, 
                    'account_number'=>$account_number, 
                    'bank_name'=>$bank_name, 
                    'date_created'=>$date];

            $where = "id = $vendor_id";

            $str = $this->db->update_string('vendors', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendors");
            exit();
            
        }

        if(isset($_POST['delete_vendor'])){

            $vendor_id =  $this->site_model->fil_num($this->input->post("vendor_id"));
            
            if(empty($vendor_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."vendors");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM vendors WHERE id='$vendor_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."vendors");
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

        $data['page_title'] = "Vendors";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."vendors",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
