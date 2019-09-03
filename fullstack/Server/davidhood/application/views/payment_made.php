<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Asks for Transfer</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url().LOGO_URL;?>" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Asks for Transfer</li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Payment Made</h5>
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
									<th>User</th>
									<th>Asked CHF</th>
									<th>IBAN</th>
									<th>Status</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                	for($i = 0; $i < count($data); $i++) {
                                		if ($data[$i]['status'] == 0) { continue; } ?>
										<tr >
										<td ><?php echo $i+1; ?></td>	
										<td ><?php echo $data[$i]['user']['email']; ?></td>	
										<td><?php echo $data[$i]['price']; ?></td>
										<td><?php echo $data[$i]['user']['iban']; ?></td>
										<td><span class="label bg-blue-400">paid</span></td>
										<td><?php echo $data[$i]['date']; ?></td>
										<td><a href="<?php echo base_url().'main/delete/tbl_purchase/'.$data[$i]['id']; ?>" class="btn btn-default" >Remove <i class="icon-cancel-circle2 position-right"></i></a></td>
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

</body>

</html>
