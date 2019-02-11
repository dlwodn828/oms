	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">시스템 관리</a></li>
            <li class="active">I-CSS / IPT / NICE</li>
        </ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">IPT 기술문 <small>Edit</small></h1>
		<!-- end page-header -->

        <div class="profile-container">

            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered form-custom" data-parsley-validate="true" name="demo-form">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">구분</label>
                        <div class="col-md-2 col-sm-4">
                            <input class="form-control" type="text" id="" name="" value="자기 특성" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">차원</label>
                        <div class="col-md-2 col-sm-4">
                            <input class="form-control" type="text" id="" name="" value="자아 존중감" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">수준 상 *</label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">수준 중 *</label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3" for="fullname">수준 하 *</label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3"><a href="iptResultItem" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Go List</a></label>
                        <div class="col-md-6 col-sm-6 m-t-10 text-center">
                            <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Save</button>
                            <a href="iptResultItem" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Cancel</a>
                        </div>
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
