<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">활동지수 통계</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">월별 통계 (스테이지) <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-15">
				<form class="form-inline" role="form" id="actForm" method="get">
					<div class="form-inline">
						<div class="form-group">
							<div class="alert alert-info p-10 m-b-0">
								<strong>Default : Last 1 Years</strong>
							</div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" id="datepicker-month" name="dStartDate" placeholder="2015-01-01" />
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" id="datepicker-month2" name="dEndDate" placeholder="2015-01-01" />
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
			<div class="col-md-12">
				<ul class="nav nav-pills">
					<li class="active"><a href="#default-pills-tab-1" data-toggle="tab" aria-expanded="true">스테이지 개설</a></li>
					<li class=""><a href="#default-pills-tab-2" data-toggle="tab" aria-expanded="false">스테이지 참여</a></li>
				</ul>
				<!-- 통계 그래프는 최대 1달로 한다. -->
				<div class="tab-content p-0">
					<div class="tab-pane fade active in" id="default-pills-tab-1">
						<div id="interactive-chart-stage" class="height-sm m-b-20"></div>
						<table class="table table-bordered table-hover table-td-valign-middle table-primary">
							<thead>
							<tr>
								<th width="50%" class="text-center">날짜</th>
								<th width="50%" class="text-center">스테이지 개설 (증감)</th>
							</tr>
							</thead>
							<tbody>
								<?
								$arrCnt=array(0,0,0,-1,-1,-1);
								foreach ($arrDate04 as $row) {
									$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
								?>
								<tr>
									<td class="text-center valign-middle"><?=$row["NowDate"]?></td>
									<td class="text-center valign-middle">
									<?
									echo $row["iCnt01"];
									if ($arrCnt[3]!=-1) {
										if ($row["iCnt01"]<$arrCnt[3]) {
											echo " (<span class='text-danger'><i class='fa fa-arrow-down'></i>".($arrCnt[3]-$row["iCnt01"])."</span>)";
										} else if ($row["iCnt01"]>$arrCnt[3]) {
											echo " (<span class='text-primary'><i class='fa fa-arrow-up'></i> ".($row["iCnt01"]-$arrCnt[3])."</span>)";
										} else if ($row["iCnt01"]==$arrCnt[3]) {
											echo " (<span class='text-primary'> - </span>)";
										}
									}
									?>
									</td>
								</tr>
								<?
									$arrCnt[3]=$row["iCnt01"];
								} ?>
								<tr>
									<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">합 계</span></td>
									<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700"><?=number_format($arrCnt[0])?></span></td>
								</tr>
								<tr>
									<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">현재까지 개설회원 합계</span></td>
									<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=number_format($arrDate05["iCnt01"])?></span></td>
								</tr>
							</tbody>
						</table>
						<div class="panel-body">
							<div class="dataTables_info">
								<a href="/statistics/monthStageStatisticsExcel01<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade active in" id="default-pills-tab-2">
						<div id="interactive-chart-stage-2" class="height-sm m-b-20"></div>
						<table class="table table-bordered table-hover table-td-valign-middle table-primary">
							<thead>
							<tr>
								<th width="50%" class="text-center">날짜</th>
								<th width="50%" class="text-center">스테이지 참여 (증감)</th>
							</tr>
							</thead>
							<tbody>
								<?
								$arrCnt=array(0,0,0,-1,-1,-1);
								foreach ($arrDate04 as $row) {
									$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
								?>
								<tr>
									<td class="text-center valign-middle"><?=$row["NowDate"]?></td>
									<td class="text-center valign-middle">
									<?
									echo $row["iCnt02"];
									if ($arrCnt[4]!=-1) {
										if ($row["iCnt02"]<$arrCnt[4]) {
											echo " (<span class='text-danger'><i class='fa fa-arrow-down'></i>".($arrCnt[4]-$row["iCnt02"])."</span>)";
										} else if ($row["iCnt02"]>$arrCnt[4]) {
											echo " (<span class='text-primary'><i class='fa fa-arrow-up'></i> ".($row["iCnt02"]-$arrCnt[4])."</span>)";
										} else if ($row["iCnt02"]==$arrCnt[4]) {
											echo " (<span class='text-primary'> - </span>)";
										}
									}
									?>
									</td>
								</tr>
								<?
									$arrCnt[4]=$row["iCnt02"];
								} ?>
								
								<tr>
									<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">합 계</span></td>
									<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700"><?=number_format($arrCnt[1])?></span></td>
								</tr>
								<tr>
									<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">현재까지 참여회원 합계</span></td>
									<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=number_format($arrDate05["iCnt02"])?></span></td>
								</tr>
							</tbody>
						</table>
						<div class="panel-body">
							<div class="dataTables_info">
								<a href="/statistics/monthStageStatisticsExcel02<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
							</div>
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
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<script src="/assets/js/statistics-activity-month.stage.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#datepicker-month").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#datepicker-month2").datepicker( "setDate", "<?=$dEndDate?>" );
	var  xLabel2 =[
				<?
				for ($iCnt=0;$iCnt<sizeof($arrDate);$iCnt++) {
					$iCnt02=$iCnt+1;
					if ($iCnt==0) {
						echo "[".$iCnt02.",'".$arrDate[$iCnt]."']";
					} else {
						echo ",[".$iCnt02.",'".$arrDate[$iCnt]."']";
					}
				}
				?>
			];
	var options = {
		data1 : [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate01);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate01[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate01[$iCnt]."]";
				}
			}
			?>
		],
		xLabel : xLabel2
	};
	var options2 = {
		data1 : [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate02);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate02[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate02[$iCnt]."]";
				}
			}
			?>
		],
		xLabel : xLabel2
	};
	StatisticsActivityMonthStage.init(options, options2);
	// 스테이지 개설, 스테이지 참여는 tab으로 구서되어 있으므로 모든 탭을 다 active in 해야만 차트 에러가 안 남
	// 그래서 모든 탭을 active in하고 두번째 탭을 not active in 한다.
	$("#default-pills-tab-2").removeClass('active in');
});
</script>