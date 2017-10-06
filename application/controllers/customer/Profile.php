<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $url = $this->config->base_url();

        if(!isset($_SESSION['powdera_customer_logged'])){
            header("Location: $url"."customer/login");
            exit();
        } 

         $this->mod_dir = "customer/";
        $this->customer_id = $_SESSION['powdera_customer_logged']['customer_id'];
        $this->full_url = $this->config->base_url()."".$this->mod_dir;
        $this->module = "Customer";
    }

    public function index(){
        
        if(isset($_POST['change_password'])){

            $password = $this->input->post("password");
            $rpassword = $this->input->post("rpassword");

            if(empty($password) OR empty($rpassword)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields.
                        </div>";
                header("Location: $url".$mod_dir."profile");
                exit();
            }

            if($password != $rpassword) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Password Mismatch.
                        </div>";
                header("Location: $url".$mod_dir."profile");
                exit();
            }


            
            $date = date("Y-m-d H:i:s");

            // update 
            $this->db->query("UPDATE customers SET password='$password' WHERE id='$this->customer_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                <strong>Operation Successful. Password Changed. </strong> 
              </div>";
            header("Location: $url".$mod_dir."profile");
            exit();
            
        }

        if(isset($_POST['update_profile'])){

            $name = $this->site_model->fil_string($this->input->post("name"));
            $email = $this->site_model->fil_email($this->input->post("email"));
            $mobile = $this->site_model->fil_string($this->input->post("mobile"));
            $city = $this->site_model->fil_string($this->input->post("city"));
            $state = $this->site_model->fil_string($this->input->post("state"));
            $address = $this->site_model->fil_text($this->input->post("address"));

            if(empty($name) OR empty($email) OR empty($mobile) OR empty($city) OR empty($state) OR empty($address)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields.
                        </div>";
                header("Location: $url".$mod_dir."profile");
                exit();
            }
            
            $date = date("Y-m-d H:i:s");

            // update 
            $this->db->query("UPDATE customers SET name='$name',email='$email',mobile='$mobile',city='$city',state='$state',address='$address' WHERE id='$this->customer_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                <strong>Operation Successful. Profile Updated. </strong> 
              </div>";
            header("Location: $url".$mod_dir."profile");
            exit();
            
        }

        $data['page_title'] = "Customer Profile";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."profile",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
