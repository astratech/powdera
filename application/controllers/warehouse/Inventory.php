<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory extends CI_Controller {
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
        $this->module = "Warehouse Manager";
   	}

	public function index(){

        if(isset($_POST['create'])){

            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $unit =  $this->site_model->fil_string($this->input->post("unit"));
            $location =  $this->site_model->fil_string($this->input->post("location"));
            $value =  $this->site_model->fil_string($this->input->post("value"));
            $name =  $this->site_model->fil_string($this->input->post("name"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."inventory");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM warehouse_ex_prod WHERE uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Product Code already added. 
                            </div>";

                    header("Location: $url".$mod_dir."inventory");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('warehouse_ex_prod', ['name'=>$name, 
                    'uq_id'=>$uq_id, 
                    'quantity'=>$quantity, 
                    'unit'=>$unit, 
                    'location'=>$location, 
                    'value'=>$value, 
                    'staff_id'=>$this->staff_id, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."inventory");
            exit();
            
        }

        if(isset($_POST['update'])){ 
            
            $c_id =  $this->site_model->fil_string($this->input->post("c_id"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $unit =  $this->site_model->fil_string($this->input->post("unit"));
            $location =  $this->site_model->fil_string($this->input->post("location"));
            $value =  $this->site_model->fil_string($this->input->post("value"));
            $name =  $this->site_model->fil_string($this->input->post("name"));

            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($c_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."materials");
                    exit();
                }

            } 


            $date = date("Y-m-d H:i:s");

            $up_data = ['name'=>$name, 
                    'uq_id'=>$uq_id, 
                    'quantity'=>$quantity, 
                    'unit'=>$unit, 
                    'location'=>$location, 
                    'value'=>$value, 
                    ];

            $where = "id = $c_id";

            $str = $this->db->update_string('warehouse_ex_prod', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."inventory");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."inventory");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM warehouse_ex_prod WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."inventory");
            exit();
            
        }

        $data['page_title'] = "Inventory";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."inventory",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
