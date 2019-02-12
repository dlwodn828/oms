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
        <form action="/customers/modifySaveCompany" method="post">
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
                                    <th class="text-center">ID</th>
                                    <td><input name="userid" class="i30" type="text" value="<?=$row["userid"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Password</th>
                                    <td><input name="userpwd" class="i30" type="text" value="<?=$row["userpwd"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">업체명</th>
                                    <td><input name="companyname" class="i30" type="text" value="<?=$row["companyname"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">대표자명</th>
                                    <td><input name="managername" class="i30" type="text" value="<?=$row["managername"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">주소</th>
                                    <td><input name="companyaddr" class="i80" type="text" value="<?=$row["companyaddr"]?>"/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">전화번호</th>
                                    <td><input name="companytel" class="i30" type="text" value="<?=$row["companytel"]?>"/></td>
                                </tr>
                                <tr>
                                    <th width="20%" class="text-center">HP</th>
                                    <td><input name="managertel" class="i30" type="text" value="<?=$row["managertel"]?>"/></td>
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
    $(".tb_top").css("background-color","#6d7983");
    $(".i30").css("width", "30%");
    $(".i80").css("width", "100%");
});

</script>
