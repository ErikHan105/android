<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Advertisements</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url().LOGO_URL;?>" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Advertisements</li>
						</ul>
						<ul class="breadcrumb-elements">
							<li><a href="<?php echo base_url().'main/add_advertisement'; ?>"><i class="icon-pencil4 position-left"></i> New</a></li>
							
						</ul>
						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Advertisements &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="<?php echo base_url().'main/advertisement/french';?>">
									<?php if ($_SESSION[SITE]['lang'] == 'french') { ?>
									<img src="<?php echo base_url().'uploadImages/admin/fr1.png';?>" style="width:60px; height: 20px; vertical-align: middle;" />
									<?php } else { ?>
									<img src="<?php echo base_url().'uploadImages/admin/fr.png';?>" style="width:60px; height: 20px; vertical-align: middle;" />
									<?php } ?>
								</a>
								&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
								<a href="<?php echo base_url().'main/advertisement/deutsch';?>">
									<?php if ($_SESSION[SITE]['lang'] == 'deutsch') { ?>
									<img src="<?php echo base_url().'uploadImages/admin/de1.png';?>" style="width:60px; height: 20px; vertical-align: middle;" />
									<?php } else { ?>
									<img src="<?php echo base_url().'uploadImages/admin/de.png';?>" style="width:60px; height: 20px; vertical-align: middle;" />
									<?php } ?>
								</a>
							</h5>
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
									<th>Preview</th>
									<th>Detail</th>
									<th>Price(CHF)</th>
									<th>View Type</th>
									<th>Max Views</th>
									<th>Limit Views</th>
									<th>Remain Views</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                	for($i = 0; $i < count($data); $i++) {
										?><tr <?php if($data[$i]['remains'] == 0) {?> style="background: #dbdcdb;"<?php }?>>
										<td ><?php echo $i+1; ?></td>												
										<td>
											<video src="<?php echo $data[$i]['download']; ?>" style="width: 200px; height: 140px;" controls >HTML5 Video is required.</video>
										</td>
										<td >
											<p><b><?php echo $data[$i]['title']; ?></b></p>
											<?php echo $data[$i]['description']; ?>
										</td>
										<td ><?php echo $data[$i]['price']; ?></td>
										<td >
											<span class="label bg-<?php if($data[$i]['type'] == 'once') echo 'blue'; else echo 'orange'; ?>-400"><?php echo $data[$i]['type']; ?></span>
										</td>
										<td ><?php echo $data[$i]['cnt']; ?></td>
										<td ><?php echo $data[$i]['limits']; ?></td>
										<td ><?php echo $data[$i]['remains']; ?></td>
										<td><a href="<?php echo base_url().'main/delete/tbl_advertise/'.$data[$i]['id']; ?>" class="btn btn-default" >Remove <i class="icon-cancel-circle2 position-right"></i></a></td>
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
