<link href="<?php echo base_url(); ?>assets/loader/dist/loading.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/loader/dist/jquery.loading.min.js"></script>

<style type="text/css">
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add Advertisement</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url().LOGO_URL;?>" alt="" style="width:50px; height:50px; margin-right:20px;">		
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li>Add Advertisement</li>
						</ul>
					</div>
				</div>
					<!-- /header -->

						<?php if ($error != "") { ?>
							<div class="alert <?php if(strpos($error, 'Successfully') !== false) echo 'alert-primary'; else echo 'alert-danger'; ?> no-border">
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
										<div class="panel panel-flat col-md-12">
											<div class="panel-heading">
												<h6 class="panel-title">Advertisement information</h6>
												
											</div>

											<div class="panel-body">
												<form action="<?php echo base_url().'main/do_add_advertisement'; ?>" method="POST">
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>Language*</label>
 																<select name="lang" data-placeholder="Select language..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																	<option></option>
																		<option value="french" <?php if($data['lang'] == 'french'){ ?> selected="selected" <?php } ?>>French</option>
																		<option value="deutsch" <?php if($data['lang'] == 'deutsch'){ ?> selected="selected" <?php } ?>>Deutsch</option>
																</select>
																<br><br>
																<label>Title*</label>
																<input type="text" name="title" value="<?php echo $data['title']; ?>" class="form-control" placeholder="title" required>
																<br>
																<label>Public Url (from Google Drive)*</label>
																<input type="text" name="url" value="<?php echo $data['url']; ?>" class="form-control" placeholder="https://drive.google.com/open?id=xxx" required>
																<br>
																<label>Price(CHF)*</label>
																<input type="number" name="price" value="<?php echo $data['price']; ?>" class="form-control" placeholder="0.01" step="any" min="0.01" required>
																<br>
																<label>Company Url*</label>
																<input type="text" name="company_url" value="<?php echo $data['company_url']; ?>" class="form-control" placeholder="http(s)://" required>
															</div>
															<div class="col-md-6">
																<label>Description*</label>
																<textarea name="description" value="" class="form-control" rows="5" required><?php echo $data['description']; ?></textarea>
																<br>
																<label style="margin-top: 3px;">View Type*</label>
 																<select name="type" data-placeholder="Select type..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" onchange="getType(this)">
																	<option></option>
																		<option value="once" <?php if($data['type'] == 'once'){ ?> selected="selected" <?php } ?>>ONCE</option>
																		<option value="multi" <?php if($data['type'] == 'multi'){ ?> selected="selected" <?php } ?>>MULTI</option>
																</select>
																<div id="div_cnt">
																	<br>
																	<label>Max Views*</label>
																	<input id="input-cnt" type="number" name="cnt" value="<?php echo $data['cnt']; ?>" class="form-control" placeholder="1" step="1" min="1" required <?php if ($data['type'] == 'once') echo 'disabled'; ?>>
																</div>
																<br>
																<label>Limit Views*</label>
																<input type="number" name="limits" value="<?php echo $data['limits']; ?>" class="form-control" placeholder="1" step="1" min="1" required>
															</div>
														</div>
														<hr style="border-color: #3097c7; border-bottom-width: 5px; border-style: double;" />
														<div class="row">
															<div class="container" style="background: #9fdac7; padding: 15px;">
																<label>Question</label>
																<textarea name="question" class="form-control" placeholder="write a short question here..." ><?php echo $data['question'];?></textarea>
																<br>
																<label>Answer</label>
																<table class="table table-bordered table-hover" id="tab_logic">
																	<thead>
																		<tr >
																			<th class="text-center">
																				No
																			</th>
																			<th class="text-center">
																				Answer
																			</th>
																			<th class="text-center">
																				isRight?
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php for($i = 0; $i < count($answer); $i++) { ?>
																		<tr id='addr0'>
																			<td style="width: 30px;">
																			<?php echo $i+1; ?>
																			</td>
																			<td>
																			<input type="text" name='answer<?php echo $i;?>' placeholder='write an answer here...' class="form-control" value="<?php echo $answer[$i]['answer'];?>" />
																			</td>
																			<td style="width: 30px;">
																				<input type="checkbox" name="check<?php echo $i;?>"  class="form-control" 
																				<?php if($answer[$i]['isright'] == 1) { echo 'checked'; }?>

																				>
																			</td>
																		</tr>
																		<?php } ?>
													                    <tr id='addr1'></tr>
																	</tbody>
																</table>
																<br>
																<a id="add_row" class="btn btn-default pull-left">Add Answer</a><a id='delete_row' class="pull-right btn btn-default">Delete Answer</a>
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

	</div>
	<!-- /page container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_inputs.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_select2.js"></script>
	<script type="text/javascript">
		function getType(selectObject) {
		    var value = selectObject.value;  
		    if (value == 'once') {
		    	document.getElementById("input-cnt").disabled = true;
		    } else {
		    	document.getElementById("input-cnt").disabled = false;
		    }
		}

		$(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='answer"+i+"' type='text' placeholder='write your answer here...' class='form-control input-md'  /> </td><td><input name='check"+i+"' type='checkbox' class='form-control'  /> </td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});
	</script>

</body>
</html>
