<?php
class Dashboardmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	function dashboard() {
		$this->sQuery="select (select count(Idx) as iCnt FROM tbl_stage) as iCnt01,(select count(Idx) as iCnt FROM tbl_donate) as iCnt02,(select count(Idx) as iCnt FROM tbl_member where UserDelYn!='Y') as iCnt03,(select count(Idx) as iCnt FROM tbl_member_log where ReturnCode='01') as iCnt04";
		$arrData["arrResult"]=$this->db->query($this->sQuery)->row_array();
		$this->sQuery="SELECT tbl1.* FROM cms_inquiryList as tbl1 order by tbl1.Idx desc LIMIT 0,5";
		$arrData["arrResult02"]=$this->db->query($this->sQuery)->result_array();
		$this->sQuery="SELECT tbl1.* FROM tbl_board as tbl1 order by tbl1.Category asc,tbl1.Idx desc LIMIT 0,5";
		$arrData["arrResult03"]=$this->db->query($this->sQuery)->result_array();

		$arrData['arrDate']=array(date("m/d",strtotime(date("Y-m-d")."-19 days")),date("m/d",strtotime(date("Y-m-d")."-18 days")),date("m/d",strtotime(date("Y-m-d")."-17 days")),date("m/d",strtotime(date("Y-m-d")."-16 days")),date("m/d",strtotime(date("Y-m-d")."-15 days")),date("m/d",strtotime(date("Y-m-d")."-14 days")),date("m/d",strtotime(date("Y-m-d")."-13 days")),date("m/d",strtotime(date("Y-m-d")."-12 days")),date("m/d",strtotime(date("Y-m-d")."-11 days")),date("m/d",strtotime(date("Y-m-d")."-10 days")),date("m/d",strtotime(date("Y-m-d")."-9 days")),date("m/d",strtotime(date("Y-m-d")."-8 days")),date("m/d",strtotime(date("Y-m-d")."-7 days")),date("m/d",strtotime(date("Y-m-d")."-6 days")),date("m/d",strtotime(date("Y-m-d")."-5 days")),date("m/d",strtotime(date("Y-m-d")."-4 days")),date("m/d",strtotime(date("Y-m-d")."-3 days")),date("m/d",strtotime(date("Y-m-d")."-2 days")),date("m/d",strtotime(date("Y-m-d")."-1 days")),date("m/d"));
		$this->sStartDate=date("Y-m-d",strtotime(date("Y-m-d")."-19 days"));
		$this->sEndDate=date("Y-m-d");
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage where RegDate >'".$this->sStartDate." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->sStartDate."' and tbl1.NowDate <= '".$this->sEndDate."' order by tbl1.NowDate asc"; 
//		echo $this->sQuery;
//		exit;
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate01']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate01'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_stage_del where RegDate >'".$this->sStartDate." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->sStartDate."' and tbl1.NowDate <= '".$this->sEndDate."' order by tbl1.NowDate asc"; 
//		echo $this->sQuery;
//		exit;
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate02']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate02'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_member_log where RegDate >'".$this->sStartDate." 00:00:00' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->sStartDate."' and tbl1.NowDate <= '".$this->sEndDate."' order by tbl1.NowDate asc"; 
//		echo $this->sQuery;
//		exit;
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate03']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate03'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		$this->sQuery="select DATE_FORMAT(tbl1.NowDate,'%m/%d') as NowDate,ifnull(tbl2.iCnt,0) as iCnt from tbl_calendar as tbl1 left join (select count(left(RegDate,10)) as iCnt,left(RegDate,10) as RegDate from tbl_counter where RegDate >'".$this->sStartDate." ' group by left(RegDate,10)) as tbl2 on tbl1.NowDate=tbl2.RegDate where tbl1.NowDate >='".$this->sStartDate."' and tbl1.NowDate <= '".$this->sEndDate."' order by tbl1.NowDate asc"; 
//		echo $this->sQuery;
//		exit;
		$this->arrResult="";
		$this->arrResult=$this->db->query($this->sQuery);
		$arrData['arrDate04']=array();
		$this->iCnt=0;
		foreach ($this->arrResult->result() as $row) {
			$arrData['arrDate04'][$this->iCnt]=$row->iCnt;
			$this->iCnt=$this->iCnt+1;
		}
		
		return $arrData;
	}
}