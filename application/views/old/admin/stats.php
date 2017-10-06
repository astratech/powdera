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
                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">Site Total Stats</h1>
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
                    <div class="content row">
                        <!-- Full Table -->
                       
                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total Num of Users</h3>
                                </div>
                                <div class="panel-body">
                                    <h2><?php echo $this->admin_model->admin_get_total_users(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total PH amount</h3>
                                </div>
                                <div class="panel-body">
                                    <h2>₦ <?php echo $this->admin_model->admin_get_total_ph(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total GH amount</h3>
                                </div>
                                <div class="panel-body">
                                    <h2>₦ <?php echo $this->admin_model->admin_get_total_gh(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total Merged</h3>
                                </div>
                                <div class="panel-body">
                                    <h2>₦ <?php echo $this->admin_model->admin_get_total_merged(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total PH UnMerged</h3>
                                </div>
                                <div class="panel-body">
                                    <h2>₦ <?php echo $this->admin_model->admin_get_total_ph_unmerged(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-primary text-center">
                                <div class="panel-heading">
                                    <h3>Total GH UnMerged</h3>
                                </div>
                                <div class="panel-body">
                                    <h2>₦ <?php echo $this->admin_model->admin_get_total_gh_unmerged(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <!-- END Full Table -->
                    </div>
                    <!-- END Page Content -->
                </main>
                <!-- END Main Container -->
                </div>s