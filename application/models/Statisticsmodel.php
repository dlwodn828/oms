<?php
class Statisticsmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	//dayMemberStatistics
	function dayMemberStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));
		$arrData['arrDate']=array(date("m/d",strtotime($this->dEndDate02."-30 days")),date("m/d",strtotime($this->dEndDate02."-29 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-27 days")),date("m/d",strtotime($this->dEndDate02."-26 days")),date("m/d",strtotime($this->dEndDate02."-25 days")),date("m/d",strtotime($this->dEndDate02."-24 days")),date("m/d",strtotime($this->dEndDate02."-23 days")),date("m/d",strtotime($this->dEndDate02."-22 days")),date("m/d",strtotime($this->dEndDate02."-21 days")),date("m/d",strtotime($this->dEndDate02."-20 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-18 days")),date("m/d",strtotime($this->dEndDate02."-17 days")),date("m/d",strtotime($this->dEndDate02."-16 days")),date("m/d",strtotime($this->dEndDate02."-15 days")),date("m/d",strtotime($this->dEndDate02."-14 days")),date("m/d",strtotime($this->dEndDate02."-13 days")),date("m/d",strtotime($this->dEndDate02."-12 days")),date("m/d",strtotime($this->dEndDate02."-11 days")),date("m/d",strtotime($this->dEndDate02."-10 days")),date("m/d",strtotime($this->dEndDate02."-9 days")),date("m/d",strtotime($this->dEndDate02."-8 days")),date("m/d",strtotime($this->dEndDate02."-7 days")),date("m/d",strtotime($this->dEndDate02."-6 days")),date("m/d",strtotime($this->dEndDate02."-5 days")),date("m/d",strtotime($this->dEndDate02."-4 days")),date("m/d",strtotime($this->dEndDate02."-3 days")),date("m/d",strtotime($this->dEndDate02."-2 days")),date("m/d",strtotime($this->dEndDate02."-1 days")),date("m/d",strtotime($this->dEndDate02)));

		//일반회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_member where UserDelYn!='Y' and RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//플러스회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(tbl3.RegDate,10)) as iCnt,left(tbl3.RegDate,10) as RegDate from tbl_member_plus as tbl3 left join tbl_member as tbl4 on tbl3.ParentIdx=tbl4.Idx where tbl4.UserDelYn!='Y' and tbl3.RegDate >'".$this->dStartDate02." 00:00:00' group by left(tbl3.RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 

		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate02']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate02'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//나눔회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(NanumDate,10)) as iCnt,left(NanumDate,10) as RegDate from tbl_member where UserDelYn!='Y' and UserNanumYn='Y' and NanumDate >'".$this->dStartDate02." 00:00:00' group by left(NanumDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate03']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate03'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02,ifnull(tbl4.iCnt,0) as iCnt03,(select count(Idx) as iCnt from tbl_member where UserDelYn!='Y' and RegDate <= date_add(tbl1.NowDate,interval +1 day)) as iCnt04 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_member where UserDelYn!='Y' and RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate left join (select count(left(tbl5.RegDate,10)) as iCnt,left(tbl5.RegDate,10) as RegDate from tbl_member_plus as tbl5 left join tbl_member as tbl6 on tbl5.ParentIdx=tbl6.Idx where tbl6.UserDelYn!='Y' and tbl5.RegDate >'".$this->dStartDate01." 00:00:00' group by left(tbl5.RegDate,10)) as tbl3 on tbl1.NowDate=tbl3.RegDate left join (select count(left(tbl7.NanumDate,10)) as iCnt,left(tbl7.NanumDate,10) as RegDate from tbl_member as tbl7 where tbl7.UserDelYn!='Y' and tbl7.UserNanumYn='Y' and tbl7.NanumDate >'".$this->dStartDate01." 00:00:00' group by left(tbl7.NanumDate,10)) as tbl4 on tbl1.NowDate=tbl4.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_member where UserDelYn!='Y') as iCnt01,(select count(tbl1.Idx) as iCnt from tbl_member_plus as tbl1 left join tbl_member as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.UserDelYn!='Y') as iCnt02 ,(select count(tbl3.Idx) as iCnt from tbl_member as tbl3 where tbl3.UserDelYn!='Y' and tbl3.UserNanumYn='Y') as iCnt03 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//dayMemberStatisticsExcel
	function dayMemberStatisticsExcel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02,ifnull(tbl4.iCnt,0) as iCnt03,(select count(Idx) as iCnt from tbl_member where UserDelYn!='Y' and RegDate <= date_add(tbl1.NowDate,interval +1 day)) as iCnt04 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_member where UserDelYn!='Y' and RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate left join (select count(left(tbl5.RegDate,10)) as iCnt,left(tbl5.RegDate,10) as RegDate from tbl_member_plus as tbl5 left join tbl_member as tbl6 on tbl5.ParentIdx=tbl6.Idx where tbl6.UserDelYn!='Y' and tbl5.RegDate >'".$this->dStartDate01." 00:00:00' group by left(tbl5.RegDate,10)) as tbl3 on tbl1.NowDate=tbl3.RegDate left join (select count(left(tbl7.NanumDate,10)) as iCnt,left(tbl7.NanumDate,10) as RegDate from tbl_member as tbl7 where tbl7.UserDelYn!='Y' and tbl7.UserNanumYn='Y' and tbl7.NanumDate >'".$this->dStartDate01." 00:00:00' group by left(tbl7.NanumDate,10)) as tbl4 on tbl1.NowDate=tbl4.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_member where UserDelYn!='Y') as iCnt01,(select count(tbl1.Idx) as iCnt from tbl_member_plus as tbl1 left join tbl_member as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.UserDelYn!='Y') as iCnt02 ,(select count(tbl3.Idx) as iCnt from tbl_member as tbl3 where tbl3.UserDelYn!='Y' and tbl3.UserNanumYn='Y') as iCnt03 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('일별통계_회원');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '일반회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('C1', '플러스회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('D1', '나눔회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('E1', '전체회원');
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
			$arrCnt[2]=$arrCnt[2]+$row["iCnt03"];

			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["iCnt03"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["iCnt04"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
			$arrCnt[4]=$row["iCnt02"];
			$arrCnt[5]=$row["iCnt03"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,number_format($arrCnt[1]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,number_format($arrCnt[2]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,number_format(array_pop($arrData['arrDate04'])["iCnt04"]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 회원수",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrData['arrDate05']["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrData['arrDate05']["iCnt03"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="일별통계_회원";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//monthMemberStatistics
	function monthMemberStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		$arrData['arrDate']=array(date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-10,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-9,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-8,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-7,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-6,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-5,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-4,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-3,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-2,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-1,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",strtotime($this->dEndDate02)));

		//일반회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_member where UserDelYn!='Y' and RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//플러스회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(tbl3.RegDate,7)) as iCnt,left(tbl3.RegDate,7) as RegDate from tbl_member_plus as tbl3 left join tbl_member as tbl4 on tbl3.ParentIdx=tbl4.Idx where tbl4.UserDelYn!='Y' and tbl3.RegDate >'".$this->dStartDate02." 00:00:00' group by left(tbl3.RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate02']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate02'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//나눔회원
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(tbl3.NanumDate,7)) as iCnt,left(tbl3.NanumDate,7) as RegDate from tbl_member as tbl3 where tbl3.UserDelYn!='Y' and tbl3.UserNanumYn='Y' and tbl3.NanumDate >'".$this->dStartDate02." 00:00:00' group by left(tbl3.NanumDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate03']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate03'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02,ifnull(tbl4.iCnt,0) as iCnt03,(select count(Idx) as iCnt from tbl_member where UserDelYn!='Y' and left(RegDate,7) <= left(tbl1.NowDate,7)) as iCnt04 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_member where UserDelYn!='Y' and left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate left join (select count(left(tbl5.RegDate,7)) as iCnt,left(tbl5.RegDate,7) as RegDate from tbl_member_plus as tbl5 left join tbl_member as tbl6 on tbl5.ParentIdx=tbl6.Idx where tbl6.UserDelYn!='Y' and left(tbl5.RegDate,7) >='".$this->dStartDate01." ' group by left(tbl5.RegDate,7)) as tbl3 on left(tbl1.NowDate,7)=tbl3.RegDate left join (select count(left(tbl7.NanumDate,7)) as iCnt,left(tbl7.NanumDate,7) as RegDate from tbl_member as tbl7 where tbl7.UserDelYn!='Y' and tbl7.UserNanumYn='Y' and left(tbl7.NanumDate,7) >='".$this->dStartDate01." ' group by left(tbl7.NanumDate,7)) as tbl4 on left(tbl1.NowDate,7)=tbl4.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_member where UserDelYn!='Y') as iCnt01,(select count(tbl1.Idx) as iCnt from tbl_member_plus as tbl1 left join tbl_member as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.UserDelYn!='Y') as iCnt02 ,(select count(tbl3.Idx) as iCnt from tbl_member as tbl3 where tbl3.UserDelYn!='Y' and tbl3.UserNanumYn='Y') as iCnt03 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//monthMemberStatisticsExcel
	function monthMemberStatisticsExcel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));

		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02,ifnull(tbl4.iCnt,0) as iCnt03,(select count(Idx) as iCnt from tbl_member where UserDelYn!='Y' and left(RegDate,7) <= left(tbl1.NowDate,7)) as iCnt04 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_member where UserDelYn!='Y' and left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate left join (select count(left(tbl5.RegDate,7)) as iCnt,left(tbl5.RegDate,7) as RegDate from tbl_member_plus as tbl5 left join tbl_member as tbl6 on tbl5.ParentIdx=tbl6.Idx where tbl6.UserDelYn!='Y' and left(tbl5.RegDate,7) >='".$this->dStartDate01." ' group by left(tbl5.RegDate,7)) as tbl3 on left(tbl1.NowDate,7)=tbl3.RegDate left join (select count(left(tbl7.NanumDate,7)) as iCnt,left(tbl7.NanumDate,7) as RegDate from tbl_member as tbl7 where tbl7.UserDelYn!='Y' and tbl7.UserNanumYn='Y' and left(tbl7.NanumDate,7) >='".$this->dStartDate01." ' group by left(tbl7.NanumDate,7)) as tbl4 on left(tbl1.NowDate,7)=tbl4.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_member where UserDelYn!='Y') as iCnt01,(select count(tbl1.Idx) as iCnt from tbl_member_plus as tbl1 left join tbl_member as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.UserDelYn!='Y') as iCnt02 ,(select count(tbl3.Idx) as iCnt from tbl_member as tbl3 where tbl3.UserDelYn!='Y' and tbl3.UserNanumYn='Y') as iCnt03 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('월별통계_회원');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '일반회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('C1', '플러스회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('D1', '나눔회원 (증감)');
		$this->excel->getActiveSheet()->setCellValue('E1', '전체회원');
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
			$arrCnt[2]=$arrCnt[2]+$row["iCnt03"];

			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["iCnt03"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["iCnt04"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
			$arrCnt[4]=$row["iCnt02"];
			$arrCnt[5]=$row["iCnt03"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,number_format($arrCnt[1]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,number_format($arrCnt[2]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,number_format(array_pop($arrData['arrDate04'])["iCnt04"]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 회원수",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrData['arrDate05']["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrData['arrDate05']["iCnt03"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="월별통계_회원";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//dayStageStatistics
	function dayStageStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));
		$arrData['arrDate']=array(date("m/d",strtotime($this->dEndDate02."-30 days")),date("m/d",strtotime($this->dEndDate02."-29 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-27 days")),date("m/d",strtotime($this->dEndDate02."-26 days")),date("m/d",strtotime($this->dEndDate02."-25 days")),date("m/d",strtotime($this->dEndDate02."-24 days")),date("m/d",strtotime($this->dEndDate02."-23 days")),date("m/d",strtotime($this->dEndDate02."-22 days")),date("m/d",strtotime($this->dEndDate02."-21 days")),date("m/d",strtotime($this->dEndDate02."-20 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-18 days")),date("m/d",strtotime($this->dEndDate02."-17 days")),date("m/d",strtotime($this->dEndDate02."-16 days")),date("m/d",strtotime($this->dEndDate02."-15 days")),date("m/d",strtotime($this->dEndDate02."-14 days")),date("m/d",strtotime($this->dEndDate02."-13 days")),date("m/d",strtotime($this->dEndDate02."-12 days")),date("m/d",strtotime($this->dEndDate02."-11 days")),date("m/d",strtotime($this->dEndDate02."-10 days")),date("m/d",strtotime($this->dEndDate02."-9 days")),date("m/d",strtotime($this->dEndDate02."-8 days")),date("m/d",strtotime($this->dEndDate02."-7 days")),date("m/d",strtotime($this->dEndDate02."-6 days")),date("m/d",strtotime($this->dEndDate02."-5 days")),date("m/d",strtotime($this->dEndDate02."-4 days")),date("m/d",strtotime($this->dEndDate02."-3 days")),date("m/d",strtotime($this->dEndDate02."-2 days")),date("m/d",strtotime($this->dEndDate02."-1 days")),date("m/d",strtotime($this->dEndDate02)));

		//스테이지 개설
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//스테이지 참여
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage_apply where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 

		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate02']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate02'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//개설, 참여리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage_apply where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl3 on tbl1.NowDate=tbl3.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 개설,참여 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply ) as iCnt02 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//dayStageStatisticsExcel01
	function dayStageStatisticsExcel01() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//개설, 참여리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage_apply where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl3 on tbl1.NowDate=tbl3.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 개설,참여 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply ) as iCnt02 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('일별통계_스테이지개설');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 개설 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 개설회원 합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="일별통계_스테이지개설";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//dayStageStatisticsExcel02
	function dayStageStatisticsExcel02() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//개설, 참여리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage_apply where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl3 on tbl1.NowDate=tbl3.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 개설,참여 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply ) as iCnt02 "; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('일별통계_스테이지참여');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 참여 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt02"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[1]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 참여회원 합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="일별통계_스테이지참여";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//monthStageStatistics
	function monthStageStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		$arrData['arrDate']=array(date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-10,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-9,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-8,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-7,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-6,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-5,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-4,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-3,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-2,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-1,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",strtotime($this->dEndDate02)));

		//스테이지 개설
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		
		//스테이지 참여
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage_apply where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate02']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate02'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage_apply where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl3 on left(tbl1.NowDate,7)=tbl3.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply) as iCnt02"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//monthStageStatisticsExcel01
	function monthStageStatisticsExcel01() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage_apply where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl3 on left(tbl1.NowDate,7)=tbl3.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply) as iCnt02"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('월별통계_스테이지개설');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 개설 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 개설회원 합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="월별통계_스테이지개설";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//monthStageStatisticsExcel02
	function monthStageStatisticsExcel02() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01,ifnull(tbl3.iCnt,0) as iCnt02 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_stage_apply where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl3 on left(tbl1.NowDate,7)=tbl3.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_stage ) as iCnt01,(select count(Idx) as iCnt from tbl_stage_apply) as iCnt02"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('월별통계_스테이지참여설');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 참여 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[1]=$arrCnt[1]+$row["iCnt02"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[4]=$row["iCnt02"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[1]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 참여회원 합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt02"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="월별통계_스테이지참여";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//dayDonateStatistics
	function dayDonateStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));
		$arrData['arrDate']=array(date("m/d",strtotime($this->dEndDate02."-30 days")),date("m/d",strtotime($this->dEndDate02."-29 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-27 days")),date("m/d",strtotime($this->dEndDate02."-26 days")),date("m/d",strtotime($this->dEndDate02."-25 days")),date("m/d",strtotime($this->dEndDate02."-24 days")),date("m/d",strtotime($this->dEndDate02."-23 days")),date("m/d",strtotime($this->dEndDate02."-22 days")),date("m/d",strtotime($this->dEndDate02."-21 days")),date("m/d",strtotime($this->dEndDate02."-20 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-18 days")),date("m/d",strtotime($this->dEndDate02."-17 days")),date("m/d",strtotime($this->dEndDate02."-16 days")),date("m/d",strtotime($this->dEndDate02."-15 days")),date("m/d",strtotime($this->dEndDate02."-14 days")),date("m/d",strtotime($this->dEndDate02."-13 days")),date("m/d",strtotime($this->dEndDate02."-12 days")),date("m/d",strtotime($this->dEndDate02."-11 days")),date("m/d",strtotime($this->dEndDate02."-10 days")),date("m/d",strtotime($this->dEndDate02."-9 days")),date("m/d",strtotime($this->dEndDate02."-8 days")),date("m/d",strtotime($this->dEndDate02."-7 days")),date("m/d",strtotime($this->dEndDate02."-6 days")),date("m/d",strtotime($this->dEndDate02."-5 days")),date("m/d",strtotime($this->dEndDate02."-4 days")),date("m/d",strtotime($this->dEndDate02."-3 days")),date("m/d",strtotime($this->dEndDate02."-2 days")),date("m/d",strtotime($this->dEndDate02."-1 days")),date("m/d",strtotime($this->dEndDate02)));

		//나눔 회원수
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_donate_apply where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}

		//참여리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_donate_apply where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_donate_apply ) as iCnt01"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//dayDonateStatisticsExcel
	function dayDonateStatisticsExcel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//참여리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_donate_apply where RegDate >'".$this->dStartDate01." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_donate_apply ) as iCnt01"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('일별통계_나눔');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '나눔회원수 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 나눔 회원수",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="일별통계_나눔";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//monthDonateStatistics
	function monthDonateStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		$arrData['arrDate']=array(date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-10,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-9,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-8,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-7,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-6,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-5,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-4,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-3,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-2,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-1,1,date("Y",strtotime($this->dEndDate02)))),date("Y.m",strtotime($this->dEndDate02)));

		//나눔 회원수
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_donate_apply where RegDate >'".$this->dStartDate02." 00:00:00' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and left(tbl1.NowDate,7) <= '".$this->dEndDate02."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc ";
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_donate_apply where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_donate_apply) as iCnt01"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//monthDonateStatisticsExcel
	function monthDonateStatisticsExcel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m",mktime(0,0,0,date("m")-11,1,date("Y")));

		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m");
			$this->dEndDate02=date("Y-m");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m",mktime(0,0,0,date("m",strtotime($this->dEndDate02))-11,1,date("Y",strtotime($this->dEndDate02))));
		//리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,7)) as iCnt,left(RegDate,7) as RegDate from tbl_donate_apply where left(RegDate,7) >='".$this->dStartDate01." ' group by left(RegDate,7)) as tbl2 on left(tbl1.NowDate,7)=tbl2.RegDate where left(tbl1.NowDate,7) >='".$this->dStartDate01."' and left(tbl1.NowDate,7) <= '".$this->dEndDate01."' group by left(tbl1.NowDate,7) order by left(tbl1.NowDate,7) asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(Idx) as iCnt from tbl_donate_apply) as iCnt01"; 
		$arrData['arrDate05']=$this->db->query($this->sQuery)->row_array();
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('월별통계_나눔');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '나눔회원수 (증감)');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"현재까지 나눔 회원수",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrData['arrDate05']["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sFileName="월별통계_나눔";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//itemsStatistics5
	function itemsStatistics5() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//itemsStatistics5Excel
	function itemsStatistics5Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		
		$arrPaymentMoney01=array();
		$arrPaymentMoney02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$sAlphabet="B";
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('인원_5명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		for ($iCnt=1;$iCnt<20;$iCnt++) {
			$this->excel->getActiveSheet()->getColumnDimension($sAlphabet)->setWidth(10);
			$sAlphabet++;
		}
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$sAlphabet="B";
		for ($iCnt=1;$iCnt<20;$iCnt++) {
			$arrPaymentMoney01[$iCnt]= $iCnt*5*10;
			$this->excel->getActiveSheet()->setCellValue($sAlphabet.'1',$arrPaymentMoney01[$iCnt]);
			$sAlphabet++;
		}
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrData['arrDate04']);$iCnt02++) {
				if ($iCnt==$arrData['arrDate04'][$iCnt02]["StageRate"]) {
					$iCnt03=$arrData['arrDate04'][$iCnt02]["StageMoney"]/50;
					$arrPaymentMoney02[$iCnt][$iCnt03]=$arrData['arrDate04'][$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			for ($iCnt02=1;$iCnt02<20;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrPaymentMoney02[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
			}
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$sFileName="인원_5명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//itemsStatistics7
	function itemsStatistics7() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//itemsStatistics7Excel
	function itemsStatistics7Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		
		$arrPaymentMoney01=array();
		$arrPaymentMoney02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$sAlphabet="B";
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('인원_7명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		for ($iCnt=1;$iCnt<15;$iCnt++) {
			$this->excel->getActiveSheet()->getColumnDimension($sAlphabet)->setWidth(10);
			$sAlphabet++;
		}
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$sAlphabet="B";
		for ($iCnt=1;$iCnt<15;$iCnt++) {
			$arrPaymentMoney01[$iCnt]= $iCnt*7*10;
			$this->excel->getActiveSheet()->setCellValue($sAlphabet.'1',$arrPaymentMoney01[$iCnt]);
			$sAlphabet++;
		}
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrData['arrDate04']);$iCnt02++) {
				if ($iCnt==$arrData['arrDate04'][$iCnt02]["StageRate"]) {
					$iCnt03=$arrData['arrDate04'][$iCnt02]["StageMoney"]/70;
					$arrPaymentMoney02[$iCnt][$iCnt03]=$arrData['arrDate04'][$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			for ($iCnt02=1;$iCnt02<15;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrPaymentMoney02[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
			}
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$sFileName="인원_7명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//itemsStatistics9
	function itemsStatistics9() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//itemsStatistics9Excel
	function itemsStatistics9Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		
		$arrPaymentMoney01=array();
		$arrPaymentMoney02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$sAlphabet="B";
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('인원_9명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		for ($iCnt=1;$iCnt<12;$iCnt++) {
			$this->excel->getActiveSheet()->getColumnDimension($sAlphabet)->setWidth(10);
			$sAlphabet++;
		}
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$sAlphabet="B";
		for ($iCnt=1;$iCnt<12;$iCnt++) {
			$arrPaymentMoney01[$iCnt]= $iCnt*9*10;
			$this->excel->getActiveSheet()->setCellValue($sAlphabet.'1',$arrPaymentMoney01[$iCnt]);
			$sAlphabet++;
		}
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrData['arrDate04']);$iCnt02++) {
				if ($iCnt==$arrData['arrDate04'][$iCnt02]["StageRate"]) {
					$iCnt03=$arrData['arrDate04'][$iCnt02]["StageMoney"]/90;
					$arrPaymentMoney02[$iCnt][$iCnt03]=$arrData['arrDate04'][$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			for ($iCnt02=1;$iCnt02<12;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrPaymentMoney02[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
			}
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$sFileName="인원_9명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//itemsStatistics13
	function itemsStatistics13() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//itemsStatistics13Excel
	function itemsStatistics13Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));

		//참여리스트
		$this->sQuery="select tbl2.StageRate,(tbl2.StageMoney*tbl2.StageNum) as StageMoney,count(tbl2.StageMoney) as iCnt01 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl2.StageMoney order by tbl2.StageRate asc,tbl2.StageMoney asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		
		$arrPaymentMoney01=array();
		$arrPaymentMoney02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$sAlphabet="B";
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('인원_13명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		for ($iCnt=1;$iCnt<12;$iCnt++) {
			$this->excel->getActiveSheet()->getColumnDimension($sAlphabet)->setWidth(10);
			$sAlphabet++;
		}
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$sAlphabet="B";
		for ($iCnt=1;$iCnt<8;$iCnt++) {
			$arrPaymentMoney01[$iCnt]= $iCnt*13*10;
			$this->excel->getActiveSheet()->setCellValue($sAlphabet.'1',$arrPaymentMoney01[$iCnt]);
			$sAlphabet++;
		}
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:'.$sAlphabet.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrData['arrDate04']);$iCnt02++) {
				if ($iCnt==$arrData['arrDate04'][$iCnt02]["StageRate"]) {
					$iCnt03=$arrData['arrDate04'][$iCnt02]["StageMoney"]/130;
					$arrPaymentMoney02[$iCnt][$iCnt03]=$arrData['arrDate04'][$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			for ($iCnt02=1;$iCnt02<8;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrPaymentMoney02[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
			}
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$sFileName="인원_13명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//statusStatistics
	function statusStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sStageState=addslashes(trim($this->input->get('sStageState')));
		$this->sWhere="";
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		if ($this->sStageState!="") {
			$this->sWhere=$this->sWhere." and State='".$this->sStageState."'";
		}
		$this->dStartDate02=date("Y-m-d",strtotime($this->dEndDate02."-30 days"));
		$arrData['arrDate']=array(date("m/d",strtotime($this->dEndDate02."-30 days")),date("m/d",strtotime($this->dEndDate02."-29 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-27 days")),date("m/d",strtotime($this->dEndDate02."-26 days")),date("m/d",strtotime($this->dEndDate02."-25 days")),date("m/d",strtotime($this->dEndDate02."-24 days")),date("m/d",strtotime($this->dEndDate02."-23 days")),date("m/d",strtotime($this->dEndDate02."-22 days")),date("m/d",strtotime($this->dEndDate02."-21 days")),date("m/d",strtotime($this->dEndDate02."-20 days")),date("m/d",strtotime($this->dEndDate02."-19 days")),date("m/d",strtotime($this->dEndDate02."-18 days")),date("m/d",strtotime($this->dEndDate02."-17 days")),date("m/d",strtotime($this->dEndDate02."-16 days")),date("m/d",strtotime($this->dEndDate02."-15 days")),date("m/d",strtotime($this->dEndDate02."-14 days")),date("m/d",strtotime($this->dEndDate02."-13 days")),date("m/d",strtotime($this->dEndDate02."-12 days")),date("m/d",strtotime($this->dEndDate02."-11 days")),date("m/d",strtotime($this->dEndDate02."-10 days")),date("m/d",strtotime($this->dEndDate02."-9 days")),date("m/d",strtotime($this->dEndDate02."-8 days")),date("m/d",strtotime($this->dEndDate02."-7 days")),date("m/d",strtotime($this->dEndDate02."-6 days")),date("m/d",strtotime($this->dEndDate02."-5 days")),date("m/d",strtotime($this->dEndDate02."-4 days")),date("m/d",strtotime($this->dEndDate02."-3 days")),date("m/d",strtotime($this->dEndDate02."-2 days")),date("m/d",strtotime($this->dEndDate02."-1 days")),date("m/d",strtotime($this->dEndDate02)));

		//스테이지 상태별
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate02." 00:00:00' ".$this->sWhere." group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate02."' and tbl1.NowDate <= '".$this->dEndDate02."' order by tbl1.NowDate asc"; 
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		//스테이지 리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate01." 00:00:00' ".$this->sWhere." group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['sStageState']=$this->sStageState;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//statusStatisticsExcel
	function statusStatisticsExcel() {

		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sStageState=addslashes(trim($this->input->get('sStageState')));
		$this->sWhere="";
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		if ($this->sStageState!="") {
			$this->sWhere=$this->sWhere." and State='".$this->sStageState."'";
		}
		//스테이지 리스트
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%Y.%m.%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt01 from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->dStartDate01." 00:00:00' ".$this->sWhere." group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->dStartDate01."' and tbl1.NowDate <= '".$this->dEndDate01."' order by tbl1.NowDate asc"; 
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('상태별_스테이지통계');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '날짜');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 수');
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		$arrCnt=array(0,0,0,-1,-1,-1);
		foreach ($arrData['arrDate04'] as $row) {
			$arrCnt[0]=$arrCnt[0]+$row["iCnt01"];
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$row["NowDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["iCnt01"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
			$arrCnt[3]=$row["iCnt01"];
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,number_format($arrCnt[0]),PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':B'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$n++;
		$sFileName="상태별_스테이지통계";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	function waitingTurnStatistics() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//순번별 대기 리스트 -5인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate01']=$this->db->query($this->sQuery)->result_array();

		//순번별 대기 리스트 -7인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate02']=$this->db->query($this->sQuery)->result_array();

		//순번별 대기 리스트 -9인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate03']=$this->db->query($this->sQuery)->result_array();

		//순번별 대기 리스트 -13인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();

		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitingTurnStatisticsExcel01
	function waitingTurnStatisticsExcel01() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//순번별 대기 리스트 -5인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate01=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0));
		$arrCnt02=array_fill(0,50,array(0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0);
		$arrCnt04=array(0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,6,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('순번별_대기인원_5명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '비율');

		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate01);$iCnt02++) {
				if ($iCnt==$arrDate01[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate01[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt][$iCnt03]=$arrCnt02[$iCnt][$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt04[$iCnt03]=$arrCnt04[$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
				}
			}
		}
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalPercent=0;
			$arrTotalCnt02=array_fill(0,2,0);
			for ($iCnt02=1;$iCnt02<6;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$arrTotalCnt02[0]=$arrTotalCnt02[0]+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt02[1]=$arrTotalCnt02[1]+$arrCnt02[$iCnt][$iCnt02];
			}
			if ($arrTotalCnt02[1]!=0) {
				$iTotalPercent=($arrTotalCnt02[0]/$arrTotalCnt02[1])*100;
			} else {
				$iTotalPercent=0;
			}
			$iTotalPercent=fnRound02($iTotalPercent,3)."%";;
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalPercent,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt04[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=($arrCnt03[$iCnt03]/$arrCnt04[$iCnt03])*100;
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3)."%";
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"순번별 대기인원 비율(%)",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="순번별_대기인원_5명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//waitingTurnStatisticsExcel02
	function waitingTurnStatisticsExcel02() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate01=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0));
		$arrCnt02=array_fill(0,50,array(0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0);
		$arrCnt04=array(0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,8,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('순번별_대기인원_7명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '비율');

		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate01);$iCnt02++) {
				if ($iCnt==$arrDate01[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate01[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt][$iCnt03]=$arrCnt02[$iCnt][$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt04[$iCnt03]=$arrCnt04[$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
				}
			}
		}
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalPercent=0;
			$arrTotalCnt02=array_fill(0,2,0);
			for ($iCnt02=1;$iCnt02<8;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$arrTotalCnt02[0]=$arrTotalCnt02[0]+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt02[1]=$arrTotalCnt02[1]+$arrCnt02[$iCnt][$iCnt02];
			}
			if ($arrTotalCnt02[1]!=0) {
				$iTotalPercent=($arrTotalCnt02[0]/$arrTotalCnt02[1])*100;
			} else {
				$iTotalPercent=0;
			}
			$iTotalPercent=fnRound02($iTotalPercent,3)."%";;
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalPercent,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt04[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=($arrCnt03[$iCnt03]/$arrCnt04[$iCnt03])*100;
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3)."%";
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"순번별 대기인원 비율(%)",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="순번별_대기인원_7명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}

	//waitingTurnStatisticsExcel03
	function waitingTurnStatisticsExcel03() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//순번별 대기 리스트 -9인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate01=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0));
		$arrCnt02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0);
		$arrCnt04=array(0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,10,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('순번별_대기인원_9명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '비율');

		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate01);$iCnt02++) {
				if ($iCnt==$arrDate01[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate01[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt][$iCnt03]=$arrCnt02[$iCnt][$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt04[$iCnt03]=$arrCnt04[$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
				}
			}
		}
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalPercent=0;
			$arrTotalCnt02=array_fill(0,2,0);
			for ($iCnt02=1;$iCnt02<10;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$arrTotalCnt02[0]=$arrTotalCnt02[0]+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt02[1]=$arrTotalCnt02[1]+$arrCnt02[$iCnt][$iCnt02];
			}
			if ($arrTotalCnt02[1]!=0) {
				$iTotalPercent=($arrTotalCnt02[0]/$arrTotalCnt02[1])*100;
			} else {
				$iTotalPercent=0;
			}
			$iTotalPercent=fnRound02($iTotalPercent,3)."%";;
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalPercent,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt04[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=($arrCnt03[$iCnt03]/$arrCnt04[$iCnt03])*100;
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3)."%";
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"순번별 대기인원 비율(%)",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="순번별_대기인원_9명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}

	//waitingTurnStatisticsExcel04
	function waitingTurnStatisticsExcel04() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//순번별 대기 리스트 -13인
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,sum(if(isnull(tbl3.RegDate),1,0)) as iCnt01,count(tbl1.TurnNo) as iCnt02 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate01=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$arrCnt02=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$arrCnt04=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,14,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('순번별_대기인원_13명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);


		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '10번');
		$this->excel->getActiveSheet()->setCellValue('L1', '11번');
		$this->excel->getActiveSheet()->setCellValue('M1', '12번');
		$this->excel->getActiveSheet()->setCellValue('N1', '13번');
		$this->excel->getActiveSheet()->setCellValue('O1', '비율');

		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate01);$iCnt02++) {
				if ($iCnt==$arrDate01[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate01[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt][$iCnt03]=$arrCnt02[$iCnt][$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate01[$iCnt02]["iCnt01"];
					$arrCnt04[$iCnt03]=$arrCnt04[$iCnt03]+$arrDate01[$iCnt02]["iCnt02"];
				}
			}
		}
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalPercent=0;
			$arrTotalCnt02=array_fill(0,2,0);
			for ($iCnt02=1;$iCnt02<14;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$arrTotalCnt02[0]=$arrTotalCnt02[0]+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt02[1]=$arrTotalCnt02[1]+$arrCnt02[$iCnt][$iCnt02];
			}
			if ($arrTotalCnt02[1]!=0) {
				$iTotalPercent=($arrTotalCnt02[0]/$arrTotalCnt02[1])*100;
			} else {
				$iTotalPercent=0;
			}
			$iTotalPercent=fnRound02($iTotalPercent,3)."%";;
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalPercent,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt04[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=($arrCnt03[$iCnt03]/$arrCnt04[$iCnt03])*100;
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3)."%";
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"순번별 대기인원 비율(%)",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$arrTotalCnt[10],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$arrTotalCnt[11],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$arrTotalCnt[12],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$arrTotalCnt[13],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="순번별_대기인원_13명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//distributionStatistics
	function distributionStatistics() {
		//회원등급
		$this->sQuery="select (select count(Idx) as iCnt01 from tbl_member where UserGrade='1' and UserDelYn!='Y') as iCnt01,(select count(Idx) as iCnt01 from tbl_member where UserGrade='3' and UserDelYn!='Y') as iCnt02,(select count(Idx) as iCnt01 from tbl_member where UserDelYn!='Y') as iCnt03"; 
		$arrData['arrResult01']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 성별통계
		$this->sQuery="select (select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserGender='W') as iCnt01,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserGender='M') as iCnt02,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3') as iCnt03"; 
		$arrData['arrResult02']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 연령통계
		$dNowYear=date("Y")+1;
		$this->sQuery="select (select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='2') as iCnt01,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='3') as iCnt02,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='4') as iCnt03,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='5') as iCnt04,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='6') as iCnt05,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='7') as iCnt06,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)>='8') as iCnt07,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3') as iCnt08"; 
		$arrData['arrResult03']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 지역통계
		$this->sQuery="select (select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '서울%') as iCnt01,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '부산%') as iCnt02,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '대구%') as iCnt03,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '인천%') as iCnt04,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '광주%') as iCnt05,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '대전%') as iCnt06,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '울산%') as iCnt07,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '세종%') as iCnt08,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '경기%') as iCnt09,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '강원%') as iCnt10,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '충북%') as iCnt11,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '충남%') as iCnt12,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '전북%') as iCnt13,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '전남%') as iCnt14,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '경북%') as iCnt15,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '경남%') as iCnt16,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3' and UserAddress01 like '제주%') as iCnt17,(select count(Idx) as iCnt01 from cms_memberList where UserGrade='3') as iCnt18"; 
		$arrData['arrResult04']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 결혼여부
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='결혼유무' and RegistValue='미혼') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='결혼유무' and RegistValue='기혼') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='결혼유무') as iCnt03";
		$arrData['arrResult05']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 자녀유무
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자녀유무' and RegistValue='자녀있음') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자녀유무' and RegistValue='자녀없음') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자녀유무') as iCnt03";
		$arrData['arrResult06']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 직업
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='공무원') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='직장인') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='자영업') as iCnt03,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='프리랜서') as iCnt04,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='주부') as iCnt05,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='학생') as iCnt06,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업' and RegistValue='무직') as iCnt07,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='직업') as iCnt08";
		$arrData['arrResult07']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 자녀유무
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수' and RegistValue='1년이하') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수' and RegistValue='1 ~ 2년') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수' and RegistValue='3 ~ 4년') as iCnt03,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수' and RegistValue='5 ~ 7년') as iCnt04,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수' and RegistValue='7년 이상') as iCnt05,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='근속년수') as iCnt06";
		$arrData['arrResult08']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 주택 보유
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택 보유' and RegistValue='보유') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택 보유' and RegistValue='미보유') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택 보유') as iCnt03";
		$arrData['arrResult09']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 자동차 보유
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자동차 보유' and RegistValue='보유') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자동차 보유' and RegistValue='미보유') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='자동차 보유') as iCnt03";
		$arrData['arrResult10']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 주택형태
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태' and RegistValue='자가아파트') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태' and RegistValue='자가주택') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태' and RegistValue='전세아파트') as iCnt03,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태' and RegistValue='전세주택') as iCnt04,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태' and RegistValue='월세') as iCnt05,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='주택형태') as iCnt06";
		$arrData['arrResult11']= $this->db->query($this->sQuery)->row_array();

		//플러스회원 주택형태
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='인터넷검색') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='언론기사') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='인터넷광고') as iCnt03,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='지인추천') as iCnt04,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='블로그') as iCnt05,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로' and RegistValue='SNS') as iCnt06,(select count(tbl1.Idx) as iCnt01 from tbl_member_regist_item as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl2.UserDelYn!='Y' and tbl1.RegistItem='아임인을 알게된 경로') as iCnt07";
		$arrData['arrResult12']= $this->db->query($this->sQuery)->row_array();
		return $arrData;
	}
	//icssMemberStatistics
	function icssMemberStatistics() {
		//ICSS 등급 성별
		$this->sQuery="select tbl1.ICSS,(select count(Idx) from cms_memberList where UserGrade='3' and UserGender='W' and ICSSGrade=tbl1.ICSS) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and UserGender='M' and ICSSGrade=tbl1.ICSS) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and ICSSGrade=tbl1.ICSS) as iCnt03 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult01']= $this->db->query($this->sQuery)->result_array();

		//ICSS 등급 성별 토탈 카운트
		$this->sQuery="select (select count(Idx) from cms_memberList where UserGrade='3' and UserGender='W') as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and UserGender='M') as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3') as iCnt03 "; 
		$arrData['arrResult02']=$this->db->query($this->sQuery)->row_array();
		
		//ICSS 등급 연령별
		$dNowYear=date("Y")+1;
		$this->sQuery="select tbl1.ICSS,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='2' and ICSSGrade=tbl1.ICSS) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='3' and ICSSGrade=tbl1.ICSS) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='4' and ICSSGrade=tbl1.ICSS) as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='5' and ICSSGrade=tbl1.ICSS) as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='6' and ICSSGrade=tbl1.ICSS) as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='7' and ICSSGrade=tbl1.ICSS) as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)>='8' and ICSSGrade=tbl1.ICSS) as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3' and ICSSGrade=tbl1.ICSS) as iCnt08 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult03']= $this->db->query($this->sQuery)->result_array();

		//ICSS 등급 연령별 토탈 카운트
		$this->sQuery="select tbl1.ICSS,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='2') as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='3') as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='4') as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='5') as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='6') as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='7') as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)>='8') as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3') as iCnt08  from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult04']=$this->db->query($this->sQuery)->row_array();

		//ICSS 등급 지역별
		$this->sQuery="select tbl1.ICSS,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '서울%' and ICSSGrade=tbl1.ICSS) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '부산%' and ICSSGrade=tbl1.ICSS) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대구%' and ICSSGrade=tbl1.ICSS) as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '인천%' and ICSSGrade=tbl1.ICSS) as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '광주%' and ICSSGrade=tbl1.ICSS) as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대전%' and ICSSGrade=tbl1.ICSS) as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '울산%' and ICSSGrade=tbl1.ICSS) as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '세종%' and ICSSGrade=tbl1.ICSS) as iCnt08,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경기%' and ICSSGrade=tbl1.ICSS) as iCnt09,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '강원%' and ICSSGrade=tbl1.ICSS) as iCnt10,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충북%' and ICSSGrade=tbl1.ICSS) as iCnt11,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충남%' and ICSSGrade=tbl1.ICSS) as iCnt12,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전북%' and ICSSGrade=tbl1.ICSS) as iCnt13,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전남%' and ICSSGrade=tbl1.ICSS) as iCnt14,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경북%' and ICSSGrade=tbl1.ICSS) as iCnt15,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경남%' and ICSSGrade=tbl1.ICSS) as iCnt16,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '제주%' and ICSSGrade=tbl1.ICSS) as iCnt17,(select count(Idx) from cms_memberList where UserGrade='3' and ICSSGrade=tbl1.ICSS) as iCnt18 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult05']= $this->db->query($this->sQuery)->result_array();

		//ICSS 등급 지역별 토탈 카운트
		$this->sQuery="select tbl1.ICSS,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '서울%' ) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '부산%' ) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대구%' ) as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '인천%' ) as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '광주%' ) as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대전%' ) as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '울산%' ) as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '세종%' ) as iCnt08,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경기%' ) as iCnt09,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '강원%' ) as iCnt10,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충북%' ) as iCnt11,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충남%' ) as iCnt12,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전북%' ) as iCnt13,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전남%' ) as iCnt14,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경북%' ) as iCnt15,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경남%' ) as iCnt16,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '제주%' ) as iCnt17,(select count(Idx) from cms_memberList where UserGrade='3') as iCnt18 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult06']= $this->db->query($this->sQuery)->row_array();
		return $arrData;
	}
	//icssStageStatistics
	function icssStageStatistics() {
		//스테이지 인원
		$this->sQuery="select tbl1.ICSS,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='5' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='7' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='9' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='13' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl3.ICSSGrade=tbl1.ICSS) as iCnt05 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult01']= $this->db->query($this->sQuery)->result_array();

		//스테이지 인원 토탈 카운트
		$this->sQuery="select (select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='5') as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='7') as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='9') as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageNum='13') as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx) as iCnt05 "; 
		$arrData['arrResult02']=$this->db->query($this->sQuery)->row_array();
		
		//스테이지 이율
		$this->sQuery="select tbl1.ICSS,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='7' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='8' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='9' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='10' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='11' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt05,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='12' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt06,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='13' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt07,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='14' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt08,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='15' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt09,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='16' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt10,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='17' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt11,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='18' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt12,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='19' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt13,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='20' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt14,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl3.ICSSGrade=tbl1.ICSS) as iCnt15 from tbl_ICSS_score as tbl1"; 
		$arrData['arrResult03']= $this->db->query($this->sQuery)->result_array();

		//스테이지 이율 토탈 카운트
		$this->sQuery="select (select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='7' ) as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='8' ) as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='9' ) as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='10' ) as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='11' ) as iCnt05,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='12' ) as iCnt06,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='13' ) as iCnt07,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='14' ) as iCnt08,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='15' ) as iCnt09,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='16' ) as iCnt10,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='17' ) as iCnt11,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='18' ) as iCnt12,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='19' ) as iCnt13,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx where tbl4.StageRate='20' ) as iCnt14,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx left join tbl_stage as tbl4 on tbl2.ParentIdx=tbl4.Idx) as iCnt15 "; 
		$arrData['arrResult04']= $this->db->query($this->sQuery)->row_array();


		//스테이지 지역별
		$this->sQuery="select tbl1.ICSS,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '서울%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '부산%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '대구%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '인천%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '광주%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt05,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '대전%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt06,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '울산%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt07,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '세종%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt08,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경기%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt09,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '강원%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt10,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '충북%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt11,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '충남%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt12,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '전북%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt13,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '전남%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt14,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경북%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt15,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경남%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt16,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '제주%' and tbl3.ICSSGrade=tbl1.ICSS) as iCnt17,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.ICSSGrade=tbl1.ICSS) as iCnt18 from tbl_ICSS_score as tbl1";
		$arrData['arrResult05']= $this->db->query($this->sQuery)->result_array();

		//스테이지 지역별 토탈 카운트
		$this->sQuery="select (select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '서울%' ) as iCnt01,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '부산%' ) as iCnt02,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '대구%' ) as iCnt03,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '인천%' ) as iCnt04,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '광주%' ) as iCnt05,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '대전%' ) as iCnt06,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '울산%' ) as iCnt07,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '세종%' ) as iCnt08,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경기%' ) as iCnt09,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '강원%' ) as iCnt10,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '충북%' ) as iCnt11,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '충남%' ) as iCnt12,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '전북%' ) as iCnt13,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '전남%' ) as iCnt14,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경북%' ) as iCnt15,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '경남%' ) as iCnt16,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx where tbl3.UserAddress01 like '제주%' ) as iCnt17,(select count(tbl2.Idx) from tbl_stage_apply as tbl2 left join cms_memberList as tbl3 on tbl2.UserIdx=tbl3.Idx) as iCnt18";
		$arrData['arrResult06']= $this->db->query($this->sQuery)->row_array();
		return $arrData;
	}
	//categoryMemberStatistics
	function categoryMemberStatistics() {
		//관심카테고리 등급별
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName,(select count(Idx) from cms_memberList where UserGrade='1' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt02,(select count(Idx) from cms_memberList where concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt03 from tbl_category as tbl1";
		$arrData['arrResult01']= $this->db->query($this->sQuery)->result_array();

		//관심카테고리 등급별 토탈 카운트
		$arrData['arrResult02']["iCnt01"]=0;
		$arrData['arrResult02']["iCnt02"]=0;
		$arrData['arrResult02']["iCnt03"]=0;
		foreach ($arrData['arrResult01'] as $row) { 
			$arrData['arrResult02']["iCnt01"]=$arrData['arrResult02']["iCnt01"]+$row["iCnt01"];
			$arrData['arrResult02']["iCnt02"]=$arrData['arrResult02']["iCnt02"]+$row["iCnt02"];
			$arrData['arrResult02']["iCnt03"]=$arrData['arrResult02']["iCnt03"]+$row["iCnt03"];
		}

		//관심카테고리 성별
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName,(select count(Idx) from cms_memberList where UserGender='W' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt01,(select count(Idx) from cms_memberList where UserGender='M' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt02,(select count(Idx) from cms_memberList where UserGender!='' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt03 from tbl_category as tbl1";
		$arrData['arrResult03']= $this->db->query($this->sQuery)->result_array();

		//관심카테고리 성별 토탈 카운트
		$arrData['arrResult04']["iCnt01"]=0;
		$arrData['arrResult04']["iCnt02"]=0;
		$arrData['arrResult04']["iCnt03"]=0;
		foreach ($arrData['arrResult03'] as $row) { 
			$arrData['arrResult04']["iCnt01"]=$arrData['arrResult04']["iCnt01"]+$row["iCnt01"];
			$arrData['arrResult04']["iCnt02"]=$arrData['arrResult04']["iCnt02"]+$row["iCnt02"];
			$arrData['arrResult04']["iCnt03"]=$arrData['arrResult04']["iCnt03"]+$row["iCnt03"];
		}

		//관심카테고리 연령별
		$dNowYear=date("Y")+1;
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='2' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='3' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='4' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='5' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='6' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)='7' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and floor((".$dNowYear."-UserYear)/10)>='8' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt08 from tbl_category as tbl1";
		$arrData['arrResult05']= $this->db->query($this->sQuery)->result_array();
		
		//관심카테고리 연령별 토탈 카운트
		$arrData['arrResult06']=array("iCnt01"=>0,"iCnt02"=>0,"iCnt03"=>0,"iCnt04"=>0,"iCnt05"=>0,"iCnt06"=>0,"iCnt07"=>0,"iCnt08"=>0);
		foreach ($arrData['arrResult05'] as $row) { 
			$arrData['arrResult06']["iCnt01"]=$arrData['arrResult06']["iCnt01"]+$row["iCnt01"];
			$arrData['arrResult06']["iCnt02"]=$arrData['arrResult06']["iCnt02"]+$row["iCnt02"];
			$arrData['arrResult06']["iCnt03"]=$arrData['arrResult06']["iCnt03"]+$row["iCnt03"];
			$arrData['arrResult06']["iCnt04"]=$arrData['arrResult06']["iCnt04"]+$row["iCnt04"];
			$arrData['arrResult06']["iCnt05"]=$arrData['arrResult06']["iCnt05"]+$row["iCnt05"];
			$arrData['arrResult06']["iCnt06"]=$arrData['arrResult06']["iCnt06"]+$row["iCnt06"];
			$arrData['arrResult06']["iCnt07"]=$arrData['arrResult06']["iCnt07"]+$row["iCnt07"];
			$arrData['arrResult06']["iCnt08"]=$arrData['arrResult06']["iCnt08"]+$row["iCnt08"];
		}

		//관심카테고리 지역별
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '서울%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt01,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '부산%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt02,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대구%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt03,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '인천%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt04,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '광주%' and concat('||',UserCategory) like concat(concat('주||',tbl1.Idx),'||%')) as iCnt05,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '대전%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt06,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '울산%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt07,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '세종%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt08,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경기%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt09,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '강원%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt10,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충북%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt11,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '충남%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt12,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전북%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt13,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '전남%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt14,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경북%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt15,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '경남%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt16,(select count(Idx) from cms_memberList where UserGrade='3' and UserAddress01 like '제주%' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt17,(select count(Idx) from cms_memberList where UserGrade='3' and concat('||',UserCategory) like concat(concat('%||',tbl1.Idx),'||%')) as iCnt18 from tbl_category as tbl1";
		$arrData['arrResult07']= $this->db->query($this->sQuery)->result_array();

		//관심카테고리 지역별 토탈 카운트
		$arrData['arrResult08']=array("iCnt01"=>0,"iCnt02"=>0,"iCnt03"=>0,"iCnt04"=>0,"iCnt05"=>0,"iCnt06"=>0,"iCnt07"=>0,"iCnt08"=>0,"iCnt09"=>0,"iCnt10"=>0,"iCnt11"=>0,"iCnt12"=>0,"iCnt13"=>0,"iCnt14"=>0,"iCnt15"=>0,"iCnt16"=>0,"iCnt17"=>0,"iCnt18"=>0);
		foreach ($arrData['arrResult07'] as $row) {
			$arrData['arrResult08']["iCnt01"]=$arrData['arrResult08']["iCnt01"]+$row["iCnt01"];
			$arrData['arrResult08']["iCnt02"]=$arrData['arrResult08']["iCnt02"]+$row["iCnt02"];
			$arrData['arrResult08']["iCnt03"]=$arrData['arrResult08']["iCnt03"]+$row["iCnt03"];
			$arrData['arrResult08']["iCnt04"]=$arrData['arrResult08']["iCnt04"]+$row["iCnt04"];
			$arrData['arrResult08']["iCnt05"]=$arrData['arrResult08']["iCnt05"]+$row["iCnt05"];
			$arrData['arrResult08']["iCnt06"]=$arrData['arrResult08']["iCnt06"]+$row["iCnt06"];
			$arrData['arrResult08']["iCnt07"]=$arrData['arrResult08']["iCnt07"]+$row["iCnt07"];
			$arrData['arrResult08']["iCnt08"]=$arrData['arrResult08']["iCnt08"]+$row["iCnt08"];
			$arrData['arrResult08']["iCnt09"]=$arrData['arrResult08']["iCnt09"]+$row["iCnt09"];
			$arrData['arrResult08']["iCnt10"]=$arrData['arrResult08']["iCnt10"]+$row["iCnt10"];
			$arrData['arrResult08']["iCnt11"]=$arrData['arrResult08']["iCnt11"]+$row["iCnt11"];
			$arrData['arrResult08']["iCnt12"]=$arrData['arrResult08']["iCnt12"]+$row["iCnt12"];
			$arrData['arrResult08']["iCnt13"]=$arrData['arrResult08']["iCnt13"]+$row["iCnt13"];
			$arrData['arrResult08']["iCnt14"]=$arrData['arrResult08']["iCnt14"]+$row["iCnt14"];
			$arrData['arrResult08']["iCnt15"]=$arrData['arrResult08']["iCnt15"]+$row["iCnt15"];
			$arrData['arrResult08']["iCnt16"]=$arrData['arrResult08']["iCnt16"]+$row["iCnt16"];
			$arrData['arrResult08']["iCnt17"]=$arrData['arrResult08']["iCnt17"]+$row["iCnt17"];
			$arrData['arrResult08']["iCnt18"]=$arrData['arrResult08']["iCnt18"]+$row["iCnt18"];
		}
		return $arrData;
	}
	//overdueMemberStatistics
	function overdueMemberStatistics() {
		//연체률
		//$this->sQuery="select ifnull(sum(DepositMoney),0) as OverDueMoney from tbl_stage_deposit where DepositState in ('N','H') and (DATEDIFF(now(),DefaultDepositDate)>30 and DATEDIFF(now(),DefaultDepositDate)<91)"; 
		$this->sQuery="select (select ifnull(sum(DefaultMoney),0) from tbl_stage_deposit where DepositState!='A') as TotalScheduledDepositMoney01,(select ifnull(sum(ScheduledDepositMoney),0) from tbl_stage_deposit where DepositState in ('N','H') ) as TotalScheduledDepositMoney02,(select ifnull(sum(DepositMoney),0) from tbl_stage_deposit where DepositState in ('Y','N','H')) as TotalDepositMoney,(select ifnull(sum(ControlDepositMoney),0) from tbl_stage_deposit where DepositState in ('N','H')) as TotalControlDepositMoney01,(select ifnull(sum(ControlDepositMoney),0) from tbl_stage_deposit ) as TotalControlDepositMoney02";
		$arrData['arrResult01']= $this->db->query($this->sQuery)->row_array();

		//인원별 연체률
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('N','H') and tbl2.StageNum='5') as iCnt01,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('Y','N','H') and tbl2.StageNum='5') as iCnt02,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('N','H') and tbl2.StageNum='7') as iCnt03,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('Y','N','H') and tbl2.StageNum='7') as iCnt04,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('N','H') and tbl2.StageNum='9') as iCnt05,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('Y','N','H') and tbl2.StageNum='9') as iCnt06,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('N','H') and tbl2.StageNum='13') as iCnt07,(select count(tbl1.Idx) as iCnt01 from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.DepositState in ('Y','N','H') and tbl2.StageNum='13') as iCnt08";
		$arrData['arrResult02']= $this->db->query($this->sQuery)->row_array();
		return $arrData;
	}
	//manageMoneyStatistics
	function manageMoneyStatistics() {
		//총 운영금액
		$this->sQuery="select (select ifnull(sum(tbl1.DefaultMoney),0) from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.State in ('S','C','L','W')) as iCnt01,(select ifnull(sum(tbl1.DefaultMoney),0) from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.State in ('E')) as iCnt02,(select sum(DefaultMoney) from tbl_stage_deposit) as iCnt03";
		$arrData['arrResult01']= $this->db->query($this->sQuery)->row_array();

		//진행중 금액
		$this->sQuery="select (select ifnull(sum(tbl1.DefaultMoney),0) from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.State in ('S','C','L','W') and tbl1.DepositState in ('Y','N','H')) as iCnt01,(select ifnull(sum(tbl1.DefaultMoney),0) from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.State in ('S','C','L','W') and tbl1.DepositState in ('A')) as iCnt02,(select ifnull(sum(tbl1.DefaultMoney),0) from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl2.State in ('S','C','L','W') ) as iCnt03";
		$arrData['arrResult02']= $this->db->query($this->sQuery)->row_array();
		return $arrData;
	}
	//overdueTermStatistics5
	function overdueTermStatistics5() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$arrData['iTotalCnt02']=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//overdueTermStatistics5Excel
	function overdueTermStatistics5Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$iTotalCnt02=$this->db->query($this->sQuery)->row_array()["iCnt01"];

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,6,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('연체_순번별_5명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<6;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="연체_순번별_5명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//overdueTermStatistics7
	function overdueTermStatistics7() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$arrData['iTotalCnt02']=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//overdueTermStatistics7Excel
	function overdueTermStatistics7Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$iTotalCnt02=$this->db->query($this->sQuery)->row_array()["iCnt01"];

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,8,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('연체_순번별_7명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<8;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="연체_순번별_7명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//overdueTermStatistics9
	function overdueTermStatistics9() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$arrData['iTotalCnt02']=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//overdueTermStatistics9Excel
	function overdueTermStatistics9Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$iTotalCnt02=$this->db->query($this->sQuery)->row_array()["iCnt01"];

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,10,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('연체_순번별_9명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<10;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="연체_순번별_9명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//overdueTermStatistics13
	function overdueTermStatistics13() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$arrData['iTotalCnt02']=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//overdueTermStatistics13Excel
	function overdueTermStatistics13Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//연체 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.MyTurn,count(tbl1.MyTurn) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.MyTurn order by tbl2.StageRate asc,tbl1.MyTurn asc  ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();
		//토탈 카운트
		$this->sQuery="select (select count(tbl1.Idx) as iCnt01 from tbl_stage_overdue as tbl1 left join tbl_stage as tbl2 on tbl1.StageCode=tbl2.StageCode where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' ) as iCnt01 "; 
		$iTotalCnt02=$this->db->query($this->sQuery)->row_array()["iCnt01"];

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,14,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('연체_순번별_13명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '10번');
		$this->excel->getActiveSheet()->setCellValue('L1', '11번');
		$this->excel->getActiveSheet()->setCellValue('M1', '12번');
		$this->excel->getActiveSheet()->setCellValue('N1', '13번');
		$this->excel->getActiveSheet()->setCellValue('O1', '소계');
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
				}
			}
		}
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<14;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$arrTotalCnt[10],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$arrTotalCnt[11],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$arrTotalCnt[12],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$arrTotalCnt[13],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="연체_순번별_13명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}

	//waitTermStatistics5
	function waitTermStatistics5() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitTermStatistics5Excel
	function waitTermStatistics5Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='5' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0));
		$arrCnt02=array(0,0,0,0,0,0);
		$arrCnt03=array(0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,6,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('대기_순번별_평균_대기일_5명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt03]=$arrCnt02[$iCnt03]+$arrDate04[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate04[$iCnt02]["iCnt03"];
				}
			}
		}
		for ($iCnt=11;$iCnt<24;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<6;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$iTotalCnt=$iTotalCnt/5;
			$iTotalCnt=fnRound02($iTotalCnt,3);
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt03[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=$arrCnt02[$iCnt03]/$arrCnt03[$iCnt03];
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3);
		}
		$iTotalCnt02=($arrTotalCnt[1]+$arrTotalCnt[2]+$arrTotalCnt[3]+$arrTotalCnt[4]+$arrTotalCnt[5])/5;
		$iTotalCnt02=fnRound02($iTotalCnt02,3);
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':G'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="대기_순번별_평균_대기일_5명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//waitTermStatistics7
	function waitTermStatistics7() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitTermStatistics7Excel
	function waitTermStatistics7Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='7' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0));
		$arrCnt02=array(0,0,0,0,0,0,0,0);
		$arrCnt03=array(0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,8,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('대기_순번별_평균_대기일_7명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
					$iTotalCnt02=$iTotalCnt02+$arrDate04[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt03]=$arrCnt02[$iCnt03]+$arrDate04[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate04[$iCnt02]["iCnt03"];
				}
			}
		}
		for ($iCnt=9;$iCnt<22;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<8;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$iTotalCnt=$iTotalCnt/7;
			$iTotalCnt=fnRound02($iTotalCnt,3);
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt03[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=$arrCnt02[$iCnt03]/$arrCnt03[$iCnt03];
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3);
		}
		$iTotalCnt02=($arrTotalCnt[1]+$arrTotalCnt[2]+$arrTotalCnt[3]+$arrTotalCnt[4]+$arrTotalCnt[5]+$arrTotalCnt[6]+$arrTotalCnt[7])/7;
		$iTotalCnt02=fnRound02($iTotalCnt02,3);
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="대기_순번별_평균_대기일_7명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}

	//waitTermStatistics9
	function waitTermStatistics9() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitTermStatistics9Excel
	function waitTermStatistics9Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='9' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0));
		$arrCnt02=array(0,0,0,0,0,0,0,0,0,0);
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,10,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('대기_순번별_평균_대기일_9명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt03]=$arrCnt02[$iCnt03]+$arrDate04[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate04[$iCnt02]["iCnt03"];
				}
			}
		}
		for ($iCnt=8;$iCnt<21;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<10;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$iTotalCnt=$iTotalCnt/9;
			$iTotalCnt=fnRound02($iTotalCnt,3);
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt03[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=$arrCnt02[$iCnt03]/$arrCnt03[$iCnt03];
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3);
		}
		$iTotalCnt02=($arrTotalCnt[1]+$arrTotalCnt[2]+$arrTotalCnt[3]+$arrTotalCnt[4]+$arrTotalCnt[5]+$arrTotalCnt[6]+$arrTotalCnt[7]+$arrTotalCnt[8]+$arrTotalCnt[9])/9;
		$iTotalCnt02=fnRound02($iTotalCnt02,3);
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':K'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="대기_순번별_평균_대기일_9명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}

	//waitTermStatistics13
	function waitTermStatistics13() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrData['arrDate04']=$this->db->query($this->sQuery)->result_array();
		$arrData['dStartDate']=$this->dStartDate01;
		$arrData['dEndDate']=$this->dEndDate01;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitTermStatistics13Excel
	function waitTermStatistics13Excel() {
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		if ($this->dStartDate=="") {
			$this->dStartDate01=date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
		} else {
			$this->dStartDate01=$this->dStartDate;
		}
		if ($this->dEndDate=="") {
			$this->dEndDate01=date("Y-m-d");
			$this->dEndDate02=date("Y-m-d");
		} else {
			$this->dEndDate01=$this->dEndDate;
			$this->dEndDate02=$this->dEndDate;
		}
		//평균 대기일 리스트
		$this->sQuery="select tbl2.StageRate,tbl1.TurnNo as MyTurn,round((sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)),0) as iCnt01,(sum(if(isnull(tbl3.RegDate),DATEDIFF(now(),tbl2.RegDate),DATEDIFF(tbl3.RegDate,tbl2.RegDate)))/count(tbl1.TurnNo)) as iCnt02,count(tbl1.TurnNo) as iCnt03 from tbl_stage_payment as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_apply as tbl3 on tbl1.ParentIdx=tbl3.ParentIdx and tbl1.UserIdx=tbl3.UserIdx where tbl2.StageNum='13' and tbl1.RegDate >='".$this->dStartDate01."' and tbl1.RegDate <= '".$this->dEndDate01."' group by tbl2.StageRate,tbl1.TurnNo order by tbl2.StageRate asc,tbl1.TurnNo asc ";
		$arrDate04=$this->db->query($this->sQuery)->result_array();

		$arrCnt=array_fill(0,50,array(0,0,0,0,0,0,0,0,0,0,0,0,0,0));
		$arrCnt02=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$arrCnt03=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$arrTotalCnt=array_fill(0,14,0);
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('대기_순번별_평균_대기일_13명');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', '이율');
		$this->excel->getActiveSheet()->setCellValue('B1', '1번');
		$this->excel->getActiveSheet()->setCellValue('C1', '2번');
		$this->excel->getActiveSheet()->setCellValue('D1', '3번');
		$this->excel->getActiveSheet()->setCellValue('E1', '4번');
		$this->excel->getActiveSheet()->setCellValue('F1', '5번');
		$this->excel->getActiveSheet()->setCellValue('G1', '6번');
		$this->excel->getActiveSheet()->setCellValue('H1', '7번');
		$this->excel->getActiveSheet()->setCellValue('I1', '8번');
		$this->excel->getActiveSheet()->setCellValue('J1', '9번');
		$this->excel->getActiveSheet()->setCellValue('K1', '9번');
		$this->excel->getActiveSheet()->setCellValue('L1', '9번');
		$this->excel->getActiveSheet()->setCellValue('M1', '9번');
		$this->excel->getActiveSheet()->setCellValue('N1', '9번');
		$this->excel->getActiveSheet()->setCellValue('O1', '소계');

		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			for ($iCnt02=0;$iCnt02<sizeof($arrDate04);$iCnt02++) {
				if ($iCnt==$arrDate04[$iCnt02]["StageRate"]) {
					$iCnt03=$arrDate04[$iCnt02]["MyTurn"];
					$arrCnt[$iCnt][$iCnt03]=$arrDate04[$iCnt02]["iCnt01"];
					$arrCnt02[$iCnt03]=$arrCnt02[$iCnt03]+$arrDate04[$iCnt02]["iCnt02"];
					$arrCnt03[$iCnt03]=$arrCnt03[$iCnt03]+$arrDate04[$iCnt02]["iCnt03"];
				}
			}
		}
		for ($iCnt=7;$iCnt<18;$iCnt++) {
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$iCnt."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$sAlphabet="B";
			$iTotalCnt=0;
			for ($iCnt02=1;$iCnt02<14;$iCnt02++) {
				$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$arrCnt[$iCnt][$iCnt02],PHPExcel_Cell_DataType::TYPE_STRING);
				$sAlphabet++;
				$iTotalCnt=$iTotalCnt+$arrCnt[$iCnt][$iCnt02];
				$arrTotalCnt[$iCnt02]=$arrTotalCnt[$iCnt02]+$arrCnt[$iCnt][$iCnt02];
			}
			$iTotalCnt=$iTotalCnt/13;
			$iTotalCnt=fnRound02($iTotalCnt,3);
			$this->excel->getActiveSheet()->setCellValueExplicit($sAlphabet.$n,$iTotalCnt,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':'.$sAlphabet.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		}
		for ($iCnt03=1;$iCnt03<sizeof($arrTotalCnt);$iCnt03++) {
			if ($arrCnt03[$iCnt03]!=0) {
				$arrTotalCnt[$iCnt03]=$arrCnt02[$iCnt03]/$arrCnt03[$iCnt03];
			} else {
				$arrTotalCnt[$iCnt03]=0;
			}
			$arrTotalCnt[$iCnt03]=fnRound02($arrTotalCnt[$iCnt03],3);
		}
		$iTotalCnt02=($arrTotalCnt[1]+$arrTotalCnt[2]+$arrTotalCnt[3]+$arrTotalCnt[4]+$arrTotalCnt[5]+$arrTotalCnt[6]+$arrTotalCnt[7]+$arrTotalCnt[8]+$arrTotalCnt[9]+$arrTotalCnt[10]+$arrTotalCnt[11]+$arrTotalCnt[12]+$arrTotalCnt[13])/13;
		$iTotalCnt02=fnRound02($iTotalCnt02,3);
		$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,"합 계",PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$arrTotalCnt[1],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$arrTotalCnt[2],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$arrTotalCnt[3],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$arrTotalCnt[4],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$arrTotalCnt[5],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$arrTotalCnt[6],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$arrTotalCnt[7],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$arrTotalCnt[8],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$arrTotalCnt[9],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$arrTotalCnt[10],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$arrTotalCnt[11],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$arrTotalCnt[12],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$arrTotalCnt[13],PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$iTotalCnt02,PHPExcel_Cell_DataType::TYPE_STRING);

		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sFileName="대기_순번별_평균_대기일_13명";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		ob_end_clean();
		ob_start();
		$objWriter->save('php://output');
	}
	//mainStatistics
	function mainStatistics() {
		$this->Idx="1";
		$this->sQuery="SELECT tbl1.* FROM tbl_main_statistics as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		return $arrData;
	}
	//mainStatisticsModifyProc
	function mainStatisticsModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->TotalMoney=addslashes($this->input->post('TotalMoney'));
		$this->OverDueRate=addslashes($this->input->post('OverDueRate'));
		$this->WeakRate=addslashes($this->input->post('WeakRate'));
		$this->sQuery="update tbl_main_statistics set TotalMoney='".$this->TotalMoney."',OverDueRate='".$this->OverDueRate."',WeakRate='".$this->WeakRate."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/statistics/mainStatistics",'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
}