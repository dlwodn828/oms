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
        <form action="/prices/priceList" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                            <tr>
                                <th class="text-center">거래처명*</th>
                                <td >
                                <div align="center">
                                    <div class="fm fm-top"> 
                                            <!-- <form class="fm" action="/customers/addCompany"> -->
                                                <!-- <form action="/customers/addCompany" method="post"><input type="hidden" name="addpricepage" value="addpricepage"/></form> -->
                                                <a href="/customers/addCompany" id="addbtn"class="btn btn-md btn-primary">새로운 업체 등록하기</a>
                                            <!-- <form> -->
                                    </div>
                                    <div class="fm or">또는</div>
                                    
                                        <input type="hidden" name="sPage" id="sPage" value="">
                                        <div class="fm slct">
                                            <div class="">
                                                <select class="form-control width-150" id="companyidx" name="companyidx">
                                                    <option value="">전체(업체명)</option>
                                                    <? foreach($arrResult02 as $row) { ?>
                                                        <option value="<?=$row["idx"]?>">
                                                            <?=$row["companyname"]?>
                                                        </option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                                </div>    
                                    
                                    
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">사용품목*</th>
                                <td><input class="form-control" id="procuctname" name="productname" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">규격*</th>
                                <td><input class="form-control" id="size" name="size" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">재질</th>
                                <td><input class="form-control" name="material" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">도금</th>
                                <td><input class="form-control" name="plated" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">세트번호*</th>
                                <td><input class="form-control" name="setnumber" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">단가(원)*</th>
                                <td><input class="form-control" name="price1" type="text" /></td>
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
                        <button type="submit" id="saveprice" name="saveprice" value="saveprice" class="btn btn-success btn-sm" onclick="check_blank()">저장</button>
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
    $(".fm").css("display","inline-block").css("float","left");
    $(".fm-top").css("margin-top","7px").css("margin-left","80px");
    $(".or").css("margin-top","7px").css("margin-left","15px");
    $(".slct").css("margin-left","15px");
});
function check_blank(){
    if($(".form-control").val()==""){
        alert("필수 입력란이 비어있습니다.");
        $("form").attr("action", "/prices/addPrice");
     
    }

}
</script>
