<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">회원 관리</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">회원가입 현황 <small>List</small></h1>
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
						<div class="form-group">
							<select class="form-control width-125" id="sSearchUserGrade" name="sSearchUserGrade">
								<option value="" >전체(등급)</option>
								<option value="1" <?=checkSelect($sSearchUserGrade,"1","s")?>>일반회원</option>
								<option value="2" <?=checkSelect($sSearchUserGrade,"2","s")?>>나눔회원</option>
								<option value="3" <?=checkSelect($sSearchUserGrade,"3","s")?>>플러스회원</option>
							</select>
							<select class="form-control width-150" id="sSearchUserAgreePath" name="sSearchUserAgreePath">
								<option value="" >전체(가입경로)</option>
								<option value="E" <?=checkSelect($sSearchUserAgreePath,"E","s")?>>email</option>
								<option value="F" <?=checkSelect($sSearchUserAgreePath,"F","s")?>>facebook</option>
								<option value="K" <?=checkSelect($sSearchUserAgreePath,"K","s")?>>kakao</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-125" id="sSearchUserGender" name="sSearchUserGender">
								<option value="">전체(성별)</option>
								<option value="M" <?=checkSelect($sSearchUserGender,"M","s")?>>남성</option>
								<option value="W" <?=checkSelect($sSearchUserGender,"W","s")?>>여성</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-125" id="sSearchUserAge" name="sSearchUserAge">
								<option value="">전체(연령대)</option>
								<option value="2" <?=checkSelect($sSearchUserAge,"2","s")?>>20대</option>
								<option value="3" <?=checkSelect($sSearchUserAge,"3","s")?>>30대</option>
								<option value="4" <?=checkSelect($sSearchUserAge,"4","s")?>>40대</option>
								<option value="5" <?=checkSelect($sSearchUserAge,"5","s")?>>50대</option>
								<option value="6" <?=checkSelect($sSearchUserAge,"6","s")?>>60대</option>
								<option value="7" <?=checkSelect($sSearchUserAge,"7","s")?>>70대</option>
								<option value="8" <?=checkSelect($sSearchUserAge,"8","s")?>>80대</option>
								<option value="9" <?=checkSelect($sSearchUserAge,"9","s")?>>90대</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-150" id="sSearchUserCategory" name="sSearchUserCategory">
								<option value="">전체(관심카테고리)</option>
								<? foreach ($arrResult02->result() as $row) { ?>
									<option value="<?=$row->Idx?>" <?=checkSelect($sSearchUserCategory,$row->Idx,"s")?>><?=$row->CategoryName?></option>
								<? } ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control width-125" id="sSearchUserSuccessionYn" name="sSearchUserSuccessionYn">
								<option value="" >전체(승계회원여부)</option>
								<option value="Y" <?=checkSelect($sSearchUserSuccessionYn,"Y","s")?>>Y</option>
								<option value="N" <?=checkSelect($sSearchUserSuccessionYn,"N","s")?>>N</option>
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
						<th width="7%" class="text-center">회원 코드</th>
						<th width="5%" class="text-center">등급</th>
						<th class="text-center">이메일</th>
						<th width="5%" class="text-center">이름</th>
						<th width="7%" class="text-center">닉네임</th>
						<th width="5%" class="text-center">가입경로</th>
						<th width="5%" class="text-center">아임인을 알게된 경로</th>
						<th width="5%" class="text-center">성별</th>
						<th width="5%" class="text-center">연령대</th>
						<th width="5%" class="text-center">나눔여부</th>
						<th width="8%" class="text-center">가입일</th>
						<th width="7%" class="text-center">플러스 가입일</th>
						<th width="7%" class="text-center">I-CSS(점수)</th>
						<th width="5%" class="text-center">대기 S</th>
						<th width="5%" class="text-center">진행 S</th>
						<th width="7%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult->result() as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/memberView<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->UserCode?></a></td>
						<td class="text-center"><?=fnMemberGrade($row->UserGrade)?></td>
						<td class="text-center"><a href="/systems/memberView<?=$sParam?>&Idx=<?=$row->Idx?>"><?=fnstrCuting($row->UserId,50)?></a></td>
						<td class="text-center"><a href="/systems/memberView<?=$sParam?>&Idx=<?=$row->Idx?>"><?=$row->UserName?></a></td>
						<td class="text-center"><?=$row->UserNickName?></td>
						<td class="text-center"><?=fnMemberAgreePath($row->UserAgreePath)?></td>
						<td class="text-center"><?=$row->RegistValue?></td>
						<td class="text-center"><?=fnMemberGender($row->UserGender)?></td>
						<td class="text-center"><span class="badge badge-warning"><?=fnMemberAge($row->UserPSNNo)?></span></td>
						<td class="text-center"><?=fnMemberNanum($row->UserNanumYn)?></td>
						<td class="text-center"><?=$row->RegDate?></td>
						<td class="text-center"><?=$row->PlusRegDate?></td>
						<td class="text-center"><?=$row->ICSSGrade?> (<?=$row->ICSSScore?>)</td>
						<td class="text-center"><?=$row->iCnt01?></td>
						<td class="text-center"><?=$row->iCnt02?></td>
						<td class="text-center">
							<a href="/systems/memberView<?=$sParam?>&Idx=<?=$row->Idx?>" class="btn btn-info btn-xs" ><i class="fa fa-eye"></i> View</a>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
				<div class="dataTables_info" id="data-table_info">
					<a href="/systems/memberListExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
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
$(document).on('change', '#sSearchUserAgreePath', function (e) {
	$("#actForm").submit();
});
$(document).on('change', '#sSearchUserCategory', function (e) {
	$("#actForm").submit();
});
$(document).on('change', '#sSearchUserSuccessionYn', function (e) {
	$("#actForm").submit();
});
$(document).on('change', '#sSearchUserGender', function (e) {
	$("#actForm").submit();
});
$(document).on('change', '#sSearchUserAge', function (e) {
	$("#actForm").submit();
});
</script>
