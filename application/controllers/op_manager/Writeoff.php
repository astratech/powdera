<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Writeoff extends CI_Controller {
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

        if(isset($_POST['approve'])){ 
            
            $writeoff_id =  $this->site_model->fil_num($this->input->post("writeoff_id"));

            //check for empty fields
            if (empty($writeoff_id)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Operation Failed.
                        </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }

            $item_id = $this->site_model->get_record("store_item_write_off", $writeoff_id)->item_id;
            $item_qty = $this->site_model->get_record("store_items", $item_id)->quantity;

            $qty_in_store = $item_qty - $this->site_model->calc_prod_input_items_qty($item_id);
            $writeoff_qty = $this->site_model->get_record("store_item_write_off", $writeoff_id)->quantity;

            
            if ($writeoff_qty > $qty_in_store) {
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Operation Failed.<br><br>  Quantity to writeoff is more than Quantity in store.
                        </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }
        

            $new_qty = $item_qty - $writeoff_qty;
            $date = date("Y-m-d H:i:s");

            $this->db->trans_begin();

            $this->db->query("UPDATE store_items SET quantity='$new_qty' WHERE id='$item_id'");
            $this->db->query("UPDATE store_item_write_off SET is_approved='1',approve_staff_id='$this->staff_id',date_approved='$date' WHERE id='$writeoff_id'");

            if($this->db->trans_status() === FALSE){

                $this->db->trans_rollback();

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }      

            
        }


        if(isset($_POST['decline'])){ 
            
            $writeoff_id =  $this->site_model->fil_num($this->input->post("writeoff_id"));

            //check for empty fields
            if (empty($writeoff_id)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Operation Failed.
                        </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }
            $item_id = $this->site_model->get_record("store_item_write_off", $writeoff_id)->item_id;
            $item_qty = $this->site_model->get_record("store_items", $this->site_model->get_record("store_item_write_off", $writeoff_id)->item_id)->quantity;
            $writeoff_qty = $this->site_model->get_record("store_item_write_off", $writeoff_id)->quantity;

            $new_qty = $item_qty - $writeoff_qty;
            $date = date("Y-m-d H:i:s");

            $this->db->trans_begin();

            $this->db->query("DELETE FROM store_item_write_off WHERE id='$writeoff_id'");

            if($this->db->trans_status() === FALSE){

                $this->db->trans_rollback();

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."writeoff");
                exit();
            }      

            
        }

        $data['page_title'] = "Write Off Materials";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."writeoff",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
