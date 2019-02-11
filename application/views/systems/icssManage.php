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
	<h1 class="page-header">I-CSS 평점/한도 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="10%" class="text-center">I-CSS</th>
						<th width="10%" class="text-center">점수 범위</th>
						<th width="10%" class="text-center">점수 최소</th>
						<th width="10%" class="text-center">점수 최대</th>
						<!--<th width="10%" class="text-center">한도 범위(원)</th>
						<th width="10%" class="text-center">한도 최소(원)</th>
						<th width="10%" class="text-center">한도 최대(원)</th>-->
						<th width="10%" class="text-center">월 납입한도(원)</th>
						<th width="15%" class="text-center">Action</th>
					</tr>
				</thead>
				<form class="form-inline" role="form" id="actForm02" action="/systems/icssUpdateAllProc" method="post">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
				<tbody>
					<? foreach ($arrResult as $row) { ?>
					<tr>
						<td class="text-center"><?=$row["ICSS"]?></td>
						<td class="text-center"><?=$row["LimitScore01"]?>~<?=$row["LimitScore02"]?></td>
						<td class="text-center"><input type="number" min="0" id="LimitScore01[]" name="LimitScore01[]" class="LimitScore01" value="<?=$row["LimitScore01"]?>" /></td>
						<td class="text-center"><input type="number" min="0" id="LimitScore02[]" name="LimitScore02[]" class="LimitScore02" value="<?=$row["LimitScore02"]?>" /></td>
						<!--<td class="text-center"><?=number_format($row["LimitMinLoan"])?>~<?=number_format($row["LimitMaxLoan"])?></td>
						<td class="text-center"><input type="number" min="0" id="LimitMinLoan[]" name="LimitMinLoan[]" class="LimitMinLoan" value="<?=$row["LimitMinLoan"]?>" /></td>
						<td class="text-center"><input type="number" min="0" id="LimitMaxLoan[]" name="LimitMaxLoan[]" class="LimitMaxLoan" value="<?=$row["LimitMaxLoan"]?>" /></td>-->
						<td class="text-center"><input type="number" min="0" id="MonthLimitLoan[]" name="MonthLimitLoan[]" class="MonthLimitLoan" value="<?=$row["MonthLimitLoan"]?>" /></td>
						<td class="text-center">
							<input type="hidden" name="Idx[]" id="Idx[]" value="<?=$row["Idx"]?>" />
							<a href="javascript:void(0);" class="btn btn-info btn-xs editProc" data-idx="<?=$row["Idx"]?>"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
					<? } ?>
					<tr>
						<td colspan="5" class="text-center"></td>
						<td class="text-center">
							<a href="javascript:void(0);" class="btn btn-danger btn-xs updateAll"><i class="fa fa-edit"></i> All Edit </a>
						</td>
					</tr>
				</tbody>
				</form>
			</table>
		</div>
		<!-- end #table-responsive -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
});
$('.editProc').click(function(e){
	$.ajax({
		type: "get",
		encoding:"UTF-8",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "/systems/icssUpdateProc",
		data: {Idx:$(this).data("idx"),LimitScore01:$(this).parent().parent().find(".LimitScore01").val(),LimitScore02:$(this).parent().parent().find(".LimitScore02").val(),LimitMinLoan:$(this).parent().parent().find(".LimitMinLoan").val(),LimitMaxLoan:$(this).parent().parent().find(".LimitMaxLoan").val(),MonthLimitLoan:$(this).parent().parent().find(".MonthLimitLoan").val()},
		dataType:"json",
		success:function(data) {
			alert(data.sMessage);
			if (data.sRetCode=="01") {
				location.reload();
			}
		}
	});
});
$('.updateAll').click(function(e){
	$.ajax({
		type: $("#actForm02").attr("method"),
		encoding:"UTF-8",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: $("#actForm02").attr("action"),
		data: $("#actForm02").serialize(),
		dataType:"json",
		success:function(data) {
			alert(data.sMessage);
			if (data.sRetCode=="01") {
				location.reload();
			}
		}
	});
});
</script>
