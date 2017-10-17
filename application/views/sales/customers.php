            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='customer_id']").val(d.id);
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

                            $("#edit-modal [name='customer_id']").val(d.id);
                            $("#edit-modal [name='name']").val(d.name);
                            $("#edit-modal [name='email']").val(d.email);
                            $("#edit-modal [name='mobile']").val(d.mobile);
                            $("#edit-modal [name='address']").val(d.address);
                            $("#edit-modal [name='city']").val(d.city);
                            $("#edit-modal [name='state']").val(d.state);
                            $("#edit-modal [name='uq_id']").val(d.uq_id);
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
                                        List of Customers
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Customer</button></p>
                                        <!-- <p><button class="btn btn-primary shwCreateForm">Create New Query</button></p> -->
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Mail Address</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Sales Personnel</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM customers ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>$r->name</td>";
                                                        echo "<td style='text-transform: lowercase;'>$r->email</td>";
                                                        echo "<td>$r->mobile</td>";                                                        
                                                        echo "<td>$r->address</td>";                                                        
                                                        echo "<td>$r->city</td>";                                                        
                                                        echo "<td>$r->state</td>"; 

                                                        echo "<td>".$this->site_model->get_record("staffs", $r->staff_id)->uq_id."</td>";                                                        
                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";

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
                            <h4 class="modal-title" id="myModalLabel">Create New Customer</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">

                                    <div class="form-group col-xs-12">
                                        <label>Customer ID</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('CTM'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required" value="<?php echo isset($_SESSION['cache_form']['name']) ? $_SESSION['cache_form']['name'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" required="required" value="<?php echo $this->site_model->gen_token(); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required="required" value="<?php echo isset($_SESSION['cache_form']['email']) ? $_SESSION['cache_form']['email'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" name="mobile" required="required" value="<?php echo isset($_SESSION['cache_form']['mobile']) ? $_SESSION['cache_form']['mobile'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <div class="col-xs-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" required="required" value="<?php echo isset($_SESSION['cache_form']['city']) ? $_SESSION['cache_form']['city'] : '' ?>">
                                        </div>

                                        <div class="col-xs-6">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" required="required" value="<?php echo isset($_SESSION['cache_form']['state']) ? $_SESSION['cache_form']['state'] : '' ?>">
                                        </div>
                                        
                                    </div>




                                    <div class="form-group col-xs-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required="required"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_customer" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Salary</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-xs-12">
                                        <label>Customer ID</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('CTM'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required" value="<?php echo isset($_SESSION['cache_form']['name']) ? $_SESSION['cache_form']['name'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required="required" value="<?php echo isset($_SESSION['cache_form']['email']) ? $_SESSION['cache_form']['email'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" name="mobile" required="required" value="<?php echo isset($_SESSION['cache_form']['mobile']) ? $_SESSION['cache_form']['mobile'] : '' ?>">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <div class="col-xs-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" required="required" value="<?php echo isset($_SESSION['cache_form']['city']) ? $_SESSION['cache_form']['city'] : '' ?>">
                                        </div>

                                        <div class="col-xs-6">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" required="required" value="<?php echo isset($_SESSION['cache_form']['state']) ? $_SESSION['cache_form']['state'] : '' ?>">
                                        </div>
                                        
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required="required"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="customer_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_customer" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="customer_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_customer" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

