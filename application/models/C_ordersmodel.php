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
		$this->sQuery="SELECT tbl3.idx, tbl3.setnumber, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl3.price from tbl_stock as tbl2 join tbl_cpuse as tbl3 on tbl3.company='".$this->sid."' and tbl2.idx=tbl3.product ".$where." order by tbl3.idx asc, tbl3.setnumber asc LIMIT ".$start.", ".$pageScale;
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
        $this->sQuery="SELECT DISTINCT setnumber from tbl_cpuse where company='".$this->sid."'";
        $this->arrData = $this->db->query($this->sQuery)->result_array();
		return $this->arrData;
	}

	
	

	// 기본 값 설정
	function defaultSetting(){
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->companyidx=$this->session->userdata("AdminIdx");
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;

		// SelectBox에서 체크한 company만 출력
		$this->setnumber=addslashes(trim($this->input->get('setnumber'))); 
		if ($this->setnumber) { $this->sWhere.=" and tbl3.setnumber='".$this->setnumber."' ";  }
		$arrData['setnumber']=$this->setnumber;
        
		$this->sQuery="SELECT count(tbl3.idx) as iCnt FROM tbl_cpuse as tbl3 ".$this->sWhere." and tbl3.company='".$this->companyidx."'";
        $this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		
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
		
        $arrData['arrResult02']= $this->showSelectBoxQuery();
		$this->sid=$this->session->userdata("AdminIdx");
		$this->sQuery="SELECT tbl3.idx, tbl3.setnumber, tbl2.productname, tbl2.size, tbl2.material, tbl2.plated, tbl3.price from tbl_stock as tbl2 join tbl_cpuse as tbl3 on tbl3.company='".$this->sid."' and tbl2.idx=tbl3.product ".$this->sWhere." order by tbl3.idx asc, tbl3.setnumber asc";
		$arrData['arrResult']=$this->arrData = $this->db->query($this->sQuery)->result_array();
		// $arrData['orderquantity']=$this->getOrderedPriceQuery($this->companyidx);
        return $arrData;
    }


	function insertCpuseQuery($companyidx,$productidx,$price){
		$this->sQuery="INSERT into tbl_cpuse (company,product,price) values ('".$companyidx."','".$productidx."','".$price."')";
		$this->db->query($this->sQuery);
	}   	

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

		// SelectBox 내용 출력
		$arrData['arrResult02']= $this->showSelectBoxQuery();
		// 단가 페이지 출력
		$arrData['arrResult'] = $this->showPriceQuery($this->sWhere,$this->iStart,$this->iPageScale);
		return $arrData;
	}


	function saveOrder($iCnt,$arrCpuse, $arrBasequantity, $duedate, $destination){

		for($i=0;$i<$iCnt;$i++){
			$this->sQuery="INSERT into tbl_order(company, product, orderprice) values ('".$arrCpuse[$i]['company']."' ,'".$arrCpuse[$i]['product']."','".$arrCpuse[$i]['price']."')";
			$this->db->query($this->sQuery);
			$this->sQuery2="SELECT MAX(idx) as ridx from tbl_order";
			$this->recentOrder=$this->db->query($this->sQuery2)->row()->ridx;
			$this->sQuery3="UPDATE tbl_order set orderquantity=".$arrBasequantity[$i].", duedate=".$duedate.", destination='".$destination."' where idx='".$this->recentOrder."'";
			$this->db->query($this->sQuery3);
			$this->sQuery4="SELECT * from tbl_order as tbl1 JOIN tbl_stock as tbl2 JOIN tbl_company as tbl3 on tbl1.product=tbl2.idx and tbl1.company=tbl3.idx where tbl1.idx='".$this->recentOrder."'";
			$orderlist[$i]=$this->db->query($this->sQuery4)->result_array();
		}
		
		return $orderlist;

	}


	function sendEmail() {
		// alert('no');
		foreach ($this->input->post('arrIdx') as $index => $idx) {
			$arrIdx[] = addslashes(trim($idx));
			$arrBasequantity[] = addslashes(trim($this->input->post('arrBasequantity')[$index]));
			
		}

		$duedate =  addslashes(trim($this->input->post('duedate')));
		$destination =  addslashes(trim($this->input->post('destination')));
		
		if (empty($arrBasequantity) || empty($arrIdx)) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		}else{
			$this->sQuery="SELECT count(idx) as iCnt01 FROM tbl_cpuse where idx IN (".implode(',',$arrIdx).")";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			

			if($this->iCnt01!=0){
				$this->sQuery="SELECT tbl.* from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx asc"; //desc
				$arrData['arrResult'] = $this->db->query($this->sQuery)->result_array();
				
				// $this->sQuery="SELECT tbl.company, tbl.product, tbl.price from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx asc";
				$this->sQuery="SELECT tbl.* from tbl_cpuse as tbl where tbl.idx IN (".implode(',',$arrIdx).") order by idx asc";
				$arrCpuse=$this->db->query($this->sQuery)->result_array();

				if ($arrCpuse) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'이메일 주문이 완료되었습니다.', 'data'=>$arrData['arrResult']);
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'model에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}

				foreach ($arrData['arrResult'] as $index => $value) {
					$arrData['arrResult'][$index]['basequantity'] = $arrBasequantity[$index];
				}
				// $data['arrItem'] =$arrData['arrResult'];
				$this->no=0;
				$data['no']=$this->no;

				$this->orderlist=$this->saveOrder($this->iCnt01,$arrCpuse,$arrBasequantity,$duedate, $destination);
				$this->sQuery="SELECT * from email_view LIMIT ".$this->iCnt01;
				$data['arrItem']=$this->db->query($this->sQuery)->result_array();
				
				
				$arrPrice=[];
				$i=0;
				foreach($data['arrItem'] as $index=>$row){
					$defaultPrice = $row['orderprice'];
					$orderquantity = $row['orderquantity'];
					$supplyPrice = $defaultPrice * $orderquantity;
					$vat=$supplyPrice*0.1;
					$total=$supplyPrice+$vat;
					$arrPrice[$i]=$total;
				}
				$data['total']=$arrPrice;
				


				$this->load->library('email');
				//SMTP & mail configuration
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => '',
					'smtp_pass' => '',
					'mailtype'  => 'text',
					'charset'   => 'utf-8'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				// $this->email->set_crlf("\r\n");

				/*
					Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.
				*/




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
					fnAlertMsg($this->email->print_debugger(array('headers', 'subject', 'body')));
					// fnAlertMsg("메일발송이 실패하였습니다. 해당 문제가 지속될시 관리자에게 연락주세요");

				}
			}
		}
		return json_encode($arrRetMessage);	
		
	}

	function c_orderList(){
		// $arrData=$this->defaultSetting();
		$this->no = 0; // 표의 인덱스
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		
		$this->sid=$this->session->userdata("AdminIdx");
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM order_view as tbl1 where tbl1.idx='".$this->sid."'";
        $this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; 
		
        $this->sQuery="select distinct idx, companyname, productname, size, material, plated, orderquantity, orderprice, setnumber, orderdate, duedate, destination from order_view where idx='".$this->sid."' order by setnumber asc, orderdate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();

		$arrData['no']=$this->no;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		
		return $arrData;
	}
	
}
 
