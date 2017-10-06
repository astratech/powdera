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
   	}

	public function index(){

        if(isset($_POST['create_leave'])){

            $leave_type =  $this->site_model->fil_string($this->input->post("leave_type"));
            $date_from =  date("y-m-d", strtotime($this->input->post("date_from")));
            $date_to =  date("y-m-d", strtotime($this->input->post("date_to")));
            $comment =  $this->site_model->fil_text($this->input->post("comment"));


            $this->db->insert('leaves', ['staff_id'=>$this->staff_id, 'leave_type'=>$leave_type, 'date_from'=>$date_from, 'date_to'=>$date_to, 'comments'=>$comment]);

            header("Location: $url".$mod_dir."leave");
            exit();
        }

        $data['page_title'] = "Support Staff Leave";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."leave",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
