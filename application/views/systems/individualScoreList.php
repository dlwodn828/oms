<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">I-CSS / IPT / NICE</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">개인평점 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
				<form class="form-inline" role="form" id="actForm" method="get">
					<input type="hidden" name="sPage" id="sPage" value="">
					<div class="form-inline">
						<div class="form-group">
							<h4><span class="badge badge-default badge-square p-8">회원 : <?=$iTotalCnt?> 명 </span></h4>
						</div>
						<div class="input-group">
							<div class="input-group input-daterange">
								<input type="text" class="form-control width-100" name="dStartDate" id="dStartDate" placeholder="Date Start">
								<span class="input-group-addon">to</span>
								<input type="text" class="form-control width-100" name="dEndDate" id="dEndDate" placeholder="Date End">
							</div>
						</div>
						<div class="form-group pull-right p-t-10" >
							<div class="input-group ">
								<input type="text" class="form-control" placeholder="Search" name="sSearchWord" id="sSearchWord" value="<?=$sSearchWord?>">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="5%" class="text-center">No</th>
						<th width="7%" class="text-center">회원 코드</th>
						<th width="8%" class="text-center">닉네임</th>
						<th width="5%" class="text-center">이름</th>
						<th width="6%" class="text-center">I-CSS</th>
						<th width="6%" class="text-center">평점</th>
						<th width="6%" class="text-center">합계</th>
						<th width="7%" class="text-center">NICE 등급</th>
						<th width="7%" class="text-center">신용대출금액</th>
						<th width="6%" class="text-center">OPR</th>
						<th width="6%" class="text-center">SN</th>
						<th width="6%" class="text-center">CLA</th>
						<th width="6%" class="text-center">POU</th>
						<th width="6%" class="text-center">SNE</th>
						<th width="10%" class="text-center">AR</th>
						<th width="10%" class="text-center">DS</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/memberView?Idx=<?=$row["Idx"]?>" target="_about"><?=$row["UserCode"]?></a></td>
						<td class="text-center"><a href="/systems/memberView?Idx=<?=$row["Idx"]?>" target="_about"><?=$row["UserNickName"]?></a></td>
						<td class="text-center"><a href="/systems/memberView?Idx=<?=$row["Idx"]?>" target="_about"><?=$row["UserName"]?></a></td>
						<td class="text-center"><span class="badge badge-warning badge-square"><?=$row["ICSSGrade"]?></span></td>
						<td class="text-center"><span class="badge badge-default badge-square"><?=$row["ICSSScore"]?></span></td>
						<td class="text-center"><span class="badge badge-danger badge-square"><?=number_format($row["RISKScore"]*0.01, 3, '.', '')?>%</span></td>
						<td class="text-center"><?=number_format($row["NiceGradeScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["NiceMoneyScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["OPRScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["SNScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["CLAScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["POUScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["SNEScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["ARScore"]*0.01, 4, '.', '')?>%</td>
						<td class="text-center"><?=number_format($row["DSScore"]*0.01, 4, '.', '')?>% <a href="#modal-ds" data-toggle="modal" class="m-l-5 btn btn-info btn-xs editSelect" data-idx="<?=$row["Idx"]?>" data-icssidx="<?=$row["ICSSIdx"]?>">DS 변경</a></td>
					</tr>
					<? } ?>
				</tbody>
			</table>

			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="/systems/individualScoreListExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
				</div>
				<div class="dataTables_paginate paging_simple_numbers pull-right" id="data-table_paginate">
					<?=$sPaging?>
				</div>
			</div>
		</div>
		<!-- end #table-responsive -->
		<!-- #modal-ds -->
		<div class="modal fade" id="modal-ds">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">DS Edit</h4>
					</div>
					<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm02" action="/systems/ICSSDSModifyProc" method="POST">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
					<input type="hidden" name="Idx" id="Idx" value=""/>
					<input type="hidden" name="ICSSIdx" id="ICSSIdx" value=""/>
					<div class="panel-body panel-form">
						<div class="form-group"></div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3" for="fullname">소득세 구간 * </label>
							<div class="col-md-9 col-sm-6">
								<select class="form-control width-250" id="UserIncome" name="UserIncome">
									<option value="0" selected>미적용</option>
									<option value="12000000" >12,000,000 이내</option>
									<option value="12000001">12,000,001 ~ 46,000,000 원</option>
									<option value="46000001">46,000,001 ~ 88,000,000 원</option>
									<option value="88000001">88,000,001 ~ 150,000,000 원</option>
									<option value="150000001">150,000,001 원 이상</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3" for="fullname">재산세 구간 * </label>
							<div class="col-md-9 col-sm-6">
								<select class="form-control width-250" id="UserAssets" name="UserAssets">
									<option value="0" selected>미적용</option>
									<option value="60000000" >60,000,000 이내</option>
									<option value="60000001">60,000,001 ~ 150,000,000 원</option>
									<option value="150000001">150,000,001 ~ 300,000,000 원</option>
									<option value="300000001">300,000,001 원 이상</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<a class="btn btn-xs btn-white" data-dismiss="modal">Close</a>
						<input type="submit" class="btn btn-xs btn-primary" value="Save">
					</div>
					</form>
				</div>
			</div>
		</div><!-- end #modal-delete -->

	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#dStartDate").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#dEndDate").datepicker( "setDate", "<?=$dEndDate?>" );
});
var sSendFlag=false;
var sSendFlag02=false;
$(document).on('click','.editSelect', function (e) {
	var UserIdx = $(this).data("idx");
	var ICSSIdx = $(this).data("icssidx");
	$.ajax({
	url:"/systems/memberICSSInfo?Idx="+UserIdx,
	dataType:"json",
	}).done(function (data) {
		$("#Idx").val(UserIdx);
		$("#ICSSIdx").val(ICSSIdx);
		$("#UserIncome").val(data.UserIncome);
		$("#UserAssets").val(data.UserAssets);
		sSendFlag02=true;
	}).fail(function () {
	});
});
$("#actForm02").submit(function(e) {
	e.preventDefault();
	}).validate({
		rules: {
			"UserIncome": {required:true},
			"UserAssets": {required:true},
		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		messages: {
			"UserIncome" : {required : "소득세 구간을 입력해주세요."},
			"UserAssets" : {required : "제산세 구간을 입력해주세요."},
		},
		submitHandler:function(form) {
			if (!sSendFlag) {
				sSendFlag=true;
				$.ajax({
					type: $(form).attr("method"),
					encoding:"UTF-8",
					contentType: "application/x-www-form-urlencoded; charset=UTF-8",
					url: $(form).attr("action"),
					data: $(form).serialize(),
					dataType:"json",
					success:function(data) {
						alert(data.sMessage);
						$("#csrf").val(data.sToken);
						if (data.sRetCode=="01") {
							document.location.reload();
						} else { //실패시
//							alert(data.sRetCode);
						}
						sSendFlag=false;
					}
				})
			} else {
			}
		}
});
</script>
