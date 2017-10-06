                <script type="text/javascript">
                    //Ajax
                    $(document).ready(function () {
                        $(".delete").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var ph = $(this).attr('ph');
                            var gh = $(this).attr('gh');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'delete_merge', 'merge_id': id, 'ph_id':ph, 'gh_id':gh},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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
                        $(".confirm").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'confirm_merge', 'merge_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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
                        $(".unconfirm").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unconfirm_merge', 'merge_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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

                        $(".report").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna report this transaction?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'report', 'merge_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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

                        $(".unreport").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna Unreport this transaction?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'unreport', 'merge_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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

                        $(".on-auto").click(function(e){
                            
                            e.preventDefault();
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna on AutoMerge?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'onauto'},
                                    dataType : 'text',
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if(result == '1'){
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
                                        }
                                        else{
                                            alert("Operation Failed");
                                        }
                                    },
                                    error: function (xhr, desc, err) {
                                        alert("Fatal Error: Operation Failed");
                                    }
                                });//end ajax call
                            }
                        });
                        $(".force-merge").click(function(e){
                            
                            e.preventDefault();
                            $('#main-container').hide();
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna on force merge the system?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'force_merge'},
                                    dataType : 'text',
                                    success: function (data, status) {
                                        $('#main-container').show();
                                        var result = String(data);
                                        result = result.trim();

                                        if(result == '1'){
                                            alert("System Force Merge Successfully");
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
                                        }
                                        else if(result == 'no_gh'){
                                            alert("No Pending GH");
                                        }
                                        else if(result == 'no_ph'){
                                            alert("No Pending PH");
                                        }
                                        else{
                                            alert("Operation Failed");
                                        }
                                    },
                                    error: function (xhr, desc, err) {
                                        alert("Fatal Error: Operation Failed"+desc);
                                        $('#main-container').show();
                                    }
                                });//end ajax call
                            }
                            else{
                                $('#main-container').show();
                            }
                        });

                        $(".purge").click(function(e){
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna purge this transaction?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'purge', 'merge_id': id},
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if (result == "1") {
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
                                        }
                                        else if (result == "paid") {
                                            alert("Cant Purge user has already paid");
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
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

                        $(".off-auto").click(function(e){
                            
                            e.preventDefault();
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Are you sure you wanna off AutoMerge?");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'offauto'},
                                    dataType : 'text',
                                    success: function (data, status) {
                                        var result = String(data);
                                        result = result.trim();
                                        if(result == '1'){
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
                                        }
                                        else{
                                            alert("Operation Failed");
                                        }
                                    },
                                    error: function (xhr, desc, err) {
                                        alert("Fatal Error: Operation Failed");
                                    }
                                });//end ajax call
                            }
                        });
                        $(".send-sms").click(function (e) {
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var ph_id = $(this).attr('ph');
                            var gh_id = $(this).attr('gh');
                            var c_url = "<?php echo $this->config->base_url().'back/merge' ?>";
                            var con = confirm("Do You wanna send this sms??");
                            if(con){
                                $.ajax({
                                    url: c_url,
                                    type: 'post',
                                    data: {'action': 'send_sms', 'merge_id': id, 'ph_id': ph_id, 'gh_id': gh_id},
                                    success: function (data, status) {
                                        if (data = 1) {
                                            // alert('successful');
                                            window.location.href = "<?php echo $this->config->base_url().'back/merge' ?>";
                                        }
                                        else {
                                            alert('failed');
                                        }
                                    },
                                    error: function (xhr, desc, err) {
                                        alert(err);
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
                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">Merge List</h1>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- <button class='btn btn-success force-merge push-50-t'>Force Merge</button> -->
                                                <?php
                                                    if($this->admin_model->get_option("auto_merge")->value == 1){
                                                        echo " <button class='btn btn-danger off-auto push-50-t'>Off Auto Merge</button>";
                                                    }
                                                    else{
                                                        echo " <button class='btn btn-primary on-auto push-50-t'>On Auto Merge</button>";
                                                    }
                                                ?>
                                                <!-- <button class="btn btn-primary  push-50-t" href="#modal-merge" data-toggle="modal">Create New</button> -->
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Page Header -->
                    <div class="row">
                        <!-- Merge Modal -->
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('select').select2();
                            });
                        </script>
                        <!-- <div class="" id="modal-merge" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="block block-themed block-transparent remove-margin-b">
                                        <div class="block-header bg-danger">
                                            <ul class="block-options">
                                                <li>
                                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                                </li>
                                            </ul>
                                            <h3 class="block-title">Merge Form</h3>
                                        </div>
                                        <div class="block-content">
                                            <form action="" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label>Sender</label>
                                                        <select name="ph_id" style="width:100%;">
                                                            <option></option>
                                                            <?php
                                                                $q = $this->db->query("SELECT * FROM ph WHERE is_confirmed='0' AND hidden='0' ORDER BY id ASC");
                                                                foreach ($q->result() as $r) {
                                                                    $pleft = $this->admin_model->get_unpaid_ph_amount($r->amount, $r->id);
                                                                    if($pleft > 1){
                                                                        // echo "<option>i dey here</option>";
                                                                        echo "<option value='$r->id'>$r->trans_num = NGN$r->amount :: ".$r->username.":: Unpaid = ₦".($this->admin_model->get_unpaid_ph_amount($r->amount, $r->id))." ::: $r->date_created</option><option></option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label>Recipent</label>
                                                        <select name="gh_id" style="width:100%;">
                                                            <option></option>
                                                            <?php
                                                                $q = $this->db->query("SELECT * FROM gh WHERE is_confirmed='0' AND hidden='0' ORDER BY id ASC");
                                                                foreach ($q->result() as $r) {
                                                                    $rleft = $this->admin_model->get_unpaid_gh_amount($r->amount, $r->id);
                                                                    if($rleft > 1){
                                                                        echo "<option value='$r->id'>$r->trans_num = NGN$r->amount :: ".$r->username.":: Unpaid = ₦".($this->admin_model->get_unpaid_gh_amount($r->amount, $r->id))."::: $r->date_created</option><option></option>";
                                                                    }
                                                                    // echo "<option value='$r->id'>$r->trans_num = NGN$r->amount :: ".$r->username.":: Unpaid = ₦".($r->amount - $this->admin_model->get_unpaid_gh_amount($r->id))."::: $r->date_created</option><option></option>";
                                                                    
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
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label>Total Time(Hours)</label>
                                                        <input type="number" name="days" class="form-control">
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                        <input type="submit" class="btn btn-effect-ripple btn-primary" name="reg_merge" value="Submit"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div> -->
                        <!-- END Merge Modal -->
                    </div>

                    <!-- Page Content -->
                    <div class="content">
                        <!-- Full Table -->
                        <div class="block">
                            <div class="block-header">
                                <a href="<?php echo $this->config->base_url();?>back/merge" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
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
                                <?php 
                                    if(isset($_SESSION['notification'])){
                                        echo $_SESSION['notification'];
                                    }
                                ?>

                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-vcenter table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date Merged</th>
                                                <th>Merge ID</th>
                                                <th>Sender</th>
                                                <th>PH Trans Num</th>
                                                <th>Amount</th>
                                                <th>Recipent</th>
                                                <th>GH Trans Num</th>
                                                <th>Time given(HRS)</th>
                                                <th>Time Left</th>
                                                <th>Confirmation</th>
                                                <!-- <th>Report</th> -->
                                                <th>Date Paid</th>
                                                <th>Receipt</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sn = 1;
                                            echo "<p>".$list->num_rows()." Records Found<p>";
                                            
                                            foreach ($list->result() as $r) {
                                                echo "<tr class='info'>";
                                                echo "<td>$sn</td>";
                                                echo "<td>$r->date_created</td>";
                                                echo "<td>$r->id</td>";
                                                echo "<td>".$this->admin_model->get_ph($r->ph_id)->username."</td>";
                                                echo "<td>".$this->admin_model->get_ph($r->ph_id)->trans_num."</td>";
                                                echo "<td>₦$r->amount</td>";
                                                echo "<td>".$this->admin_model->get_gh($r->gh_id)->username."</td>";
                                                echo "<td>".$this->admin_model->get_gh($r->gh_id)->trans_num."</td>";
                                                $days = $r->days." hours";
                                                $time_out_date = date('Y-m-d H:i:s', strtotime($r->date_created. " + $days"));
                                                $time_out = $this->admin_model->get_date_diff($time_out_date, date("Y-m-d H:i:s"));
                                                echo "<td>$r->days Hours</td>";
                                                echo "<td>$time_out->hours Hours</td>";
                                                // auto purge
                                                // if($time_out->hours < 1 && $r->is_confirmed == 0){
                                                //     $payee = $this->admin_model->get_ph($r->ph_id)->username;
                                                //     //delete merge
                                                //     $this->db->query("DELETE FROM merge WHERE id='$r->id'");
                                                //     //delete ph
                                                //     $this->db->query("DELETE FROM ph WHERE id='$r->ph_id'");
                                                //     //unmerge gh
                                                //     $this->db->query("UPDATE gh SET is_merge='0' WHERE id='$r->gh_id'");
                                                //     // decrease gh counter
                                                //     $counter = $this->admin_model->get_gh($r->gh_id)->counter - 1;
                                                //     $this->db->query("UPDATE gh SET counter='$counter' WHERE id='$r->gh_id'");
                                                // }
                                                $d1= date('Y-m-d H:i:s');
                                                if($r->is_confirmed == 0){
                                                    echo "<td></td>";
                                                }
                                                else{
                                                    echo "<td>Confirmed</td>";
                                                }

                                                // if($r->is_report == 0){
                                                //     echo "<td></td>";
                                                // }
                                                // else{
                                                //     echo "<td>REPORTED</td>";
                                                // }
                                                
                                                echo "<td>$r->date_paid</td>";
                                                if($r->receipt == ''){
                                                    echo "<td>NO RECEIPT</td>";
                                                }
                                                else{
                                                    echo "<td><a href='".$this->config->item('assets_url')."/pop/$r->receipt' target='_blank'><img src='".$this->config->item('assets_url')."/pop/$r->receipt' class='img-thumbnail pull-right' width='100' height='100'></a></td>";   
                                                }

                                                echo "<td>$r->date_created</td>";
                                                
                                                echo "<td><button class='btn btn-danger delete' id='$r->id' ph='$r->ph_id' gh='$r->gh_id'>Delete</button></td>";
                                                echo "<td><button class='btn btn-warning purge' id='$r->id'>purge</button></td>";
                                                // if($r->is_blocked == 0){
                                                //     echo "<td><button class='btn btn-danger block-merge' id='$r->id'>Block</button></td>";
                                                // }
                                                // else{
                                                //     echo "<td><button class='btn btn-danger unblock-merge' id='$r->id'>unBlock</button></td>";
                                                // }
                                                if($r->is_confirmed == 0){
                                                    echo "<td><button class='btn btn-success confirm' id='$r->id'>confirm</button></td>";
                                                }
                                                else{
                                                    echo "<td><button class='btn btn-danger unconfirm' id='$r->id'>unconfirm</button></td>";
                                                }

                                                // if($r->is_report == 0){
                                                //     echo "<td><button class='btn btn-success report' id='$r->id'>Report</button></td>";
                                                // }
                                                // else{
                                                //     echo "<td><button class='btn btn-success unreport' id='$r->id'>unreport</button></td>";
                                                // }
                                                // echo "<td><button class='btn btn-primary send-sms btn-sm' id='$r->id' ph='$r->ph_id' gh='$r->gh_id'>Send SMS</button></td>";
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
                