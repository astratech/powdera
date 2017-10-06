                <script type="text/javascript">

                    //Ajax

                    $(document).ready(function () {

                        $(".delete").click(function(e){

                            e.preventDefault();

                            var id = $(this).attr('id');

                            var c_url = "<?php echo $this->config->base_url().'admin/report' ?>";

                            var con = confirm("Are you sure?");

                            if(con){

                                $.ajax({

                                    url: c_url,

                                    type: 'post',

                                    data: {'action': 'delete', 'report_id': id},

                                    success: function (data, status) {

                                        var result = String(data);

                                        result = result.trim();

                                        if (result == "1") {

                                            window.location.href = "<?php echo $this->config->base_url().'admin/report' ?>";

                                        }

                                        else {

                                            alert('failed');

                                        }

                                    },

                                    error: function (xhr, desc, err) {

                                        alert('failed'+desc);

                                    }

                                });//end ajax call

                            }

                        });

                        $(".solve").click(function(e){

                            e.preventDefault();

                            var id = $(this).attr('id');

                            var c_url = "<?php echo $this->config->base_url().'admin/report' ?>";

                            var con = confirm("Are you sure?");

                            if(con){

                                $.ajax({

                                    url: c_url,

                                    type: 'post',

                                    data: {'action': 'solve', 'report_id': id},

                                    success: function (data, status) {

                                        var result = String(data);

                                        result = result.trim();

                                        if (result == "1") {

                                            window.location.href = "<?php echo $this->config->base_url().'admin/report' ?>";

                                        }

                                        else {

                                            alert('failed');

                                        }

                                    },

                                    error: function (xhr, desc, err) {

                                        alert('failed');

                                    }

                                });//end ajax call

                            }

                        });

                        $(".unsolve").click(function(e){

                            e.preventDefault();

                            var id = $(this).attr('id');

                            var c_url = "<?php echo $this->config->base_url().'admin/report' ?>";

                            var con = confirm("Are you sure?");

                            if(con){

                                $.ajax({

                                    url: c_url,

                                    type: 'post',

                                    data: {'action': 'unsolve', 'report_id': id},

                                    success: function (data, status) {

                                        var result = String(data);

                                        result = result.trim();

                                        if (result == "1") {

                                            window.location.href = "<?php echo $this->config->base_url().'admin/report' ?>";

                                        }

                                        else {

                                            alert('failed');

                                        }

                                    },

                                    error: function (xhr, desc, err) {

                                        alert('failed');

                                    }

                                });//end ajax call

                            }

                        });

                    });

                </script>

                <!-- Main Container -->

                <main id="main-container">

                    <!-- Page Header -->

                    <div class="bg-image overflow-hidden" style="background-image: url('<?php echo $this->config->item("assets_url"); ?>/img/banners/bg3.png');">

                        <div class="bg-black-op">

                            <div class="content content-narrow">

                                <div class="block block-transparent">

                                    <div class="block-content block-content-full">

                                        <div class="row">

                                            <div class="col-sm-6">

                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">Report List</h1>

                                            </div>

                                            <div class="col-sm-6">

                                                <!-- <button class="btn btn-primary pull-right push-50-t">Create New</button> -->

                                            </div>

                                        </div>

                                        

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- END Page Header -->

                    <!-- Page Content -->

                    <div class="content">

                        <!-- Full Table -->

                        <div class="block">

                            <div class="block-header">

                                <a href="<?php echo $this->config->base_url();?>admin/report" class="btn btn-primary"><i class="fa fa-refresh"></i></a>

                                <form action="" method="post" class="form-inline pull-right" >

                                    <div class="form-group">

                                        <label class="sr-only"></label>

                                        <input name="search" class="form-control" placeholder="Username" type="text" value="<?php echo isset($_GET['search']) ? $_GET['search']: ''?>">

                                    </div>

                                    <div class="form-group">

                                        <input type="submit" value="Search" style="overflow: hidden; position: relative;" class="form-control btn btn-effect-ripple btn-primary">

                                    </div>

                                </form>

                            </div>

                            <div class="block-content">

                                <div class="table-responsive">

                                    <table class="table table-striped table-vcenter table-bordered">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Username</th>

                                                <th>Merge ID</th>

                                                <th>Reason</th>

                                                <th>ID</th>

                                                <th>Solve</th>

                                                <th>Date Created</th>

                                                <th>Action</th>

                                                <th>Resolve Link</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        <?php

                                            $sn = 1;

                                            echo "<p>".$list->num_rows()." Records Found<p>";

                                            foreach ($list->result() as $r) {

                                                echo "<tr class='active'>";

                                                echo "<td>$sn</td>";

                                                echo "<td>$r->username</td>";

                                                echo "<td>$r->merge_id</td>";

                                                echo "<td>$r->reason</td>";

                                                echo "<td>$r->id</td>";



                                                if($r->is_solved == "0"){

                                                    echo "<td></td>";

                                                }

                                                else{

                                                    echo "<td>SOLVED</td>";

                                                }

                                                

                                                echo "<td>$r->date_created</td>";

                                                echo "<td>";

                                                echo "<button class='btn btn-danger btn-sm delete' id='$r->id'><i class='fa fa-trash'></i></button><br/><br/>";

                                                if($r->is_solved == 0){

                                                    echo "<button class='btn btn-primary btn-sm solve' id='$r->id'>solve</button>";

                                                }

                                                else{

                                                    echo "<button class='btn btn-primary btn-sm unsolve' id='$r->id'>unsolve</button>";

                                                }

                                                

                                                echo "</td>";

                                                echo "<td><a href='".$this->config->base_url()."admin/report/resolve/$r->merge_id' target='_blank'>link</a></td>";

                                                echo "</tr>";

                                                $sn++;

                                            }

                                        ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <!-- END Full Table -->

                    </div>

                    <!-- END Page Content -->

                </main>

                <!-- END Main Container -->

                </div>s