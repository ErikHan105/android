
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Profile</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url().LOGO_URL;?>" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Profile</li>
							
						</ul>
					</div>
				</div>
					<!-- /header -->

						<?php if ($error != "") { ?>
							<div class="alert <?php if(strpos($error, 'uccessfully') !== false) echo 'alert-primary'; else echo 'alert-danger'; ?> no-border">
								<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
								<span class="text-semibold"><?php echo $error; ?></span>
					    	</div>
						<?php } ?>
				<!-- Content area -->
				<div class="content">

					<!-- User profile -->
					<div class="row">
						<div class="col-lg-12">
							<div class="tabbable">
								<div class="tab-content">

									<div class="tab-pane fade active in" id="settings">

										<!-- Profile info -->
										<div class="panel panel-flat col-md-6">
											<div class="panel-heading">
												<h6 class="panel-title">Profile information</h6>
												
											</div>

											<div class="panel-body">
												<form action="<?php echo base_url().'index.php/admin/update_admin'; ?>" method="POST">
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Email*</label>
																<input type="text" name="email" value="<?php echo $email; ?>" class="form-control" required>
															</div>
															
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Password*</label>
																<input type="text" name="password" value="<?php echo $password; ?>" class="form-control" required>
															</div>
															
														</div>
													</div>  
													
							                        <div class="text-right">
								                        <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
							                        </div>
												</form>
											</div>
										</div>
										<!-- /profile info -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user profile -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
