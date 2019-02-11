<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li><a href="javascript:;">ALLT</a></li>
		<li class="active">카스188</li>
	</ol>
	 end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header"> 출입정보(실시간)</h1>
	<!-- end page-header -->
	<div class="profile-container">
			<div class="row">
				<div class="table-responsive">
					<div class="p-b-10">
						<form class="form-inline" role="form" id="actForm" method="get">
							<input type="hidden" name="sPage" id="sPage" value="">
							<div class="form-inline">
								<div class="input-group">
									<div class="input-group input-daterange">
										<input type="text" class="form-control width-100" name="dStartDate" id="dStartDate" placeholder="Date Start">
										<span class="input-group-addon">to</span>
										<input type="text" class="form-control width-100" name="dEndDate" id="dEndDate" placeholder="Date End">
									</div>
								</div>
								<div class="form-group">
									<select class="form-control width-300" id="sSearchType" name="sSearchType">
										<option value="">이벤트종류</option>
										<? foreach ($arrResult01->result() as $row) { ?>
										<option value="<?=$row->nEventIdn?>" <?=checkSelect($sSearchType,$row->nEventIdn,"s")?>><?=$row->sName?></option>
										<? } ?>
									</select>
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
								<th width="7%" class="text-center">No</th>
								<th width="10%" class="text-center">이벤트 로그ID</th>
								<th width="10%" class="text-center">이벤트 시간</th>
								<th width="10%" class="text-center">이벤트 종류</th>
								<th width="10%" class="text-center">등록된 유저명</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult as $index => $row) { ?>
							<tr>
								<td class="text-center"><?=$iNum--?></td>
								<td class="text-center"><?=$row["evtid"]?></td>
								<td class="text-center"><?=$row["evttime"]?></td>
								<td class="text-center"><?=$row["evttype"]?></td>
								<td class="text-center"><?=$row["evtname"]?></td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
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
		<!-- #modal-comment -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- #modal-dialog -->
<div class="modal fade" id="modal-email">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">이메일 주문</h4>
			</div>
			<div class="modal-body">
				이메일 주문을 보내시겠습니까?
			</div>
			<div class="modal-footer">
				<!-- <input type="hidden" id="pidx" value="">
				<input type="hidden" id="basequantity" value=""> -->
				<a href="javascript:;" class="btn btn-sm btn-white closeOrder" data-dismiss="modal">Close</a>
				<a href="javascript:;" class="btn btn-sm btn-success sendOrder">Send</a>
			</div>
		</div>
	</div>
</div>

<!-- purchase form for printing-->
<div class="hidden print" id="orderForm"></div>

<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	FormDatePickerPlugins.init();
	$("#dStartDate").datepicker( "setDate", "<?=$dStartDate?>" );
	$("#dEndDate").datepicker( "setDate", "<?=$dEndDate?>" );
});

</script>
