<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">스테이지 현황</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">나눔 스테이지 현황 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body text-left">
							<p><b>STAGE</b></p>
							<ul class="nav nav-pills nav-stacked nav-sm">
								<li><a href="donateStageApplicant<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(관리) </a></li>
								<li class="active"><a href="donateStageStats<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(통계) </a></li>
								<li><a href="donateStageInformation<?=$sParam?>"><i class="fa fa-info-circle fa-fw m-r-5"></i> 기본정보 </a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-profile">
						<div class="panel-body">
							<ul class="list-group no-margin text-left">
								<li class="list-group-item"><span class="text-info p-l-10">스테이지 코드</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->StageCode?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">상태여부</span><?=fnRetState($arrResult02->StatusYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">노출여부</span><?=fnRetState($arrResult02->DisplayYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">기간</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->StageStart?>~<?=$arrResult02->StageEnd?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">개설일</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->RegDate?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">후원처</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyName?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">목표금액</span><span class="badge badge-primary badge-square pull-right m-r-10"><?=$arrResult02->TargetMoney?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">담당자</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyDamdang?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">연락처</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyTel?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="http://www.google.co.kr" target="_about" class="btn btn-info btn-xs"><i class="fa fa-link"></i> 홈페이지</a>
						<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin applicant -->
				<div class="panel panel-profile">
					<div class="wrapper">
						<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-users m-r-5"></i> 스테이지 나눔 현황(통계)
							<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
						</h4>
						<form class="form-inline" role="form" id="actForm" method="get">
							<input type="hidden" name="Idx" value="<?=$arrResult02->Idx?>">
							<input type="hidden" name="sPage" id="sPage" value="">
							<div class="form-inline">
								<div class='input-group date' id='datepicker-year'>
									<input type="text" id="start2" class="form-control" name="start2" value="<?=$sYear?>" />
									<span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
								</div>
								<div class="form-group" >
									<div class="input-group ">
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div class="panel-body">
							<span class="label label-warning f-s-13 m-r-20 p-5 pull-right">단위(명)</span>
							<div id="interactive-chart" class="height-sm m-t-20 p-r-10"></div>
						</div>
					</div>
				</div>
				<!-- end applicant -->
			</div>
			<!-- end vertical-box-column -->
		</div>
	</div>
	<!-- end vertical-box -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/js/donate.stage.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	console.log("<?=$sYear?>");
	$("#start2").val('<?=$sYear?>');
	// chart data(기부인원)
	var options = {
		data1 : <?=json_encode($jsonResult)?>
	};
	DonateStage.init(options);
});
</script>