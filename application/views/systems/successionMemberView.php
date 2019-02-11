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
	<h1 class="page-header">회원가입 현황 <small>View</small></h1>
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
								<li class="list-group-item"><span class="text-info p-l-10">대기 스테이지</span><span class="badge badge-warning pull-right"><?=$arrResult->iCnt01?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">진행 스테이지</span><span class="badge badge-warning pull-right"><?=$arrResult->iCnt02?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">연체 누적횟수</span><span class="badge badge-warning pull-right"><?=$arrResult->iCnt05?></span></li>

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
						<a href="/systems/successionMemberList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
						<!-- 고객센터 회원상세로 연결 -->
						<a href="/customers/memberConsultBasic?Idx=<?=$arrResult->Idx?>" class="btn btn-warning btn-xs pull-right" target="_about"><i class="fa fa-eye"></i> 회원 상세</a>
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
								<a href="/customers/memberConsultBasic?Idx=<?=$arrResult->Idx?>" class="btn btn-warning btn-xs pull-right m-l-10"><i class="fa fa-eye"></i> 회원 상세</a>
								<a href="/systems/successionMemberList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
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
									<? if ($arrResult->UserSafeKey!="") { echo " ( 세이프키 : ".$arrResult->UserSafeKey.")"; } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">계좌 정보</label>
									<div class="col-md-8 col-sm-6 text-left"><?=$arrResult->UserBank?> (<?=$arrResult->UserDepositor?>) <?=$arrResult->UserAccount?> </div>
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
									<strong>관심카테고리</strong>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">관심카테고리</label>
									<div class="col-md-8 col-sm-6 text-left text-danger"><?=fnMemberCategory($arrResult->UserCategory)?></div>
								</div>
								<div class="alert alert-info p-10 m-b-0">
									<strong>승계회원</strong>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">승계회원 여부</label>
									<div class="col-md-8 col-sm-6 text-left">
										<?=fnMemberSuccessionYn($arrResult->UserSuccessionYn)?>
										<div class="btn-group">
											<a class="btn btn-info btn-xs" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-cog"></i> 승계 변경
												<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu">
												<li><a href="javascript:void(0);" class="Succession" data-yn="Y"> 승계회원으로 변경</a></li>
												<li><a href="javascript:void(0);" class="Succession" data-yn="N"> 승계취소로 변경</a></li>
											</ul>
										</div>
									</div>
								</div>
								<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm" action="/systems/successionMemberModifyProc" method="POST">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
								<input type="hidden" name="Idx" id="Idx" value="<?=$arrResult->Idx?>"/>
								<input type="hidden" name="sParam" id="sParam" value="<?=$sParam?>"/>
								<input type="hidden" name="sParam02" id="sParam" value="<?=$sParam02?>"/>
								<div class="alert alert-info p-10 m-b-0">
									<strong>탈퇴 정보</strong>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">탈퇴 가능여부</label>
									<div class="col-md-8 col-sm-6 text-left">
										<span class="text-danger"> * 현재 진행중(대기, 진행, 연체, 부실)인 스테이지가 없을 경우에만 탈퇴가 가능함 </span>
										<? if ($iCnt01!=0) { ?>
										<span class="badge badge-danger badge-square">불가</span>
										<? } else { ?>
										<span class="badge badge-primary badge-square">가능</span>
										<!-- 탈퇴가 가능할때 탈퇴시킴 -->
										<select class="form-control width-125" id="UserDelYn" name="UserDelYn">
											<option value="N" selected>전체(탈퇴)</option>
											<option value="Y">탈퇴하기</option>
										</select>
										<? } ?>
									</div>
								</div>
								<? if ($iCnt01==0) { ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">탈퇴 이유(메모)</label>
									<div class="col-md-4 col-sm-6 text-left">
										<textarea class="form-control" cols="20" rows="5" placeholder="내용" id="UserDelReason" name="UserDelReason"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12 text-center p-t-20">
										<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
										<a href="/systems/successionMemberList<?=$sParam02?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
									</div>
								</div>
								<? } ?>
								</form>
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
$('.Succession').click(function(e){
	$.ajax({
	url:"/systems/successionMemberChange?UserSuccessionYn="+$(this).data("yn")+"&Idx=<?=$arrResult->Idx?>",
	dataType:"json",
	}).done(function (data) {
		alert(data.sMessage);
		if (data.sRetCode=="01") {
			location.reload();
		} else {
			$('#modal-delete').modal('hide');
		}
	}).fail(function () {
		$('#modal-delete').modal('hide');
		alert('작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
	});
});
</script>