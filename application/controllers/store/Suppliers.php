<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Suppliers extends CI_Controller {
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

        if(isset($_POST['create_supplier'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                // echo "$key == $val <br>";
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."suppliers");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM suppliers WHERE name='$name' OR uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Supplier already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."suppliers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('suppliers', ['name'=>$name, 
                    'uq_id'=>$uq_id, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."suppliers");
            exit();
            
        }

        if(isset($_POST['update_supplier'])){ 
            
            $name =  $this->site_model->fil_string($this->input->post("name"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $supplier_id =  $this->site_model->fil_string($this->input->post("supplier_id"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($supplier_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."suppliers");
                    exit();
                }

            } 


            $r = $this->db->query("SELECT * FROM customers WHERE (name='$name' OR uq_id='$uq_id') AND id!='$supplier_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Supplier already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."suppliers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $up_data = ['name'=>$name];

            $where = "id = $supplier_id";

            $str = $this->db->update_string('suppliers', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."suppliers");
            exit();
            
        }

        if(isset($_POST['delete_supplier'])){

            $supplier_id =  $this->site_model->fil_num($this->input->post("supplier_id"));
            
            if(empty($supplier_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."suppliers");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM suppliers WHERE id='$supplier_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."suppliers");
            exit();
            
        }

        $data['page_title'] = "Suppliers";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."suppliers",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
