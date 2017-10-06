
<?php
	$staff = $this->site_model->get_staff($this->staff_id);
?>
<!--main content start-->
<div id="content" class="ui-content ui-content-aside-overlay">
	<div class="ui-content-body">

		<div class="ui-container">

			<!--page title and breadcrumb start -->
			<div class="row">
				<div class="col-md-8">
					<h1 class="page-title">
						My Profile 
					</h1>
				</div>
				<div class="col-md-4">
					<ul class="breadcrumb pull-right">
						<li>Support Staff</li>
						<li>My Profile</li>

					</div>
				</div>
				<!--page title and breadcrumb end -->


				<div class="row">
					<div class="col-md-6">
						<section class="panel">
							<div class="panel-body">
								<div class="col-md-12">
									
									<form class="form-horizontal dform" action="" method="POST">
										<div class="row">
											<div class="form-group">

												<div class="col-xs-3">
													<label>Title</label>
													<input type="text" class="form-control" value="<?php echo $staff->title; ?>" disabled>
												</div>

												<div class="col-xs-9">
													<label>Full Name</label>
													<input type="text" class="form-control" value="<?php echo $staff->fullname; ?>" disabled>
												</div>
											</div>


											<div class="form-group col-xs-12">
												<label>Email</label>
												<input type="text" class="form-control" value="<?php echo $staff->email; ?>" disabled>
											</div>

											<div class="form-group col-xs-12">
												<label>Mobile</label>
												<input type="text" class="form-control" value="<?php echo $staff->mobile; ?>" disabled>
											</div>

											<div class="form-group col-xs-12">
												<label>Suppervisor</label>
												<input type="text" class="form-control" value="<?php echo $staff->supervisor_staff_id; ?>" disabled>
											</div>
											
											<div class="form-group col-xs-12">
												<!-- <input type="submit" name="create_leave" class="btn btn-primary" value="Send"> -->
											</div>
										</div>
										
									</form>
								</div>
							</div>
						</section>
					</div>

					<div class="col-md-6">
						<section class="panel">
							<div class="panel-heading">
								<p>Change Password</p>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<?php 
										if(isset($_SESSION['notification'])){

											echo $_SESSION['notification'];

										}
									
									?>
									<form class="form-horizontal dform" action="" method="POST">
										<div class="row">
											<div class="form-group">

												<div class="col-xs-12">
													<label>New Password</label>
													<input type="password" class="form-control" name="password">
												</div>

												<div class="col-xs-12">
													<label>Retype Password</label>
													<input type="password" class="form-control" name="r_password">
												</div>
											</div>
											
											<div class="form-group col-xs-12">
												<input type="submit" name="change_password" class="btn btn-primary" value="Submit">
											</div>
										</div>
										
									</form>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--main content end-->


