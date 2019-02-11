<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">스테이지 관리</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">미완성 스테이지 관리 <small>View</small></h1>
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
								<li class="active"><a href="#information" data-toggle="tab"><i class="fa fa-info-circle fa-fw m-r-5"></i> 기본정보 </a></li>
								<li><a href="#applicant" data-toggle="tab"><i class="fa fa-users fa-fw m-r-5"></i> 대기자(참여자) 현황 </a></li>
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
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="/systems/incompleteStageList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin information -->
				<div id="information" class="tab-pane fade active in p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 스테이지 기본 정보
								<a href="/systems/incompleteStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<div class="panel-body panel-form form-horizontal form-bordered">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">스테이지 제목</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult02->Title?></div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">스테이지 소개</label>
									<div class="col-md-8 col-sm-6 text-left"><?=fnEnter($arrResult02->Summary)?></div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">등록 사진</label>
									<div class="col-md-8 col-sm-6 text-left">
										<?=fnImageView02("/stage/medium/".$arrResult02->StageImage,"img-responsive","")?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">등록내용</label>
									<div class="col-md-8 col-sm-6 text-left">
										<?=fnEnter($arrResult02->Contents)?>
									</div>
								</div>
								<div class="form-group"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- end information -->

				<!-- begin applicant -->
				<div id="applicant" class="tab-pane fade p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 스테이지 대기자(참여자) 현황
								<a href="/systems/incompleteStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<!-- 인원수에 따라 테이블 width를 설정한다. -->
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-td-valign-middle table-primary">
									<thead>
										<tr>
											<th class="text-center">번호</th>
											<? for ($iCnt=1;$iCnt<=$arrResult02->StageNum;$iCnt++) {?>
											<th width="7%" class="text-center"><?=$iCnt?>번</th>
											<? } ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center text-primary">대기자</td>
											<? for ($iCnt=0;$iCnt<$arrResult02->StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult03[$iCnt]["UserNickName"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">참여일</td>
											<? for ($iCnt=0;$iCnt<$arrResult02->StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult03[$iCnt]["RegDate"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">등급</td>
											<? for ($iCnt=0;$iCnt<$arrResult02->StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult03[$iCnt]["ICSSGrade"]?></td>
											<? } ?>
										</tr>
										<tr>
											<td class="text-center text-primary">점수</td>
											<? for ($iCnt=0;$iCnt<$arrResult02->StageNum;$iCnt++) {?>
												<td class="text-center"><?=$arrResult03[$iCnt]["ICSSScore"]?></td>
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