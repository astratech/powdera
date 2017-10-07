            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function (e) {
                        e.preventDefault();
                        try{
                            var d = $(this).data('all');

                            $("#app-modal input[name='allowance_id']").val(d.id);
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

                            $("#edit-modal input[name='allowance_id']").val(d.id);
                            $("#edit-modal input[name='staff_id']").val(d.staff_id);
                            $("#edit-modal input[name='staff_name']").val(d.staff_name);
                            $("#edit-modal [name='type']").val(d.allowance_type);
                            $("#edit-modal input[name='amount']").val(d.amount);
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
                                        Allowance
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Allowance</button></p>
                                       
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Staff</th>
                                                    <th>Allowance Type</th>
                                                    <th>Amount</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM allowance ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>";
                                                        $staff_name = $this->site_model->get_staff($r->staff_id)->title." ".$this->site_model->get_staff($r->staff_id)->fullname;
                                                        echo "<p>".$this->site_model->get_staff($r->staff_id)->fullname."</p>";
                                                        echo "<p><a href='".$this->full_url."view_staff?id=$r->id' target='_blank' class='btn btn-default shwStaff' data-staff-id=''>View Staff Details</a><p>";
                                                        echo "</td>";
                                                        echo "<td>$r->allowance_type</td>";
                                                        echo "<td>₦$r->amount</td>";
                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";
                                                        $r->staff_name  = $staff_name;
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
                            <h4 class="modal-title" id="myModalLabel">Create New Allowance</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-md-12">
                                        <label>Staff</label>
                                        <select class="ss form-control" name="staff_id">
                                           <?php
                                                $list = $this->site_model->get_all_staff_list();
                                                foreach ($list->result() as $d) {
                                                   echo "<option value='$d->id'>$d->title $d->fullname :: $d->staff_uq_id</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Allowance Type</label>
                                        <select class="ss form-control" name="type">
                                           <option value="leave">Leave</option>
                                           <option value="medical">Medical</option>
                                           <option value="wardrobe">Wardrobe</option>
                                           <option value="special grants">Special Grants</option>
                                           <option value="transport">Transport</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount" required="required">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_allowance" />
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
                            <h4 class="modal-title" id="myModalLabel">Edit Allowance</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                                <div class="row dform" style="padding: 20px;">
                                    <div class="form-group col-md-12">
                                        <label>Staff</label>
                                        <input type="text" name="staff_name" class="form-control" readonly="readonly">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Allowance Type</label>
                                        <select class="ss form-control" name="type">
                                           <option value=""></option>
                                           <option value="leave">Leave</option>
                                           <option value="medical">Medical</option>
                                           <option value="wardrobe">Wardrobe</option>
                                           <option value="special grants">Special Grants</option>
                                           <option value="transport">Transport</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Salary(₦)</label>
                                        <input type="number" class="form-control" name="amount" required="required">
                                        <input type="hidden" name="allowance_id" value="" />
                                        <input type="hidden" name="staff_id" value="" />
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update_allowance" />
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
                            <h4 class="modal-title" id="myModalLabel">Delete Allowance</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            <input type="hidden" name="allowance_id" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="delete_allowance" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

