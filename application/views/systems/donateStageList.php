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
	<h1 class="page-header">나눔 스테이지 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
				<div class="col-md-3 col-sm-3 p-l-0">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-title">전체 나눔 회원</div>
						<div class="stats-number"><?=number_format($iMonthTotalCnt)?>명</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
						<div class="stats-title">금월 나눔 회원</div>
						<div class="stats-number"><?=number_format($iNowTotalCnt)?>명</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
						<div class="stats-title">전월 나눔 회원</div>
						<div class="stats-number"><?=number_format($iPreviousTotalCnt)?>명</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 p-r-0">
					<div class="widget widget-stats bg-aqua">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-cubes fa-fw"></i></div>
						<div class="stats-title">총 나눔 스테이지</div>
						<div class="stats-number"><?=$iTotalCnt?>개</div>
					</div>
				</div>
			</div>
			<form class="form-inline m-b-10" role="form" id="actForm" method="get">
			<input type="hidden" name="sPage" id="sPage" value="">
				<div class="form-inline">
					<div class="form-group">
						<select class="form-control width-150" id="sSearchType" name="sSearchType">
							<option value="">전체</option>
							<option value="Title" <?=checkSelect($sSearchType,"Title","s")?>>스테이지명</option>
							<option value="CompanyName" <?=checkSelect($sSearchType,"CompanyName","s")?>>후원처</option>
						</select>
					</div>
					<div class="form-group">
						<div class="input-group ">
							<input type="text" class="form-control" placeholder="Search" name="sSearchWord" id="sSearchWord" value="<?=$sSearchWord?>">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="5%" class="text-center">No</th>
						<th width="10%" class="text-center">스테이지 코드</th>
						<th width="10%" class="text-center">후원처</th>
						<th class="text-center">스테이지명</th>
						<th width="14%" class="text-center">기간</th>
						<th width="12%" class="text-center">개설일</th>
						<th width="6%" class="text-center">상태여부</th>
						<th width="6%" class="text-center">노출유무</th>
						<th width="18%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult->result() as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="donateStageApplicant<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->StageCode?></a></td>
						<td class="text-center"><?=$row->CompanyName?></td>
						<td class="text-center"><a href="donateStageInformation<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->Title?></a></td>
						<td class="text-center"><?=$row->StageStart?> ~ <?=$row->StageEnd?></td>
						<td class="text-center"><?=$row->RegDate?></td>
						<td class="text-center"><?=fnRetState($row->StatusYn,arrPopupUseYn)?></td>
						<td class="text-center"><?=fnRetState($row->DisplayYn,arrPopupUseYn)?></td>
						<td class="text-center">
							<a href="donateStageModify<?=$sParam?>&Idx=<?=$row->Idx?>" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> Edit</a>
							<a href="/systems/donateStageApplicantExcel?Idx=<?=$row->Idx?>" class="btn btn-success btn-xs" ><i class="fa fa-file-excel-o"></i> Excel</a><!-- 나눔회원 다운로드 -->
							<a href="#modal-delete" class="btn btn-danger btn-xs delSelect" data-toggle="modal" data-idx="<?=$row->Idx?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="donateStageCreate<?=$sParam?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Create </a>
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

	$('.delProc').click(function(e){
		$.ajax({
		url:"/systems/donateStageDelProc?Idx=" + $("#delIdx").val(),
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
});
$(document).on('click', '.delSelect', function (e) {
	$("#delIdx").val($(this).data("idx"));
});
</script>