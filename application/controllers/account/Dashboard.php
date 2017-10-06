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
        $this->staff_id = $_SESSION['powdera_logged']['staff_id'];
        $this->module = "Account Manager";
    }

    public function index(){
        if(isset($_POST['reg_pop'])){
            $merge_id = $this->input->post('merge_id');
            $trans_num= $this->input->post('trans_num');
            if(empty($trans_num) || empty($merge_id)){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>ERROR: </strong> Fill thse empty fields
                  </div>";
                header("Location: $url"."dashboard");
                exit();
            }   
            $config['upload_path'] = 'public/assets/pop';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10000;
            $config['file_name'] = $merge_id;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('receipt')){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>ERROR: </strong> Upload failed
                      </div>";
                // echo $this->upload->display_errors();
                header("Location: $url"."dashboard");
                exit();
            }
            else{
                $u = $this->upload->data();
                $pop_name = $u['file_name'];
                $date = date("Y-m-d H:i:s");
                $this->db->query("UPDATE merge SET receipt='$pop_name', date_paid='$date' WHERE id='$merge_id'");
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>SUCCESS: </strong> Upload Successful
                      </div>";
                header("Location: $url"."dashboard");
                exit();
            } 
        }

        if(isset($_POST['create_query'])){

            $staff_id =  $this->site_model->fil_num($this->input->post("staff_id"));
            $comments =  $this->site_model->fil_text($this->input->post("comments"));
            
            if(empty($staff_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."queries");
                    exit();
            }

            $config['upload_path'] = 'public/assets/site/queries';
            $config['allowed_types'] = 'docx|doc|txt|pdf';
            $config['max_size'] = 100000;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('doc')){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>ERROR: </strong> Upload failed
                      </div>";
                echo $this->upload->display_errors();
                // header("Location: $url".$mod_dir."queries");
                exit();
            }
            else{
                $u = $this->upload->data();
                $doc_name = $u['file_name'];
                $date = date("Y-m-d H:i:s");

                $this->db->insert('queries', ['staff_id'=>$staff_id, 'doc'=>$doc_name, 'comments'=>$comments, 'date_created'=>$date]);

                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>Operation Successful </strong> 
                      </div>";
                header("Location: $url".$mod_dir."queries");
                exit();
            } 
            
        }

        $data['page_title'] = "Dashboard";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."dashboard",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
    }
}
