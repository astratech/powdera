<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses extends CI_Controller {
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

        if(isset($_POST['create'])){

            $title =  $this->site_model->fil_string($this->input->post("title"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $category_id =  $this->site_model->fil_num($this->input->post("category_id"));
            $uq_id =  $this->site_model->gen_uq_id("EXP");

            // echo "$category_id";
            // exit();

            $description = htmlspecialchars_decode($this->input->post("description"), ENT_NOQUOTES);
            
            if(empty($title) OR empty($amount) OR empty($category_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."expenses.php");
                    exit();
            }


            $date = date("Y-m-d H:i:s");

            $this->db->insert('expenses', ['title'=>$title, 'amount'=>$amount, 'uq_id'=>$uq_id, 'description'=>$description, 'staff_id'=>$this->staff_id, 'category_id'=>$category_id, 'date_created'=>$date]);

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."expenses");
            exit();
        }

        if(isset($_POST['update'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            $title =  $this->site_model->fil_string($this->input->post("title"));
            $amount =  $this->site_model->fil_num($this->input->post("amount"));
            $category_id =  $this->site_model->fil_num($this->input->post("category_id"));
            $description = htmlspecialchars_decode($this->input->post("description"), ENT_NOQUOTES);
            
            if(empty($title) OR empty($amount) OR empty($category_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."expenses.php");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("UPDATE expenses SET title='$title', amount='$amount',category_id='$category_id', description='$description' WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."expenses");
            exit();
            
        }

        if(isset($_POST['delete'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
                  $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                                <strong>ERROR: </strong> Operation Failed
                            </div>";

                    header("Location: $url".$mod_dir."expenses");
                    exit();
            }

            $date = date("Y-m-d H:i:s");

            $this->db->query("DELETE FROM expenses WHERE id='$c_id'");

            $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                    <strong>Operation Successful </strong> 
                  </div>";
            header("Location: $url".$mod_dir."expenses");
            exit();
            
        }

        if(isset($_POST['upload'])){

            $c_id =  $this->site_model->fil_num($this->input->post("c_id"));
            
            if(empty($c_id)){
              $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                            <strong>ERROR: </strong> Operation Failed
                        </div>";

                header("Location: $url".$mod_dir."expenses");
                exit();
            }

            $date = date("Y-m-d H:i:s");

            $config['upload_path'] = 'public/assets/site/expenses';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc|pdf';
            $config['max_size'] = 10000;
            $config['file_name'] = $c_id;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('receipt')){
                $_SESSION['notification'] = "<div class='alert alert-callout alert-danger alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>ERROR: </strong> Upload failed
                      </div>";
                // echo $this->upload->display_errors();
                header("Location: $url".$mod_dir."expenses");
                exit();
            }
            else{
                $u = $this->upload->data();
                $pop_name = $u['file_name'];
                $date = date("Y-m-d H:i:s");
                $this->db->query("UPDATE expenses SET receipt='$pop_name' WHERE id='$c_id'");
                $_SESSION['notification'] = "<div class='alert alert-callout alert-success alert-dismissable' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
                        <strong>SUCCESS: </strong> Upload Successful
                      </div>";
                header("Location: $url".$mod_dir."expenses");
                exit();
            } 
            
        }

        $data['page_title'] = "Expenses";

        $this->load->view("$this->mod_dir"."header",$data);
        $this->load->view("$this->mod_dir"."expenses",$data);
        $this->load->view("$this->mod_dir"."footer",$data);
        unset($_SESSION['notification']);
	}
}
