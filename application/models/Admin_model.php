 <?php
class Admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("Africa/Lagos");
        session_start();
    }

    public function fil_email($str){
        $val = preg_replace("/[^A-Za-z0-9_.-@]/", "", $str);
        return $val;
    }

    public function fil_num($str){
        $val = preg_replace("/[^0-9]/", "", $str);
        return $val;
    }

    public function fil_text($str){
        $val = preg_replace("/[^A-Za-z0-9,_.\-@() ]/", "", $str);
        return $val;
    }
    public function fil_string($str){
        $val = preg_replace("/[^A-Za-z0-9_.\- ]/", "", $str);
        return $val;
    }
    public function fil_password($str){
        $val = preg_replace("/[^A-Za-z0-9_.\-@!#$%&*() ]/", "", $str);
        return $val;
    }
    public function get_admin($email){
        $q = $this->db->query("SELECT * FROM admin WHERE email='$email'");
        $output = ["id"=>null, "name"=>null, "role"=>null, "date_created"=>null, "last_login"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['name'] = $r->name;
                $output['role'] = $r->role;
                $output['last_login'] = $r->last_login;
                $output['date_created'] = $r->date_created;
            }
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    
    public function encode_password($t) {
        $a = "jkiwg";
        $b = "$@dda";
        //encode pass
        $r = base64_encode($t);
        //add pre salt
        $r = $a.$r;
        return $r;
    }
    public function decode_password($t) {
        $r = substr($t, 5);
        $r = base64_decode($r);
        return $r;
    }
    
    public function update_last_login($email) {
        $d = date('Y-m-d H:i:s');
        $this->db->query("UPDATE admin SET last_login='$d' WHERE email='$email'");
    }
    public function get_total_members() {
        $q = $this->db->query("SELECT * FROM users");
        return $q->num_rows();
    }
    public function get_banks() {
        return $this->db->query("SELECT * FROM banks");
    }
    public function get_bank_name($id) {
        $r = $this->db->query("SELECT * FROM banks WHERE id='$id'");
        foreach ($r->result() as $row) {
            return $row->name;
        }
    }
    public function get_users() {
        return $this->db->query("SELECT * FROM users");
    }

    public function email_exist($email) {
        $q = $this->db->query("SELECT * FROM users WHERE email='$email'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function account_number_exist($account_number) {
        $q = $this->db->query("SELECT * FROM users WHERE account_number='$account_number'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function mobile_exist($mobile) {
        $q = $this->db->query("SELECT * FROM users WHERE mobile='$mobile'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function username_exist($username) {
        $q = $this->db->query("SELECT * FROM users WHERE username='$username'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function gen_trans_num() {
        $a1 = ['AS','GG','RQ','LF', 'FS', 'HC', 'TF', 'AF', 'UE', 'US', 'KK', 'LL', 'YT'];
        shuffle($a1);
        $a2 = rand(00,99);
        $r = "GLD".$a2."".$a1['1'];
        return $r;
    }
    public function gen_token() {
        $a = uniqid();
        $b = "GLD";
        return $b.substr(str_shuffle($a),0, 6);
    }
    public function send_sms($msg, $number){
        $message = urlencode($msg);
        $username = "unocash";
        $password = "unocash";
        $sender = urlencode("GoldPortal");
        // $url ='http://api.smartsmssolutions.com/smsapi.php?username='.$username.'&password='.$password.'&sender='.$sender.'&recipient='.$number.'&message='.$message;
        $url = "https://smartsmssolutions.com/api/?message=".$message."&to=".$number."&sender=".$sender."&type=0&routing=4&token=4QdwmXS85T3wK3TzxtentjBbkgJBVdcOo3bMep283Y5q4M8ZoivliweVzuynWiXznXhwZmXbOX3mjxL4Vgxn5WJQsgfVmpZ6StAC";
        $send = file_get_contents($url);
        return $send;
    }

    public function validate_mobile($number){
        $username = "unocash";
        $password = "unocash";
        $sender = urlencode("GoldPortal");
        $message = "Welcome to GoldPortal.";
        $message = urlencode($message);
        // $url ='http://api.smartsmssolutions.com/smsapi.php?username='.$username.'&password='.$password.'&sender='.$sender.'&recipient='.$number.'&message='.$message;
        $url = "https://smartsmssolutions.com/api/?message=".$message."&to=".$number."&sender=".$sender."&type=0&routing=4&token=4QdwmXS85T3wK3TzxtentjBbkgJBVdcOo3bMep283Y5q4M8ZoivliweVzuynWiXznXhwZmXbOX3mjxL4Vgxn5WJQsgfVmpZ6StAC";
        $send = file_get_contents($url);
        $r = substr($send, 0,4);
        if($r == "1000"){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_date_diff($day1, $day2){
        $r = [];
        //format dates
        $date1 = date_create($day1);
        $date2 = date_create($day2);
        //get differences
        $df = date_diff($date1,$date2);
        $h = $df->h;
        $m = $df->i;
        $s = $df->s;
        if ($df->invert == 1) {
            //set output
            $r['hours'] = $h + ($df->days * 24);
            $r['mins'] = ($m);
            $r['sec'] = ($s);
            $r['days'] =  $df->days;
        }else {
            //set output
            $r['hours'] = 0;
            $r['mins'] = 0;
            $r['sec'] = 0;
            $r['days'] =  -$df->days;
        }
        
        $r = json_encode($r);
        return json_decode($r);
    }

    public function get_support($ticket_num){
        $q = $this->db->query("SELECT * FROM support WHERE ticket_number='$ticket_num'");
        $output = ["id"=>null, 'user_id'=>null, 'subject'=>null, 'message'=>null, 'status'=>null, 'ip'=>null, 'date_created'=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['user_id'] = $r->user_id;
                $output['subject'] = $r->subject;
                $output['message'] = $r->message;
                $output['status'] = $r->status;
                $output['ip'] = $r->ip;
                $output['date_created'] = $r->date_created;
            }
            
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    public function get_token($token){
        $q = $this->db->query("SELECT * FROM users WHERE token='$token'");
        $output = ["email"=>null, "fullname"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['email'] = $r->email;
                $output['fullname'] = $r->fullname;
            }
            
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    public function token_match_email($token, $email){
        $q = $this->db->query("SELECT * FROM users WHERE token='$token' AND email='$email'");
        if($q->num_rows() > 0){
            return true;
            
        }
        return false;
    }
    public function get_option($name){
        $q = $this->db->query("SELECT * FROM options WHERE name='$name'");
        $output = ["value"=>""];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['value'] = $r->value;
            }
            
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    public function get_admin_unread_support_msg($ticket_num) {
        $total = 0;
        $q = $this->db->query("SELECT * FROM support_msg WHERE ticket_number='$ticket_num' AND admin_read='0'");
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + 1;
            }
        }
        return $total; 
    }
    public function get_user($username){
        $q = $this->db->query("SELECT * FROM users WHERE username='$username'");
        $output = ["id"=>null, "fullname"=>null, "mobile"=>null, "email"=>null, "city"=>null, "bank_id"=>null, "account_name"=>null, "account_number"=>null, "account_type"=>null, "ref"=>null, "bank_name"=>null, "ph_count"=>null, "package"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['fullname'] = $r->fullname;
                $output['mobile'] = $r->mobile;
                $output['email'] = $r->email;
                $output['city'] = $r->city;
                $output['bank_id'] = $r->bank_id;
                $output['ref'] = $r->ref;
                $output['bank_name'] = $this->admin_model->get_bank_name($r->bank_id);
                $output['account_type'] = $r->account_type;
                $output['account_name'] = $r->account_name;
                $output['account_number'] = $r->account_number;
                $output['date_created'] = $r->date_created;
                $output['ph_count'] = $r->ph_count;
                $output['package'] = $r->package;
            }
            
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    public function get_user_by_email($email){
        $q = $this->db->query("SELECT * FROM users WHERE email='$email'");
        $output = ["id"=>null, "fullname"=>null, "mobile"=>null, "email"=>null, "city"=>null, "bank_id"=>null, "account_name"=>null, "account_number"=>null, "account_type"=>null, "ref"=>null, "bank_name"=>null, "ph_count"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['fullname'] = $r->fullname;
                $output['mobile'] = $r->mobile;
                $output['email'] = $r->email;
                $output['password'] = $r->password;
                $output['username'] = $r->username;
                $output['city'] = $r->city;
                $output['bank_id'] = $r->bank_id;
                $output['ref'] = $r->ref;
                $output['bank_name'] = $this->admin_model->get_bank_name($r->bank_id);
                $output['account_type'] = $r->account_type;
                $output['account_name'] = $r->account_name;
                $output['account_number'] = $r->account_number;
                $output['date_created'] = $r->date_created;
                $output['ph_count'] = $r->ph_count;
            }
            
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }
    public function get_ph($id){
        $q = $this->db->query("SELECT * FROM ph WHERE id='$id'");
        $output = ["plan"=>null, "username"=>null, "amount"=>null, "trans_num"=>null, "returns"=>null, "release_date"=>null, "date_created"=>null, "is_merge"=>null, "is_confirmed"=>null, "date_confirmed"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['plan'] = $r->plan;
                $output['username'] = $r->username;
                $output['amount'] = $r->amount;
                $output['trans_num'] = $r->trans_num;
                $output['returns'] = $r->returns;
                $output['release_date'] = $r->release_date;
                $output['date_created'] = $r->date_created;
                $output['is_merge'] = $r->is_merge;
                $output['is_confirmed'] = $r->is_confirmed;
                $output['is_gh'] = $r->is_gh;
                $output['is_recycle'] = $r->is_recycle;                
                $output['date_confirmed'] = $r->date_confirmed;                
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }

    public function get_user_last_ph($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' ORDER BY id DESC LIMIT 0,1");
        $output = ["plan"=>null, "username"=>null, "amount"=>null, "trans_num"=>null, "returns"=>null, "release_date"=>null, "date_created"=>null, "is_merge"=>null, "is_confirmed"=>null, "date_confirmed"=>null, "is_gh"=>null, "id"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['plan'] = $r->plan;
                $output['id'] = $r->id;
                $output['username'] = $r->username;
                $output['amount'] = $r->amount;
                $output['trans_num'] = $r->trans_num;
                $output['returns'] = $r->returns;
                $output['release_date'] = $r->release_date;
                $output['date_created'] = $r->date_created;
                $output['is_merge'] = $r->is_merge;
                $output['is_confirmed'] = $r->is_confirmed;
                $output['is_gh'] = $r->is_gh;
                $output['is_recycle'] = $r->is_recycle;                
                $output['date_confirmed'] = $r->date_confirmed;                
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }

    public function is_user_having_ph_ungh($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_confirmed='1' AND is_gh='0' LIMIT 0,1");
        if($q->num_rows() > 0){
           return true;
        }
        else{
            return false;
        }
    }

    public function is_user_having_unpaid_gh($username){
        $q = $this->db->query("SELECT * FROM gh WHERE username='$username' AND is_confirmed='0' LIMIT 0,1");
        if($q->num_rows() > 0){
           return true;
        }
        else{
            return false;
        }
    }

    public function get_user_last_unpaid_ph($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_confirmed='0' AND is_gh='0' ORDER BY id ASC LIMIT 0,1");
        $id = null;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $id = $r->id;
            }
        }
        return $id;
    }

    public function get_user_last_ungh_ph($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_gh='0' ORDER BY id ASC LIMIT 0,1");
        $id = null;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $id = $r->id;
            }
        }
        return $id;
    }

    public function get_user_last_unpaid_gh($username){
        $q = $this->db->query("SELECT * FROM gh WHERE username='$username' AND is_confirmed='0' ORDER BY id ASC LIMIT 0,1");
        $id = null;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $id = $r->id;
            }
        }
        return $id;
    }


    public function get_user_total_ph($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_confirmed='1'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }

    public function get_user_total_locked_gh($username){
        $q = $this->db->query("SELECT * FROM gh WHERE locked='1' AND username='$username'");
        $amount = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $amount = $r->amount + $amount;
            }
        }
        return $amount;
    }

    public function get_gh($id){
        $q = $this->db->query("SELECT * FROM gh WHERE id='$id'");
        $output = ["plan"=>null, "username"=>null, "amount"=>null, "trans_num"=>null, "ph_id"=>null, "date_created"=>null, "is_merge"=>null, "is_confirmed"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['plan'] = $r->plan;
                $output['username'] = $r->username;
                $output['amount'] = $r->amount;
                $output['trans_num'] = $r->trans_num;
                $output['ph_id'] = $r->ph_id;
                $output['date_created'] = $r->date_created;
                $output['is_merge'] = $r->is_merge;
                $output['is_confirmed'] = $r->is_confirmed;
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }
    public function get_user_total_gh($username){
        $q = $this->db->query("SELECT * FROM gh WHERE username='$username' AND is_confirmed='1'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }
    public function get_user_total_bonus($username){
        $q = $this->db->query("SELECT * FROM bonus WHERE username='$username'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }

    public function get_user_total_recycle($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_recycle='1'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }

    public function count_user_total_recycle($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_recycle='1'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total++;
                
            }
        }
        return $total;
    }

    public function get_user_total_ref($username){
        $q = $this->db->query("SELECT * FROM users WHERE ref='$username'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + 1;
                
            }
        }
        return $total;
    }

    public function get_user_bonus_balance($username){
        $q = $this->db->query("SELECT * FROM bonus WHERE username='$username' AND is_paid='0'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }

    public function get_ph_id_by_trans_num($trans_num) {
        $r = $this->db->query("SELECT * FROM ph WHERE trans_num='$trans_num'");
        foreach ($r->result() as $row) {
            return $row->id;
        }
    }
    public function get_gh_id_by_trans_num($trans_num) {
        $r = $this->db->query("SELECT * FROM gh WHERE trans_num='$trans_num'");
        foreach ($r->result() as $row) {
            return $row->id;
        }
    }
    public function get_merge($id){
        $q = $this->db->query("SELECT * FROM merge WHERE id='$id'");
        $output = ["ph_id"=>null, "gh_id"=>null, "amount"=>null, "receipt"=>null, "is_confirmed"=>null, "is_blocked"=>null, "days"=>null, "date_paid"=>null, "date_created"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['ph_id'] = $r->ph_id;
                $output['gh_id'] = $r->gh_id;
                $output['amount'] = $r->amount;
                $output['receipt'] = $r->receipt;
                $output['is_confirmed'] = $r->is_confirmed;
                $output['is_blocked'] = $r->is_blocked;
                $output['days'] = $r->days;
                $output['date_paid'] = $r->date_paid;
                $output['date_created'] = $r->date_created;
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }
    public function get_plan($plan_name){
        $q = $this->db->query("SELECT * FROM plans WHERE name='$plan_name'");
        $output = ["id"=>null, "amount"=>null, "returns"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['amount'] = $r->amount;
                $output['returns'] = $r->returns;
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }
    public function is_user_verified($username) {
        $r = $this->db->query("SELECT * FROM users WHERE is_verified='1' AND username='$username'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function is_user_blocked($username) {
        $r = $this->db->query("SELECT * FROM users WHERE is_blocked='1' AND username='$username'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function does_user_have_pending_ph($username) {
        $r = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND username='$username'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function does_user_have_locked_gh($username) {
        $r = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND username='$username' AND locked='1'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function does_user_have_pending_gh($username) {
        $r = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND username='$username' AND locked='0'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function does_user_have_unmerged_gh($username) {
        $r = $this->db->query("SELECT * FROM gh WHERE is_merge='0' AND username='$username' AND locked='0'");
        if($r->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_unpaid_bonus($username){
        $q = $this->db->query("SELECT * FROM bonus WHERE username='$username' AND is_paid='0'");
        $amount = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $amount = $amount + $r->amount;
            }
        }
        return $amount;
    }
    public function is_user_ph_first_time($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username'");
        if($q->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function is_user_ph_first_time2($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username'");
        if($q->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_match_to_pay($price){
        $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND is_merge='0' AND amount='$price' AND username!='$this->username' AND locked='0' ORDER BY id DESC");
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $ph_id = $r->id;
            }
            return $ph_id;
        }
        else{
            return null;
        }
        
    }

    public function get_recipent($amount, $username){
        // $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND amount>='$amount' AND username!='$username' ORDER BY id ASC");
        $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND username!='$username' AND hidden='0' AND locked='0' AND  amount='$amount' ORDER BY id ASC LIMIT 0,1");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                return $r->id;                
            }
        }
        else{
            return null;
        }
        
    }

    public function get_sender($amount, $username){

        $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND username!='$username' AND hidden='0' AND is_recycle='0' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                $a_left = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id);
                // $a_left = (20/100) * $r->amount;
                if($a_left > 0){
                    $recipent_id = $r->id;
                    break;
                }
                
            }
            return $recipent_id;
        }
        else{
            return null;
        }
        
    }

    public function get_sender_20($amount, $username){
        $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND is_merge='0' AND username!='$username' AND hidden='0' AND merged_20='0' AND blocked='0' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {

                $d1 =  date('Y-m-d H:i:s', strtotime($r->date_created. ' + 2 days'));
                $d2 = $this->admin_model->get_date_diff($d1, date('Y-m-d H:i:s'))->hours;

                // if($d2 <= 48){
                    if(!$this->admin_model->does_user_have_pending_gh($r->username)){
                        $a_left = (20/100) * $r->amount;
                        if($a_left > 0){
                            $recipent_id = $r->id;
                            break;
                        }
                    }
                // }
                
            }
            return $recipent_id;            
        }
        else{
            return null;
        }
        
    }


    public function get_sender_80($amount, $username){
        
        $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND username!='$username' AND hidden='0' AND merged_20='1' AND blocked='0' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                // calculate day
                $days = $this->admin_model->get_date_diff($r->merged_20_date, date('Y-m-d H:i:s'))->days;

                if($this->admin_model->is_20_confirmed($r->id)){
                    $d1 =  date('Y-m-d H:i:s', strtotime($r->merged_20_date. ' + 2 days'));
                    $d2 = $this->admin_model->get_date_diff($d1, date('Y-m-d H:i:s'))->hours;

                    // if($d2 <= 31){
                        $a_left = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id);
                        if($a_left > 0){
                            $recipent_id = $r->id;
                            break;
                        }
                    // }
                }
            }
            return $recipent_id;            
        }
        else{
            return null;
        }
        
    }


    public function get_sender_normal($amount, $username){

        $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND username!='$username' AND hidden='0' AND blocked='0' AND is_recycle='0' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                // calculate day
                $days = $this->admin_model->get_date_diff($r->merged_20_date, date('Y-m-d H:i:s'))->days;

                $d1 =  date('Y-m-d H:i:s', strtotime($r->merged_20_date. ' + 2 days'));
                $d2 = $this->admin_model->get_date_diff($d1, date('Y-m-d H:i:s'))->hours;

                // if($d2 <= 39){
                    if(!$this->admin_model->does_user_have_pending_gh($r->username)){
                        $a_left = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id);
                        if($a_left > 0){
                            $recipent_id = $r->id;
                            break;
                        }
                    }
                // }
            }
            return $recipent_id;            
        }
        else{
            return null;
        }
        
    }

    public function get_sender_recycle($amount, $username){
        $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND username!='$username' AND hidden='0' AND blocked='0' AND is_recycle='1' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                // calculate day
                $days = $this->admin_model->get_date_diff($r->merged_20_date, date('Y-m-d H:i:s'))->days;

                $d1 =  date('Y-m-d H:i:s', strtotime($r->merged_20_date. ' + 2 days'));
                $d2 = $this->admin_model->get_date_diff($d1, date('Y-m-d H:i:s'))->hours;

                // if($d2 <= 39){
                    if(!$this->admin_model->does_user_have_pending_gh($username)){
                        $a_left = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id);
                        if($a_left > 0){
                            $recipent_id = $r->id;
                            break;
                        }
                    }
                // }
            }
            return $recipent_id;            
        }
        else{
            return null;
        }
    }

    public function get_real_recipent($amount, $username){
        // $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND amount>='$amount' AND username!='$username' ORDER BY id ASC");
        $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND username!='$username' AND hidden='0' ORDER BY id ASC");
        if($q->num_rows() > 0){
            $recipent_id = null;
            foreach ($q->result() as $r) {
                $a_left = $this->admin_model->get_unpaid_gh_amount($r->amount, $r->id);
                if($a_left > 0 && $a_left >= $amount){
                    $recipent_id = $r->id;
                    break;
                }
                
            }
            return $recipent_id;
        }
        else{
            return null;
        }
        
    }

    public function get_admin_match_to_receive($price, $username){
        $q = $this->db->query("SELECT * FROM ph WHERE is_merge='0' AND is_confirmed='0' AND amount='$price' AND username!='$username' ORDER BY id DESC");
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $ph_id = $r->id;
            }
            return $ph_id;
        }
        else{
            return null;
        }
    }
    public function is_merge_before($ph_id, $gh_id){
        $q = $this->db->query("SELECT * FROM merge WHERE ph_id='$ph_id' AND gh_id='$gh_id'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function is_20_confirmed($ph_id){
        $q = $this->db->query("SELECT * FROM merge WHERE ph_id='$ph_id' AND is_confirmed='1'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function is_gh_paid($ph_id){
        $q = $this->db->query("SELECT * FROM gh WHERE ph_id='$ph_id' AND is_confirmed='1'");
        if($q->num_rows() > 1){
            return true;
        }
        else{
            return false;
        }
    }
    public function has_user_ph_before($username, $price){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND amount='$price'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function has_user_ph_before_anyprice($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function has_user_transact_before($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_confirmed='1'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function count_gh_merged_confirmed($gh_id){
        $q = $this->db->query("SELECT * FROM merge WHERE gh_id='$gh_id' AND is_confirmed='1'");
        $count = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $count++;
            }
        }
        
        return $count;
    }
    public function has_user_gh($ph_id){
        $q = $this->db->query("SELECT * FROM ph WHERE is_gh='1' AND id='$ph_id'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_total_users(){
        $q = $this->db->query("SELECT * FROM users");
        return $q->num_rows()+600;
    }
    public function get_total_ph(){
        $q = $this->db->query("SELECT * FROM ph");
        $amount = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $amount = $r->amount + $amount;
            }
        }
        return $amount;
    }
    public function get_total_gh(){
        $q = $this->db->query("SELECT * FROM gh");
        $amount = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $amount = $r->amount + $amount;
            }
        }
        return $amount;
    }

    

    public function get_report($merge_id){
        $q = $this->db->query("SELECT * FROM reports WHERE merge_id='$merge_id'");
        $output = ["username"=>null, "reason"=>null, "id"=>null, "is_solved"=>null, "time_out"=>null];
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $output['username'] = $r->username;
                $output['reason'] = $r->reason;
                $output['id'] = $r->id;
                $output['date_created'] = $r->date_created;
                $output['is_solved'] = $r->is_solved;
                $output['time_out'] = $r->time_out;
                
            }
        }
        $output = json_encode($output);
        return json_decode($output);
    }
    public function get_user_total_wallet($username){
        $q = $this->db->query("SELECT * FROM wallet WHERE username='$username' AND is_recycle='0'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }
    public function is_wallet_cashable($username, $price){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND amount='$price' AND is_wallet='1'");
        if($q->num_rows() >= 5){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_wallet_times($username, $price){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND amount='$price' AND is_wallet='1'");
        return $q->num_rows();
    }

    public function has_user_testimony($username){
        $q1 = $this->db->query("SELECT * FROM gh WHERE username='$username' AND is_confirmed='1'");
        
        if($q1->num_rows() > 0){
            $q = $this->db->query("SELECT * FROM testimony WHERE username='$username'");
            if($q->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return true;
        }
        
    }
    public function has_user_report_before($username, $merge_id){
        $q1 = $this->db->query("SELECT * FROM reports WHERE username='$username' AND merge_id='$merge_id'");
        
        if($q1->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function gv_ref($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username'");
        if($q->num_rows() < 2){
            // echo "true";
            return true;
        }
        else{
            // echo "false";
            return false;
        }
    }

    public function count_unconfirmed_ph($username){
        $q = $this->db->query("SELECT * FROM ph WHERE username='$username' AND is_confirmed='0'");
        return $q->num_rows();
    }

    public function get_unpaid_gh_amount($gh_amount, $gh_id){
        $q = $this->db->query("SELECT * FROM merge WHERE gh_id='$gh_id'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return ($gh_amount - $total);
    }

    public function get_paid_gh_amount($gh_amount, $gh_id){
        $q = $this->db->query("SELECT * FROM merge WHERE gh_id='$gh_id'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return $total;
    }

    public function get_unpaid_ph_amount($ph_amount, $ph_id){
        $q = $this->db->query("SELECT * FROM merge WHERE ph_id='$ph_id'");
        $total = 0;
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $total = $total + $r->amount;
                
            }
        }
        return ($ph_amount - $total);
    }

    public function get_news(){

        $q = $this->db->query("SELECT * FROM news LIMIT 0,1");

        $output = ["content"=>null];


        if($q->num_rows() > 0){

            foreach ($q->result() as $r) {
                $output['id'] = $r->id;
                $output['content'] = $r->content;
            }

        }

        $output = json_encode($output);

        return json_decode($output);

    }

    public function is_ph_in_merge_list($ph_id){
        $q = $this->db->query("SELECT * FROM merge WHERE ph_id='$ph_id'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function is_gh_in_merge_list($gh_id){
        $q = $this->db->query("SELECT * FROM merge WHERE gh_id='$gh_id'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function is_ph_awaiting_merge($username){
        $q = $this->db->query("SELECT * FROM ph WHERE is_merge='0' AND username='$username'");
        if($q->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function admin_get_total_users() {
        $q = $this->db->query("SELECT * FROM users WHERE dont_count='0'");
        return $q->num_rows();
    }

    public function admin_get_total_ph() {
        $q = $this->db->query("SELECT * FROM ph WHERE dont_count='0'");
        $c = 0;
        foreach ($q->result() as $r) {
            $c = $c + $r->amount;
        }
        return $c;
    }

    public function admin_get_total_gh() {
        $q = $this->db->query("SELECT * FROM gh WHERE dont_count='0'");
        $c = 0;
        foreach ($q->result() as $r) {
            $c = $c + $r->amount;
        }
        return $c;
    }

    public function admin_get_total_ph_unmerged() {
        $q = $this->db->query("SELECT * FROM ph WHERE dont_count='0'");
        $c = 0;
        foreach ($q->result() as $r) {
            $c = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id) + $c;
        }
        return $c;
    }

    public function admin_get_total_gh_unmerged() {
        $q = $this->db->query("SELECT * FROM gh WHERE dont_count='0'");
        $c = 0;
        foreach ($q->result() as $r) {
            $c = $this->admin_model->get_unpaid_gh_amount($r->amount, $r->id) + $c;
        }
        return $c;
    }

    public function admin_get_total_merged() {
        $q = $this->db->query("SELECT * FROM merge WHERE dont_count='0'");
        $c = 0;
        foreach ($q->result() as $r) {
            $c = $r->amount + $c;
        }
        return $c;
    }

    public function get_roi($username){
        $l = $this->admin_model->get_user($username)->ph_count;
        $roi = 0;

        if($l >= 4){
            $roi = 50;
        }


        elseif($l == 3){
            $roi = 40;
        }
        elseif($l == 2){
            $roi = 30;
        }
        elseif($l == 1){
            $roi = 20;
        }else{
            $roi = 20;
        }

        return $roi;
    }
}
