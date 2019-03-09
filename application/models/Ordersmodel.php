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
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
        $this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		
		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;

		
        
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		
		$arrData['arrResult02']=$this->showSelectBoxQuery();
		// if($this->session->userdata("AdminIdx")==1){
			$this->sQuery="select idx, companyname, productname, size, material, plated, setnumber, orderquantity, orderprice, orderdate, duedate, destination from order_view ".$this->sWhere." order by idx asc, orderdate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
			$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();	
		// }
		
		return $arrData;
	}

	// 업체 - 수정 버튼 눌렀을 때
	function modifyOrder(){
		$this->idx=$this->input->post('idx');
		$this->sQuery="SELECT tbl1.* from tbl_order as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['idx']=$this->idx;
		return $arrData;
	}
	
	// 업체 - 저장 버튼 눌렀을 때
	function modifySaveOrder(){
		
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx');
		$this->ordername=$this->input->post('ordername');
		$this->material=$this->input->post('material');
		$this->plated=$this->input->post('plated');
		$this->size1=$this->input->post('size1');
		$this->size2=$this->input->post('size2');
		$this->size3=$this->input->post('size3');
		$this->setnumber=$this->input->post('setnumber');
		
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_order as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
	
		$this->sQuery="UPDATE tbl_order SET ordername='".$this->ordername."',material='".$this->material."',plated='".$this->plated."',size1='".$this->size1."',size2='".$this->size2."',size3='".$this->size3."',setnumber='".$this->setnumber."' WHERE tbl_order.idx='".$this->idx."'";
		$this->sQuery2="SELECT tbl1.* from tbl_order as tbl1";
		$this->db->query($this->sQuery);

		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;

	}

	function deleteOrder(){
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');
		$this->sQuery="DELETE FROM tbl_order WHERE idx='".$this->idx."'";
		$this->db->query($this->sQuery);
		$this->sQuery2="SELECT tbl1.* from tbl_order as tbl1";
		$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_order as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		return $arrData;
	}
	
}
