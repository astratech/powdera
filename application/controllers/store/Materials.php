<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Materials extends CI_Controller {
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

        if(isset($_POST['create_materials'])){

            $supplier_id =  $this->site_model->fil_string($this->input->post("supplier_id"));
            $item_name =  $this->site_model->fil_string($this->input->post("name"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $unit =  $this->site_model->fil_string($this->input->post("unit"));
            $staff_id =  $this->site_model->fil_string($this->input->post("staff_id"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $date_supplied =  date("y-m-d H:i:s", strtotime($this->input->post("date_supplied")));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                // echo "$key == $val <br>";
                $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."materials");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM suppliers WHERE uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Material already added. 
                            </div>";

                    header("Location: $url".$mod_dir."materials");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('store_items', ['item_name'=>$item_name, 
                    'uq_id'=>$uq_id, 
                    'supplier_id'=>$supplier_id, 
                    'quantity'=>$quantity, 
                    'unit'=>$unit, 
                    'staff_id'=>$staff_id, 
                    'date_supplied'=>$date_supplied, 
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."materials");
            exit();
            
        }

        if(isset($_POST['update_material'])){ 
            
            $item_name =  $this->site_model->fil_string($this->input->post("name"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $staff_id =  $this->site_model->fil_string($this->input->post("staff_id"));
            $supplier_id =  $this->site_model->fil_string($this->input->post("supplier_id"));
            $unit =  $this->site_model->fil_string($this->input->post("unit"));
            $material_id =  $this->site_model->fil_string($this->input->post("material_id"));
            $uq_id =  $this->site_model->fil_string($this->input->post("uq_id"));
            $date_supplied =  date("y-m-d H:i:s", strtotime($this->input->post("date_supplied")));


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($supplier_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."materials");
                    exit();
                }

            } 


            // $r = $this->db->query("SELECT * FROM store_items WHERE (name='$name' OR uq_id='$uq_id') AND id!='$supplier_id'");
            // if($r->num_rows() > 0){
            //     $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
            //                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
            //                     <strong>ERROR: </strong> Supplier already exist. 
            //                 </div>";

            //         header("Location: $url".$mod_dir."suppliers");
            //         exit();
            // }

            $date = date("Y-m-d H:i:s");

            $up_data = ['item_name'=>$item_name,
                    'uq_id'=>$uq_id, 
                    'supplier_id'=>$supplier_id, 
                    'quantity'=>$quantity, 
                    'unit'=>$unit, 
                    'staff_id'=>$staff_id, 
                    'date_supplied'=>$date_supplied
                    ];

            $where = "id = $material_id";

            $str = $this->db->update_string('store_items', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."materials");
            exit();
            
        }

        if(isset($_POST['delete_material'])){

            $material_id =  $this->site_model->fil_num($this->input->post("material_id"));
            
            if(empty($material_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."materials");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM store_items WHERE id='$material_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."materials");
            exit();
            
        }

        if(isset($_POST['write_off'])){

            $item_id =  $this->site_model->fil_num($this->input->post("material_id"));
            $qty_in_store =  $this->site_model->fil_num($this->input->post("qty_in_store"));
            $qty_to_writeoff =  $this->site_model->fil_num($this->input->post("qty_to_writeoff"));
            $reason =  htmlspecialchars_decode($this->input->post("reason"), ENT_NOQUOTES);

            if(empty($item_id) OR empty($qty_in_store) OR empty($qty_to_writeoff) OR empty($reason)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."materials");
                exit();
            }

            if($qty_to_writeoff > $qty_in_store){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Quantity to writeoff is more than Quantity in store.
                        </div>";
                header("Location: $url".$mod_dir."materials");
                exit();
            }

            $date = date("Y-m-d H:i:s");



            $this->db->insert('store_item_write_off', ['item_id'=>$item_id, 
                    'quantity'=>$qty_to_writeoff, 
                    'staff_id'=>$this->staff_id, 
                    'reason'=>$reason, 
                    'date_created'=>$date
                    ]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."writeoff");
            exit();
            
        }

        $data['page_title'] = "Materials";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."materials",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
