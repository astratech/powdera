            
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

                                    // $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                    // foreach ($list->field_data() as $d) {
                                    //     echo $d->name;
                                    // }
                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        List of Incoming Materials
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Add new item</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Item Code</th>
                                                    <th>Supplier</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity Supplied</th>
                                                    <th>Unit</th>
                                                    <th>Quantity In Store</th>
                                                    <th>Date Supplied</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM store_items ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";

                                                        echo "<td>";
                                                        echo "<p>".$this->site_model->get_supplier($r->supplier_id)->name."</p>";
                                                        echo "<p>".$this->site_model->get_supplier($r->supplier_id)->category."</p>";
                                                        echo "</td>";

                                                        echo "<td>$r->item_name</td>";
                                                        echo "<td>$r->quantity</td>";
                                                        echo "<td>$r->unit</td>";
                                                        $left = $r->quantity - ($this->site_model->calc_prod_input_items_qty($r->id));
                                                        echo "<td>$left</td>";

                                                        echo "<td>$r->date_supplied</td>";
                                                                                                            
                                                        echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary btn-sm shwEditModal' data-all='".json_encode($r)."' ><i class='fa fa-pencil'></i> Edit </button>";
                                                        echo " <button class='btn btn-danger btn-sm shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-trash'></i> Delete</button>";
                                                        echo "</td>";
                                                        echo "</tr>";

                                                        $sn++;   
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
                                                   echo "<option value='$d->id'>$d->name - $d->uq_id - $d->category </option>";
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
                            <h4 class="modal-title" id="myModalLabel">Edit Material</h4>
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
                                                   echo "<option value='$d->id'>$d->name :: $d->uq_id - $d->category </option>";
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
                            <input type="hidden" name="material_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_material" />
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

