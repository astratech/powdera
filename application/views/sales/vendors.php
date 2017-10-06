            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='vendor_id']").val(d.id);
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

                            $("#edit-modal [name='vendor_id']").val(d.id);
                            $("#edit-modal [name='company_name']").val(d.company_name);
                            $("#edit-modal [name='rep_name']").val(d.rep_name);
                            $("#edit-modal [name='rep_email']").val(d.rep_email);
                            $("#edit-modal [name='rep_mobile']").val(d.rep_mobile);
                            $("#edit-modal [name='category']").val(d.category);
                            $("#edit-modal [name='address']").val(d.address);
                            $("#edit-modal [name='location']").val(d.location);
                            $("#edit-modal [name='address']").val(d.address);
                            $("#edit-modal [name='account_number']").val(d.account_number);
                            $("#edit-modal [name='bank_name']").val(d.bank_name);
                            $("#edit-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });


                    $(".shwItemModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#item-modal [name='vendor_id']").val(d.id);
                            $("#item-modal [name='uq_id']").val(d.uq_id);
                            $("#item-modal").modal("show");
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
                                        Vendor Management
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Vendor</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Company Name</th>
                                                    <th>Company Rep Details</th>
                                                    <th>Vendor ID</th>
                                                    <th>Vendor Category</th>
                                                    <th>Mailing Address</th>
                                                    <th>Location</th>
                                                    <th>Supply Items</th>
                                                    <th>Vendor Bank Details</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM vendors ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->company_name</td>";

                                                        echo "<td>";
                                                        echo "<p>$r->rep_name</p>";
                                                        echo "<p style='text-transform: lowercase;'>$r->rep_email</p>";
                                                        echo "<p>$r->rep_mobile</p>";
                                                        echo "</td>";

                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>$r->category</td>";
                                                        echo "<td>$r->address</td>";
                                                        echo "<td>$r->location</td>";

                                                        echo "<td>";
                                                        $st = $this->db->query("SELECT * FROM vendor_items WHERE vendor_id='$r->id' ORDER BY id DESC");
                                                        foreach ($st->result() as $i) {
                                                            echo "<p>$i->item</p>";

                                                        }
                                                        echo "<button class='btn btn-primary btn-xs shwItemModal' data-all='".json_encode($r)."' ><i class='fa fa-plus'></i> Add Item </button>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<p>$r->bank_name</p>";
                                                        echo "<p>$r->account_number</p>";
                                                        echo "</td>";

                                                        echo "<td>".date("d / M / Y H:i:s", strtotime($r->date_created))."</td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary shwEditModal' data-all='".json_encode($r)."' ><i class='fa fa-pencil'></i> Edit </button>";
                                                        echo " <button class='btn btn-danger shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-trash'></i> Delete</button>";
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
                            <h4 class="modal-title" id="myModalLabel">Create New Vendor</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">

                                    <div class="form-group col-xs-12">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="company_name" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Name</label>
                                        <input type="text" class="form-control" name="rep_name" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Email</label>
                                        <input type="email" class="form-control" name="rep_email" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Mobile</label>
                                        <input type="number" class="form-control" name="rep_mobile" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Vendor ID</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id("VND"); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="category" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required="required"></textarea>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="location" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Account Number</label>
                                         <input type="number" class="form-control" name="account_number" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Bank Name</label>
                                         <input type="text" class="form-control" name="bank_name" required="required">
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_vendor" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Vendor</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-xs-12">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="company_name" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Name</label>
                                        <input type="text" class="form-control" name="rep_name" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Email</label>
                                        <input type="email" class="form-control" name="rep_email" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Company Rep Mobile</label>
                                        <input type="number" class="form-control" name="rep_mobile" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="category" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required="required"></textarea>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="location" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Account Number</label>
                                         <input type="number" class="form-control" name="account_number" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" required="required">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="vendor_id" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_vendor" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Vendor</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            <input type="hidden" name="vendor_id" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_vendor" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Item</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">
                                <div class="form-group col-xs-12">
                                    <label>Vendor ID</label>
                                    <input type="text" class="form-control" name="uq_id" required="required" readonly="readonly">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="item_name" required="required">
                                </div>
                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="vendor_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Add Item" name="add_item" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

