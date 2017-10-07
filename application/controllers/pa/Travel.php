<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Travel extends CI_Controller {
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

            $period =  $this->site_model->fil_string($this->input->post("period"));
            $hotel =  $this->site_model->fil_string($this->input->post("hotel"));
            $flight_num =  $this->site_model->fil_string($this->input->post("flight_num"));
            $departure =  date("y-m-d", strtotime($this->input->post("departure")));
            $arrival =  $this->input->post("arrival");
            $city =  $this->site_model->fil_string($this->input->post("city"));           
            $activities = htmlspecialchars_decode($this->input->post("activities"), ENT_NOQUOTES);

            //check for empty fields
            foreach ($_POST as $key => $val) {
                if($key != "arrival"){
                    if (empty($val)){

                        $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                    <strong>ERROR: </strong> Fill the empty fields
                                </div>";
                        header("Location: $url".$mod_dir."travel");
                        exit();
                    }
                }
            } 

            if($arrival != ""){
                $arrival =  date("y-m-d", strtotime($arrival));
            }
            else {
                $arrival = null;
            } 
            $date = date("Y-m-d H:i:s");

            $this->db->insert('travel_itin', ['period'=>$period, 
                    'hotel'=>$hotel, 
                    'flight_num'=>$flight_num,
                    'departure'=>$departure,
                    'arrival'=>$arrival,
                    'city'=>$city,
                    'activities'=>$activities,
                    'staff_id'=>$this->staff_id,
                    'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            unset($_SESSION['cache_form']);
            header("Location: $url".$mod_dir."travel");
            exit();
            
        }

        if(isset($_POST['update'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            $period =  $this->site_model->fil_string($this->input->post("period"));
            $hotel =  $this->site_model->fil_string($this->input->post("hotel"));
            $flight_num =  $this->site_model->fil_string($this->input->post("flight_num"));
            $departure =  date("y-m-d", strtotime($this->input->post("departure")));
            $arrival =  $this->input->post("arrival");
            $city =  $this->site_model->fil_string($this->input->post("city"));           
            $activities = htmlspecialchars_decode($this->input->post("activities"), ENT_NOQUOTES);

            foreach ($_POST as $key => $val) {
                if($key != "arrival"){
                    if (empty($val)){

                        $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                    <strong>ERROR: </strong> Fill the empty fields
                                </div>";
                        header("Location: $url".$mod_dir."travel");
                        exit();
                    }
                }
            } 

            if($arrival != ""){
                $arrival =  date("y-m-d", strtotime($arrival));
            }
            else {
                $arrival = null;
            } 

            $date = date("Y-m-d H:i:s");

            // echo "$activities";
            // exit();

            $up_data = ['period'=>$period, 
                    'hotel'=>$hotel, 
                    'flight_num'=>$flight_num,
                    'departure'=>$departure,
                    'arrival'=>$arrival,
                    'city'=>$city,
                    'activities'=>$activities
                    ];

            $where = "id = $c_id";

            $str = $this->db->update_string('travel_itin', $up_data, $where);


            $this->db->query("$str");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."travel");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."travel");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM travel_itin WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."travel");
            exit();
            
        }

        $data['page_title'] = "Travel Itinerary";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."travel",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
