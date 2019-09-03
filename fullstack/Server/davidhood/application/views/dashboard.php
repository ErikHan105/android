<style>
.statictics {
    text-decoration: underline;
}
.statictics:hover {
    color: black;
}
</style>

<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Statistics</span></h4>
						</div>
						<div class="heading-elements">						
							<img src="<?php echo base_url(); ?>uploadImages/admin/title.png" alt="" style="width:70px; height:30px; margin-right:20px;">	
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><i class="icon-home2 position-left"></i> Dashboard</li>
							<li>Statistics</li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">

					<!-- Users stats -->
					<div class="row">
						
						<div class="col-lg-10">

							<div class="panel panel-flat">
								<br>
								<div id="container" style="height:400px !important;"></div>
									<div style="width: 100px; height: 20px; margin-top: -22px; background: white; position: absolute; right: 13px;"> </div>
    								<div class="container-fluid">
									<div class="row text-center">
										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?php echo $data['video'][0]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_videos/daily'; ?>"><span class="text-muted text-size-small statictics">Videos today</span></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar22 position-left text-slate"></i> <?php echo $data['video'][1]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_videos/weekly'; ?>"><span class="text-muted text-size-small statictics">Videos this week</span></a>
											</div>
										</div>

										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> <?php echo $data['video'][2]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_videos/monthly'; ?>"><span class="text-muted text-size-small statictics">Videos this month</span></a>
											</div>
										</div>

										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-playlist position-left text-slate"></i> <?php echo $data['video'][3]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_videos'; ?>"><span class="text-muted text-size-small statictics">Videos total</span></a>
											</div>
										</div>
									</div>
									<br>
									<div class="row text-center">
										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> <?php echo $data['purchase'][0]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_purchase/daily'; ?>"><span class="text-muted text-size-small statictics">Purchase today</span></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar22 position-left text-slate"></i> <?php echo $data['purchase'][1]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_purchase/weekly'; ?>"><span class="text-muted text-size-small statictics">Purchase this week</span></a>
											</div>
										</div>

										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> <?php echo $data['purchase'][2]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_purchase/monthly'; ?>"><span class="text-muted text-size-small statictics">Purchase this month</span></a>
											</div>
										</div>

										<div class="col-md-3">
											<div class="content-group">
												<h5 class="text-semibold no-margin"><i class="icon-cart2 position-left text-slate"></i> <?php echo $data['purchase'][3]; ?></h5>
												<a href="<?php echo base_url().'index.php/services/go_purchase'; ?>"><span class="text-muted text-size-small statictics">Purchase total</span></a>
											</div>
										</div>
									</div>
								</div>
				
								<div class="content-group-sm" id="app_sales"></div>
								<div id="monthly-sales-stats"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
var chart_video = [];
var chart_purchase = [];

<?php foreach ($chart_video['result'] as $key => $value) { ?>
	var value = <?php echo $value; ?>;
	chart_video.push(value);
<?php } ?>
<?php foreach ($chart_purchase['result'] as $key => $value) { ?>
	var value = <?php echo $value; ?>;
	chart_purchase.push(value);
<?php } ?>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statictics '+new Date().getFullYear()
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ' '
        },
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
	    {
	        name: 'Video',
	        data: chart_video

	    },
	    {
	        name: 'Purchase',
	        data: chart_purchase

	    }
    ]
});
// $(':contains("Highcharts.com")').each(function(){
//     $(this).html($(this).html().split("Highcharts.com").join(""));
// });
</script>
</body>
</html>
