 <?php
class Site_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("Africa/Lagos");
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
        $val = preg_replace("/[^A-Za-z0-9,_.\-@(): ]/", "", $str);
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

    public function get_dept($id){
        $q = $this->db->query("SELECT * FROM depts WHERE id='$id'");
        $output = ["id"=>null, "name"=>null, "url"=>null, "title"=>null];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        $output = json_encode($output);
        return json_decode($output);
        
    }

     public function get_dept_list(){
        $q = $this->db->query("SELECT * FROM depts");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q;
        }
        return $output;
    }

    public function get_records($table){
        $q = $this->db->query("SELECT * FROM $table");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q;
        }
        return $output;
    }

    public function get_record($table, $id){
        $q = $this->db->query("SELECT * FROM $table WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_staff($id){
        $q = $this->db->query("SELECT * FROM staffs WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_vendor($id){
        $q = $this->db->query("SELECT * FROM vendors WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_supplier($id){
        $q = $this->db->query("SELECT * FROM suppliers WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();

        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_business_line($id){
        $q = $this->db->query("SELECT * FROM business_line WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();

        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_process($id){
        $q = $this->db->query("SELECT * FROM process WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_assigned_process($id){
        $q = $this->db->query("SELECT * FROM assigned_process WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_biz_next_assigned_process($biz_line_id, $prod_batch_id){
        $q = $this->db->query("SELECT * FROM prod_batch_process WHERE prod_batch_id='$prod_batch_id'");
        $count = $q->num_rows();
        $count = $count + 1;

        $ass = $this->db->query("SELECT * FROM assigned_process WHERE business_line_id='$biz_line_id' AND process_order='$count'");
        if($ass->num_rows() > 0){
            $output = $ass->row();
        }
        else{
            foreach ($ass->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 

    }

    public function get_last_prod_batch_process($prod_batch_id, $prod_batch_process_id){
        $ass = $this->db->query("SELECT * FROM prod_batch_process WHERE prod_batch_id='$prod_batch_id' AND id!='$prod_batch_process_id' ORDER BY id DESC LIMIT 0,1");
        if($ass->num_rows() > 0){
            $output = $ass->row();
        }
        else{
            foreach ($ass->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_prod_batch($id){
        $q = $this->db->query("SELECT * FROM prod_batch WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_prod_batch_process($id){
        $q = $this->db->query("SELECT * FROM prod_batch_process WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_store_item($id){
        $q = $this->db->query("SELECT * FROM store_items WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }


    public function get_sales_product($id){
        $q = $this->db->query("SELECT * FROM sales_product WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }

    public function get_customer($id){
        $q = $this->db->query("SELECT * FROM customers WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
        
    }



    public function get_all_staff_list(){
        $q = $this->db->query("SELECT * FROM staffs");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q;
        }
        return $output;
        
    }

    public function gen_uq_id($txt) {
        // $a = uniqid();
        $a = mt_rand(9000,9000000);
        $r = $txt.substr(str_shuffle($a),0, 4);
        return strtoupper($r);
    }

    public function gen_token() {
        $a = mt_rand(9000,9000000);
        $r = substr(str_shuffle($a),0, 6);
        return strtoupper($r);
    }

    public function get_last_inserted($table){
        $q = $this->db->query("SELECT * FROM $table ORDER BY id DESC LIMIT 0,1");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_biz_first_process($id){
        $q = $this->db->query("SELECT * FROM assigned_process WHERE business_line_id='$id' ORDER BY process_order ASC LIMIT 0,1");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function calc_prod_input_items_qty($store_item_id){
        $input_quantity = 0;

        $q1 = $this->db->query("SELECT * FROM prod_input_items WHERE store_item_id='$store_item_id' ");
        if($q1->num_rows() > 0){
            foreach ($q1->result() as $d) {
                $input_quantity = $d->quantity + $input_quantity;
            }
        }

        return $input_quantity;
        
    }

    public function calc_ex_prod_qty_sold($id){
        $input_quantity = 0;

        $q1 = $this->db->query("SELECT * FROM sales_ex_product WHERE warehouse_id='$id' ");
        if($q1->num_rows() > 0){
            foreach ($q1->result() as $d) {
                $input_quantity = $d->quantity + $input_quantity;
            }
        }

        return $input_quantity;
        
    }

    public function calc_req_sale_qty($sales_product_id){
        $quantity = 0;

        $q1 = $this->db->query("SELECT * FROM customer_requests WHERE sales_product_id='$sales_product_id' ");
        if($q1->num_rows() > 0){
            foreach ($q1->result() as $d) {
                $quantity = $d->quantity + $quantity;
            }
        }

        return $quantity;
        
    }

    public function calc_sys_total_sales(){
        $total = 0;

        $q1 = $this->db->query("SELECT * FROM customer_requests WHERE status='delivered'");
        if($q1->num_rows() > 0){
            foreach ($q1->result() as $d) {
                $total = $d->amount + $total;
            }
        }

        return $total;
        
    }

    public function calc_total_warehouse_prod(){
        $total = 0;
        $st = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND is_approved='1' ORDER BY id DESC");
        foreach ($st->result() as $r) {
            $qq = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_id='$r->id' ORDER BY id DESC LIMIT 0,1");
            foreach ($qq->result() as $i) {
                $w_qty = $i->quantity;
            }
            $total = $w_qty + $total;
        }

        return $total;
        
    }

    public function is_staff_on_leave($staff_id){

        $date = date("Y-m-d H:i:s");
        $st = $this->db->query("SELECT * FROM leaves WHERE is_approved='1' AND staff_id='$staff_id' AND date_to>'$date' ORDER BY id DESC");
        if($st->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }        
    }

    public function calc_total_staff(){
        $total = 0;
        $st = $this->db->query("SELECT * FROM staffs WHERE is_approved='1' ORDER BY id DESC");
        foreach ($st->result() as $r) {

            $total++;
        }

        return $total;        
    }

    public function calc_staff_available(){
        $total = 0;
        $st = $this->db->query("SELECT * FROM staffs WHERE is_approved='1' ORDER BY id DESC");
        foreach ($st->result() as $r) {

            if($this->site_model->is_staff_on_leave($r->id)){

            }
            else{
                $total++;
            }
        }

        return $total;        
    }

    public function calc_total_prod_input($prod_batch_id){
        $total = 0;
        $st = $this->db->query("SELECT * FROM prod_input_items WHERE prod_batch_id='$prod_batch_id' ORDER BY id DESC");
        foreach ($st->result() as $r) {
            $total++;
        }

        return $total;        
    }

    public function calc_total_prod_output($prod_batch_id){
        $total = 0;
        $st = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_id='$prod_batch_id' ORDER BY id DESC");
        foreach ($st->result() as $r) {
            $total++;
        }

        return $total;        
    }

    public function calc_total_prod_defects($prod_batch_id){
        $total = 0;
        $st = $this->db->query("SELECT * FROM prod_defects WHERE prod_batch_id='$prod_batch_id' ORDER BY id DESC");
        foreach ($st->result() as $r) {
            $total++;
        }

        return $total;        
    }

    public function get_prod_batch_output($prod_batch_id){
        $q = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_id='$prod_batch_id' ORDER BY id DESC LIMIT 0,1");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_prod_output_item($id){
        $q = $this->db->query("SELECT * FROM prod_output_items WHERE id='$id'");
        $output = [];
        if($q->num_rows() > 0){
            $output = $q->row();
        }
        else{
            foreach ($q->field_data() as $d) {
                $output[$d->name] = null;
            }
        }       

        $output = json_encode($output);
        return json_decode($output); 
    }

    public function get_current_prod_batch_details(){
        $total = 0;
        $st = $this->db->query("SELECT * FROM prod_batch WHERE done='0' AND is_approved='1' ORDER BY id DESC LIMIT 0,1");
        $output = [];
        if($st->num_rows() > 0){
            foreach ($st->result() as $r) {
                $prod_batch_id = $r->id;
            }

            $output['input'] = $this->site_model->calc_total_prod_input($prod_batch_id);
            $output['output'] = $this->site_model->calc_total_prod_output($prod_batch_id);
            $output['defects'] = $this->site_model->calc_total_prod_defects($prod_batch_id);

        }
        else{
            $s2 = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND is_approved='1' ORDER BY id DESC LIMIT 0,1");
            foreach ($s2->result() as $r) {
                $prod_batch_id = $r->id;
            }

            $output['input'] = $this->site_model->calc_total_prod_input($prod_batch_id);
            $output['output'] = $this->site_model->calc_total_prod_output($prod_batch_id);
            $output['defects'] = $this->site_model->calc_total_prod_defects($prod_batch_id);
        }
        

        $output = json_encode($output);
        return json_decode($output);         
    }
}