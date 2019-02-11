<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">시스템 관리</a></li>
		<li class="active">스테이지 현황</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">나눔 스테이지 현황 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body text-left">
							<p><b>STAGE</b></p>
							<ul class="nav nav-pills nav-stacked nav-sm">
								<li class="active"><a href="donateStageApplicant<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(관리) </a></li>
								<li><a href="donateStageStats<?=$sParam?>"><i class="fa fa-users fa-fw m-r-5"></i> 나눔 현황(통계) </a></li>
								<li><a href="donateStageInformation<?=$sParam?>"><i class="fa fa-info-circle fa-fw m-r-5"></i> 기본정보 </a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-profile">
						<div class="panel-body">
							<ul class="list-group no-margin text-left">
								<li class="list-group-item"><span class="text-info p-l-10">스테이지 코드</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->StageCode?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">상태여부</span><?=fnRetState($arrResult02->StatusYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">노출여부</span><?=fnRetState($arrResult02->DisplayYn,arrPopupUseYn)?></li>
								<li class="list-group-item"><span class="text-info p-l-10">기간</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->StageStart?>~<?=$arrResult02->StageEnd?></span></li>
								<li class="list-group-item"><span class="text-info p-l-10">개설일</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->RegDate?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">후원처</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyName?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">목표금액</span><span class="badge badge-primary badge-square pull-right m-r-10"><?=number_format($arrResult02->TargetMoney)?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">담당자</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyDamdang?></span></li>
								<li class="list-group-item"><span class="text-warning p-l-10">연락처</span><span class="text-primary pull-right p-r-10"><?=$arrResult02->CompanyTel?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="http://www.google.co.kr" target="_about" class="btn btn-info btn-xs"><i class="fa fa-link"></i> 홈페이지</a>
						<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin applicant -->
				<div class="panel panel-profile">
					<div class="wrapper">
						<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-users m-r-5"></i> 스테이지 나눔 현황(관리)
							<a href="donateStageList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
						</h4>
						<!--form class="form-inline" role="form" id="actForm" method="get">
							<input type="hidden" name="sPage" id="sPage" value="">
							<div class="form-inline">
								<div class="form-group">
									<h4><span class="label label-default p-8">나눔회원 : <?=$iTotalCnt?> 명</span></h4>
								</div>
								<div class="form-group">
									<select class="form-control width-150" id="" name="">
										<option value="" selected>전체(구분)</option>
										<option value="1">이름</option>
										<option value="2">주민번호앞자리</option>
										<option value="3">휴대전화</option>
									</select>
								</div>
								<div class="input-group">
									<div class="input-group input-daterange">
										<input type="text" class="form-control" name="start" placeholder="Date Start">
										<span class="input-group-addon">to</span>
										<input type="text" class="form-control" name="end" placeholder="Date End">
									</div>
								</div>
								<div class="form-group pull-right" >
									<div class="input-group ">
										<input type="text" class="form-control" placeholder="Search" name="searchWord" id="searchWord" value="">
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</form-->
						<table class="table table-bordered table-hover table-td-valign-middle table-primary">
							<thead>
								<tr>
									<th width="7%" class="text-center">No</th>
									<th width="10%" class="text-center">이름</th>
									<th width="15%" class="text-center">주민번호</th>
									<th width="15%" class="text-center">휴대전화</th>
									<th class="text-center">주소</th>
									<th width="10%" class="text-center">나눔일</th>
								</tr>
							</thead>
							<tbody id="contentsList01"></tbody>
						</table>
						<!-- pagination -->
						<div class="panel-body">
							<div class="dataTables_info" id="data-table_info">
								<a href="/systems/donateStageApplicantExcel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel Download</a>
							</div>
							<div class="dataTables_paginate paging_simple_numbers pull-right" id="contentsPaging" ></div>
						</div>
					</div>
				</div>
				<!-- end applicant -->
			</div>
			<!-- end vertical-box-column -->
		</div>
	</div>
	<!-- end vertical-box -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	fnMemberConsultListAjax(gPage);
});
var gPage=1;
function fnMemberConsultListAjax(sPage02) {
	fnReset01();
//	location.href="/systems/donateStageApplicantAjax?ParentIdx=<?=$ParentIdx?>&sPage02="+sPage02;
	$.ajax({
		url:"/systems/donateStageApplicantAjax?ParentIdx=<?=$ParentIdx?>&sPage02="+sPage02,
		dataType: 'json',
		async: false,
		success:function(data){
			var obj = data;
			for (var iCnt=0;iCnt < obj["arrResult"].length; iCnt++){
				fnAjaxContents(obj["arrResult"][iCnt],obj["iNum"]);
				obj["iNum"]--;
			}
			fnAjaxPaging(obj["iTotalCnt"],obj["iPageScale"],obj["iStepScale"],obj["sPage02"]);
			gPage=sPage02;
		}
		,beforeSend: function() {
		}
		,complete: function() {
		}
	});
}
function fnAjaxContents(objValue,iNum) {
	var sContents="";
	sContents+="<tr>";
	sContents+="	<td class='text-center'>"+iNum+"</td>";
	sContents+="	<td class='text-center'><a href='/customers/memberConsultBasic?Idx="+objValue.UserIdx+"' target='_about'>"+objValue.UserName+"</a></td>";
	sContents+="	<td class='text-center'>"+objValue.UserPSNNo+"</td>";
	sContents+="	<td class='text-center'>"+objValue.UserTel+"</td>";
	sContents+="	<td class='text-center'>"+objValue.UserAddress01+" "+objValue.UserAddress02+"</td>";
	sContents+="	<td class='text-center'>"+objValue.RegDate+"</td>";
	sContents+="</tr>";
	$("#contentsList01").append(sContents);
}
function fnReset01() {
	$('#contentsList01 *').remove();
	$('#contentsPaging *').remove();
}
function fnAjaxPaging(iNum,iPageScale,iStepScale,iPage) {
	iLastPage = iNum/iPageScale + (iNum%iPageScale==0?0:1);
	iStepStart = (parseInt((iPage-1)/iStepScale,10))*iStepScale+1;
	iStepEnd = iStepStart + iStepScale;
	iStepValue = iStepStart-iStepScale;
	var sContents="";
	sContents+="<ul class='pagination pagination-sm'>";
	if (iStepValue>0) {
		sContents+="<li><a class='paginate_button ' href=\"javascript:fnMemberConsultListAjax("+iStepValue+");\" aria-controls='data-table' tabindex='0'>Previous</a><li>";
	} else {
		sContents+="<li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Previous</a></li>";
	}
	for (iCnt=iStepStart;iCnt<=iLastPage&&iCnt<iStepEnd;iCnt++) {
		if(iPage==iCnt){
			sContents+=" <li class='active'><a class='paginate_button active' aria-controls='data-table' tabindex='0'>"+iCnt+"</a></li>";
		} else {
			sContents+=" <li><a href=\"javascript:fnMemberConsultListAjax("+iCnt+");\">"+iCnt+"</a></li>";
		}
	}
	if(iStepEnd<=iLastPage){
		sContents+=" <li><a href=\"javascript:fnMemberConsultListAjax("+iStepEnd+");\"  rel='next'>Next</a></li>";
	} else {
		sContents+=" <li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Next</a></li>";
	}
	sContents+="</ul>";
	$("#contentsPaging").append(sContents);
}
</script>