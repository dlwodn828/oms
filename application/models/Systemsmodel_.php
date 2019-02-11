<?php
class Systemsmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	//memberList
	function memberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//memberListExcel
	function memberListExcel() {
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('회원리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '등급');
		$this->excel->getActiveSheet()->setCellValue('D1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('G1', '가입경로');
		$this->excel->getActiveSheet()->setCellValue('H1', '성별');
		$this->excel->getActiveSheet()->setCellValue('I1', '연령대');
		$this->excel->getActiveSheet()->setCellValue('J1', '나눔여부');
		$this->excel->getActiveSheet()->setCellValue('K1', '가입일');
		$this->excel->getActiveSheet()->setCellValue('L1', '플러스가입일');
		$this->excel->getActiveSheet()->setCellValue('M1', 'I-CSS (점수)');
		$this->excel->getActiveSheet()->setCellValue('N1', '대기 S');
		$this->excel->getActiveSheet()->setCellValue('O1', '진행 S');

		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserCode,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,fnMemberGrade02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->UserName="";
			if ($row->UserGrade=="2") {
				$this->UserName=$row->NanumUserName;
			} else if ($row->UserGrade=="3") {
				$this->UserName=$row->PlusUserName;
			}
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$this->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,fnMemberGender02($row->UserGrade,$row->PlusUserGender,$row->NanumUserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnMemberAge($row->UserGrade,$row->PlusUserPSNNo,$row->NanumUserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberNanum02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':O'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;
		
		$sFileName="회원리스트";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다. 
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		$objWriter->save('php://output');
	}
	//memberView
	function memberView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='1' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult02'] = $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='2' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult03'] = $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//memberSuccessionChange
	function memberSuccessionChange() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->UserSuccessionYn=addslashes(trim($this->input->get('UserSuccessionYn')));
		$this->sQuery="select UserGrade from tbl_member where Idx='".$this->Idx."'";
		$this->UserGrade=$this->db->query($this->sQuery)->row()->UserGrade;
		if ($this->UserGrade!="3") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'승계회원은 플러스 회원만 가능합니다.');
		} else {
			$this->sQuery="update tbl_member set UserSuccessionYn='".$this->UserSuccessionYn."' where Idx='".$this->Idx."'";
			$arrData['arrResult']=$this->db->query($this->sQuery);
			if ($arrData['arrResult']) {
				$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'승계변경이 완료되었습니다.');
			} else {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
			}
		}
		echo json_encode($arrRetMessage);
	}
	//memberModifyProc
	function memberModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->UserDelYn=addslashes($this->input->post('UserDelYn'));
		$this->UserDelReason=addslashes($this->input->post('UserDelReason'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sParam02=addslashes($this->input->post('sParam02'));
		if ($this->UserDelYn=="Y") {
			$this->sQuery="update tbl_member set UserDelReason='".$this->UserDelReason."',UserDelYn='Y',DelDate=now() where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$sRetUrl=sSiteUrl."/systems/memberList".$this->sParam02;
		} else {
			$sRetUrl=sSiteUrl."/systems/memberView".$this->sParam;
		}
		$this->db->trans_complete();//트랜잭션 끝
		redirect($sRetUrl,'refresh'); 
	}
	//successionMemberList
	function successionMemberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where UserSuccessionYn='Y' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//successionMemberListExcel
	function successionMemberListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where UserSuccessionYn='Y' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('회원리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '등급');
		$this->excel->getActiveSheet()->setCellValue('D1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('G1', '가입경로');
		$this->excel->getActiveSheet()->setCellValue('H1', '성별');
		$this->excel->getActiveSheet()->setCellValue('I1', '연령대');
		$this->excel->getActiveSheet()->setCellValue('J1', '나눔여부');
		$this->excel->getActiveSheet()->setCellValue('K1', '가입일');
		$this->excel->getActiveSheet()->setCellValue('L1', '플러스가입일');
		$this->excel->getActiveSheet()->setCellValue('M1', 'I-CSS (점수)');

		$this->excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserCode,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,fnMemberGrade02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->UserName="";
			if ($row->UserGrade=="2") {
				$this->UserName=$row->NanumUserName;
			} else if ($row->UserGrade=="3") {
				$this->UserName=$row->PlusUserName;
			}
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$this->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,fnMemberGender02($row->UserGrade,$row->PlusUserGender,$row->NanumUserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnMemberAge($row->UserGrade,$row->PlusUserPSNNo,$row->NanumUserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberNanum02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':M'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;
		
		$sFileName="승계회원리스트";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다. 
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		$objWriter->save('php://output');
	}
	//successionMemberView
	function successionMemberView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='1' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult02'] = $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='2' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult03'] = $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//successionMemberModifyProc
	function successionMemberModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->UserDelYn=addslashes($this->input->post('UserDelYn'));
		$this->UserDelReason=addslashes($this->input->post('UserDelReason'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sParam02=addslashes($this->input->post('sParam02'));
		if ($this->UserDelYn=="Y") {
			$this->sQuery="update tbl_member set UserDelReason='".$this->UserDelReason."',UserDelYn='Y',DelDate=now() where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$sRetUrl=sSiteUrl."/systems/successionMemberList".$this->sParam02;
		} else {
			$sRetUrl=sSiteUrl."/systems/successionMemberView".$this->sParam;
		}
		$this->db->trans_complete();//트랜잭션 끝
		redirect($sRetUrl,'refresh'); 
	}
	//withdrawMemberList
	function withdrawMemberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_withdrawMemberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_withdrawMemberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//withdrawMemberListExcel
	function withdrawMemberListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_withdrawMemberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_withdrawMemberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('회원리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '등급');
		$this->excel->getActiveSheet()->setCellValue('D1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('G1', '가입경로');
		$this->excel->getActiveSheet()->setCellValue('H1', '성별');
		$this->excel->getActiveSheet()->setCellValue('I1', '연령대');
		$this->excel->getActiveSheet()->setCellValue('J1', '나눔여부');
		$this->excel->getActiveSheet()->setCellValue('K1', '가입일');
		$this->excel->getActiveSheet()->setCellValue('L1', '플러스가입일');
		$this->excel->getActiveSheet()->setCellValue('M1', 'I-CSS (점수)');
		$this->excel->getActiveSheet()->setCellValue('N1', '탈퇴일');

		$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserCode,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,fnMemberGrade02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->UserName="";
			if ($row->UserGrade=="2") {
				$this->UserName=$row->NanumUserName;
			} else if ($row->UserGrade=="3") {
				$this->UserName=$row->PlusUserName;
			}
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$this->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,fnMemberGender02($row->UserGrade,$row->PlusUserGender,$row->NanumUserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnMemberAge($row->UserGrade,$row->PlusUserPSNNo,$row->NanumUserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberNanum02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row->DelDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':N'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;
		
		$sFileName="탈퇴회원리스트";
		$sFileName.=".xls";
		$sFileName= iconv("utf-8","euc-kr",$sFileName);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$sFileName.'"');
		header('Cache-Control: max-age=0');
		# Excel5 포맷(excel 2003 .XLS file)으로 저장한다. 
		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		# 이용자가 다운로드하여 컴퓨터 HD에 저장하도록 강제한다.
		$objWriter->save('php://output');
	}
	//withdrawMemberView
	function withdrawMemberView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='1' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult02'] = $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM tbl_member_regist_item as tbl1 where tbl1.RegistCategory='2' and tbl1.UserIdx='".$this->Idx."' ";
		$arrData['arrResult03'] = $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	function jumpingCouponList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchType="UserNickName";
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserSuccessionYn=addslashes(trim($this->input->get('sSearchUserSuccessionYn')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->sSearchUserAge=addslashes(trim($this->input->get('sSearchUserAge')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' "; 
			}
		}
		if ($this->sSearchUserGrade) { $this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";  }
		if ($this->sSearchUserAgreePath) { $this->sWhere.=" and tbl1.UserAgreePath='".$this->sSearchUserAgreePath."' ";  }
		if ($this->sSearchUserCategory) { $this->sWhere.=" and tbl1.UserCategory like '%".$this->sSearchUserCategory."%' ";  }
		if ($this->sSearchUserSuccessionYn) { $this->sWhere.=" and tbl1.UserSuccessionYn='".$this->sSearchUserSuccessionYn."' ";  }
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['sSearchUserSuccessionYn']=$this->sSearchUserSuccessionYn;
		$arrData['sSearchUserGender']=$this->sSearchUserGender;
		$arrData['sSearchUserAge']=$this->sSearchUserAge;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//jumpingCouponUseList
	function jumpingCouponUseList() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sPage02=addslashes(trim($this->input->get('sPage02')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where UserIdx='".$this->Idx."' ";
		if(!$this->sPage02){ $this->sPage02 = 1;}
		$this->iStart=($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_member_jumping_coupon as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_member_jumping_coupon as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		$arrData['sPage']=$this->sPage;
		$arrData['sPage02']=$this->sPage02;
		$arrData['sPaging']=$this->utilmodel->fnPaging02($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage02);
		$arrData['Idx']=$this->Idx;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		if ($arrData['arrResult02']->UserGrade=="2") {
			$arrData['UserName']=$arrData['arrResult02']->NanumUserName;
		} else if ($arrData['arrResult02']->UserGrade=="3") {
			$arrData['UserName']=$arrData['arrResult02']->PlusUserName;
		} else {
			$arrData['UserName']="";
		}
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam03();
		return $arrData;
	}
	//jumpingCouponUseCreateProc
	function jumpingCouponUseCreateProc() {
		$this->UserIdx=addslashes($this->input->post('UserIdx'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->Point=addslashes($this->input->post('Point'));
		$this->sParam=addslashes($this->input->post('sParam'));

		$this->sQuery="insert into tbl_member_jumping_coupon (UserIdx,Contents,Point) values ('".$this->UserIdx."','".$this->Contents."','".$this->Point."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/systems/jumpingCouponUseList".$this->sParam,'refresh'); 
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}

	//jumpingCouponIssueList
	function jumpingCouponIssueList() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sPage02=addslashes(trim($this->input->get('sPage02')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage02){ $this->sPage02 = 1;}
		$this->iStart=($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_jumping_coupon as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_jumping_coupon as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		$arrData['sPage']=$this->sPage;
		$arrData['sPage02']=$this->sPage02;
		$arrData['sPaging']=$this->utilmodel->fnPaging02($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage02);
		$arrData['Idx']=$this->Idx;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['sSearchUserAgreePath']=$this->sSearchUserAgreePath;
		$arrData['sSearchUserCategory']=$this->sSearchUserCategory;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam03();
		return $arrData;
	}
	//jumpingCouponIssueModify
	function jumpingCouponIssueModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_jumping_coupon as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//jumpingCouponIssueModifyProc
	function jumpingCouponIssueModifyProc() {
		$this->CouponIdx=addslashes($this->input->post('CouponIdx'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->CouponCnt=addslashes($this->input->post('CouponCnt'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_jumping_coupon set Title='".$this->Title."',CouponCnt='".$this->CouponCnt."' where Idx='".$this->CouponIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/systems/jumpingCouponIssueList".$this->sParam,'refresh'); 
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}


}