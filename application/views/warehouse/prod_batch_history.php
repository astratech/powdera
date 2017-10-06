            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='business_line_id']").val(d.id);
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
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM prod_batch WHERE done='1' ORDER BY id DESC");
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
                            <h4 class="modal-title" id="myModalLabel">Create New Supplier</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">

                                    <div class="form-group col-xs-12">
                                        <label>Supplier Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="<?php echo $this->site_model->gen_uq_id('SPR'); ?>" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required" value="<?php echo isset($_SESSION['cache_form']['name']) ? $_SESSION['cache_form']['name'] : '' ?>">
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_supplier" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Supplier</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-xs-12">
                                        <label>Supplier Code</label>
                                        <input type="text" class="form-control" name="uq_id" required="required" value="" readonly>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" required="required">
                                    </div>
                                    
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="supplier_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_supplier" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Business Line</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="business_line_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_biz" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

