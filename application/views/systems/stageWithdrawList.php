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
	<h1 class="page-header">스테이지 약정철회 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
				<form class="form-inline" role="form" id="actForm" method="get">
					<input type="hidden" name="sPage" id="sPage" value="">
					<div class="form-inline">
						<div class="form-group">
							<select class="form-control width-150" id="sSearchState" name="sSearchState">
								<option value="">전체(상태구분)</option>
								<option value="1" <?=checkSelect($sSearchState,"1","s")?>>처리중</option>
								<option value="2" <?=checkSelect($sSearchState,"2","s")?>>보류중</option>
								<option value="3" <?=checkSelect($sSearchState,"3","s")?>>승계처리</option>
								<option value="4" <?=checkSelect($sSearchState,"4","s")?>>탈퇴처리</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchAdminIdx" name="sSearchAdminIdx">
								<option value="" >전체(직원)</option>
								<? foreach($arrResult02 as $row) { ?>
								<option value="<?=$row["Idx"]?>"  <?=checkSelect($sSearchAdminIdx,$row["Idx"],"s")?>><?=$row["AdminName"]?></option>
								<? } ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchType" name="sSearchType">
								<option value="">전체(키워드)</option>
								<option value="StageCode" <?=checkSelect($sSearchType,"StageCode","s")?>>스테이지 코드</option>
								<option value="UserNickName" <?=checkSelect($sSearchType,"UserNickName","s")?>>닉네임</option>
								<option value="UserId" <?=checkSelect($sSearchType,"UserId","s")?>>이메일</option>
								<option value="UserTel" <?=checkSelect($sSearchType,"UserTel","s")?>>연락처</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchDateType" name="sSearchDateType">
								<option value="">전체(날짜구분)</option>
								<option value="RegDate"  <?=checkSelect($sSearchDateType,"RegDate","s")?>>신청일</option>
								<option value="ApproveDate"  <?=checkSelect($sSearchDateType,"ApproveDate","s")?>>처리일</option>
							</select>
						</div>
						<div class="input-group">
							<div class="input-group input-daterange">
								<input type="text" class="form-control" name="dStartDate" id="dStartDate" placeholder="Date Start">
								<span class="input-group-addon">to</span>
								<input type="text" class="form-control" name="dEndDate" id="dEndDate" placeholder="Date End">
							</div>
						</div>
						<div class="form-group" >
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
			<table class="table table-bordered table-hover table-td-valign-middle table-primary">
				<thead>
					<tr>
						<th width="6%" class="text-center">No</th>
						<th width="10%" class="text-center">스테이지 코드</th>
						<th class="text-center">스테이지 제목</th>
						<th width="6%" class="text-center">이율</th>
						<th width="6%" class="text-center">순번</th>
						<th width="7%" class="text-center">회차</th>
						<th width="8%" class="text-center">약정금액</th>
						<th width="6%" class="text-center">신청자</th>
						<th width="6%" class="text-center">상담자</th>
						<th width="8%" class="text-center">접수일</th>
						<th width="8%" class="text-center">처리일</th>
						<th width="8%" class="text-center">처리결과</th>
						<th width="7%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/generalStageInformation?Idx=<?=$row["StageIdx"]?>" target="_about"><?=$row["StageCode"]?></a></td>
						<td class="text-center"><a href="/systems/stageWithdrawModify<?=$sParam?>&Idx=<?=$row["Idx"]?>"><?=$row["Title"]?></a></td>
						<td class="text-center"><?=$row["StageRate"]?>%</td>
						<td class="text-center"><span class="badge badge-warning badge-square"><?=$row["MyTurn"]?></span></td>
						<td class="text-center"><span class="badge badge-primary badge-square"><?=$row["NowTurn"]?></span> / <span class="badge badge-default badge-square"><?=$row["StageNum"]?></span></td>
						<td class="text-center"><?=number_format($row["StageMoney"]*10000)?>원</td>
						<td class="text-center"><?=$row["UserNickName"]?></td>
						<td class="text-center"><?=$row["AdminName"]?></td>
						<td class="text-center"><?=$row["RegDate"]?></td>
						<td class="text-center"><?=$row["ApproveDate"]?></td>
						<td class="text-center"><?=fnUserWithdrawState($row["State"])?></td>
						<td class="text-center">
							<a href="/systems/stageWithdrawModify<?=$sParam?>&Idx=<?=$row["Idx"]?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<!--<div class="dataTables_info" id="data-table_info">
					<a href="#none" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
				</div>-->
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
					<div class="modal-body text-center">
						<h4 class="text-danage">정말로 삭제하시겠습니까?</h4>
					</div>
					<div class="panel-body panel-form">
						<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm02" action="/settings/r_create_proc" method="POST">
							<input type="hidden" name="Idx" id="Idx" value=""/>
							<div class="form-group"></div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname">삭제이유 * </label>
								<div class="col-md-9 col-sm-6">
									<select class="form-control width-150" id="" name="">
										<option value="1" selected>시간초과</option>
										<option value="2">본인요청</option>
										<option value="3">기타</option>
									</select>
								</div>
							</div>
						</form>
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
	$("#dStartDate").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#dEndDate").datepicker( "setDate", "<?=$dEndDate?>" );
});
$(document).on('change', '#sSearchState', function (e) {
	$("#actForm").submit();
});
$(document).on('change', '#sSearchAdminIdx', function (e) {
	$("#actForm").submit();
});

</script>