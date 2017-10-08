<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Defects extends CI_Controller {
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
        $this->module = "QaQc";
   	}

	public function index(){

        if(isset($_POST['create'])){

            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $prod_batch_id =  $this->site_model->fil_num($this->input->post("prod_batch_id"));
            $num_of_defects =  $this->site_model->fil_num($this->input->post("num_of_defects"));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."defects");
                    exit();
                }

            }  

            if($num_of_defects > $quantity){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Number of Defects is more than quantity received. 
                            </div>";

                header("Location: $url".$mod_dir."defects");
                exit();
            }   

            $r = $this->db->query("SELECT * FROM qaqc WHERE prod_batch_id='$prod_batch_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Production Batch Defect already recorded. 
                            </div>";

                    header("Location: $url".$mod_dir."defects");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('qaqc', ['prod_batch_id'=>$prod_batch_id, 
                    'qty_received'=>$quantity, 
                    'num_of_defects'=>$num_of_defects, 
                    'staff_id'=>$this->staff_id, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."defects");
            exit();
            
        }

        if(isset($_POST['update'])){ 
            
            $c_id =  $this->site_model->fil_string($this->input->post("c_id"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $prod_batch_id =  $this->site_model->fil_num($this->input->post("prod_batch_id"));
            $num_of_defects =  $this->site_model->fil_num($this->input->post("num_of_defects"));

            if($num_of_defects > $quantity){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Number of Defects is more than quantity received. 
                            </div>";

                header("Location: $url".$mod_dir."defects");
                exit();
            }

            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($c_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."defects");
                    exit();
                }

            } 


            $date = date("Y-m-d H:i:s");

            $up_data = ['prod_batch_id'=>$prod_batch_id, 
                    'qty_received'=>$quantity, 
                    'num_of_defects'=>$num_of_defects
                    ];

            $where = "id = $c_id";

            $str = $this->db->update_string('qaqc', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."defects");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."defects");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM qaqc WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."defects");
            exit();
            
        }

        $data['page_title'] = "Defects";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."defects",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
