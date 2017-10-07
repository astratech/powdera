<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave extends CI_Controller {
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
        $this->module = "HR";
   	}

	public function index(){

        if(isset($_POST['create_leave'])){

            $leave_type =  $this->site_model->fil_string($this->input->post("leave_type"));
            $date_from =  date("y-m-d", strtotime($this->input->post("date_from")));
            $date_to =  date("y-m-d", strtotime($this->input->post("date_to")));
            $comment =  $this->site_model->fil_text($this->input->post("comment"));
            $date = date("Y-m-d H:i:s");


            foreach ($_POST as $key => $val) {
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."leave");
                    exit();
                }

            }  

            $this->db->insert('leaves', ['staff_id'=>$this->staff_id, 'leave_type'=>$leave_type, 'date_from'=>$date_from, 'date_to'=>$date_to, 'comments'=>$comment, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>Operation Successful: </strong> Wait for approval.
                            </div>";

            header("Location: $url".$mod_dir."leave");
            exit();
        }

        $data['page_title'] = "Leave";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."leave",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
