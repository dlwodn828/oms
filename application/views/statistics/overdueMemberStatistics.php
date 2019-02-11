<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">회원 통계</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">연체회원 통계 <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="row">
		<div class="panel panel-primary" data-sortable-id="ui-widget-14">
			<div class="panel-heading">
				<h4 class="panel-title"><span class="f-s-15">연체율 (금액)</span></h4>
			</div>
			<div class="panel-body">
				<div class="col-md-3 col-sm-3 p-l-0">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
						<div class="stats-title">총 입금예정액</div>
						<div class="stats-number"><?=number_format($arrResult01["TotalScheduledDepositMoney01"]+$arrResult01["TotalScheduledDepositMoney02"])?>원</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
						<div class="stats-title">총 입금액</div>
						<div class="stats-number"><?=number_format($arrResult01["TotalDepositMoney"])?>원</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
						<div class="stats-title">총 미납액</div>
						<div class="stats-number"><?=number_format($arrResult01["TotalControlDepositMoney01"])?>원</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 p-0 p-r-10">
					<div class="alert f-s-20 text-center">
						<strong>
							연체율 = ( 총 미납액 / 총 입금예정액 ) * 100 = <span class="text-danger f-w-700">
							<?
							$TotalScheduledDepositMoney=($arrResult01["TotalScheduledDepositMoney01"]+$arrResult01["TotalScheduledDepositMoney02"]);
							if ($TotalScheduledDepositMoney!=0) {
								$iPercent=($arrResult01["TotalControlDepositMoney01"]/$TotalScheduledDepositMoney)*100;
								$iPercent=fnRound02($iPercent,3);
							} else {
								$iPercent=0;
							}
							echo $iPercent."%";
							?></span>
						</strong>
					</div>
				</div>

			</div>
		</div>

		<div class="panel panel-info" data-sortable-id="ui-widget-14">
			<div class="panel-heading">
				<h4 class="panel-title"><span class="f-s-15">연체율 (인원)</span></h4>
			</div>
			<div class="panel-body">

				<div class="col-md-12 col-sm-12 p-0 p-r-10">
					<div class="alert f-s-20 ">
						<strong>
							* 인원별 연체율 = ( 인원별 연체인원  / 총 입금인원 ) * 100
						</strong>
					</div>
				</div>

				<div class="col-md-3 col-sm-3 p-l-0">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-title">5인 연체인원</div>
						<div class="stats-number"><?=$arrResult02["iCnt01"]?>명</div>
						<div class="stats-link">
							<a class="f-s-20">연체율 = 
							<?
							if ($arrResult02["iCnt02"]!=0) {
								$iPercent=($arrResult02["iCnt01"]/$arrResult02["iCnt02"])*100;
								$iPercent=fnRound02($iPercent,3);
							} else {
								$iPercent=0;
							}
							echo $iPercent."%";
							?>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-title">7인 연체인원</div>
						<div class="stats-number"><?=$arrResult02["iCnt03"]?>명</div>
						<div class="stats-link">
							<a class="f-s-20">연체율 = 
							<?
							if ($arrResult02["iCnt04"]!=0) {
								$iPercent=($arrResult02["iCnt03"]/$arrResult02["iCnt04"])*100;
								$iPercent=fnRound02($iPercent,3);
							} else {
								$iPercent=0;
							}
							echo $iPercent."%";
							?>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-title">9인 연체인원</div>
						<div class="stats-number"><?=$arrResult02["iCnt05"]?>명</div>
						<div class="stats-link">
							<a class="f-s-20">연체율 = 
							<?
							if ($arrResult02["iCnt06"]!=0) {
								$iPercent=($arrResult02["iCnt05"]/$arrResult02["iCnt06"])*100;
								$iPercent=fnRound02($iPercent,3);
							} else {
								$iPercent=0;
							}
							echo $iPercent."%";
							?>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-aqua">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-title">13인 연체인원</div>
						<div class="stats-number"><?=$arrResult02["iCnt07"]?>명</div>
						<div class="stats-link">
							<a class="f-s-20">연체율 = 
							<?
							if ($arrResult02["iCnt08"]!=0) {
								$iPercent=($arrResult02["iCnt07"]/$arrResult02["iCnt08"])*100;
								$iPercent=fnRound02($iPercent,3);
							} else {
								$iPercent=0;
							}
							echo $iPercent."%";
							?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<<script src="/assets/js/form-plugins.datepicker.js"></script>
<!-- chart d3 -->
<script src="/assets/plugins/nvd3/build/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/js/chart-statistics-members.icss.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	// x : I-CSS 등급, y: 성별 점유율(%)
	var options =
	{
		dataGenderWoman: [
			{ x:1, y: 10}, { x:2, y: 15}, { x:3, y: 16}, { x:4, y: 20}, { x:5, y: 17}, { x:6, y: 2}, { x:7, y: 12}, { x:8, y: 15},
			{ x:9, y: 14}, { x:10, y: 12},{ x:11, y: 3}, { x:12, y: 12}, { x:13, y: 2}, { x:14, y: 2}, { x:15, y: 8}
		],
		dataGenderMan: [
			{ x:1, y: 10}, { x:2, y: 15}, { x:3, y: 16}, { x:4, y: 20}, { x:5, y: 17}, { x:6, y: 2}, { x:7, y: 12}, { x:8, y: 15},
			{ x:9, y: 14}, { x:10, y: 12},{ x:11, y: 3}, { x:12, y: 12}, { x:13, y: 2}, { x:14, y: 2}, { x:15, y: 8}
		]
	};
	ChartStatisticsMembersIcss.init(options);
});
</script>