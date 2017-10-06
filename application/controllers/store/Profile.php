<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
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
        $this->module = "Store Keeper";
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
            $this->db->query("UPDATE staffs SET password='$password' WHERE id='$this->staff_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                <strong>Operation Successful. Password Changed. </strong> 
              </div>";
            header("Location: $url".$mod_dir."profile");
            exit();
            
        }

        if(isset($_POST['update_profile'])){

            $email = $this->site_model->fil_email($this->input->post("email"));
            $mobile = $this->site_model->fil_string($this->input->post("mobile"));

            if(empty($email) OR empty($mobile)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields.
                        </div>";
                header("Location: $url".$mod_dir."profile");
                exit();
            }
            
            $date = date("Y-m-d H:i:s");

            // update 
            $this->db->query("UPDATE staffs SET email='$email',mobile='$mobile' WHERE id='$this->staff_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                <strong>Operation Successful. Profile Updated. </strong> 
              </div>";
            header("Location: $url".$mod_dir."profile");
            exit();
            
        }

        $data['page_title'] = "Staff Profile";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."profile",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
