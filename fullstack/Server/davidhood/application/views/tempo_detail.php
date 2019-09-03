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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tempo Deatil</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/logo.png" alt="" style="width:50px; height:50px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Manage</li>
							<li><?php echo $page_type.' tempo'; ?></li>
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
												<h6 class="panel-title">Tempo information</h6>
												
											</div>

											<div class="panel-body">
												<form action="<?php echo base_url().'index.php/services/update_tempo'; ?>" method="POST">
													<div class="form-group">
														<div class="row">
															<div class="col-md-3">
																<label>BPM*</label>
																<input type="number" name="bpm" min="50" max="200" value="<?php echo $data['bpm']; ?>" class="form-control" required>
																<br>
															</div>
															<div class="col-md-9" style="left:20px;">
																<label class="display-block ">Click*</label>
																<label class="radio-inline" style="left:20px;">
																	<input type="radio" name="click" class="styled" <?php if ($data['click'] == '3/4') { ?> checked="checked" <?php } ?> value="3/4">
																	3/4
																</label>
																<label class="radio-inline" style="left:20px;">
																	<input type="radio" name="click" class="styled" <?php if ($data['click'] == '4/4') { ?> checked="checked" <?php } ?> value="4/4">
																	4/4
																</label>
																<label class="radio-inline" style="left:20px;">
																	<input type="radio" name="click" class="styled" <?php if ($data['click'] == '6/4') { ?> checked="checked" <?php } ?> value="6/4">
																	6/4
																</label>
																<label class="radio-inline" style="left:20px;">
																	<input type="radio" name="click" class="styled" <?php if ($data['click'] == '6/8') { ?> checked="checked" <?php } ?> value="6/8">
																	6/8
																</label>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-12">
																<label>Tempo audio*</label><br>
																<audio id="audio_master" controls="" controlsList="nodownload">
							     									<source src="<?php echo base_url().'uploadAudio/tempo/'.$data['url']; ?>" type="audio/<?php echo $data['ext']; ?>">
																	Your browser does not support the audio element.
																</audio>
																<br>
																<label for="input_master_file" class="custom-file-upload"><i class="icon-upload"></i>&nbsp; Audio Upload </label>&nbsp; <label id="label_master"></label>
																<input type="file" id="input_master_file" name="input_master_file" accept="audio/*"/>
                                            					<input type="hidden" id="input_master" name="url" value="<?php echo $data['url']; ?>" required/>
                                            					<input type="hidden" id="input_master_ext" name="ext" value="<?php echo $data['ext']; ?>" required/>
                                            					<input type="hidden" id="input_master_duration" name="duration" value="<?php echo $data['duration']; ?>" required/>
															</div>
														</div>
													</div>
													<input type="text" name="id" style="display:none;" value="<?php echo $data['id'] ?>">
													<input type="text" name="page_type" style="display:none;" value="<?php echo $page_type ?>">
													
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
<script>
	$(function(){
		$("#input_master_file").on('change',function(){	    
			var filename = $(this).val().split('\\').pop();
			var fd = new FormData();
			var _this = $(this);
			if (!this.files[0]) {return;};
			if (this.files[0].size > <?php echo MAX_AUDIO_SIZE; ?>) {alert('Audio file size should be less than 20MB.'); return;};
	        fd.append( "file", this.files[0]);
	        $.showLoading({name: 'circle-fade',allowHide: false});
	        $.ajax({
	            url: "<?php echo base_url().'index.php/services/tempo_upload/' ?>",
	            type: 'POST',
	            cache: false,
	            data: fd,
	            processData: false,
	            contentType: false,
	            beforeSend: function () {
	            },
	            success: function (result) { 
	            $.hideLoading({name: 'circle-fade',allowHide: false});
	            	if (result != 400) {	
	            		$("#label_master").text(filename);				
	            		var path = "<?php echo base_url().'uploadAudio/tempo/'; ?>" + result;
	            		var ext = result.split('.').pop();
	            		$("#audio_master").stop();
	            		$('#audio_master').children("source").attr('src', path);
	            		$('#audio_master').children("source").attr('type', 'audio/'+ext);
	            		$("#audio_master").load();
	            		$('#input_master').val(result);
	            		$('#input_master_ext').val(ext);
	            	} else {
	            		alert("upload failed!");
	            	}
	            },
	            complete: function (result) {
	            },
	            error: function (result) {
	            }
	        });	    
		});
		
		$("audio").on("canplaythrough", function(e){
		    var duration = Math.round(e.currentTarget.duration);
		    $('#input_master_duration').val(duration);
		});
	});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_inputs.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/form_select2.js"></script>
</body>
</html>
