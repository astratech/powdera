                <script type="text/javascript">
                    //Ajax
                    $(document).ready(function () {
                        $(".delete").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'delete_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".confirm-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'confirm_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".unconfirm-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unconfirm_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".merge-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'merge_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".unmerge-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unmerge_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".block-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'block_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                        $(".unblock-ph").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/ph' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unblock_ph', 'ph_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/ph' ?>";
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
                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">PH List</h1>
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
                                <a href="<?php echo $this->config->base_url();?>back/ph" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
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
                                                <th>Trans Num</th>
                                                <th>Amount</th>
                                                
                                                <th>Date Created</th>
                                                <th>Returns</th>
                                                <th>Merging</th>
                                                <th>confirmation</th>
                                                <th>GH Requested</th>
                                                <th>GH Payment</th>
                                                <th>Amount Left</th>
<!--                                                 <th>PH ID</th> -->
                                                <th>Action</th>
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
                                                echo "<td>$r->trans_num</td>";
                                                echo "<td>$r->amount</td>";
                                                echo "<td>$r->date_created</td>";
                                                echo "<td>$r->returns</td>";

                                                if($r->is_merge == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>MERGED</td>";
                                                }

                                                if($r->is_confirmed == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>COMFIRMED</td>";
                                                }

                                                if($r->is_gh == 1){
                                                    echo "<td>REQUESTED</td>";
                                                }
                                                else{
                                                    echo "<td></td>";
                                                }
                                                if($r->is_paid == 1){
                                                    echo "<td>PAID</td>";
                                                }
                                                else{
                                                    echo "<td></td>";
                                                }
                                               
                                                echo "<td>₦".($this->admin_model->get_unpaid_ph_amount($r->amount, $r->id))."</td>";
//                                                  echo "<td>$r->id</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-danger btn-sm delete' id='$r->id'><i class='fa fa-trash'></i></button><br/>";
                                                if($r->is_confirmed == 0){
                                                    echo "<button class='btn btn-primary btn-sm confirm-ph' id='$r->id'>Confirm</button>";
                                                }
                                                else{
                                                    echo "<button class='btn btn-primary btn-sm unconfirm-ph' id='$r->id'>UnConfirm</button>";
                                                }

                                                if($r->is_merge == 0){
                                                    echo "<button class='btn btn-primary btn-sm merge-ph' id='$r->id'>Merge</button>";
                                                }
                                                else{
                                                    echo "<button class='btn btn-primary btn-sm unmerge-ph' id='$r->id'>UnMerge</button>";
                                                }

                                                
                                                echo "</td>";
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