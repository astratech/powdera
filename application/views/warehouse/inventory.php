            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='c_id']").val(d.id);
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

                            $("#edit-modal [name='c_id']").val(d.id);
                            $("#edit-modal [name='name']").val(d.name);
                            $("#edit-modal [name='uq_id']").val(d.uq_id);
                            $("#edit-modal [name='quantity']").val(d.quantity);
                            $("#edit-modal [name='unit']").val(d.unit);
                            $("#edit-modal [name='location']").val(d.location);
                            $("#edit-modal [name='value']").val(d.value);
                            $("#edit-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    $(".write-off").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#write-off-modal [name='material_id']").val(d.id);
                            $("#write-off-modal [name='uq_id']").val(d.uq_id);
                            $("#write-off-modal [name='supplier_name']").val(d.supplier_name);
                            $("#write-off-modal [name='supplier_id']").val(d.supplier_id);
                            $("#write-off-modal [name='qty_in_store']").val(d.qty_in_store);
                            $("#write-off-modal").modal("show");
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
                                        List of External Products
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Add new item</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity In Stock</th>
                                                    <th>Quantity Out</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM warehouse_ex_prod ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>$r->name</td>";
                                                        echo "<td>$r->quantity $r->unit</td>";

                                                        $left = $r->quantity - ($this->site_model->calc_ex_prod_qty_sold($r->id));
                                                        $r->qty_in_store = $left;
                                                        echo "<td>$left $r->unit</td>";

                                                                                                            
                                                        echo "<td>".date("d-M-Y", strtotime($r->date_created))."</td>";

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
                            <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group col-xs-12">
                                    <label>Product Code</label>
                                    <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('POW'); ?>" readonly>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="name" required="required" >
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Unit</label>
                                        <select class="form-control s2" name="unit">
                                           <?php
                                                $list = $this->db->query("SELECT * FROM quantity_units ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->name'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                   
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="location">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Value</label>
                                        <input type="text" class="form-control" name="value">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create" />
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
                                    <label>Product Code</label>
                                    <input type="text" class="form-control" name="uq_id" required readonly>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="name" required="required" >
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Unit</label>
                                        <select class="form-control s2" name="unit">
                                           <?php
                                                $list = $this->db->query("SELECT * FROM quantity_units ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->name'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                   
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="location">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Value</label>
                                        <input type="text" class="form-control" name="value">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="c_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="write-off-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Write Off</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                   <div class="form-group col-xs-12">
                                        <label>Item Code</label>
                                        <input type="text" class="form-control" name="uq_id" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Supplier</label>
                                        <input type="text" class="form-control" name="supplier_name" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity In Store</label>
                                        <input type="text" class="form-control" name="qty_in_store" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity to Write Off</label>
                                        <input type="number" class="form-control" name="qty_to_writeoff">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Reason For Write off</label>
                                        <textarea class="form-control" name="reason"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="c_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="write_off" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="c_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

