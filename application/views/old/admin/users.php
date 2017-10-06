                <script type="text/javascript">
                    //Ajax
                    $(document).ready(function () {
                        $(".delete").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'delete_user', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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
                        $(".block-user").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'block_user', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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
                        $(".unblock-user").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unblock_user', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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

                        $(".do-internal").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'do_internal', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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

                        $(".undo-internal").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'undo_internal', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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

                        $(".do-verify").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'do_verify', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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

                        $(".undo-verify").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/users' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'undo_verify', 'user_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/users' ?>";
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
                        })
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
                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">Users List</h1>
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
                                <a href="<?php echo $this->config->base_url();?>admin/users" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
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
                                                <th>Password</th>
                                                <th>Fullname</th>
                                                <th>Type</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>Phone Number</th>
                                                <th>Referral</th>
                                                <th>Blocked</th>
                                                <th>Cause</th>
                                                <th>Verification</th>
                                                <th>Bank Name</th>
                                                <th>Account Type</th>
                                                <th>Account Name</th>
                                                <th>Account Number</th>
                                                <th>Ver Code</th>
                                                <th>Joined</th>
                                                <th>Last Login</th>
                                                <th>USER ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sn = 1;
                                            echo "<p>".$list->num_rows()." Records Found<p>";
                                            foreach ($list->result() as $r) {
                                                // block user after 12 hours of non PH
                                                // $user_reg_time = $this->admin_model->get_date_diff(date("Y-m-d H:i:s"), $r->date_created);
                                                
                                                // if($user_reg_time->hours > 12 AND $r->ph_count < 1){
                                                //     // block user
                                                //     $this->db->query("UPDATE users SET is_blocked='1',cause_of_blockage='no PH within 12 hours of reg' WHERE username='$r->username'");
                                                // }

                                                echo "<tr class='active'>";
                                                echo "<td>$sn</td>";
                                                echo "<td>$r->username</td>";
                                                echo "<td>".$this->admin_model->decode_password($r->password)."</td>";
                                                echo "<td>$r->fullname</td>";
                                                echo "<td>$r->type</td>";
                                                echo "<td>$r->email</td>";
                                                echo "<td>$r->city</td>";
                                                echo "<td>$r->mobile</td>";
                                                echo "<td>$r->ref</td>";
                                                if($r->is_blocked == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>BLOCKED</td>";
                                                }

                                                echo "<td>$r->cause_of_blockage</td>";
                                                if($r->is_verified == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>VERIFIED</td>";
                                                }
                                                echo "<td>".$this->admin_model->get_bank_name($r->bank_id)."</td>";
                                                echo "<td>$r->account_type</td>";
                                                echo "<td>$r->account_name</td>";
                                                echo "<td>$r->account_number</td>";
                                                echo "<td>$r->verification_code</td>";
                                                echo "<td>$r->date_created</td>";
                                                echo "<td>$r->last_login</td>";
                                                echo "<td>$r->id</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-danger btn-sm delete' id='$r->id'><i class='fa fa-trash'></i></button><br/>";
                                                if($r->is_blocked == 1){
                                                    echo "<button class='btn btn-primary btn-sm unblock-user' id='$r->id'>UnBlock</button>";
                                                }
                                                else{
                                                    echo "<button class='btn btn-primary btn-sm block-user' id='$r->id'>Block</button>";
                                                }

                                                // if($r->is_verified == 1){
                                                //     echo "<button class='btn btn-primary btn-sm undo-verify' id='$r->id'>Unverify</button>";
                                                // }
                                                // else{
                                                //     echo "<button class='btn btn-primary btn-sm do-verify' id='$r->id'>Verify</button>";
                                                // }

                                                if($r->type == 'normal'){
                                                    echo "<button class='btn btn-primary btn-sm do-internal' id='$r->id'>Make Internal</button>";
                                                }
                                                else{
                                                    echo "<button class='btn btn-primary btn-sm undo-internal' id='$r->id'>Make Normal</button>";
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