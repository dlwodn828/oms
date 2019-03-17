<!-- begin #content -->
<div id="content" class="content">
	<!-- begin page-header -->
	<h1 class="page-header"> 업체 정보</h1>
	<!-- end page-header -->
	<div class="profile-container" align="center">
        <form action="/prices/modifySavePrice" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <? foreach($arrResult as $index => $row){ ?>
                                <? if($row["idx"]==$idx){ ?>
                                <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                                <input name ="idx" type="hidden" value=<?=$idx?> />
                                <tr>
                                    <th class="text-center">품명</th>
                                    <td><input name="pricename" type="text" value="<?=$row["pricename"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">규격</th>
                                    <td><input name="material" type="text" value="<?=$row["size"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">재질</th>
                                    <td><input name="plated" type="text" value="<?=$row["material"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">도금</th>
                                    <td><input name="size1" type="text" value="<?=$row["plated"]?>"/></td>
                                </tr>
                                <tr>
                                    <th width="20%" class="text-center">세트번호</th>
                                    <td><input name="setnumber" type="text" value="<?=$row["setnumber"]?>"/></td>
                                </tr>
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

</script>
