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
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Products Requested
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <table class="table convert-data-table table-striped table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">
                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM customer_requests WHERE customer_id='$this->customer_id' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>".$this->site_model->get_sales_product($r->sales_product_id)->prod_output_item_id."</td>";
                                                        echo "<td>$r->quantity</td>";
                                                        echo "<td>".($this->site_model->get_sales_product($r->sales_product_id)->price * $r->quantity)."</td>";
                                        
                                                        echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_created))."</td>";
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
