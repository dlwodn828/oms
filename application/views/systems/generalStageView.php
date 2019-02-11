	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li><a href="javascript:;">Home</a></li>
			<li><a href="javascript:;">시스템 관리</a></li>
			<li class="active">스테이지 관리</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">일반 스테이지 관리 <small>View</small></h1>
		<!-- end page-header -->

        <div class="profile-container">

            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" name="demo-form">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">스테이지 등록자</label>
                        <div class="col-md-2 col-sm-2">홍길동</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="email">참여인원 * :</label>
                        <div class="col-md-6 col-sm-6">
                            <span class="person badge badge-warning badge-square cursor-pointer" data-id="7">7명</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="email">약정금액 * :</label>
                        <div class="col-md-6 col-sm-6">20만원</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="email">이율 * :</label>
                        <div class="col-md-9 col-sm-9">
                            <span class="interest-rate badge badge-warning badge-square cursor-pointer" data-id="6.5">6.5%</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="email">카테고리 * :</label>
                        <div class="col-md-9 col-sm-9">
                            <span class="category badge badge-warning badge-square cursor-pointer" data-id="2">컴퓨터/가전</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="email">공개여부 * :</label>
                        <div class="col-md-4 col-sm-4">
                            <!-- 현재 설정된 인원은 active -> badge-warning -->
                            <div class="col-md-4 col-md-4 p-l-0">
                                <span class="open-yn badge badge-warning badge-square cursor-pointer" data-id="N">비공개</span>
                            </div>
                            <div class="col-md-4 col-sm-4 open-yn-pwd">
                                비밀번호 : 123456
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">스테이지 제목 </label>
                        <div class="col-md-6 col-sm-6">스테이지 제목입니다.스테이지 제목입니다.</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="message">스테이지 소개 (300자 이내)</label>
                        <div class="col-md-6 col-sm-6">스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="message">스테이지 사진</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="file"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="message">스테이지 내용</label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" id="message" name="message" rows="10">
                                스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.<br />
                                스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.<br />
                                스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.<br />
                                스테이지 제목입니다.스테이지 제목입니다.스테이지 제목입니다.<br />
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3"><a href="generalStageList" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
                    </div>
                </form>
            </div>

    	</div>
        <!-- end #profile-container -->
    </div>
	<!-- end #content -->

	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<script>
$(document).ready(function() {
    App.init();
	FormDatePickerPlugins.init();
});
</script>

</body>
</html>
