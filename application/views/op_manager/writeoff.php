            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='writeoff_id']").val(d.id);
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

                            $("#dec-modal input[name='writeoff_id']").val(d.id);
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

                                    // $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                    // foreach ($list->field_data() as $d) {
                                    //     echo $d->name;
                                    // }
                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        List of Write Off Materials
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Item Details</th>
                                                    <th>Supplier</th>
                                                    <th>Quantity to Write Off</th>
                                                    <th>Date Created</th>
                                                    <th>Approver</th>
                                                    <th>Date Approved</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM store_item_write_off ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>";
                                                        echo "<p>".$this->site_model->get_record("store_items", $r->item_id)->uq_id." - ".$this->site_model->get_record("store_items", $r->item_id)->item_name."</p>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<p>".$this->site_model->get_record("suppliers", $this->site_model->get_record("store_items", $r->item_id)->supplier_id)->name."</p>";
                                                        echo "</td>";
                                                        
                                                        echo "<td>$r->quantity ".$this->site_model->get_record("store_items", $r->item_id)->unit."</td>";
                                                                                                            
                                                        echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_created))."</td>";

                                                        

                                                        if($r->is_approved == 1){
                                                            echo "<td>".$this->site_model->get_record("staffs", $r->approve_staff_id)->uq_id."</td>";
                                                            echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_approved))."</td>";
                                                            echo "<td>APPROVED</td>";
                                                        }
                                                        else{
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td>";
                                                            echo "<button class='btn btn-primary btn-xs shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-check'></i> Approve</button>";
                                                            echo " <button class='btn btn-danger btn-xs shwDecModal'  data-all='".json_encode($r)."'><i class='fa fa-ban'></i> Decline</button>";
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
                            <h4 class="modal-title" id="myModalLabel">Approve Request</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="writeoff_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="approve" />
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
                            <h4 class="modal-title" id="myModalLabel">Decline Request</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="writeoff_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Decline" name="decline" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

