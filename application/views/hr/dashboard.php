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
                                    <li>Home</li>
                                    <li><a href="index.html#" class="active">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!--states start-->
                        <div class="row">

                            <div class="col-md-6 col-sm-6">
                                <div class="panel short-states bg-primary">
                                    <div class="pull-right state-icon">
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            $ts = $this->db->query("SELECT * FROM staffs WHERE is_approved='1' AND offboard='0' ORDER BY id DESC");
                                            $tt = $ts->num_rows();
                                        ?>
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $tt; ?></h1>
                                        <div class=" pull-right"></i></div>
                                        <strong class="text-uppercase">Total Number of Staff.</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="panel short-states bg-primary" style="background-color: #89c26f;">
                                    <div class="pull-right state-icon">
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            $ts = $this->db->query("SELECT * FROM depts ORDER BY id DESC");
                                            $td = $ts->num_rows();
                                        ?>
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $td; ?></h1>
                                        <div class=" pull-right"></i></div>
                                        <strong class="text-uppercase">Total Number of Dept.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--states end-->


                        <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Queries in 6 Months
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
