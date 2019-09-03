<?php if (!isset($_SESSION[SITE])) { ?>
	<meta http-equiv="refresh" content="0; url=<?php echo base_url(); ?>" />
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SITE;?></title>
	<link rel="shortcut icon" href="<?php echo base_url().LOGO_URL;?>">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/visualization/echarts/echarts.js"></script>
	

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/autosize.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/typeahead/handlebars.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/passy.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/inputs/maxlength.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/notifications/sweet_alert.min.js"></script>


	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/app.js"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_advanced.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/components_modals.js"></script>

	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<span><?php echo 'Account'; ?></span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?php echo base_url().'admin/go_edit'; ?>"><i class="icon-user"></i> My profile</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url(); ?>login/do_logout"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left">
									<img src="<?php echo base_url(); ?>uploadImages/admin/admin.png" alt="">
								</a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo SITE;?></span>
									<div class="text-size-mini text-muted">
										<i class="text-size-small"></i> &nbsp;Administrator
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Dashboard -->
								<!-- <li <?php if ($active == 'dashboard') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url(); ?>main"><i class="icon-home4"></i> <span>Dashboard</span></a>
								</li> -->

								<!-- Main -->
								<li class="navigation-header"><span>Manage</span> <i class="icon-menu" title="Main pages"></i></li>
								<li <?php if ($active == 'advertisement') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url().'main/advertisement/'.$_SESSION[SITE]['lang'];?>"><i class="icon-list"></i> <span>Advertisements</span></a>
								</li>

								<li <?php if ($active == 'user') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url(); ?>main/user"><i class="icon-user"></i> <span>Users</span></a>
								</li>

								<li <?php if ($active == 'purchase') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url(); ?>main/purchase"><i class="icon-cart2"></i> <span>Asks for Transfer</span></a>
								</li>
								<li <?php if ($active == 'question') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url(); ?>main/question"><i class="icon-book"></i> <span>Questions</span></a>
								</li>
								<li <?php if ($active == 'payment_made') { ?> class="active" <?php }?> >
									<a href="<?php echo base_url(); ?>main/payment_made"><i class="icon-book"></i> <span>Payment Made</span></a>
								</li>
							
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->

<!--
1.Anyway Admin should have all the rights Operators have and have detailed statistics on total users, total operators,
 total projects, total projects per Operator, total projects per category, total featured projects and
 also total featured projects per Operator
2.Also Admin can set project as featured project
3.Admin can block a member, delete user account
-->