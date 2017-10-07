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
                                        Products in Warehouse
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <table class="table convert-data-table table-striped table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product Type</th>
                                                    <th>Quantity</th>
                                                    <th>Date Added</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">

                                                <?php
                                                    $st = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND is_approved='1' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";
                                                        echo "<td>$r->uq_id</td>";

                                                        echo "<td>".$this->site_model->get_business_line($r->business_line_id)->name."</td>";

                                                        $qq = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_id='$r->id' ORDER BY id DESC LIMIT 0,1");
                                                        foreach ($qq->result() as $i) {
                                                            $w_item = $i->item;
                                                            $w_qty = $i->quantity;
                                                            $w_unit = $i->unit;

                                                        }

                                                        echo "<td><p>$w_item</p> <p>$w_qty $w_unit</p></td>";
                                                        echo "<td>".date("d-M-Y", strtotime($r->date_approved))."</td>";
                                                                                                            
                                                      
                                                        echo "</tr>";

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
