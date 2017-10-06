<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
        parent::__construct();

        if(isset($_SESSION['powdera_customer_logged'])){
            $this->mod_dir = $this->site_model->get_dept($_SESSION['powdera_customer_logged']['dept_id'])->url;
            $full_url = $this->config->base_url()."".$this->mod_dir;
            $url = $this->config->base_url();
            $this->staff_id = $_SESSION['powdera_customer_logged']['customer_id'];

            header("Location: $full_url"."login");
            exit();
        } 

   	}
	public function index(){
        
		$url = $this->config->base_url();	
        // header("Location: $url"."home");
        // exit();
        
		if(isset($_POST['login'])){
            // echo "string";
            // exit();

			$email = $this->admin_model->fil_email($this->input->post("email"));
            $password = $this->admin_model->fil_string($this->input->post("password"));

            if(empty($email) || empty($password)){
                //set notification session
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                header("Location: $url"."customer/login");
                exit();
            }

            // $password = $this->admin_model->encode_password($password);
            
            $q = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $url = $this->config->base_url();
                foreach ($r->result() as $row) {
                    $_SESSION['powdera_customer_logged']['email'] = $row->email;
                    $_SESSION['powdera_customer_logged']['customer_id'] = $row->id;
                    
                }

                $d = date("Y-m-d H:i:s");
                $this->db->query("UPDATE customers SET last_login='$d' WHERE email='$email'");
                $mod_dir = $this->site_model->get_dept($dept)->url;
                header("Location: $url"."customer/dashboard");
                exit();
            }
            else{
                
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Invalid Login
                            </div>";
                header("Location: $url"."customer/login");
                exit();
            }
		}
		$data['page_title'] = "Login";

        $this->load->view('header',$data);
        $this->load->view("customer/login",$data);
		unset($_SESSION['notification']);
	}
}
