<?php
class Settingsmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	//managerValid
	function managerValid() {
		$this->AdminId=addslashes(trim($this->input->get('AdminId')));
		$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_admin where AdminId='".$this->AdminId."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->iCnt=="0") {
			return "true";
		} else {
			return "false";
		}
	}
	//managerList
	function managerList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_admin as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_admin as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//managerCreate
	function managerCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//managerCreateProc
	function managerCreateProc() {
		$this->AdminName=addslashes($this->input->post('AdminName'));
		$this->AdminId=addslashes($this->input->post('AdminId'));
		$this->AdminPwd=addslashes($this->input->post('AdminPwd'));
		$this->AdminRole=addslashes($this->input->post('AdminRole'));
		$this->AdminPosition=addslashes($this->input->post('AdminPosition'));
		$this->arrAdminPermission=$this->input->post('AdminPermission');
		$this->AdminPermission="";
		if (is_array($this->arrAdminPermission)) {
			for ($iCnt=0;$iCnt<count($this->arrAdminPermission);$iCnt++) {
				$this->AdminPermission.=$this->arrAdminPermission[$iCnt]."||";
			}
		}
		$this->AdminIP01=addslashes($this->input->post('AdminIP01'));
		$this->AdminIP02=addslashes($this->input->post('AdminIP02'));
		$this->sQuery="insert into tbl_admin (AdminName,AdminId,AdminPwd,AdminRole,AdminPosition,AdminPermission,AdminIP01,AdminIP02) values ('".$this->AdminName."','".$this->AdminId."','".md5($this->AdminPwd)."','".$this->AdminRole."','".$this->AdminPosition."','".$this->AdminPermission."','".$this->AdminIP01."','".$this->AdminIP02."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/managerList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//managerDelProc
	function managerDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_admin where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'관리자 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//managerModify
	function managerModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_admin as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrPermission'] = explode("||",$arrData['arrResult']->AdminPermission);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//managerModifyProc
	function managerModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->AdminName=addslashes($this->input->post('AdminName'));
		$this->AdminId=addslashes($this->input->post('AdminId'));
		$this->AdminPwd=addslashes($this->input->post('AdminPwd'));
		$this->AdminRole=addslashes($this->input->post('AdminRole'));
		$this->AdminPosition=addslashes($this->input->post('AdminPosition'));
		$this->arrAdminPermission=$this->input->post('AdminPermission');
		$this->AdminPermission="";
		if (is_array($this->arrAdminPermission)) {
			for ($iCnt=0;$iCnt<count($this->arrAdminPermission);$iCnt++) {
				$this->AdminPermission.=$this->arrAdminPermission[$iCnt]."||";
			}
		}
		$this->AdminIP01=addslashes($this->input->post('AdminIP01'));
		$this->AdminIP02=addslashes($this->input->post('AdminIP02'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQueryAdd="";
		if ($this->AdminPwd!="") {
			$this->sQueryAdd.="',AdminPwd='".md5($this->AdminPwd);
		}
		if ($this->AdminRole=="9") {
			$this->AdminPermission="";
		}

		$this->sQuery="update tbl_admin set AdminName='".$this->AdminName."',AdminRole='".$this->AdminRole."',AdminPosition='".$this->AdminPosition."',AdminPermission='".$this->AdminPermission."',AdminIP01='".$this->AdminIP01."',AdminIP02='".$this->AdminIP02."'".$this->sQueryAdd." where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/managerModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainPage
	function mainPage() {
		$this->sQuery="SELECT tbl1.IncFile01,tbl1.IncFile02,tbl1.IncFile03 FROM tbl_main as tbl1 where tbl1.Idx='1'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainPageModify
	function mainPageModify() {
		$this->sQuery="SELECT tbl1.Idx,tbl1.IncFile01,tbl1.IncFile02,tbl1.IncFile03 FROM tbl_main as tbl1 where tbl1.Idx='1'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainPageModifyProc
	function mainPageModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder01);
		$this->NewIncFile01=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile02",sUploadFolder01);
		$this->NewIncFile02=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile03",sUploadFolder01);
		$this->NewIncFile03=$this->arrRetFile[0];
		$this->sQuery="select IncFile01,IncFile02,IncFile03 from tbl_main where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->IncFile01=$this->arrResult->IncFile01;
			$this->IncFile02=$this->arrResult->IncFile02;
			$this->IncFile03=$this->arrResult->IncFile03;
		} else {
			$this->IncFile01="";
			$this->IncFile02="";
			$this->IncFile03="";
		}
		if ($this->NewIncFile01!="") { $this->IncFile01=$this->NewIncFile01; }
		if ($this->NewIncFile02!="") { $this->IncFile02=$this->NewIncFile02; }
		if ($this->NewIncFile03!="") { $this->IncFile03=$this->NewIncFile03; }
		$this->sQuery="update tbl_main set IncFile01='".$this->IncFile01."',IncFile02='".$this->IncFile02."',IncFile03='".$this->IncFile03."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/mainPageModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//agreementList
	function agreementList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_agreement as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_agreement as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//agreementCreate
	function agreementCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//agreementCreateProc
	function agreementCreateProc() {
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->sQuery="insert into tbl_agreement (Title,Contents) values ('".$this->Title."','".$this->Contents."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/agreementList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//agreementModify
	function agreementModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_agreement as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//agreementModifyProc
	function agreementModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_agreement set Title='".$this->Title."',Contents='".$this->Contents."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/agreementModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//agreementDelProc
	function agreementDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_agreement where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'약관 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//categoryList
	function categoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 20;
		$this->iStepScale = 5;
		$this->sWhere="where DelYn='N' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_category as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_category as tbl1 ".$this->sWhere." order by tbl1.Sort asc,tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//categoryCreate
	function categoryCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//categoryCreateProc
	function categoryCreateProc() {
		$this->CategoryName=addslashes($this->input->post('CategoryName'));
		$this->CategoryCode=addslashes($this->input->post('CategoryCode'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->CategoryColor=addslashes($this->input->post('CategoryColor'));
		$this->UseYn=addslashes($this->input->post('UseYn'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		//기존의 카테고리 코드 검색
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 from tbl_category as tbl1 where CategoryCode='".$this->CategoryCode."'";
		$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
		if ($this->iCnt01!=0) {
			fnAlertMsg("이미 가입되어있는 카테고리 코드입니다.");
		} else {
			$this->db->trans_start(); //트랜잭션 시작
			$this->sQuery="SELECT ifnull(AUTO_INCREMENT,0) as IdentIdx FROM information_schema.tables WHERE table_name = 'tbl_category' AND table_schema = DATABASE()";
			$this->ParentIdx=$this->db->query($this->sQuery)->row()->IdentIdx;
			$this->sQuery="insert into tbl_category (CategoryName,CategoryCode,Sort,CategoryColor,UseYn) values ('".$this->CategoryName."','".$this->CategoryCode."','".$this->Sort."','".$this->CategoryColor."','".$this->UseYn."')";
			$this->db->query($this->sQuery);
			if (is_array($this->arrIncImage)) {
				$this->sCheckFile = array("jpg","png","gif","jpeg");
				for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
					$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
					$this->sValue02=array_pop($this->arrValue01);
					$this->sFileNameExt=strtolower($this->sValue02);
					if(in_array($this->sFileNameExt,$this->sCheckFile)) {
						$this->FileType="P";
					} else {
						$this->FileType="F";
					}
					$this->sQuery="INSERT INTO tbl_category_file (ParentIdx,FileName,FileType) VALUES ('".$this->ParentIdx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
					$this->db->query($this->sQuery);
				}
			}
			$this->db->trans_complete();//트랜잭션 끝
			if ($this->db->trans_status() === FALSE) {
				echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
			} else {
				redirect(sSiteUrl.'/settings/categoryList','refresh');
			}
		}
	}
	//categorySortValid
	function categorySortValid() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->Sort=addslashes(trim($this->input->get('Sort')));
		if ($this->Idx) {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_category where DelYn='N' and Sort='".$this->Sort."' and Idx!='".$this->Idx."'";
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_category where DelYn='N' and Sort='".$this->Sort."'";
		}
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->iCnt=="0") {
			echo "true";
		} else {
			echo "false";
		}
	}
	//categoryModify
	function categoryModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_category as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_category_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['iMaxFiles01']=10-$arrData['iFileCnt01'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//categoryModifyProc
	function categoryModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->CategoryName=addslashes($this->input->post('CategoryName'));
		$this->CategoryCode=addslashes($this->input->post('CategoryCode'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->CategoryColor=addslashes($this->input->post('CategoryColor'));
		$this->UseYn=addslashes($this->input->post('UseYn'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_category set CategoryName='".$this->CategoryName."',CategoryCode='".$this->CategoryCode."',Sort='".$this->Sort."',CategoryColor='".$this->CategoryColor."',UseYn='".$this->UseYn."' where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_category_file (ParentIdx,FileName,FileType) VALUES ('".$this->Idx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/categoryModify".$this->sParam,'refresh');
		}
	}
	//categoryDelProc
	function categoryDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="update tbl_category set DelYn='Y' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'카테고리 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//categoryFileDelProc
	function categoryFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_category_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_category_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//registItemList
	function registItemList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 20;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_regist_item as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,(select count(Idx) as iCnt01 from tbl_regist_item_option where ParentIdx=tbl1.Idx) as iCnt01 FROM tbl_regist_item as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//registItemCreateProc
	function registItemCreateProc() {
		$this->Category=addslashes($this->input->post('Category'));
		$this->ItemName=addslashes($this->input->post('ItemName'));
		$this->sQuery="insert into tbl_regist_item (Category,ItemName) values ('".$this->Category."','".$this->ItemName."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/registItemList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//registItemDelProc
	function registItemDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_regist_item where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'가입정보가 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//registItemModify
	function registItemModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_regist_item as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//registItemModifyProc
	function registItemModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Category=addslashes($this->input->post('Category'));
		$this->ItemName=addslashes($this->input->post('ItemName'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_regist_item set Category='".$this->Category."',ItemName='".$this->ItemName."' where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		$sRetUrl=sSiteUrl."/settings/registItemList".$this->sParam;
		redirect($sRetUrl,'refresh');
	}
	//registItemSub
	function registItemSub() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->ParentIdx=addslashes($this->input->get('Idx'));
		$this->sWhere="where ParentIdx='".$this->ParentIdx."' ";
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_regist_item_option as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iNum']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM tbl_regist_item_option as tbl1 ".$this->sWhere." order by tbl1.Sort asc,tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		$arrData['ParentIdx']=$this->ParentIdx;
		return $arrData;
	}
	//registItemSortValid
	function registItemSortValid() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->Sort=addslashes(trim($this->input->get('Sort')));
		$this->ParentIdx=addslashes(trim($this->input->get('ParentIdx')));
		if ($this->Idx) {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_regist_item_option where ParentIdx='".$this->ParentIdx."' and Sort='".$this->Sort."' and Idx!='".$this->Idx."'";
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_regist_item_option where ParentIdx='".$this->ParentIdx."' and Sort='".$this->Sort."'";
		}
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->iCnt=="0") {
			echo "true";
		} else {
			echo "false";
		}
	}
	//registItemSubCreateProc
	function registItemSubCreateProc() {
		$this->ParentIdx=addslashes($this->input->post('ParentIdx'));
		$this->OptionName=addslashes($this->input->post('OptionName'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="insert into tbl_regist_item_option (ParentIdx,OptionName,Sort) values ('".$this->ParentIdx."','".$this->OptionName."','".$this->Sort."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$sRetUrl=sSiteUrl."/settings/registItemSub".$this->sParam;
			redirect($sRetUrl,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//registItemSubDelProc
	function registItemSubDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_regist_item_option where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'가입정보 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//registItemSubModify
	function registItemSubModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_regist_item_option as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//registItemSubModifyProc
	function registItemSubModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->OptionName=addslashes($this->input->post('OptionName'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_regist_item_option set OptionName='".$this->OptionName."',Sort='".$this->Sort."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/registItemSub".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//bannerList
	function bannerList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sBannerType01=addslashes(trim($this->input->get('sBannerType01')));
		$this->sBannerType02=addslashes(trim($this->input->get('sBannerType02')));
		$this->sBannerType03=addslashes(trim($this->input->get('sBannerType03')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sBannerType01) {
			$this->sWhere.=" and tbl1.BannerType01='".$this->sBannerType01."' ";
		}
		if ($this->sBannerType02) {
			$this->sWhere.=" and tbl1.BannerType02='".$this->sBannerType02."' ";
		}
		if ($this->sBannerType03) {
			$this->sWhere.=" and tbl1.BannerType03='".$this->sBannerType03."' ";
		}

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_banner as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_banner as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sBannerType01']=$this->sBannerType01;
		$arrData['sBannerType02']=$this->sBannerType02;
		$arrData['sBannerType03']=$this->sBannerType03;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//bannerCreate
	function bannerCreate() {
		$this->sQuery="select * from tbl_category where DelYn='N' order by Sort asc";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//bannerCreateProc
	function bannerCreateProc() {
		$this->BannerType01=addslashes($this->input->post('BannerType01'));
		$this->BannerType02=addslashes($this->input->post('BannerType02'));
		$this->BannerType03=addslashes($this->input->post('BannerType03'));
		$this->BannerTypeStage=addslashes($this->input->post('BannerTypeStage'));
		$this->BannerTypeUser=addslashes($this->input->post('BannerTypeUser'));
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->BannerImage=$this->arrRetFile[0];

		$this->sQuery="insert into tbl_banner (BannerType01,BannerType02,BannerType03,BannerTypeStage,BannerTypeUser,BannerTitle,BannerUrl,BannerImage,BannerStartDate,BannerEndDate,BannerUseYn,NewWindowYn) values ('".$this->BannerType01."','".$this->BannerType02."','".$this->BannerType03."','".$this->BannerTypeStage."','".$this->BannerTypeUser."','".$this->BannerTitle."','".$this->BannerUrl."','".$this->BannerImage."','".$this->BannerStartDate."','".$this->BannerEndDate."','".$this->BannerUseYn."','".$this->NewWindowYn."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/bannerList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}

	}
	//bannerDelProc
	function bannerDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_banner where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'배너 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//bannerModify
	function bannerModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_banner as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$this->sQuery="select * from tbl_category where DelYn='N' order by Sort asc";
		$arrData['arrResult02']=$this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//bannerModifyProc
	function bannerModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->BannerType01=addslashes($this->input->post('BannerType01'));
		$this->BannerType02=addslashes($this->input->post('BannerType02'));
		$this->BannerType03=addslashes($this->input->post('BannerType03'));
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->NewBannerImage=$this->arrRetFile[0];
		$this->sQuery="select BannerImage from tbl_banner where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->BannerImage=$this->arrResult->BannerImage;
		} else {
			$this->BannerImage="";
		}
		if ($this->NewBannerImage!="") { $this->BannerImage=$this->NewBannerImage; }
		$this->sQuery="update tbl_banner set BannerType01='".$this->BannerType01."',BannerType02='".$this->BannerType02."',BannerType03='".$this->BannerType03."',BannerTitle='".$this->BannerTitle."',BannerUrl='".$this->BannerUrl."',BannerImage='".$this->BannerImage."',BannerStartDate='".$this->BannerStartDate."',BannerEndDate='".$this->BannerEndDate."',BannerUseYn='".$this->BannerUseYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/bannerModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//popupList
	function popupList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_popup as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_popup as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//popupCreate
	function popupCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//popupCreateProc
	function popupCreateProc() {
		$this->PopupStyle=addslashes($this->input->post('PopupStyle'));
		$this->PopupTitle=addslashes($this->input->post('PopupTitle'));
		$this->PopupUrl=addslashes($this->input->post('PopupUrl'));
		$this->PopupStartDate=addslashes($this->input->post('PopupStartDate'));
		$this->PopupEndDate=addslashes($this->input->post('PopupEndDate'));
		$this->PopupStartTime=$this->input->post('PopupStartTime');
		$this->PopupWidth=addslashes($this->input->post('PopupWidth'));
		$this->PopupHeight=addslashes($this->input->post('PopupHeight'));
		$this->PopupTop=addslashes($this->input->post('PopupTop'));
		$this->PopupLeft=addslashes($this->input->post('PopupLeft'));
		$this->PopupUseYn=addslashes($this->input->post('PopupUseYn'));
		$this->PopupScrollYn=addslashes($this->input->post('PopupScrollYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("PopupImage",sUploadFolder01);
		$this->PopupImage=$this->arrRetFile[0];

		$this->sQuery="insert into tbl_popup (PopupStyle,PopupTitle,PopupUrl,PopupStartDate,PopupEndDate,PopupStartTime,PopupImage,PopupWidth,PopupHeight,PopupTop,PopupLeft,PopupUseYn,PopupScrollYn,NewWindowYn) values ('".$this->PopupStyle."','".$this->PopupTitle."','".$this->PopupUrl."','".$this->PopupStartDate."','".$this->PopupEndDate."','".$this->PopupStartTime."','".$this->PopupImage."','".$this->PopupWidth."','".$this->PopupHeight."','".$this->PopupTop."','".$this->PopupLeft."','".$this->PopupUseYn."','".$this->PopupScrollYn."','".$this->NewWindowYn."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/popupList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//popupDelProc
	function popupDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_popup where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'팝업 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//popupModify
	function popupModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_popup as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//popupModifyProc
	function popupModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->PopupStyle=addslashes($this->input->post('PopupStyle'));
		$this->PopupTitle=addslashes($this->input->post('PopupTitle'));
		$this->PopupUrl=addslashes($this->input->post('PopupUrl'));
		$this->PopupStartDate=addslashes($this->input->post('PopupStartDate'));
		$this->PopupEndDate=addslashes($this->input->post('PopupEndDate'));
		$this->PopupStartTime=$this->input->post('PopupStartTime');
		$this->PopupWidth=addslashes($this->input->post('PopupWidth'));
		$this->PopupHeight=addslashes($this->input->post('PopupHeight'));
		$this->PopupTop=addslashes($this->input->post('PopupTop'));
		$this->PopupLeft=addslashes($this->input->post('PopupLeft'));
		$this->PopupUseYn=addslashes($this->input->post('PopupUseYn'));
		$this->PopupScrollYn=addslashes($this->input->post('PopupScrollYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));

		$this->arrRetFile=$this->utilmodel->do_upload("PopupImage",sUploadFolder01);
		$this->NewPopupImage=$this->arrRetFile[0];
		$this->sQuery="select PopupImage from tbl_popup where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->PopupImage=$this->arrResult->PopupImage;
		} else {
			$this->PopupImage="";
		}
		if ($this->NewPopupImage!="") { $this->PopupImage=$this->NewPopupImage; }
		$this->sQuery="update tbl_popup set PopupTitle='".$this->PopupTitle."',PopupUrl='".$this->PopupUrl."',PopupStartDate='".$this->PopupStartDate."',PopupEndDate='".$this->PopupEndDate."',PopupStartTime='".$this->PopupStartTime."',PopupImage='".$this->PopupImage."',PopupWidth='".$this->PopupWidth."',PopupHeight='".$this->PopupHeight."',PopupTop='".$this->PopupTop."',PopupLeft='".$this->PopupLeft."',PopupUseYn='".$this->PopupUseYn."',PopupScrollYn='".$this->PopupScrollYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/popupModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//holiday
	function holiday() {
		$this->sQuery="SELECT tbl1.* FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		return $arrData;
	}
	//holidayModifyProc
	function holidayModifyProc() {
		$this->Holiday=addslashes($this->input->post('Holiday'));
		$this->sQuery="update tbl_holiday set Holiday='".$this->Holiday."' where Idx='1'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/holiday','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}

	//bankAccount
	function bankAccount() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 20;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_bank_account as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_bank_account as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//bankAccountCreateProc
	function bankAccountCreateProc() {
		$this->BankName=addslashes($this->input->post('BankName'));
		$this->BankAccount=addslashes($this->input->post('BankAccount'));
		$this->BankOwner=addslashes($this->input->post('BankOwner'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="insert into tbl_bank_account (BankName,BankAccount,BankOwner) values ('".$this->BankName."','".$this->BankAccount."','".$this->BankOwner."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$sRetUrl=sSiteUrl."/settings/bankAccount".$this->sParam;
			redirect($sRetUrl,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//bankAccountModify
	function bankAccountModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_bank_account as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//bankAccountModifyProc
	function bankAccountModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->BankName=addslashes($this->input->post('BankName'));
		$this->BankAccount=addslashes($this->input->post('BankAccount'));
		$this->BankOwner=addslashes($this->input->post('BankOwner'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_bank_account set BankName='".$this->BankName."',BankAccount='".$this->BankAccount."',BankOwner='".$this->BankOwner."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/bankAccount".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//bankAccountDelProc
	function bankAccountDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_bank_account where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'계좌 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}

	//inquiryList
	function inquiryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_inquiryList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_inquiryList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//inquiryDelProc
	function inquiryDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_qna where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'문의내용 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//inquiryReply
	function inquiryReply() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName,tbl2.UserId FROM tbl_qna as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//inquiryReplyProc
	function inquiryReplyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Reply=addslashes($this->input->post('Reply'));
		$this->State=addslashes($this->input->post('State'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sAddQuery="";
		if ($this->State=="Y") {
			$this->sAddQuery.=",ReplyDate=now()";
		} else {
			$this->sAddQuery.=",ReplyDate=''";
		}
		$this->sQuery="update tbl_qna set Reply='".$this->Reply."',State='".$this->State."'".$this->sAddQuery." where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/inquiryReply".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//noticeList
	function noticeList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchCategory=addslashes(trim($this->input->get('sSearchCategory')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere01=" where tbl1.BoardConfIdx='1' and tbl1.TopYn='Y' ";
		$this->sWhere02=" where tbl1.BoardConfIdx='1' and tbl1.TopYn='N' ";
		if ($this->sSearchCategory) {
			$this->sWhere01.=" and tbl1.Category='".$this->sSearchCategory."' ";
			$this->sWhere02.=" and tbl1.Category='".$this->sSearchCategory."' ";
		}
		$this->sQuery="SELECT * FROM tbl_board as tbl1 ".$this->sWhere01." order by tbl1.Idx desc";
		$arrData['arrResult01']= $this->db->query($this->sQuery);

		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere02.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_board as tbl1 ".$this->sWhere02;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_board as tbl1 ".$this->sWhere02." order by tbl1.Category asc,tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchCategory']=$this->sSearchCategory;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//noticeCreate
	function noticeCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//noticeCreateProc
	function noticeCreateProc() {
		//$this->BoardConfIdx=addslashes($this->input->post('BoardConfIdx'));
		$this->BoardConfIdx="1";
		$this->Title=addslashes($this->input->post('Title'));
		$this->TopYn=addslashes($this->input->post('TopYn'));
		$this->Category=addslashes($this->input->post('Category'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="SELECT ifnull(AUTO_INCREMENT,0) as IdentIdx FROM information_schema.tables WHERE table_name = 'tbl_board' AND table_schema = DATABASE()";
		$this->ParentIdx=$this->db->query($this->sQuery)->row()->IdentIdx;
		$this->sQuery="insert into tbl_board (BoardConfIdx,TopYn,Title,Contents,Category,Summary) values ('".$this->BoardConfIdx."','".$this->TopYn."','".$this->Title."','".$this->Contents."','".$this->Category."','".$this->Summary."')";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_board_file (ParentIdx,FileName,FileType) VALUES ('".$this->ParentIdx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl.'/settings/noticeList','refresh');
		}
	}
	//noticeDelProc
	function noticeDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_board where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'글 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//noticeModify
	function noticeModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_board as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_board_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['iMaxFiles01']=3-$arrData['iFileCnt01'];
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_board_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles02']=3-$arrData['iFileCnt02'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//noticeModifyProc
	function noticeModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->TopYn=addslashes($this->input->post('TopYn'));
		$this->Category=addslashes($this->input->post('Category'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_board set Title='".$this->Title."',TopYn='".$this->TopYn."',Category='".$this->Category."',Contents='".$this->Contents."',Summary='".$this->Summary."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_board_file (ParentIdx,FileName,FileType) VALUES ('".$this->Idx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/noticeModify".$this->sParam,'refresh');
		}
	}
	//noticeFileDelProc
	function noticeFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_board_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_board_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//pressList
	function pressList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sQuery="SELECT * FROM tbl_press as tbl1 where tbl1.TopYn='Y' order by tbl1.Idx desc";
		$arrData['arrResult01']= $this->db->query($this->sQuery);
		$this->sWhere="where tbl1.TopYn='N' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_press as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_press  as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//pressCreate
	function pressCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//pressCreateProc
	function pressCreateProc() {
		$this->TopYn=addslashes($this->input->post('TopYn'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Press=addslashes($this->input->post('Press'));
		$this->Link=addslashes($this->input->post('Link'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->ViewDate=addslashes($this->input->post('ViewDate'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile",sUploadFolder01);
		$this->IncFile=$this->arrRetFile[0];
		$this->sQuery="insert into tbl_press (TopYn,Title,Press,Link,Summary,ViewDate,IncFile) values ('".$this->TopYn."','".$this->Title."','".$this->Press."','".$this->Link."','".$this->Summary."','".$this->ViewDate."','".$this->IncFile."')";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/pressList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//pressModify
	function pressModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_press as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row_array();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrResult']=array_map('htmlspecialchars',$arrData['arrResult']);

		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//pressModifyProc
	function pressModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->TopYn=addslashes($this->input->post('TopYn'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Press=addslashes($this->input->post('Press'));
		$this->Link=addslashes($this->input->post('Link'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->ViewDate=addslashes($this->input->post('ViewDate'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile",sUploadFolder01);
		$this->NewIncFile=$this->arrRetFile[0];
		$this->sQuery="select IncFile from tbl_press where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->IncFile=$this->arrResult->IncFile;
		} else {
			$this->IncFile="";
		}
		if ($this->NewIncFile!="") { $this->IncFile=$this->NewIncFile; }
		$this->sQuery="update tbl_press set TopYn='".$this->TopYn."',Title='".$this->Title."',Press='".$this->Press."',Link='".$this->Link."',Summary='".$this->Summary."',ViewDate='".$this->ViewDate."',IncFile='".$this->IncFile."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/pressModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//pressDelProc
	function pressDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_press where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'게시글 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//faqList
	function faqList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sCategory=addslashes(trim($this->input->get('sCategory')));
		$this->iPageScale = 20;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sCategory) {
			$this->sWhere.=" and tbl1.Category='".$this->sCategory."' ";
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_faq as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_faq as tbl1 ".$this->sWhere." order by tbl1.Category asc,tbl1.Sort asc,tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sCategory']=$this->sCategory;

		$arrData['sParam']=fnParam();
		return $arrData;

	}
	//faqCreate
	function faqCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//faqCreateProc
	function faqCreateProc() {
		$this->Category=addslashes($this->input->post('Category'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="SELECT ifnull(AUTO_INCREMENT,0) as IdentIdx FROM information_schema.tables WHERE table_name = 'tbl_faq' AND table_schema = DATABASE()";
		$this->ParentIdx=$this->db->query($this->sQuery)->row()->IdentIdx;
		$this->sQuery="insert into tbl_faq (Title,Contents,Category,Sort) values ('".$this->Title."','".$this->Contents."','".$this->Category."','".$this->Sort."')";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_faq_file (ParentIdx,FileName,FileType) VALUES ('".$this->ParentIdx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl.'/settings/faqList','refresh');
		}

	}
	//faqSortValid
	function faqSortValid() {
		$this->Category=addslashes(trim($this->input->get('Category')));
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->Sort=addslashes(trim($this->input->get('Sort')));
		if ($this->Idx) {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_faq where Category='".$this->Category."' and Sort='".$this->Sort."' and Idx!='".$this->Idx."'";
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_faq where Category='".$this->Category."' and Sort='".$this->Sort."'";
		}
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->iCnt=="0") {
			echo "true";
		} else {
			echo "false";
		}
	}
	//faqDelProc
	function faqDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_faq where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'이용안내 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//faqModify
	function faqModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_faq as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_faq_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['iMaxFiles01']=3-$arrData['iFileCnt01'];
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_faq_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles02']=3-$arrData['iFileCnt02'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//faqModifyProc
	function faqModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Category=addslashes($this->input->post('Category'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_faq set Title='".$this->Title."',Category='".$this->Category."',Contents='".$this->Contents."',Sort='".$this->Sort."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_faq_file (ParentIdx,FileName,FileType) VALUES ('".$this->Idx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/faqModify".$this->sParam,'refresh');
		}
	}
	//faqFileDelProc
	function faqFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_faq_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_faq_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//smsSearchList
	function smsSearchList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->sSearchUserSMSYn=addslashes(trim($this->input->get('sSearchUserSMSYn')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserTel like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
		}
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->sSearchUserSMSYn) { $this->sWhere.=" and tbl1.UserSMSYn='".$this->sSearchUserSMSYn."' ";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_smsSearchList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_smsSearchList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['sSearchUserSMSYn']=$this->sSearchUserSMSYn;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//smsSearchListExcel
	function smsSearchListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->sSearchUserSMSYn=addslashes(trim($this->input->get('sSearchUserSMSYn')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserTel like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
		}
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->sSearchUserSMSYn) { $this->sWhere.=" and tbl1.UserSMSYn='".$this->sSearchUserSMSYn."' ";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_smsSearchList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_smsSearchList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['sSearchUserSMSYn']=$this->sSearchUserSMSYn;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('회원리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원명');
		$this->excel->getActiveSheet()->setCellValue('C1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('D1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('E1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('F1', '수신동의');

		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserTel,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserSMSYn,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':F'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="SMS대상_리스트_".date("Y-m-d");
		$sFileName.=".xls";
		$sFileName02= iconv("utf-8","euc-kr",$sFileName);
		//다운내역 저장
		$this->sQuery="insert into tbl_sms_history (AdminName,FileName,UserNum) values ('".$this->session->userdata("AdminName")."','".$sFileName."','".$this->iNum."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName02.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		$objWriter->save('php://output');
	}
	//smsHistoryList
	function smsHistoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_sms_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_sms_history as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mailSearchList
	function mailSearchList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->sSearchUserEmailYn=addslashes(trim($this->input->get('sSearchUserEmailYn')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserTel like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
		}
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->sSearchUserEmailYn) { $this->sWhere.=" and tbl1.UserEmailYn='".$this->sSearchUserEmailYn."' ";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_mailSearchList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_mailSearchList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['sSearchUserEmailYn']=$this->sSearchUserEmailYn;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mailSearchListExcel
	function mailSearchListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->sSearchUserEmailYn=addslashes(trim($this->input->get('sSearchUserEmailYn')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserTel like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
		}
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->sSearchUserEmailYn) { $this->sWhere.=" and tbl1.UserEmailYn='".$this->sSearchUserEmailYn."' ";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_mailSearchList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_mailSearchList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['sSearchUserEmailYn']=$this->sSearchUserEmailYn;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('회원리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원명');
		$this->excel->getActiveSheet()->setCellValue('C1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('D1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('E1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('F1', '수신동의');

		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserTel,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserEmailYn,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':F'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="메일_대상_리스트_".date("Y-m-d");
		$sFileName.=".xls";
		$sFileName02= iconv("utf-8","euc-kr",$sFileName);
		//다운내역 저장
		$this->sQuery="insert into tbl_mail_history (AdminName,FileName,UserNum) values ('".$this->session->userdata("AdminName")."','".$sFileName."','".$this->iNum."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName02.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다.
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		$objWriter->save('php://output');

	}

	//mailHistoryList
	function mailHistoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_mail_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_mail_history as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//insightList
	function insightList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchCategory=addslashes(trim($this->input->get('sSearchCategory')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchCategory) { $this->sWhere.=" and tbl1.Category='".$this->sSearchCategory."' "; }
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_insightList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_insightList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="SELECT * FROM tbl_insight_category order by Sort asc,Idx desc ";
		$arrData['arrCategory']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchCategory']=$this->sSearchCategory;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//insightCreate
	function insightCreate() {
		$this->sQuery="SELECT * FROM tbl_insight_category order by Sort asc,Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//insightCreateProc
	function insightCreateProc() {
		$this->Category=addslashes($this->input->post('Category'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents01=addslashes($this->input->post('Contents01'));
		$this->Contents02=addslashes($this->input->post('Contents02'));
		$this->Contents03=addslashes($this->input->post('Contents03'));
		$this->Contents04=addslashes($this->input->post('Contents04'));
		$this->Contents05=addslashes($this->input->post('Contents05'));
		$this->Contents06=addslashes($this->input->post('Contents06'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder01);
		$this->IncFile01=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile02",sUploadFolder01);
		$this->IncFile02=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile03",sUploadFolder01);
		$this->IncFile03=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile04",sUploadFolder01);
		$this->IncFile04=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile05",sUploadFolder01);
		$this->IncFile05=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile06",sUploadFolder01);
		$this->IncFile06=$this->arrRetFile[0];
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="SELECT ifnull(AUTO_INCREMENT,0) as IdentIdx FROM information_schema.tables WHERE table_name = 'tbl_insight' AND table_schema = DATABASE()";
		$this->ParentIdx=$this->db->query($this->sQuery)->row()->IdentIdx;
		$this->sQuery="insert into tbl_insight (Category,Title,Contents01,Contents02,Contents03,Contents04,Contents05,Contents06,IncFile01,IncFile02,IncFile03,IncFile04,IncFile05,IncFile06,AdminYn) values ('".$this->Category."','".$this->Title."','".$this->Contents01."','".$this->Contents02."','".$this->Contents03."','".$this->Contents04."','".$this->Contents05."','".$this->Contents06."','".$this->IncFile01."','".$this->IncFile02."','".$this->IncFile03."','".$this->IncFile04."','".$this->IncFile05."','".$this->IncFile06."','Y')";
		$this->db->query($this->sQuery);
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl.'/settings/insightList','refresh');
		}
	}
	//insightDelProc
	function insightDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_insight where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'글 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}

	//insightView
	function insightView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		if ($this->Idx=="") {
			fnAlertMsg("잘못된 접근입니다.");
		}
		$this->sSearchCategory=addslashes(trim($this->input->get('sSearchCategory')));
		if ($this->sSearchCategory=="") {
			$this->sQuery="SELECT tbl1.Idx FROM tbl_insight_category as tbl1 order by tbl1.Sort asc,tbl1.Idx desc limit 0,1";
			$arrData['arrResult']= $this->db->query($this->sQuery)->row();
			if ($arrData['arrResult']) {
				$this->sSearchCategory=$arrData['arrResult']->Idx;
			}
		}
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));

		$this->sQuery="update tbl_insight set ReadCnt=ReadCnt+1 where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM front_insightList as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }

		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_insight_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['iMaxFiles01']=3-$arrData['iFileCnt01'];
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName,tbl1.RegDate from tbl_insight_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles02']=3-$arrData['iFileCnt02'];
		$this->sQuery="SELECT tbl1.*,(select count(Idx) as iCnt01 from tbl_insight where Category=tbl1.Idx) as iCnt01 FROM tbl_insight_category as tbl1 order by tbl1.Sort asc,tbl1.Idx desc ";
		$arrData['arrCategory']= $this->db->query($this->sQuery);
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchCategory) { $this->sWhere.=" and tbl1.Category='".$this->sSearchCategory."' "; }
		$this->sQuery="SELECT tbl1.* FROM front_insightList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT 0,5";
		$arrData['arrLeftList']= $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName,tbl2.UserPhoto FROM tbl_insight_comment as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx where ParentIdx='".$this->Idx."' order by tbl1.Idx asc ";
		$arrData['arrCommentList']= $this->db->query($this->sQuery);
		$arrData['sSearchCategory']=$this->sSearchCategory;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}

	//insightModify
	function insightModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_insight as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_insight_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_insight_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles']=10-$arrData['iFileCnt01']-$arrData['iFileCnt02'];
		$this->sQuery="SELECT * FROM tbl_insight_category order by Sort asc,Idx desc ";
		$arrData['arrCategory']= $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//insightFileDelProc
	function insightFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_insight_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_insight_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//insightModifyProc
	function insightModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->Category=addslashes($this->input->post('Category'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents01=addslashes($this->input->post('Contents01'));
		$this->Contents02=addslashes($this->input->post('Contents02'));
		$this->Contents03=addslashes($this->input->post('Contents03'));
		$this->Contents04=addslashes($this->input->post('Contents04'));
		$this->Contents05=addslashes($this->input->post('Contents05'));
		$this->Contents06=addslashes($this->input->post('Contents06'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder01);
		$this->NewIncFile01=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile02",sUploadFolder01);
		$this->NewIncFile02=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile03",sUploadFolder01);
		$this->NewIncFile03=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile04",sUploadFolder01);
		$this->NewIncFile04=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile05",sUploadFolder01);
		$this->NewIncFile05=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile06",sUploadFolder01);
		$this->NewIncFile06=$this->arrRetFile[0];
		$this->sQuery="select IncFile01,IncFile02,IncFile03,IncFile04,IncFile05,IncFile06 from tbl_insight where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->IncFile01=$this->arrResult->IncFile01;
			$this->IncFile02=$this->arrResult->IncFile02;
			$this->IncFile03=$this->arrResult->IncFile03;
			$this->IncFile04=$this->arrResult->IncFile04;
			$this->IncFile05=$this->arrResult->IncFile05;
			$this->IncFile06=$this->arrResult->IncFile06;
		} else {
			$this->IncFile01="";
			$this->IncFile02="";
			$this->IncFile03="";
			$this->IncFile04="";
			$this->IncFile05="";
			$this->IncFile06="";
		}
		if ($this->NewIncFile01!="") { $this->IncFile01=$this->NewIncFile01; }
		if ($this->NewIncFile02!="") { $this->IncFile02=$this->NewIncFile02; }
		if ($this->NewIncFile03!="") { $this->IncFile03=$this->NewIncFile03; }
		if ($this->NewIncFile04!="") { $this->IncFile04=$this->NewIncFile04; }
		if ($this->NewIncFile05!="") { $this->IncFile05=$this->NewIncFile05; }
		if ($this->NewIncFile06!="") { $this->IncFile06=$this->NewIncFile06; }
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_insight set Title='".$this->Title."',Category='".$this->Category."',Contents01='".$this->Contents01."',Contents02='".$this->Contents02."',Contents03='".$this->Contents03."',Contents04='".$this->Contents04."',Contents05='".$this->Contents05."',Contents06='".$this->Contents06."',IncFile01='".$this->IncFile01."',IncFile02='".$this->IncFile02."',IncFile03='".$this->IncFile03."',IncFile04='".$this->IncFile04."',IncFile05='".$this->IncFile05."',IncFile06='".$this->IncFile06."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/insightModify".$this->sParam,'refresh');
		}
	}

	//insightCategoryList
	function insightCategoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 20;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_insight_category as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_insight_category as tbl1 ".$this->sWhere." order by tbl1.Sort asc,tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//insightCategorySortValid
	function insightCategorySortValid() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->Sort=addslashes(trim($this->input->get('Sort')));
		if ($this->Idx) {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_insight_category where Sort='".$this->Sort."' and Idx!='".$this->Idx."'";
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt FROM tbl_insight_category where Sort='".$this->Sort."'";
		}
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->iCnt=="0") {
			echo "true";
		} else {
			echo "false";
		}
	}
	//insightCategoryCreateProc
	function insightCategoryCreateProc() {
		$this->CategoryName=addslashes($this->input->post('CategoryName'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="insert into tbl_insight_category (CategoryName,Sort) values ('".$this->CategoryName."','".$this->Sort."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$sRetUrl=sSiteUrl."/settings/insightCategoryList".$this->sParam;
			redirect($sRetUrl,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//insightCategoryModify
	function insightCategoryModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_insight_category as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//insightCategoryModifyProc
	function insightCategoryModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->CategoryName=addslashes($this->input->post('CategoryName'));
		$this->Sort=addslashes($this->input->post('Sort'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_insight_category set CategoryName='".$this->CategoryName."',Sort='".$this->Sort."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/insightCategoryList".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//insightCategoryDelProc
	function insightCategoryDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_insight_category where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'카테고리 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//event01List
	function event01List() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_event01List as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from cms_event01List as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//event01DelProc
	function event01DelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_event01 where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//event01Modify
	function event01Modify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM cms_event01List as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_event01_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_event01_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles']=10-$arrData['iFileCnt01']-$arrData['iFileCnt02'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//event01FileDelProc
	function event01FileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_event01_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_event01_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//event01ModifyProc
	function event01ModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->UserTel=addslashes($this->input->post('UserTel'));
		$this->UserZipCode=addslashes($this->input->post('UserZipCode'));
		$this->UserAddress01=addslashes($this->input->post('UserAddress01'));
		$this->UserAddress02=addslashes($this->input->post('UserAddress02'));
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_event01 set UserTel='".$this->UserTel."',UserZipCode='".$this->UserZipCode."',UserAddress01='".$this->UserAddress01."',UserAddress02='".$this->UserAddress02."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_event01_file (ParentIdx,FileName,FileType) VALUES ('".$this->Idx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/event01Modify".$this->sParam,'refresh');
		}
	}
	function alarmScheduleList01() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where ScheduleType='1' ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_schedule_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName FROM tbl_schedule_history as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	function alarmScheduleList02() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where ScheduleType='3' ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_schedule_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName FROM tbl_schedule_history as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	function alarmScheduleList03() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where ScheduleType='2' ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_schedule_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName FROM tbl_schedule_history as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	function alarmScheduleList04() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where ScheduleType='4' ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_schedule_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,tbl2.UserNickName FROM tbl_schedule_history as tbl1 left join tbl_member as tbl2 on tbl1.UserIdx=tbl2.Idx ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}

	//mainBannerList
	function mainBannerList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_main_banner as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_main_banner as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}

	//mainBannerCreate
	function mainBannerCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainBannerCreateProc
	function mainBannerCreateProc() {
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->BannerImage=$this->arrRetFile[0];
		$this->sQuery="insert into tbl_main_banner (BannerTitle,BannerUrl,BannerImage,BannerStartDate,BannerEndDate,BannerUseYn,NewWindowYn) values ('".$this->BannerTitle."','".$this->BannerUrl."','".$this->BannerImage."','".$this->BannerStartDate."','".$this->BannerEndDate."','".$this->BannerUseYn."','".$this->NewWindowYn."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/mainBannerList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainBannerDelProc
	function mainBannerDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_main_banner where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'배너 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//mainBannerModify
	function mainBannerModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_main_banner as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//mainBannerModifyProc
	function mainBannerModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->NewBannerImage=$this->arrRetFile[0];
		$this->sQuery="select BannerImage from tbl_main_banner where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->BannerImage=$this->arrResult->BannerImage;
		} else {
			$this->BannerImage="";
		}
		if ($this->NewBannerImage!="") { $this->BannerImage=$this->NewBannerImage; }
		$this->sQuery="update tbl_main_banner set BannerTitle='".$this->BannerTitle."',BannerUrl='".$this->BannerUrl."',BannerImage='".$this->BannerImage."',BannerStartDate='".$this->BannerStartDate."',BannerEndDate='".$this->BannerEndDate."',BannerUseYn='".$this->BannerUseYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/mainBannerModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainBannerMobileList
	function mainBannerMobileList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_main_banner_mobile as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_main_banner_mobile as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainBannerMobileCreate
	function mainBannerMobileCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainBannerMobileCreateProc
	function mainBannerMobileCreateProc() {
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->BannerImage=$this->arrRetFile[0];
		$this->sQuery="insert into tbl_main_banner_mobile (BannerTitle,BannerUrl,BannerImage,BannerStartDate,BannerEndDate,BannerUseYn,NewWindowYn) values ('".$this->BannerTitle."','".$this->BannerUrl."','".$this->BannerImage."','".$this->BannerStartDate."','".$this->BannerEndDate."','".$this->BannerUseYn."','".$this->NewWindowYn."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/mainBannerMobileList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainBannerMobileDelProc
	function mainBannerMobileDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_main_banner_mobile where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'배너 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//mainBannerMobileModify
	function mainBannerMobileModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_main_banner_mobile as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//mainBannerMobileModifyProc
	function mainBannerMobileModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->NewBannerImage=$this->arrRetFile[0];
		$this->sQuery="select BannerImage from tbl_main_banner_mobile where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->BannerImage=$this->arrResult->BannerImage;
		} else {
			$this->BannerImage="";
		}
		if ($this->NewBannerImage!="") { $this->BannerImage=$this->NewBannerImage; }
		$this->sQuery="update tbl_main_banner_mobile set BannerTitle='".$this->BannerTitle."',BannerUrl='".$this->BannerUrl."',BannerImage='".$this->BannerImage."',BannerStartDate='".$this->BannerStartDate."',BannerEndDate='".$this->BannerEndDate."',BannerUseYn='".$this->BannerUseYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/mainBannerMobileModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}

	//mainPressList
	function mainPressList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_main_press as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_main_press as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainPressCreate
	function mainPressCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//mainPressCreateProc
	function mainPressCreateProc() {
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->BannerImage=$this->arrRetFile[0];
		$this->sQuery="insert into tbl_main_press (BannerTitle,BannerUrl,BannerImage,BannerStartDate,BannerEndDate,BannerUseYn,NewWindowYn) values ('".$this->BannerTitle."','".$this->BannerUrl."','".$this->BannerImage."','".$this->BannerStartDate."','".$this->BannerEndDate."','".$this->BannerUseYn."','".$this->NewWindowYn."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/settings/mainPressList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainPressDelProc
	function mainPressDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_main_press where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'메인 언론관리 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//mainPressModify
	function mainPressModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_main_press as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//mainPressModifyProc
	function mainPressModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->BannerTitle=addslashes($this->input->post('BannerTitle'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->BannerStartDate=addslashes($this->input->post('BannerStartDate'));
		$this->BannerEndDate=addslashes($this->input->post('BannerEndDate'));
		$this->BannerUseYn=addslashes($this->input->post('BannerUseYn'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->NewBannerImage=$this->arrRetFile[0];
		$this->sQuery="select BannerImage from tbl_main_press where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->BannerImage=$this->arrResult->BannerImage;
		} else {
			$this->BannerImage="";
		}
		if ($this->NewBannerImage!="") { $this->BannerImage=$this->NewBannerImage; }
		$this->sQuery="update tbl_main_press set BannerTitle='".$this->BannerTitle."',BannerUrl='".$this->BannerUrl."',BannerImage='".$this->BannerImage."',BannerStartDate='".$this->BannerStartDate."',BannerEndDate='".$this->BannerEndDate."',BannerUseYn='".$this->BannerUseYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/mainPressModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//mainMedia
	function mainMedia() {
		//$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->Idx="2";
		$this->sQuery="SELECT tbl1.* FROM tbl_main_video as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		return $arrData;
	}
	//mainMediaModifyProc
	function mainMediaModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->BannerUrl=addslashes($this->input->post('BannerUrl'));
		$this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
		$this->arrRetFile=$this->utilmodel->do_upload("BannerImage",sUploadFolder01);
		$this->NewBannerImage=$this->arrRetFile[0];
		$this->sQuery="select BannerImage from tbl_main_video where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->BannerImage=$this->arrResult->BannerImage;
		} else {
			$this->BannerImage="";
		}
		if ($this->NewBannerImage!="") { $this->BannerImage=$this->NewBannerImage; }
		$this->sQuery="update tbl_main_video set BannerUrl='".$this->BannerUrl."',NewWindowYn='".$this->NewWindowYn."',BannerImage='".$this->BannerImage."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/settings/mainMedia",'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
        //mainUseInfo1
        function mainUseInfo1() {
                //$this->Idx=addslashes(trim($this->input->get('Idx')));
                $this->Idx="1";
                $this->sQuery="SELECT tbl1.* FROM tbl_main_info as tbl1 where tbl1.Idx='".$this->Idx."'";
                $arrData['arrResult'] = $this->db->query($this->sQuery)->row();
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }
        //mainUseInfo2
        function mainUseInfo2() {
                //$this->Idx=addslashes(trim($this->input->get('Idx')));
                $this->Idx="2";
                $this->sQuery="SELECT tbl1.* FROM tbl_main_info as tbl1 where tbl1.Idx='".$this->Idx."'";
                $arrData['arrResult'] = $this->db->query($this->sQuery)->row();
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }
        //mainUseInfo3
        function mainUseInfo3() {
                //$this->Idx=addslashes(trim($this->input->get('Idx')));
                $this->Idx="3";
                $this->sQuery="SELECT tbl1.* FROM tbl_main_info as tbl1 where tbl1.Idx='".$this->Idx."'";
                $arrData['arrResult'] = $this->db->query($this->sQuery)->row();
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }
        //mainUseInfoModifyProc
        function mainUseInfoModifyProc() {
                $this->Idx=addslashes($this->input->post('Idx'));
                $this->Title=addslashes($this->input->post('Title'));
                $this->MobileTitle=addslashes($this->input->post('MobileTitle'));
                $this->Url=addslashes($this->input->post('Url'));
                $this->MobileUrl=addslashes($this->input->post('MobileUrl'));
                $this->Summary=addslashes($this->input->post('Summary'));
                $this->MobileSummary=addslashes($this->input->post('MobileSummary'));
                $this->sQuery = "update tbl_main_info set Title='".$this->Title."',MobileTitle='".$this->MobileTitle."',Url='".$this->Url."',MobileUrl='".$this->MobileUrl."',Summary='".$this->Summary."',MobileSummary='".$this->MobileSummary."'";

                if ($this->Idx == 1 || $this->Idx == 2) {
                        $this->arrRetFile=$this->utilmodel->do_upload("Image",sUploadFolder01);
                        if ($this->arrRetFile[0]!="") {
                                $this->Image = $this->arrRetFile[0];
                                $this->sQuery = $this->sQuery.",Image='".$this->Image."'";
                        }
                        $this->arrRetFile=$this->utilmodel->do_upload("MobileImage",sUploadFolder01);
                        if ($this->arrRetFile[0]!="") {
                                $this->MobileImage=$this->arrRetFile[0];
                                $this->sQuery = $this->sQuery.",MobileImage='".$this->MobileImage."'";
                        }
                }
                $this->sQuery = $this->sQuery." where Idx='".$this->Idx."'";
                $arrData['arrResult']=$this->db->query($this->sQuery);
                if ($arrData['arrResult']) {
                        redirect(sSiteUrl."/settings/mainUseInfo1",'refresh');
                } else {
                        echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
                }
        }
        //mainSectionImage
        function mainSectionImage() {
                $this->sQuery="SELECT tbl1.* FROM tbl_main_section_image as tbl1 where tbl1.Idx<10 order by tbl1.Idx";
                $arrData['arrResult']= $this->db->query($this->sQuery);
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }
        //mainSectionImageMobile
        function mainSectionImageMobile() {
                $this->sQuery="SELECT tbl1.* FROM tbl_main_section_image as tbl1 where tbl1.Idx>=10 order by tbl1.Idx";
                $arrData['arrResult']= $this->db->query($this->sQuery);
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }

        //mainSectionImageModify
        function mainSectionImageModify() {
                $this->Idx=addslashes(trim($this->input->get('Idx')));
                $this->sQuery="SELECT tbl1.* FROM tbl_main_section_image as tbl1 where tbl1.Idx='".$this->Idx."'";
                $arrData['arrResult'] = $this->db->query($this->sQuery)->row();
                if (!$arrData['arrResult']) { exit; }
                return $arrData;
        }
        //mainSectionImageModifyProc
        function mainSectionImageModifyProc() {
                $this->Idx=addslashes($this->input->post('Idx'));
                $this->SectionTitle=addslashes($this->input->post('SectionTitle'));
                $this->SectionUrl=addslashes($this->input->post('SectionUrl'));
                $this->SectionUseYn=addslashes($this->input->post('SectionUseYn'));
                $this->LinkUseYn=addslashes($this->input->post('LinkUseYn'));
                $this->NewWindowYn=addslashes($this->input->post('NewWindowYn'));
                $this->arrRetFile=$this->utilmodel->do_upload("SectionImage",sUploadFolder01);
                $this->NewSectionImage=$this->arrRetFile[0];
                $this->sQuery="select SectionImage from tbl_main_section_image where Idx='".$this->Idx."'";
                $this->arrResult = $this->db->query($this->sQuery)->row();
                if ($this->arrResult) {
                        $this->SectionImage=$this->arrResult->SectionImage;
                } else {
                        $this->SectionImage="";
                }
                if ($this->NewSectionImage!="") { $this->SectionImage=$this->NewSectionImage; }
		if ($this->LinkUseYn!="Y") { $this->LinkUseYn="N"; }
                $this->sQuery="update tbl_main_section_image set SectionTitle='".$this->SectionTitle."',SectionUrl='".$this->SectionUrl."',SectionImage='".$this->SectionImage."',SectionUseYn='".$this->SectionUseYn."',LinkUseYn='".$this->LinkUseYn."',NewWindowYn='".$this->NewWindowYn."' where Idx='".$this->Idx."'";
                $arrData['arrResult']=$this->db->query($this->sQuery);
                if ($arrData['arrResult']) {
			if ($this->Idx<10) {
                        	redirect(sSiteUrl."/settings/mainSectionImage",'refresh');
			} else {
                        	redirect(sSiteUrl."/settings/mainSectionImageMobile",'refresh');
			}
                } else {
                        echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
                }
        }

	//guideList
	function guideList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_guide as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_guide as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//guideCreate
	function guideCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//guideCreateProc
	function guideCreateProc() {
		$this->Title=addslashes($this->input->post('Title'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->arrRetFile=$this->utilmodel->do_upload("ListImage",sUploadFolder01);
		$this->ListImage=$this->arrRetFile[0];
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="SELECT ifnull(AUTO_INCREMENT,0) as IdentIdx FROM information_schema.tables WHERE table_name = 'tbl_guide' AND table_schema = DATABASE()";
		$this->ParentIdx=$this->db->query($this->sQuery)->row()->IdentIdx;
		$this->sQuery="insert into tbl_guide (Title,Contents,Summary,ListImage,AdminYn) values ('".$this->Title."','".$this->Contents."','".$this->Summary."','".$this->ListImage."','Y')";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_guide_file (ParentIdx,FileName,FileType) VALUES ('".$this->ParentIdx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl.'/settings/guideList','refresh');
		}
	}
	//guideDelProc
	function guideDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_guide where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'글 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//guideModify
	function guideModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_guide as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_guide_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_guide_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles']=10-$arrData['iFileCnt01']-$arrData['iFileCnt02'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//guideFileDelProc
	function guideFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_guide_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_guide_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//guideModifyProc
	function guideModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->arrRetFile=$this->utilmodel->do_upload("ListImage",sUploadFolder01);
		$this->NewListImage=$this->arrRetFile[0];
		$this->sQuery="select ListImage from tbl_guide where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->ListImage=$this->arrResult->ListImage;
		} else {
			$this->ListImage="";
		}
		if ($this->NewListImage!="") { $this->ListImage=$this->NewListImage; }
		$this->arrIncImage=$this->input->post('IncImage[]');
		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_guide set Title='".$this->Title."',Contents='".$this->Contents."',ListImage='".$this->ListImage."',Summary='".$this->Summary."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		if (is_array($this->arrIncImage)) {
			$this->sCheckFile = array("jpg","png","gif","jpeg");
			for ($iCnt=0; $iCnt<sizeof($this->arrIncImage); $iCnt++) {
				$this->arrValue01=explode('.',$this->arrIncImage[$iCnt]);
				$this->sValue02=array_pop($this->arrValue01);
				$this->sFileNameExt=strtolower($this->sValue02);
				if(in_array($this->sFileNameExt,$this->sCheckFile)) {
					$this->FileType="P";
				} else {
					$this->FileType="F";
				}
				$this->sQuery="INSERT INTO tbl_guide_file (ParentIdx,FileName,FileType) VALUES ('".$this->Idx."','".$this->arrIncImage[$iCnt]."','".$this->FileType."')";
				$this->db->query($this->sQuery);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/guideModify".$this->sParam,'refresh');
		}
	}
	//aramList
	function aramList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_aram as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_aram as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//aramCreate
	function aramCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//aramCreateProc
	function aramCreateProc() {
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->Contents01=addslashes($this->input->post('Contents01'));
		$this->Contents02=addslashes($this->input->post('Contents02'));
		$this->Contents03=addslashes($this->input->post('Contents03'));
		$this->Contents04=addslashes($this->input->post('Contents04'));
		$this->Contents05=addslashes($this->input->post('Contents05'));
		$this->Contents06=addslashes($this->input->post('Contents06'));
		$this->arrRetFile=$this->utilmodel->do_upload("ListImage",sUploadFolder01);
		$this->ListImage=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder01);
		$this->IncFile01=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile02",sUploadFolder01);
		$this->IncFile02=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile03",sUploadFolder01);
		$this->IncFile03=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile04",sUploadFolder01);
		$this->IncFile04=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile05",sUploadFolder01);
		$this->IncFile05=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile06",sUploadFolder01);
		$this->IncFile06=$this->arrRetFile[0];
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="insert into tbl_aram (Title,Contents01,Contents02,Contents03,Contents04,Contents05,Contents06,IncFile01,IncFile02,IncFile03,IncFile04,IncFile05,IncFile06,Summary,ListImage,AdminYn) values ('".$this->Title."','".$this->Contents01."','".$this->Contents02."','".$this->Contents03."','".$this->Contents04."','".$this->Contents05."','".$this->Contents06."','".$this->IncFile01."','".$this->IncFile02."','".$this->IncFile03."','".$this->IncFile04."','".$this->IncFile05."','".$this->IncFile06."','".$this->Summary."','".$this->ListImage."','Y')";
		$this->db->query($this->sQuery);
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl.'/settings/aramList','refresh');
		}
	}
	//aramDelProc
	function aramDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_aram where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'글 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//aramModify
	function aramModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_aram as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['arrFile01'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_aram_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='P'");
		$arrData['iFileCnt01']=$arrData['arrFile01']->num_rows();
		$arrData['arrFile02'] = $this->db->query("select tbl1.Idx,tbl1.FileName from tbl_aram_file as tbl1 where tbl1.ParentIdx='".$this->Idx."' and tbl1.FileType='F'");
		$arrData['iFileCnt02']=$arrData['arrFile02']->num_rows();
		$arrData['iMaxFiles']=10-$arrData['iFileCnt01']-$arrData['iFileCnt02'];
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//aramFileDelProc
	function aramFileDelProc() {
		$this->ParentIdx=addslashes($this->input->get('ParentIdx'));
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT FileName FROM tbl_aram_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrResult=$this->db->query($this->sQuery);
		$this->sQuery="delete from tbl_aram_file where Idx='".$this->Idx."' and ParentIdx='".$this->ParentIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			foreach ($arrResult->result() as $row) {
				if ($row->FileName) {
					fnDelFile(sUploadFolder01.$row->FileName);
				}
			}
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'파일 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		echo json_encode($arrRetMessage);
	}
	//aramModifyProc
	function aramModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->Contents01=addslashes($this->input->post('Contents01'));
		$this->Contents02=addslashes($this->input->post('Contents02'));
		$this->Contents03=addslashes($this->input->post('Contents03'));
		$this->Contents04=addslashes($this->input->post('Contents04'));
		$this->Contents05=addslashes($this->input->post('Contents05'));
		$this->Contents06=addslashes($this->input->post('Contents06'));
		$this->arrRetFile=$this->utilmodel->do_upload("ListImage",sUploadFolder01);
		$this->NewListImage=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder01);
		$this->NewIncFile01=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile02",sUploadFolder01);
		$this->NewIncFile02=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile03",sUploadFolder01);
		$this->NewIncFile03=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile04",sUploadFolder01);
		$this->NewIncFile04=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile05",sUploadFolder01);
		$this->NewIncFile05=$this->arrRetFile[0];
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile06",sUploadFolder01);
		$this->NewIncFile06=$this->arrRetFile[0];
		$this->sQuery="select ListImage,IncFile01,IncFile02,IncFile03,IncFile04,IncFile05,IncFile06 from tbl_aram where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->ListImage=$this->arrResult->ListImage;
			$this->IncFile01=$this->arrResult->IncFile01;
			$this->IncFile02=$this->arrResult->IncFile02;
			$this->IncFile03=$this->arrResult->IncFile03;
			$this->IncFile04=$this->arrResult->IncFile04;
			$this->IncFile05=$this->arrResult->IncFile05;
			$this->IncFile06=$this->arrResult->IncFile06;
		} else {
			$this->ListImage="";
			$this->IncFile01="";
			$this->IncFile02="";
			$this->IncFile03="";
			$this->IncFile04="";
			$this->IncFile05="";
			$this->IncFile06="";
		}
		if ($this->NewListImage!="") { $this->ListImage=$this->NewListImage; }
		if ($this->NewIncFile01!="") { $this->IncFile01=$this->NewIncFile01; }
		if ($this->NewIncFile02!="") { $this->IncFile02=$this->NewIncFile02; }
		if ($this->NewIncFile03!="") { $this->IncFile03=$this->NewIncFile03; }
		if ($this->NewIncFile04!="") { $this->IncFile04=$this->NewIncFile04; }
		if ($this->NewIncFile05!="") { $this->IncFile05=$this->NewIncFile05; }
		if ($this->NewIncFile06!="") { $this->IncFile06=$this->NewIncFile06; }

		$this->sWhere="";
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="update tbl_aram set Title='".$this->Title."',Contents01='".$this->Contents01."',Contents02='".$this->Contents02."',Contents03='".$this->Contents03."',Contents04='".$this->Contents04."',Contents05='".$this->Contents05."',Contents06='".$this->Contents06."',IncFile01='".$this->IncFile01."',IncFile02='".$this->IncFile02."',IncFile03='".$this->IncFile03."',IncFile04='".$this->IncFile04."',IncFile05='".$this->IncFile05."',IncFile06='".$this->IncFile06."',ListImage='".$this->ListImage."',Summary='".$this->Summary."' ".$this->sWhere." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/settings/aramModify".$this->sParam,'refresh');
		}
	}
}
