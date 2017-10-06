<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Create_biz_line extends CI_Controller {
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

        if(isset($_POST['create_biz'])){

            $name =  $this->site_model->fil_string($this->input->post("name"));
            $num_of_process =  $this->site_model->fil_num($this->input->post("num_of_process"));
            $uq_id =  $this->site_model->gen_uq_id("BIZ");

            //check for empty fields
            foreach ($_POST as $key => $val) {
                // $_SESSION['cache_form'][$key] = $val;
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."create_biz_line.php");
                    exit();
                }

            }     

            $r = $this->db->query("SELECT * FROM business_line WHERE uq_id='$uq_id' OR name='$name'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed. 
                            </div>";

                    header("Location: $url".$mod_dir."create_biz_line");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $_SESSION['cache_form_biz']['name'] = $name;
            $_SESSION['cache_form_biz']['num_of_process'] = $num_of_process;
            $_SESSION['cache_form_biz']['uq_id'] = $uq_id;

            // $this->db->insert('store_items', ['item_name'=>$item_name, 
            //         'uq_id'=>$uq_id, 
            //         'supplier_id'=>$supplier_id, 
            //         'quantity'=>$quantity, 
            //         'staff_id'=>$staff_id, 
            //         'date_supplied'=>$date_supplied, 
            //         'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."create_biz_line");
            exit();
            
        }

        if(isset($_POST['final_biz'])){

            $name = $_SESSION['cache_form_biz']['name'];
            $num_of_process = $_SESSION['cache_form_biz']['num_of_process'];
            $uq_id =   $_SESSION['cache_form_biz']['uq_id'];

            $date = date("Y-m-d H:i:s");

            $this->db->trans_begin();


            // insert business line
            $this->db->insert('business_line', ['name'=>$name, 
                    'uq_id'=>$uq_id, 
                    'num_of_process'=>$num_of_process, 
                    'date_created'=>$date]);

            $last_inserted_id = $this->site_model->get_last_inserted("business_line")->id;

            for ($i=1; $i<=$num_of_process ; $i++){ 
                $process_id = $this->input->post("$i");
                $this->db->insert('assigned_process', ['business_line_id'=>$last_inserted_id, 
                    'process_id'=>$process_id, 
                    'process_order'=>$i, 
                    'date_created'=>$date]);
            }

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                unset($_SESSION['cache_form_biz']);
                header("Location: $url".$mod_dir."create_biz_line");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
                unset($_SESSION['cache_form_biz']);
                header("Location: $url".$mod_dir."manage_biz_line");
                exit();
            }            
        }

        if(isset($_POST['update_supplier'])){ 
            
            $item_name =  $this->site_model->fil_string($this->input->post("name"));
            $quantity =  $this->site_model->fil_num($this->input->post("quantity"));
            $staff_id =  $this->site_model->fil_string($this->input->post("staff_id"));
            $supplier_id =  $this->site_model->fil_string($this->input->post("supplier_id"));
            $supplier_id =  $this->site_model->fil_string($this->input->post("supplier_id"));
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

            $up_data = ['item_name'=>$item_name,
                    'uq_id'=>$uq_id, 
                    'supplier_id'=>$supplier_id, 
                    'quantity'=>$quantity, 
                    'staff_id'=>$staff_id, 
                    'date_supplied'=>$date_supplied
                    ];

            $where = "id = $supplier_id";

            $str = $this->db->update_string('store_items', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."suppliers");
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

        if(isset($_POST['cancel_biz'])){
            unset($_SESSION['cache_form_biz']);
            header("Location: $url".$mod_dir."create_biz_line");
            exit();
        }



        $data['page_title'] = "Create Business Line";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."create_biz_line",$data);
        // $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
