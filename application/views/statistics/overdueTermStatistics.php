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
	<h1 class="page-header">연체 기간별 <small>Statistics</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="col-md-12 p-15">
				<form class="form-inline" role="form" id="actForm" method="get">
					<input type="hidden" name="sPage" id="sPage" value="">
					<div class="form-inline">
						<div class="form-group">
							<div class="alert alert-info p-10 m-b-0">
								<strong>Default : Last 30 Days</strong>
							</div>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" id="datepicker-date" name="sStartDate" />
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" id="datepicker-date2" name="sEndDate" />
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
			<div class="col-md-12 p-15">
				<table class="table table-bordered table-hover table-td-valign-middle">
					<thead>
					<tr>
						<th width="14%" rowspan="2" class="text-center">날짜</th>
						<th colspan="6" class="text-center">연체 기간</th>
						<th width="14%" rowspan="2" class="text-center">소계</th>
					</tr>
					<tr>
						<th width="12%" class="text-center">1일 이상</th>
						<th width="12%" class="text-center">5일 이상</th>
						<th width="12%" class="text-center">10일 이상</th>
						<th width="12%" class="text-center">15일 이상</th>
						<th width="12%" class="text-center">20일 이상</th>
						<th width="12%" class="text-center">25일 이상</th>
					</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center valign-middle">2016.10.16</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (30%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle"><span class="text-primary">40</span></td>
						</tr>
						<tr>
							<td class="text-center valign-middle">2016.10.16</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (30%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle"><span class="text-primary">40</span></td>
						</tr>
						<tr>
							<td class="text-center valign-middle">2016.10.16</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (30%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle"><span class="text-primary">40</span></td>
						</tr>
						<tr>
							<td class="text-center valign-middle">2016.10.16</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (30%)</td>
							<td class="text-center valign-middle">10 (20%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle">10 (15%)</td>
							<td class="text-center valign-middle"><span class="text-primary">40</span></td>
						</tr>
						<tr>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">합 계</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">300 (15%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">165 (20%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">135 (30%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">300 (20%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">300 (15%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-13 f-w-500">300 (15%)</span></td>
							<td class="text-center valign-middle"><span class="text-warning f-s-15 f-w-700">600</span></td>
						</tr>
					</tbody>
				</table>
				<div class="panel-body">
					<div class="dataTables_info">
						<a href="#none" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i> Excel </a>
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
});
</script>