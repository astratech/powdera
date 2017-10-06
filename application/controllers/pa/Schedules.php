<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedules extends CI_Controller {
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

        if(isset($_POST['add_reminder'])){

            $reminder =  $this->site_model->fil_text($this->input->post("reminder"));
            $when = date("y-m-d", strtotime($this->input->post("when")));

            if (empty($reminder) OR empty($when)) {
                
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Fill the empty fields
                        </div>";

                header("Location: $url".$mod_dir."schedules");
                exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->insert('pa_schedule', ['reminder'=>$reminder, 'r_when'=>$when, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>SUCCESSFUL: </strong> Reminder Created.
                </div>";

            header("Location: $url".$mod_dir."schedules");
            exit();
        }

        if(isset($_POST['delete_sch'])){

            $schedule_id =  $this->site_model->fil_text($this->input->post("schedule_id"));

            if(empty($schedule_id)) {
                
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>Operation Failed.</strong>
                        </div>";

                header("Location: $url".$mod_dir."schedules");
                exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM pa_schedule WHERE id='$schedule_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful</strong>
            </div>";

            header("Location: $url".$mod_dir."schedules");
            exit();
        }

        $data['page_title'] = "Schedules";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."schedules",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
