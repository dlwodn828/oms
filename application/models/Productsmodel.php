<?php
class Productsmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}

	//consultHistoryList
	function productList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	// 업체 - 수정 버튼 눌렀을 때
	function modifyProduct(){
		$this->idx=$this->input->post('idx');
		$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['idx']=$this->idx;
		return $arrData;
	}
	
	// 업체 - 저장 버튼 눌렀을 때
	function modifySaveProduct(){
		
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		// $this->idx=$this->input->post('idx');
		// $this->userid=$this->input->post('userid');
		// $this->userpwd=$this->input->post('userpwd');
		// $this->companyname=$this->input->post('companyname');
		// $this->managername=$this->input->post('managername');
		// $this->companyaddr=$this->input->post('companyaddr');
		// $this->companytel=$this->input->post('companytel');
		// $this->managertel=$this->input->post('managertel');

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 

		
		// $this->sQuery="UPDATE tbl_company SET userid='".$this->userid."',userpwd='".$this->userpwd."',companyname='".$this->companyname."',managername='".$this->managername."',companyaddr='".$this->companyaddr."',companytel='".$this->companytel."',managertel='".$this->managertel."' WHERE tbl_company.idx='".$this->idx."'";
		$this->sQuery2="SELECT tbl1.* from tbl_stock as tbl1";
		$this->db->query($this->sQuery);

		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;

	}

	function deleteProduct(){
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 

		
		$this->sQuery="DELETE FROM tbl_stock WHERE idx='".$this->idx."'";
		$this->db->query($this->sQuery);
		$this->sQuery2="SELECT tbl1.* from tbl_stock as tbl1";
		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;
	}
	
}
