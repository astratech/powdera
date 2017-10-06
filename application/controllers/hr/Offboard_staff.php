<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Offboard_staff extends CI_Controller {
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

        if(isset($_POST['make_offboard'])){

            $staff_id =  $this->site_model->fil_num($this->input->post("staff_id"));
            $date = date("Y-m-d H:i:s");
            
            if(empty($staff_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."view_staff");
                    exit();
            }

            $this->db->query("UPDATE staffs SET offboard='1' WHERE id='$staff_id'");
            $_SESSION['notification'] = "<div class='alert alert-callout alert-successå alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>Operation Successful</strong>
                    </div>";

            header("Location: $url".$mod_dir."view_staff");
            exit();
        }

        $data['page_title'] = "Offboard Staff";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."offboard_staff",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
