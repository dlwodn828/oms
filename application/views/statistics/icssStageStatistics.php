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
	<h1 class="page-header">스테이지 통계 (I-CSS 기준) <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">스테이지 - 인원</h4>
				</div>
				<div class="panel-body">
					<div id="nv-stacked-bar-person" class="height-sm m-b-20"></div>

					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="20%" rowspan="2" class="text-center">I-CSS</th>
								<th width="60%" colspan="4" class="text-center">인원 (명)</th>
								<th width="20%" rowspan="2" class="text-center">점유율(%)</th>
							</tr>
							<tr>
								<th width="15%" class="text-center">5</th>
								<th width="15%" class="text-center">7</th>
								<th width="15%" class="text-center">9</th>
								<th width="15%" class="text-center">13</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult01 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["ICSS"]?></td>
								<? for ($iCnt01=1;$iCnt01<6;$iCnt01++) {
									if ($iCnt01==5) {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt0".$iCnt01]);
										if ($arrResult02["iCnt05"]!=0) {
											$iPercent=($row["iCnt0".$iCnt01]/$arrResult02["iCnt05"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt0".$iCnt01]);
										if ($arrResult02["iCnt05"]!=0) {
											$iPercent=($row["iCnt0".$iCnt01]/$arrResult02["iCnt05"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">총 점유율(%)</span></td>
								<? for ($iCnt01=1;$iCnt01<6;$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult02["iCnt0".$iCnt01]);
									if ($arrResult02["iCnt05"]!=0) {
										$iPercent=($arrResult02["iCnt0".$iCnt01]/$arrResult02["iCnt05"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo "(".$iPercent."%)</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">스테이지 - 이율</h4>
				</div>
				<div class="panel-body">

					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="8%" rowspan="2" class="text-center">I-CSS</th>
							<th width="84%" colspan="14" class="text-center">이율 (%)</th>
							<th width="8%" rowspan="2" class="text-center">점유율(%)</th>
						</tr>
						<tr>
							<th width="6%" class="text-center">7</th>
							<th width="6%" class="text-center">8</th>
							<th width="6%" class="text-center">9</th>
							<th width="6%" class="text-center">10</th>
							<th width="6%" class="text-center">11</th>
							<th width="6%" class="text-center">12</th>
							<th width="6%" class="text-center">13</th>
							<th width="6%" class="text-center">14</th>
							<th width="6%" class="text-center">15</th>
							<th width="6%" class="text-center">16</th>
							<th width="6%" class="text-center">17</th>
							<th width="6%" class="text-center">18</th>
							<th width="6%" class="text-center">19</th>
							<th width="6%" class="text-center">20</th>
						</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult03 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["ICSS"]?></td>
								<? for ($iCnt01=1;$iCnt01<16;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01==15) {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult04["iCnt15"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult04["iCnt05"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult04["iCnt15"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult04["iCnt15"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">총 점유율(%)</span></td>
								<? for ($iCnt01=1;$iCnt01<16;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult04["iCnt".$iCnt01]);
									if ($arrResult04["iCnt15"]!=0) {
										$iPercent=($arrResult04["iCnt".$iCnt01]/$arrResult04["iCnt15"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo "(".$iPercent."%)</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">I-CSS 등급 - 지역별</h4>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-td-valign-middle" style="width: 2000px;">
						<thead>
						<tr>
							<th width="6%" rowspan="2" class="text-center">I-CSS</th>
							<th colspan="17" class="text-center">금액 (만원)</th>
							<th width="8%" rowspan="2" class="text-center">점유율(%)</th>
						</tr>
						<tr>
							<th width="5%" class="text-center">서울</th>
							<th width="5%" class="text-center">부산</th>
							<th width="5%" class="text-center">대구</th>
							<th width="5%" class="text-center">인천</th>
							<th width="5%" class="text-center">광주</th>
							<th width="5%" class="text-center">대전</th>
							<th width="5%" class="text-center">울산</th>
							<th width="5%" class="text-center">세종</th>
							<th width="5%" class="text-center">경기도</th>
							<th width="5%" class="text-center">강원도</th>
							<th width="5%" class="text-center">충북</th>
							<th width="5%" class="text-center">충남</th>
							<th width="5%" class="text-center">전북</th>
							<th width="5%" class="text-center">전남</th>
							<th width="5%" class="text-center">경북</th>
							<th width="5%" class="text-center">경남</th>
							<th width="5%" class="text-center">제주</th>
						</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult05 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["ICSS"]?></td>
								<? for ($iCnt01=1;$iCnt01<19;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01==18) {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult06["iCnt18"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult06["iCnt18"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult06["iCnt18"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult06["iCnt18"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">총 점유율(%)</span></td>
								<? for ($iCnt01=1;$iCnt01<19;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-500'>";
									echo number_format($arrResult06["iCnt".$iCnt01]);
									if ($arrResult06["iCnt18"]!=0) {
										$iPercent=($arrResult06["iCnt".$iCnt01]/$arrResult06["iCnt18"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo "(".$iPercent."%)</span></td>";
								}
								?>
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
<script src="/assets/js/chart-statistics-members.stage.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	<?
	$iCnt02=1;
	$arrData=array();
	foreach ($arrResult01 as $row) {
		for ($iCnt01=1;$iCnt01<5;$iCnt01++) {
			if ($arrResult02["iCnt05"]!=0) {
				$iPercent=($row["iCnt0".$iCnt01]/$arrResult02["iCnt05"])*100;
			} else {
				$iPercent=0;
			}
			$iPercent=fnRound02($iPercent,3);
//			$arrData[$iCnt01][$iCnt02]="{ x:".$iCnt02.", y: ".$iPercent."},";
			
		}
		$arrData[0][$iCnt02]=($row["iCnt01"]/$arrResult02["iCnt05"])*100;
		$arrData[1][$iCnt02]=($row["iCnt02"]/$arrResult02["iCnt05"])*100;
		$arrData[2][$iCnt02]=($row["iCnt03"]/$arrResult02["iCnt05"])*100;
		$arrData[3][$iCnt02]=($row["iCnt04"]/$arrResult02["iCnt05"])*100;
		$arrData[0][$iCnt02]=fnRound02($arrData[0][$iCnt02],3);
		$arrData[1][$iCnt02]=fnRound02($arrData[1][$iCnt02],3);
		$arrData[2][$iCnt02]=fnRound02($arrData[2][$iCnt02],3);
		$arrData[3][$iCnt02]=fnRound02($arrData[3][$iCnt02],3);
		$iCnt02++;
	}
	?>
	// x : I-CSS 등급, y: 인원별 점유율(%)
	var options =
	{
		dataPerson5: [
			<?
			for ($iCnt=1;$iCnt<sizeof($arrData[0])+1;$iCnt++) {
				echo "{ x:".$iCnt.", y: ".$arrData[0][$iCnt]."},";
			}
			?>
		],
		dataPerson7: [
			<?
			for ($iCnt=1;$iCnt<sizeof($arrData[1])+1;$iCnt++) {
				echo "{ x:".$iCnt.", y: ".$arrData[1][$iCnt]."},";
			}
			?>
		],
		dataPerson9: [
			<?
			for ($iCnt=1;$iCnt<sizeof($arrData[2])+1;$iCnt++) {
				echo "{ x:".$iCnt.", y: ".$arrData[2][$iCnt]."},";
			}
			?>
		],
		dataPerson13: [
			<?
			for ($iCnt=1;$iCnt<sizeof($arrData[3])+1;$iCnt++) {
				echo "{ x:".$iCnt.", y: ".$arrData[3][$iCnt]."},";
			}
			?>
		]
	};
	ChartStatisticsMembersStage.init(options);
});
</script>