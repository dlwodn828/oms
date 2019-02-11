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
	<h1 class="page-header">월별 통계(나눔) <small>Statistics</small></h1>
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
				<!-- 통계 그래프는 최대 1달로 한다. -->
				<div class="p-t-10 p-b-10">
					<div id="interactive-chart-donate" class="height-sm m-b-20"></div>
				</div>
				<table class="table table-bordered table-hover table-td-valign-middle table-primary">
					<thead>
					<tr>
						<th width="50%" class="text-center">날짜</th>
						<th width="50%" class="text-center">나눔회원수 (증감)</th>
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
							<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">현재까지 나눔 회원수</span></td>
							<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=number_format($arrDate05["iCnt01"])?></span></td>
						</tr>
					</tbody>
				</table>
				<div class="panel-body">
					<div class="dataTables_info">
						<a href="/statistics/monthDonateStatisticsExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
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
<script src="/assets/js/statistics-activity-month.donate.js"></script>
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
	StatisticsActivityMonthDonate.init(options);
});
</script>