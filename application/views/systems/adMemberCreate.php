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
	<h1 class="page-header">제휴 회원 등록</h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" id="actForm" action="/systems/adMemberCreateProc" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
				<input type="hidden" id="UserCategory" name="UserCategory" value="">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">닉네임 ( 10자 이내 ) *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="UserNickName" name="UserNickName" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">이메일 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="UserId" name="UserId" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">비밀번호 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="password" id="UserPwd" name="UserPwd" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">비밀번호 확인 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="password" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">스테이지 개설수 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="StageCreateMax" name="StageCreateMax" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">카테고리 *</label>
					<div class="col-md-6 col-sm-6">
						<ul id="category-check" class="category_check">
							<? foreach ($arrResult->result() as $row) { ?>
								<li><a href="javascript:void(0);" class="categoryIdx" data-idx="<?=$row->Idx?>"><?=$row->CategoryName?></a></li>
							<? } ?>
						</ul>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3"></label>
					<div class="col-md-6 col-sm-6 m-t-10 text-center">
						<button class="btn btn-info btn-xs" onclick="javascript:fnActForm();"><i class="fa fa-save"></i> 가입완료</button>
					</div>
				</div>
			</form>
		</div>
		<!-- end #table-responsive -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();

        // Category 선택시
        $("#category-check li a").click(function(e) {
                e.preventDefault();
                var bCategoryCheck=true;
                if (!$(this).hasClass("check")) {
                        if ($(".checkCnt").length>2) {
                                bCategoryCheck=false;
                                alert("관심 카테고리는 최대 3개까지 선택 가능합니다.");
                        }
                }
                if (bCategoryCheck) {
                        $(this).toggleClass("check");
                        $(this).toggleClass("checkCnt");
                        var UserCategory="";
                        $(".categoryIdx").each(function() {
                                if ($(this).hasClass("check")) {
                                        UserCategory=UserCategory+$(this).data("idx")+"||";
                                }
                        });
                        $("#UserCategory").val(UserCategory);
                }
        });
        // 추가 가입정보 선택시(a tag data값을 불러옴)
        $(".category_check li a").not($("#category-check li a")).click(function(e) {
                e.preventDefault();
                $(this).addClass("check").parent().siblings().find('a').removeClass("check");
                $(this).parent().parent().parent().children(".regist-path").val($(this).data("optionname"));
        });
});
function fnActForm() {
        $("#actForm").submit();
}
//폼전송
var sSendFlag=false;
jQuery.validator.addMethod("pwdCheck", function(value, element) {
	var iNum = value.search(/[0-9]/g);
	var sEng = value.search(/[a-z]/ig);
	if(iNum < 0 || sEng < 0) {
		return false;
	} else {
		 return true;
	}
},"<span class='inputShowInfo'>영어 및 숫자 포함해서 최소 8자 이상으로 입력해 주세요.</span>");
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
		"UserNickName": {required: true,maxlength:10},
		"UserId": {required: true,maxlength:50,email: true},
		"UserPwd": {required: true,minlength:8,pwdCheck:true,maxlength:255},
		"UserPwdRe": {required: true,minlength:8,pwdCheck:true,maxlength:255,equalTo: "#UserPwd"},
		"StageCreateMax": {required: true,number:true,range:[0, 99]},
	},
	messages: {
		"UserNickName": {required : "<span class='inputShowInfo'>닉네임을 입력해주세요.</span>",maxlength:"<span class='inputShowInfo'>{0}자를 넘을 수 없습니다.</span>"},
		"UserId" : {required : "<span class='inputShowInfo'>이메일을 입력해주세요. ex)abc@email.com</span>",maxlength:"<span class='inputShowInfo'>{0}자를 넘을 수 없습니다.</span>",minlength:"<span class='inputShowInfo'>{0}자 이상 입력하세요.</span>",email: "<span class='inputShowInfo'>이메일 형식이 맞지 않습니다.</span>",remote: "<span class='inputShowInfo'>이미 가입되어 있는 이메일입니다. 다른 이메일주소를 사용해 주세요.</span>"
		},
		"UserPwd" : {required : "<span class='inputShowInfo'>비밀번호를 입력해주세요.</span>",maxlength:"<span class='inputShowInfo'>{0}자를 넘을 수 없습니다.</span>",minlength:"<span class='inputShowInfo'>영어 및 숫자 포함해서 최소 8자 이상으로 입력해 주세요.</span>"},
		"UserPwdRe" : {required : "<span class='inputShowInfo'>비밀번호 확인을 입력해주세요.</span>",maxlength:"<span class='inputShowInfo'>{0}자를 넘을 수 없습니다.</span>",minlength:"<span class='inputShowInfo'>영어 및 숫자 포함해서 최소 8자 이상으로 입력해 주세요.</span>",equalTo: "<span class='inputShowInfo'>비밀번호가 서로 다릅니다.</span>"},
		"StageCreateMax" : {required : "<span class='inputShowInfo'>스테이지 개설수를 입력해 주세요. (0-99)</span>"},

	},
	submitHandler:function(form) {
		if ($("#UserCategory").val()=="") {
			alert("카테고리를 선택해주세요.");
			return false;
		}

		if (!sSendFlag) {
			sSendFlag=true;
			form.submit();
		} else {
		}
	}
});
</script>
