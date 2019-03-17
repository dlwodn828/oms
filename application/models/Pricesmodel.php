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
		$this->sQuery = "SELECT tbl1.idx, tbl2.idx as sidx, tbl1.companyname, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl3.setnumber, tbl3.price from tbl_cpuse as tbl3 join tbl_company as tbl1 join tbl_stock as tbl2 on tbl3.company=tbl1.idx and tbl3.product=tbl2.idx ".$where." order by tbl1.idx asc,tbl2.idx asc, tbl3.setnumber asc LIMIT ".$start.", ".$pageScale;
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 바뀐 단가 Update
	function updatePriceQuery($idx, $price, $product){
		$this->sQuery="UPDATE tbl_cpuse SET price='".$price."' WHERE company='".$idx."' and product='".$product."'";
		$this->db->query($this->sQuery);
	}

	// SelectBox 내용 출력
	function showSelectBoxQuery(){
		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1 ".$this->sWhere." order by tbl1.Idx asc";
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
		
		// SelectBox에서 체크한 company만 출력
		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and tbl1.idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;
		
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	// 단가 - 메인
	function priceList() {
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		
		// SelectBox에서 체크한 company만 출력
		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and tbl1.idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;
		
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		//단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	function addPrice() {
		$arrData=$this->defaultSetting();
		$arrData['arrResult02']= $this->showSelectBoxQuery();

		return $arrData;
	}

	
	// 단가 - 저장 버튼 눌렀을 때
	function modifySavePrice(){
		// 표의 인덱스
		$arrData=$this->defaultSetting();	
		$this->no = 0;
		$this->idx=$this->input->post('idx');
		$this->price=$this->input->post('price');
		$this->product=$this->input->post('productidx');
			
		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		// 바뀐 단가 Update
		$this->updatePriceQuery($this->idx, $this->price, $this->product);
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
	}
	function insertCpuseQuery($companyidx,$productidx,$price,$setnumber){
		$this->sQuery="INSERT into tbl_cpuse (company,product,price,setnumber) values ('".$companyidx."','".$productidx."','".$price."', '".$setnumber."')";
		$this->db->query($this->sQuery);
	}   	


	function checkExistence($companyidx, $productname, $size, $material, $plated, $setnumber, $price){
		// 품목 테이블에 있는 건지 확인 (중복되는 품목이 생기는 것을 방지)
		$this->sQuery="select count(idx) as pidx from tbl_stock where productname='".$productname."' and size='".$size."' and material='".$material."' and plated='".$plated."'";
		$this->productIdx = $this->db->query($this->sQuery)->row()->pidx;
		//중복되는 것이 없으면 
		if(!$this->productIdx){
			//품목 테이블에 등록
			$this->sQuery="INSERT into tbl_stock (productname,size,material,plated) values ('".$productname."','".$size."','".$material."','".$plated."')";
			$this->db->query($this->sQuery);
			$this->sQuery2="SELECT MAX(idx) as recentidx from tbl_stock";
			$this->recentidx=$this->db->query($this->sQuery2)->row()->recentidx;
			
			//사용 테이블에 등록
			$this->insertCpuseQuery($companyidx,$this->recentidx,$price,$setnumber);
			
		}
		//중복되는 것이 있으면
		else{

			//사용 테이블에 등록
			$this->sQuery="SELECT count(idx) as cidx from tbl_cpuse where company='".$companyidx."' and product=".$this->productIdx." and price='".$price."'";
			$this->companyIdx=$this->db->query($this->sQuery)->row()->cidx;
			if(!$this->companyIdx){
				$this->insertCpuseQuery($companyidx,$this->productIdx,$price,$setnumber);
			}
		}
		return null;

		
	}

	
	  

	function addSavePrice(){
		
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		
		// SelectBox에서 체크한 company만 출력
		$this->companyidx=addslashes(trim($this->input->get('companyidx'))); 
		if ($this->companyidx) { $this->sWhere.=" and tbl1.idx='".$this->companyidx."' ";  }
		$arrData['companyidx']=$this->companyidx;
		
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_cpuse as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);

		$this->companyidx=$this->input->post('companyidx');
		$this->productname=$this->input->post('productname');
		$this->size=$this->input->post('size');
		$this->material=$this->input->post('material');
		$this->plated=$this->input->post('plated');
		$this->setnumber=$this->input->post('setnumber');
		$this->price=$this->input->post('price1');
		$this->checkExistence($this->companyidx, $this->productname, $this->size, $this->material, $this->plated, $this->setnumber, $this->price);

		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
	}
	function deletePrice(){
		// 표의 인덱스
		$this->no = 0;
		$arrData['no']=$this->no;

		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";

		$this->idx=$this->input->post('idx2');
		$this->productidx=$this->input->post('productidx');
		$this->sQuery="DELETE FROM tbl_cpuse WHERE company='".$this->idx."' and product='".$this->productidx."'";
		$this->db->query($this->sQuery);

		$this->sQuery="SELECT count(*) as c from tbl_cpuse where product='".$this->productidx."'";
		$this->isProductUsed=$this->db->query($this->sQuery)->row()->c;
		if(!$this->isProductUsed){
			$this->sQuery="DELETE FROM tbl_stock WHERE idx='".$this->productidx."'";
			$this->db->query($this->sQuery);

		}

		$arrData = $this->priceList();

		return $arrData;
	}

}
 
