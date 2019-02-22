<?php
class C_ordersmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}


	// 업체별 품목 및 단가 페이지 출력
	function showOrderQuery($where, $start, $pageScale){         
        $this->sid=$this->session->userdata("AdminIdx");
		$this->sQuery="SELECT tbl3.idx, tbl2.setnumber, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl3.price from tbl_stock as tbl2 join tbl_cpuse as tbl3 on tbl3.company='".$this->sid."' and tbl2.idx=tbl3.product ".$where." order by tbl3.idx asc, tbl2.setnumber, tbl2.idx desc LIMIT ".$start.", ".$pageScale;
		$this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	// 바뀐 단가 Update
	function updateQuantityQuery($idx, $price){
		$this->sQuery="UPDATE tbl_cpuse SET price='".$price."' WHERE tbl_cpuse.idx='".$idx."'";
		$this->db->query($this->sQuery);
	}

	// SelectBox 내용 출력
	function showSelectBoxQuery(){
        $this->sid=$this->session->userdata("AdminIdx");
        $this->sQuery="select setnumber from tbl_set where companyidx='".$this->sid."'";
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
		$this->setnumber=addslashes(trim($this->input->get('setnumber'))); 
		if ($this->setnumber) { $this->sWhere.=" and tbl2.setnumber='".$this->setnumber."' ";  }
		$arrData['setnumber']=$this->setnumber;
        
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		return $arrData;
	}

	function getOrderedPriceQuery($companyidx){
		$this->sQuery="SELECT product, orderquantity FROM tbl_order WHERE company='".$companyidx."' and orderdate = (SELECT MAX(orderdate) FROM tbl_order GROUP BY product)";
		$this->arrData=$this->db->query($this->sQuery)->result_array();
		
		return $this->arrData;
	}

    function c_ordering(){
		
		$arrData=$this->defaultSetting();
		$this->companyidx=$this->session->userdata("AdminIdx");
        $arrData['arrResult02']= $this->showSelectBoxQuery();
		$arrData['arrResult'] = $this->showOrderQuery($this->sWhere,$this->iStart,$this->iPageScale);
		// $arrData['orderquantity']=$this->getOrderedPriceQuery($this->companyidx);
        return $arrData;
    }

	function saveOrder(){
		$this->duedate=$this->input->post('duedate');
		$this->destination=$this->input->post('destination');

		$arrData=$this->defaultSetting();
		//주문 내용 DB에 저장
		$this->sQuery1="SELECT price from tbl_cpuse where idx='".$this->idx."'";
        $this->arrData = $this->db->query($this->sQuery1)->result_array();
		$this->sQuery="INSERT into tbl_order(company, product, orderquantity, orderprice, orderdate, duedate, destination) values ('".$this->idx."', '".$this->quantity."','".$this->quantity."')";
		//이메일 보내기
		$this->sendEmail();




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



	function sendEmail() {
		// alert('no');
		foreach ($this->input->post('arrIdx') as $index => $idx) {
			$arrIdx[] = addslashes(trim($idx));
			$arrBasequantity[] = addslashes(trim($this->input->post('arrBasequantity')[$index]));
		}

		$this->duedate = $this->input->post('duedate');
		$this->destination = $this->input->post('destination');
		
		if (empty($arrBasequantity) || empty($arrIdx)) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		}else{
			$this->sQuery="SELECT count(idx) as iCnt01 FROM tbl_cpuse where idx IN (".implode(',',$arrIdx).")";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			

			if($this->iCnt01!=0){
				$this->sQuery="SELECT tbl.* from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx desc";
				$arrData['arrResult'] = $this->db->query($this->sQuery)->result_array();
				
				$this->sQuery="SELECT tbl.company, tbl.product, tbl.price from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).")";
				$arrCpuse=$this->db->query($this->sQuery)->result_array();

				if ($arrCpuse) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'이메일 주문이 완료되었습니다.', 'data'=>$arrCpuse);
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'model에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}


				$data['arrItem'] = $arrData['arrResult'];

				$this->load->library('email');
				//SMTP & mail configuration
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'alltcpc@gmail.com',
					'smtp_pass' => 'alltcpc0712',
					'mailtype'  => 'html',
					'charset'   => 'utf-8'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");

				//Email content
				$htmlContent = $this->load->view('forms/purchaseFormA4', $data, TRUE);
				// TEST
				// $datajson = json_encode($arrBasequantity);
				// $htmlContent = $datajson;

				$this->email->to('dlwodn828@gmail.com');
				$this->email->from('allt@allt.kr','ALLT');
				$this->email->subject('주문서가 도착했습니다.');
				$this->email->message($htmlContent);
				// $arrRetMessage['data'] = $arrBasequantity;
				//Send email
				if (!$this->email->send(TRUE)) {
					// fnAlertMsg($this->email->print_debugger(array('headers', 'subject', 'body')));
					fnAlertMsg("메일발송이 실패하였습니다. 해당 문제가 지속될시 관리자에게 연락주세요");
				}





			}
			// $arrRetMessage=array('sRetCode'=>'01', 'sMessage'=>'성공!');
		}
		return json_encode($arrRetMessage);	
		
	}
//cancelStageProc
	function sendEmail1() {
		foreach ($this->input->post('arrIdx') as $index => $idx) {
			$arrIdx[] = addslashes(trim($idx));
			$arrBasequantity[] = addslashes(trim($this->input->post('arrBasequantity')[$index]));
		}

		$this->duedate = $this->input->post('duedate');
		$this->destination = $this->input->post('destination');
		
		if (empty($arrBasequantity) || empty($arrIdx)) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
 			// foreach ($arrIdx as $idx) {
			// }
			$this->sQuery="SELECT count(idx) as iCnt01 FROM tbl_cpuse where idx IN (".implode(',',$arrIdx).")";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			
			if ($this->iCnt01!=0) {
				$this->sQuery="SELECT tbl.* from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx desc";
				$arrData['arrResult'] = $this->db->query($this->sQuery)->result_array();
				
				$this->sQuery="SELECT tbl.company, tbl.product, tbl.price from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx acs";
				$arrCpuse=$this->db->query($this->sQuery)->result_array();

				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'이메일 주문이 완료되었습니다.', 'data'=>$arrData['arrResult']);
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'model에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
				
				// foreach ($arrData['arrResult'] as $index => $value) {
				// 	$arrData['arrResult'][$index]['basequantity'] = $arrBasequantity[$index];
				// }



				// $this->sQuery="SELECT tbl.company, tbl.product, tbl.price from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx acs";
				
				// for($i=0;$i<$this->iCnt01;$i++){
				



				// $arrData['arrResult'][0]['basequantity'] = $this->basequantity;
				// $arrRetMessage['data'] = ;
				// $data['arrItem'] = $arrData['arrResult'];
				//sendmail 진행
				//Load email library
				$this->load->library('email');
				//SMTP & mail configuration
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'alltcpc@gmail.com',
					'smtp_pass' => 'alltcpc0712',
					'mailtype'  => 'html',
					'charset'   => 'utf-8'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");

				//Email content
				$htmlContent = $this->load->view('forms/purchaseFormA4', $data, TRUE);
				// TEST
				// $datajson = json_encode($arrBasequantity);
				// $htmlContent = $datajson;

				$this->email->to('dlwodn828@gmail.com');
				$this->email->from('allt@allt.kr','ALLT');
				$this->email->subject('주문서가 도착했습니다.');
				$this->email->message($htmlContent);
				// $arrRetMessage['data'] = $arrBasequantity;
				//Send email
				if (!$this->email->send(TRUE)) {
					// fnAlertMsg($this->email->print_debugger(array('headers', 'subject', 'body')));
					fnAlertMsg("메일발송이 실패하였습니다. 해당 문제가 지속될시 관리자에게 연락주세요");
				}else{
					//DB저장

					$arrData=$this->defaultSetting();
					//주문 내용 DB에 저장
					$this->sQuery1="SELECT price from tbl_cpuse where idx IN (".implode(',',$arrIdx).")";
					$this->arrData = $this->db->query($this->sQuery1)->result_array();

					foreach($arrCpuse as $index=>$value){
						$this->sQuery="INSERT into tbl_order (company,product,orderprice) values ('".$arrCpuse."'[0]['".$value."'], '".$arrCpuse."'[1]['".$value."'], '".$arrCpuse."'[2]['".$value."'])";
						// "INSERT into tbl_order(company,product,orderprice) values ($arrData['arrResult'][0][$value],$arrData['arrResult'][0][$value],$arrData['arrResult'][0][$value],$arrData['arrResult'][0][$value])
						$this->db->query($this->sQuery);
					}

					// $this->sQuery
					// $this->sQuery="INSERT into tbl_order(orderquantity, duedate, destination) values ('".$this->idx."', '".$this->quantity."','".$this->quantity."')";
					
					
				}
			}
		return json_encode($arrRetMessage);
		}
	}
	
}
 
