            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='prod_batch_id']").val(d.id);
                            $("#app-modal .modal-title").text("Approve Production Batch : "+d.uq_id);
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

                            $("#dec-modal input[name='prod_batch_id']").val(d.id);
                            $("#dec-modal .modal-title").text("Decline Production Batch : "+d.uq_id);
                            $("#dec-modal").modal("show");
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
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Batch Code</th>
                                                    <th>Operations Supervisor</th>
                                                    <th>Line of Business</th>
                                                    <th>Raw Materials Used</th>
                                                    <th>Total Defects</th>
                                                    <th>Qty sent to warehouse</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM prod_batch WHERE done='1' AND is_approved='0' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>".$this->site_model->get_staff($r->staff_id)->fullname."</td>";
                                                        echo "<td>".$this->site_model->get_business_line($r->business_line_id)->name."</td>";

                                                        echo "<td>";
                                                        $st = $this->db->query("SELECT * FROM prod_input_items WHERE prod_batch_id='$r->id' ORDER BY id ASC");
                                                        foreach ($st->result() as $i) {
                                                            echo "<p> - ".$this->site_model->get_store_item($i->store_item_id)->item_name."</p>";

                                                        }
                                                        echo "</td>";

                                                        $td = $this->db->query("SELECT * FROM prod_defects WHERE prod_batch_id='$r->id' ORDER BY id ASC");
                                                        $total_defects = 0;
                                                        foreach ($td->result() as $i) {
                                                            $total_defects = $total_defects + $i->quantity;

                                                        }
                                                        echo "<td>$total_defects</td>";

                                                        $qq = $this->db->query("SELECT * FROM prod_output_items WHERE prod_batch_id='$r->id' ORDER BY id DESC LIMIT 0,1");
                                                        $total_defects = 0;
                                                        foreach ($qq->result() as $i) {
                                                            $w_item = $i->item;
                                                            $w_qty = $i->quantity;
                                                            $w_unit = $i->unit;

                                                        }

                                                        echo "<td><p>$w_item</p> <p>$w_qty $w_unit</p></td>";
                                                                                                            
                                                        echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_created))."</td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary btn-xs shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-check'></i> Approve</button>";
                                                        echo " <button class='btn btn-danger btn-xs shwDecModal'  data-all='".json_encode($r)."'><i class='fa fa-ban'></i> Decline</button>";
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

            <div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Approve Production Batch</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="prod_batch_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="app_prod" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="dec-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Decline Production Batch</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="prod_batch_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="dec_prod" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

