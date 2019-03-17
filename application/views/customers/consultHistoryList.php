<style> 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {
    border-color: #e2e7eb;
    padding: 15px 3px;
    background: #fff;
}
</style>
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
	<h1 class="page-header"> 업체 정보</h1>
	<!-- end page-header -->
	<div class="profile-container">
			<div class="row">
				<form class="form-inline" role="form" id="actForm" method="get">
						<input type="hidden" name="sPage" id="sPage" value="">
					</form>
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="2%" class="text-center">No</th>
								<th width="10%" class="text-center">업체명</th>
								<th width="6%" class="text-center">ID</th>
								<th width="6%" class="text-center">Password</th>
								<th width="5%" class="text-center">대표자명</th>
								<th width="5%" class="text-center">업태</th>
								<th width="10%" class="text-center">종목</th>
								<th width="15%" class="text-center">주소</th>
								<th width="6%" class="text-center">전화번호</th>
								<th width="6%" class="text-center">FAX</th>
								<th width="6%" class="text-center">H.P</th>
								<th width="5%" class="text-center">Email</th>
								<th width="5%" class="text-center">등록일</th>
								<th width="4%" class="text-center">수정</th>
								<th width="4%" class="text-center">삭제</th>
							</tr>
						</thead>
						<tbody>
						
							<? foreach ($arrResult as $index => $row) { ?>
								
							<tr>
								<td class="text-center"><?=$iNum--?></td>
								<td class="text-center"><?=$row["companyname"]?></td>
								<td class="text-center"><?=$row["userid"]?></td>
								<td class="text-center"><?=$row["userpwd"]?></td>
								<td class="text-center"><?=$row["managername"]?></td>
								<td class="text-center"><?=$row["maincategory"]?></td>
								<td class="text-center"><?=$row["subcategory"]?></td>
								<td class="text-center"><?=$row["companyaddr"]?></td>
								<td class="text-center"><?=$row["companytel"]?></td>
								<td class="text-center"><?=$row["fax"]?></td>
								<td class="text-center"><?=$row["managertel"]?></td>
								<td class="text-center"><?=$row["email"]?></td>
								<td class="text-center"><?=$row["regdate"]?></td>
								<td class="text-center "><form action="/customers/modifyCompany" method="post"><button name="idx" value="<?=$row["idx"]?>" class="btn btn-warning btn-sm modify" type="submit">수정</button></form></td>
								<td class="text-center ">
									<form action="/customers/consultHistoryList" method="post">
										<button name="idx2" value="<?=$row["idx"]?>" id="delete" class="btn btn-danger btn-sm delete" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</button>
									</form>
								</td>
							</tr>
							<? } ?>
						
						</tbody>
					</table>
				</div>	
			</div>
			<div align="right" >
				<form action="/customers/addCompany" method="post"><button name="add" value="add" class="btn btn-success btn-md modify" type="submit">등록</button></form>
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

});
</script>
