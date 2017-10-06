                <script type="text/javascript">
                    //Ajax
                    $(document).ready(function () {
                        $(".delete").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'delete_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".confirm-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'confirm_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".unconfirm-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unconfirm_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".merge-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'merge_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".unmerge-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unmerge_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".lock-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure you wanna lock this transaction?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'lock_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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

                        $(".unlock-gh").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'admin/gh' ?>";
                            var con = confirm("Are you sure you wanna unlock this transaction?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unlock_gh', 'gh_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'admin/gh' ?>";
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
                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">GH List</h1>
                                            </div>
                                            <div class="col-sm-6">
                                               <!--  <button class="btn btn-danger push-50-t"5 href="#modal-reset" data-toggle="modal">Reset Internal Counter</button> -->
                                                 <button class="btn btn-primary pull-right push-50-t"5 href="#modal-gh" data-toggle="modal">Create New</button>
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
                                <a href="<?php echo $this->config->base_url();?>admin/gh" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
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
                                                <th>PH ID</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Date Created</th>
                                                <th>Merging</th>
                                                <th>Locked</th>
                                                <th>GH ID</th>
                                                <th>Confirmation</th>
                                                <th>Unpaid Amount</th>
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
                                                echo "<td>$r->ph_id</td>";
                                                echo "<td>₦$r->amount</td>";
                                                
                                                echo "<td>$r->type</td>";
                                                echo "<td>$r->date_created</td>";
                                                if($r->is_merge == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>MERGED</td>";
                                                }

                                                echo "<td>";
                                                if($r->locked == "0"){
                                                    echo "";
                                                }
                                                else{
                                                    echo "LOCKED";
                                                }
                                                echo "</td>";

                                                echo "<td>$r->id</td>";
                                                if($r->is_confirmed == "0"){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>COMFIRMED</td>";
                                                }

                                                echo "<td>₦".($this->admin_model->get_unpaid_gh_amount($r->amount, $r->id))."</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-danger btn-sm delete' id='$r->id'><i class='fa fa-trash'></i></button><br/>";
                                                if($r->is_confirmed == 0){
                                                    echo "<button class='btn btn-primary btn-sm confirm-gh' id='$r->id'>Confirm</button>";
                                                }
                                                else{
                                                    echo "<button class='btn btn-primary btn-sm unconfirm-gh' id='$r->id'>UnConfirm</button>";
                                                }

                                                if($r->is_merge == 0){
                                                    echo " <button class='btn btn-primary btn-sm merge-gh' id='$r->id'>Merge</button>";
                                                }
                                                else{
                                                    echo " <button class='btn btn-primary btn-sm unmerge-gh' id='$r->id'>UnMerge</button>";
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
                </div>
                <!-- GH Modal -->
                <div class="modal fade" id="modal-gh" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent remove-margin-b">
                                <div class="block-header bg-danger">
                                    <ul class="block-options">
                                        <li>
                                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">GH Form</h3>
                                </div>
                                <div class="block-content">
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Username</label>
                                                <select name="username" class="form-control">
                                                    <option></option>
                                                    <?php
                                                        $q = $this->db->query("SELECT * FROM users WHERE type='internal'");
                                                        foreach ($q->result() as $r) {
                                                            echo "<option value='$r->username'>$r->username</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Amount</label>
                                                <input type="number" name="amount" class="form-control">
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-effect-ripple btn-primary" name="reg_gh" value="Submit"/>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END GH Modal -->
                <!-- Reset Modal -->
                <div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent remove-margin-b">
                                <div class="block-header bg-danger">
                                    <ul class="block-options">
                                        <li>
                                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">Reset GH</h3>
                                </div>
                                <div class="block-content">
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label>Select Plan</label>
                                                <select name="amount" class="form-control">
                                                    <option value="10000">10,000</option>
                                                    <option value="20000">20,000</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12">
                                                <label>Select Internal Account</label>
                                                <select name="username" class="form-control">
                                                    <?php
                                                        $q = $this->db->query("SELECT * FROM users WHERE type='internal'");
                                                        foreach ($q->result() as $r) {
                                                            echo "<option value='$r->username'>$r->username</option><option></option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-effect-ripple btn-primary" name="reset_gh" value="Submit"/>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END Reset Modal -->