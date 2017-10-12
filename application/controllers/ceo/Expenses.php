<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses extends CI_Controller {
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
        $this->module = "CEO";

        
    }

    public function index(){

        if(isset($_POST['approve'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."expenses.php");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("UPDATE expenses SET is_approved='1', date_approved='$date' WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";

            header("Location: $url".$mod_dir."expenses");
            exit();
        }

        if(isset($_POST['approve'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."expenses.php");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM expenses WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";

            header("Location: $url".$mod_dir."expenses");
            exit();
        }

        $data['page_title'] = "Expenses";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."expenses",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
