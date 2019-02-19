<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="kr">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title><?=sSiteName?></title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- ================== BEGIN BASE CSS STYLE ================== -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="/assets/css/animate.min.css" rel="stylesheet" />
<!-- <link href="/assets/lumino/css/styles.css" rel="stylesheet">  -->
<link href="/assets/css/style.css" rel="stylesheet" />
<!-- <link href="/assets/css/style.min.css" rel="stylesheet" /> -->

<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
<link href="/assets/css/custom.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<link media="all" type="text/css" rel="stylesheet" href="/assets/plugins/lightbox/css/lightbox.css">
<!-- <link href="/assets/lumino/css/bootstrap.min.css" rel="stylesheet"> 
<link href="/assets/lumino/css/font-awesome.min.css" rel="stylesheet">
<link href="/assets/lumino/css/datepicker3.css" rel="stylesheet"> -->

<!-- <link href="/assets/lumino/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
<!-- Page level plugin CSS-->
<!-- <link href="/assets/lumino/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">	 -->
<!--Custom Font-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


</head>
<!-- ================== END BASE CSS STYLE ================== -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->
<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/assets/plugins/jquery/jquery-migrate-1.3.0.min.js"></script>
<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
    <script src="/assets/crossbrowserjs/html5shiv.js"></script>
    <script src="/assets/crossbrowserjs/respond.min.js"></script>
    <script src="/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<script src="/assets/js/apps.min.js"></script>
<script src="/assets/js/jquery.validate.js"></script>
<script src="/assets/js/messages_ko.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<script src="/assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script src="/assets/js/form-multiple-upload.demo.js"></script>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->
<!-- begin #page-container -->
<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
	<!-- begin #header -->
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="/" class="navbar-brand"><span class="navbar-logo"></span> ALLT's OMS</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end mobile sidebar expand / collapse button -->
			<!-- begin header navigation right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span id="clock" class="text-primary m-r-20"></span>
						<!--<img src="/assets/img/user-13.jpg" alt="" />-->
						<span class="hidden-xs"><?=$this->session->userdata("AdminName")?></span> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu animated fadeInLeft">
						<li><a href="/auth/logOutProc">Log Out</a></li>
					</ul>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end container-fluid -->
	</div>
	<!-- end #header -->
	<!-- begin #sidebar -->
	<div id="sidebar" class="sidebar">
		<div data-scrollbar="true" data-height="100%">
			<!-- begin sidebar nav -->
			<ul class="nav">
				<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>


				<li class="nav-header bg-black-lighter">OMS</li>

				
				<li class=" has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-list"></i>
						<span>업체 및 품목</span>
					</a>
					<ul class="sub-menu">
						<li class=""><a href="/prices/priceList">업체별 품목 및 단가</a></li>
						<li class=""><a href="/customers/consultHistoryList">업체 관리</a></li>
						<li class=""><a href="/products/productList">품목 관리</a></li>
					</ul>
				</li>

				
				<li class=" has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-truck"></i>
						<span>주문</span>
					</a>
					<ul class="sub-menu">
						<li class=""><a href="/dashboard/dash">주문정보</a></li>
					</ul>
				</li>

				<li class="nav-header">&nbsp;</li>
				<!-- begin sidebar minify button -->
				<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				<!-- end sidebar minify button -->
			</ul>
			<!-- end sidebar nav -->
		</div>
	</div>
	<div class="sidebar-bg"></div>
	<!-- end #sidebar -->
