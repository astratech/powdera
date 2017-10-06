<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Test extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */

	public function index()

	{

		// $this->load->view('welcome_message');

	}



	public function all()

	{

		$this->load->view('users/header');

		$this->load->view('users/content');

		$this->load->view('users/sidebar');

		$this->load->view('users/footer');

	}



	public function enc()

	{

		$t = 'altbaba';

		echo $this->admin_model->encode_password($t);
		// echo $this->admin_model->gen_token();

	}



	public function sms()

	{

		echo $this->admin_model->send_sms("from ur love", "09031958264");

	}



	public function dec()
	{

		$t = "jkiwgdW5hY2h1a3d1";

		echo $this->admin_model->decode_password($t);

	}

	public function ph_users()

	{
		$t = 0;

		$q = $this->db->query("SELECT * FROM users");
        if($q->num_rows() > 0){
            foreach ($q->result() as $ph) {
            	if(!$this->admin_model->has_user_ph_before_anyprice($ph->username)){
            		$t = $t + 1;
            	}
            }
        }

        echo $t;


	}

	public function list_ph(){
		$t = 0;

		$q = $this->db->query("SELECT * FROM ph WHERE is_merge='1'");
        if($q->num_rows() > 0){
            foreach ($q->result() as $ph) {
            	if(!$this->admin_model->is_ph_in_merge_list($ph->id)){
            		echo "$ph->username == $ph->trans_num<br/>";
            	}
            }
        }

	}

	public function unph()

	{

		$t = 0;

		$q = $this->db->query("SELECT * FROM ph");
        if($q->num_rows() > 0){
            foreach ($q->result() as $ph) {
            	$u = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id);

            	$t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;

            	// if($u < $ph->amount){
            	// 	// $t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;
            	// }
            	// else{
            	// 	$t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;
            	// }
            	
            }
        }

        echo $t;


	}

	public function ungh()

	{

		$t = 0;

		$q = $this->db->query("SELECT * FROM gh WHERE locked='0' and hidden='0'");
        if($q->num_rows() > 0){
            foreach ($q->result() as $gh) {
            	$t = $this->admin_model->get_unpaid_gh_amount($gh->amount, $gh->id) + $t;
            }
        }

        echo $t;


	}

	public function unghlocked()

	{

		$t = 0;

		$q = $this->db->query("SELECT * FROM gh WHERE locked='1' and hidden='0'");
        if($q->num_rows() > 0){
            foreach ($q->result() as $gh) {
            	$t = $this->admin_model->get_unpaid_gh_amount($gh->amount, $gh->id) + $t;
            }
        }

        echo $t;


	}

	public function tmerge()

	{

		$t = 0;

		$q = $this->db->query("SELECT * FROM merge WHERE hidden='0'");
		// $q = $this->db->query("SELECT * FROM merge");
        if($q->num_rows() > 0){
            foreach ($q->result() as $p) {
            	$t = $p->amount + $t;
            }
        }

        echo $t;


	}

	public function trecycle()

	{

		$t = 0;

		$q = $this->db->query("SELECT * FROM ph WHERE is_recycle='1' AND is_merge='0'");
		// $q = $this->db->query("SELECT * FROM merge");
        if($q->num_rows() > 0){
            foreach ($q->result() as $p) {

            	$d1 =  date('Y-m-d H:i:s', strtotime($p->date_created. ' + 3 days'));
                $d2 = $this->admin_model->get_date_diff($d1, date('Y-m-d H:i:s'))->hours;

                // if($d2 <= 48){
                	$t = $p->amount + $t;
            		echo "$d2 :: $p->trans_num :: $p->amount <br>";
                // }
            	
            }
        }

        echo $t;


	}

	public function leftph(){
		$q = $this->db->query("SELECT * FROM ph");
        if($q->num_rows() > 0){
            foreach ($q->result() as $ph) {
            	$u = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id);

            	// $t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;

            	if($u < $ph->amount AND $u != 0){
            		// $t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;

            		echo "$ph->username = N$u || $ph->trans_num<br>";
            	}
            	// else{
            	// 	$t = $this->admin_model->get_unpaid_ph_amount($ph->amount, $ph->id) + $t;
            	// }
            	
            }
        }

        // echo $t;
	}

	public function forcemewsdds(){
		$q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND hidden='0' AND locked='0' ORDER BY id ASC");
	    if($q->num_rows() > 0){
	        foreach ($q->result() as $gh) {
	            $gh_merge_amount = $this->admin_model->get_unpaid_gh_amount($gh->amount, $gh->id);

	            // get match
	            $sender_ph_id = $this->admin_model->get_sender($gh_merge_amount, $gh->username);
	            $date = date("Y-m-d H:i:s");

	            //if there is a merge
	            if(!is_null($sender_ph_id)){

	                //get  info
	                $ph_id =  $sender_ph_id;
	                $gh_id = $gh->id;

	                $ph_amount = $this->admin_model->get_ph($sender_ph_id)->amount;
	                $ph_merge_amount= $this->admin_model->get_unpaid_ph_amount($ph_amount, $ph_id);

	                $gh_merge_amount = $this->admin_model->get_unpaid_gh_amount($gh->amount, $gh->id);

	                if($gh_merge_amount > 0 || $ph_merge_amount > 0){
	                    $ph_user = $this->admin_model->get_ph($ph_id)->username;
	                    $ph_trans = $this->admin_model->get_ph($ph_id)->trans_num;

	                    $gh_user = $this->admin_model->get_gh($gh_id)->username;
	                    $gh_trans = $this->admin_model->get_gh($gh_id)->trans_num;

	                    // echo "$ph_user / $ph_trans / $ph_merge_amount == $gh_user / $gh_trans / $gh_merge_amount<br/>";
	                        if($gh_merge_amount > $ph_merge_amount ){
	                            if($ph_merge_amount > 1 && $gh_merge_amount > 1){
	                                echo "$ph_user / $ph_trans / $ph_merge_amount == $gh_user / $gh_trans / $gh_merge_amount<br/>";
	                                // merge them
	                                $this->db->insert('merge', ["ph_id"=>$ph_id, "gh_id"=>$gh_id, "amount"=>$ph_merge_amount, "days"=>"9", "date_created"=>$date]);

	                                // update gh merged
	                                $this->db->query("UPDATE gh SET is_merge='1' WHERE id='$gh_id'");

	                                //update ph merged
	                                $this->db->query("UPDATE ph SET is_merge='1' WHERE id='$ph_id'");

	                                $ph_number = $this->admin_model->get_user($this->admin_model->get_ph($ph_id)->username)->mobile;
	                                $gh_number = $this->admin_model->get_user($this->admin_model->get_gh($gh_id)->username)->mobile;

	                                $ph_msg = "You have been merged to pay N$ph_merge_amount on WealthTrain. Login to see details.";
	                                $gh_msg = "You have been merged to receive N$ph_merge_amount on WealthTrain. Login to see details.";

											  // $this->admin_model->send_sms($ph_msg, $ph_number);
											$this->admin_model->send_sms($gh_msg, $gh_number);
	                            }
	                            
	                        }
	                        else{
	                            if($ph_merge_amount > 1 && $gh_merge_amount > 1){
	                                echo "$ph_user / $ph_trans / $ph_merge_amount == $gh_user / $gh_trans / $gh_merge_amount<br/>";
	                                $this->db->insert('merge', ["ph_id"=>$ph_id, "gh_id"=>$gh_id, "amount"=>$gh_merge_amount, "days"=>"9", "date_created"=>$date]);

	                                // update gh merged
	                                $this->db->query("UPDATE gh SET is_merge='1' WHERE id='$gh_id'");

	                                //update ph merged
	                                $this->db->query("UPDATE ph SET is_merge='1' WHERE id='$ph_id'");

	                                $ph_number = $this->admin_model->get_user($this->admin_model->get_ph($ph_id)->username)->mobile;
	                                $gh_number = $this->admin_model->get_user($this->admin_model->get_gh($gh_id)->username)->mobile;

	                                $ph_msg = "You have been merged to pay N$gh_merge_amount on WealthTrain.  Login to see details";
	                                $gh_msg = "You have been merged to receive N$gh_merge_amount on WealthTrain. Login to see details";

									// $this->admin_model->send_sms($ph_msg, $ph_number);
		                            $this->admin_model->send_sms($gh_msg, $gh_number);
	                            }
	                            
	                        }
	                    
	                }                
	            }
	        }
	        echo "1";
	        exit();
	    }
	    else{
	        echo "no_gh";
	        exit();
	    }
	}

	public function fm2434343(){
		$q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND hidden='0' AND is_recycle='1' AND is_merge='0' ORDER BY id ASC");
	    if($q->num_rows() > 0){
	    	foreach ($q->result() as $ph) {

	    		$ph_20_percent = (50/100) * $ph->amount;
	    		// get recipent
                $recipent = $this->admin_model->get_real_recipent($ph_20_percent, $ph->username);
                if(is_null($recipent)){
                	
                }
                else{
                    // do merging
                    $gh_id = $recipent;
                    $ph_id = $ph->id;
                    $date = date("Y-m-d H:i:s");

                    // merge them
                    $this->db->insert('merge', ["ph_id"=>$ph_id, "gh_id"=>$gh_id, "amount"=>$ph_20_percent, "days"=>"4", "date_created"=>$date]);

                    // update gh merged
                    $this->db->query("UPDATE gh SET is_merge='1' WHERE id='$gh_id'");

                    //update ph merged
                    $this->db->query("UPDATE ph SET is_merge='1' WHERE id='$ph_id'");

                    $ph_number = $this->admin_model->get_user($this->admin_model->get_ph($ph_id)->username)->mobile;
                    $gh_number = $this->admin_model->get_user($this->admin_model->get_gh($gh_id)->username)->mobile;

                    $ph_msg = "You have been merged to pay.  Login to see details";
                    $gh_msg = "You have been merged to receive. Login to see details";


                    $this->admin_model->send_sms($ph_msg, $ph_number);
		                            $this->admin_model->send_sms($gh_msg, $gh_number);
                    
                    echo "Good";
                }
	    	}
	    }
	    else{
	    	echo "No more PH";
	    	exit();
	    }
	}

	public function f20344334(){
		$q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND hidden='0' AND is_recycle='0' AND is_merge='0' AND merged_20='0' ORDER BY id ASC LIMIT 20");
		$t =0;
	    if($q->num_rows() > 0){
	    	foreach ($q->result() as $ph) {
	    		// $p =((20/100) * $ph->amount);
	    		// echo "$ph->trans_num :: $ph->amount :: $p<br>";
	    		// $t = $t + ((20/100) * $ph->amount);

	    		$ph_20_percent = (20/100) * $ph->amount;
	    		// get recipent
                $recipent = $this->admin_model->get_real_recipent($ph_20_percent, $ph->username);
                if(is_null($recipent)){
                	
                }
                else{
                    // do merging
                    $gh_id = $recipent;
                    $ph_id = $ph->id;
                    $date = date("Y-m-d H:i:s");

                    // merge them
                    $this->db->insert('merge', ["ph_id"=>$ph_id, "gh_id"=>$gh_id, "amount"=>$ph_20_percent, "days"=>"12", "date_created"=>$date]);

                    // update gh merged
                    $this->db->query("UPDATE gh SET is_merge='1' WHERE id='$gh_id'");

                    //update ph merged
                    $this->db->query("UPDATE ph SET is_merge='1',merged_20='1',merged_20_date='$date' WHERE id='$ph_id'");

                    $ph_number = $this->admin_model->get_user($this->admin_model->get_ph($ph_id)->username)->mobile;
                    $gh_number = $this->admin_model->get_user($this->admin_model->get_gh($gh_id)->username)->mobile;

                    $ph_msg = "You have been merged to pay.  Login to see details";
                    $gh_msg = "You have been merged to receive. Login to see details";


                    $this->admin_model->send_sms($ph_msg, $ph_number);
		            $this->admin_model->send_sms($gh_msg, $gh_number);
                    
                    // echo "Good";
                }
	    	}
	    }

	    echo "total = $t";
	}
}

