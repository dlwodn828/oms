<!-- begin #content -->
<div id="content" class="content">
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
                                <td><input class="form-control" id="companyname" name="companyname" type="text"/></td>
                            </tr>
                            <tr>
                                <th class="text-center">ID*</th>
                                <td><input class="form-control" id="userid" name="userid" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">Password*</th>
                                <td><input class="form-control" id="userpwd" name="userpwd" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">대표자명</th>
                                <td><input class="form-control" name="managername" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">업태</th>
                                <td><input class="form-control" name="maincategory" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">종목</th>
                                <td><input class="form-control" name="subcategory" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">주소</th>
                                <td><input class="form-control" name="companyaddr" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">전화번호</th>
                                <td><input class="form-control" name="companytel" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">FAX</th>
                                <td><input class="form-control" name="fax" type="text" /></td>
                            </tr>
                            <tr>
                                <th width="20%" class="text-center">HP</th>
                                <td><input class="form-control" name="managertel" type="text" /></td>
                            </tr>
                            <tr>
                                <th class="text-center">Email</th>
                                <td><input class="form-control" name="email"  type="text" /></td>
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
function check_blank(){
    if($("#companyname").val()==""||$("#userid").val()==""||$("#userpwd").val()==""){
        alert("필수 입력란이 비어있습니다.");
        $("form").attr("action", "/customers/addCompany");
    }
}
</script>
