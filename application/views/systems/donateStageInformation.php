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
	<h1 class="page-header">나눔 스테이지 현황 <small>View</small></h1>
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
								<li><a href="donateStageApplicant<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(관리) </a></li>
								<li><a href="donateStageStats<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(통계) </a></li>
								<li class="active"><a href="donateStageInformation<?=$sParam?>"><i class="fa fa-info-circle fa-fw m-r-5"></i> 기본정보 </a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-profile">
						<div class="panel-body">
							<ul class="list-group no-margin text-left">
								<li class="list-group-item"><span class="text-info p-l-10">스테이지 코드</span><span class="text-danger pull-right p-r-10"><?=$arrResult->StageCode?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">상태여부</span><?=fnRetState($arrResult->StatusYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">노출여부</span><?=fnRetState($arrResult->DisplayYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">기간</span><span class="text-danger pull-right p-r-10"><?=$arrResult->StageStart?>~<?=$arrResult->StageEnd?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">개설일</span><span class="text-danger pull-right p-r-10"><?=$arrResult->RegDate?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">후원처</span><span class="text-primary pull-right p-r-10"><?=$arrResult->CompanyName?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">목표금액</span><span class="badge badge-primary badge-square pull-right m-r-10"><?=$arrResult->TargetMoney?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">담당자</span><span class="text-primary pull-right p-r-10"><?=$arrResult->CompanyDamdang?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">연락처</span><span class="text-primary pull-right p-r-10"><?=$arrResult->CompanyTel?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="http://www.google.co.kr" target="_about" class="btn btn-info btn-xs"><i class="fa fa-link"></i> 홈페이지</a>
						<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin information -->
				<div class="panel panel-profile">
					<div class="wrapper">
						<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 스테이지 기본 정보
							<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
						</h4>
						<div class="text-center alert alert-info p-10 m-b-0">
							<strong>스테이지 정보</strong>
						</div>
						<div class="panel-body panel-form form-horizontal form-bordered">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">스테이지 제목</label>
								<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->Title?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">스테이지 간략소개</label>
								<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->Summary?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">스테이지 이미지</label>
								<div class="col-md-4 col-sm-8 text-left">
									<?=fnImageView02("/systems/".$arrResult->StageImage,"img-responsive","")?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">목표금액</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->TargetMoney?>원</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">기간</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->StageStart?> ~ <?=$arrResult->StageEnd?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">계좌정보 1</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->BankAccount1?> <?=$arrResult->BankName1?> <?=$arrResult->BankDepositor1?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">계좌정보 2</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->BankAccount2?> <?=$arrResult->BankName2?> <?=$arrResult->BankDepositor2?></div>
							</div>

							<div class="text-center alert alert-info p-10 m-b-0">
								<strong>후원처 정보</strong>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">로고 및 대표이미지</label>
								<div class="col-md-4 col-sm-4 text-left">
									<?=fnImageView02("/systems/".$arrResult->CompanyLogoImage,"img-responsive","")?>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">후원처</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->CompanyName?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">담당자</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->CompanyDamdang?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">연락처</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->CompanyTel?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">주소</label>
								<div class="col-md-4 col-sm-6 text-left"><?=$arrResult->CompanyAddress?></div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="Contents">웹사이트</label>
								<div class="col-md-4 col-sm-6 text-left"><a href="<?=$arrResult->CompanyHomepage?>" target="_about"><?=$arrResult->CompanyHomepage?></a></div>
							</div>
							<div class="text-center alert alert-info p-10 m-b-0">
								<strong>상세설명 정보</strong>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2" for="message">상세설명 1 *</label>
								<div class="col-md-9 col-sm-9">
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">이미지 *</label>
										<div class="col-md-4 col-sm-6">
											<?=fnImageView02("/systems/".$arrResult->DetailImage1,"img-responsive","")?>
										</div>
									</div>
									<!--div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="fullname">동영상주소</label>
										<div class="col-md-4 col-sm-6">
											<?=$arrResult->DetailMedia1?>
										</div>
									</div-->
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">상세 내용</label>
										<div class="col-md-8 col-sm-8 text-left"> <?=nl2br($arrResult->DetailContent1)?></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2" for="message">상세설명 2 *</label>
								<div class="col-md-9 col-sm-9">
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">이미지 *</label>
										<div class="col-md-4 col-sm-6">
											<?=fnImageView02("/systems/".$arrResult->DetailImage2,"img-responsive","")?>
										</div>
									</div>
									<!--div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="fullname">동영상주소</label>
										<div class="col-md-4 col-sm-6">
											<?=$arrResult->DetailMedia2?>
										</div>
									</div-->
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">상세 내용</label>
										<div class="col-md-8 col-sm-8 text-left"> <?=nl2br($arrResult->DetailContent2)?></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2" for="message">상세설명 3 *</label>
								<div class="col-md-9 col-sm-9">
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">이미지 *</label>
										<div class="col-md-4 col-sm-6">
											<?=fnImageView02("/systems/".$arrResult->DetailImage3,"img-responsive","")?>
										</div>
									</div>
									<!--div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="fullname">동영상주소</label>
										<div class="col-md-4 col-sm-6">
											<?=$arrResult->DetailMedia3?>
										</div>
									</div-->
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-2" for="message">상세 내용</label>
										<div class="col-md-8 col-sm-8 text-left"> <?=nl2br($arrResult->DetailContent3)?></div>
									</div>
								</div>
							</div>

							<div class="form-group p-t-20">
								<a href="donateStageList" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
							</div>

						</div>
					</div>
				</div>
				<!-- end information -->
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