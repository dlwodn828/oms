<?php
class Customersmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}

	//consultHistoryList
	function consultHistoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;
		
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_company as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	function addCompany(){
		return;
	}
	function addSaveCompany(){
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx');
		$this->companyname=$this->input->post('companyname');
		$this->userid=$this->input->post('userid');
		$this->userpwd=$this->input->post('userpwd');
		$this->managername=$this->input->post('managername');
		$this->maincategory=$this->input->post('maincategory');
		$this->subcategory=$this->input->post('subcategory');
		$this->companyaddr=$this->input->post('companyaddr');
		$this->companytel=$this->input->post('companytel');
		$this->fax=$this->input->post('fax');
		$this->managertel=$this->input->post('managertel');
		$this->email=$this->input->post('email');
		if($this->companyname==""||$this->userid==""||$this->userpwd==""){
			return "";
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_company as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 

		
		$this->sQuery="INSERT INTO tbl_company(companyname ,userid, userpwd, managername, maincategory, subcategory, companyaddr, companytel, fax, managertel, email) VALUES('".$this->companyname."','".$this->userid."','".$this->userpwd."','".$this->managername."','".$this->maincategory."','".$this->subcategory."','".$this->companyaddr."','".$this->companytel."','".$this->fax."','".$this->managertel."','".$this->email."')";
		$this->sQuery2="SELECT tbl1.* from tbl_company as tbl1";
		$this->db->query($this->sQuery);

		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;
	}


	// 업체 - 수정 버튼 눌렀을 때
	function modifyCompany(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;
		$this->idx=$this->input->post('idx');
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['idx']=$this->idx;
		return $arrData;
	}
	
	// 업체 - 저장 버튼 눌렀을 때
	function modifySaveCompany(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx');
		$this->companyname=$this->input->post('companyname');
		$this->userid=$this->input->post('userid');
		$this->userpwd=$this->input->post('userpwd');
		$this->managername=$this->input->post('managername');
		$this->maincategory=$this->input->post('maincategory');
		$this->subcategory=$this->input->post('subcategory');
		$this->companyaddr=$this->input->post('companyaddr');
		$this->companytel=$this->input->post('companytel');
		$this->fax=$this->input->post('fax');
		$this->managertel=$this->input->post('managertel');
		$this->email=$this->input->post('email');

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_company as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 

		
		$this->sQuery="UPDATE tbl_company SET companyname='".$this->companyname."',userid='".$this->userid."',userpwd='".$this->userpwd."',managername='".$this->managername."',maincategory='".$this->maincategory."',subcategory='".$this->subcategory."',companyaddr='".$this->companyaddr."',companytel='".$this->companytel."',fax='".$this->fax."',managertel='".$this->managertel."',email='".$this->email."' WHERE tbl_company.idx='".$this->idx."'";
		$this->sQuery2="SELECT tbl1.* from tbl_company as tbl1";
		$this->db->query($this->sQuery);

		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;

	}

	function deleteCompany(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_company as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 

		
		$this->sQuery="DELETE FROM tbl_company WHERE idx='".$this->idx."'";
		$this->db->query($this->sQuery);
		$this->sQuery2="SELECT tbl1.* from tbl_company as tbl1";
		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;
	}
	
}
