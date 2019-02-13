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
	<div class="profile-container" align="center">
        <form action="/products/modifySaveProduct" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <? foreach($arrResult as $index => $row){ ?>
                                <? if($row["idx"]==$idx){ ?>
                                <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                                <tr>
                                    <th class="text-center">No</th>
                                    <input name ="idx" type="hidden" value=<?=$idx?> />
                                    <td class="text-center "><b><?=$row["idx"]?></b></td>
                                </tr>
                                <tr>
                                    <th class="text-center">품명</th>
                                    <td><input name="productname" class="i30" type="text" value="<?=$row["productname"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">재질</th>
                                    <td><input name="material" class="i30" type="text" value="<?=$row["material"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">도금</th>
                                    <td><input name="plated" class="i30" type="text" value="<?=$row["plated"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">굵기</th>
                                    <td><input name="size1" class="i30" type="text" value="<?=$row["size1"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">길이</th>
                                    <td><input name="size2" class="i80" type="text" value="<?=$row["size2"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">피치</th>
                                    <td><input name="size3" class="i30" type="text" value="<?=$row["size3"]?>"/></td>
                                </tr>
                                <tr>
                                    <th width="20%" class="text-center">세트번호</th>
                                    <td><input name="setnumber" class="i30" type="text" value="<?=$row["setnumber"]?>"/></td>
                                </tr>
                                <!-- <tr>
                                    <th width="6%" class="text-center">등록일</th>
                                    <td><input type="text" value="<?=$row["regdate"]?>"/></td>
                                </tr> -->
                                <? } ?>
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
                        <button type="submit" class="btn btn-success btn-sm" >저장</button>
                        <a href="/products/productList"class="btn btn-danger btn-sm ">취소</a>
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
    $(".i30").css("width", "100%");
    $(".i80").css("width", "100%");
});

</script>
