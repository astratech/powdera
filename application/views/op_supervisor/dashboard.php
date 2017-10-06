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
                                        Ongoing Production Details
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <table class="table convert-data-table table-striped table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Batch Code</th>
                                                    <th>Product Type</th>
                                                    <th>Current Run Process</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM prod_batch WHERE done='0' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>".$this->site_model->get_business_line($r->business_line_id)->name."</td>";
                                                        echo "<td>".$this->site_model->get_process($this->site_model->get_assigned_process($r->current_ass_process_id)->process_id)->name."</td>";

                                                        
                                                      
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
