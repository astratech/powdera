            
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

                    $(".shwUploadModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#upload-modal input[name='c_id']").val(d.id);
                            $("#upload-modal").modal("show");
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

                            $("#edit-modal input[name='c_id']").val(d.id);
                            $("#edit-modal input[name='category_id']").val(d.category_id);
                            $("#edit-modal input[name='title']").val(d.title);
                            $("#edit-modal input[name='amount']").val(d.amount);
                            // $("#edit-modal input[name='description']").val(d.description);
                            $("#edit-modal input[name='description']").text("dssdsds");
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
                                        Records
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Record</button></p>
                                       
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Category</th>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Receipt</th>
                                                    <th>Date Created</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM expenses ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>".$this->site_model->get_record("exp_category",$r->category_id)->name."</td>";
                                                        echo "<td>$r->title</td>";
                                                        echo "<td>$r->amount</td>";
                                                        echo "<td>$r->description</td>";
                                                        echo "<td>";
                                                        echo "<p><button class='btn btn-primary btn-xs shwUploadModal' data-all='".json_encode($r)."'>Upload Receipt</button></p>";
                                                        echo "<p><a href='".$this->config->item('assets_url')."/site/expenses/".$r->receipt."' target='_blank'>View Receipt<a></p>";
                                                        echo "</td>";

                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";
                                                        if($r->is_approved == 1){
                                                            echo "<td>APPROVED</td>";
                                                        }
                                                        else{
                                                            echo "<td>Awaiting Approval</td>";
                                                        }
                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary shwEditModal' data-all='".json_encode($r)."' ><i class='fa fa-pencil'></i> Edit </button>";
                                                        echo " <button class='btn btn-danger shwAppModal' data-all='".json_encode($r)."'><i class='fa fa-trash'></i> Delete</button>";
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
                            <h4 class="modal-title" id="myModalLabel">Create New Record</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-md-12">
                                        <label>Select Category</label>
                                        <select class="s2 form-control" name="category_id">
                                           <?php
                                                $list = $this->site_model->get_records("exp_category");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount" required>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
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
                            <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                   <div class="form-group col-md-12">
                                        <label>Select Category</label>
                                        <select class="s2 form-control" name="category_id">
                                           <?php
                                                $list = $this->site_model->get_records("exp_category");
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount" required>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
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
                            <h4 class="modal-title" id="myModalLabel">Delete Record</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            <input type="hidden" name="c_id" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload Receipt</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                           <p>Only JPG, JPEG, PNG images allowed<br/>10MB Maximum Upload Size</p>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="name" class="control-label">Receipt</label>
                                    <input type="file" name="receipt" class="form-control"/>
                                </div>
                            </div>
                            <input type="hidden" name="c_id" class="form-control"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Upload" name="upload" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

