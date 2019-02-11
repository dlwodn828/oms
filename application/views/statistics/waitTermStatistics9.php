<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">스테이지 통계</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">대기 순번별 평균 대기일- 9명 <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="col-md-12 p-15">
				<form class="form-inline" role="form" id="actForm" method="get">
					<div class="form-inline">
						<div class="form-group">
							<div class="alert alert-info p-10 m-b-0">
								<strong>Default : Last 30 Days</strong>
							</div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control width-100" name="dStartDate" id="datepicker-date" placeholder="Date Start">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control width-100" name="dEndDate" id="datepicker-date2" placeholder="Date End">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-12 p-15">
				<table class="table table-bordered table-hover table-td-valign-middle">
					<thead>
					<tr>
						<th width="14%" rowspan="2" class="text-center">이율</th>
						<th colspan="9" class="text-center">순번</th>
						<th width="14%" rowspan="2" class="text-center">소계</th>
					</tr>
					<tr>
						<th width="12%" class="text-center">1</th>
						<th width="12%" class="text-center">2</th>
						<th width="12%" class="text-center">3</th>
						<th width="12%" class="text-center">4</th>
						<th width="12%" class="text-center">5</th>
						<th width="12%" class="text-center">6</th>
						<th width="12%" class="text-center">7</th>
						<th width="12%" class="text-center">8</th>
						<th width="12%" class="text-center">9</th>
					</tr>
					</thead>
					<tbody>
						<?
						$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0));
						$arrCnt02=array(0,0,0,0,0,0,0,0,0,0);
						$arrCnt03=array(0,0,0,0,0,0,0,0,0,0);
						$arrTotalCnt=array_fill(0,10,0);
						for ($iCnt=8;$iCnt<21;$iCnt++) {
							for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
								if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
									$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
									$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
									$arrCnt02[$iCnt03]=$arrCnt02[$iCnt03]+$arrDate04[$iCnt02]["iCnt02"];
									$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate04[$iCnt02]["iCnt03"];
								}
							}
						}
						for ($iCnt=8;$iCnt<21;$iCnt++) {?>
						<tr>
							<td class="text-center valign-middle"><?=$iCnt?>%</td>
							<?
							$iTotalCnt=0;
							for ($iCnt02=1;$iCnt02<10;$iCnt02++) {
								echo "<td class='text-center valign-middle'>".$arrCnt[$iCnt][$iCnt02]."</td>";
								$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
								$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
							}
							$iTotalCnt=$iTotalCnt/9;
							$iTotalCnt=fnRound02($iTotalCnt,3);
							?>
							<td class="text-center valign-middle"><span class="text-primary"><?=$iTotalCnt?></span></td>
						</tr>
						<? }
						for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
							if ($arrCnt03[$iCnt03]!=0) {
								$arrTotalCnt[$iCnt03]=$arrCnt02[$iCnt03]/$arrCnt03[$iCnt03];
							} else {
								$arrTotalCnt[$iCnt03]=0;
							}
							$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3);
						}
						$iTotalCnt02=($arrTotalCnt[1]+$arrTotalCnt[2]+$arrTotalCnt[3]+$arrTotalCnt[4]+$arrTotalCnt[5]+$arrTotalCnt[6]+$arrTotalCnt[7]+$arrTotalCnt[8]+$arrTotalCnt[9])/9;
						$iTotalCnt02=fnRound02($iTotalCnt02,3);
						?>
						<tr>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">합 계</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[1]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[2]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[3]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[4]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[5]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[6]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[7]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[8]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=$arrTotalCnt[9]?> </span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700"><?=$iTotalCnt02?></span></td>
						</tr>
					</tbody>
				</table>
				<div class="panel-body">
					<div class="dataTables_info">
						<a href="/statistics/waitTermStatistics9Excel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
					</div>
				</div>

			</div>

		</div>

	</div>
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#datepicker-date").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#datepicker-date2").datepicker( "setDate", "<?=$dEndDate?>" );
});
</script>