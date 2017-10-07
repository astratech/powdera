            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='payment_id']").val(d.id);
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

                            $("#edit-modal [name='vendor_id']").val(d.vendor_id);
                            $("#edit-modal [name='payment_id']").val(d.id);
                            $("#edit-modal [name='quantity']").val(d.quantity);
                            $("#edit-modal [name='amount']").val(d.amount);
                            $("#edit-modal [name='purpose']").val(d.purpose);
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
                               
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Salary
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">

                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Amount</th>
                                                    <th>Tax</th>
                                                    <th>Net to Gross</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM salary WHERE staff_id='$this->staff_id' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>₦$r->amount</td>";

                                                        echo "<td>";
                                                        echo "<p>$r->tax%</p>";
                                                        echo "<p>₦".(($r->tax/100) * $r->amount)."</p>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<p>₦".($r->amount - ($r->tax/100) * $r->amount)."</p>";
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

                            <div class="col-md-12">
                               
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Allowance
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">

                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Allowance Type</th>
                                                    <th>Amount</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM allowance ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->allowance_type</td>";
                                                        echo "<td>₦$r->amount</td>";                                                        
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
                            <h4 class="modal-title" id="myModalLabel">Create New Vendor Payment</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group col-xs-12">
                                    <label>Vendor</label>
                                    <br>
                                    <select class="form-control s2" name="vendor_id">
                                       <?php
                                       $list = $this->db->query("SELECT * FROM vendors ORDER BY id DESC");
                                            foreach ($list->result() as $d) {
                                               echo "<option value='$d->id'>$d->company_name :: $d->uq_id</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" name="quantity" required="required">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" required="required">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Purpose of Payment</label>
                                    <input type="text" class="form-control" name="purpose" required="required">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Send For Approval" name="create_payment" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Vendor Payment</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group col-xs-12">
                                    <label>Vendor</label>
                                    <br>
                                    <select class="form-control s2" name="vendor_id">
                                       <?php
                                       $list = $this->db->query("SELECT * FROM vendors ORDER BY id DESC");
                                            foreach ($list->result() as $d) {
                                               echo "<option value='$d->id'>$d->company_name :: $d->uq_id</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" name="quantity" required="required">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" required="required">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Purpose of Payment</label>
                                    <input type="text" class="form-control" name="purpose" required="required">
                                </div>

                            </div>  
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="payment_id" value="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_payment" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Payment</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            <input type="hidden" name="payment_id" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_payment" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
