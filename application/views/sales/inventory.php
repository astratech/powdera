            
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
                                        List of Products
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Add New Product</button></p>
                                        <!-- <p><button class="btn btn-primary shwCreateForm">Create New Query</button></p> -->
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity In Stock</th>
                                                    <th>Quantity Available</th>
                                                    <th>CEO Approval</th>
                                                    <th>WareHouse Approval</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM sales_product ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       
                                                        $r->quantity_available = ($r->quantity - $this->site_model->calc_req_sale_qty($r->id));
                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>".$this->site_model->get_prod_output_item($r->prod_output_item_id)->item."</td>";

                                                        echo "<td>$r->price</td>";
                                                        echo "<td>$r->quantity $r->unit</td>";
                                                        echo "<td>$r->quantity_available $r->unit</td>"; 

                                                        if($r->ceo_approved == 1){
                                                            echo "<td>APPROVED</td>";
                                                        }
                                                        else{
                                                            echo "<td></td>";
                                                        }  

                                                        if($r->warehouse_approved == 1){
                                                            echo "<td>APPROVED</td>";
                                                        }
                                                        else{
                                                            echo "<td></td>";
                                                        }                                                                                                           
                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        // echo "<button class='btn btn-primary btn-sm shwEditModal' data-all='".json_encode($r)."' ><i class='fa fa-pencil'></i> Edit </button>";
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
                                        <label>Product</label>
                                        <select class="form-control s2" name="prod_output_item_id">
                                            <?php
                                                $list = $this->db->query("SELECT * FROM prod_batch WHERE is_approved='1' ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                    $av = ($this->site_model->get_prod_batch_output($d->id)->quantity) - ($this->site_model->calc_pd_sales_prod_qty($this->site_model->get_prod_batch_output($d->id)->id));
                                                   
                                                   echo "<option value='".$this->site_model->get_prod_batch_output($d->id)->id."'>".$this->site_model->get_prod_batch_output($d->id)->item." - $av ".$this->site_model->get_prod_batch_output($d->id)->unit." Available.</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="quantity" required="required" value="<?php echo isset($_SESSION['cache_form']['city']) ? $_SESSION['cache_form']['city'] : '' ?>">
                                        </div>

                                        <div class="col-xs-6">
                                            <label>Unit</label>
                                            <input type="text" class="form-control" name="unit" required="required">
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label>Price</label>
                                            <input type="number" class="form-control" name="price" required="required" value="<?php echo isset($_SESSION['cache_form']['city']) ? $_SESSION['cache_form']['city'] : '' ?>">
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="add_product" />
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

