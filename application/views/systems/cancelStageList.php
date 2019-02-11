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
	<h1 class="page-header">대기(취소자) 스테이지 관리 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
				<form class="form-inline" role="form" id="actForm" method="get">
					<input type="hidden" name="sPage" id="sPage" value="">
					<div class="form-inline">
						<div class="form-group">
							<h4><span class="badge badge-default badge-square p-8">게시물 : <?=number_format($iTotalCnt)?> EA </span></h4>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchReason" name="sSearchReason">
								<option value="">전체(취소이유)</option>
								<option value="1" <?=checkSelect($sSearchReason,"1","s")?>>이율이 낮아서</option>
								<option value="2" <?=checkSelect($sSearchReason,"2","s")?>>사람이 안차서</option>
								<option value="3" <?=checkSelect($sSearchReason,"3","s")?>>개인 변심</option>
								<option value="4" <?=checkSelect($sSearchReason,"4","s")?>>서비스 불만</option>
								<option value="5" <?=checkSelect($sSearchReason,"5","s")?>>순번 변경 목적</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchType" name="sSearchType">
								<option value="">전체(키워드)</option>
								<option value="StageCode" <?=checkSelect($sSearchType,"StageCode","s")?>>스테이지 코드</option>
								<option value="Title" <?=checkSelect($sSearchType,"Title","s")?>>스테이지 이름</option>
								<option value="CreatUserNickName" <?=checkSelect($sSearchType,"CreatUserNickName","s")?>>개설자</option>
								<option value="LeaveUserNickName" <?=checkSelect($sSearchType,"LeaveUserNickName","s")?>>취소자 이름</option>
								<option value="LeaveUserId" <?=checkSelect($sSearchType,"LeaveUserId","s")?>>취소자 이메일</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchDateType" name="sSearchDateType">
								<option value="">전체(날짜구분)</option>
								<option value="CreateRegDate"  <?=checkSelect($sSearchDateType,"CreateRegDate","s")?>>개설일</option>
								<option value="LeaveDate"  <?=checkSelect($sSearchDateType,"LeaveDate","s")?>>취소일</option>
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
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="5%" class="text-center">No</th>
						<th width="10%" class="text-center">스테이지 코드</th>
						<th class="text-center">스테이지명</th>
						<th width="5%" class="text-center">개설자</th>
						<th width="5%" class="text-center">이율</th>
						<th width="5%" class="text-center">인원수</th>
						<th width="8%" class="text-center">약정금액</th>
						<th width="8%" class="text-center">개설일</th>
						<th width="5%" class="text-center">취소자명</th>
						<th width="8%" class="text-center">연락처</th>
						<th width="8%" class="text-center">취소이유</th>
						<th width="8%" class="text-center">취소일</th>
						<th width="7%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) {  ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/cancelStageView<?=$sParam?>&Idx=<?=$row["Idx"]?>"><?=$row["StageCode"]?></a></td>
						<td class="text-center"><a href="/systems/cancelStageView<?=$sParam?>&Idx=<?=$row["Idx"]?>"><?=$row["Title"]?></a></td>
						<td class="text-center"><?=$row["CreatUserNickName"]?></td>
						<td class="text-center"><?=$row["StageRate"]?>%</td>
						<td class="text-center"><?=$row["StageNum"]?></td>
						<td class="text-center"><?=number_format($row["StageMoney"]*$row["StageNum"]*10000)?></td>
						<td class="text-center"><?=$row["CreateRegDate"]?></td>
						<td class="text-center"><a href="/customers/memberConsultBasic?Idx=<?=$row["CancelIdx"]?>" target="_blank"><?=$row["LeaveUserNickName"]?></a></td>
						<td class="text-center"><?=$row["UserTel"]?></td>
						<td class="text-center"><?=$row["LeaveReason"]?></td>
						<td class="text-center"><?=$row["LeaveDate"]?></td>
						<td class="text-center">
							<a target="_blank" href="/systems/cancelStageView<?=$sParam?>&Idx=<?=$row["Idx"]?>" class="btn btn-info btn-xs" ><i class="fa fa-eye"></i> View</a>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="/systems/cancelStageListExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel Download</a>
				</div>
				<div class="dataTables_paginate paging_simple_numbers pull-right" id="data-table_paginate">
					<?=$sPaging?>
				</div>
			</div>
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
	$("#dStartDate").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#dEndDate").datepicker( "setDate", "<?=$dEndDate?>" );
});
$(document).on("change","#sSearchReason",function(e) {
	$("#actForm").submit();
});
</script>