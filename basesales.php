<?php require_once 'ti.php' ?>
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] !='Sales'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php";
	//require 'koneksi.php';
	error_reporting (E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<style type="text/css">
html *
{
   font-size: 12px !important;
}
.fa-plus {
  color: black;	
  font-size: 16px !important;
}
.fa-edit {
  color: black;
  font-size: 20px !important;
}
.fa-search {
  font-size: 20px !important;
}
.fa-trash {
  color: black;
  font-size: 20px !important;
}
.fa-bars {
  font-size: 20px !important;
}
</style>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Sinar Rodamas</title>
 

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- PLUGINS CSS -->
		<link href="assets/plugins/weather-icon/css/weather-icons.min.css" rel="stylesheet">
		<link href="assets/plugins/prettify/prettify.min.css" rel="stylesheet">
		<link href="assets/plugins/magnific-popup/magnific-popup.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.theme.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.transitions.min.css" rel="stylesheet">
		<link href="assets/plugins/chosen/chosen.min.css" rel="stylesheet">
		<link href="assets/plugins/icheck/skins/all.css" rel="stylesheet">
		<link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/validator/bootstrapValidator.min.css" rel="stylesheet">
		<link href="assets/plugins/summernote/summernote.min.css" rel="stylesheet">
		<link href="assets/plugins/markdown/bootstrap-markdown.min.css" rel="stylesheet">
		<link href="assets/plugins/datatable/css/bootstrap.datatable.min.css" rel="stylesheet">
		<link href="assets/plugins/morris-chart/morris.min.css" rel="stylesheet">
		<link href="assets/plugins/c3-chart/c3.min.css" rel="stylesheet">
		<link href="assets/plugins/slider/slider.min.css" rel="stylesheet">
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
 
	<body class="tooltips">
		
		
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="wrapper">
			<!-- BEGIN TOP NAV -->
			<div class="top-navbar">
				<div class="top-navbar-inner">
					
					<!-- Begin Logo brand -->
					<div class="logo-brand">
						<a href="sales.php"><img src="images/honda-logo.png" alt="Sinar Rodamas"></a>
					</div><!-- /.logo-brand -->
					<!-- End Logo brand -->
					
					<div class="top-nav-content">
						
						<!-- Begin button sidebar left toggle -->
						<div class="btn-collapse-sidebar-left">
							<i class="fa fa-bars icon-dinamic"></i>
						</div><!-- /.btn-collapse-sidebar-left -->
						<!-- End button sidebar left toggle -->
						

						
						<!-- Begin button nav toggle -->
						<div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
							<i class="fa fa-plus fa fa-plus"></i>
						</div><!-- /.btn-collapse-sidebar-right -->
						<!-- End button nav toggle -->
						
						
						<!-- Begin user session nav -->
						<ul class="nav-user navbar-right">
							<li onclick="window.location.assign('logout.php')" class="dropdown">
							  <a href="logout.php" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/logout.png" class="avatar img-circle" alt="Avatar">
								<font color="white">Hi, <strong><?php echo $_SESSION['LOGIN_NAME']?></strong></font>
							  </a>
							</li>
						</ul>
						<!-- End user session nav -->
						
						<!-- Begin Collapse menu nav -->
						<div class="collapse navbar-collapse" id="main-fixed-nav">

						</div><!-- /.navbar-collapse -->
						<!-- End Collapse menu nav -->
					</div><!-- /.top-nav-content -->
				</div><!-- /.top-navbar-inner -->
			</div><!-- /.top-navbar -->
			<!-- END TOP NAV -->
			
			
			
			<!-- BEGIN SIDEBAR LEFT -->
			<div class="sidebar-left sidebar-nicescroller">
				<ul class="sidebar-menu">
					<li><a href="sales.php"><i class="fa fa-dashboard icon-sidebar"></i>Dashboard</a></li>
					<li>
						<a href="#">
							<i class="fa fa-home icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Warehouse
							</a>
						<ul class="submenu">
							<li><a href="masteringstockkeluar.php">Stock Batu Keluar</a></li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-shopping-cart icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Sales
							</a>
						<ul class="submenu">
							<li><a href="masteringpenjualan.php">Penjualan</a></li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-table icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Mastering
							</a>
						<ul class="submenu">
							<li><a href="masteringkustomer.php">Customer</a></li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-file icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Report
							</a>
						<ul class="submenu">
							<li><a href="lappenjualan.php">Penjualan</a></li>						
							<li><a href="lapstok.php">Stock</a></li>
							<li><a href="laphutangmutasi.php">Laporan Hutang</a></li>
						</ul>
					</li>

			</div><!-- /.sidebar-left -->
			<!-- END SIDEBAR LEFT -->
			
			
			

			
			
			

			
			
			
			<!-- BEGIN PAGE CONTENT -->
			<div class="page-content">
				<div class="container-fluid">
<?php startblock('konten') ?>
<?php endblock() ?>
				</div><!-- /.container-fluid -->
				
				
				
				<!-- BEGIN FOOTER -->
				
				<footer>
					&copy;<script language="JavaScript" type="text/javascript">
							now = new Date
							theYear=now.getYear()
							if (theYear < 1900)
								theYear=theYear+1900
								document.write(theYear)
						</script>
						<a href="admin.php">Sinar Rodamas</a><br />
				</footer>
				<!-- END FOOTER -->
				
				
			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
		
		
	
		
		
		
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		
		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- MAIN JAVASRCIPT (REQUIRED ALL PAGE)-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/plugins/retina/retina.min.js"></script>
		<script src="assets/plugins/nicescroll/jquery.nicescroll.js"></script>
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
 
		<!-- PLUGINS -->
		<script src="assets/plugins/skycons/skycons.js"></script>
		<script src="assets/plugins/prettify/prettify.js"></script>
		<script src="assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
		<script src="assets/plugins/icheck/icheck.min.js"></script>
		<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
		<script src="assets/plugins/mask/jquery.mask.min.js"></script>
		<script src="assets/plugins/validator/bootstrapValidator.min.js"></script>
		<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatable/js/bootstrap.datatable.js"></script>
		<script src="assets/plugins/summernote/summernote.min.js"></script>
		<script src="assets/plugins/markdown/markdown.js"></script>
		<script src="assets/plugins/markdown/to-markdown.js"></script>
		<script src="assets/plugins/markdown/bootstrap-markdown.js"></script>
		<script src="assets/plugins/slider/bootstrap-slider.js"></script>
		
		<!-- EASY PIE CHART JS -->
		<script src="assets/plugins/easypie-chart/easypiechart.min.js"></script>
		<script src="assets/plugins/easypie-chart/jquery.easypiechart.min.js"></script>
		
		<!-- KNOB JS -->
		<!--[if IE]>
		<script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
		<![endif]-->
		<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
		<script src="assets/plugins/jquery-knob/knob.js"></script>

		<!-- FLOT CHART JS -->
		<script src="assets/plugins/flot-chart/jquery.flot.js"></script>
		<script src="assets/plugins/flot-chart/jquery.flot.tooltip.js"></script>
		<script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
		<script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
		<script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
		<script src="assets/plugins/flot-chart/jquery.flot.time.js"></script>

		<!-- MORRIS JS -->
		<script src="assets/plugins/morris-chart/raphael.min.js"></script>
		<script src="assets/plugins/morris-chart/morris.min.js"></script>
		
		<!-- C3 JS -->
		<script src="assets/plugins/c3-chart/d3.v3.min.js" charset="utf-8"></script>
		<script src="assets/plugins/c3-chart/c3.min.js"></script>
		
		<!-- MAIN APPS JS -->
		<script src="assets/js/apps.js"></script>
		
	</body>
</html>
<?php
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;		
        $('ul.submenu a[href="'+ url +'"]').addClass('active selected');
        $('ul.submenu a').filter(function() {
             return this.href == url;
        }).parent().addClass('active selected').parent().addClass('visible').closest('li').addClass('active selected');
    });
</script>