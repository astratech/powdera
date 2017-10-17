            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='request_id']").val(d.uq_id);
                            $("#app-modal input[name='sales_product_id']").val(d.sales_product_id);
                            $("#app-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });

                    $(".shwDecModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#rej-modal input[name='request_id']").val(d.id);
                            $("#rej-modal").modal("show");
                        }
                        catch(err){
                            alert(err);
                        }
                    });
                    ''
                    $(".c-n-q").click(function (e) {
                        e.preventDefault();
                        $("#c-form-modal").modal("show");
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
                                        Pending Customer Requests
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <table class="table convert-data-table table-striped table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Request Code</th>
                                                    <th>Customer Details</th>
                                                    <th>Product Details</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Sales Personnel</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">
                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM customer_requests WHERE status!='delivered' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>".$this->site_model->get_customer($r->customer_id)->name."</td>";
                                                        echo "<td>".$this->site_model->get_prod_output_item($this->site_model->get_sales_product($r->sales_product_id)->prod_output_item_id)->item."</td>";
                                                        echo "<td>$r->quantity</td>";
                                                        echo "<td>$r->amount</td>";
                                                        echo "<td>";
                                                        echo "<p>$r->status <br></p>";
                                                        echo "<button class='btn btn-primary btn-sm shwAppModal btn-link' data-all='".json_encode($r)."'> Change Status</button>";
                                                        echo "</td>";

                                                        echo "<td>".$this->site_model->get_record("staffs", $this->site_model->get_record("customers", $r->customer_id)->staff_id)->uq_id."</td>";
                                                        if($r->status == 'pending'){
                                                            echo "<td>";
                                                            echo "<button class='btn btn-danger btn-sm shwDecModal btn-link' data-all='".json_encode($r)."'> Decline</button>";
                                                            echo "</td>";
                                                        }
                                                        else{
                                                            echo "<td></td>";
                                                        }
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


            <div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Product Request</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-xs-12">
                                        <label>Request ID</label>
                                        <input type="text" class="form-control" name="request_id" value="" readonly>
                                        <input type="hidden" class="form-control" name="sales_product_id" required="required" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="pending">Pending</option>
                                            <option value="in-transit">In-Transit</option>
                                            <option value="delivered">Delivered</option>
                                        </select>
                                    </div> 
                                    
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="business_line_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="change_status" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="rej-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Decline Product Request</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">
                                <p>Are you sure?</p>
                            </div>
                        <div class="modal-footer">
                            <input type="hidden" name="request_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="decline_request" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
