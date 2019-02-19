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
		$this->sQuery = "SELECT tbl1.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$where." order by tbl3.idx asc, tbl2.setnumber LIMIT ".$start.", ".$pageScale;
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 바뀐 단가 Update
	function updatePriceQuery($idx, $price){
		$this->sQuery="UPDATE tbl_cpuse SET price='".$price."' WHERE tbl_cpuse.idx='".$idx."'";
		$this->db->query($this->sQuery);
	}

	// SelectBox 내용 출력
	function showSelectBoxQuery(){
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 기본 값 설정
	function defaultSetting(){
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
		$arrData=$this->defaultSetting();
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		//단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
		// SelectBox에서 체크한 company를 보여주기 위한 쿼리문
		// $this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		// $arrData['arrResult02']= $this->db->query($this->sQuery)->result_array();
		// $this->sQuery="SELECT tbl3.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$this->sWhere." order by tbl3.idx asc LIMIT ".$this->iStart.", ".$this->iPageScale;
        // $arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
	}

	function addPrice() {
		$arrData=$this->defaultSetting();
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		//단가 페이지 출력
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
		$arrData=$this->defaultSetting();	
		$this->no = 0;
		$this->idx=$this->input->post('idx');
		$this->price=$this->input->post('price');
			
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		// 바뀐 단가 Update
		$this->updatePriceQuery($this->idx, $this->price);
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
		// $this->sQuery="UPDATE tbl_cpuse SET price='".$this->price."' WHERE tbl_cpuse.idx='".$this->idx."'";
		// $this->sQuery2="SELECT tbl3.idx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl2.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 on tbl3.company=tbl1.idx join tbl_stock as tbl2 on tbl3.product=tbl2.idx ".$this->sWhere." order by tbl3.idx asc LIMIT ".$this->iStart.", ".$this->iPageScale;
	}
	function insertCpuseQuery($companyidx,$productidx,$price){
		$this->sQuery="INSERT into tbl_cpuse (company,product,price) values ('".$companyidx."','".$productidx."','".$price."')";
		$this->db->query($this->sQuery);
	}   	
	// function insertProuctQuery(){
	// 	$this->sQuery="INSERT into tbl_stock (company,product,price) values (".$companyidx.",".$productidx.",".$price.")";
	// 	$this->db->query($this->sQuery);
	// }

	function checkExistence($companyidx, $productname, $size, $material, $plated, $setnumber, $price){
		$this->sQuery="select idx as pidx from tbl_stock where productname='".$productname."' and size='".$size."' and material='".$material."' and plated='".$plated."'";
		$this->productIdx = $this->db->query($this->sQuery)->row()->pidx;
		if(!$this->productIdx){
			$this->sQuery="INSERT into tbl_stock (productname,size,material,plated) values ('".$productname."','".$size."','".$material."','".$plated."')";
			$this->db->query($this->sQuery);
			$this->sQuery2="SELECT MAX(idx) as newidx from tbl_stock";
			$this->newidx=$this->db->query($this->sQuery2)->row()->newidx;
			$this->insertCpuseQuery($companyidx,$this->newidx,$price);
		}else{
			$this->sQuery="SELECT idx from tbl_cpuse where company='".$companyidx."' and product=".$this->productIdx." and price='".$price."'";
			if(!$this->db->query($this->sQuery)){
				$this->insertCpuseQuery($companyidx,$this->productIdx,$price);
			}
		}
		return null;
		// return 값을 줘서 view로 뿌려준다음 자바스크립트로 false가 들어오면 alert창이 (이미 있다고) 뜨게
		
	}

	
	  

	function addSavePrice(){
		
		$arrData=$this->defaultSetting();
		$this->companyidx=$this->input->post('companyidx');
		$this->productname=$this->input->post('productname');
		$this->size=$this->input->post('size');
		$this->material=$this->input->post('material');
		$this->plated=$this->input->post('plated');
		$this->setnumber=$this->input->post('setnumber');
		$this->price=$this->input->post('price');
		$this->checkExistence($this->companyidx, $this->productname, $this->size, $this->material, $this->plated, $this->setnumber, $this->price);
		// $this->isnull=$this->checkExistence($this->companyidx, $this->productname, $this->size, $this->material, $this->plated, $this->setnumber, $this->price);
		// $arrData['isAlreadyExistCpuse']=$this->isnull;
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
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
 
