            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function () {
                        // alert("yes boss");
                        var staff_id= $(this).data('staff-id');
                        // alert(text);
                        $("#app-modal #hiddenStaffId").val(staff_id);
                        $("#app-modal").modal("show");
                    });

                    $(".shwRjModal").click(function () {
                        // alert("yes boss");
                        var staff_id= $(this).data('staff-id');
                        // alert(text);
                        $("#rj-modal #hiddenStaffId").val(staff_id);
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
                                        List of Unapproved Staff
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Dept</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Supervisor</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM staffs WHERE is_approved='0' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->title $r->fullname</td>";

                                                        echo "<td>".$this->site_model->get_dept($r->dept_id)->title."</td>";
                                                        echo "<td style='text-transform: lowercase;'>$r->email</td>";
                                                        echo "<td>$r->mobile</td>";
                                                        echo "<td>".$this->site_model->get_staff($r->supervisor_staff_id)->title." ".$this->site_model->get_staff($r->supervisor_staff_id)->fullname."</td>";

                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary shwAppModal' data-staff-id='$r->id'><i class='fa fa-check'></i> Approve</button>";
                                                        echo "<button class='btn btn-danger shwRjModal'  data-staff-id='$r->id'><i class='fa fa-ban'></i> Reject</button>";
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
                            <h4 class="modal-title" id="myModalLabel">Approve Staff</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you Sure?</p>
                            <input type="hidden" name="staff_id" id="hiddenStaffId" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Yes" name="approve_staff" />
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
                            <h4 class="modal-title" id="myModalLabel">Reject Staff</h4>
                        </div>
                        <form action="" method="POST">
                        <div class="modal-body">
                            <p>Are you about to Reject a Staff. <br><br>Are you Sure of this?</p>
                            <input type="hidden" name="staff_id" id="hiddenStaffId" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Continue" name="reject_staff" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>


