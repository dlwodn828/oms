<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">설정 관리</a></li>
		<li class="active">페이지(화면) 관리</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">약관 관리 <small>Edit</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" id="actForm" name="actForm" action="/settings/agreementModifyProc" method="POST">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
			<input type="hidden" name="Idx" id="Idx" value="<?=$arrResult->Idx?>" />
			<input type="hidden" name="sParam" value="<?=$sParam?>">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">약관명 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="Title" name="Title" value="<?=$arrResult->Title?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="message">약관 내용</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents" name="Contents" rows="30"><?=$arrResult->Contents?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3"><a href="/settings/agreementList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
					<div class="col-md-6 col-sm-6 m-t-10 text-center">
						<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
						<a href="/settings/agreementList<?=$sParam02?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
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
var sSendFlag=false;
$("#actForm").submit(function(e) {
	e.preventDefault();
	}).validate({
	rules: {
		"Title": {required:true,maxlength:255},
		"Contents": {required:true,minlength:1},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Title" : {required : "약관명을 입력해주세요."},
		"Contents" : {required : "내용을 입력해주세요."},
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