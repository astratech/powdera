<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $url = $this->config->base_url();

        if(!isset($_SESSION['powdera_logged'])){
            header("Location: $url"."login");
            exit();
        } 

        $this->mod_dir = $this->site_model->get_dept($_SESSION['powdera_logged']['dept_id'])->url;
        $this->full_url = $this->config->base_url()."".$this->mod_dir;
        $this->module = "CEO";
   	}

	public function index(){
        $date_to = date('Y-m-d');
        $date_from = date('Y-m-d', strtotime('-7 days'));

        $batch = [];
        $inputs = [];
        $defects = [];
        $outputs = [];

        

        if(isset($_POST['get_prod'])){
            $date_from =  date("y-m-d", strtotime($this->input->post("date_from")));
            $date_to =  date("y-m-d", strtotime($this->input->post("date_to")));

            if(empty($date_from) OR empty($date_to)){
                header("Location: $url".$mod_dir."dashboard");
                exit();
            }

            $s2 = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND (date_created>'$date_from' AND date_created<'$date_to') ORDER BY id ASC");
            foreach ($s2->result() as $r) {
                $prod_batch_id = $r->id;
                array_push($batch, $r->uq_id);
                array_push($inputs, $this->site_model->calc_total_prod_input($prod_batch_id));
                array_push($defects, $this->site_model->calc_total_prod_defects($prod_batch_id));
                array_push($outputs, $this->site_model->calc_total_prod_output($prod_batch_id));
            }
        }
        else{
            $s2 = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND (date_created>'$date_from' AND date_created<'$date_to') ORDER BY id ASC");
            foreach ($s2->result() as $r) {
                $prod_batch_id = $r->id;
                array_push($batch, $r->uq_id);
                array_push($inputs, $this->site_model->calc_total_prod_input($prod_batch_id));
                array_push($defects, $this->site_model->calc_total_prod_defects($prod_batch_id));
                array_push($outputs, $this->site_model->calc_total_prod_output($prod_batch_id));
            }
        }

        $data['batch'] = $batch;
        $data['inputs'] = $inputs;
        $data['defects'] = $defects;
        $data['outputs'] = $outputs;
        $data['stats_statement'] = "Showing Stats From ".date('d-M-Y', strtotime($date_from))." To ".date('d-M-Y', strtotime($date_to));

        // echo json_encode($batch);
        // exit();

        $data['page_title'] = "$this->module | Dashboard";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."dashboard",$data);
        $this->load->view("$this->mod_dir"."footer",$data);

        unset($_SESSION['notification']);
	}
}
