            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='supplier_id']").val(d.id);
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
                            $("#edit-modal [name='category']").val(d.category);
                            $("#edit-modal [name='contact_info']").val(d.contact_info);
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
                                <style type="text/css">
                                    pre{
                                        border-width: 0px;
                                        background-color: transparent;
                                    }
                                </style>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        List of Suppliers
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Supplier</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Contact Info</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>$r->name</td>";
                                                        echo "<td>$r->category</td>";
                                                        echo "<td><pre>".$r->contact_info."</pre></td>";
                                                                                                            
                                                        echo "<td>".date("d-M-Y H:i:s", strtotime($r->date_created))."</td>";

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

                                    <div class="form-group col-xs-12">
                                        <label>Supplier Item Category</label>
                                        <input type="text" class="form-control" name="category" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Contact Info</label>
                                        <textarea class="form-control" name="contact_info"></textarea>
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

                                    <div class="form-group col-xs-12">
                                        <label>Supplier Item Category</label>
                                        <input type="text" class="form-control" name="category" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Contact Info</label>
                                        <textarea class="form-control" name="contact_info"><pre></pre></textarea>
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
                            <h4 class="modal-title" id="myModalLabel">Delete Supplier</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="supplier_id" value="" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_supplier" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

