<?php
class Ordersmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	function showSelectBoxQuery(){
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}
	//orderList
	function orderList() {
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM order_view as tbl1 ".$this->sWhere;
        $this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 


		$arrData['no']=$this->no;
		$arrData['arrResult02']=$this->showSelectBoxQuery();
		$this->sQuery="select DISTINCT oidx, idx, companyname, productname, size, material, plated, setnumber, orderquantity, orderprice, orderdate, duedate, destination from order_view ".$this->sWhere." order by idx asc, orderdate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();	
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		
		return $arrData;
	}

	// 업체 - 수정 버튼 눌렀을 때
	function modifyOrder(){
		$this->no = 0;
		$arrData['no']=$this->no;
		// $this->totalprice=$this->input->post('idx1');
		$this->idx=$this->input->post('idx');
		$this->sQuery="SELECT tbl1.* from order_view as tbl1 where tbl1.oidx='".$this->idx."'";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['idx']=$this->idx;
		return $arrData;
	}
	
	// 업체 - 저장 버튼 눌렀을 때
	function modifySaveOrder(){
		$this->no = 0; 
		$arrData['no']=$this->no;
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->oidx=$this->input->post('oidx');
		$this->orderquantity=$this->input->post('orderquantity');
		$this->duedate=$this->input->post('duedate');
		$this->destination=$this->input->post('destination');

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_order as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
	
		$this->sQuery="UPDATE tbl_order SET orderquantity='".$this->orderquantity."', duedate='".$this->duedate."', destination='".$this->destination."' WHERE tbl_order.idx='".$this->oidx."'";
		$this->db->query($this->sQuery);
		
		
		$arrData['arrResult02']=$this->showSelectBoxQuery();
		$this->sQuery="select DISTINCT oidx, idx, companyname, productname, size, material, plated, setnumber, orderquantity, orderprice, orderdate, duedate, destination from order_view ".$this->sWhere." order by idx asc, orderdate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;

	}

	function deleteOrder(){
		$this->no = 0;
		$arrData['no']=$this->no;
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');
		$this->sQuery="DELETE FROM tbl_order WHERE idx='".$this->idx."'";
		$this->db->query($this->sQuery);
		

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_order as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$this->sQuery="select DISTINCT oidx, idx, companyname, productname, size, material, plated, setnumber, orderquantity, orderprice, orderdate, duedate, destination from order_view ".$this->sWhere." order by idx asc, orderdate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();
		return $arrData;
	}
	
}
