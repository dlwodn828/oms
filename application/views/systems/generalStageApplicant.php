<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">스테이지 현황</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">일반 스테이지 현황 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body text-left">
							<p><b>STAGE</b></p>
							<ul class="nav nav-pills nav-stacked nav-sm">
								<li><a href="/systems/generalStageInformation<?=$sParam02?>&Idx=<?=$Idx?>"><i class="fa fa-info-circle fa-fw m-r-5"></i> 기본정보 </a></li>
								<li class="active"><a href="/systems/generalStageApplicant<?=$sParam02?>&Idx=<?=$Idx?>"><i class="fa fa-users fa-fw m-r-5"></i> 대기자(참여자) 현황 </a></li>
								<li><a href="/systems/generalStageDeposit<?=$sParam02?>&Idx=<?=$Idx?>"><i class="fa fa-sign-in fa-fw m-r-5"></i> 입금 현황 </a></li>
								<li><a href="/systems/generalStagePayment<?=$sParam02?>&Idx=<?=$Idx?>"><i class="fa fa-sign-out fa-fw m-r-5"></i> 지급 현황 </a></li>
								<li><a href="/systems/generalStageRate<?=$sParam02?>&Idx=<?=$Idx?>"><i class="fa fa-sort-amount-asc fa-fw m-r-5"></i> 이율표 </a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-profile">
						<div class="panel-body">
							<ul class="list-group no-margin text-left">
								<li class="list-group-item"><span class="text-success p-l-10">스테이지 코드</span><span class="text-danger pull-right p-r-10"><?=$arrResult01->StageCode?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">공개여부</span><span class="pull-right p-r-10"><?=fnStageSecret02($arrResult01->SecretYN)?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">카테고리</span><span class="text-danger pull-right p-r-10"><?=$arrResult01->CategoryName?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">참여인원</span><span class="badge badge-primary badge-square pull-right"><?=$arrResult01->StageNum?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">이율</span><span class="badge badge-primary badge-square pull-right"><?=$arrResult01->StageRate?>%</span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">약정금액</span><span class="badge badge-primary badge-square pull-right"><?=number_format($arrResult01->StageMoney*10000)?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">개설일</span><span class="text-danger pull-right p-r-10"><?=$arrResult01->RegDate?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">효력개시일</span><span class="text-danger pull-right p-r-10"><?=$arrResult01->StartDate?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">만기일</span><span class="text-danger pull-right p-r-10"><?=$arrResult01->EndDate?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">진행상태</span><span class="badge badge-primary badge-square pull-right p-r-10"><?=fnStageState($arrResult01->State)?></span></li>
								<!-- 스테이지가 연체 부실일 경우 -->
								<li class="list-group-item"><span class="text-warning p-l-10">경과일</span><span class="badge badge-danger badge-square pull-right p-r-10">+<?=$arrResult01->OverDate?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="/systems/generalStageList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-contetn">
				<!-- begin applicant -->
				<div id="applicant" class="p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 스테이지 대기자(참여자) 현황
								<a href="/systems/generalStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<!-- 인원수에 따라 테이블 width를 설정한다. -->
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-td-valign-middle table-primary p-5">
									<thead>
										<tr>
											<th class="text-center">번호</th>
											<? for ($iCnt=1;$iCnt<=$StageNum;$iCnt++) {?>
											<th width="7%" class="text-center"><?=$iCnt?>번</th>
											<? } ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center text-primary">참여자</td>
											<? for ($iCnt=0;$iCnt<$StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult02[$iCnt]["UserNickName"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">참여일</td>
											<? for ($iCnt=0;$iCnt<$StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult02[$iCnt]["RegDate"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">등급</td>
											<? for ($iCnt=0;$iCnt<$StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult02[$iCnt]["ICSSGrade"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">점수</td>
											<? for ($iCnt=0;$iCnt<$StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult02[$iCnt]["ICSSScore"]?></td>
											<? } ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- end applicant -->
			</div>
			<!-- end vertical-box-column -->
		</div>
	</div>
	<!-- end vertical-box -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
});
</script>