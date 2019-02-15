<style>
#addbtn{
    display:inline;
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
	<h1 class="page-header"> 업체 등록</h1>
	<!-- end page-header -->
	<div class="profile-container" align="center">
        <form action="/customers/consultHistoryList" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                            <tr>
                                <th class="text-center">거래처명*</th>
                                <td>
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
                                    <div class=""> 
                                        <form action="">
                                            <button id="addbtn"class="btn btn-md btn-default">새로운 업체 등록하기</button>
                                        <form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">사용품목*</th>
                                <td><input class="form-control" id="userid" name="userid" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">규격*</th>
                                <td><input class="form-control" id="userpwd" name="userpwd" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">재질</th>
                                <td><input class="form-control" name="managername" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">도금</th>
                                <td><input class="form-control" name="maincategory" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">세트번호*</th>
                                <td><input class="form-control" name="subcategory" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">단가(원)*</th>
                                <td><input class="form-control" name="companyaddr" type="text" /></td>
                            </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="pull-center">
                        <button type="submit" id="save2" name="save2" value="save2" class="btn btn-success btn-sm" onclick="check_blank()">저장</button>
                        <a href="/prices/priceList"class="btn btn-danger btn-sm ">취소</a>
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
function check_blank(){
    if($(".form-control").val()==""){
        alert("필수 입력란이 비어있습니다.");
        $("form").attr("action", "/prices/addPrice");
    }
}
</script>
