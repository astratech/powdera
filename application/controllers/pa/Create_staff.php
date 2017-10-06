<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Create_staff extends CI_Controller {
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
        $this->module = "Admin PA";
   	}

	public function index(){

        if(isset($_POST['create_staff'])){

            //check for empty fields
            foreach ($_POST as $key => $val) {
                $_SESSION['reg_form'][$key] = $val;
                if (empty($val)) {
                    
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";

                    header("Location: $url".$mod_dir."create_staff");
                    exit();
                }
            }   


            $dept_id =  $this->site_model->fil_num($this->input->post("dept_id"));
            $title =  $this->site_model->fil_string($this->input->post("title"));
            $fullname =  $this->site_model->fil_string($this->input->post("fullname"));
            $email =  $this->site_model->fil_email($this->input->post("email"));
            $mobile =  $this->site_model->fil_string($this->input->post("mobile"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $supervisor_staff_id =  $this->site_model->fil_num($this->input->post("supervisor_staff_id"));
            $password =  $this->input->post("password");

            $date = date("Y-m-d H:i:s");


            $this->db->insert('staffs', ['dept_id'=>$dept_id, 'title'=>$title, 'fullname'=>$fullname, 'email'=>$email, 'mobile'=>$mobile, 'uq_id'=>$uq_id, 'supervisor_staff_id'=>$supervisor_staff_id, 'password'=>$password, 'date_created'=>$date]);

            $msg = "<h3>Powdera</h3>";
                $msg .= "<h3>Hello $name, Below are your login details</h3>";
                $msg .= "<p>Email : $email</p>";
                $msg .= "<p>Password : $password</p>";

                $to = $email;
                $subject = "Account Details";


                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <support@.com>' . "\r\n";

                // mail($email,$subject,$msg,$headers);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>SUCCESSFUL: </strong> Staff Created.
                </div>";

            header("Location: $url".$mod_dir."create_staff");
            exit();
        }

        $data['page_title'] = "Create Staff";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."create_staff",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
