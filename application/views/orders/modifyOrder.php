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
	<h1 class="page-header">주문 정보 수정</h1>
	<!-- end page-header -->
	<div class="profile-container" align="center">
        <form action="/orders/orderList" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <? foreach($arrResult as $index => $row){ ?>
                                
                                <input name ="idx" type="hidden" value=<?=$idx?> />
                                <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                                <tr>
                                    <th class="text-center">거래처명</th>
                                    <td><?=$row["companyname"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">품목명</th>
                                    <td><?=$row["productname"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">규격</th>
                                    <td><?=$row["size"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">재질</th>
                                    <td><?=$row["material"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">도금</th>
                                    <td><?=$row["plated"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">set</th>
                                    <td><?=$row["setnumber"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">주문수량</th>
                                    <td  ><input class="orderquantity" name="orderquantity" type="text" value="<?=$row["orderquantity"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">단가(원)</th>
                                    <td class="price" ><?=$row["orderprice"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">주문금액(원)</th>
                                    <td class="total"></td>
                                </tr>
                                <tr>
                                    <th width="20%" class="text-center">주문일자</th>
                                    <td><?=$row["orderdate"]?></td>
                                </tr>
                                <tr>
                                    <th class="text-center">납기일</th>
                                    <td><input name="duedate"  type="text" value="<?=$row["duedate"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">배송지</th>
                                    <td><input name="destination"  type="text" value="<?=$row["destination"]?>"/></td>
                                </tr>
                                <script>
                                
								var defaultPrice = $(".price").html();
								var orderquantity = $(".orderquantity").val();
								var supplyPrice = defaultPrice * orderquantity;
								var vat = Math.floor(supplyPrice * 0.1);
								var total = supplyPrice + vat;
								
								// $('.total<?=$no?>').html(AddComma(total));
								
								$('.total').html(total);
                               

                                $(document).on('change', '.orderquantity', function(e) {

                                    orderquantity = $(".orderquantity").val();
                                    supplyPrice = defaultPrice * orderquantity;
                                    vat = Math.floor(supplyPrice * 0.1);
                                    total = supplyPrice + vat;
                                        
									$('.total').html(total);
									
									
								});

                                </script>
                                
                            <? } ?>
                            
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-center">
                        <button type="submit"name="save1" value="save1" class="btn btn-success btn-sm" >저장</button>
                        <a href="/orders/orderList"class="btn btn-danger btn-sm ">취소</a>
					</div>
				</div>
			</div>
			<!-- pagination -->
        </form>   
		</div>
		<!-- end #table-responsive -->
		<!-- #modal-comment -->
	</div>
	<!-- end #profile-container -->
</div>
<!-- end #content -->
<script>
$(document).ready(function() {
	App.init();
    $("table").css("width","40%");
    $("tr").css("height","45px");
    $(".tb_top").css("background-color","#e3e9f2");
    $("input").css("width", "100%");
});

</script>
