<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Allowance extends CI_Controller {
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
        $this->module = "Account Manager";
   	}

	public function index(){

        if(isset($_POST['create_allowance'])){

            $staff_id =  $this->site_model->fil_num($this->input->post("staff_id"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $allowance_type =  $this->site_model->fil_string($this->input->post("type"));
            
            if(empty($staff_id) || empty($amount) || empty($allowance_type)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."allowance");
                    exit();
            }

            $r = $this->db->query("SELECT * FROM allowance WHERE staff_id='$staff_id' AND allowance_type='$allowance_type'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Allowance already assigned to a staff. 
                            </div>";

                    header("Location: $url".$mod_dir."allowance");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('allowance', ['staff_id'=>$staff_id, 'amount'=>$amount, 'allowance_type'=>$allowance_type, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."allowance");
            exit();
            
        }

        if(isset($_POST['update_allowance'])){

            $staff_id =  $this->site_model->fil_num($this->input->post("staff_id"));
            $allowance_id =  $this->site_model->fil_num($this->input->post("allowance_id"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $allowance_type =  $this->site_model->fil_string($this->input->post("type"));
            
            if(empty($staff_id) || empty($amount) || empty($allowance_type) || empty($allowance_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."allowance");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $r = $this->db->query("SELECT * FROM allowance WHERE staff_id='$staff_id' AND allowance_type='$allowance_type' AND id!='$allowance_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Allowance already assigned to a staff. 
                            </div>";

                    header("Location: $url".$mod_dir."allowance");
                    exit();
            }

            $this->db->query("UPDATE allowance SET amount='$amount',allowance_type='$allowance_type' WHERE id='$allowance_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."allowance");
            exit();
            
        }

        if(isset($_POST['delete_allowance'])){

            $allowance_id =  $this->site_model->fil_num($this->input->post("allowance_id"));
            
            if(empty($allowance_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."allowance");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM allowance WHERE id='$allowance_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."allowance");
            exit();
            
        }

        $data['page_title'] = "Allowance";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."allowance",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
