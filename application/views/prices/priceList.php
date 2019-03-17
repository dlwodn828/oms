<style>
#addbtn{
	margin-right : 10px;
	margin-bottom: 30px;
}
</style>
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin page-header -->
	<h1 class="page-header"> 업체별 품목 단가 정보</h1>
	<!-- end page-header -->
	<div class="profile-container">
			<div class="row">
				<div class="table-responsive">
					<div class="p-b-10">
						<form class="form-inline" role="form" id="actForm" method="get">
							<input type="hidden" name="sPage" id="sPage" value="">
							<div class="form-inline">
							<div class="form-group">
								<select class="form-control width-150" id="companyidx" name="companyidx">
									<option value="">전체(업체명)</option>
									<? foreach($arrResult02 as $row) { ?>
										<option value="<?=$row["idx"]?>" <?=checkSelect($companyidx,$row["idx"],"s")?>>
											<?=$row["companyname"]?>
										</option>
									<? } ?>
								</select>
							</div>
							</div>
						</form>
					</div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="3%" class="text-center">No</th>
								<th width="12%" class="text-center">거래처명</th>
								<th width="12%" class="text-center">사용품목</th>
								<th width="8%" class="text-center">규격</th>
								<th width="8%" class="text-center">재질</th>
								<th width="8%" class="text-center">도금</th>
								<th width="5%" class="text-center">세트번호</th>
								<th width="10%" class="text-center">단가(원)</th>
								<th width="3%" class="text-center">저장</th>
								<th width="3%" class="text-center">삭제</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult as $index => $row) { ?>
							<tr>
								<td class="text-center"><?=$iNum--?></td>
								<td class="text-center"><?=$row["companyname"]?></td>
								<td class="text-center"><?=$row["productname"]?></td>
								<td class="text-center"><?=$row["size"]?></td>
								<td class="text-center"><?=$row["material"]?></td>
								<td class="text-center"><?=$row["plated"]?></td>
								<td class="text-center"><?=$row["setnumber"]?></td>
								<td class="text-center"><form action="/prices/priceList" method="post"><input name="productidx" type="hidden" value="<?=$row['sidx']?>"><input name="price" class="form-control text-center" type="text" value="<?=$row["price"]?>"/></td>
								<td class="text-center "><button name="idx" value="<?=$row["idx"]?>" class="btn btn-primary btn-sm modify" type="submit">저장</button></form></td>
								<td class="text-center "><form action="/prices/deletePrice" method="post"><input name="productidx" type="hidden" value="<?=$row['sidx']?>"><button name="idx2" value="<?=$row["idx"]?>" class="btn btn-danger btn-sm modify" type="submit">삭제</button></form></td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div align="right" >
				<form action="/prices/addPrice" method="post">
					<button id="addbtn" name="add" value="add" class="btn btn-success btn-md modify" type="submit">업체가 사용할 품목 등록하기</button>
				</form>
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
	</div>
	<!-- end #profile-container -->
	
</div>

<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
	
});


$(document).on("change","#companyidx",function(e) {
	$("#actForm").submit();
});

</script>
