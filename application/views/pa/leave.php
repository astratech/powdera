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
                            <div class="col-md-6 col-md-offset-3">
                                <section class="panel">
                                   
                                    <div class="panel-body">
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#pick-date1').datepicker({
                                                    singleDatePicker: true,
                                                    showDropdowns: true
                                                });

                                                $('#pick-date2').datepicker({
                                                    singleDatePicker: true,
                                                    showDropdowns: true
                                                });
                                            });
                                        </script>
                                        

                                        <div class="col-md-12">
                                            <?php 
                                                if(isset($_SESSION['notification'])){

                                                    echo $_SESSION['notification'];

                                                }
                                            ?>
                                            <form class="form-horizontal dform" action="" method="POST">
                                                <!-- <div class="form-group">
                                                    <label>Select Employee</label>
                                                    <select class="form-control s2" name="staff_id">
                                                        <option>Mr Adepoyo - WareHouse</option> 
                                                        <option>Mr James - Store</option> 
                                                        <option>Mr Jones - Factory</option> 
                                                    </select>
                                                </div> -->

                                                <div class="form-group">
                                                    <label>Select Leave Type</label>
                                                    <select class="form-control s2" name="leave_type">
                                                        <option value="maternity">Maternity</option> 
                                                        <option value="compassionate">Compassionate</option> 
                                                        <option value="annual">Annual</option> 
                                                        <option value="study">Study</option> 
                                                        <option value="sick off">Sick off</option> 
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>From</label>
                                                    <input type="text" class="form-control" data-provide="datepicker" name="date_from">
                                                </div>

                                                <div class="form-group">
                                                    <label>To</label>
                                                    <input type="text" class="form-control" data-provide="datepicker" name="date_to">
                                                </div>


                                                <div class="form-group">
                                                    <label>Comments to Approver</label>
                                                    <textarea class="form-control" name="comment"></textarea>
                                                </div>

                                               <div class="form-group">
                                                   <input type="submit" name="create_leave" class="btn btn-primary" value="Send">
                                               </div>
                                           </form>
                                       </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        My Leave History
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>Leave Type</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Comments</th>
                                                    <th>Date Created</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM leaves WHERE staff_id='$this->staff_id' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$r->leave_type</td>";
                                                        echo "<td>".date("d-M-Y", strtotime($r->date_from))."</td>";
                                                        echo "<td>".date("d-M-Y", strtotime($r->date_to))."</td>";
                                                        echo "<td>$r->comments</td>";

                                                        echo "<td>".date("d-M-Y", strtotime($r->date_created))."</td>";
                                                        if($r->is_declined == 1){
                                                            echo "<td>Declined</td>";
                                                        }
                                                        elseif($r->is_approved == 1){
                                                             echo "<td>Declined</td>";
                                                        }
                                                        else{
                                                             echo "<td>Pending</td>";
                                                        }
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


