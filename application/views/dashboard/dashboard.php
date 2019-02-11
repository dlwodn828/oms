<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Dashboard</h1>
	<!-- end page-header -->
	
	<!-- begin row -->
	<div class="row">
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-green">
				<div class="stats-icon"><i class="fa fa-desktop"></i></div>
				<div class="stats-info">
					<h4>일반 스테이지수</h4>
					<p><?=number_format($arrResult["iCnt01"])?></p>
				</div>
				<div class="stats-link">
					<a href="/systems/generalStageList">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
				<div class="stats-info">
					<h4>나눔 스테이지수</h4>
					<p><?=number_format($arrResult["iCnt02"])?></p>
				</div>
				<div class="stats-link">
					<a href="/systems/donateStageList">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-purple">
				<div class="stats-icon"><i class="fa fa-users"></i></div>
				<div class="stats-info">
					<h4>전체회원수</h4>
					<p><?=number_format($arrResult["iCnt03"])?></p>
				</div>
				<div class="stats-link">
					<a href="/systems/memberList">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
				<div class="stats-info">
					<h4>전체방문자(로그인)</h4>
					<p><?=number_format($arrResult["iCnt04"])?></p>
				</div>
				<div class="stats-link">
					<a href="/systems/memberList">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
	</div>
	<!-- end row -->
	<!-- begin row -->
	<div class="row">
		<!-- begin col-8 -->
		<div class="col-md-8">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">스테이지 생성 현황 (Last 20 Days)</h4>
				</div>
				<div class="panel-body">
					<div id="interactive-chart" class="height-sm"></div>
				</div>
			</div>
			
			<div class="panel panel-inverse" data-sortable-id="index-2">
				<div class="panel-heading">
					<h4 class="panel-title">회원현황 (Last 20 Days)</h4>
				</div>
				<div class="panel-body">
					<div id="interactive-chart-member" class="height-sm"></div>
				</div>
			</div>

		</div>
		<!-- end col-8 -->
		<!-- begin col-4 -->
		<div class="col-md-4">
			<div class="panel panel-inverse" data-sortable-id="index-3">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="/settings/inquiryList" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
					</div>
					<h4 class="panel-title">문의하기</h4>
				</div>
				<div class="panel-body p-t-0">
					<table class="table table-valign-middle m-b-0">
						<thead>
							<tr>	
								<th width="15%" >이름</th>
								<th>제목</th>
								<th width="20%">질문일</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult02 as $row) { ?>
							<tr>
								<td><a href="/settings/inquiryReply?Idx=<?=$row["Idx"]?>" ><?=$row["UserNickName"]?></a></td>
								<td><a href="/settings/inquiryReply?Idx=<?=$row["Idx"]?>" ><?=fnstrCuting($row["Contents"],100)?></a></td>
								<td><?=$row["RegDate"]?></td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="panel panel-inverse m-t-30" data-sortable-id="index-3">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="/settings/noticeList" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
					</div>
					<h4 class="panel-title">공지사항</h4>
				</div>
				<div class="panel-body p-t-0">
					<table class="table table-valign-middle m-b-0">
						<thead>
							<tr>	
								<th>내용</th>
								<th width="20%">등록일</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($arrResult03 as $row) { ?>
							<tr>
								<td><a href="/settings/noticeModify?Idx=<?=$row["Idx"]?>" ><?=fnstrCuting($row["Title"],100)?></a></td>
								<td><?=$row["RegDate"]?></td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- end col-4 -->
	</div>
	<!-- end row -->
</div>
<!-- end #content -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/dashboard.min.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
/*
	PHP 단에서 아래 배열값을 완성하여 뿌려줌
	data1 = ASoM Count
	data2 = Member Register
	data3 = Login member
	xLabel = 오늘날짜 기준으로 이전 19일까지 계산
*/
var handleInteractiveChart = function () {
	"use strict";
	function showTooltip(x, y, contents) {
		$('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
			top: y - 45,
			left: x - 55
		}).appendTo("body").fadeIn(200);
	}
	if ($('#interactive-chart').length !== 0) {
		var data1 = [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate01);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate01[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate01[$iCnt]."]";
				}
			}
			?>
		];
		var data2 = [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate02);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate02[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate02[$iCnt]."]";
				}
			}
			?>
		];
		var xLabel = [
			[1,''],[2,''],[3,'<?=$arrDate[2]?>'],[4,''],[5,''],[6,'<?=$arrDate[5]?>'],[7,''],[8,''],[9,'<?=$arrDate[8]?>'],[10,''],
			[11,''],[12,'<?=$arrDate[11]?>'],[13,''],[14,''],[15,'<?=$arrDate[14]?>'],[16,''],[17,''],[18,'<?=$arrDate[17]?>'],[19,''],[20,'']
		];
		
		$.plot($("#interactive-chart"), [
				{
					data: data1, 
					label: "스테이지 생성", 
					color: blue,
					lines: { show: true, fill:false, lineWidth: 2 },
					points: { show: true, radius: 3, fillColor: '#fff' },
					shadowSize: 0
				}, {
					data: data2,
					label: '스테이지 삭제',
					color: red,
					lines: { show: true, fill:false, lineWidth: 2 },
					points: { show: true, radius: 3, fillColor: '#fff' },
					shadowSize: 0
				}
			], 
			{
				xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: '#ddd' },
				yaxis: {  ticks: 10, tickColor: '#ddd', min: 0, max: 100 },
				grid: { 
					hoverable: true, 
					clickable: true,
					tickColor: "#ddd",
					borderWidth: 1,
					backgroundColor: '#fff',
					borderColor: '#ddd'
				},
				legend: {
					labelBoxBorderColor: '#ddd',
					margin: 10,
					noColumns: 1,
					show: true
				}
			}
		);
		var previousPoint = null;
		$("#interactive-chart").bind("plothover", function (event, pos, item) {
			$("#x").text(pos.x.toFixed(2));
			$("#y").text(pos.y.toFixed(2));
			if (item) {
				if (previousPoint !== item.dataIndex) {
					previousPoint = item.dataIndex;
					$("#tooltip").remove();
					var y = item.datapoint[1].toFixed(2);
					
					var content = item.series.label + " " + y;
					showTooltip(item.pageX, item.pageY, content);
				}
			} else {
				$("#tooltip").remove();
				previousPoint = null;			
			}
			event.preventDefault();
		});
	}

	if ($('#interactive-chart-member').length !== 0) {
	
		var data1 = [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate03);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate03[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate03[$iCnt]."]";
				}
			}
			?>
		];
		var data2 = [
			<?
			for ($iCnt=0;$iCnt<sizeof($arrDate04);$iCnt++) {
				$iCnt02=$iCnt+1;
				if ($iCnt==0) {
					echo "[".$iCnt02.",".$arrDate04[$iCnt]."]";
				} else {
					echo ",[".$iCnt02.",".$arrDate04[$iCnt]."]";
				}
			}
			?>
		];
		var xLabel = [
			[1,''],[2,''],[3,'<?=$arrDate[2]?>'],[4,''],[5,''],[6,'<?=$arrDate[5]?>'],[7,''],[8,''],[9,'<?=$arrDate[8]?>'],[10,''],
			[11,''],[12,'<?=$arrDate[11]?>'],[13,''],[14,''],[15,'<?=$arrDate[14]?>'],[16,''],[17,''],[18,'<?=$arrDate[17]?>'],[19,''],[20,'']
		];
		
		$.plot($("#interactive-chart-member"), [
				{
					data: data1, 
					label: "로그인 방문자", 
					color: blue,
					lines: { show: true, fill:false, lineWidth: 2 },
					points: { show: true, radius: 3, fillColor: '#fff' },
					shadowSize: 0
				}, {
					data: data2,
					label: 'IP 방문자',
					color: red,
					lines: { show: true, fill:false, lineWidth: 2 },
					points: { show: true, radius: 3, fillColor: '#fff' },
					shadowSize: 0
				}
			], 
			{
				xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: '#ddd' },
				yaxis: {  ticks: 10, tickColor: '#ddd', min: 0, max: 400 },
				grid: { 
					hoverable: true, 
					clickable: true,
					tickColor: "#ddd",
					borderWidth: 1,
					backgroundColor: '#fff',
					borderColor: '#ddd'
				},
				legend: {
					labelBoxBorderColor: '#ddd',
					margin: 10,
					noColumns: 1,
					show: true
				}
			}
		);
		var previousPoint = null;
		$("#interactive-chart-member").bind("plothover", function (event, pos, item) {
			$("#x").text(pos.x.toFixed(2));
			$("#y").text(pos.y.toFixed(2));
			if (item) {
				if (previousPoint !== item.dataIndex) {
					previousPoint = item.dataIndex;
					$("#tooltip").remove();
					var y = item.datapoint[1].toFixed(2);
					
					var content = item.series.label + " " + y;
					showTooltipMember(item.pageX, item.pageY, content);
				}
			} else {
				$("#tooltip").remove();
				previousPoint = null;
			}
			event.preventDefault();
		});
	}
};
</script>
<script>
$(document).ready(function() {
	App.init();
	Dashboard.init();
});
</script>