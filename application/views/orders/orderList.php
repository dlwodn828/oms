<style>

#addbtn{
	margin-right : 10px;
	margin-bottom: 30px;
}
.bottom_form{
	/* margin-top : 10px; */
	margin-bottom : 30px;
	display:block;
}
.form-border{
	border : 1px solid gray;
}
.bf{
	width : 400px;
}
.bftop{
	margin-top:20px;
}
h4{
	display:inline;
	margin:5px;

}
.border-none{
	border : 0px white;
}
.totalprice{
	font-size:3rem;
}
.tpf{
	margin-bottom:20px;
	margin-right:20px;
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
	<h1 class="page-header"> 주문내역</h1>
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
			<!--
									<div class="form-group" >
										<div class="input-group ">
											<input type="text" class="form-control" placeholder="Search" name="sSearchWord" id="sSearchWord" value="<?=$sSearchWord?>">
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
											</div>
										</div>
									</div>
			-->
							</div>
						</form>
					</div>
							
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="2%" class="text-center">No</th>
								<th width="6%" class="text-center">업체명</th>
								<th width="6%" class="text-center">품목명</th>
								<th width="6%" class="text-center">규격</th>
								<th width="6%" class="text-center">재질</th>
								<th width="6%" class="text-center">도금</th>
								<th width="1%" class="text-center">set</th>
								<th width="6%" class="text-center">주문수량</th>
								<th width="3%" class="text-center">단가(원)</th>
								<th width="7%" class="text-center">주문금액</th>
								<th width="5%" class="text-center">주문일자</th>
								<th width="5%" class="text-center">납기일</th>
								<th width="8%" class="text-center">배송지</th>
								<th width="3%" class="text-center">수정</th>
								<th width="3%" class="text-center">삭제</th>
							</tr>
						</thead>
						<?$i=0;$count=0;?>
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
								<td class="text-center orderquantity<?=$iNum?>"><?=$row["orderquantity"]?></td>
								<td class="text-center price<?=$iNum?>"><?=$row["orderprice"]?></td>
								<td class="text-center total<?=$iNum?>"></td>					
								<td class="text-center"><?=$row["orderdate"]?></td>
								<td class="text-center"><?=$row["duedate"]?></td>
								<td class="text-center"><?=$row["destination"]?></td>
								<td class="text-center "><form action="/orders/modifyOrder" method="post"><input type="hidden" value="<?=$row["idx"]?>"><button name="idx" value="<?=$row["oidx"]?>" class="btn btn-warning btn-sm modify" type="submit">수정</button></form></td>
								<td class="text-center ">
									<form action="/orders/deleteOrder" method="post">
										<button name="idx2" value="<?=$row["oidx"]?>" id="delete" class="btn btn-danger btn-sm delete" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</button>
									</form>
								</td>
							</tr>
							
							<script>
								
								function removeComma(str){
									n = parseInt(str.replace(/,/g,"")); //?
									return n;
								}

								function AddComma(data_value) {
									return Number(data_value).toLocaleString('en');
								}

								var defaultPrice = $(".price<?=$iNum?>").html();
								var orderquantity = $(".orderquantity<?=$iNum?>").html();
								var supplyPrice = defaultPrice * orderquantity;
								var vat = Math.floor(supplyPrice * 0.1);
								var total = supplyPrice + vat;
								
								// $('.total<?=$iNum?>').html(AddComma(total));
								$('.supplyprice<?=$iNum?>').html(AddComma(supplyPrice));
								$('.orderquantity<?=$iNum?>').html(AddComma(orderquantity));
								$('.total<?=$iNum?>').html(AddComma(total));
								$('.price<?=$iNum?>').html(AddComma(defaultPrice));
							</script>
							<? } ?>		
						</tbody>
					</table>
				</div>
			</div>
			</div>
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
</div>
<!-- #modal-dialog -->
<!-- purchase form for printing-->

<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
});
$(document).on("change","#companyidx",function(e) {
	$("#actForm").submit();
});
</script>
