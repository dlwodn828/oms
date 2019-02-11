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
	<h1 class="page-header">관심카테고리 통계 <small>Statistics</small></h1>
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
					<h4 class="panel-title">전체회원 - 회원 등급별</h4>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="20%" rowspan="2" class="text-center">카테고리</th>
								<th width="60%" colspan="2" class="text-center">회원등급</th>
								<th width="20%" rowspan="2" class="text-center">점유율(%)</th>
							</tr>
							<tr>
								<th width="30%" class="text-center">일반회원</th>
								<th width="30%" class="text-center">플러스회원</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult01 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["CategoryName"]?></td>
								<? for ($iCnt01=1;$iCnt01<4;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01=="03") {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult02["iCnt03"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult02["iCnt03"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult02["iCnt03"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult02["iCnt03"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<? for ($iCnt01=1;$iCnt01<4;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult02["iCnt".$iCnt01]);
									if ($arrResult02["iCnt03"]!=0) {
										$iPercent=($arrResult02["iCnt".$iCnt01]/$arrResult02["iCnt03"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo " (".$iPercent."%)</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 - 회원 성별</h4>
				</div>
				<div class="panel-body">

					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="25%" rowspan="2" class="text-center">카테고리</th>
								<th width="50%" colspan="2" class="text-center">성별</th>
								<th width="25%" rowspan="2" class="text-center">점유율(%)</th>
							</tr>
							<tr>
								<th width="25%" class="text-center">여성</th>
								<th width="25%" class="text-center">남성</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult03 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["CategoryName"]?></td>
								<? for ($iCnt01=1;$iCnt01<4;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01=="03") {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult04["iCnt03"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult04["iCnt03"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult04["iCnt03"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult04["iCnt03"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<? for ($iCnt01=1;$iCnt01<4;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult04["iCnt".$iCnt01]);
									if ($arrResult04["iCnt03"]!=0) {
										$iPercent=($arrResult04["iCnt".$iCnt01]/$arrResult04["iCnt03"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo " (".$iPercent."%)</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-3">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 - 회원 연령대별</h4>
				</div>
				<div class="panel-body" id="panel-collapse-3">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="15%" rowspan="2" class="text-center">카테고리</th>
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
							<? foreach ($arrResult05 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["CategoryName"]?></td>
								<? for ($iCnt01=1;$iCnt01<9;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01=="08") {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult06["iCnt08"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult06["iCnt08"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult06["iCnt08"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult06["iCnt08"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</td>";
									}
								}
								?>
							</tr>
							<? } ?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<? for ($iCnt01=1;$iCnt01<9;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult06["iCnt".$iCnt01]);
									if ($arrResult06["iCnt08"]!=0) {
										$iPercent=($arrResult06["iCnt".$iCnt01]/$arrResult06["iCnt08"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo " (".$iPercent."%)</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-4">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 - 회원 지역별</h4>
				</div>
				<div class="panel-body" id="panel-collapse-4">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="12%" rowspan="2" class="text-center">카테고리</th>
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
							<? foreach ($arrResult07 as $row) { ?>
							<tr>
								<td class="text-center valign-middle"><?=$row["CategoryName"]?></td>
								<? for ($iCnt01=1;$iCnt01<19;$iCnt01++) {
									if ($iCnt01<10) {
										$iCnt01="0".$iCnt01;
									}
									if ($iCnt01=="18") {
										echo "<td class='text-center valign-middle'><span class='text-primary f-s-15 f-w-700'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult08["iCnt18"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult08["iCnt18"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</span></td>";
									} else {
										echo "<td class='text-center valign-middle'>";
										echo number_format($row["iCnt".$iCnt01]);
										if ($arrResult08["iCnt18"]!=0) {
											$iPercent=($row["iCnt".$iCnt01]/$arrResult08["iCnt18"])*100;
										} else {
											$iPercent=0;
										}
										$iPercent=fnRound02($iPercent,3);
										echo " (".$iPercent."%)</td>";
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
									echo "<td class='text-center valign-middle'><span class='text-warning f-s-15 f-w-700'>";
									echo number_format($arrResult08["iCnt".$iCnt01]);
									if ($arrResult08["iCnt18"]!=0) {
										$iPercent=($arrResult08["iCnt".$iCnt01]/$arrResult08["iCnt18"])*100;
									} else {
										$iPercent=0;
									}
									$iPercent=fnRound02($iPercent,3);
									echo " (".$iPercent."%)</span></td>";
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
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.categories.js"></script>
<script src="/assets/plugins/flot/jquery.flot.barnumbers.js"></script>
<script src="/assets/plugins/flot/jquery.flot.tooltip.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
});
</script>