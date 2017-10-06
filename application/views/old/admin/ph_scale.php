                <script type="text/javascript">



                    //Ajax



                    $(document).ready(function () {



                        $(".delete").click(function(e){



                            e.preventDefault();



                            var id = $(this).attr('id');



                            var ph = $(this).attr('ph');



                            var gh = $(this).attr('gh');



                            var c_url = "<?php echo $this->config->base_url().'adam/merge' ?>";



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



                                            window.location.href = "<?php echo $this->config->base_url().'adam/merge' ?>";



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



                            var c_url = "<?php echo $this->config->base_url().'adam/ph' ?>";



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



                                            window.location.href = "<?php echo $this->config->base_url().'adam/ph' ?>";



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



                            var c_url = "<?php echo $this->config->base_url().'adam/ph' ?>";



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



                                            window.location.href = "<?php echo $this->config->base_url().'adam/ph' ?>";



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



                                                <h1 class="h1 font-w300 text-white animated fadeInDown push-50-t push-5">PH Scale</h1>



                                            </div>



                                            <div class="col-sm-6">



                                                <button class="btn btn-primary pull-right push-50-t"5 href="#modal-merge" data-toggle="modal">Select PH</button>



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



                                <a href="<?php echo $this->config->base_url();?>adam/scale/ph" class="btn btn-primary"><i class="fa fa-refresh"></i></a>



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



                                                <th>Sender</th>



                                                <th>PH Trans Num</th>



                                                <th>Amount</th>



                                                <th>Recipent</th>



                                                <th>GH Trans Num</th>



                                                <th>Time given</th>



                                                <th>Time Left</th>



                                                <th>Blocked</th>



                                                <th>Confirmation</th>



                                                <th>Date Paid</th>



                                                <th>Receipt</th>



                                                <th>Action</th>



                                            </tr>



                                        </thead>



                                        <tbody>



                                        <?php



                                            $sn = 1;



                                            $total_merge = 0;



                                            $merge_paid = 0;



                                            $ph_amount = $this->admin_model->get_ph($ph_id)->amount;



                                            echo "PH TRANSACTION NUMBER ".$this->admin_model->get_ph($ph_id)->trans_num."<br/>";



                                            if(empty($list_err)){



                                                foreach ($list->result() as $r) {



                                                    echo "<tr class='info'>";



                                                    $total_merge = $r->amount + $total_merge;



                                                    echo "<td>$sn</td>";



                                                    echo "<td>$r->date_created</td>";



                                                    echo "<td>".$this->admin_model->get_ph($r->ph_id)->username."</td>";



                                                    echo "<td>".$this->admin_model->get_ph($r->ph_id)->trans_num."</td>";



                                                    echo "<td>$r->amount</td>";



                                                    echo "<td>".$this->admin_model->get_gh($r->gh_id)->username."</td>";



                                                    echo "<td>".$this->admin_model->get_gh($r->gh_id)->trans_num."</td>";



                                                    $days = $r->days." hours";



                                                    $time_out_date = date('Y-m-d H:i:s', strtotime($r->date_created. " + $days"));



                                                    $time_out = $this->admin_model->get_date_diff($time_out_date, date("Y-m-d H:i:s"));



                                                    echo "<td>$r->days</td>";



                                                    echo "<td>$time_out->hours</td>";



                                                    $d1= date('Y-m-d H:i:s');



                                                    if($r->is_blocked == 0){



                                                        echo "<td></td>";



                                                    }



                                                    else{



                                                        echo "<td>Blocked</td>";



                                                    }



                                                    if($r->is_confirmed == 0){



                                                        echo "<td></td>";



                                                    }



                                                    else{



                                                        echo "<td>Confirmed</td>";



                                                        $merge_paid = $r->amount + $merge_paid;



                                                    }



                                                    echo "<td>$r->date_paid</td>";



                                                    echo "<td><a href='".$this->config->item('assets_url')."/pop/$r->receipt' target='_blank'><img src='".$this->config->item('assets_url')."/pop/$r->receipt' class='img-thumbnail pull-right' width='100' height='100'></a></td>";



                                                    echo "<td><button class='btn btn-danger delete' id='$r->id' ph='$r->ph_id' gh='$r->gh_id'>Delete</button></td>";



                                                   



                                                    $sn++;



                                                }



                                                    echo "</tr>";



                                                    echo "<tr>";



                                                    echo "<td></td>";



                                                    echo "<td></td>";



                                                    echo "<td>PH Amount = $ph_amount</td>";



                                                    echo "<td>Amount Merged = $total_merge</td>";



                                                    echo "<td>Merge Paid = $merge_paid</td>";



                                                    echo "<td>Amount Left to merge = ".($ph_amount - $total_merge)."</td>";



                                                    echo "</tr>";



                                            }



                                            else{



                                                echo "No record Found";



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







                <!-- Merge Modal -->



                <div class="modal fade" id="modal-merge" tabindex="-1" role="dialog" aria-hidden="true">



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



                                                <label>PH</label>



                                                <select name="ph_trans_num" class="form-control">



                                                    <option></option>



                                                    <?php



                                                        $q = $this->db->query("SELECT * FROM ph ORDER BY id DESC");



                                                        foreach ($q->result() as $r) {



                                                            echo "<option value='$r->trans_num'>$r->trans_num = NGN$r->amount :: ".$r->username."</option>";



                                                        }



                                                    ?>



                                                </select>



                                            </div>



                                        </div>



                                </div>



                            </div>



                            <div class="modal-footer">



                                <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Cancel</button>



                                <input type="submit" class="btn btn-effect-ripple btn-primary" name="scale" value="Submit"/>



                            </div>



                        </div>



                        </form>



                    </div>



                </div>



                <!-- END Merge Modal -->