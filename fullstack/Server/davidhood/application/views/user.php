<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Users</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url().LOGO_URL;?>" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Users</li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Users</h5>
							<?php if ($error != "") { ?>
								<div class="alert alert-primary no-border">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<span class="text-semibold"><?php echo $error; ?></span>
						    	</div>
							<?php } ?>
							
							
						</div>

						<table class="table datatable-show-all">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Birth Date</th>
									<th>Address</th>
									<th>City</th>
									<th>Postal Code</th>
									<th>IBAN</th>
									<th>Gained CHF</th>
									<th>Paid CHF</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                	for($i = 0; $i < count($data); $i++) {
										?><tr>
										<td ><?php echo $i+1; ?></td>	
										<td >
											<?php if ($data[$i]['lang'] == 'french') {?>
											<img src="<?php echo base_url().'uploadImages/admin/french.png';?>" style="width:17px; height: 17px;" />
											<?php } else { ?>
											<img src="<?php echo base_url().'uploadImages/admin/deutsch.png';?>" style="width:17px; height: 17px;" />
											<?php } ?><br>
											<?php echo $data[$i]['first_name'].' '.$data[$i]['last_name']; ?>
										</td>	
										<td><?php echo $data[$i]['email']; ?></td>
										<td><?php echo $data[$i]['birth_date']; ?></td>
										<td><?php echo $data[$i]['address']; ?></td>
										<td><?php echo $data[$i]['city']; ?></td>
										<td><?php echo $data[$i]['postal_code']; ?></td>
										<td><?php echo $data[$i]['iban']; ?></td>
										<td style="text-align: center;"><?php echo $data[$i]['price']; ?></td>
										<td style="text-align: center;"><?php echo $data[$i]['paid']; ?></td>
										<td style="text-align: center;"><a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal_default_<?php echo $i;?>">Remove <i class="icon-cancel-circle2 position-right"></i></a>
													<div id="modal_default_<?php echo $i;?>" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<h2 class="panel-title">Warning</h2>
																</div>
																<div class="modal-body">
																			<p>Are you sure to delete this item?</p>
																</div>
																<div class="modal-footer">
																	<div class="row">
																		<div class="col-md-12 text-right">
																			<a class="btn btn-primary" href="<?php echo base_url().'main/delete/tbl_user/'.$data[$i]['id']; ?>" >Confirm</a>
																			<a class="btn btn-default" data-dismiss="modal">Cancel</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div><br><br>
											<a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal_edit_<?php echo $i;?>">Edit <i class="icon-pencil5 position-right"></i></a>
													<div id="modal_edit_<?php echo $i;?>" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
														<form action="<?php echo base_url().'main/reset_password'; ?>" method="POST">
														<div class="modal-dialog">
															<div class="modal-content">
																
																<div class="modal-header">
																	<h2 class="panel-title">Edit User Info</h2>
																</div>
																<div class="modal-body" style="text-align:  left;">
																			
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>Email</LABEL>
																							<input type="text" name="email" value="<?php echo $data[$i]['email']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>Address</LABEL>
																							<input type="text" name="address" value="<?php echo $data[$i]['address']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>City</LABEL>
																							<input type="text" name="city" value="<?php echo $data[$i]['city']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>Postal Code</LABEL>
																							<input type="text" name="postal_code" value="<?php echo $data[$i]['postal_code']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>IBAN</LABEL>
																							<input type="text" name="iban" value="<?php echo $data[$i]['iban']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																				<div class="form-group">
																					<div class="row">
																						<div class="col-md-12">
																							<LABEL>Password</LABEL>
																							<input type="hidden" name="id" value="<?php echo $data[$i]['id']; ?>">
																							<input type="text" name="password" value="<?php echo $data[$i]['password']; ?>" class="form-control" required>
																						</div>
																					</div>
																				</div>  
																</div>
																<div class="modal-footer">
																	<div class="row">
																		<div class="col-md-12 text-right">
																			<button type="submit" class="btn btn-primary" >Reset</button>
																			<a class="btn btn-default" data-dismiss="modal">Cancel</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														</form>
													</div>
										</td>
										</tr>
										<?php
									} 
                            	?>
								
							</tbody>
						</table>
					</div>
					<!-- /page length options -->
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
				<div id="modal_default" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Basic modal</h5>
								<button type="button" class="close" data-dismiss="modal">×</button>
							</div>

							<div class="modal-body">
								<h6 class="font-weight-semibold">Text in a modal</h6>
								<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

								<hr>

								<h6 class="font-weight-semibold">Another paragraph</h6>
								<p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
								<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close<div class="legitRipple-ripple" style="left: 58.7583%; top: 67.3684%; transform: translate3d(-50%, -50%, 0px); width: 225.286%; opacity: 0;"></div><div class="legitRipple-ripple" style="left: 48.3881%; top: 69.4737%; transform: translate3d(-50%, -50%, 0px); width: 225.286%; opacity: 0;"></div><div class="legitRipple-ripple" style="left: 36.9265%; top: 48.9474%; transform: translate3d(-50%, -50%, 0px); width: 225.286%; opacity: 0;"></div></button>
								<button type="button" class="btn bg-primary legitRipple">Save changes</button>
							</div>
						</div>
					</div>
				</div>
	<!-- <?php echo base_url().'main/delete/tbl_user/'.$data[$i]['id']; ?> -->
</body>
<script type="text/javascript">

</script>
</html>
