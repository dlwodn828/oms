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
	<h1 class="page-header">회원점핑 쿠폰관리 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<form class="form-inline" role="form" id="actForm" method="get">
				<input type="hidden" name="Idx" id="Idx" value="<?=$Idx?>">
				<input type="hidden" name="sPage" id="sPage" value="<?=$sPage?>">
				<input type="hidden" name="sSearchWord" id="sSearchWord" value="<?=$sSearchWord?>">
				<input type="hidden" name="sSearchUserGrade" id="sSearchUserGrade" value="<?=$sSearchUserGrade?>">
				<input type="hidden" name="sSearchUserAgreePath" id="sSearchUserAgreePath" value="<?=$sSearchUserAgreePath?>">
				<input type="hidden" name="sSearchUserCategory" id="sSearchUserCategory" value="<?=$sSearchUserCategory?>">
				<input type="hidden" name="dStartDate" id="dStartDate" value="<?=$dStartDate?>">
				<input type="hidden" name="dEndDate" id="dEndDate" value="<?=$dEndDate?>">
				<input type="hidden" name="sPage02" id="sPage02" value="">
				</form>
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body text-left">
							<p><b>점핑 쿠폰</b></p>
							<ul class="nav nav-pills nav-stacked nav-sm">
								<li class="active"><a href="/systems/jumpingCouponUseList<?=$sParam?>"><i class="fa fa-minus-square fa-fw m-r-5"></i> 사용내역 <span class="badge badge-danger pull-right"><?=$arrResult02->iCnt03?></span></a></li>
								<li><a href="/systems/jumpingCouponIssueList<?=$sParam?>"><i class="fa fa-plus-square fa-fw m-r-5"></i> 발급종류 </a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-profile">
						<div class="panel-body">
							<?=fnImageView("/member/".$arrResult02->UserPhoto,"img-circle width-100","width:100px;height:100px;")?>
							<div class="name p-t-10"><?=$arrResult02->UserName?></div>
							<ul class="list-group no-margin text-left p-t-10">
								<li class="list-group-item"><span class="text-success p-l-10">닉네임</span><span class="pull-right p-r-10"><?=$arrResult02->UserNickName?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">이메일</span><span class="pull-right p-r-10"><?=$arrResult02->UserId?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">가입일</span><span class="pull-right p-r-10"><?=$arrResult02->RegDate?></span></li>
								<li class="list-group-item">
									<span class="text-success p-l-10">회원등급</span>
									<?=fnMemberGrade($arrResult02->UserGrade)?>
								</li>
								<li class="list-group-item text-left">
								<span class="text-success p-l-10 ">관심카테고리</span>
								<span class="pull-right  text-danger"><?=fnMemberCategory($arrResult02->UserCategory)?></span>
								</li>
								<li class="list-group-item"><span class="text-info p-l-10">대기 스테이지</span><span class="badge badge-warning pull-right"><?=$arrResult02->iCnt01?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">진행 스테이지</span><span class="badge badge-warning pull-right"><?=$arrResult02->iCnt02?></span></li>
								<!-- 플러스 및 나눔회원 정보 -->
								<li class="list-group-item"><span class="text-warning p-l-10">I-CSS 등급</span><span class="badge badge-primary badge-square pull-right"><?=$arrResult02->ICSSGrade?> (<?=$arrResult02->ICSSScore?>)</span></li>
								<li class="list-group-item">
									<span class="text-warning p-l-10">나눔여부</span>
									<?=fnMemberNanum($arrResult02->UserNanumYn)?>
								</li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="/systems/jumpingCouponList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
						<!-- 고객센터 회원상세로 연결 -->
						<a href="#none" class="btn btn-warning btn-xs pull-right"><i class="fa fa-eye"></i> 회원 상세</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin jumping history -->
				<div id="jumping" class="p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 점핑쿠폰 사용내역 (현재 사용가능 점핑수 : <span class="badge badge-warning"><?=$arrResult02->iCnt04?></span>)
								<a href="/systems/jumpingCouponList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-td-valign-middle table-primary">
									<thead>
										<tr>
											<th width="10%" class="text-center">번호</th>
											<th class="text-center">사용 내역</th>
											<th width="20%" class="text-center">사용 날짜</th>
											<th width="10%" class="text-center">사용 쿠폰 수</th>
										</tr>
									</thead>
									<tbody>
										<? foreach ($arrResult->result() as $row) { ?>
										<tr>
											<td class="text-center"><?=$iNum--?></td>
											<td class="text-center"><?=$row->Contents?></td>
											<td class="text-center"><?=$row->RegDate?></td>
											<td class="text-center">
											<?
											if ($row->Point < 0) {
												echo "<span class='text-danger'>".$row->Point."</span>";
											} else {
												echo $row->Point;
											}
											?></td>
										</tr>
										<? } ?>
									</tbody>
								</table>
								<!-- pagination -->
								<div class="panel-body">
									<div class="dataTables_info" id="data-table_info">
										<a href="#modal-create" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> 직접 쿠폰 발급</a>
									</div>
									<div class="dataTables_paginate paging_simple_numbers pull-right" id="data-table_paginate">
										<?=$sPaging?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end information -->
			</div>
			<!-- end vertical-box-column -->
		</div>
		<!-- #modal-create -->
		<div class="modal fade" id="modal-create">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Post Create</h4>
					</div>
					<div class="panel-body panel-form">
						<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm02" action="/systems/jumpingCouponUseCreateProc" method="POST">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
						<input type="hidden" name="UserIdx" id="UserIdx" value="<?=$arrResult02->Idx?>"/>
						<input type="hidden" name="sParam" value="<?=$sParam?>">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname">회원명 /이메일 *</label>
								<div class="col-md-6 col-sm-6">
									<input type="text" class="form-control" id="" name="" value="<?=$UserName.' / '.$arrResult02->UserId?>" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname">발급내용 *</label>
								<div class="col-md-6 col-sm-6">
									<input type="text" class="form-control" id="Contents" name="Contents" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname">점핑수 *</label>
								<div class="col-md-2 col-sm-4">
									<input type="number" class="form-control" id="Point" name="Point" min="-10" max="999" />
								</div>
							</div>
							<div class="modal-footer">
								<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
								<input type="submit" class="btn btn-primary" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
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
//폼전송
var sSendFlag=false;
var sSendFlag02=false;
$("#actForm02").submit(function(e) {
	e.preventDefault();
	}).validate({
		rules: {
			"Contents": {required:true,maxlength:255},
			"Point": {required:true,number:true,maxlength:11},
		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		messages: {
			"Contents" : {required : "발급내용을 입력해주세요."},
			"Point" : {required : "점핑수를 입력해주세요."},
		},
		submitHandler:function(form) {
			if (!sSendFlag) {
				sSendFlag=true;
				form.submit();
			} else {
			}
		}
});
//modal창 제어
$('#modal-create').on('hide.bs.modal', function (e) {
	$("#Contents").val("");
	$("#Point").val("");
});
</script>
