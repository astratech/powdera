            
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
                                        echo $business_line_id;

                                    }
                                ?>
                                 <section class="panel col-md-8 col-md-offset-2">
                                    
                                    <div class="panel-body">
                                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="row dform" style="padding: 20px;">

                                                <?php
                                                    $list = $this->db->query("SELECT * FROM assigned_process WHERE business_line_id='$business_line_id' ORDER BY process_order ASC");
                                                    $ass = [];
                                                    $ord = [];
                                                    foreach ($list->result() as $d) {
                                                        
                                                 ?>


                                                <div class="form-group">
                                                    <div class="col-xs-6">
                                                       <label>Process</label>
                                                       <input type="text" name="" class="form-control" value="<?php echo $this->site_model->get_process($d->process_id)->name; ?>" readonly>
                                                       <input type="hidden" name="ass_id[]" class="form-control" value="<?php echo $d->id; ?>" readonly>
                                                    </div>
                                                    
                                                    <div class="col-xs-6">
                                                        <label>Order</label>
                                                        <select class="form-control s2" style='text-transform: capitalize;' name="ord_id[]">
                                                            <?php
                                                                echo "<option value='$d->process_order'>$d->process_order</option>";
                                                                echo "<option>-------------</option>";
                                                                echo "<option></option>";
                                                                $num_of_process = $this->site_model->get_business_line($business_line_id)->num_of_process;
                                                                for($i=1; $i<=$num_of_process; $i++) {
                                                                   echo "<option value='$i'>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </select>
                                                    </div>
                                                    
                                                    
                                                </div>

                                                <?php
                                                    }
                                                ?>

                                                <div class="form-group col-xs-12">
                                                    <input type="submit" class="btn btn-primary" value="Submit" name="change_order" />
                                                </div>
                                            </div>
                                        
                                        </form>
                                    </div>
                                </section>
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
                            <h4 class="modal-title" id="myModalLabel">Create New Supplier</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">

                                    <div class="form-group col-xs-12">
                                        <label>Supplier Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('SPR'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required" value="<?php echo isset($_SESSION['cache_form']['name']) ? $_SESSION['cache_form']['name'] : '' ?>">
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_supplier" />
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
                                        <label>Supplier Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required">
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
                            <h4 class="modal-title" id="myModalLabel">Delete Supplier</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
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

