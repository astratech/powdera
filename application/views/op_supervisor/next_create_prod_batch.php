            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () { 

                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='supplier_id']").val(d.id);
                            $("#app-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    $(".c-n-q").click(function (e) {
                        e.preventDefault();
                        $("#c-form-modal").modal("show");
                    });

                    $(".shwEditModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#edit-modal [name='supplier_id']").val(d.id);
                            $("#edit-modal [name='name']").val(d.name);
                            $("#edit-modal [name='uq_id']").val(d.uq_id);
                            $("#edit-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    $(".addItem").click(function (e) {

                        e.preventDefault();
                        try{
                            var $entry = $('.c-in .form-group').clone();


                            $('.ent-form').append($entry);

                            var num_of_input = $(".ent-form .ent-inp").length;
                            $("#boxNumOfInput").val(num_of_input);

                            
                            var new_num_of_input = $("#boxNumOfInput").val();

                            $('.ent-form .ent-inp').each(function(i, obj) {
                                var nn = i + 1;
                                $(this).find("#tempNumOfInput").val(nn);
                                $(this).find(".deleteItem").attr( 'datasn',nn);
                            });

                            
                            
                            
                            
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    // $(".ent-form").find(".dd").hover(function (e) {
                    //     e.preventDefault();

                    //     alert("yer");
                    //     try{
                    //         alert($(this).attr('datasn'));
                            
                    //     }
                    //     catch(err){
                    //         alert(err);
                    //     }
                    // });

                    $('.body').on('click', '.dd', function() {
                        alert("click");
                    });

                });//end ready

            </script> 

            <!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title">
                                    <?php echo "$page_title"; ?>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li><?php echo "$this->module"; ?></li>
                                    <li><?php echo "$page_title"; ?></li>
                                </ul>

                            </div>
                        </div>
                        <!--page title and breadcrumb end -->


                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($_SESSION['notification'])){

                                        echo $_SESSION['notification'];

                                    }
                                ?>
                                <section class="panel col-md-8 col-md-offset-2">
                                    
                                    <div class="panel-body">

                                         <!-- <div class="form-group col-xs-12">
                                            <label>Production Batch: <?php echo $_SESSION['cache_form_prod_batch']['id']; ?></label><br>
                                            <label>Production Batch Process: <?php echo $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->current_ass_process_id; ?></label>
                                            <?php 
                                                $bb_line = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;
                                                $cc_process = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->current_ass_process_id; 
                                                print_r($_SESSION['cache_form_prod_batch']);
                                                

                                            ?>
                                            <br>
                                            <label>Next Production Batch Process: <?php echo $this->site_model->get_biz_next_assigned_process($bb_line, $_SESSION['cache_form_prod_batch']['id'])->id; ?></label>
                                        </div> -->
                                        <?php
                                            // unset($_SESSION['cache_form_prod_batch']);
                                            if(!isset($_SESSION['cache_form_prod_batch']) OR empty($_SESSION['cache_form_prod_batch']['id'])){
                                                // create new
                                        ?>
                                            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="row dform" style="padding: 20px;">

                                                    <div class="form-group col-xs-12">
                                                        <label>Line of Business</label>
                                                        <select class="form-control s2" style='text-transform: capitalize;' name="business_line_id">
                                                            <?php
                                                                $list = $this->db->query("SELECT * FROM business_line ORDER BY id DESC");
                                                                foreach ($list->result() as $d) {
                                                                   echo "<option value='$d->id'>$d->name - $d->uq_id</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-xs-12">
                                                        <input type="submit" class="btn btn-primary" value="Submit" name="create_prod" />
                                                    </div>
                                                </div>
                                            
                                            </form>

                                        <?php
                                            }
                                            else{
                                                $biz_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->business_line_id;
                                        ?>
                                            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="row dform" style="padding: 20px;">

                                                    

                                                    <div class="form-group col-xs-12">
                                                        <label>Line of Business</label>
                                                        <input type="text" value="<?php echo $this->site_model->get_business_line($biz_id)->name; ?>" class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-xs-12">
                                                        <label>Production Code</label>
                                                        <input type="text" value="<?php echo $this->site_model->get_business_line($biz_id)->uq_id; ?>" class="form-control" readonly>
                                                    </div>

                                                </div>
                                            
                                            </form>
                                        <?php
                                            }
                                        ?>
                                        
                                    </div>
                                </section>

                                <div class="col-md-12">
                                    <section class="panel">
                                        <header class="panel-heading panel-border">
                                            Production Status
                                            <span class="tools pull-right">
                                                <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            </span>
                                        </header>
                                        <div class="panel-body">
                                            <?php

                                                $list = $this->db->query("SELECT * FROM assigned_process WHERE business_line_id='$biz_id' ORDER BY process_order ASC");
                                                $current_ass_process_id = $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->current_ass_process_id;
                                                foreach ($list->result() as $d) {

                                                    if($current_ass_process_id == $d->id){
                                                        $p_d = $_SESSION['cache_form_prod_batch']['id'];
                                                        $q1 = $this->db->query("SELECT * FROM prod_batch_process WHERE prod_batch_id='$p_d' AND assigned_process_id='$d->id' ORDER BY id DESC LIMIT 0,1");
                                                        if($q1->num_rows() > 0){
                                                            foreach ($q1->result() as $r1) {
                                                                if($r1->status == "pending"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-check-circle' style='color: grey; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Processing</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                elseif($r1->status == "awaiting" OR $r1->status == "processing" OR $r1->status == "approved"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-spinner' style='color: blue; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize; color: blue;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p style='text-transform: capitalize; color: blue;'><small>Processing</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                elseif($r1->status == "complete"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <i class='fa fa-check-circle' style='color: green; font-size: 30px;''></i>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Complete</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                else{

                                                                }
                                                            }
                                                        }
                                                        else{
                                                            echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-ellipsis-h' style='color: grey; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Un Processed</small></p>
                                                                        </div>
                                                                    </div>";
                                                        }

                                                    }
                                                    else{
                                                        $p_d = $_SESSION['cache_form_prod_batch']['id'];
                                                        $q1 = $this->db->query("SELECT * FROM prod_batch_process WHERE prod_batch_id='$p_d' AND assigned_process_id='$d->id' ORDER BY id DESC LIMIT 0,1");
                                                        if($q1->num_rows() > 0){
                                                            foreach ($q1->result() as $r1) {
                                                                if($r1->status == "pending"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-check-circle' style='color: grey; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Processing</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                elseif($r1->status == "awaiting" OR $r1->status == "processing" OR $r1->status == "approved"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-spinner' style='color: blue; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize; color: blue;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p style='text-transform: capitalize; color: blue;'><small>Processing</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                elseif($r1->status == "complete"){
                                                                    echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <i class='fa fa-check-circle' style='color: green; font-size: 30px;''></i>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Complete</small></p>
                                                                        </div>
                                                                    </div>";

                                                                }
                                                                else{

                                                                }
                                                            }
                                                        }
                                                        else{
                                                            echo "<div class='col-md-3'>
                                                                        <div class='text-center'>
                                                                            <p><i class='fa fa-ellipsis-h' style='color: grey; font-size: 30px;'></i></p>
                                                                            <p style='text-transform: capitalize;'>".$this->site_model->get_process($d->process_id)->name."</p>
                                                                            <p><small>Un Processed</small></p>
                                                                        </div>
                                                                    </div>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        
                                        </div>
                                    </section>
                                </div>

                                <div class="col-md-12">
                                    <section class="panel">
                                        <header class="panel-heading panel-border">
                                          <p>Process <?php echo $this->site_model->get_assigned_process($current_ass_process_id)->process_order; ?>:: <?php echo $this->site_model->get_process($this->site_model->get_assigned_process($current_ass_process_id)->process_id)->name; ?> </p>
                                        <span class="tools pull-right">
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                        </span>
                                        </header>
                                        <div class="panel-body">
                                            <?php 
                                                if(isset($_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'])){
                                                    $prod_batch_process_id = $_SESSION['cache_form_prod_batch']['last_prod_batch_process_id'];

                                            ?>
                                                <form class="pow" action="" method="POST">
                                                    <div class="col-md-3">
                                                        <div class="col-md-12" style="border: 1px solid #ccc;">
                                                            <div class="form-group">
                                                                <label>Number of Input Items</label>
                                                                <input type="number" name="num_of_input" class="form-control" value="<?php echo $this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_input; ?>" readonly>
                                                            </div>
                                                            <?php
                                                                if($this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_output == 0){
                                                            ?>
                                                                <div class="form-group">
                                                                    <label>Number of Output Items</label>
                                                                    <input type="number" name="num_of_output" class="form-control">
                                                                    <input type="hidden" name="assigned_process_id" class="form-control" value="<?php echo $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->current_ass_process_id; ?>">
                                                                    <input type="hidden" name="prod_batch_id" class="form-control" value="<?php echo $_SESSION['cache_form_prod_batch']['id']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="submit" name="reg_num_of_output" class="btn btn-primary form-control" value="Submit Number of OutPut Items" >
                                                                </div>

                                                            <?php

                                                                }
                                                                else{
                                                            ?>
                                                                <div class="form-group">
                                                                    <label>Number of Output Items</label>
                                                                    <input type="number" name="num_of_output" class="form-control" readonly value="<?php echo $this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_output; ?>">
                                                                    <input type="hidden" name="assigned_process_id" class="form-control" value="<?php echo $this->site_model->get_prod_batch($_SESSION['cache_form_prod_batch']['id'])->current_ass_process_id; ?>">
                                                                    <input type="hidden" name="prod_batch_id" class="form-control" value="<?php echo $_SESSION['cache_form_prod_batch']['id']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <!-- <input type="submit" name="reg_process" class="btn btn-primary form-control" value="Go" > -->
                                                                </div>
                                                            <?php
                                                                }
                                                            ?>
                                                             

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-md-12" style="border: 1px solid #ccc;">
                                                            <h5>Process Status</h5>
                                                            <?php
                                                                if($this->site_model->get_prod_batch_process($prod_batch_process_id)->status == "pending"){
                                                                   echo "<p><label class='label label-default'>No Item Selected</label></p>";
                                                                }
                                                                elseif($this->site_model->get_prod_batch_process($prod_batch_process_id)->status == "awaiting"){
                                                                    echo "<p><label class='label label-danger'>Awaiting Items Approval</label></p>";
                                                                }
                                                                elseif($this->site_model->get_prod_batch_process($prod_batch_process_id)->status == "approved"){
                                                                    echo "<p><label class='label label-primary'>Processing</label></p>";
                                                                }
                                                                elseif($this->site_model->get_prod_batch_process($prod_batch_process_id)->status == "complete"){
                                                                    echo "<p><label class='label label-success'>Process Complete</label></p>";
                                                                }
                                                                else{
                                                                   echo "<p><label class='label label-primary'>No Item Selected</label></p>"; 
                                                                }
                                                            ?>                                                            
                                                        </div>
                                                    </div>
                                               </form>

                                            <?php
                                                }
                                                else{
                                                }
                                            ?>
                                                


                                                <form class="pow form-horizontal" action="" method="POST">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12" style="border: 1px solid #ccc; margin-top: 10px;">
                                                            <h5>Input items</h5>
                                                            <div class="col-md-12">
                                                                <!-- select last output -->
                                                                <div class="row dform ent-form" style="padding: 20px;">
                                                                    <?php
                                                                        $n = $this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_input;
                                                                        $sn = 1;
                                                                        $last_prod_batch_process_id = $this->site_model->get_last_prod_batch_process($_SESSION['cache_form_prod_batch']['id'], $prod_batch_process_id)->id;

                                                                        // echo $last_prod_batch_process_id;

                                                                        $pb_id =$_SESSION['cache_form_prod_batch']['id'];
                                                                        $last_out = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_process_id='$last_prod_batch_process_id' AND prod_batch_id='$pb_id'");
                                                                        if($last_out->num_rows() > 0){
                                                                            foreach ($last_out->result() as $lo) {
                                                                            
                                                                            
                                                                    ?>
                                                                        <div class="form-group ent-inp">
                                                                            <div class="col-md-2">
                                                                                <label>S/N</label>
                                                                                <input class="form-control" type="text" name="sn[]" value="<?php echo $sn;?>" readonly>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                               <label>Item name</label>
                                                                            <input class="form-control" type="text" name="item[]" value="<?php echo $lo->item;?>" readonly>
                                                                               
                                                                            </div>
                                                                            
                                                                            <div class="col-md-3">
                                                                                <label>Enter Quantity</label>
                                                                                <input class="form-control" type="number" name="quantity[]" value="<?php echo $lo->quantity;?>" readonly>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <label>Unit</label>
                                                                                <input class="form-control" type="text" name="unit[]" value="<?php echo $lo->unit;?>" readonly>
                                                                            </div>

                                                                            <!-- <div class="col-md-1">
                                                                                <label>Remove</label>
                                                                                <button class="btn btn-danger btn-sm form-control deleteItem dd" datasn=''><i class="fa fa-trash"></i> Delete</button>
                                                                            </div> -->
                                                                            
                                                                        </div>
                                                                    <?php
                                                                            $sn++;
                                                                            }
                                                                        }
                                                                    ?>

                                                                    <!-- <div id="putNewEntry"></div> -->
                                                                    
                                                                </div>

                                                                
                                                                    <p>
                                                                        <!-- <input class="btn btn-primary form-control" type="submit" name="reg_items" value="Submit for Approval"> -->
                                                                    </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                            <?php
                                                if($this->site_model->get_prod_batch_process($prod_batch_process_id)->status == "approved"){
                                                    if($this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_output != 0){
                                                
                                            ?>
                                                   <form class="pow form-horizontal" action="" method="POST">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12" style="border: 1px solid #ccc; margin-top: 10px;">
                                                                <h5>Enter the Output items</h5>
                                                                <div class="col-md-12">
                                                                    <div class="row dform ent-form" style="padding: 20px;">
                                                                        <?php
                                                                            $n = $this->site_model->get_prod_batch_process($prod_batch_process_id)->num_of_output;
                                                                            $sn = 1;
                                                                            for($c=0;$c<$n;$c++){
                                                                                
                                                                        ?>
                                                                            <div class="form-group ent-inp">
                                                                                <div class="col-md-2">
                                                                                    <label>S/N</label>
                                                                                    <input class="form-control" type="text" name="sn[]" value="<?php echo $sn;?>" readonly>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                   <label>Output Item</label>
                                                                                   <input class="form-control" type="text" name="item[]">
                                                                                </div>
                                                                                
                                                                                <div class="col-md-3">
                                                                                    <label>Enter Quantity</label>
                                                                                    <input class="form-control" type="number" name="quantity[]">
                                                                                </div>

                                                                                <div class="col-md-3">
                                                                                    <label>Enter Unit</label>
                                                                                    <input class="form-control" type="text" name="unit[]">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        <?php
                                                                                $sn++;
                                                                            }
                                                                        ?>
                                                                        <p>Record Defects</p>
                                                                        <div class="form-group ent-inp">
                                                                                

                                                                                <div class="col-md-4">
                                                                                   <label>Defects Quantity</label>
                                                                                   <input class="form-control" type="number" name="defect_qty">
                                                                                </div>
                                                                                
                                                                                <div class="col-md-3">
                                                                                    <label>Unit</label>
                                                                                    <input class="form-control" type="unit" name="defect_unit">
                                                                                </div>
                                                                                
                                                                            </div>

                                                                        <!-- <div id="putNewEntry"></div> -->
                                                                        
                                                                    </div>
              
                                                                    <!-- <button class="btn btn-info addOutItem">Add One more Item</button> -->
                                                                    <p></p>
                                                                    
                                                                        <p>
                                                                            <?php
                                                                                if($this->site_model->get_biz_next_assigned_process($bb_line, $_SESSION['cache_form_prod_batch']['id'])->id == null){
                                                                                    echo "<input class='btn btn-primary form-control' type='submit' name='finish_prod' value='Finish Production Batch'>";
                                                                                }
                                                                                else{
                                                                                    echo "<input class='btn btn-primary form-control' type='submit' name='reg_output_items' value='Goto Next Process'>";
                                                                                }

                                                                            ?>
                                                                            
                                                                        </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   </form>

                                            <?php
                                                    }
                                                    else{
                                            ?>

                                                    <form class="pow form-horizontal" action="" method="POST">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12" style="border: 1px solid #ccc; margin-top: 10px;">
                                                                    <h5>Enter number of Output items above</h5>
                                                                    
                                                                </div>
                                                            </div>
                                                    </form>


                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--main content end-->


            <div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <div class="c-in">
                                <div class="form-group ent-inp">
                                    <div class="col-md-2">
                                        <label>S/N</label>
                                        <input class="form-control" id="tempNumOfInput" type="text" name="sn[]" value="<?php echo $sn;?>">
                                    </div>

                                    <div class="col-md-6">
                                       <label>Select Item</label>
                                       <select class="form-control" name="item_id[]">
                                       <?php
                                            $s1 = $this->db->query("SELECT * FROM store_items ORDER BY id DESC");
                                            if($s1->num_rows() > 0){
                                                 foreach ($s1->result() as $r1) {
                                                    $left = $r1->quantity - ($this->site_model->calc_prod_input_items_qty($r1->id));
                                                    echo "<option value='$r1->id'>$r1->item_name :: $left $r1->unit Left </option>";
                                                 }
                                             }
                                        ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label>Enter Quantity</label>
                                        <input class="form-control" type="number" name="quantity[]" />
                                    </div>

                                    <!-- <div class="col-md-1">
                                        <label>Remove</label>
                                        <span class="btn btn-danger btn-sm form-control deleteItem dd"><i class="fa fa-trash"></i> Delete</span>
                                    </div> -->
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="supplier_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_supplier" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>



