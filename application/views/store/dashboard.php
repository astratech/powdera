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

                        <!--states start-->
                        <div class="row">

                            <div class="col-md-4 col-sm-4">
                                <div class="panel short-states bg-primary">
                                    <div class="pull-right state-icon">
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            $ss = $this->db->query("SELECT * FROM depts ORDER BY id DESC");
                                        ?>
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $ss->num_rows(); ?></h1>
                                        <div class=" pull-right"></i></div>
                                        <strong class="text-uppercase">Total Number of Suppliers</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="panel short-states bg-primary" style="background-color: #89c26f;">
                                    <div class="pull-right state-icon">
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            $ss = $this->db->query("SELECT * FROM store_items ORDER BY id DESC");
                                        ?>
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $ss->num_rows(); ?></h1>
                                        <div class=" pull-right"></i></div>
                                        <strong class="text-uppercase">Total Number of Materials.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--states end-->


                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($_SESSION['notification'])){

                                        echo $_SESSION['notification'];

                                    }

                                    // $list = $this->db->query("SELECT * FROM suppliers ORDER BY id DESC");
                                    // foreach ($list->field_data() as $d) {
                                    //     echo $d->name;
                                    // }
                                ?>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        List of Finishing Materials
                                    <span class="tools pull-right">
                                        <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                    </span>
                                    </header>
                                    <div class="panel-body table-responsive">
                                       
                                        <table class="table convert-data-table table-striped table-bordered">
                                            <thead style="text-align: right;">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Item Code</th>
                                                    <th>Supplier</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity Supplied</th>
                                                    <th>Unit</th>
                                                    <th>Percentage Available</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left; color: #000;">

                                                <?php
                                                    $sn = 1;

                                                    $st = $this->db->query("SELECT * FROM store_items ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                       $left = $r->quantity - ($this->site_model->calc_prod_input_items_qty($r->id));

                                                        $p1 = 100 - (($left/$r->quantity) * 100);

                                                        if($p1 < 50){

                                                            echo "<tr style='text-transform: capitalize;'>";

                                                            echo "<td>$sn</td>";
                                                            
                                                            echo "<td>$r->uq_id</td>";

                                                            echo "<td>".$this->site_model->get_supplier($r->supplier_id)->name."</td>";

                                                            echo "<td>$r->item_name</td>";
                                                            echo "<td>$r->quantity</td>";
                                                            echo "<td>$r->unit</td>";
                                                            if($p1 < 30){
                                                                echo "<td>";
                                                                echo "<p>$p1%</p>";
                                                                echo "<div class='progress progress-striped'>
                                                                        <div style='width: $p1%'' aria-valuemax='100' aria-valuemin='0' aria-valuenow='$p1' role='progressbar' class='progress-bar progress-bar-xs progress-bar-danger'>
                                                                        </div>
                                                                    </div>";

                                                                echo "</td>";
                                                            }
                                                            else{
                                                                echo "<td>";
                                                                echo "<p>$p1%</p>";
                                                                echo "<div class='progress progress-striped'>
                                                                        <div style='width: $p1%'' aria-valuemax='100' aria-valuemin='0' aria-valuenow='$p1' role='progressbar' class='progress-bar progress-bar-xs progress-bar-warning'>
                                                                        </div>
                                                                    </div>";

                                                                echo "</td>";
                                                            }
                                                           
                                                            echo "</tr>";

                                                            $sn++;  
                                                        } 
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
