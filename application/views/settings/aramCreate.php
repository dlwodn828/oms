<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">설정 관리</a></li>
		<li class="active">게시판 관리</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">아람이 뉘우스 <small>Create</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="panel-body panel-form">
			<form class="form-horizontal form-bordered" id="actForm" action="/assets/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">제목 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="text" id="Title" name="Title" value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">요약 *</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Summary" name="Summary" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">리스트 이미지 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="ListImage[]" name="ListImage[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용01</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents01" name="Contents01" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지01</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile01[]" name="IncFile01[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용02</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents02" name="Contents02" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지02</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile02[]" name="IncFile02[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용03</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents03" name="Contents03" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지03</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile03[]" name="IncFile03[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용04</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents04" name="Contents04" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지04</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile04[]" name="IncFile04[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용05</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents05" name="Contents05" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지05</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile05[]" name="IncFile05[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용06</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents06" name="Contents06" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">첨부 이미지06</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="IncFile06[]" name="IncFile06[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3"><a href="/settings/aramList<?=$sParam?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
					<div class="col-md-6 col-sm-6 m-t-10 text-center">
						<a href="javascript:void(0);" onclick="javascript:fnSendForm();" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button></a>
						<a href="/settings/aramList<?=$sParam?>" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
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
	FormMultipleUpload.init();
	// jQuery File Uplaod Options Settings
	// 기존에 등록된 이미지, 파일갯수를 계산하여 업로드 갯수를 산정한다.
});
//폼전송
var sSendFlag=false;
function fnSendForm() {
	$("#actForm").submit();
}
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
		"Title": {required:true,maxlength:255},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Title" : {required : "제목을 입력해주세요."},
	},
	submitHandler:function(form) {
		if (!sSendFlag) {
			sSendFlag=true;
			$("#actForm").attr("action","/settings/aramCreateProc");
			form.submit();
		} else {
		}
	}
});
</script>