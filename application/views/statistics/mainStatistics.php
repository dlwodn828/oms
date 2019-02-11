<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">운영금액 설정</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">운영금액 설정<small>Create & Edit</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" id="actForm" action="/statistics/mainStatisticsModifyProc" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
			<input type="hidden" name="Idx" id="Idx" value="<?=$arrResult->Idx?>"/>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">누적 운영금액 </label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="TotalMoney" name="TotalMoney" value="<?=$arrResult->TotalMoney?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">연체율</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="OverDueRate" name="OverDueRate" value="<?=$arrResult->OverDueRate?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">부실률</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="WeakRate" name="WeakRate" value="<?=$arrResult->WeakRate?>"/>
					</div>
				</div>
				<div class="">
					<div class="m-t-20 text-center">
						<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
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
});
//폼전송
var sSendFlag=false;
function fnSendForm() {
	$("#actForm").submit();
}
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
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