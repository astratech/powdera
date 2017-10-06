<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Units extends CI_Controller {
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
        $this->module = "Store Keeper";
   	}

	public function index(){

        if(isset($_POST['create_unit'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));

            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."units");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM quantity_units WHERE name='$name'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Unit already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."units");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('quantity_units', ['name'=>$name, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."units");
            exit();
            
        }

        if(isset($_POST['update_unit'])){ 
            
            $name =  $this->site_model->fil_string($this->input->post("name"));
            $unit_id =  $this->site_model->fil_string($this->input->post("unit_id"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($unit_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."units");
                    exit();
                }

            } 


            $r = $this->db->query("SELECT * FROM quantity_units WHERE name='$name' AND id!='$unit_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Unit already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."units");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $up_data = ['name'=>$name];

            $where = "id = $unit_id";

            $str = $this->db->update_string('quantity_units', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."units");
            exit();
            
        }

        if(isset($_POST['delete_unit'])){

            $unit_id =  $this->site_model->fil_num($this->input->post("unit_id"));
            
            if(empty($unit_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."units");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM quantity_units WHERE id='$unit_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."units");
            exit();
            
        }

        $data['page_title'] = "Units";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."units",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
