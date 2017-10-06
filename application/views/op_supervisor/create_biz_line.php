            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='material_id']").val(d.id);
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

                            $("#edit-modal [name='material_id']").val(d.id);
                            $("#edit-modal [name='name']").val(d.item_name);
                            $("#edit-modal [name='staff_id']").val(d.staff_id);
                            $("#edit-modal [name='supplier_id']").val(d.supplier_id);
                            $("#edit-modal [name='uq_id']").val(d.uq_id);
                            $("#edit-modal [name='quantity']").val(d.quantity);
                            $("#edit-modal [name='date_supplied']").val(d.date_supplied);
                            $("#edit-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
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
                            <div class="col-md-6 col-md-offset-3">

                                <?php 
                                    if(isset($_SESSION['notification'])){

                                        echo $_SESSION['notification'];

                                    }
                                ?>
                                <section class="panel">
                                    
                                    <div class="panel-body">
                                        <script type="text/javascript">
                                            $(function() {
                                                $(".sss").select2({
                                                     placeholder: "",
                                                 });
                                            });
                                        </script>

                                        <style type="text/css">
                                            .pow input{
                                                margin-bottom: 0px;
                                            }
                                        </style>
                                        <?php
                                            if(!isset($_SESSION['cache_form_biz']) OR empty($_SESSION['cache_form_biz']['name'])){
                                                // create new
                                        ?>
                                            <div class="col-md-12">
                                                <form class="form-horizontal pow" action="" method="POST">
                                                     <div class="form-group">
                                                        <label>Name of Business</label>
                                                        <input type="text" name="name" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Input Number of Processes</label>
                                                        <input type="number" name="num_of_process" class="form-control">
                                                    </div>

                                                   <div class="form-group">
                                                       <input type="submit" name="create_biz" class="btn btn-primary" value="Proceed">
                                                   </div>
                                               </form>
                                            </div>
                                        <?php
                                            }
                                            else{
                                                // proceed
                                        ?>
                                            <div class="col-md-12">

                                                <form class="form-horizontal pow" action="" method="POST">
                                                     <div class="form-group">
                                                        <label>Name of Business</label>
                                                        <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['cache_form_biz']['name']?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Input Number of Processes</label>
                                                        <input type="number" name="num_of_process" value="<?php echo $_SESSION['cache_form_biz']['num_of_process']?>" class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Business Code</label>
                                                        <input type="text" name="uq_id" class="form-control" value="<?php echo $_SESSION['cache_form_biz']['uq_id']?>" readonly>
                                                    </div>

                                               </form>
                                               <div class='alert alert-callout alert-info alert-dismissable' role='alert'>
                                                    <strong>Select the Processes to continue. </strong> 
                                                </div>
                                            </div>

                                        <?php
                                            }
                                        ?>
                                        
                                    </div>
                                </section>
                            </div>

                            <?php
                                if(isset($_SESSION['cache_form_biz']) OR !empty($_SESSION['cache_form_biz']['name'])){
                            ?>
                                            
                            <div class="col-md-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                      <p>Input the Processes</p>
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body">
                                        <form action="" method="POST">
                                            <?php
                                                $num_of_process = $_SESSION['cache_form_biz']['num_of_process'];
                                                for ($i=1; $i<=$num_of_process ; $i++) { 
                                                    $post_name = "p"."$i";
                                                    // echo "$post_name";
                                            ?>

                                                <div class="col-md-3">
                                                    <div class="col-md-12" style="border: 1px solid #ccc; margin-bottom: 10px;">                                                        
                                                        <div class="form-group">
                                                            <label>Select Process <?php echo $i; ?></label>
                                                            <select class="form-control s2" style='text-transform: capitalize;' name="<?php echo $i; ?>">
                                                                <?php
                                                                    $list = $this->db->query("SELECT * FROM process ORDER BY id DESC");
                                                                    foreach ($list->result() as $d) {
                                                                       echo "<option value='$d->id'>$d->name</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                       
                                                    </div>
                                                </div>

                                            <?php
                                                }
                                            ?>
                                            


                                            <div class="col-md-12" style="margin-top: 10px;">
                                                <div class="form-group pull-left">
                                                    <input type="submit" name="final_biz" class="btn btn-primary" value="Submit">
                                                </div>

                                                <div class="form-group pull-right">
                                                    <input type="submit" name="cancel_biz" class="btn btn-danger" value="Cancel">
                                                </div>
                                            </div>
                                       </form>
                                    </div>
                                </section>
                            </div>
                            <?php

                                }
                            ?>

                           
                        </div>
                    </div>
                    </div>

                </div>
            </div>
            <!--main content end-->


            <div class="modal fade" id="c-form-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Item</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">

                                    <div class="form-group col-xs-12">
                                        <label>Item Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('MTR'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Supplier</label>
                                        <select class="form-control s2" name="supplier_id">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->name :: $d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="name" required="required" value="<?php echo isset($_SESSION['cache_form']['name']) ? $_SESSION['cache_form']['name'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity Supplied</label>
                                        <input type="number" class="form-control" name="quantity" required="required" value="<?php echo isset($_SESSION['cache_form']['quantity']) ? $_SESSION['cache_form']['quantity'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Date Supplied</label>
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_supplied">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Store Keeper</label>
                                        <select class="form-control s2" name="staff_id">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM staffs WHERE dept_id='1' ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->title $d->fullname :: $d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_materials" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Supplier</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                   <div class="form-group col-xs-12">
                                        <label>Item Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('MTR'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Supplier</label>
                                        <select class="form-control s2" name="supplier_id">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->name :: $d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="name" required="required" >
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity Supplied</label>
                                        <input type="number" class="form-control" name="quantity" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Date Supplied</label>
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_supplied">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Store Keeper</label>
                                        <select class="form-control s2" name="staff_id">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM staffs WHERE dept_id='1' ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->title $d->fullname :: $d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="supplier_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_supplier" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Material</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="material_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_material" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

