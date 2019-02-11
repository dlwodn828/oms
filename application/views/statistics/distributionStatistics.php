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
	<h1 class="page-header">회원분포 통계 <small>Statistics</small></h1>
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
					<h4 class="panel-title">회원등급</h4>
				</div>
				<div class="panel-body">
					<div id="nv-donut-grade" class="height-sm"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="20%" class="text-center"></th>
							<th width="20%" class="text-center">일반회원</th>
							<!--th width="20%" class="text-center">나눔회원</th-->
							<th width="20%" class="text-center">플러스회원</th>
							<th width="20%" class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult01["iCnt01"]);?></td>
								<!--td class="text-center valign-middle">25,000</td-->
								<td class="text-center valign-middle"><?=number_format($arrResult01["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult01["iCnt03"]);?></td>
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

		<!-- 플러스회원 필수가입 정보 통계 -->
		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-2">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 필수 통계(성별)</h4>
				</div>
				<div class="panel-body">
					<div id="nv-donut-gender" class="height-sm"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">여성</th>
							<th width="25%" class="text-center">남성</th>
							<th width="25%" class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult02["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult02["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult02["iCnt03"]);?></td>
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
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700"><?=$iPercent02_02?>%</span></td>
								<td class="text-center valign-middle"><span class="text-danger f-s-15 f-w-700">100%</span></td>
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
					<h4 class="panel-title">플러스회원 필수 통계(연령별)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-3">
					<div id="nv-bar-age" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="11%" class="text-center"></th>
							<th width="11%" class="text-center">20대</th>
							<th width="11%" class="text-center">30대</th>
							<th width="11%" class="text-center">40대</th>
							<th width="11%" class="text-center">50대</th>
							<th width="11%" class="text-center">60대</th>
							<th width="11%" class="text-center">70대</th>
							<th width="11%" class="text-center">80대 이상</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt06"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt07"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult03["iCnt08"]);?></td>
							</tr>
							<?
							if ($arrResult03["iCnt08"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult03);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									$arrPercent03[$iCnt01]=($arrResult03["iCnt0".$iCnt02]/$arrResult03["iCnt08"])*100;
									$arrPercent03[$iCnt01]=fnRound02($arrPercent03[$iCnt01],3);
								}
							} else {
								$arrPercent03=array(0,0,0,0,0,0,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent03);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent03[$iCnt01]."%</span></td>";
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
					<h4 class="panel-title">플러스회원 필수 통계(지역)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-4">
					<div id="nv-bar-address" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th class="text-center"></th>
							<th width="5%" class="text-center">서울</th>
							<th width="5%" class="text-center">부산</th>
							<th width="5%" class="text-center">대구</th>
							<th width="5%" class="text-center">인천</th>
							<th width="5%" class="text-center">광주</th>
							<th width="5%" class="text-center">대전</th>
							<th width="5%" class="text-center">울산</th>
							<th width="5%" class="text-center">세종</th>
							<th width="5%" class="text-center">경기</th>
							<th width="5%" class="text-center">강원</th>
							<th width="5%" class="text-center">충북</th>
							<th width="5%" class="text-center">충남</th>
							<th width="5%" class="text-center">전북</th>
							<th width="5%" class="text-center">전남</th>
							<th width="5%" class="text-center">경북</th>
							<th width="5%" class="text-center">경남</th>
							<th width="5%" class="text-center">제주</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt06"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt07"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt08"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt09"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt10"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt11"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt12"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt13"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt14"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt15"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt16"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt17"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult04["iCnt18"]);?></td>
							</tr>
							<?
							if ($arrResult04["iCnt18"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult04);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent04[$iCnt01]=($arrResult04["iCnt".$iCnt02]/$arrResult04["iCnt18"])*100;
									$arrPercent04[$iCnt01]=fnRound02($arrPercent04[$iCnt01],3);
								}
							} else {
								$arrPercent04=array_fill(0,18,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent04);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent04[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- 플러스회원 추가정보 가입 정보 통계 -->
		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-5">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (결혼여부)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-5">
					<div id="nv-donut-marriage" class="height-sm m-b-20"></div>

					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">미혼</th>
							<th width="25%" class="text-center">기혼</th>
							<th width="25%" class="text-center">응답회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult05["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult05["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult05["iCnt03"]);?></td>
							</tr>
							<?
							if ($arrResult05["iCnt03"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult05);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent05[$iCnt01]=($arrResult05["iCnt".$iCnt02]/$arrResult05["iCnt03"])*100;
									$arrPercent05[$iCnt01]=fnRound02($arrPercent05[$iCnt01],3);
								}
							} else {
								$arrPercent05=array_fill(0,2,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent05);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent05[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-6">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (자녀여부)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-6">
					<div id="nv-donut-child" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">자녀있음</th>
							<th width="25%" class="text-center">자녀없음</th>
							<th width="25%" class="text-center">응답회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult06["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult06["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult06["iCnt03"]);?></td>
							</tr>
							<?
							if ($arrResult06["iCnt03"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult06);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent06[$iCnt01]=($arrResult06["iCnt".$iCnt02]/$arrResult06["iCnt03"])*100;
									$arrPercent06[$iCnt01]=fnRound02($arrPercent06[$iCnt01],3);
								}
							} else {
								$arrPercent06=array_fill(0,2,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent06);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent06[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-7">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (직업)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-7">
					<div id="nv-bar-job" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="11%" class="text-center"></th>
							<th width="11%" class="text-center">공무원</th>
							<th width="11%" class="text-center">직장인</th>
							<th width="11%" class="text-center">자영업</th>
							<th width="11%" class="text-center">프리랜서</th>
							<th width="11%" class="text-center">주부</th>
							<th width="11%" class="text-center">학생</th>
							<th width="11%" class="text-center">무직</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt06"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt07"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult07["iCnt08"]);?></td>
							</tr>
							<?
							if ($arrResult07["iCnt08"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult07);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent07[$iCnt01]=($arrResult07["iCnt".$iCnt02]/$arrResult07["iCnt08"])*100;
									$arrPercent07[$iCnt01]=fnRound02($arrPercent07[$iCnt01],3);
								}
							} else {
								$arrPercent07=array_fill(0,8,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent07);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent07[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-8">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (근속년수)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-8">
					<div id="nv-bar-working" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th class="text-center"></th>
							<th width="15%" class="text-center">1년 이하</th>
							<th width="15%" class="text-center">1~3년</th>
							<th width="15%" class="text-center">3~5년</th>
							<th width="15%" class="text-center">5~7년</th>
							<th width="15%" class="text-center">7년이상</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult08["iCnt06"]);?></td>
							</tr>
							<?
							if ($arrResult08["iCnt06"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult08);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent08[$iCnt01]=($arrResult08["iCnt".$iCnt02]/$arrResult08["iCnt06"])*100;
									$arrPercent08[$iCnt01]=fnRound02($arrPercent08[$iCnt01],3);
								}
							} else {
								$arrPercent08=array_fill(0,6,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent08);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent08[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-9">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (주택보유여부)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-9">
					<div id="nv-donut-house" class="height-sm m-b-20"></div>

					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">보유</th>
							<th width="25%" class="text-center">미보유</th>
							<th width="25%" class="text-center">응답회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult09["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult09["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult09["iCnt03"]);?></td>
							</tr>
							<?
							if ($arrResult09["iCnt03"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult09);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent09[$iCnt01]=($arrResult09["iCnt".$iCnt02]/$arrResult09["iCnt03"])*100;
									$arrPercent09[$iCnt01]=fnRound02($arrPercent09[$iCnt01],3);
								}
							} else {
								$arrPercent09=array_fill(0,2,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent09);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent09[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-inverse" data-sortable-id="index-10">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (자동차보유여부)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-10">
					<div id="nv-donut-car" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th width="25%" class="text-center"></th>
							<th width="25%" class="text-center">보유</th>
							<th width="25%" class="text-center">미보유</th>
							<th width="25%" class="text-center">응답회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult10["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult10["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult10["iCnt03"]);?></td>
							</tr>
							<?
							if ($arrResult10["iCnt03"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult10);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent10[$iCnt01]=($arrResult10["iCnt".$iCnt02]/$arrResult10["iCnt03"])*100;
									$arrPercent10[$iCnt01]=fnRound02($arrPercent10[$iCnt01],3);
								}
							} else {
								$arrPercent10=array_fill(0,2,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent10);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent10[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-11">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 추가가입 정보 (주거형태)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-11">
					<div id="nv-bar-live" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th class="text-center"></th>
							<th width="15%" class="text-center">자가아파트</th>
							<th width="15%" class="text-center">자가주택</th>
							<th width="15%" class="text-center">전세아파트</th>
							<th width="15%" class="text-center">전세주택</th>
							<th width="15%" class="text-center">월세</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult11["iCnt06"]);?></td>
							</tr>
							<?
							if ($arrResult11["iCnt06"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult11);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent11[$iCnt01]=($arrResult11["iCnt".$iCnt02]/$arrResult11["iCnt06"])*100;
									$arrPercent11[$iCnt01]=fnRound02($arrPercent11[$iCnt01],3);
								}
							} else {
								$arrPercent11=array_fill(0,6,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent11);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent11[$iCnt01]."%</span></td>";
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-inverse" data-sortable-id="index-12">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<!--a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a-->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">플러스회원 필수가입 정보 (가입경로)</h4>
				</div>
				<div class="panel-body" id="panel-collapse-12">
					<div id="nv-bar-join" class="height-sm m-b-20"></div>
					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
						<tr>
							<th class="text-center"></th>
							<th width="12%" class="text-center">인터넷검색</th>
							<th width="12%" class="text-center">언론기사</th>
							<th width="12%" class="text-center">인터넷광고</th>
							<th width="12%" class="text-center">지인추천</th>
							<th width="12%" class="text-center">블로그</th>
							<th width="12%" class="text-center">SNS</th>
							<th class="text-center">전체회원</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center valign-middle">인원</td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt01"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt02"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt03"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt04"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt05"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt06"]);?></td>
								<td class="text-center valign-middle"><?=number_format($arrResult12["iCnt07"]);?></td>
							</tr>
							<?
							if ($arrResult12["iCnt07"]!=0) {
								for ($iCnt01=0;$iCnt01<sizeof($arrResult12);$iCnt01++) {
									$iCnt02=$iCnt01+1;
									if ($iCnt02<10) {
										$iCnt02="0".$iCnt02;
									}
									$arrPercent12[$iCnt01]=($arrResult12["iCnt".$iCnt02]/$arrResult12["iCnt07"])*100;
									$arrPercent12[$iCnt01]=fnRound02($arrPercent12[$iCnt01],3);
								}
							} else {
								$arrPercent12=array_fill(0,7,0);
							}
							?>
							<tr>
								<td class="text-center valign-middle">점유율(%)</td>
								<?
								for ($iCnt01=0;$iCnt01<sizeof($arrPercent12);$iCnt01++) {
									echo "<td class='text-center valign-middle'><span class='text-danger f-s-15 f-w-700'>".$arrPercent12[$iCnt01]."%</span></td>";
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
<script src="/assets/js/chart-statistics-members.member.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	var options =
	{
		dataGrade: [
			{ 'label': '일반회원', 'value' : <?=$iPercent01_01?>, 'color': red },
			//{ 'label': '나눔회원', 'value' : 15, 'color': orange },
			{ 'label': '플러스회원', 'value' : <?=$iPercent01_02?>, 'color': green }
		],
		dataGender: [
			{ 'label': '여성', 'value' : <?=$iPercent02_01?>, 'color': red },
			{ 'label': '남성', 'value' : <?=$iPercent02_02?>, 'color': orange }
		],
		dataAge: [
			{ 'label': '20대', 'value' : "<?=$arrPercent03[0]?>", 'color': red },
			{ 'label': '30대', 'value' : "<?=$arrPercent03[1]?>", 'color': orange },
			{ 'label': '40대', 'value' : "<?=$arrPercent03[2]?>", 'color': green },
			{ 'label': '50대', 'value' : "<?=$arrPercent03[3]?>", 'color': aqua },
			{ 'label': '60대', 'value' : "<?=$arrPercent03[4]?>", 'color': blue },
			{ 'label': '70대', 'value' : "<?=$arrPercent03[5]?>", 'color': purple },
			{ 'label': '80이상', 'value' : "<?=$arrPercent03[6]?>", 'color': grey }
		],
		dataAddress: [
			{ 'label': '서울', 'value' : "<?=$arrPercent04[0]?>", 'color': red },
			{ 'label': '부산', 'value' : "<?=$arrPercent04[1]?>", 'color': orange },
			{ 'label': '대구', 'value' : "<?=$arrPercent04[2]?>", 'color': green },
			{ 'label': '인천', 'value' : "<?=$arrPercent04[3]?>", 'color': aqua },
			{ 'label': '광주', 'value' : "<?=$arrPercent04[4]?>", 'color': blue },
			{ 'label': '대전', 'value' : "<?=$arrPercent04[5]?>", 'color': purple },
			{ 'label': '울산', 'value' : "<?=$arrPercent04[6]?>", 'color': grey },
			{ 'label': '세종', 'value' : "<?=$arrPercent04[7]?>", 'color': red },
			{ 'label': '경기', 'value' : "<?=$arrPercent04[8]?>", 'color': orange },
			{ 'label': '강원', 'value' : "<?=$arrPercent04[9]?>", 'color': green },
			{ 'label': '충북', 'value' : "<?=$arrPercent04[10]?>", 'color': aqua },
			{ 'label': '충남', 'value' : "<?=$arrPercent04[11]?>", 'color': blue },
			{ 'label': '전북', 'value' : "<?=$arrPercent04[12]?>", 'color': purple },
			{ 'label': '전남', 'value' : "<?=$arrPercent04[13]?>", 'color': grey },
			{ 'label': '경북', 'value' : "<?=$arrPercent04[14]?>", 'color': red },
			{ 'label': '경남', 'value' : "<?=$arrPercent04[15]?>", 'color': orange },
			{ 'label': '제주', 'value' : "<?=$arrPercent04[16]?>", 'color': green }
		],
		dataMarriage: [
			{ 'label': '미혼', 'value' : "<?=$arrPercent05[0]?>", 'color': red },
			{ 'label': '기혼', 'value' : "<?=$arrPercent05[1]?>", 'color': green }
		],
		dataChild: [
			{ 'label': '자녀있음', 'value' : "<?=$arrPercent06[0]?>", 'color': red },
			{ 'label': '자녀없음', 'value' : "<?=$arrPercent06[1]?>", 'color': green }
		],
		dataJob: [
			{ 'label': '공무원', 'value' : "<?=$arrPercent07[0]?>", 'color': red },
			{ 'label': '직장인', 'value' : "<?=$arrPercent07[1]?>", 'color': orange },
			{ 'label': '자영업', 'value' : "<?=$arrPercent07[2]?>", 'color': green },
			{ 'label': '프리랜서', 'value' : "<?=$arrPercent07[3]?>", 'color': aqua },
			{ 'label': '주부', 'value' : "<?=$arrPercent07[4]?>", 'color': blue },
			{ 'label': '학생', 'value' : "<?=$arrPercent07[5]?>", 'color': purple },
			{ 'label': '무직', 'value' : "<?=$arrPercent07[6]?>", 'color': grey }
		],
		dataWorking: [
			{ 'label': '1년미만', 'value' : "<?=$arrPercent08[0]?>", 'color': red },
			{ 'label': '1~3년', 'value' : "<?=$arrPercent08[1]?>", 'color': orange },
			{ 'label': '3~5년', 'value' : "<?=$arrPercent08[2]?>", 'color': green },
			{ 'label': '5~7년', 'value' : "<?=$arrPercent08[3]?>", 'color': aqua },
			{ 'label': '7년이상', 'value' : "<?=$arrPercent08[4]?>", 'color': blue }
		],
		dataHouse: [
			{ 'label': '보유', 'value' : "<?=$arrPercent09[0]?>", 'color': red },
			{ 'label': '미보유', 'value' : "<?=$arrPercent09[1]?>", 'color': green }
		],
		dataCar: [
			{ 'label': '보유', 'value' : "<?=$arrPercent10[0]?>", 'color': red },
			{ 'label': '미보유', 'value' : "<?=$arrPercent10[1]?>", 'color': green }
		],
		dataLive: [
			{ 'label': '자가아파트', 'value' : "<?=$arrPercent11[0]?>", 'color': red },
			{ 'label': '자가주택', 'value' : "<?=$arrPercent11[1]?>", 'color': orange },
			{ 'label': '전세아파트', 'value' : "<?=$arrPercent11[2]?>", 'color': green },
			{ 'label': '전세주택', 'value' : "<?=$arrPercent11[3]?>", 'color': aqua },
			{ 'label': '월세', 'value' : "<?=$arrPercent11[4]?>", 'color': blue }
		],
		dataJoin: [
			{ 'label': '인터넷검색', 'value' : "<?=$arrPercent12[0]?>", 'color': red },
			{ 'label': '언론기사', 'value' : "<?=$arrPercent12[1]?>", 'color': orange },
			{ 'label': '인터넷광고', 'value' : "<?=$arrPercent12[2]?>", 'color': green },
			{ 'label': '지인추천', 'value' : "<?=$arrPercent12[3]?>", 'color': aqua },
			{ 'label': '블로그', 'value' : "<?=$arrPercent12[4]?>", 'color': blue },
			{ 'label': 'SNS', 'value' : "<?=$arrPercent12[5]?>", 'color': red }
		]
	};
	ChartStatisticsMembers.init(options);
});
</script>