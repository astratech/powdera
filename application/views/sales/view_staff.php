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

                        <?php
                            if(isset($_GET['id']) AND !empty($_GET['id'])){
                                $s_id = $this->site_model->fil_num($_GET['id']);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Staff Details
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Dept</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Supervisor</th>
                                                    <th>Status</th>
                                                    <th>Date Created</th>
                                                    <th>Date Approved</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM staffs WHERE id='$s_id' ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->title $r->fullname</td>";

                                                        echo "<td>".$this->site_model->get_dept($r->dept_id)->title."</td>";
                                                        echo "<td style='text-transform: lowercase;'>$r->email</td>";
                                                        echo "<td>$r->mobile</td>";
                                                        echo "<td>".$this->site_model->get_staff($r->supervisor_staff_id)->title." ".$this->site_model->get_staff($r->supervisor_staff_id)->fullname."</td>";

                                                        if ($r->is_approved == 1) {
                                                            echo "<td><label class='label label-success'>Approved</label></td>";
                                                        }
                                                        else{
                                                            echo "<td><label class='label label-default'>Awaiting Approval</label></td>";
                                                        }

                                                        echo "<td>".date("d / M / Y", strtotime($r->date_created))."</td>";
                                                        echo "<td>".date("d / M / Y", strtotime($r->date_approved))."</td>";
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
                        <?php
                            }
                            else{
                        ?>
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
                                       
                                        <table class="table convert-data-table table-hover table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Dept</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Supervisor</th>
                                                    <th>Status</th>
                                                    <th>Date Created</th>
                                                    <th>Date Approved</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM staffs ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       

                                                        echo "<tr style='text-transform: capitalize;'>";

                                                        echo "<td>$sn</td>";
                                                        echo "<td>$r->title $r->fullname</td>";

                                                        echo "<td>".$this->site_model->get_dept($r->dept_id)->title."</td>";
                                                        echo "<td style='text-transform: lowercase;'>$r->email</td>";
                                                        echo "<td>$r->mobile</td>";
                                                        echo "<td>".$this->site_model->get_staff($r->supervisor_staff_id)->title." ".$this->site_model->get_staff($r->supervisor_staff_id)->fullname."</td>";

                                                        if ($r->is_approved == 1) {
                                                            echo "<td><label class='label label-success'>Approved</label></td>";
                                                        }
                                                        else{
                                                            echo "<td><label class='label label-default'>Awaiting Approval</label></td>";
                                                        }

                                                        echo "<td>".date("d / M / Y", strtotime($r->date_created))."</td>";
                                                        echo "<td>".date("d / M / Y", strtotime($r->date_approved))."</td>";
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
                        <?php 

                            }
                        ?>
                    </div>

                </div>
            </div>
            <!--main content end-->


