            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function () {
                        var id= $(this).data('leave-id');
                        $("#app-modal #hiddenLeaveId").val(id);
                        $("#app-modal").modal("show");
                    });

                    $(".shwRjModal").click(function () {
                        var id= $(this).data('leave-id');
                        $("#rj-modal #hiddenLeaveId").val(id);
                        $("#rj-modal").modal("show");
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
                                        List of Unapproved Leave
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Staff</th>
                                                    <th>Leave Type</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Comments</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM leaves WHERE is_approved='0' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>";
                                                        echo "<p>".$this->site_model->get_staff($r->staff_id)->fullname."</p>";
                                                        echo "<p><a href='".$this->full_url."view_staff?id=$r->id' target='_blank' class='btn btn-default shwStaff' data-staff-id=''>View Staff Details</a><p>";
                                                        echo "</td>";
                                                        echo "<td>$r->leave_type</td>";
                                                        echo "<td>".date("d/M/Y", strtotime($r->date_from))."</td>";
                                                        echo "<td>".date("d/M/Y", strtotime($r->date_to))."</td>";
                                                        echo "<td>$r->comments</td>";

                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary shwAppModal' data-leave-id='$r->id'><i class='fa fa-check'></i> Approve</button>";
                                                        echo " <button class='btn btn-danger shwRjModal'  data-leave-id='$r->id'><i class='fa fa-ban'></i> Reject</button>";
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
                            <h4 class="modal-title" id="myModalLabel">Approve Leave</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure?</p>
                            <input type="hidden" name="leave_id" id="hiddenLeaveId" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Yes" name="approve_leave" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="rj-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Reject Leave</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure of this?</p>
                            <input type="hidden" name="leave_id" id="hiddenLeaveId" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="reject_leave" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

