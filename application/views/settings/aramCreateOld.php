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
					<label class="control-label col-md-3 col-sm-3" for="fullname">내용 *</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control" id="Contents" name="Contents" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="fullname">리스트 이미지 *</label>
					<div class="col-md-6 col-sm-6">
						<input class="form-control" type="file" id="ListImage[]" name="ListImage[]" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3" for="Contents">파일첨부 *<br />(최대 10장)</label>
					<!-- jquery file upload -->
					<!-- id="fileupload" 반드시 필요함 -->
					<div id="fileupload" class="col-md-9 col-sm-9">
						<div class="row fileupload-buttonbar">
							<div class="col-md-7">
								<span class="btn btn-success fileinput-button">
									<i class="fa fa-plus"></i>
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="fa fa-upload"></i>
									<span>Start upload</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="fa fa-ban"></i>
									<span>Cancel upload</span>
								</button>
								<button type="button" class="btn btn-danger delete">
									<i class="glyphicon glyphicon-trash"></i>
									<span>Delete</span>
								</button>
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-md-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
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
<!-- jquery file upload -->
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload fade">
			<td class="col-md-1">
				<span class="preview"></span>
			</td>
			<td style="vertical-align:middle">
				<p class="name">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td style="vertical-align:middle">
				<p class="size">Processing...</p>
				<div class="progress progress-striped active"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
			</td>
			<td style="vertical-align:middle">
				{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-primary btn-sm start" disabled>
						<i class="fa fa-upload"></i>
						<span>Start</span>
					</button>
				{% } %}
				{% if (!i) { %}
					<button class="btn btn-white btn-sm cancel">
						<i class="fa fa-ban"></i>
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download fade">
			<td>
				<span class="preview">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					<input name="IncImage[]" type="hidden" value="{%=file.name%}">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<i class="glyphicon glyphicon-trash"></i>
						<span>Delete</span>
					</button>
					<input type="checkbox" name="delete" value="1" class="toggle">
				{% } else { %}
					<button class="btn btn-warning cancel">
						<i class="glyphicon glyphicon-ban-circle"></i>
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
</script>
<script>
$(document).ready(function() {
	App.init();
	FormMultipleUpload.init();
	// jQuery File Uplaod Options Settings
	// 기존에 등록된 이미지, 파일갯수를 계산하여 업로드 갯수를 산정한다.
	var maxFiles = 10;
	// Image Type(default)
	$('#fileupload').fileupload({
		maxNumberOfFiles: maxFiles
	});
});
//폼전송
var sSendFlag=false;
function fnSendForm() {
	$("#actForm").submit();
}
$("#actForm").submit(function(e) {e.preventDefault();}).validate({
	rules: {
		"Title": {required:true,maxlength:255},
		"Contents": {required:true},
	},
	highlight: function(element) {
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	},
	messages: {
		"Title" : {required : "제목을 입력해주세요."},
		"Contents" : {required : "내용을 입력해주세요."},
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