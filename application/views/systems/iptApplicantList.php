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
	<h1 class="page-header">IPT 설문 참여자 <small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
				<form class="form-inline" role="form" id="actForm" method="get">
				<input type="hidden" name="sPage" id="sPage" value="">
					<div class="form-inline">
						<div class="form-group">
							<h4><span class="badge badge-default badge-square p-8">참여자 : <?=$iTotalCnt?> 명 </span></h4>
						</div>
						<div class="form-group">
							<select class="form-control width-125" id="sSearchUserGrade" name="sSearchUserGrade">
								<option value="" >전체(등급)</option>
								<option value="1" <?=checkSelect($sSearchUserGrade,"1","s")?>>일반회원</option>
								<option value="2" <?=checkSelect($sSearchUserGrade,"2","s")?>>나눔회원</option>
								<option value="3" <?=checkSelect($sSearchUserGrade,"3","s")?>>플러스회원</option>
							</select>
							<select class="form-control width-150" id="sSearchType" name="sSearchType">
								<option value="">전체(키워드)</option>
								<option value="UserCode" <?=checkSelect($sSearchType,"UserCode","s")?>>회원코드</option>
								<option value="UserName" <?=checkSelect($sSearchType,"UserName","s")?>>이름</option>
								<option value="UserNickName" <?=checkSelect($sSearchType,"UserNickName","s")?>>닉네임</option>
								<option value="UserId" <?=checkSelect($sSearchType,"UserId","s")?>>이메일</option>
								<option value="UserTel" <?=checkSelect($sSearchType,"UserTel","s")?>>연락처</option>
							</select>
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
						<th width="10%" class="text-center">회원 코드</th>
						<th width="7%" class="text-center">등급</th>
						<th class="text-center">이메일</th>
						<th width="7%" class="text-center">이름</th>
						<th width="7%" class="text-center">닉네임</th>
						<th width="7%" class="text-center">I-CSS</th>
						<th width="7%" class="text-center">점수</th>
						<th width="12%" class="text-center">설문일</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/iptApplicantView<?=$sParam?>&Idx=<?=$row["Idx"]?>" ><?=$row["UserCode"]?></a></td>
						<td class="text-center"><?=fnMemberGrade($row["UserGrade"])?></td>
						<td class="text-center"><?=$row["UserId"]?></td>
						<td class="text-center"><a href="/systems/iptApplicantView<?=$sParam?>&Idx=<?=$row["Idx"]?>" ><?=$row["UserName"]?></a></td>
						<td class="text-center"><?=$row["UserNickName"]?></td>
						<td class="text-center"><span class="badge badge-warning badge-square"><?=$row["ICSSGrade"]?></span></td>
						<td class="text-center"><span class="badge badge-default badge-square"><?=$row["ICSSScore"]?></span></td>
						<td class="text-center"><?=$row["RegDate"]?></td>
						<td class="text-center">
							<a href="/systems/iptApplicantView<?=$sParam?>&Idx=<?=$row["Idx"]?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View</a>
						</td>
					</tr>
					<? } ?>

				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="/systems/iptApplicantListExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
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
$(document).on('change', '#sSearchUserGrade', function (e) {
	$("#actForm").submit();
});
</script>
