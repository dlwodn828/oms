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
	<h1 class="page-header">일별 통계(회원) <small>Statistics</small></h1>
	<!-- end page-header -->
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-15">
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
			<div class="col-md-12">
				<!-- 통계 그래프는 최대 1달로 한다. -->
				<div class="p-t-10 p-b-10">
					<div id="interactive-chart-member" class="height-sm m-b-20"></div>
				</div>
				<table class="table table-bordered table-hover table-td-valign-middle table-primary">
					<thead>
					<tr>
						<th width="20%" class="text-center">날짜</th>
						<th width="20%" class="text-center">일반회원 (증감)</th>
						<th width="20%" class="text-center">플러스회원 (증감)</th>
						<th width="20%" class="text-center">나눔회원 (증감)</th>
						<th width="20%" class="text-center">전체회원</th>
					</tr>
					</thead>
					<tbody>
						<?
						$arrCnt=array(0,0,0,-1,-1,-1);
						foreach ($arrDate04 as $row) {
							$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
							$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
							$arrCnt[2]=$arrCnt[2]+$row["iCnt03"];
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
							<td class="text-center valign-middle">
							<?
							echo $row["iCnt03"];
							if ($arrCnt[5]!=-1) {
								if ($row["iCnt03"]<$arrCnt[5]) {
									echo " (<span class='text-danger'><i class='fa fa-arrow-down'></i>".($arrCnt[5]-$row["iCnt03"])."</span>)";
								} else if ($row["iCnt03"]>$arrCnt[5]) {
									echo " (<span class='text-primary'><i class='fa fa-arrow-up'></i> ".($row["iCnt03"]-$arrCnt[5])."</span>)";
								} else if ($row["iCnt03"]==$arrCnt[5]) {
									echo " (<span class='text-primary'> - </span>)";
								}
							}
							?>
							</td>
							<td class="text-center valign-middle"><span class="text-primary"><?=$row["iCnt04"]?></span></td>
						</tr>
						<?
							$arrCnt[3]=$row["iCnt01"];
							$arrCnt[4]=$row["iCnt02"];
							$arrCnt[5]=$row["iCnt03"];
						} ?>
						<tr>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">합 계</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=number_format($arrCnt[0])?></span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=number_format($arrCnt[1])?></span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500"><?=number_format($arrCnt[2])?></span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700"><?=number_format(array_pop($arrDate04)["iCnt04"])?></span></td>
						</tr>
						<tr>
							<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">현재까지 회원수</span></td>
							<td class="text-center valign-middle"><span class="text-danger f-s-13 f-w-500"><?=number_format($arrDate05["iCnt01"])?></span></td>
							<td class="text-center valign-middle"><span class="text-danger f-s-13 f-w-500"><?=number_format($arrDate05["iCnt02"])?></span></td>
							<td class="text-center valign-middle"><span class="text-danger f-s-13 f-w-500"><?=number_format($arrDate05["iCnt03"])?></span></td>
							<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=number_format($arrDate05["iCnt01"])?></span></td>
						</tr>
					</tbody>
				</table>
				<div class="panel-body">
					<div class="dataTables_info">
						<a href="/statistics/dayMemberStatisticsExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
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
<script src="/assets/js/statistics-activity-day.member.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#datepicker-date").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#datepicker-date2").datepicker( "setDate", "<?=$dEndDate?>" );
	/*
	PHP 단에서 아래 배열값을 완성하여 뿌려줌
	options data1 = 일반회원
	options data2 = 플러스회원
	options data3 = 나눔회원
	xLabel = 오늘날짜 기준으로 이전 19일까지 계산
	통계 그래프는 최대 1달로 한다.
	x축 라벨은 3일마다 넣는다.
	*/
	var  xLabel2 =[
				[1,''],[2,''],[3,'<?=$arrDate[2]?>'],[4,''],[5,''],[6,'<?=$arrDate[5]?>'],[7,''],[8,''],[9,'<?=$arrDate[8]?>'],[10,''],
				[11,''],[12,'<?=$arrDate[11]?>'],[13,''],[14,''],[15,'<?=$arrDate[14]?>'],[16,''],[17,''],[18,'<?=$arrDate[17]?>'],[19,''],[20,''],
				[21,'<?=$arrDate[20]?>'],[22,''],[23,''],[24,'<?=$arrDate[23]?>'],[25,''],[26,''],[27,'<?=$arrDate[26]?>'],[28,''],[29,''],[30,'<?=$arrDate[29]?>'],[31,''],
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
		data2 : [
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
		data3 : [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate03);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate03[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate03[$iCnt]."]";
				}
			}
			?>
		],
		xLabel : xLabel2
	};
	StatisticsActivityDayMember.init(options);
});
</script>