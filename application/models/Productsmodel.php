<?php
class Productsmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}

	//productList
	function productList() {
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

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
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->idx=$this->input->post('idx');
		$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['idx']=$this->idx;
		return $arrData;
	}
	
	// 업체 - 저장 버튼 눌렀을 때
	function modifySaveProduct(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;
		
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx');
		$this->productname=$this->input->post('productname');
		$this->size=$this->input->post('size');
		$this->material=$this->input->post('material');
		$this->plated=$this->input->post('plated');
		$this->setnumber=$this->input->post('setnumber');
		
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
	
		$this->sQuery="UPDATE tbl_stock SET productname='".$this->productname."',material='".$this->material."',plated='".$this->plated."',size='".$this->size."',setnumber='".$this->setnumber."' WHERE tbl_stock.idx='".$this->idx."'";
		$this->sQuery2="SELECT tbl1.* from tbl_stock as tbl1";
		$this->db->query($this->sQuery);

		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;

	}

	function deleteProduct(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');
		$this->sQuery="DELETE FROM tbl_stock WHERE idx='".$this->idx."'";
		$this->db->query($this->sQuery);
		$this->sQuery2="SELECT tbl1.* from tbl_stock as tbl1";
		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;
	}
	
}
