<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Create_prod_batch extends CI_Controller {
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
        $this->module = "Operations Supervisor";
   	}

	public function index(){

        if(isset($_POST['create_prod'])){

            $business_line_id =  $this->site_model->fil_string($this->input->post("business_line_id"));
            $uq_id =  $this->site_model->gen_uq_id("PRD");

            if(empty($business_line_id)) {
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            }   

            $current_ass_process_id =  $this->site_model->get_biz_first_process("$business_line_id")->id;

            $r = $this->db->query("SELECT * FROM prod_batch WHERE uq_id='$uq_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Code already exist. 
                            </div>";

                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('prod_batch', ['business_line_id'=>$business_line_id, 
                    'uq_id'=>$uq_id, 
                    'current_ass_process_id'=>$current_ass_process_id, 
                    'date_created'=>$date]);

            $prod_batch_id = $this->site_model->get_last_inserted("prod_batch")->id;

            $_SESSION['cache_form_prod_batch']['id'] = $prod_batch_id;

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."create_prod_batch");
            exit();
            
        }


        if(isset($_POST['reg_process'])){

            $prod_batch_id =  $this->site_model->fil_string($this->input->post("prod_batch_id"));
            $assigned_process_id =  $this->site_model->fil_string($this->input->post("assigned_process_id"));
            $num_of_output =  $this->site_model->fil_num($this->input->post("num_of_output"));
            $num_of_input =  $this->site_model->fil_string($this->input->post("num_of_input"));

            if(empty($prod_batch_id) OR empty($assigned_process_id) OR empty($num_of_input) OR empty($num_of_output)) {
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            }   

            $r = $this->db->query("SELECT * FROM prod_batch_process WHERE prod_batch_id='$prod_batch_id' AND $assigned_process_id='$assigned_process_id'");
            if($r->num_rows() > 0){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('prod_batch_process', ['prod_batch_id'=>$prod_batch_id, 
                    'assigned_process_id'=>$assigned_process_id, 
                    'num_of_output'=>$num_of_output, 
                    'num_of_input'=>$num_of_input, 
                    'staff_id'=>$this->staff_id, 
                    'date_created'=>$date]);

            $last_prod_batch_process_id = $this->site_model->get_last_inserted("prod_batch_process")->id;

            $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'] = $last_prod_batch_process_id;

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."create_prod_batch");
            exit();
            
        }

        if(isset($_POST['reg_items'])){

            // print "<pre>";
            // print_r($_POST);
            // print "</pre>";
            // exit();
            $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];
            $prod_batch_id = $_SESSION['cache_form_prod_batch']['id'];

            foreach ($_POST['item_id'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Select an Item.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }

            foreach ($_POST['quantity'] as $key => $val) {
                if (empty($val)) {
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input quantity.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }  

            // echo count($_POST['sn']);
            // exit();

            $count = count($this->input->post("sn"));
            $date = date("Y-m-d H:i:s");
            $this->db->trans_begin();

            // insert items
            for ($i=0; $i<$count; $i++) { 
                $item_id = $_POST['item_id']["$i"];
                $quantity = $_POST['quantity']["$i"];

                if(empty($item_id) OR $quantity <= 0){
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>Operation Failed. </strong> 
                          </div>";
                    header("Location: $this->full_url"."create_prod_batch");
                    exit();
                }

                $this->db->insert('prod_input_items', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$quantity, 
                    'store_item_id'=>$item_id, 
                    'staff_id' => $this->staff_id, 
                    'date_created'=>$date]);
            }

            // update batch process status
            $this->db->query("UPDATE prod_batch_process SET status='awaiting',num_of_input='$count' WHERE id='$prod_batch_process_id'");

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful, Item Added Awaiting Approval. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            } 
            
        }

        if(isset($_POST['reg_output_items'])){

            // print "<pre>";
            // print_r($_POST);
            // print "</pre>";
            // exit();
            $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];
            $prod_batch_id = $_SESSION['cache_form_prod_batch']['id'];
            $business_line_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;

            foreach ($_POST['item'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Enter an Item.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }

            foreach ($_POST['quantity'] as $key => $val) {
                if (empty($val) OR $val <= 0) {
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input quantity.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }  

            foreach ($_POST['unit'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input the unit
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }

            // echo count($_POST['sn']);
            // exit();

            $count = count($this->input->post("item"));
            $date = date("Y-m-d H:i:s");
            $this->db->trans_begin();

            // insert output items
            for ($i=0; $i<$count; $i++) { 
                $item = $_POST['item']["$i"];
                $quantity = $_POST['quantity']["$i"];
                $unit = $_POST['unit']["$i"];

                $this->db->insert('prod_output_items', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$quantity, 
                    'item'=>$item, 
                    'staff_id' => $this->staff_id, 
                    'unit' => $unit, 
                    'date_created'=>$date]);
            }

            $old_assigned_process_id = $this->site_model->get_prod_batch($prod_batch_id)->current_ass_process_id;

            $assigned_process_id = $this->site_model->get_biz_next_assigned_process($business_line_id, $prod_batch_id)->id;

            // update batch process status
            $this->db->query("UPDATE prod_batch_process SET status='complete',staff_id=$this->staff_id WHERE id='$prod_batch_process_id'");

             // update prod batch current assigned process
            $this->db->query("UPDATE prod_batch SET current_ass_process_id='$assigned_process_id' WHERE id='$prod_batch_id'");

            

            $this->db->insert('prod_batch_process', ['prod_batch_id'=>$prod_batch_id, 
                    'assigned_process_id'=>$assigned_process_id, 
                    'num_of_input'=>$count, 
                    'status'=>'approved', 
                    'date_created'=>$date]);

            $last_prod_batch_process_id = $this->site_model->get_last_inserted("prod_batch_process")->id;

            $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'] = $last_prod_batch_process_id;

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."create_prod_batch/next/?pd=$prod_batch_id");
                exit();
            } 
            
        }




        $data['page_title'] = "Create Production Batch";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."create_prod_batch",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}

    public function next(){

        if(isset($_POST['reg_num_of_output'])){

            $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];
            $prod_batch_id = $_SESSION['cache_form_prod_batch']['id'];
            $business_line_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;

            $num_of_output = $this->input->post("num_of_output");

            if(empty($num_of_output) OR $num_of_output <= 0) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Please enter a valid number.
                        </div>";
               header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                exit();
            }

            // update
            $this->db->query("UPDATE prod_batch_process SET num_of_output='$num_of_output' WHERE id='$prod_batch_process_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>Successful: </strong> Number of OutPut items recorded.
                        </div>";
                header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                exit();

            
        }

        if(isset($_POST['reg_output_items'])){

  
            $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];
            $prod_batch_id = $_SESSION['cache_form_prod_batch']['id'];
            $business_line_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;

            foreach ($_POST['item'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Enter an Item.
                            </div>";
                    header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                    exit();
                }
            }

            foreach ($_POST['quantity'] as $key => $val) {
                if (empty($val) OR $val <= 0) {
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input quantity.
                            </div>";
                    header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                    exit();
                }
            }  

            foreach ($_POST['unit'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input the unit
                            </div>";
                    header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                    exit();
                }
            }

            // echo count($_POST['sn']);
            // exit();

            $count = count($this->input->post("item"));
            $date = date("Y-m-d H:i:s");
            $this->db->trans_begin();

            // insert output items
            for ($i=0; $i<$count; $i++) { 
                $item = $_POST['item']["$i"];
                $quantity = $_POST['quantity']["$i"];
                $unit = $_POST['unit']["$i"];

                $this->db->insert('prod_output_items', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$quantity, 
                    'item'=>$item, 
                    'staff_id' => $this->staff_id, 
                    'unit' => $unit, 
                    'date_created'=>$date]);
            }

            $old_assigned_process_id = $this->site_model->get_prod_batch($prod_batch_id)->current_ass_process_id;

            $assigned_process_id = $this->site_model->get_biz_next_assigned_process($business_line_id, $prod_batch_id)->id;

            // update batch process status
            $this->db->query("UPDATE prod_batch_process SET status='complete',staff_id=$this->staff_id WHERE id='$prod_batch_process_id'");

             // update prod batch current assigned process
            $this->db->query("UPDATE prod_batch SET current_ass_process_id='$assigned_process_id' WHERE id='$prod_batch_id'");

            

            $this->db->insert('prod_batch_process', ['prod_batch_id'=>$prod_batch_id, 
                    'assigned_process_id'=>$assigned_process_id, 
                    'num_of_input'=>$count, 
                    'status'=>'approved', 
                    'date_created'=>$date]);

            $defect_qty = $this->input->post("defect_qty");
            $defect_unit = $this->input->post("defect_unit");

            if(!empty($defect_qty)){
                // insert defects
                if(empty($defect_unit)){
                    $this->db->trans_rollback();
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>Operation Failed. Enter Defect Unit </strong> 
                      </div>";
                    header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                    exit();

                }

                $this->db->insert('prod_defects', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$defect_qty, 
                    'unit'=>$defect_unit, 
                    'staff_id' => $this->staff_id, 
                    'unit' => $unit, 
                    'date_created'=>$date]);

            }

            $last_prod_batch_process_id = $this->site_model->get_last_inserted("prod_batch_process")->id;

            $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'] = $last_prod_batch_process_id;

            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";
                header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                exit();
            } 
            
        }

        if(isset($_POST['finish_prod'])){

            $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];
            $prod_batch_id = $_SESSION['cache_form_prod_batch']['id'];
            $business_line_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;

            foreach ($_POST['item'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Enter an Item.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }

            foreach ($_POST['quantity'] as $key => $val) {
                if (empty($val) OR $val <= 0) {
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input quantity.
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }  

            foreach ($_POST['unit'] as $key => $val) {
                if (empty($val)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Please Input the unit
                            </div>";
                    header("Location: $url".$mod_dir."create_prod_batch");
                    exit();
                }
            }


            $count = count($this->input->post("item"));
            $date = date("Y-m-d H:i:s");
            $this->db->trans_begin();

            // insert output items
            for ($i=0; $i<$count; $i++) { 
                $item = $_POST['item']["$i"];
                $quantity = $_POST['quantity']["$i"];
                $unit = $_POST['unit']["$i"];

                $this->db->insert('prod_output_items', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$quantity, 
                    'item'=>$item, 
                    'staff_id' => $this->staff_id, 
                    'unit' => $unit, 
                    'date_created'=>$date]);
            }

            $old_assigned_process_id = $this->site_model->get_prod_batch($prod_batch_id)->current_ass_process_id;

            // $assigned_process_id = $this->site_model->get_biz_next_assigned_process($business_line_id, $prod_batch_id)->id;

            // update batch process status
            $this->db->query("UPDATE prod_batch_process SET status='complete',staff_id=$this->staff_id WHERE id='$prod_batch_process_id'");
            $this->db->query("UPDATE prod_batch SET done='1',staff_id=$this->staff_id WHERE id='$prod_batch_id'");

            $defect_qty = $this->input->post("defect_qty");
            $defect_unit = $this->input->post("defect_unit");

            if(!empty($defect_qty)){
                // insert defects
                if(empty($defect_unit)){
                    $this->db->trans_rollback();
                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>Operation Failed. Enter Defect Unit </strong> 
                      </div>";
                    header("Location: $this->full_url"."create_prod_batch/next?pd=$prod_batch_id");
                    exit();

                }

                $this->db->insert('prod_defects', ['prod_batch_id'=>$prod_batch_id, 
                    'prod_batch_process_id'=>$prod_batch_process_id, 
                    'quantity'=>$defect_qty, 
                    'unit'=>$defect_unit, 
                    'staff_id' => $this->staff_id, 
                    'unit' => $unit, 
                    'date_created'=>$date]);

            }


            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Failed. </strong> 
                  </div>";
                header("Location: $url".$mod_dir."create_prod_batch");
                exit();
            }
            else{
                $this->db->trans_commit();
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful. </strong> 
                  </div>";

                unset($_SESSION['cache_form_prod_batch']);
                header("Location: $this->full_url"."prod_batch_history");
                exit();
            } 
            
        }

        $data['page_title'] = "Create Production Batch";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."next_create_prod_batch",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
