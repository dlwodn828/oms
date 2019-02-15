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
        <form action="/customers/consultHistoryList" method="post">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-td-valign-middle">
						<thead>
                            <? foreach($arrResult as $index => $row){ ?>
                                <? if($row["idx"]==$idx){ ?>
                                <input name ="idx" type="hidden" value=<?=$idx?> />
                                <tr><th class="text-center tb_top">항목</th><th class="text-center tb_top">정보</th></tr>
                                <tr>
                                    <th class="text-center">거래처명</th>
                                    <td><input name="companyname" type="text" value="<?=$row["companyname"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <td><input name="userid" type="text" value="<?=$row["userid"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Password</th>
                                    <td><input name="userpwd" type="text" value="<?=$row["userpwd"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">대표자명</th>
                                    <td><input name="managername" type="text" value="<?=$row["managername"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">업태</th>
                                    <td><input name="maincategory" type="text" value="<?=$row["maincategory"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">종목</th>
                                    <td><input name="subcategory" type="text" value="<?=$row["subcategory"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">주소</th>
                                    <td><input name="companyaddr" type="text" value="<?=$row["companyaddr"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">전화번호</th>
                                    <td><input name="companytel" type="text" value="<?=$row["companytel"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">FAX</th>
                                    <td><input name="fax" type="text" value="<?=$row["fax"]?>"/></td>
                                </tr>
                                <tr>
                                    <th width="20%" class="text-center">HP</th>
                                    <td><input name="managertel" type="text" value="<?=$row["managertel"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <td><input name="email"  type="text" value="<?=$row["email"]?>"/></td>
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
                        <button type="submit"name="save1" value="save1" class="btn btn-success btn-sm" >저장</button>
                        <a href="/customers/consultHistoryList"class="btn btn-danger btn-sm ">취소</a>
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
