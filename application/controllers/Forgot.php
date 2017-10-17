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

        $msg = "<div style='width: 400px; height: 700px; background-color: #62549a; text-align: center;'>
           <img src='<?php echo $this->config->item('assets_url'); ?>/images/logo.png' width='130px' alt=''/>

           <h3>Hello, Below are your Login Details</h3>
           <div style='color: #eee;'>
               <p>Email: </p>
               <p>Password: </p>
               <p>Department: </p>
           </div>
        </div>";

        $to = "flamezbaba@gmail.com";
        $subject = "Account Password";


        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no-reply@powderahealthcareproducts.com>' . "\r\n";

        $e = mail($email,$subject,$msg,$headers);
        echo $e;

        exit();

        if(isset($_POST['dept']) AND $_POST['dept'] == 9){
            header("Location: $url"."customer");
            exit();
        }
        
		if(isset($_POST['login'])){
			$email = $this->admin_model->fil_email($this->input->post("email"));
            $password = $this->admin_model->fil_string($this->input->post("password"));
            $dept = $this->admin_model->fil_num($this->input->post("dept"));

            if(empty($email) || empty($password) || empty($dept)){
                //set notification session
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                header("Location: $url"."login");
                exit();
            }

            // $password = $this->admin_model->encode_password($password);
            
            $q = "SELECT * FROM staffs WHERE email='$email' AND password='$password' AND dept_id='$dept' AND offboard='0'";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $url = $this->config->base_url();
                foreach ($r->result() as $row) {
                    $_SESSION['powdera_logged']['email'] = $row->email;
                    $_SESSION['powdera_logged']['dept_id'] = $row->dept_id;
                    $_SESSION['powdera_logged']['staff_id'] = $row->id;
                    
                }

                $d = date("Y-m-d H:i:s");
                $this->db->query("UPDATE staffs SET last_login='$d' WHERE email='$email'");
                $mod_dir = $this->site_model->get_dept($dept)->url;
                header("Location: $url".$mod_dir."dashboard");
                exit();
            }
            else{
                
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Invalid Login
                            </div>";
                header("Location: $url"."login");
                exit();
            }
		}
		$data['page_title'] = "Login";

        $this->load->view('header',$data);
        $this->load->view('forgot',$data);
		// $this->load->view('footer',$data);
		unset($_SESSION['notification']);
	}
}
