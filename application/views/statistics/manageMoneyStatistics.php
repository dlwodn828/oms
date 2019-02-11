<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">운영금액 통계</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">운영금액 통계 <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">총 운영금액</h4>
				</div>
				<div class="panel-body">
					<div id="nv-donut-total" class="height-sm"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="20%" class="text-center"></th>
							<th width="20%" class="text-center">진행중인 금액</th>
							<th width="20%" class="text-center">완료된 금액</th>
							<th width="20%" class="text-center">총 금액</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">금액</td>
								<td class="text-center valign-middle"><?=number_format($arrResult01["iCnt01"])?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult01["iCnt02"])?></td>
								<td class="text-center valign-middle"><span class="text-primary f-s-15 f-w-700"><?=number_format($arrResult01["iCnt03"])?></span></td>
							</tr>
							<?
							if ($arrResult01["iCnt03"]!=0) {
								$iPercent01_01=($arrResult01["iCnt01"]/$arrResult01["iCnt03"])*100;
								$iPercent01_01=fnRound02($iPercent01_01,3);
								$iPercent01_02=($arrResult01["iCnt02"]/$arrResult01["iCnt03"])*100;
								$iPercent01_02=fnRound02($iPercent01_02,3);
							} else {
								$iPercent01_01=0;
								$iPercent01_02=0;
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=$iPercent01_01?>%</span></td>
								<!--td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">12.5</span></td-->
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=$iPercent01_02?>%</span></td>
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">100%</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-2">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">진행중(효력개시중) 금액</h4>
				</div>
				<div class="panel-body">
					<div id="nv-donut-procedding" class="height-sm"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">납입 완료 금액</th>
							<th width="25%" class="text-center">잔여 금액</th>
							<th width="25%" class="text-center">총 금액</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">금액</td>
								<td class="text-center valign-middle"><?=number_format($arrResult02["iCnt01"])?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult02["iCnt02"])?></td>
								<td class="text-center valign-middle"><span class="text-primary f-s-15 f-w-700"><?=number_format($arrResult02["iCnt03"])?></span></td>
							</tr>
							<?
							if ($arrResult02["iCnt03"]!=0) {
								$iPercent02_01=($arrResult02["iCnt01"]/$arrResult02["iCnt03"])*100;
								$iPercent02_01=fnRound02($iPercent02_01,3);
								$iPercent02_02=($arrResult02["iCnt02"]/$arrResult02["iCnt03"])*100;
								$iPercent02_02=fnRound02($iPercent02_02,3);
							} else {
								$iPercent02_01=0;
								$iPercent02_02=0;
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=$iPercent02_01?>%</span></td>
								<!--td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">12.5</span></td-->
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=$iPercent02_02?>%</span></td>
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">100%</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="dataTables_info">
			<!--a href="#none" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> All Excel Download</a-->
		</div>
	</div>
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<!-- chart d3 -->
<script src="/assets/plugins/nvd3/build/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/js/chart-statistics-money.manage.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	var options =
	{
		dataTotal: [
			{ 'label': '진행중인 금액', 'value' : <?=$iPercent01_01?>, 'color': red },
			{ 'label': '완료된 금액', 'value' : <?=$iPercent01_02?>, 'color': green },
		],
		dataProceeding: [
			{ 'label': '납입 금액', 'value' : <?=$iPercent02_01?>, 'color': red },
			{ 'label': '잔여 금액', 'value' : <?=$iPercent02_02?>, 'color': green }
		]
	};
	ChartStatisticsMoney.init(options);
});
</script>