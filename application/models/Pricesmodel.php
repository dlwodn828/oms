<?php
class Pricesmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}


	// 업체별 품목 및 단가 페이지 출력
	function showPriceQuery($where, $start, $pageScale){
		$this->sQuery="SELECT tbl3.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$where." order by tbl3.idx asc, tbl2.setnumber LIMIT ".$start.", ".$pageScale;
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 바뀐 단가 Update
	function updatePriceQuery($price, $idx){
		$this->sQuery="UPDATE tbl_cpuse SET price='".$price."' WHERE tbl_cpuse.idx='".$idx."'";
		$this->db->query($this->sQuery);
	}

	// SelectBox 내용 출력
	function showSelecteBoxQuery(){
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 기본 값 설정
	function defualtSetting(){
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;

		// SelectBox에서 체크한 company만 출력
		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and tbl1.idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;

		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	// 단가 - 메인
	function priceList() {
		$arrData=$this->defualtSetting();
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelecteBoxQuery();
		//단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
		// SelectBox에서 체크한 company를 보여주기 위한 쿼리문
		// $this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		// $arrData['arrResult02']= $this->db->query($this->sQuery)->result_array();
		// $this->sQuery="SELECT tbl3.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$this->sWhere." order by tbl3.idx asc LIMIT ".$this->iStart.", ".$this->iPageScale;
        // $arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
	}

	
	// 단가 - 저장 버튼 눌렀을 때
	function modifySavePrice(){
		// 표의 인덱스
		$this->no = 0;
		$this->idx=$this->input->post('idx');
		$this->price=$this->input->post('price');
		$arrData=$this->defualtSetting();		
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelecteBoxQuery();
		// 바뀐 단가 Update
		$this->updatePriceQuery($this->price,$this->idx);
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
		// $this->sQuery="UPDATE tbl_cpuse SET price='".$this->price."' WHERE tbl_cpuse.idx='".$this->idx."'";
		// $this->sQuery2="SELECT tbl3.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$this->sWhere." order by tbl3.idx asc LIMIT ".$this->iStart.", ".$this->iPageScale;
	}

	// function deletePrice(){
	// 	// 표의 인덱스
	// 	$this->no = 0;
	// 	$arrData['no']=$this->no;

	// 	$this->sPage=addslashes(trim($this->input->get('sPage')));
	// 	$this->iPageScale = 10;
	// 	$this->iStepScale = 5;
	// 	$this->sWhere="where 1=1 ";

	// 	$this->idx=$this->input->post('idx2');
	// 	$this->sQuery="DELETE FROM tbl_stock WHERE idx='".$this->idx."'";
	// 	$this->db->query($this->sQuery);
	// 	$this->sQuery2="SELECT tbl1.* from tbl_stock as tbl1";
	// 	$arrData['arrResult']=$this->db->query($this->sQuery2)->result_array();

	// 	if(!$this->sPage){ $this->sPage = 1;}
	// 	$this->iStart=($this->sPage-1)*$this->iPageScale;
	// 	$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
	// 	$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
	// 	$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
	// 	$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
	// 	$arrData['sPage']=$this->sPage;
	// 	$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

	// 	return $arrData;
	// }

	
	// // 업체 - 수정 버튼 눌렀을 때
	// function modifyPrice(){
	// 	// 표의 인덱스
	// 	$this->no = 0;
	// 	$arrData['no']=$this->no;

	// 	$this->idx=$this->input->post('idx');
	// 	$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1";
	// 	$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
	// 	$arrData['idx']=$this->idx;
	// 	return $arrData;
	// }
	
}
