<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller {
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

        if(isset($_POST['create_customer'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));
            $email =  $this->site_model->fil_email($this->input->post("email"));
            $password =  $this->site_model->fil_password($this->input->post("password"));
            $mobile =  $this->site_model->fil_string($this->input->post("mobile"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $city =  $this->site_model->fil_string($this->input->post("city"));
            $state =  $this->site_model->fil_string($this->input->post("state"));
            $address =  $this->site_model->fil_text($this->input->post("address"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                // echo "$key == $val <br>";
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."customers");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM customers WHERE name='$name' OR email='$email' OR mobile='$mobile' OR uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Customer already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."customers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('customers', ['name'=>$name, 
                    'email'=>$email, 
                    'password'=>$password, 
                    'mobile'=>$mobile, 
                    'uq_id'=>$uq_id, 
                    'city'=>$city, 
                    'address'=>$address, 
                    'state'=>$state, 
                    'staff_id'=>$this->staff_id, 
                    'date_created'=>$date]);


                $msg = "<h3>Powdera</h3>";
                $msg .= "<h3>Hello $name, Below are your login details</h3>";
                $msg .= "<p>Email : $email</p>";
                $msg .= "<p>Password : $password</p>";

                $to = $email;
                $subject = "Account Password";


                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <support@.com>' . "\r\n";

                // mail($email,$subject,$msg,$headers);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."customers");
            exit();
            
        }

        if(isset($_POST['update_customer'])){ 
            
            $customer_id =  $this->site_model->fil_string($this->input->post("customer_id"));
            $name =  $this->site_model->fil_string($this->input->post("name"));
            $email =  $this->site_model->fil_email($this->input->post("email"));
            $mobile =  $this->site_model->fil_string($this->input->post("mobile"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $city =  $this->site_model->fil_string($this->input->post("city"));
            $state =  $this->site_model->fil_string($this->input->post("state"));
            $address =  $this->site_model->fil_text($this->input->post("address"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                
                if (empty($val) OR empty($customer_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."customers");
                    exit();
                }

            } 


            $r = $this->db->query("SELECT * FROM customers WHERE (name='$name' OR email='$email' OR mobile='$mobile' OR uq_id='$uq_id') AND id!='$customer_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Customer already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."customers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $up_data = ['name'=>$name, 
                    'email'=>$email, 
                    'mobile'=>$mobile, 
                    'city'=>$city, 
                    'address'=>$address, 
                    'state'=>$state,];

            $where = "id = $customer_id";

            $str = $this->db->update_string('customers', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."customers");
            exit();
            
        }

        if(isset($_POST['delete_customer'])){

            $customer_id =  $this->site_model->fil_num($this->input->post("customer_id"));
            
            if(empty($customer_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."customers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM customers WHERE id='$customer_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."customers");
            exit();
            
        }

        $data['page_title'] = "Customers";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."customers",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
