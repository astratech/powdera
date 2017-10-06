<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process extends CI_Controller {
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
        $this->module = "Operations Manager";
   	}

	public function index(){

        echo $this->site_model->get_last_inserted("business_line")->id;

        if(isset($_POST['create_process'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));

            //check for empty fields
            foreach ($_POST as $key => $val) {
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."process.php");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM process WHERE name='$name'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed. 
                            </div>";

                    header("Location: $url".$mod_dir."process");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('process', ['name'=>$name, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."process");
            exit();
            
        }

        if(isset($_POST['delete_process'])){

            $process_id =  $this->site_model->fil_num($this->input->post("process_id"));
            
            if(empty($process_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."process");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM process WHERE id='$process_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."process");
            exit();
            
        }

        $data['page_title'] = "Process";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."process",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
