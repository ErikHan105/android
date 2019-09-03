<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">All Tempos</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/logo.png" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Tempos</li>
							<li><?php switch ($click) {
								case 0:
									echo '3/4';
									break;
								case 1:
									echo '4/4';
									break;
								case 2:
									echo '6/4';
									break;
								case 3:
									echo '6/8';
									break;
								default:
									break;
							}; ?></li>
						</ul>
						<ul class="breadcrumb-elements">
							<li><a href="<?php echo base_url().'index.php/services/edit_tempo/new'; ?>"><i class="icon-pencil4 position-left"></i> New</a></li>
							
						</ul>
						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Clicks: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url().'index.php/services/go_tempos/0'; ?>" style="color: <?php if ($click == 0) echo 'black'; else echo 'lightgray'; ?>;">3/4</a>&nbsp; &nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url().'index.php/services/go_tempos/1'; ?>" style="color: <?php if ($click == 1) echo 'black'; else echo 'lightgray'; ?>;">4/4</a>&nbsp; &nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url().'index.php/services/go_tempos/2'; ?>" style="color: <?php if ($click == 2) echo 'black'; else echo 'lightgray'; ?>;">6/4</a>&nbsp; &nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url().'index.php/services/go_tempos/3'; ?>" style="color: <?php if ($click == 3) echo 'black'; else echo 'lightgray'; ?>;">6/8</a>
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
									<th>Player</th>
									<th>Name</th>
									<th>Click</th>
									<th style="display:none;"></th>
									<th style="display:none;"></th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                	for($i = 0; $i < count($data); $i++) {
										?><tr>
										<td ><?php echo $i+1; ?></td>												
										<td>
											<audio controls="" controlsList="nodownload">
		     									<source src="<?php echo base_url().'uploadAudio/tempo/'.$data[$i]['url']; ?>" type="audio/<?php echo $data[$i]['ext']; ?>">
												Your browser does not support the audio element.
											</audio>
										</td>
										<td ><?php echo $data[$i]['bpm']; ?> BPM</td>
										<td ><?php echo $data[$i]['click']; ?></td>
										<th style="display:none;"></th>
										<td style="display:none;"></td>
										<td class="text-center" >
											<ul class="icons-list" >
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="<?php echo base_url().'index.php/services/edit_tempo/edit/'.$data[$i]['id']; ?>"><i class="icon-eye2"></i>Edit</a></li>
														<li class="divider"></li>
														<li><a href="<?php echo base_url().'index.php/services/delete_tempo/'.$click.'/'.$data[$i]['id']; ?>"><i class="icon-cancel-circle2"></i> Delete</a></li>
													</ul>
												</li>
											</ul>
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
</body>

</html>
