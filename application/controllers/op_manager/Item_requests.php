<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_requests extends CI_Controller {
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

        if(isset($_POST['approve_items'])){ 
            
            $prod_batch_id =  $this->site_model->fil_string($this->input->post("prod_batch_id"));
            $prod_batch_process_id =  $this->site_model->fil_string($this->input->post("prod_batch_process_id"));

            // echo $prod_batch_process_id;
            // exit();

            if (empty($prod_batch_id) OR empty($prod_batch_process_id)) {

                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Operation Failed.
                        </div>";
                header("Location: $url".$mod_dir."requests");
                exit();
            }


            $date = date("Y-m-d H:i:s");

            $up_data = ['manager_approved'=>'1',
                    'date_approved'=>$date
                    ];

            $where = "prod_batch_process_id = $prod_batch_process_id AND prod_batch_id = $prod_batch_id";

            $str = $this->db->update_string('prod_input_items', $up_data, $where);


            $this->db->query("$str");
            // $this->db->query("UPDATE prod_batch_process SET status='approved',approver_staff_id='$this->staff_id' WHERE id='$prod_batch_process_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."item_requests");
            exit();
            
        }

        $data['page_title'] = "Requests";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."item_requests",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
