<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Event extends CI_Controller {
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
        $this->module = "Admin PA";
   	}

	public function index(){

        if(isset($_POST['create'])){

            $event_name =  $this->site_model->fil_string($this->input->post("event_name"));
            $event_date =  date("y-m-d", strtotime($this->input->post("event_date")));
            $event_time =  $this->site_model->fil_text($this->input->post("event_time"));
            $c_name =  $this->site_model->fil_string($this->input->post("c_name"));
            $c_mobile =  $this->site_model->fil_string($this->input->post("c_mobile"));
            $event_duration =  $this->site_model->fil_string($this->input->post("event_duration"));
            $event_location =  $this->site_model->fil_string($this->input->post("event_location"));
           
            $obj = htmlspecialchars_decode($this->input->post("obj"), ENT_NOQUOTES);

            //check for empty fields
            foreach ($_POST as $key => $val) {
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
            $date = date("Y-m-d H:i:s");

            $this->db->insert('event_itin', ['event_name'=>$event_name, 
                    'event_date'=>$event_date, 
                    'event_time'=>$event_time,
                    'coordinator_name'=>$c_name,
                    'coordinator_mobile'=>$c_mobile,
                    'event_duration'=>$event_duration,
                    'event_location'=>$event_location,
                    'event_objectives'=>$obj,
                    'staff_id'=>$this->staff_id,
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."event");
            exit();
            
        }

        if(isset($_POST['update'])){ 
            
            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            $event_name =  $this->site_model->fil_string($this->input->post("event_name"));
            $event_date =  date("y-m-d", strtotime($this->input->post("event_date")));
            $event_time =  $this->site_model->fil_text($this->input->post("event_time"));
            $c_name =  $this->site_model->fil_string($this->input->post("c_name"));
            $c_mobile =  $this->site_model->fil_string($this->input->post("c_mobile"));
            $event_duration =  $this->site_model->fil_string($this->input->post("event_duration"));
            $event_location =  $this->site_model->fil_string($this->input->post("event_location"));
           
            $obj = htmlspecialchars_decode($this->input->post("obj"), ENT_NOQUOTES);


            //check for empty fields
            foreach ($_POST as $key => $val) {
                if (empty($val) OR empty($c_id)) {

                    $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Fill the empty fields
                            </div>";
                    header("Location: $url".$mod_dir."event");
                    exit();
                }

            } 

            $date = date("Y-m-d H:i:s");

            $up_data = ['event_name'=>$event_name, 
                    'event_date'=>$event_date, 
                    'event_time'=>$event_time,
                    'coordinator_name'=>$c_name,
                    'coordinator_mobile'=>$c_mobile,
                    'event_duration'=>$event_duration,
                    'event_location'=>$event_location,
                    'event_objectives'=>$obj
                    ];

            $where = "id = $c_id";

            $str = $this->db->update_string('event_itin', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."event");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."event");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM event_itin WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."event");
            exit();
            
        }

        $data['page_title'] = "Event Itinerary";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."event",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
