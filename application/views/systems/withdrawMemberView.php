<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">회원 관리</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">탈퇴회원 현황 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body">
							<?=fnImageView("/member/".$arrResult->UserPhoto,"img-circle width-100","width:100px;height:100px;")?>
							<div class="name p-t-10"><?=$arrResult->UserName?></div>
							<ul class="list-group no-margin text-left p-t-10">
								<li class="list-group-item"><span class="text-success p-l-10">닉네임</span><span class="pull-right p-r-10"><?=$arrResult->UserNickName?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">이메일</span><span class="pull-right p-r-10"><?=$arrResult->UserId?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">가입경로</span><?=fnMemberAgreePath($arrResult->UserAgreePath)?></li>
								<li class="list-group-item"><span class="text-success p-l-10">가입일</span><span class="pull-right p-r-10"><?=$arrResult->RegDate?></span></li>
								<li class="list-group-item">
									<span class="text-success p-l-10">회원등급</span>
									<?=fnMemberGrade($arrResult->UserGrade)?>
								</li>
								<!-- 플러스 및 나눔회원 정보 -->
								<li class="list-group-item"><span class="text-warning p-l-10">I-CSS 등급</span><span class="badge badge-primary badge-square pull-right"><?=$arrResult->ICSSGrade?> (<?=$arrResult->ICSSScore?>)</span></li>
								<li class="list-group-item">
									<span class="text-warning p-l-10">나눔 여부</span>
									<?=fnMemberNanum($arrResult->UserNanumYn)?>
								</li>
								<li class="list-group-item">
									<span class="text-warning p-l-10">승계회원 여부</span>
									<?=fnMemberSuccessionYn($arrResult->UserSuccessionYn)?>
								</li>
								<li class="list-group-item"><span class="text-warning p-l-10">플러스 가입입</span><span class="text-danger pull-right p-r-10"><?=$arrResult->PlusRegDate?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="/systems/withdrawMemberList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin information -->
				<div id="information" class="p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 나눔/플러스 회원 정보
								<!-- 고객센터 회원상세로 연결 -->
								<a href="/systems/withdrawMemberList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<div class="panel-body panel-form form-horizontal form-bordered">
								<div class="alert alert-info p-10 m-b-0">
									<strong>기본정보</strong>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">이름 / 주민번호</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->UserName?> / <?=$arrResult->UserPSNNo?></div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">휴대전화</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->UserTel?></div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">주소</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->UserAddress01?> / <?=$arrResult->UserAddress02?></div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">세이프키 유무</label>
									<div class="col-md-8 col-sm-6 text-left">
									<?=fnMemberSafeKeyYn($arrResult->UserSafeKey)?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">계좌 정보</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->UserBank?> (<?=$arrResult->UserDepositor?>) <?=$arrResult->UserAccount?></div>
								</div>
								<? foreach ($arrResult02->result() as $row) { ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents"><?=$row->RegistItem?></label>
									<div class="col-md-8 col-sm-6 text-left"><?=$row->RegistValue?></div>
								</div>
								<? } ?>
								<div class="alert alert-info p-10 m-b-0">
									<strong>추가정보</strong>
								</div>
								<? foreach ($arrResult03->result() as $row) { ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents"><?=$row->RegistItem?></label>
									<div class="col-md-8 col-sm-6 text-left"><?=$row->RegistValue?></div>
								</div>
								<? } ?>
								<div class="alert alert-info p-10 m-b-0">
									<strong>탈퇴 정보</strong>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">탈퇴 이유(메모)</label>
									<div class="col-md-4 col-sm-6 text-left">
										<?=$arrResult->UserDelReason?>
									</div>
								</div>
								<div class="form-group"></div>
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