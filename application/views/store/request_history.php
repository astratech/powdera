            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='prod_batch_process_id']").val(d.prod_batch_process_id);
                            $("#app-modal input[name='prod_batch_id']").val(d.prod_batch_id);


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
                            $("#edit-modal [name='unit']").val(d.unit);
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
                            <div class="col-md-12">
                                <?php 
                                    if(isset($_SESSION['notification'])){

                                        echo $_SESSION['notification'];

                                    }

                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        List of Item Requests
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>

                                     <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    
                                                    <th>Production Batch</th>
                                                    <th>Production Process</th>
                                                    <th>Request Date</th>
                                                    <th>Requestor</th>
                                                    <th>Items Requested</th>
                                                    <th>Approver</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $prod_batch_process = $this->db->query("SELECT * FROM prod_batch_process WHERE status!='awaiting' ORDER BY id DESC");
                                                    foreach ($prod_batch_process ->result() as $pdp) {
                                                        $input_items = $this->db->query("SELECT * FROM prod_input_items WHERE prod_batch_process_id='$pdp->id' AND prod_batch_id='$pdp->prod_batch_id' ORDER BY id DESC");
                                                        if($input_items->num_rows() > 0){
                                                            $d['prod_batch_process_id'] = $pdp->id;
                                                            $d['prod_batch_id'] = $pdp->prod_batch_id;

                                                            echo "<tr style='text-transform: capitalize;'>";
                                                            echo "<td>".$this->site_model->get_prod_batch($pdp->prod_batch_id)->uq_id."</td>";
                                                            echo "<td>".$this->site_model->get_process($this->site_model->get_assigned_process($pdp->assigned_process_id)->process_id)->name."</td>";
                                                            echo "<td>$pdp->date_created</td>";
                                                            echo "<td>".$this->site_model->get_staff($pdp->staff_id)->fullname."</td>";

                                                            echo "<td>";
                                                            $input_items = $this->db->query("SELECT * FROM prod_input_items WHERE prod_batch_process_id='$pdp->id' AND prod_batch_id='$pdp->prod_batch_id' ORDER BY id DESC");
                                                            foreach ($input_items ->result() as $ii) {
                                                                echo "<p>".$this->site_model->get_store_item($ii->store_item_id)->item_name." - ".$ii->quantity." ".$this->site_model->get_store_item($ii->store_item_id)->unit."</p>";
                                                            }
                                                            echo "</td>";

                                                            echo "<td>".$this->site_model->get_staff($pdp->approver_staff_id)->fullname."</td>";
                                                            
                                                            echo "</tr>";
                                                        }
                                                    }
                                                        
                                                ?>

                                            </tbody>
                                        </table>
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
                                        <label>unit</label>
                                        <select class="form-control s2" name="unit">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM quantity_units ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->name'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
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
                                        <label>unit</label>
                                        <select class="form-control s2" name="unit">
                                           <?php
                                           $list = $this->db->query("SELECT * FROM quantity_units ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->name'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
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
                            <h4 class="modal-title" id="myModalLabel">Approve Production Materials</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="prod_batch_id" value="" />
                            <input type="hidden" name="prod_batch_process_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="approve_items" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

