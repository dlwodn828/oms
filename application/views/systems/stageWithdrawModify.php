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
	<h1 class="page-header">스테이지 약정철회 관리 <small>Edit</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
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
						<a href="/systems/stageWithdrawList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
						<a href="/systems/generalStageInformation?Idx=<?=$arrResult02["StageIdx"]?>" class="btn btn-warning btn-xs pull-right" target="_aboout"><i class="fa fa-eye"></i> 스태이지 상세</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin information -->
				<div class="panel panel-profile">
					<div class="wrapper">
						<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> 스테이지 약정철회 수정
							<a href="/systems/stageWithdrawList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
						</h4>
						<div class="panel-body panel-form form-horizontal form-bordered">
							<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm" action="/systems/stageWithdrawModifyProc" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
								<input type="hidden" name="Idx" id="Idx" value="<?=$Idx?>">
								<input type="hidden" name="sParam" id="sParam" value="<?=$sParam?>"/>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3">스테이지 제목</label>
									<div class="col-md-6 col-sm-6 text-left">
										<input class="form-control" type="text" value="<?=$arrResult02["Title"]?>" disabled />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3">담당자</label>
									<div class="col-md-4 col-sm-4 text-left">
										<input class="form-control" type="text" value="<?=$arrResult02["AdminName"]?>" disabled />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3">신청일</label>
									<div class="col-md-4 col-sm-4 text-left">
										<input class="form-control" type="text" value="<?=$arrResult02["RegDate"]?>" disabled />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="IncFile01">신청서</label>
									<div class="col-md-8 col-sm-6 text-left">
										<?=fnFileLink($arrResult02["IncFile01"],"stage")?>
										<input class="form-control" type="file" id="IncFile01[]" name="IncFile01[]" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">내용</label>
									<div class="col-md-8 col-sm-6 text-left">
										<textarea class="form-control" id="Contents" name="Contents" rows="10"><?=$arrResult02["Contents"]?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="State">처리상태</label>
									<div class="col-md-8 col-sm-6 text-left">
										<select class="form-control width-150" id="State" name="State">
											<option value="1" <?=checkSelect($arrResult02["State"],"1","s")?>>처리중</option>
											<option value="2" <?=checkSelect($arrResult02["State"],"2","s")?>>보류중</option>
											<option value="3" <?=checkSelect($arrResult02["State"],"3","s")?>>승계처리</option>
											<option value="4" <?=checkSelect($arrResult02["State"],"4","s")?>>탈퇴처리</option>
										</select>
									</div>
								</div>
								<div id="process-succession" class="form-group <? if ($arrResult02["State"]!="3") { echo "hidden"; } ?>">
									<label class="control-label col-md-3 col-sm-3" for="SuccessionIdx">승계회원</label>
									<div class="col-md-4 col-sm-4 input-group ">
										<input type="text" class="form-control" placeholder="승계회원 검색" name="SuccessionUserName" id="SuccessionUserName" value="<?=$arrResult02["SuccessionUserName"]?>" readonly>
										<input type="hidden" name="SuccessionIdx" id="SuccessionIdx" value="">
										<? if ($arrResult02["SuccessionIdx"]==0) { ?>
										<div class="input-group-btn">
											<a href="#modal-search" data-toggle="modal" class="btn btn-default fnSuccession"><i class="glyphicon glyphicon-search"></i></a>
										</div>
										<? } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="Contents">처리일</label>
									<div class="col-md-4 col-sm-4 text-left">
										<input class="form-control" type="text" value="<?=$arrResult02["ApproveDate"]?>" disabled />
									</div>
								</div>
								<? if ($arrResult02["SuccessionIdx"]==0) { ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3"><!--a href="#modal-delete" class="btn btn-danger btn-xs" data-toggle="modal" data-idx="23"><i class="glyphicon glyphicon-trash"></i> Delete</a--></label>
									<div class="col-md-6 col-sm-6 m-t-10 text-center">
										<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
										<a href="/systems/stageWithdrawList<?=$sParam02?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
									</div>
								</div>
								<? } ?>
								<div class="form-group"></div>
							</form>
						</div>
					</div>
				</div>
				<!-- end information -->
				<!-- #modal-search -->
				<div class="modal fade" id="modal-search">
					<div class="modal-dialog modal-medium">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Member Select</h4>
							</div>
							<div class="panel-body panel-form">
								<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm02" action="/settings/r_create_proc" method="POST">
									<input type="hidden" name="Idx" id="Idx" value=""/>

									<div class="profile-container">

										<div class="table-responsive">

											<table class="table table-bordered table-hover table-td-valign-middle table-primary">
												<thead>
													<tr>
														<th width="20%" class="text-center">코드</th>
														<th width="15%" class="text-center">회원명</th>
														<th class="text-center">이메일</th>
														<th width="20%" class="text-center">I-CSS(점수)</th>
														<th width="15%" class="text-center">Action</th>
													</tr>
												</thead>
												<tbody id="contentsList01"></tbody>
											</table>
										</div>
										<!-- end #table-responsive -->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- #modal-delete -->
				<div class="modal fade" id="modal-delete">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title">Post Delete</h4>
							</div>
							<div class="modal-body">
								정말로 삭제하시겠습니까?
							</div>
							<div class="modal-footer">
								<input type="hidden" id="delIdx" value="">
								<a class="btn btn-xs btn-white" data-dismiss="modal">Close</a>
								<a class="btn btn-xs btn-danger delProc" data-dismiss="modal">Delete</a>
							</div>
						</div>
					</div>
				</div><!-- end #modal-delete -->
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
	$("#State").change(function() {
		if ($(this).val()=="3") {
			$("#process-succession").removeClass("hidden");
		} else {
			$("#process-succession").addClass("hidden");
		}
	});
});
$(document).on("click",".fnSuccession",function(e) {
	fnBoardListAjax();
});
var sSendFlag=false;
$("#actForm").submit(function(e) {
	e.preventDefault();
	}).validate({
	rules: {
		"Contents": {required:true},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Contents" : {required : "내용을 입력해주세요."},
	},
	submitHandler:function(form) {
		if (($("#State").val()=="3")&&($("#SuccessionIdx").val()=="")) {
			alert("승계회원을 선택해주세요.");
			return false;
		}
		if (!sSendFlag) {
			sSendFlag=true;
			form.submit();
		} else {
		}
	}
});
$('.delProc').click(function(e){
	/* 히스토리 보전을 위해 삭제 일시적 정지
	$.ajax({
	url:"/systems/stageWithdrawDelProc?Idx=<?=$Idx?>",
	dataType:"json",
	}).done(function (data) {
		alert(data.sMessage);
		if (data.sRetCode=="01") {
			location.href="/systems/stageWithdrawList<?=$sParam02?>";
		} else {
			$('#modal-delete').modal('hide');
		}
	}).fail(function () {
		$('#modal-delete').modal('hide');
		alert('작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
	});
	*/
});
function fnBoardListAjax() {
	fnReset01();
	$.ajax({
		url:"/systems/memberSuccessionAjax",
		dataType: 'json',
		async: false,
		success:function(data){
			var obj = data;
			for (var iCnt=0;iCnt < obj["arrResult"].length; iCnt++){
				fnAjaxContents(obj["arrResult"][iCnt]);
			}
		}
		,beforeSend: function() {
		}
		,complete: function() {
		}
	});
}
function fnAjaxContents(objValue) {
	var sContents="";
	sContents+="<tr>";
	sContents+="	<td class='text-center'>"+objValue.UserCode+"</td>";
	sContents+="	<td class='text-center'>"+objValue.UserNickName+"</td>";
	sContents+="	<td class='text-center'>"+objValue.UserId+"</td>";
	sContents+="	<td class='text-center'>"+objValue.ICSSGrade+"("+objValue.ICSSScore+")</td>";
	sContents+="	<td class='text-center'>";
	sContents+="		<a class='btn btn-success btn-xs SuccessionSelect' data-dismiss='modal' data-username='"+objValue.UserNickName+"' data-idx='"+objValue.Idx+"' data-accountinfo='"+objValue.AccountInfo+"'><i class='fa fa-edit'></i> 선택</a>";
	sContents+="	</td>";
	sContents+="</tr>";
	$("#contentsList01").append(sContents);
}
function fnReset01() {
	$('#contentsList01 *').remove();
}
$(document).on("click",".SuccessionSelect",function(e) {
	if ($(this).data("accountinfo")=="Y") {
		$("#SuccessionUserName").val($(this).data("username"));
		$("#SuccessionIdx").val($(this).data("idx"));
	} else {
		alert("승계회원의 계좌정보를 확인해주세요.");
	}
});
</script>