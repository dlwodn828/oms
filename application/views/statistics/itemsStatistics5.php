<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">통계 관리</a></li>
		<li class="active">스테이지 통계</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header"> 인원  - 5명 <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="col-md-12 p-15">
				<form class="form-inline" role="form" id="actForm" method="get">
					<div class="form-inline">
						<div class="form-group">
							<div class="alert alert-info p-10 m-b-0">
								<strong>Default : Last 30 Days</strong>
							</div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control width-100" name="dStartDate" id="datepicker-date" placeholder="Date Start">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control width-100" name="dEndDate" id="datepicker-date2" placeholder="Date End">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered table-hover table-td-valign-middle">
					<thead>
					<tr>
						<th width="5%" rowspan="2" class="text-center">이율</th>
						<th width="60%" colspan="19" class="text-center">약정금액(만원)</th>
					</tr>
					<tr>
						<?
						$arrPaymentMoney01=array();
						$arrPaymentMoney02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
						for ($iCnt=1;$iCnt<20;$iCnt++) {
							$arrPaymentMoney01[$iCnt]= $iCnt*5*10;
							echo "<th class='text-center'>".$arrPaymentMoney01[$iCnt]."</th>";
						} ?>
					</tr>
					</thead>
					<tbody>
						<? for ($iCnt=11;$iCnt<24;$iCnt++) {
							for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
								if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
									$iCnt03=$arrDate04[$iCnt02]["StageMoney"]/50;
									$arrPaymentMoney02[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
								}
							}
						}
						for ($iCnt=11;$iCnt<24;$iCnt++) {?>
						<tr>
							<td class="text-center valign-middle"><?=$iCnt?>%</td>
							<?
							for ($iCnt02=1;$iCnt02<20;$iCnt02++) {
								echo "<td class='text-center valign-middle'>".$arrPaymentMoney02[$iCnt][$iCnt02]."</td>";
							} ?>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<div class="panel-body">
					<div class="dataTables_info">
						<a href="/statistics/itemsStatistics5Excel<?=$sParam?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/js/form-plugins.datepicker.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#datepicker-date").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#datepicker-date2").datepicker( "setDate", "<?=$dEndDate?>" );
});
</script>