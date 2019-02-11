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
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="tbl1.UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->companyidx=addslashes(trim($this->input->get('companyidx')));
		$this->warehouseidx=addslashes(trim($this->input->get('warehouseidx')));
		$this->sSearchUserType=addslashes(trim($this->input->get('sSearchUserType')));
		$this->sSearchAdminIdx=addslashes(trim($this->input->get('sSearchAdminIdx')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and ".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->companyidx) { $this->sWhere.=" and tbl1.cid='".$this->companyidx."' ";  }
		if ($this->warehouseidx) { $this->sWhere.=" and tbl1.wid='".$this->warehouseidx."' ";  }
		if ($this->sSearchUserType) { $this->sWhere.=" and tbl1.UserType='".$this->sSearchUserType."' ";  }
		if ($this->sSearchAdminIdx) { $this->sWhere.=" and tbl1.AdminIdx='".$this->sSearchAdminIdx."' ";  }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_company as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		// $this->sQuery="SELECT tbl1.* from company as tbl1 ".$this->sWhere." order by tbl1.company_id desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		// $arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		$this->sQuery="SELECT tbl1.* from tbl_company as tbl1";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		//$arrData['arrResult02']

		$this->sQuery="SELECT tbl1.* from tbl_warehouse as tbl1 order by tbl1.idx";
		$arrData['arrResult03']= $this->db->query($this->sQuery)->result_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['companyidx']=$this->companyidx;
		$arrData['warehouseidx']=$this->warehouseidx;
		$arrData['sSearchUserType']=$this->sSearchUserType;
		$arrData['sSearchAdminIdx']=$this->sSearchAdminIdx;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}



	function consultHistoryList1() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="tbl1.UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->companyidx=addslashes(trim($this->input->get('companyidx')));
		$this->warehouseidx=addslashes(trim($this->input->get('warehouseidx')));
		$this->sSearchUserType=addslashes(trim($this->input->get('sSearchUserType')));
		$this->sSearchAdminIdx=addslashes(trim($this->input->get('sSearchAdminIdx')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and ".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->companyidx) { $this->sWhere.=" and tbl1.cid='".$this->companyidx."' ";  }
		if ($this->warehouseidx) { $this->sWhere.=" and tbl1.wid='".$this->warehouseidx."' ";  }
		if ($this->sSearchUserType) { $this->sWhere.=" and tbl1.UserType='".$this->sSearchUserType."' ";  }
		if ($this->sSearchAdminIdx) { $this->sWhere.=" and tbl1.AdminIdx='".$this->sSearchAdminIdx."' ";  }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum; // 총 몇 줄인지 
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale; //  
		$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array(); // arrResult : 재고량

		// $this->sQuery="SELECT tbl1.* from tbl_company as tbl1 order by tbl1.idx";
		// $arrData['arrResult02']= $this->db->query($this->sQuery)->result_array(); // arrResult02 : 회사정보

		// $this->sQuery="SELECT tbl1.* from tbl_warehouse as tbl1 order by tbl1.idx";
		// $arrData['arrResult03']= $this->db->query($this->sQuery)->result_array(); // arrResult03 : 창고정보

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['companyidx']=$this->companyidx;
		$arrData['warehouseidx']=$this->warehouseidx;
		$arrData['sSearchUserType']=$this->sSearchUserType;
		$arrData['sSearchAdminIdx']=$this->sSearchAdminIdx;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//alltRfidList
	function alltRfidList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and ".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.nEventLogIdn) as iCnt FROM TB_EVENT_LOG_BK as tbl1 JOIN TB_EVENT_DATA as tbl2 ON tbl1.nEventIdn = tbl2.nEventIdn LEFT JOIN TB_USER as tbl3 ON tbl1.nUserID = tbl3.nUserIdn ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.nEventLogIdn as evtid, from_unixtime(tbl1.nDateTime) as evttime, tbl2.sName as evttype, tbl3.sUserName as evtname FROM TB_EVENT_LOG_BK as tbl1 JOIN TB_EVENT_DATA as tbl2 ON tbl1.nEventIdn = tbl2.nEventIdn LEFT JOIN TB_USER as tbl3 ON tbl1.nUserID = tbl3.nUserIdn ".$this->sWhere." order by evttime desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		$this->sQuery="SELECT tbl1.* FROM TB_EVENT_DATA as tbl1";
		$arrData['arrResult01']=$this->db->query($this->sQuery);

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	
	// print order
	function printOrder () {
		foreach ($this->input->post('arrIdx') as $index => $idx) {
			$arrIdx[] = addslashes(trim($idx));
			$arrBasequantity[] = addslashes(trim($this->input->post('arrBasequantity')[$index]));
		}
		if (empty($arrBasequantity) || empty($arrIdx)) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'empty array!');
		} else {
			// foreach ($arrIdx as $idx) {
			// }
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stock where idx IN (".implode(',',$arrIdx).")";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="SELECT tbl1.* from tbl_stock as tbl1 where tbl1.idx IN (".implode(',',$arrIdx).") order by idx desc";
				$arrData['arrResult'] = $this->db->query($this->sQuery)->result_array();
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'pass');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'model에서 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
				foreach ($arrData['arrResult'] as $index => $value) {
					$arrData['arrResult'][$index]['basequantity'] = $arrBasequantity[$index];
				}
				// $arrData['arrResult'][0]['basequantity'] = $this->basequantity;
				$data['arrItem'] = $arrData['arrResult'];
				$htmlContent = $this->load->view('forms/purchaseFormA4', $data, TRUE);
				$arrRetMessage['data'] = $htmlContent;
				//sendmail 진행
				//Load email library
			}
		return json_encode($arrRetMessage);
		}
	}
	
}
