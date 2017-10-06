<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Salary extends CI_Controller {
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

        if(isset($_POST['create_salary'])){

            $staff_id =  $this->site_model->fil_num($this->input->post("staff_id"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            
            if(empty($staff_id) || empty($amount)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."salary");
                    exit();
            }

            $r = $this->db->query("SELECT * FROM salary WHERE staff_id='$staff_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Salary already assigned to a staff. 
                            </div>";

                    header("Location: $url".$mod_dir."salary");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('salary', ['staff_id'=>$staff_id, 'amount'=>$amount, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."salary");
            exit();
            
        }

        if(isset($_POST['update_salary'])){

            $salary_id =  $this->site_model->fil_num($this->input->post("salary_id"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            
            if(empty($salary_id) || empty($amount)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."salary");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("UPDATE salary SET amount='$amount' WHERE id='$salary_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."salary");
            exit();
            
        }

        if(isset($_POST['delete_salary'])){

            $salary_id =  $this->site_model->fil_num($this->input->post("salary_id"));
            
            if(empty($salary_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."salary");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM salary WHERE id='$salary_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."salary");
            exit();
            
        }

        $data['page_title'] = "Salary";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."salary",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
