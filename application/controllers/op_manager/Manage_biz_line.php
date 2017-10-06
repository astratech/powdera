<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manage_biz_line extends CI_Controller {
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

        if(isset($_POST['delete_biz'])){

            $business_line_id =  $this->site_model->fil_num($this->input->post("business_line_id"));
            
            if(empty($business_line_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."manage_biz_line");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM business_line WHERE id='$business_line_id'");
            $this->db->query("DELETE FROM assigned_process WHERE business_line_id='$business_line_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."manage_biz_line");
            exit();
            
        }

        $data['page_title'] = "Manage Business Line";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."manage_biz_line",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}

    public function change_order($id = null){

        if(is_null($id)){
            header("Location: $this->full_url"."manage_biz_line");
            exit();
        }

        if(isset($_POST['change_order'])){

            $count = count($this->input->post("ass_id"));
            for ($i=0; $i<$count; $i++) { 
                $ai = $_POST['ass_id']["$i"];
                $oi = $_POST['ord_id']["$i"];

                if(empty($oi) OR $oi == 0){
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>Operation Failed. </strong> 
                          </div>";
                    header("Location: $this->full_url"."manage_biz_line");
                    exit();
                }

                $up_data = ['process_order'=>$oi];

                $where = "id = $ai";

                $str = $this->db->update_string('assigned_process', $up_data, $where);


                $this->db->query("$str");
            }

            

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $this->full_url"."manage_biz_line");
            exit();
            
        }

        $data['business_line_id'] = $id;

       
        $data['page_title'] = "Change Order";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."change_order",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
