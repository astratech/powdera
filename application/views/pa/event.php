            
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
                            $("#edit-modal [name='event_name']").val(d.event_name);
                            $("#edit-modal [name='event_date']").val(d.event_date);
                            $("#edit-modal [name='event_time']").val(d.event_time);
                            $("#edit-modal [name='c_name']").val(d.coordinator_name);
                            $("#edit-modal [name='c_mobile']").val(d.coordinator_mobile);
                            $("#edit-modal [name='event_location']").val(d.event_location);
                            $("#edit-modal [name='event_duration']").val(d.event_duration);
                            $("#edit-modal [name='obj']").val(d.event_objectives);
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
                                        List
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                        <p><button class="btn btn-primary c-n-q">+ Add Event Itinerary</button></p>
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Event Name</th>
                                                    <th>Event Date/Time</th>
                                                    <th>Coordinator's Name</th>
                                                    <th>Coordinator's Mobile</th>
                                                    <th>Event Duration</th>
                                                    <th>Event Location</th>
                                                    <th>Event Objectives</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM event_itin ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";                                                        
                                                        echo "<td>$r->event_name</td>";
                                                        echo "<td>".date("d-M-Y", strtotime($r->event_date))." $r->event_time</td>";
                                                        echo "<td>$r->coordinator_name</td>";
                                                        echo "<td>$r->coordinator_mobile</td>";
                                                        echo "<td>$r->event_duration</td>";
                                                        echo "<td>$r->event_location</td>";
                                                        echo "<td><pre>".$r->event_objectives."</pre></td>";
                                                                                                            
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
                            <h4 class="modal-title" id="myModalLabel">Create New Event Itinerary</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group col-xs-12">
                                    <label>Event Name</label>
                                    <input type="text" class="form-control" name="event_name" required="required">
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Event Date</label>
                                        <input type="text" class="form-control" name="event_date" required="required" data-provide="datepicker">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Event Time</label>
                                        <input type="text" class="form-control" name="event_time" required="required" placeholder="00:00 PM">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Coordinator's Name</label>
                                        <input type="text" class="form-control" name="c_name" required="required">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Coordinator's Mobile</label>
                                        <input type="text" class="form-control" name="c_mobile" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Event Duration</label>
                                        <input type="text" class="form-control" name="event_duration" required="required">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Event Location</label>
                                        <input type="text" class="form-control" name="event_location" required="required">
                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Objectives</label>
                                    <textarea class="form-control" name="obj"></textarea>
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
                            <h4 class="modal-title" id="myModalLabel">Edit Itinerary</h4>
                        </div>
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row dform" style="padding: 20px;">

                                <div class="form-group col-xs-12">
                                    <label>Event Name</label>
                                    <input type="text" class="form-control" name="event_name" required="required">
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Event Date</label>
                                        <input type="text" class="form-control" name="event_date" required="required" data-provide="datepicker">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Event Time</label>
                                        <input type="text" class="form-control" name="event_time" required="required" placeholder="00:00 PM">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Coordinator's Name</label>
                                        <input type="text" class="form-control" name="c_name" required="required">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Coordinator's Mobile</label>
                                        <input type="text" class="form-control" name="c_mobile" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Event Duration</label>
                                        <input type="text" class="form-control" name="event_duration" required="required">
                                    </div>

                                    <div class="col-xs-6">
                                        <label>Event Location</label>
                                        <input type="text" class="form-control" name="event_location" required="required">
                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Objectives</label>
                                    <textarea class="form-control" name="obj"></textarea>
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
                            <h4 class="modal-title" id="myModalLabel">Delete Event Itinerary</h4>
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

