<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_approval extends CI_Controller {
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

        if(isset($_POST['approve_leave'])){

            $leave_id =  $this->site_model->fil_num($this->input->post("leave_id"));
            
            if(empty($leave_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."leave_approval");
                    exit();
            }

            $this->db->query("UPDATE leaves SET is_approved='1' WHERE id='$leave_id'");
            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>SUCCESSFUL: </strong> Staff Approved.
                    </div>";

            header("Location: $url".$mod_dir."leave_approval");
            exit();
        }

        if(isset($_POST['reject_leave'])){

            $leave_id =  $this->site_model->fil_num($this->input->post("leave_id"));
            
            if(empty($leave_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."leave_approval");
                    exit();
            }

            $this->db->query("DELETE FROM leaves WHERE id='$leave_id'");
            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>SUCCESSFUL: </strong> Staff Leave Rejected.
                    </div>";

            header("Location: $url".$mod_dir."leave_approval");
            exit();
        }


        $data['page_title'] = "Approve Leave";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."approve_leave",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
