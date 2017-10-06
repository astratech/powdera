            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='product_name']").val(d.product_name);
                            $("#app-modal input[name='sales_product_id']").val(d.id);
                            $("#app-modal input[name='quantity_available']").val(d.quantity_available);
                            $("#app-modal input[name='price']").val(d.price);
                            $("#app-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    $("#app-modal input[name='quantity']").keyup(function (e) {
                        e.preventDefault();
                        try{
                            $q = $(this).val();

                            if($q < 0){
                                $q = 0;
                            }


                            $q = parseInt($q);

                            
                            $qa = $("#app-modal input[name='quantity_available']").val();
                            $qa = parseInt($qa);

                            if($q > $qa){
                                $q = 0;
                                $(this).val("0")
                            }

                            $amount = $("#app-modal input[name='price']").val() * $q;

                            $("#app-modal input[name='amount']").val($amount);
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

                    $(".shwItemModal").click(function (e) {
                        e.preventDefault();
                        try{
                            // var d = $(this).data('all');
                            var d = $(".getLoop").data('all');

                            // alert(JSON.stringify(d));
                            // alert(d.name);

                            $.each(d, function(i, e) {
                               alert('name='+ i + ' value=' +e.id);
                            });

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
                            <div class="col-sm-12">
                                <?php 
                                    if(isset($_SESSION['notification'])){

                                        echo $_SESSION['notification'];

                                    }
                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Products Catalog
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <table class="table convert-data-table table-striped table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Product Code</th>
                                                    <th>Product</th>
                                                    <th>Quantity Available</th>
                                                    <th>Price Per Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">
                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM sales_product ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                        $r->quantity_available = ($r->quantity - $this->site_model->calc_req_sale_qty($r->id));
                                                        if($r->quantity_available > 0){
                                                            echo "<tr style='text-transform: capitalize;'>";

                                                            echo "<td>$sn</td>";
                                                            echo "<td>$r->uq_id</td>";
                                                            $r->product_name = $this->site_model->get_prod_output_item($r->prod_output_item_id)->item;
                                                            $r->quantity_available = ($r->quantity - $this->site_model->calc_req_sale_qty($r->id));
                                                            
                                                            echo "<td>".$this->site_model->get_prod_output_item($r->prod_output_item_id)->item."</td>";
                                                            echo "<td>".($r->quantity - $this->site_model->calc_req_sale_qty($r->id))." $r->unit</td>";
                                                            echo "<td>$r->price</td>";
                                                            echo "<td><button class='btn btn-info btn-sm shwAppModal btn-link' data-all='".json_encode($r)."'> Request Product</button></td>";
                                                            echo "</tr>";
                                                        }

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


            <div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Request Product</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-xs-12">
                                        <label>Product</label>
                                        <input type="text" class="form-control" name="product_name" value="" readonly>
                                        <input type="hidden" class="form-control" name="sales_product_id" required="required" value="" readonly>
                                        <input type="hidden" class="form-control" name="price" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity Available</label>
                                        <input type="number" class="form-control" name="quantity_available" required="required" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount" required="required" readonly>
                                    </div>
                                    
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="business_line_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="req_product" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
