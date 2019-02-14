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
	<h1 class="page-header"> 품목 정보</h1>
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
								<th width="3%" class="text-center">No</th>
								<th width="12%" class="text-center">거래처명</th>
								<th width="12%" class="text-center">사용품목</th>
								<th width="8%" class="text-center">규격</th>
								<th width="8%" class="text-center">재질</th>
								<th width="8%" class="text-center">도금</th>
								<th width="5%" class="text-center">세트번호</th>
								<th width="10%" class="text-center">단가</th>
								<th width="3%" class="text-center">저장</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult as $index => $row) { ?>
							<tr>
								<td class="text-center"><?=++$no?></td>
								<td class="text-center"><?=$row["companyname"]?></td>
								<td class="text-center"><?=$row["productname"]?></td>
								<td class="text-center"><?=$row["size"]?></td>
								<td class="text-center"><?=$row["material"]?></td>
								<td class="text-center"><?=$row["plated"]?></td>
								<td class="text-center"><?=$row["setnumber"]?></td>
								<td class="text-center"><input class="form-control text-center" type="text" value="<?=$row["price"]?>"/></td>
								<td class="text-center "><form action="/prices/modifySavePrice" method="post"><button name="idx" value="<?=$row["idx"]?>" class="btn btn-default btn-sm modify" type="submit">저장</button></form></td>
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

// function delok(code){
//     result = confirm('삭제 하시겠습니까');
//     if(result == true){
//         location.href = "addlist_ok.asp?gubun=del&key=" + code;
//     }else{
//     return false;
//     }
// }




// modal창 제어
// $(document).on('click', '.delete', function (e) {
// 	// $("#pidx").val($(this).data("idx"));
// 	// $("#basequantity").val($(this).data("basequantity"));
// 	// $("#basequantity").val($("input[name=basequantity]").val());
// 	var arrIdx = [];
// 	var arrBasequantity = [];
// 	i = -1;
// 	$('td input:checked').each(function() {
// 		// i++;
// 		// index = i.toString();
// 	    arrIdx.push($(this).data('idx'));
// 		arrBasequantity.push($("input[name="+'"'+$(this).data('basequantity-name')+'"'+"]").val());
// 	});
// 	if (arrIdx === undefined || arrIdx.length == 0) {
// 		alert('주문하실 품명을 선택하세요!');
// 		$('#modal-email').modal('hide');
// 	} else {
// 		console.log(arrIdx);
// 		console.log(arrBasequantity);
// 	}
// 	// e.stopPropagation();
// 	$('.closeOrder').click(function(e) {
// 		$('#modal-email').modal('hide');
// 		$('.sendOrder').off('click');
// 	});
// 	$('.sendOrder').on('click', function(e) {
// 	// location.href="/customers/cancelStageProc?idx=<?=$row['idx']?>&basequantity="+$("#basequantity").val();
// 		$.ajax({
// 			type: "post",
// 			url: "/customers/cancelStageProc",
// 			data: {arrIdx: arrIdx, arrBasequantity: arrBasequantity},
// 			dataType:"json",
// 		}).done(function (data) {
// 			alert(data.sMessage);
// 			if (data.sRetCode=="01") {
// 				location.reload();
// 			} else {
// 				$('#modal-delete').modal('hide');
// 			}
// 			// data_html = $.parseHTML(data)
// 			// d = JSON.stringify(data, null, 4);
// 			console.log(data);
// 		}).fail(function (jqXHR, textStatus, errorThrown) {
// 			// Request failed. Show error message to user.
// 		    // errorThrown has error message, or "timeout" in case of timeout.
// 			console.log(errorThrown);
// 			// $('#modal-delete').modal('hide');
// 			alert('view에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
// 		});
// 	});
// });


// $('.printOrder').click(function(e) {
// 	var arrIdx = [];
// 	var arrBasequantity = [];
// 	i = -1;
// 	$('td input:checked').each(function() {
// 		// i++;
// 		// index = i.toString();
// 	    arrIdx.push($(this).data('idx'));
// 			arrBasequantity.push($("input[name="+'"'+$(this).data('basequantity-name')+'"'+"]").val());
// 	});
// 	if (arrIdx === undefined || arrIdx.length == 0) {
// 		alert('인쇄하실 품명을 선택하세요!');
// 		return;
// 	} else {
// 		console.log(arrIdx);
// 		console.log(arrBasequantity);
// 	}
// 	$.ajax({
// 		type: "post",
// 		url: "/customers/printOrder",
// 		data: {arrIdx: arrIdx, arrBasequantity: arrBasequantity},
// 		dataType:"json",
// 	}).done(function (data) {
// 		//alert(data.sMessage);
// 		$('#orderForm').html(data.data);
// 		var divToPrint=document.getElementById('orderForm');
// 		var newWin=window.open('','print window');
// 		// var myWindow=window.open('','','width=200,height=100');
// 		// newWin.document.open();
// 		newWin.document.write(divToPrint.innerHTML);
// 		newWin.focus();
// 		newWin.print();
// 		newWin.document.close();
// 			// setTimeout(function(){newWin.close();},10);
// 		// $('#orderForm').removeClass('hidden');
// 		// data_html = $.parseHTML(data)
// 		// d = JSON.stringify(data, null, 4);
// 		console.log(data);
// 	}).fail(function (jqXHR, textStatus, errorThrown) {
// 		// Request failed. Show error message to user.
// 		// errorThrown has error message, or "timeout" in case of timeout.
// 		console.log(errorThrown);
// 		// $('#modal-delete').modal('hide');
// 		alert('view에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
// 	});
// });

// $(document).on("change","#companyidx",function(e) {
// 	$("#actForm").submit();
// });
// $(document).on("change","#warehouseidx",function(e) {
// 	$("#actForm").submit();
// });
</script>
