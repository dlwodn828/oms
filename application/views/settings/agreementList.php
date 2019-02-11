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
	<h1 class="page-header">약관 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<form class="form-inline" role="form" id="actForm" method="get">
			<input type="hidden" name="sPage" id="sPage" value="">
			</form>
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="10%" class="text-center">No</th>
						<th class="text-center">약관명</th>
						<th width="20%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult->result() as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><?=$row->Title?></td>
						<td class="text-center">
							<a href="/settings/agreementModify<?=$sParam?>&Idx=<?=$row->Idx?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
							<a href="#modal-delete" class="btn btn-danger btn-xs delSelect" data-toggle="modal" data-idx="<?=$row->Idx?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="/settings/agreementCreate<?=$sParam?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Create </a>
				</div>
				<div class="dataTables_paginate paging_simple_numbers pull-right" id="data-table_paginate">
					<?=$sPaging?>
				</div>
			</div>

		</div>
		<!-- end #table-responsive -->
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
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
});
$(document).on('click', '.delSelect', function (e) {
	$("#delIdx").val($(this).data("idx"));
});
$('.delProc').click(function(e){
	$.ajax({
	url:"/settings/agreementDelProc?Idx=" + $("#delIdx").val(),
	dataType:"json",
	}).done(function (data) {
		alert(data.sMessage);
		if (data.sRetCode=="01") {
			location.reload();
		} else {
			$('#modal-delete').modal('hide');
		}
	}).fail(function () {
		$('#modal-delete').modal('hide');
		alert('작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
	});
});
</script>