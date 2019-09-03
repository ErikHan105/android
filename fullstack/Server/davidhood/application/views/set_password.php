	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
	<script src="https://js.pusher.com/3.0/pusher.min.js" type="text/javascript"></script>


<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">    
<body style="background: #404040">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="modal-title">Set Password<a class="anchorjs-link" href="#modal-title"><span class="anchorjs-icon"></span></a></h4>
		</div>
		<div class="breadcrumb-line">
			
		</div>
		<div class="modal-body">

			<form class="form-horizontal" action="<?php echo base_url().'index.php/verify/update_password'; ?>" method="post">
				<?php if ($error == 'success') { ?>
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <p>Password has been updated successfully!</p>
                    </div>
				<?php } else if ($error != ''){ ?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<p><?php echo $error; ?></p>
					</div>
				<?php }
				if ($email != '') { ?>
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<label for="email" class="col-sm-3 control-label"><?php echo $email; ?></label>
						
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="confirm_password" name="conf_password" placeholder="Password" value="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-9">
						<button type="submit" class="btn btn-primary" style="width: 150px;">Update</button>
					</div>
				</div>
				<?php } ?>
			</form>
		</div>
	</div>
</div>
</body>
