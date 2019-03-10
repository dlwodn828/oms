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
	<h1 class="page-header">주문내역</h1>
	<!-- end page-header -->
	<div class="profile-container">
			<div class="row">
				<div class="table-responsive">
					<div class="p-b-10">
						<form class="form-inline" role="form" id="actForm1" method="get">
							<input type="hidden" name="sPage" id="sPage" value="">
							<div class="form-inline">
							<!-- <div class="form-group">
								<select class="form-control width-150" id="setnumber" name="setnumber">
									<option value="">세트 번호</option>
									<? foreach($arrResult02 as $row) { ?>
									<option value="<?=$row["setnumber"]?>" <?=checkSelect($setnumber,$row["setnumber"],"s")?>><?=$row["setnumber"]?></option>
									<? } ?>
								</select>
							</div> -->
<!-- 		
								<div class="form-group" >
									<div class="input-group ">
										<input type="text" class="form-control" placeholder="Search" name="sSearchWord" id="sSearchWord" value="<?=$sSearchWord?>">
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
										</div>
									</div>
								</div> -->
		
							</div>
						</form>
					</div>
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
							<tr>
								<th width="3%" class="text-center">No</th>
								<th width="8%" class="text-center">품목명</th>
								<th width="6%" class="text-center">규격</th>
								<th width="6%" class="text-center">재질</th>
								<th width="6%" class="text-center">도금</th>
								<th width="1%" class="text-center">set</th>
								<th width="6%" class="text-center">주문수량</th>
								<th width="4%" class="text-center">단가(원)</th>
								<th width="7%" class="text-center">주문금액</th>
								<th width="5%" class="text-center">주문일자</th>
								<th width="5%" class="text-center">납기일</th>
								<th width="8%" class="text-center">배송지</th>
							</tr>
						</thead>
						<tbody>
						<script>var totalprice=0;</script>
							<? foreach ($arrResult as $index => $row) { ?>
							
							<tr>
								<td class="text-center"><?=++$no?></td>
								<td class="text-center"><?=$row["productname"]?></td>
								<td class="text-center"><?=$row["size"]?></td>
								<td class="text-center"><?=$row["material"]?></td>
								<td class="text-center"><?=$row["plated"]?></td>
								<td class="text-center"><?=$row["setnumber"]?></td>
								<td class="text-center orderquantity<?=$no?>"><?=$row["orderquantity"]?></td>
								<td class="text-center price<?=$no?>"><?=$row["orderprice"]?></td>
								<td class="text-center total<?=$no?>"></td>					
								<td class="text-center"><?=$row["orderdate"]?></td>
								<td class="text-center"><?=$row["duedate"]?></td>
								<td class="text-center"><?=$row["destination"]?></td>
							</tr>
							
							<script>
								
								function removeComma(str){
									n = parseInt(str.replace(/,/g,"")); //?
									return n;
								}

								// var defaultPrice = removeComma($(".price<?=$no?>").html());
								// var orderquantity = removeComma($(".orderquantity<?=$no?>").val());
								// var supplyPrice = defaultPrice * orderquantity;
								// var vat = Math.floor(supplyPrice * 0.1);
								// var total = supplyPrice + vat;
								

								// //가격에도 콤마 추가하기 그전에 콤마 없애기
								// $('.supplyprice<?=$no?>').html(AddComma(supplyPrice));
								// // $('.vat<?=$no?>').html(AddComma(vat));
								// $('.total<?=$no?>').html(AddComma(total));
								// $('.price<?=$no?>').html(AddComma(defaultPrice));
								// });

								function AddComma(data_value) {
									return Number(data_value).toLocaleString('en');
								}

								var defaultPrice = $(".price<?=$no?>").html();
								var orderquantity = $(".orderquantity<?=$no?>").html();
								var supplyPrice = defaultPrice * orderquantity;
								var vat = Math.floor(supplyPrice * 0.1);
								var total = supplyPrice + vat;
								
								// $('.total<?=$no?>').html(AddComma(total));
								$('.supplyprice<?=$no?>').html(AddComma(supplyPrice));
								$('.orderquantity<?=$no?>').html(AddComma(orderquantity));
								$('.total<?=$no?>').html(AddComma(total));
								$('.price<?=$no?>').html(AddComma(defaultPrice));
							</script>
							<? } ?>		
							<!-- <script>
								$(document).on('click','.cb',function(){
									if(this.checked){
										totalprice+=$('.total<?=$no?>').html();
										$('.totalprice').html(totalprice);
									}else{
										totalprice-=$('.total<?=$no?>').html();
										$('.totalprice').html(totalprice);
									}
								});
							</script>					 -->
						</tbody>
					</table>
				</div>
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
	</div>
	<!-- end #profile-container -->
	
</div>
<!-- #modal-dialog -->
<!-- purchase form for printing-->
<!-- <div class="hidden print" id="orderForm"></div> --> -->

<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
});
</script>
