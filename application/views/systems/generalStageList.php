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
	<h1 class="page-header">일반 스테이지 관리 <small>List</small></h1>
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
							<select class="form-control width-150" id="sSearchState" name="sSearchState">
								<option value="">전체(상태구분)</option>
								<option value="R" <?=checkSelect($sSearchState,"R","s")?>>대기</option>
								<option value="S" <?=checkSelect($sSearchState,"S","s")?>>진행</option>
								<option value="C" <?=checkSelect($sSearchState,"C","s")?>>단순연체</option>
								<option value="L" <?=checkSelect($sSearchState,"L","s")?>>연체</option>
								<option value="W" <?=checkSelect($sSearchState,"W","s")?>>부실</option>
								<option value="E" <?=checkSelect($sSearchState,"E","s")?>>완료</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchType" name="sSearchType">
								<option value="">전체(키워드)</option>
								<option value="StageCode" <?=checkSelect($sSearchType,"StageCode","s")?>>스테이지 코드</option>
								<option value="Title" <?=checkSelect($sSearchType,"Title","s")?>>스테이지 이름</option>
								<option value="CategoryName" <?=checkSelect($sSearchType,"CategoryName","s")?>>관심 카테고리명</option>
								<option value="UserNickName" <?=checkSelect($sSearchType,"UserNickName","s")?>>개설자</option>
								<option value="UserId" <?=checkSelect($sSearchType,"UserId","s")?>>이메일</option>
								<option value="StageRate" <?=checkSelect($sSearchType,"StageRate","s")?>>이율</option>
								<option value="StageNum" <?=checkSelect($sSearchType,"StageNum","s")?>>인원</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchDateType" name="sSearchDateType">
								<option value="">전체(날짜구분)</option>
								<option value="RegDate"  <?=checkSelect($sSearchDateType,"RegDate","s")?>>개설일</option>
								<option value="StartDate"  <?=checkSelect($sSearchDateType,"StartDate","s")?>>효력개시일</option>
								<option value="EndDate"  <?=checkSelect($sSearchDateType,"EndDate","s")?>>만기일</option>
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
						<!--<div class="dropdown pull-right m-t-10">
							<a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								Sortings by <span class="caret m-l-5"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="javascript:;">Posted Date</a></li>
								<li><a href="javascript:;">View Count</a></li>
								<li><a href="javascript:;">Total View</a></li>
							</ul>
						</div>-->
					</div>
				</form>
			</div>
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="5%" class="text-center">No</th>
						<th width="10%" class="text-center">스테이지 코드</th>
						<th width="5%" class="text-center">보안</th>
						<th width="7%" class="text-center">카테고리</th>
						<th class="text-center">스테이지명</th>
						<th width="5%" class="text-center">개설자</th>
						<th width="5%" class="text-center">이율</th>
						<th width="5%" class="text-center">인원수</th>
						<th width="5%" class="text-center">회차</th>
						<th width="8%" class="text-center">약정금액</th>
						<th width="8%" class="text-center">개설일</th>
						<th width="8%" class="text-center">효력개시일</th>
						<th width="8%" class="text-center">만기일</th>
						<th width="5%" class="text-center">상태</th>
						<th width="7%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult->result() as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/generalStageInformation<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->StageCode?></a></td>
						<td class="text-center"><?=fnStageSecret($row->SecretYN)?></td>
						<td class="text-center"><?=$row->CategoryName?></td>
						<td class="text-center"><a href="/systems/generalStageModify<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->Title?></a></td>
						<td class="text-center"><?=$row->UserNickName?></td>
						<td class="text-center"><?=$row->StageRate?>%</td>
						<td class="text-center"><?=$row->StageNum?>명</td>
						<td class="text-center"><?=$row->NowTurn?></td>
						<td class="text-center"><?=number_format($row->StageMoney*$row->StageNum*10000)?></td>
						<td class="text-center"><?=$row->RegDate?></td>
						<td class="text-center"><?=$row->StartDate?></td>
						<td class="text-center"><?=$row->EndDate?></td>
						<td class="text-center"><?=fnStageState02($row->State)?></td>
						<td class="text-center">
							<!-- 대기중일때만 스테이지 수정가능 -->
							<a href="/systems/generalStageModify<?=$sParam?>&Idx=<?=$row->Idx?>" class="btn btn-success btn-xs" ><i class="fa fa-edit"></i> Edit</a>
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
</script>