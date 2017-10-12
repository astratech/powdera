<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exp_category extends CI_Controller {
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

        if(isset($_POST['create'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));
            $description = htmlspecialchars_decode($this->input->post("description"), ENT_NOQUOTES);
            
            if(empty($name)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."exp_category.php");
                    exit();
            }

            $r = $this->db->query("SELECT * FROM exp_category WHERE name='$name'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Category name already used. 
                            </div>";

                    header("Location: $url".$mod_dir."exp_category");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('exp_category', ['name'=>$name, 'description'=>$description, 'staff_id'=>$this->staff_id, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."exp_category");
            exit();
        }

        if(isset($_POST['update'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            $name =  $this->site_model->fil_string($this->input->post("name"));
            $description = htmlspecialchars_decode($this->input->post("description"), ENT_NOQUOTES);
            
            if(empty($name)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."exp_category");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $r = $this->db->query("SELECT * FROM exp_category WHERE name='$name' AND id!='$c_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Category name already used. 
                            </div>";

                    header("Location: $url".$mod_dir."exp_category");
                    exit();
            }

            $this->db->query("UPDATE exp_category SET name='$name',description='$description' WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."exp_category");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."exp_category");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM exp_category WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."exp_category");
            exit();
            
        }

        $data['page_title'] = "Expenditure Categories";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."exp_category",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
