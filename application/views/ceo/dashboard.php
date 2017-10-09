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
                                    <li>Dashboard</li>

                            </div>
                        </div>
                        <!--page title and breadcrumb end -->


                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="panel short-states bg-danger" style="background-image: url(<?php echo $this->config->item('assets_url'); ?>/images/ceo/top10.jpg); background-size: cover;">
                                    <div class="pull-right state-icon">
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt" style="color: #fff!important;">Top 10</h1>
                                        <strong class="text-uppercase" href="#testimony" data-toggle="modal" style="color: #fff; cursor: pointer;">Click Here</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6" >
                                <div class="panel short-states" style="background-image: url(<?php echo $this->config->item('assets_url'); ?>/images/ceo/sales.jpg); background-size: cover;">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $this->site_model->calc_sys_total_sales(); ?></h1>
                                        <strong class="text-uppercase" style="color: #fff;">Sales To Date</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="panel short-states bg-warning">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-product-hurt"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt" style="color: #fff!important;"><?php echo $this->site_model->calc_total_warehouse_prod(); ?></h1>
                                        <strong class="text-uppercase" style="color: #fff;">Products in Warehouse</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="panel short-states bg-primary">
                                    <div class="pull-right state-icon">
                                        <i class="fa fa-pie-chart"></i>
                                    </div>
                                    <div class="panel-body">
                                        <h1 class="light-txt" style="color: #fff!important;">0</h1>
                                        <div class=" pull-right"></i></div>
                                        <strong class="text-uppercase">Expenses To date</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- PRODUCTION STATS -->
                            <div class="col-md-6">
                                <div class="panel" style="min-height: 500px; max-height: auto;">
                                    <header class="panel-heading">
                                        Production Statistics

                                        <span class="tools pull-right">
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="col-md-12" style="margin-bottom: 10px; z-index: 50; margin-top: -10px;">
                                            <form class="form-inline" action="" method="POST">
                                                
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>From</label>
                                                        <input type="text" name="date_from" data-provide="datepicker" style="margin-bottom: 0px;"> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>To</label>
                                                        <input type="text" name="date_to" data-provide="datepicker" style="margin-bottom: 0px;"> 
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <input type="submit" name="get_prod" value="GO" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        
                                        <div id="b-area" style="height: 350px;"></div>
                                        <div class="col-md-12 text-center" style="margin-top: 40px;">
                                            <p><?php echo "$stats_statement"; ?></p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- END: PRODUCTION STATS -->

                            <!-- STAFF MANAGEMENT -->
                            <div class="col-md-6">
                               <div class="panel">
                                    <header class="panel-heading panel-border">
                                        STAFF MANAGEMENT
                                        <span class="tools pull-right">
                                            
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body text-center">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 text-center">
                                                <span class="chart" data-percent="80">
                                                    <span class=""><?php echo $this->site_model->calc_total_staff(); ?></span>
                                                </span>
                                                <div><small>Total Staff</small></div>
                                            </div>

                                            <div class="col-md-4 col-sm-4 text-center">
                                                <span class="chart" data-percent="80">
                                                    <span class=""><?php echo $this->site_model->calc_staff_available(); ?></span>
                                                </span>
                                                <div><small>Available Staff</small></div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 text-center">
                                                <span class="chart" data-percent="45">
                                                    <span class=""><?php echo ($this->site_model->calc_total_staff() - $this->site_model->calc_staff_available()); ?></span>
                                                </span>
                                                <div><small>Staff On Leave</small></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: STAFF MANAGEMENT -->

                            <!-- CURRENT JOB -->
                            <div class="col-md-6">
                               <div class="panel">
                                    <header class="panel-heading panel-border">
                                        CURRENT JOB
                                        <span class="tools pull-right">
                                            
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body text-center">
                                        <div class="row">
                                             <div class="col-md-4 col-sm-4 text-center" style="color: #237db1;">
                                                <span style="font-size: 35px;"><?php echo $this->site_model->get_current_prod_batch_details()->input ?></span>
                                                <p>Total Input</p>
                                            </div>
                                            <div class="col-md-4 col-sm-4 text-center" style="color: #cf3033;">
                                                <span style="font-size: 35px;"><?php echo $this->site_model->get_current_prod_batch_details()->defects ?></span>
                                                <p>Total Defects</p>
                                            </div>
                                            <div class="col-md-4 col-sm-4 text-center" style="color: #4ca957;">
                                                <span style="font-size: 35px;"><?php echo $this->site_model->get_current_prod_batch_details()->output ?></span>
                                                <p>Total Output</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: CURRENT JOB -->
                        </div>

                        <div class="row">
                            <!-- STORE CONSUMABLES -->
                            <div class="col-md-6">
                               <div class="panel">
                                    <header class="panel-heading panel-border">
                                       STORE OVERVIEW
                                        <span class="tools pull-right">
                                            
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                    $count = 0;
                                                    $st = $this->db->query("SELECT * FROM store_items ORDER BY id DESC");
                                                    foreach ($st->result() as $r) {
                                                        $left = $r->quantity - ($this->site_model->calc_prod_input_items_qty($r->id));
                                                        $p1 = 100 - (($left/$r->quantity) * 100);
                                                        $p1 = round($p1);
                                                        $p_left = 100 - $p1;

                                                        if($p1 > 80){
                                                            echo "<div>
                                                                <p>$r->item_name ($p1% Used)</p>
                                                                <div class='progress progress-striped'>
                                                                    <div style='width: $p1%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='$p1' role='progressbar' class='progress-bar progress-bar-danger'>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                        }
                                                        elseif($p1 > 50){

                                                            echo "<div>
                                                                <p>$r->item_name ($p1% Used)</p>
                                                                <div class='progress progress-striped'>
                                                                    <div style='width: $p1%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='$p1' role='progressbar' class='progress-bar progress-bar-warning'>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                        }
                                                        else{
                                                            echo "<div>
                                                                <p>$r->item_name ($p1% Used)</p>
                                                                <div class='progress progress-striped'>
                                                                    <div style='width: $p1%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='$p1' role='progressbar' class='progress-bar progress-bar-warning'>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                        }

                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: STORE CONSUMABLES -->

                        </div>
                    </div>

                </div>
            </div>
            <!--main content end-->

            <div class="modal fade" id="testimony">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title">Top 10</h2>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="tabs-accordions.html#tab1" data-toggle="tab" aria-expanded="true">Top 10 Vendors</a></li>
                                        <li class=""><a href="tabs-accordions.html#tab2" data-toggle="tab" aria-expanded="false">Top 10 Customers</a></li>
                                        <li class=""><a href="tabs-accordions.html#tab3" data-toggle="tab" aria-expanded="false">Tab 10 Expenses</a></li>
                                    </ul>
                                    <div class="tab-content panel wrapper">
                                        <div id="tab1" class="tab-pane fade active in">
                                            <div class="table-responsive">
                                                <table  class="table table-hover latest-order">
                                                    <thead>
                                                    <tr>
                                                        <th>UNIQUE ID</th>
                                                        <th>Company Name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $st = $this->db->query("SELECT * FROM vendors ORDER BY id DESC LIMIT 0,10");
                                                        foreach ($st->result() as $r) {
                                                           

                                                            echo "<tr style='text-transform: capitalize;'>";

                                                            echo "<td>$r->uq_id</td>";
                                                            echo "<td>$r->company_name</td>";

                                                            echo "</tr>";
                                                        }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="tab2" class="tab-pane fade">
                                            <div class="table-responsive">
                                                <table  class="table table-hover latest-order">
                                                    <thead>
                                                    <tr>
                                                        <th>UNIQUE ID</th>
                                                        <th>Customer Name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $st = $this->db->query("SELECT * FROM customers ORDER BY id DESC LIMIT 0,10");
                                                        foreach ($st->result() as $r) {
                                                           

                                                            echo "<tr style='text-transform: capitalize;'>";

                                                            echo "<td>$r->uq_id</td>";
                                                            echo "<td>$r->name</td>";

                                                            echo "</tr>";
                                                        }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="tab3" class="tab-pane fade">
                                            <div class="table-responsive">
                                                <table  class="table table-hover latest-order">
                                                    <thead>
                                                    <tr>
                                                        <th>UNIQUE ID</th>
                                                        <th>Customer Name</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
             <!--easypiechart-->
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>/assets/js/jquery-easy-pie-chart/easypiechart.css">
            <script src="<?php echo $this->config->item('assets_url'); ?>/assets/js/echarts/echarts-all-3.js"></script>
            <!--basic area echarts init-->
            <script type="text/javascript">

                var dom = document.getElementById("b-area");
                var myChart = echarts.init(dom);

                var app = {};
                option = null;
                option = {
                    color: ['#237db1','#cf3033','#58b761' ],

                    tooltip : {
                        trigger: 'axis'
                    },
                    legend: {
                        data:['Inputs','Defects','Outputs']
                    },

                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            boundaryGap : false,
                            data : <?php echo json_encode($batch); ?>
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'Inputs',
                            type:'line',
                            smooth:true,
                            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                            data: <?php echo json_encode($inputs); ?>
                        },
                        {
                            name:'Defects',
                            type:'line',
                            smooth:true,
                            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                            data: <?php echo json_encode($defects); ?>
                        },
                        {
                            name:'Outputs',
                            type:'line',
                            smooth:true,
                            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                            data: <?php echo json_encode($outputs); ?>
                        }
                    ]
                };

                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, false);
                }

                /**
                 * Resize chart on window resize
                 * @return {void}
                 */
                window.onresize = function() {
                    chartOne.resize();
                    myChart.resize();
                };


            </script>


