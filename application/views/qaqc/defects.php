            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='c_id']").val(d.id);
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

                            $("#edit-modal [name='c_id']").val(d.id);
                            $("#edit-modal [name='prod_batch_id']").val(d.prod_batch_id);
                            $("#edit-modal [name='num_of_defects']").val(d.num_of_defects);
                            $("#edit-modal [name='quantity']").val(d.qty_received);
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

                                    // $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                    // foreach ($list->field_data() as $d) {
                                    //     echo $d->name;
                                    // }
                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Records
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Add New Record</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Production Batch</th>
                                                    <th>Quantity Received</th>
                                                    <th>Number of Defects</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM qaqc ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";
                                                        
                                                        echo "<td>".$this->site_model->get_record("prod_batch", $r->prod_batch_id)->uq_id."</td>";
                                                        echo "<td>$r->qty_received</td>";
                                                        echo "<td>$r->num_of_defects</td>";
             
                                                        echo "<td>".date("d-M-Y", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary btn-sm shwEditModal' data-all='".json_encode($r)."' ><i class='fa fa-pencil'></i> Edit </button>";
                                                        echo " <button class='btn btn-danger btn-sm shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-trash'></i> Delete</button>";
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


            <div class="modal fade" id="c-form-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Defect</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">


                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Select Production Batch</label>
                                        <select class="form-control s2" name="prod_batch_id">
                                           <?php
                                                $list = $this->db->query("SELECT * FROM prod_batch WHERE done='1' ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Quantity Received</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Number Of Defects</label>
                                        <input type="number" class="form-control" name="num_of_defects">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Material</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Select Production Batch</label>
                                        <select class="form-control s2" name="prod_batch_id">
                                           <?php
                                                $list = $this->db->query("SELECT * FROM prod_batch WHERE done='1' ORDER BY id DESC");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Quantity Received</label>
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label>Number Of Defects</label>
                                        <input type="number" class="form-control" name="num_of_defects">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="c_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="c_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

