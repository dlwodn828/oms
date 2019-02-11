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
	<h1 class="page-header">I-CSS 분포 통계 (플러스회원 기준) <small>Statistics</small></h1>
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
					<h4 class="panel-title">I-CSS 등급 - 성별</h4>
				</div>
				<div class="panel-body">
					<div id="nv-stacked-bar-gender" class="height-sm m-b-20"></div>

					<div class="clearfix"></div>

					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="30%" rowspan="2" class="text-center">I-CSS</th>
								<th width="40%" colspan="2" class="text-center">성별</th>
								<th width="30%" rowspan="2" class="text-center">점유율(%)</th>
							</tr>
							<tr>
								<th width="20%" class="text-center">여성</th>
								<th width="20%" class="text-center">남성</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult01 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["ICSS"]?></td>
								<td class="text-center valign-middle">
								<?
								echo number_format($row["iCnt01"]);
								if ($arrResult02["iCnt03"]!=0) {
									$iPercent=($row["iCnt01"]/$arrResult02["iCnt03"])*100;
								} else {
									$iPercent=0;
								}
								$iPercent=fnRound02($iPercent,3);
								echo "(".$iPercent."%)";
								?>
								</td>
								<td class="text-center valign-middle">
								<?
								echo number_format($row["iCnt02"]);
								if ($arrResult02["iCnt03"]!=0) {
									$iPercent=($row["iCnt02"]/$arrResult02["iCnt03"])*100;
								} else {
									$iPercent=0;
								}
								$iPercent=fnRound02($iPercent,3);
								echo "(".$iPercent."%)";
								?>
								</td>
								<td class="text-center valign-middle"><span class="text-primary f-s-15 f-w-700">
								<?
								echo number_format($row["iCnt03"]);
								if ($arrResult02["iCnt03"]!=0) {
									$iPercent=($row["iCnt03"]/$arrResult02["iCnt03"])*100;
								} else {
									$iPercent=0;
								}
								$iPercent=fnRound02($iPercent,3);
								echo "(".$iPercent."%)";
								?>
								</span></td>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">총 점유율(%)</span></td>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">
								<?
								echo number_format($arrResult02["iCnt01"]);
								if ($arrResult02["iCnt03"]!=0) {
									$iPercent=($arrResult02["iCnt01"]/$arrResult02["iCnt03"])*100;
								} else {
									$iPercent=0;
								}
								$iPercent=fnRound02($iPercent,3);
								echo "(".$iPercent."%)";
								?>
								</span></td>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">
								<?
								echo number_format($arrResult02["iCnt02"]);
								if ($arrResult02["iCnt03"]!=0) {
									$iPercent=($arrResult02["iCnt02"]/$arrResult02["iCnt03"])*100;
								} else {
									$iPercent=0;
								}
								$iPercent=fnRound02($iPercent,3);
								echo "(".$iPercent."%)";
								?>
								</span></td>
								<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700"><?=number_format($arrResult02["iCnt03"])?> (100%)</span></td>
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
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">I-CSS 등급 - 연령별</h4>
				</div>
				<div class="panel-body">

					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="15%" rowspan="2" class="text-center">I-CSS</th>
								<th width="70%" colspan="7" class="text-center">연령대</th>
								<th width="15%" rowspan="2" class="text-center">점유율(%)</th>
							</tr>
							<tr>
								<th width="10%" class="text-center">20대</th>
								<th width="10%" class="text-center">30대</th>
								<th width="10%" class="text-center">40대</th>
								<th width="10%" class="text-center">50대</th>
								<th width="10%" class="text-center">60대</th>
								<th width="10%" class="text-center">70대</th>
								<th width="10%" class="text-center">80대이상</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult03 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["ICSS"]?></td>
								<? for ($iCnt01=1;$iCnt01<9;$iCnt01++) {
									if ($iCnt01==8) {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt0".$iCnt01]);
										if ($arrResult04["iCnt08"]!=0) {
											$iPercent=($row["iCnt0".$iCnt01]/$arrResult04["iCnt08"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo "(".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt0".$iCnt01]);
										if ($arrResult04["iCnt08"]!=0) {
											$iPercent=($row["iCnt0".$iCnt01]/$arrResult04["iCnt08"])*100;
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
								<? for ($iCnt01=1;$iCnt01<9;$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult04["iCnt0".$iCnt01]);
									if ($arrResult04["iCnt08"]!=0) {
										$iPercent=($arrResult04["iCnt0".$iCnt01]/$arrResult04["iCnt08"])*100;
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
					<!-- 그래프가 복잡해서 우선 빼기로 함 -->
					<!--<div id="stacked-chart-address" class="height-sm m-b-20"></div>-->

					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="12%" rowspan="2" class="text-center">I-CSS</th>
								<th width="70%" colspan="17" class="text-center">지역</th>
								<th width="12%" rowspan="2" class="text-center">점유율(%)</th>
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
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-13 f-w-700'>";
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
			<?
			$iCnt01=1;
			foreach ($arrResult01 as $row) {
				if ($arrResult02["iCnt03"]!=0) {
					$iPercent=($row["iCnt01"]/$arrResult02["iCnt03"])*100;
				} else {
					$iPercent=0;
				}
				$iPercent=fnRound02($iPercent,3);

				echo "{ x:".$iCnt01.", y: ".$iPercent."},";
				$iCnt01++;
			}
			?>
		],
		dataGenderMan: [
			<?
			$iCnt01=1;
			foreach ($arrResult01 as $row) {
				if ($arrResult02["iCnt03"]!=0) {
					$iPercent=($row["iCnt02"]/$arrResult02["iCnt03"])*100;
				} else {
					$iPercent=0;
				}
				$iPercent=fnRound02($iPercent,3);

				echo "{ x:".$iCnt01.", y: ".$iPercent."},";
				$iCnt01++;
			}
			?>
		]
	};
	ChartStatisticsMembersIcss.init(options);
});
</script>