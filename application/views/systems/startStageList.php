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
	<h1 class="page-header">효력대기 스테이지 관리 <small>List</small></h1>
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
						<!-- 효력개시는 사용자가 스테이지생성후 스테이지 인원이 다 찼을경우 효력개시일은 다음날 오전 10시임(대기중인 스테이지임) -->
						<!-- 매일 관리자가 오전 10시에 버튼 클릭하여 효력개시함 -->
						<div class="form-group pull-right" >
							<div class="input-group ">
								<div class="input-group-btn">
									<button type="button" id="stage-start" class="btn btn-primary">효력개시 <i class="text-danger glyphicon glyphicon-play"></i> </button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<table class="table table-bordered table-hover table-td-valign-middle" style="width: 1750px">
				<thead>
					<tr class="valign-middle">
						<th width="80" class="text-center valign-middle">No</th>
						<th width="125" class="text-center">스테이지 코드</th>
						<th width="60" class="text-center">보안</th>
						<th width="125" class="text-center">카테고리</th>
						<th width="225" class="text-center">스테이지명</th>
						<th width="70" class="text-center">개설자</th>
						<th width="60" class="text-center">이율</th>
						<th width="70" class="text-center">인원수</th>
						<th width="420" class="text-center">
							<ul class="person-check">
								<li><a class="round text-inverse">1</a></li>
								<li><a class="round text-inverse">2</a></li>
								<li><a class="round text-inverse">3</a></li>
								<li><a class="round text-inverse">4</a></li>
								<li><a class="round text-inverse">5</a></li>
								<li><a class="round text-inverse">6</a></li>
								<li><a class="round text-inverse">7</a></li>
								<li><a class="round text-inverse">8</a></li>
								<li><a class="round text-inverse">9</a></li>
								<li><a class="round text-inverse">10</a></li>
								<li><a class="round text-inverse">11</a></li>
								<li><a class="round text-inverse">12</a></li>
								<li><a class="round text-inverse">13</a></li>
							</ul>
						</th>
						<th width="70" class="text-center">대기일</th>
						<th width="60" class="text-center">추천</th>
						<!--th width="175" class="text-center">Action</th-->
						<th width="100" class="text-center">약정금액</th>
						<th width="100" class="text-center">개설일</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) {  ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><a href="/systems/startStageView<?=$sParam?>&Idx=<?=$row["Idx"]?>"><?=$row["StageCode"]?></a></td>
						<td class="text-center"><?=fnStageSecret($row["SecretYN"])?></td>
						<td class="text-center"><?=$row["CategoryName"]?></td>
						<td class="text-center"><a href="/systems/startStageView<?=$sParam?>&Idx=<?=$row["Idx"]?>"><?=$row["Title"]?></a></td>
						<td class="text-center"><?=$row["UserNickName"]?></td>
						<td class="text-center"><?=$row["StageRate"]?>%</td>
						<td class="text-center"><?=$row["StageNum"]?></td>
						<td class="text-center">
							<ul class="person-check">
								<? foreach ($row["ListData"] as $row02) {
									if ($row02["UserIdx"]!="0") {
										echo "<li><a class='round bg-red'></a></li>";
									} else {
										echo "<li><a class='round bg-silver-darker'></a></li>";
									}
									?>
								<? } ?>
							</ul>
						</td>
						<td class="text-center"><span class="badge badge-warning">+<?=$row["OverDate"]?></span></td>
						<td class="text-center"><?=fnRecommend($row["RecommendYN"])?></td>
						<!--td class="text-center"><a href="#modal-delete" class="btn btn-danger btn-xs delSelect" data-toggle="modal" data-idx="<?=$row["Idx"]?>"><i class="glyphicon glyphicon-trash"></i> Delete</a></td-->
						<td class="text-center"><?=number_format($row["StageMoney"]*$row["StageNum"]*10000)?></td>
						<td class="text-center"><?=$row["RegDate"]?></td>
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
						<form data-parsley-validate="true" class="form-horizontal form-bordered" id="actForm02" action="/settings/manager_create_proc" method="POST">
							<input type="hidden" name="Idx" id="Idx" value=""/>
							<div class="form-group"></div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3" for="fullname">삭제이유 * </label>
								<div class="col-md-9 col-sm-6">
									<select class="form-control width-150" id="DelReason" name="DelReason">
										<option value="시간초과">시간초과</option>
										<option value="본인요청">본인요청</option>
										<option value="기타">기타</option>
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
	$("#stage-start").click(function() {
		if(confirm("정말로 현재 효력대기중인 스테이지를 효력개시하시겠습니까?")) {
			$.ajax({
				url:"/systems/startStageProc<?=$sParam?>",
				dataType:"json",
			}).done(function (data) {
				alert(data.sMessage);
				if (data.sRetCode=="01") {
					location.reload();
				} else {

				}
			}).fail(function (data) {
				console.log(data.responseText);
				alert('작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
			});
		} else {
		}
	});
});
$(document).on('click', '.delSelect', function (e) {
	$("#delIdx").val($(this).data("idx"));
});
$('.delProc').click(function(e){
	$.ajax({
	url:"/systems/waitingStageDelProc?Idx=" +$("#delIdx").val()+"&DelReason="+encodeURIComponent($("#DelReason").val()),
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
