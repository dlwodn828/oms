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
	<h1 class="page-header">일반 스테이지 관리 <small>Edit</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" id="actForm" action="/systems/generalStageModifyProc" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
			<input type="hidden" name="Idx" id="Idx" value="<?=$arrResult->Idx?>"/>
			<input type="hidden" name="StageRate" id="StageRate" value="<?=$arrResult->StageRate?>"/>
			<input type="hidden" name="CategoryIdx" id="CategoryIdx" value="<?=$arrResult->CategoryIdx?>"/>
			<input type="hidden" name="SecretYN" id="SecretYN" value="<?=$arrResult->SecretYN?>"/>
			<input type="hidden" name="sParam" id="sParam" value="<?=$sParam?>"/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">스테이지 등록자</label>
					<div class="col-md-2 col-sm-2">
						<input class="form-control" type="text" value="<?=$arrResult->UserNickName?>" disabled />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="email">참여인원 * :</label>
					<div class="col-md-6 col-sm-6">
						<!-- 현재 설정된 인원은 active -> badge-warning -->
						<span class="person badge <?=fnSelectEffect($arrResult->StageNum,5)?> badge-square cursor-pointer" data-stagenum="5">5명</span>
						<span class="person badge <?=fnSelectEffect($arrResult->StageNum,7)?> badge-square cursor-pointer" data-stagenum="7">7명</span>
						<span class="person badge <?=fnSelectEffect($arrResult->StageNum,9)?> badge-square cursor-pointer" data-stagenum="9">9명</span>
						<span class="person badge <?=fnSelectEffect($arrResult->StageNum,13)?> badge-square cursor-pointer" data-stagenum="13">13명</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="email">약정금액 * :</label>
					<div class="col-md-6 col-sm-6">
							<input type="hidden" id="StageMoney" name="StageMoney" value="<?=$arrResult->StageMoney?>">
							<select class="form-control width-150" disabled>
							<option value="10" <?=checkSelect($arrResult->StageMoney,"10","s")?>>10만원</option>
							<option value="20" <?=checkSelect($arrResult->StageMoney,"20","s")?>>20만원</option>
							<option value="30" <?=checkSelect($arrResult->StageMoney,"30","s")?>>30만원</option>
							<option value="40" <?=checkSelect($arrResult->StageMoney,"40","s")?>>40만원</option>
							<option value="50" <?=checkSelect($arrResult->StageMoney,"50","s")?>>50만원</option>
							<option value="60" <?=checkSelect($arrResult->StageMoney,"60","s")?>>60만원</option>
							<option value="70" <?=checkSelect($arrResult->StageMoney,"70","s")?>>70만원</option>
							<option value="80" <?=checkSelect($arrResult->StageMoney,"80","s")?>>80만원</option>
							<option value="90" <?=checkSelect($arrResult->StageMoney,"90","s")?>>90만원</option>
							<option value="100" <?=checkSelect($arrResult->StageMoney,"100","s")?>>100만원</option>
							<option value="110" <?=checkSelect($arrResult->StageMoney,"110","s")?>>110만원</option>
							<option value="120" <?=checkSelect($arrResult->StageMoney,"120","s")?>>120만원</option>
							<option value="130" <?=checkSelect($arrResult->StageMoney,"130","s")?>>130만원</option>
							<option value="140" <?=checkSelect($arrResult->StageMoney,"140","s")?>>140만원</option>
							<option value="150" <?=checkSelect($arrResult->StageMoney,"150","s")?>>150만원</option>
							<option value="160" <?=checkSelect($arrResult->StageMoney,"160","s")?>>160만원</option>
							<option value="170" <?=checkSelect($arrResult->StageMoney,"170","s")?>>170만원</option>
							<option value="180" <?=checkSelect($arrResult->StageMoney,"180","s")?>>180만원</option>
							<option value="190" <?=checkSelect($arrResult->StageMoney,"190","s")?>>190만원</option>
							<option value="200" <?=checkSelect($arrResult->StageMoney,"200","s")?>>200만원</option>
							<option value="210" <?=checkSelect($arrResult->StageMoney,"210","s")?>>210만원</option>
							<option value="220" <?=checkSelect($arrResult->StageMoney,"220","s")?>>220만원</option>
							<option value="230" <?=checkSelect($arrResult->StageMoney,"230","s")?>>230만원</option>
							<option value="240" <?=checkSelect($arrResult->StageMoney,"240","s")?>>240만원</option>
							<option value="250" <?=checkSelect($arrResult->StageMoney,"250","s")?>>250만원</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="email">이율 * :</label>
					<div class="col-md-9 col-sm-9">
						<!-- 현재 설정된 이율은 active -> badge-warning -->
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"7")?> badge-square cursor-pointer" data-stagerate="7">7%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"8")?> badge-square cursor-pointer" data-stagerate="8">8%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"9")?> badge-square cursor-pointer" data-stagerate="9">9%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"10")?> badge-square cursor-pointer" data-stagerate="10">10%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"11")?> badge-square cursor-pointer" data-stagerate="11">11%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"12")?> badge-square cursor-pointer" data-stagerate="12">12%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"13")?> badge-square cursor-pointer" data-stagerate="13">13%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"14")?> badge-square cursor-pointer" data-stagerate="14">14%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"15")?> badge-square cursor-pointer" data-stagerate="15">15%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"16")?> badge-square cursor-pointer" data-stagerate="16">16%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"17")?> badge-square cursor-pointer" data-stagerate="17">17%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"18")?> badge-square cursor-pointer" data-stagerate="18">18%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"19")?> badge-square cursor-pointer" data-stagerate="19">19%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"20")?> badge-square cursor-pointer" data-stagerate="20">20%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"21")?> badge-square cursor-pointer" data-stagerate="21">21%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"22")?> badge-square cursor-pointer" data-stagerate="22">22%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"23")?> badge-square cursor-pointer" data-stagerate="23">23%</span>
						<span class="interest-rate badge <?=fnSelectEffect($arrResult->StageRate,"24")?> badge-square cursor-pointer" data-stagerate="24">24%</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="email">카테고리 * :</label>
					<div class="col-md-9 col-sm-9">
						<!-- 카테고리는 설정관리 -> 관심 카테고리 관리에 등록된 DB를 불러온다 -->
						<? foreach ($arrResult02->result() as $row) { ?>
						<span class="category badge <?=fnSelectEffect($arrResult->CategoryIdx,$row->Idx)?> badge-square cursor-pointer" data-categoryidx="<?=$row->Idx?>"><?=$row->CategoryName?></span>
						<? } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="email">공개여부 * :</label>
					<div class="col-md-4 col-sm-4">
						<!-- 현재 설정된 인원은 active -> badge-warning -->
						<div class="col-md-4 col-md-4 p-l-0">
							<span class="open-yn badge <?=fnSelectEffect($arrResult->SecretYN,"N")?> badge-square cursor-pointer" data-secretyn="N">공개</span>
							<span class="open-yn badge <?=fnSelectEffect($arrResult->SecretYN,"Y")?> badge-square cursor-pointer" data-secretyn="Y">비공개</span>
						</div>
						<div class="col-md-4 col-sm-4 open-yn-pwd">
							<input type="text" class="form-control" name="SecretPWD" id="SecretPWD" placeholder="Password" value="<?=$arrResult->SecretPWD?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">스테이지 제목 </label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="Title" name="Title" value="<?=$arrResult->Title?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="message">스테이지 소개 (300자 이내)</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Summary" name="Summary" rows="4" data-parsley-range="[1,300]"><?=$arrResult->Summary?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="message">스테이지 사진</label>
					<div class="col-md-6 col-sm-6">
						<?=fnImageView02("/stage/medium/".$arrResult->StageImage,"img-responsive","")?>
						<input class="form-control" type="file" id="StageImage[]" name="StageImage[]"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="message">스테이지 내용</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents" name="Contents" rows="10"><?=$arrResult->Contents?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3"><a href="/systems/generalStageList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
					<div class="col-md-6 col-sm-6 m-t-10 text-center">
						<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
						<a href="/systems/generalStageList<?=$sParam02?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	// 참여인원 선택시
	$(".person").click(function() {
//		$(".person").switchClass("badge-warning", "badge-default");
//		$(this).switchClass("badge-default", "badge-warning");
//		$("#StageNum").val($(this).data("stagenum"));
	});

	// 이율 선택시
	$(".interest-rate").click(function() {
		<? if ($arrResult->State=="R") { ?>
		$(".interest-rate").switchClass("badge-warning", "badge-default");
		$(this).switchClass("badge-default", "badge-warning");
		$("#StageRate").val($(this).data("stagerate"));
		<? } ?>
	});
	$(".category").click(function() {
		$(".category").switchClass("badge-warning", "badge-default");
		$(this).switchClass("badge-default", "badge-warning");
		$("#CategoryIdx").val($(this).data("categoryidx"));
	});
	// 이율 선택시
	$(".open-yn").click(function() {
		$(".open-yn").switchClass("badge-warning", "badge-default");
		$(this).switchClass("badge-default", "badge-warning");
		$("#SecretYN").val($(this).data("secretyn"));
		if ($(this).data("secretyn") == "Y") {
			$(".open-yn-pwd").show();
		} else {
			$(".open-yn-pwd").hide();
		}
	});
	<? if ($arrResult->SecretYN=="N") { ?>
		$(".open-yn-pwd").hide();
	<? } ?>
});
//폼전송
var sSendFlag=false;
function fnSendForm() {
	$("#actForm").submit();
}
jQuery.validator.addMethod("secretPWDCheck", function(value, element) {
	var BannerType01=$("#SecretYN").val();
	var BannerType02=value;
	if (BannerType01=="Y") {
		if (BannerType02=="") {
			sValue=false;
		} else {
			sValue=true;
		}
	} else {
		sValue=true;
	}
	return sValue;
}, "비밀번호를 입력해주세요.");
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
		"SecretPWD": {secretPWDCheck: true},
		"Title": {required: true},
		"Summary": {required:true},
		"Contents": {required:true},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Title":{required : "스테이지 제목을 입력해주세요."},
		"Summary":{required : "스테이지 소개를 입력해주세요."},
		"Contents":{required : "스테이지 내용을 입력해주세요."},
	},
	submitHandler:function(form) {
		if (!sSendFlag) {
			sSendFlag=true;
			form.submit();
		} else {
		}
	}
});

</script>