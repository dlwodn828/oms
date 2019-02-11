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
	<h1 class="page-header">IPT 설문 참여자 <small>View</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="vertical-box">
			<div class="vertical-box-column width-300">
				<!-- begin wrapper -->
				<div class="wrapper">
					<div class="panel panel-profile">
						<div class="panel-body">
							<?=fnImageView("/member/".$arrResult02->UserPhoto,"img-circle width-100","width:100px;height:100px;")?>
							<div class="name p-t-10"><?=$arrResult02->UserName?></div>
							<ul class="list-group no-margin text-left p-t-10">
								<li class="list-group-item"><span class="text-success p-l-10">닉네임</span><span class="pull-right p-r-10"><?=$arrResult02->UserNickName?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">이메일</span><span class="pull-right p-r-10"><?=$arrResult02->UserId?></span></li>
								<li class="list-group-item"><span class="text-success p-l-10">가입경로</span><?=fnMemberAgreePath($arrResult02->UserAgreePath)?></li>
								<li class="list-group-item"><span class="text-success p-l-10">가입일</span><span class="pull-right p-r-10"><?=$arrResult02->RegDate?></span></li>
								<li class="list-group-item">
									<span class="text-success p-l-10">회원등급</span>
									<?=fnMemberGrade($arrResult02->UserGrade)?>
								</li>
								<li class="list-group-item"><span class="text-warning p-l-10">I-CSS 등급</span><span class="badge badge-primary badge-square pull-right"><?=$arrResult02->ICSSGrade?> (<?=$arrResult02->ICSSScore?>)</span></li>
								<li class="list-group-item">
									<span class="text-warning p-l-10">나눔 여부</span>
									<?=fnMemberNanum($arrResult02->UserNanumYn)?>
								</li>
								<li class="list-group-item"><span class="text-warning p-l-10">플러스 가입입</span><span class="text-danger pull-right p-r-10"><?=$arrResult02->PlusRegDate?></span></li>
							</ul>
						</div>
					</div>
					<div class="text-left">
						<a href="/systems/iptApplicantList<?=$sParam02?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a>
					</div>
				</div>
				<!-- end wrapper -->
			</div>
			<div class="vertical-box-column tab-content">
				<!-- begin information -->
				<div id="information" class="p-0">
					<div class="panel panel-profile">
						<div class="wrapper">
							<h4 class="m-b-15 m-t-0 p-b-10 underline"><i class="fa fa-info-circle m-r-5"></i> IPT 설문조사 결과
								<a href="/systems/iptApplicantList<?=$sParam02?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> Go List</a>
							</h4>
							<div class="panel-body panel-form form-horizontal form-bordered">
								<div class="table-responsive">
									<table class="table table-bordered table-hover table-td-valign-middle">
										<thead>
											<tr>
												<th width="15%" class="text-center">구분</th>
												<!--th width="15%" class="text-center">차원</th-->
												<th width="15%" class="text-center">수준</th>
												<th class="text-center">기술문</th>
											</tr>
										</thead>
										<tbody>
											<? for ($iCnt=0;$iCnt<5;$iCnt++) { ?>
											<tr>
												<? if ($iCnt==0) { ?><td rowspan="5" class="text-center">자기 특성</td><? } ?>
												<td class="text-center"><?=$arrReturnResult[$iCnt]["ItemName"]?></td>
												<!--td class="text-center">상</td-->
												<td class="text-left"><?=$arrReturnResult[$iCnt]["Contents"]?></td>
											</tr>
											<? } ?>
											<? for ($iCnt=5;$iCnt<10;$iCnt++) { ?>
											<tr>
												<? if ($iCnt==5) { ?><td rowspan="5" class="text-center">업무 특성</td><? } ?>
												<td class="text-center"><?=$arrReturnResult[$iCnt]["ItemName"]?></td>
												<!--td class="text-center">상</td-->
												<td class="text-left"><?=$arrReturnResult[$iCnt]["Contents"]?></td>
											</tr>
											<? } ?>
											<? for ($iCnt=10;$iCnt<15;$iCnt++) { ?>
											<tr>
												<? if ($iCnt==10) { ?><td rowspan="5" class="text-center">관계 특성</td><? } ?>
												<td class="text-center"><?=$arrReturnResult[$iCnt]["ItemName"]?></td>
												<!--td class="text-center">상</td-->
												<td class="text-left"><?=$arrReturnResult[$iCnt]["Contents"]?></td>
											</tr>
											<? } ?>
										</tbody>
									</table>
								</div>
								<!-- end #table-responsive -->
							</div>
						</div>
					</div>
				</div>
				<!-- end information -->
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
});
</script>