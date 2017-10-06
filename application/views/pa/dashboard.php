<!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title">
                                    Dashboard
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Admin PA</li>
                                    <li>Dashboard</li>

                            </div>
                        </div>
                        <!--page title and breadcrumb end -->


                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Staff LIST
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Staff ID</th>
                                                    <th>Name</th>
                                                    <th>Dept</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Supervisor</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM staffs ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->uq_id</td>";
                                                        echo "<td>$r->title $r->fullname</td>";

                                                        echo "<td>".$this->site_model->get_dept($r->dept_id)->title."</td>";
                                                        echo "<td>$r->email</td>";
                                                        echo "<td>$r->mobile</td>";
                                                        echo "<td>".$this->site_model->get_staff($r->supervisor_staff_id)->title." ".$this->site_model->get_staff($r->supervisor_staff_id)->fullname."</td>";

                                                        if ($r->is_approved == 1) {
                                                            echo "<td><label class='label label-success'>Approved</label></td>";
                                                        }
                                                        else{
                                                            echo "<td><label class='label label-default'>Awaiting Approval</label></td>";
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


