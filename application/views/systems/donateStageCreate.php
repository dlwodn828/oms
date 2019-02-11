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
	<h1 class="page-header">나눔 스테이지 관리 <small>Create</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" id="actForm" action="/systems/donateStageCreateProc" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
				<div class="text-center alert alert-info p-10 m-b-0">
					<strong>스테이지 정보</strong>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="Title">스테이지 제목 *</label>
					<div class="col-md-5 col-sm-5">
						<input class="form-control" type="text" id="Title" name="Title" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="Summary">스테이지 간략소개 *</label>
					<div class="col-md-9 col-sm-9">
						<input class="form-control" type="text" id="Summary" name="Summary" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="DonateImage">스테이지 이미지 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="StageImage[]" name="StageImage[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md- col-sm-2" for="TargetMoney">목표금액 *</label>
					<div class="col-md-4 col-sm-4 form-inline">
						<input class="form-control" type="text" id="TargetMoney" name="TargetMoney" /> 원
					</div>
				</div>
				<!--div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="DonateMoney">월 납입금 (최소) *</label>
					<div class="col-md-2 col-sm-2 form-inline">
						<input class="form-control" type="text" id="DonateMoney" name="DonateMoney" /> 원
					</div>
				</div-->
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="email">기간 * :</label>
					<div class="col-md-6 col-sm-6">
						<div class="input-group">
							<div class="input-group input-daterange">
								<input type="text" class="form-control" id="StageStart" name="StageStart" placeholder="Date Start">
								<span class="input-group-addon">to</span>
								<input type="text" class="form-control" id="StageEnd" name="StageEnd" placeholder="Date End">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="email">계좌정보 1 *</label>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">계좌번호: </label><input type="text" class="form-control" id="BankAccount1" name="BankAccount1">
					</div>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">입금은행: </label><input type="text" class="form-control" id="BankName1" name="BankName1">
					</div>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">예금주: </label><input type="text" class="form-control" id="BankDepositor1" name="BankDepositor1">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="email">계좌정보 2</label>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">계좌번호: </label><input type="text" class="form-control" id="BankAccount2" name="BankAccount2">
					</div>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">입금은행: </label><input type="text" class="form-control" id="BankName2" name="BankName2">
					</div>
					<div class="col-md-3 col-sm-3 form-inline">
						<label class="control-label col-md-3 col-sm-3">예금주: </label><input type="text" class="form-control" id="BankDepositor2" name="BankDepositor2">
					</div>
				</div>

				<div class="text-center alert alert-info p-10 m-b-0">
					<strong>후원처 정보</strong>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="message">로고 및 대표이미지 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="CompanyLogo[]" name="CompanyLogoImage[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="CompanyName">후원처 *</label>
					<div class="col-md-2 col-sm-2">
						<input class="form-control" type="text" id="CompanyName" name="CompanyName" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="CompanyDamdang">담당자 *</label>
					<div class="col-md-2 col-sm-2">
						<input class="form-control" type="text" id="CompanyDamdang" name="CompanyDamdang" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="CompanyTel">연락처 *</label>
					<div class="col-md-2 col-sm-2">
						<input class="form-control" type="text" id="CompanyTel" name="CompanyTel" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="CompanyAddress">주소 *</label>
					<div class="col-md-8 col-sm-12">
						<input class="form-control" type="text" id="CompanyAddress" name="CompanyAddress" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="fullname">웹사이트 *</label>
					<div class="col-md-4 col-sm-8">
						<input class="form-control" type="text" id="CompanyHomepage" name="CompanyHomepage" placeholder="http:// 포함입니다."/>
					</div>
				</div>

				<div class="text-center alert alert-info p-10 m-b-0">
					<strong>상세설명 정보</strong>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="message">상세설명 1 *</label>
					<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="message">이미지 *</label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" type="file" id="DetailImage1[]" name="DetailImage1[]" />
							</div>
						</div>
						<!--div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailMedia">동영상주소</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="DetailMedia1" name="DetailMedia1" /><br />
								<span class="text-warning">* youtube인 경유 공유 -> 소스코드를 복사해서 붙여넣기 함 </span>
								<span class="text-default">
									<xmp><iframe width="560" height="315" src="https://www.youtube.com/embed/e4eFBQmWs8Q" frameborder="0" allowfullscreen></iframe></xmp>
								</span>
							</div>
						</div-->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailContent1">상세 내용 *</label>
							<div class="col-md-8 col-sm-8">
								<textarea class="form-control" id="DetailContent1" name="DetailContent1" rows="10"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="message">상세설명 2</label>
					<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="message">이미지 2</label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" type="file" id="DetailImage2[]" name="DetailImage2[]" />
							</div>
						</div>
						<!--div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailMedia">동영상주소 2</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="DetailMedia2" name="DetailMedia2" /><br />
								<span class="text-warning">* youtube인 경유 공유 -> 소스코드를 복사해서 붙여넣기 함 </span>
								<span class="text-default">
									<xmp><iframe width="560" height="315" src="https://www.youtube.com/embed/e4eFBQmWs8Q" frameborder="0" allowfullscreen></iframe></xmp>
								</span>
							</div>
						</div-->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailContent2">상세 내용 2</label>
							<div class="col-md-8 col-sm-8">
								<textarea class="form-control" id="DetailContent2" name="DetailContent2" rows="10"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="message">상세설명 3</label>
					<div class="col-md-9 col-sm-9">
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="message">이미지 3</label>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" type="file" id="DetailImage3[]" name="DetailImage3[]" />
							</div>
						</div>
						<!--div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailMedia">동영상주소 3</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="DetailMedia3" name="DetailMedia3" /><br />
								<span class="text-warning">* youtube인 경유 공유 -> 소스코드를 복사해서 붙여넣기 함 </span>
								<span class="text-default">
									<xmp><iframe width="560" height="315" src="https://www.youtube.com/embed/e4eFBQmWs8Q" frameborder="0" allowfullscreen></iframe></xmp>
								</span>
							</div>
						</div-->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2" for="DetailContent3">상세 내용 3</label>
							<div class="col-md-8 col-sm-8">
								<textarea class="form-control" id="DetailContent3" name="DetailContent3" rows="10"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="email">상태여부 * :</label>
					<div class="col-md-2 col-sm-2">
						<select id="StatusYn" name="StatusYn" class="form-control width-150">
							<option value="Y">진행중(Y)</option>
							<option value="N">진행완료(N)</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2" for="email">노출여부 * :</label>
					<div class="col-md-2 col-sm-2">
						<select id="DisplayYn" name="DisplayYn" class="form-control width-150">
							<option value="Y">노출</option>
							<option value="N">비노출</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2"><a href="donateStageList<?=$sParam?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
					<div class="col-md-6 col-sm-6 m-t-10 text-center">
						<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
						<a href="donateStageList<?=$sParam?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
					</div>
				</div>
			</form>
		</div>

	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<script>
$(document).ready(function() {
App.init();
FormDatePickerPlugins.init();

//폼전송
var sSendFlag=false;
function fnSendForm() {
	$("#actForm").submit();
}
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
		"Title": {required: true, maxlength:100},
		"Summary": {required: true, maxlength:200},
		"StageImage[]": {required: true},
		"TargetMoney": {required: true, number: true},
		"DonateMoney": {required: true, number: true},
		"StageStart": {required: true, maxlength:10},
		"StageEnd": {required: true, maxlength:10},
		"BankAccount1": {required: true, maxlength:20},
		"BankName1": {required: true, maxlength:20},
		"BankDepositor1": {required: true, maxlength:20},
		"CompanyLogoImage[]": {required: true, maxlength:50},
		"CompanyName": {required: true, maxlength:50},
		"CompanyDamdang": {required: true, maxlength:10},
		"CompanyTel": {required: true, maxlength:15},
		"CompanyAddress": {required: true, maxlength:200},
		"CompanyHomepage": {required: true, maxlength:100},
		"DetailImage1[]": {required: true},
		"DetailContent1": {required: true},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Title":{required : "스테이지 제목을 입력해주세요."},
		"Summary":{required : "스테이지 간략소개를 입력해주세요."},
		"StageImage[]":{required : "스테이지 이미지를 선택해주세요."},
		"TargetMoney":{required : "목표금액을 입력해주세요."},
		"DonateMoney":{required : "월 납입금을 입력해주세요."},
		"StageStart":{required : "기간(시작일)을 선택해주세요."},
		"StageEnd": {required: "기간(종료일)을 선택해주세요."},
		"BankAccount1":{required : "계좌번호를 입력해주세요."},
		"BankName1":{required : "입금은행을 입력해주세요."},
		"BankDepositor1":{required : "예금주를 입력해주세요."},
		"CompanyLogo[]":{required : "후원처 로그를 선택해주세요."},
		"CompanyName":{required : "후원처를 입력해주세요."},
		"CompanyDamdang":{required : "후원처 담당자를 입력해주세요."},
		"CompanyTel":{required : "후원처 연락처를 입력해주세요."},
		"CompanyAddress": {required: "후원처 주소를 선택해주세요."},
		"CompanyHomepage":{required : "후원처 홈페이지를 입력해주세요."},
		"DetailImage1[]":{required : "상세설명 이미지를 입력해주세요."},
		"DetailContent1": {required: "상세설명 상세네용을 선택해주세요."},

	},
	submitHandler:function(form) {
		if (!sSendFlag) {
			sSendFlag=true;
			form.submit();
		} else {
		}
	}
});
});
</script>

</body>
</html>
