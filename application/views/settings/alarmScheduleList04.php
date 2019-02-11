<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">설정 관리</a></li>
		<li class="active">알림 자동발송</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">지급 대상 회원 알림 발송 내역<small>List</small></h1>
	<!-- end page-header -->
	<div class="profile-container">
		<div class="table-responsive">
			<div class="p-b-10">
			</div>
			<form class="form-inline" role="form" id="actForm" method="get">
			<input type="hidden" name="sPage" id="sPage" value="">
			</form>
			<table class="table table-bordered table-hover table-td-valign-middle">
				<thead>
					<tr>
						<th width="10%" class="text-center">No</th>
						<th width="15%" class="text-center">회원명</th>
						<th class="text-center">내용</th>
						<th width="20%" class="text-center">발송일</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($arrResult as $row) { ?>
					<tr>
						<td class="text-center"><?=$iNum--?></td>
						<td class="text-center"><?=$row["UserNickName"]?></td>
						<td class="text-center"><?=$row["Contents"]?></td>
						<td class="text-center"><?=$row["RegDate"]?></td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<!-- pagination -->
			<div class="panel-body">
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
});
</script>