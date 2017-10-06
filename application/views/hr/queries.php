            
            <script type="text/javascript">
                //Ajax
                $(document).ready(function () {
                
                    $(".shwAppModal").click(function () {
                        var id= $(this).data('leave-id');
                        $("#app-modal #hiddenLeaveId").val(id);
                        $("#app-modal").modal("show");
                    });

                    $(".c-n-q").click(function (e) {
                        e.preventDefault();
                        $("#form-modal").modal("show");
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
                                        List of Queries
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">Create New Query</button></p>
                                        <!-- <p><button class="btn btn-primary shwCreateForm">Create New Query</button></p> -->
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Staff</th>
                                                    <th>Comment</th>
                                                    <th>Document</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM queries ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>";
                                                        echo "<p>".$this->site_model->get_staff($r->staff_id)->fullname."</p>";
                                                        echo "<p><a href='".$this->full_url."view_staff?id=$r->id' target='_blank' class='btn btn-default shwStaff' data-staff-id=''>View Staff Details</a><p>";
                                                        echo "</td>";

                                                        echo "<td>$r->comments</td>";

                                                        echo "<td>";
                                                        echo "<p>$r->doc</p>";
                                                        echo "<p><a target='_blank' href='".$this->config->item('assets_url')."/site/queries/$r->doc'>Preview Document</a></p>";
                                                        echo "</td>";

                                                        echo "<td>".date("d/M/Y H:i:s", strtotime($r->date_created))."</td>";

                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary shwAppModal' data-leave-id='$r->id'><i class='fa fa-paper-plane'></i> Send To Staff Mail</button>";
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


            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Create New Query</h4>
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
                                        <label>Document</label>
                                        <input type="file" class="form-control" name="doc" required="required">
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comments"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="create_query" />
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

