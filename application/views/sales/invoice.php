            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                    

                    $(".printNow").click(function (e) {
                        e.preventDefault();
                        $('.d-invoice').printThis();
                    });
                
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
                               <div class="panel panel-body">
                                    <h3 class="pull-left margin0">Invoice</h3>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-sm btn-info pull-right printNow" target="_blank"> <i class="fa fa-print"></i> Print Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row d-invoice">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <img src="<?php echo $this->config->item('assets_url'); ?>/images/logo.png" width="200px" alt=""/>
                                            </div>

                                            <div class="col-xs-6 text-right">
                                                <h4>Invoice No.</h4>
                                                <h4 class="text-navy"><?php echo $this->site_model->get_record("customer_requests", $id)->uq_id; ?></h4>
                                                <span>To:</span>
                                                <address>
                                                    <strong><?php echo $this->site_model->get_record("customers", $this->site_model->get_record("customer_requests", $id)->customer_id)->name; ?></strong><br>
                                                    <?php echo $this->site_model->get_record("customers", $this->site_model->get_record("customer_requests", $id)->customer_id)->uq_id; ?> <br><br>
                                                    <abbr title="Phone">P: <?php echo $this->site_model->get_record("customers", $this->site_model->get_record("customer_requests", $id)->customer_id)->mobile; ?></abbr> <br>
                                                    <abbr title="Phone">E: <?php echo $this->site_model->get_record("customers", $this->site_model->get_record("customer_requests", $id)->customer_id)->email; ?></abbr> 
                                                </address>
                                                <p>
                                                    <span><strong>Invoice Date:</strong> <?php echo date("M d,Y"); ?></span><br>
                                                </p>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover invoice-table">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product</th>
                                                            <th class="">Quantity</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <?php $sales_product_id = $this->site_model->get_record("customer_requests",$id)->sales_product_id; ?>
                                                        <tbody>
                                                            <tr style="text-transform: uppercase;">
                                                                <td>1</td>
                                                                <td><?php echo $this->site_model->get_sales_product($sales_product_id)->uq_id." - ".$this->site_model->get_prod_output_item($this->site_model->get_sales_product($sales_product_id)->prod_output_item_id)->item; ?></td>
                                                                <td class=""><?php echo $this->site_model->get_record("customer_requests", $id)->quantity." ". $this->site_model->get_sales_product($sales_product_id)->unit; ?></td>
                                                                <td>₦ <?php echo $this->site_model->get_record("customer_requests", $id)->amount; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <table class="table table-hover invoice-total">
                                                    <tbody>

                                                    <tr>
                                                        <td><strong>TOTAL :</strong></td>
                                                        <td>₦ <?php echo $this->site_model->get_record("customer_requests", $id)->amount; ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <br/>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
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
