<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgot extends CI_Controller {
	public function __construct(){
        parent::__construct();

        if(isset($_SESSION['powdera_logged'])){
            $this->mod_dir = $this->site_model->get_dept($_SESSION['powdera_logged']['dept_id'])->url;
            $full_url = $this->config->base_url()."".$this->mod_dir;
            $this->staff_id = $_SESSION['powdera_logged']['staff_id'];

            header("Location: $full_url"."dashboard");
            echo $full_url;
            exit();
        } 

   	}
	public function index(){
        
		$url = $this->config->base_url();	
        // header("Location: $url"."home");
        // exit();

        
        
		if(isset($_POST['reset_password'])){
			$email = $this->admin_model->fil_email($this->input->post("email"));

            if(empty($email)){
                //set notification session
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                header("Location: $url"."forgot");
                exit();
            }

            // $password = $this->admin_model->encode_password($password);
            
            $q = "SELECT * FROM staffs WHERE email='$email' AND offboard='0'";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $url = $this->config->base_url();
                foreach ($r->result() as $row) {
                    $email = $row->email;
                    $dept_id = $row->dept_id;
                    $password = $row->password;
                }

                $dept = $this->site_model->get_record("depts", $dept_id)->title;

                $msg = "<div style='width: 400px; height: 700px; background-color: #62549a; text-align: center;'>
                   <img src='".$this->config->item('assets_url')."/images/logo.png' width='130px' alt=''/>

                   <h3>Hello, Below are your Login Details</h3>
                   <div style='color: #eee;'>
                       <p>Email: $email</p>
                       <p>Password: $password</p>
                       <p>Department: $dept</p>
                   </div>
                </div>";

                $to = $email;
                $subject = "Powdera";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <no-reply@powderahealthcareproducts.com>' . "\r\n";

                $e = mail($to,$subject,$msg,$headers);

                if($e == 1){
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>Successful: </strong> Password Sent to your email.
                            </div>";
                    header("Location: $url"."forgot");
                    exit();
                }
                else{
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed.
                            </div>";
                    header("Location: $url"."forgot");
                    exit();
                }
                
            }
            else{
                
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Invalid Email.
                            </div>";
                header("Location: $url"."forgot");
                exit();
            }
		}
		$data['page_title'] = "Forgot Password";

        $this->load->view('header',$data);
        $this->load->view('forgot',$data);
		// $this->load->view('footer',$data);
		unset($_SESSION['notification']);
	}
}
