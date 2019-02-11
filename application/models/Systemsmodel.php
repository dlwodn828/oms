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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stock as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_stock as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		//$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		//$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
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
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '등급');
		$this->excel->getActiveSheet()->setCellValue('D1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('G1', '휴대폰번호');
		$this->excel->getActiveSheet()->setCellValue('H1', '가입경로');
		$this->excel->getActiveSheet()->setCellValue('I1', '아임인을 알게된 경로');
		$this->excel->getActiveSheet()->setCellValue('J1', '성별');
		$this->excel->getActiveSheet()->setCellValue('K1', '연령대');
		$this->excel->getActiveSheet()->setCellValue('L1', '나눔여부');
		$this->excel->getActiveSheet()->setCellValue('M1', '가입일');
		$this->excel->getActiveSheet()->setCellValue('N1', '플러스가입일');
		$this->excel->getActiveSheet()->setCellValue('O1', 'I-CSS (점수)');
		$this->excel->getActiveSheet()->setCellValue('P1', '대기 S');
		$this->excel->getActiveSheet()->setCellValue('Q1', '진행 S');

		$this->excel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserCode,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,fnMemberGrade02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserTel,PHPExcel_Cell_DataType::TYPE_STRING);

			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row->RegistValue,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberGender02($row->UserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,fnMemberAge($row->UserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,fnMemberNanum02($row->UserNanumYn),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row->ICSSGrade." (".$row->ICSSScore.")",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row->iCnt01,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,$row->iCnt02,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':Q'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$this->Idx."' and (tbl2.State='R' or tbl2.State='S' or tbl2.State='L' or tbl2.State='W' or tbl2.State='C') ";
		$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['iCnt01']=$this->iCnt01;
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
		$this->StageCreateMax=addslashes($this->input->post('StageCreateMax'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sParam02=addslashes($this->input->post('sParam02'));
		if ($this->UserDelYn=="Y") {
			//탈퇴시 현재 대기,진행 스테이지가 있는지 체크
			$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$this->Idx."' and (tbl2.State='R' or tbl2.State='S' or tbl2.State='L' or tbl2.State='W' or tbl2.State='C') ";
			$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
			if ($this->iCnt01!=0) {
				fnAlertMsg("현재 진행 또는 참여 중인 스테이지가 존재 할 경우 탈퇴가 불가능 합니다.");
			}
			$this->sQuery="update tbl_member set UserDelReason='".$this->UserDelReason."',UserDelYn='Y',DelDate=now() where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$this->sQuery="delete from tbl_member_nice where ParentIdx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$sRetUrl=sSiteUrl."/systems/memberList".$this->sParam02;
		} else {
			$this->sQuery="update tbl_member_ad set StageCreateMax='".$this->StageCreateMax."' where ParentIdx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$sRetUrl=sSiteUrl."/systems/memberView".$this->sParam;
		}
		redirect($sRetUrl,'refresh');
	}
	//successionMemberList
	function successionMemberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
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
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->sSearchUserAgreePath=addslashes(trim($this->input->get('sSearchUserAgreePath')));
		$this->sSearchUserCategory=addslashes(trim($this->input->get('sSearchUserCategory')));
		$this->sSearchUserGender=addslashes(trim($this->input->get('sSearchUserGender')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where UserSuccessionYn='Y' ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->sSearchUserGender) { $this->sWhere.=" and tbl1.UserGender='".$this->sSearchUserGender."' ";  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_memberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_memberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
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
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
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
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,fnMemberGender02($row->UserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnMemberAge($row->UserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberNanum02($row->UserNanumYn),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row->ICSSGrade." (".$row->ICSSScore.")",PHPExcel_Cell_DataType::TYPE_STRING);
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
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$this->Idx."' and (tbl2.State='R' or tbl2.State='S' or tbl2.State='L' or tbl2.State='W' or tbl2.State='C') ";
		$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['iCnt01']=$this->iCnt01;
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
			//탈퇴시 현재 대기,진행 스테이지가 있는지 체크
			$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$this->Idx."' and (tbl2.State='R' or tbl2.State='S' or tbl2.State='L' or tbl2.State='W' or tbl2.State='C') ";
			$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
			if ($this->iCnt01!=0) {
				fnAlertMsg("현재 진행 또는 참여 중인 스테이지가 존재 할 경우 탈퇴가 불가능 합니다.");
			}
			$this->sQuery="update tbl_member set UserDelReason='".$this->UserDelReason."',UserDelYn='Y',DelDate=now() where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			$sRetUrl=sSiteUrl."/systems/successionMemberList".$this->sParam02;
		} else {
			$sRetUrl=sSiteUrl."/systems/successionMemberView".$this->sParam;
		}
		redirect($sRetUrl,'refresh');
	}

	//successionMemberChange
	function successionMemberChange() {
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
	//withdrawMemberList
	function withdrawMemberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_withdrawMemberList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_withdrawMemberList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
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
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
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
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->UserAgreePath,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,fnMemberGender02($row->UserGender),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnMemberAge($row->UserPSNNo),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnMemberNanum02($row->UserNanumYn),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->PlusRegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row->ICSSGrade." (".$row->ICSSScore.")",PHPExcel_Cell_DataType::TYPE_STRING);
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
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
		if ($this->sSearchUserGender) { $this->sWhere.=" and (tbl1.PlusUserGender='".$this->sSearchUserGender."' or tbl1.NanumUserGender='".$this->sSearchUserGender."')";  }
		if ($this->sSearchUserAge) { $this->sWhere.=fnMemberSearchAge($this->sSearchUserAge);  }
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }

		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_jumpingCouponList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_jumpingCouponList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
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
		$arrData['UserName']=$arrData['arrResult02']->UserName;
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
		//기존회원 쿠폰카운트 조회
		$this->sQuery="SELECT ifnull(sum(tbl1.point),0) as NowTotalPoint FROM tbl_member_jumping_coupon as tbl1 where UserIdx='".$this->UserIdx."'";
		$this->NowTotalPoint=$this->db->query($this->sQuery)->row()->NowTotalPoint+$this->Point;
		$this->sQuery="insert into tbl_member_jumping_coupon (UserIdx,Contents,Point,NowTotalPoint) values ('".$this->UserIdx."','".$this->Contents."','".$this->Point."','".$this->NowTotalPoint."')";
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
	//adMemberList
	function adMemberList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
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
		$this->sWhere="where 1=1 and tbl1.UserGrade='4' ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserCode like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' or tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserId like '%".$this->sSearchWord."%') ";
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
        //adMemberCreate
        function adMemberCreate() {
                $this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
                $arrData['arrResult']= $this->db->query($this->sQuery);
                return $arrData;
        }
        //adMemberCreateProc
        function adMemberCreateProc() {
                $this->UserNickName=addslashes($this->input->post('UserNickName'));
                $this->UserId=addslashes($this->input->post('UserId'));
                $this->UserPwd=addslashes($this->input->post('UserPwd'));
                $this->UserCategory=addslashes($this->input->post('UserCategory'));
		$this->StageCreateMax=addslashes($this->input->post('StageCreateMax'));
                $this->UserAgreePath="E";
                $this->UserGrade="4";
                //회원코드 조회
                $this->sQuery="SELECT MAX(tbl1.UserCode) as UserCode FROM tbl_member_code as tbl1 where tbl1.UserCode > 'X0000' order by tbl1.UserCode desc";
                $arrData['arrResult']= $this->db->query($this->sQuery)->row();
                if ($arrData['arrResult']->UserCode) {
                        $this->UserCode=$arrData['arrResult']->UserCode;
                        $this->UserCode01=substr($this->UserCode,0,1);
                        $this->UserCode02=substr($this->UserCode,1,4);
                        if ($this->UserCode02=="9999") {
                                ++$this->UserCode01;
                                $this->UserCode02="1";
                        } else {
                                ++$this->UserCode02;
                        }
                        $this->iRemainSpace = 4-strlen($this->UserCode02);
                        for ($iCnt=0;$iCnt<$this->iRemainSpace;$iCnt++) {
                                $this->UserCode02="0".$this->UserCode02;
                        }
                        $this->UserCode=$this->UserCode01.$this->UserCode02;
                } else {
                        $this->UserCode="X0001";
                }

                //중복 조회
                $this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_member as tbl1 where tbl1.UserDelYn!='Y' and tbl1.UserAgreePath='".$this->UserAgreePath."' and tbl1.UserId='".$this->UserId."'";
                $this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
                if ($this->iCnt01!=0) {
                        fnAlertMsg("이미 가입한 회원입니다.");
                } else {
                        //최초 가입시 랜덤 이미지 3개중 1개를 뿌려줌
                        $this->randomNum = mt_rand(1,3);
                        $this->FileName="0".$this->randomNum."."."png";
                        $this->orinalFile=sUploadFolder05.$this->FileName;
                        $this->newFile=sUploadFolder06.$this->FileName;
                        // 실제 존재하는 파일인지 체크
                        if(file_exists($this->orinalFile)) {
                                //저장파일이 존재하는지 체크
                                $this->arrFileInfo=fnFileInfo($this->orinalFile);
                                $bFlag = 0;
                                $this->newSaveFile=$this->FileName;
                                if(file_exists($this->newFile)) {
                                        $iCnt = 1;
                                        while($bFlag != 1){
                                                if(!file_exists(sUploadFolder06.$this->arrFileInfo["filename"].$iCnt.".".$this->arrFileInfo["extension"])){
                                                        $bFlag = 1;
                                                        $this->newSaveFile=$this->arrFileInfo["filename"].$iCnt.".".$this->arrFileInfo["extension"];
                                                }
                                                $iCnt++;
                                        }
                                }
                                if(!copy($this->orinalFile,sUploadFolder06.$this->newSaveFile)) {
                                        $this->UserPhoto="";
                                } else if(file_exists(sUploadFolder06.$this->newSaveFile)) {
                                        copy($this->orinalFile,sUploadFolder06."medium/".$this->newSaveFile);
                                        copy($this->orinalFile,sUploadFolder06."thumbnail/".$this->newSaveFile);
                                        $this->UserPhoto=$this->newSaveFile;
                                }
                        } else {
                                $this->UserPhoto="";
                        }
			$this->sQuery="insert into tbl_member_code (UserCode) values ('".$this->UserCode."')";
			$this->db->query($this->sQuery);

                        $this->sQuery="insert into tbl_member (UserCode,UserNickName,UserId,UserPwd,UserCategory,UserGrade,UserAgreePath,UserPhoto) values ('".$this->UserCode."','".$this->UserNickName."','".$this->UserId."','".$this->UserPwd."','".$this->UserCategory."','".$this->UserGrade."','".$this->UserAgreePath."','".$this->UserPhoto."')";
                        $arrData['arrResult']= $this->db->query($this->sQuery);

	                $this->sQuery="select tbl1.Idx from tbl_member as tbl1 where UserCode='".$this->UserCode."'";
			$this->ParentIdx = $this->db->query($this->sQuery)->row()->Idx;

			$this->sQuery="insert into tbl_member_ad (ParentIdx, StageCreateMax) values ('".$this->ParentIdx."','".$this->StageCreateMax."')";
			$this->db->query($this->sQuery);

                        if ($arrData['arrResult']) {
//                              echo $this->sQuery;
                                redirect(sSiteUrl."/systems/adMemberList",'refresh');
                        } else {
                                fnAlertMsg("알수없는 오류가 발생했습니다. 해당 문제가 지속
될시 관리자에게 연락주세요.");
                        }
                }
        }

	//generalStageList
	function generalStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
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
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_generalStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from cms_generalStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//generalStageInformation
	function generalStageInformation() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStageApplicant
	function generalStageApplicant() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment as tbl1 left join tbl_stage_apply as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->result_array();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->sQuery="SELECT tbl1.StageNum from tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['StageNum']=$this->db->query($this->sQuery)->row()->StageNum;
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStageDeposit
	function generalStageDeposit() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.TurnNo from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrDataSub= $this->db->query($this->sQuery)->result_array();
		$iCnt=0;
		foreach ($arrDataSub as $row) {
			$this->sQuery="select tbl1.Idx,tbl1.TurnNo,tbl1.DepositDate,tbl1.ScheduledDepositMoney,tbl1.DepositMoney,tbl1.DefaultMoney,tbl1.ControlDepositMoney,tbl1.DepositState,tbl2.State,tbl1.ScheduledDepositDate,tbl2.StageCode,tbl3.UserCode,tbl3.UserNickName,tbl4.MyTurn from tbl_stage_deposit as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_stage_apply as tbl4 on tbl1.ParentIdx=tbl4.ParentIdx and tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' and tbl1.TurnNo='".$row["TurnNo"]."' order by tbl4.MyTurn asc,tbl2.RegDate asc";
			$arrDataSub02=$this->db->query($this->sQuery)->result_array();
			$arrDataSub[$iCnt]["ListData"]=$arrDataSub02;
			$iCnt++;
		}
		$arrData['arrResult02']=$arrDataSub;
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->sQuery="SELECT tbl1.StageNum from tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['StageNum']=$this->db->query($this->sQuery)->row()->StageNum;
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStagePayment
	function generalStagePayment() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.*,tbl2.State,tbl2.StageCode,tbl3.UserCode,tbl3.UserNickName from tbl_stage_receive as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->result_array();
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStageRate
	function generalStageRate() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult02'] = $this->db->query($this->sQuery);
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->sQuery="SELECT tbl1.Idx,tbl1.StageCode,tbl1.StageRate,tbl1.StageNum,tbl1.StageMoney,tbl1.NowTurn from tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->row();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStageInfo
	function generalStageInfo($sValue) {
		$this->Idx=addslashes(trim($sValue));
		$this->sQuery="select tbl1.StageCode,tbl1.SecretYN,tbl1.CategoryIdx,tbl1.StageNum,tbl1.StageRate,tbl1.StageMoney,tbl1.RegDate,if((tbl1.StartDate = '0000-00-00 00:00:00'),'',tbl1.StartDate) AS StartDate,if((tbl1.EndDate = '0000-00-00 00:00:00'),'',tbl1.EndDate) AS EndDate,tbl1.State,tbl2.CategoryName,DATEDIFF(now(),tbl1.RegDate) as OverDate from tbl_stage as tbl1 left join tbl_category as tbl2 on tbl1.CategoryIdx=tbl2.Idx where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		return $arrData;
	}
	//generalStageModify
	function generalStageModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.StageCode,tbl1.StageNum,tbl1.StageMoney,tbl1.StageRate,tbl1.CategoryIdx,tbl1.SecretYN,tbl1.SecretPWD,tbl1.Title,tbl1.Summary,tbl1.Contents,tbl1.StageImage,tbl1.State,tbl2.UserNickName FROM tbl_stage as tbl1 left join tbl_member as tbl2 on tbl1.CreateUserIdx=tbl2.Idx where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$this->sQuery="select tbl1.Idx,tbl1.CategoryName from tbl_category as tbl1 where DelYn='N' order by tbl1.Sort asc";
		$arrData['arrResult02']= $this->db->query($this->sQuery);
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//generalStageModifyProc
	function generalStageModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->StageRate=addslashes($this->input->post('StageRate'));
		$this->CategoryIdx=addslashes($this->input->post('CategoryIdx'));
		$this->StageMoney=addslashes($this->input->post('StageMoney'));
		$this->SecretYN=addslashes($this->input->post('SecretYN'));
		$this->SecretPWD=addslashes($this->input->post('SecretPWD'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->arrRetFile=$this->utilmodel->do_upload("StageImage",sUploadFolder03);
		$this->NewStageImage=$this->arrRetFile[0];
		$this->db->trans_start(); //트랜잭션 시작
		$this->sQuery="select State,StageNum,StageImage from tbl_stage where Idx='".$this->Idx."'";
		$this->arrResult = $this->db->query($this->sQuery)->row();
		if ($this->arrResult) {
			$this->StageImage=$this->arrResult->StageImage;
			$this->State=$this->arrResult->State;
			$this->StageNum=$this->arrResult->StageNum;
		} else {
			$this->StageImage="";
		}
		if ($this->NewStageImage!="") { $this->StageImage=$this->NewStageImage; }
		//개설자 이외에 참여자가 한명이라도 있으면 수정불가 -> 수정가능으로 변경
		/*
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stage_apply as tbl1 where ParentIdx='".$this->Idx."'";
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		if ($this->iNum>1) {
			fnAlertMsg("개설자 이외의 참여자가 있는 스테이지는 인원 수정이 불가능합니다.");
		}
		*/
		if ($this->SecretYN=="Y") {
			$this->sAddQuery=",SecretYN='".$this->SecretYN."',SecretPWD='".$this->SecretPWD."'";
		} else {
			$this->sAddQuery=",SecretYN='".$this->SecretYN."',SecretPWD=''";
		}
		//해당 스테이지가 대기 상태일때만 약정금액과 이율 입금내역 재설정
		if ($this->State=="R") {
			//기존회원의 순번 획득
			$this->sQuery="SELECT tbl1.TurnNo,tbl1.UserIdx FROM tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
			$arrData['arrResult']=$this->db->query($this->sQuery)->result_array();
			//기존 이율표 삭제
			$this->sQuery="delete from tbl_stage_payment where ParentIdx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			//이율표 계산
			$this->interestRate= file_get_contents("/home/src/imin/homepage/assets/json/interest-rate-".$this->StageNum.".json");
			$this->interestRate= utf8_encode($this->interestRate);
			$this->interestRate = json_decode($this->interestRate,true);
			$interestRateMoney = $this->interestRate[$this->StageRate][$this->StageMoney];
			$selPerson=$this->StageNum;
			$selDepositMoney = $this->StageMoney;
			$a = array();	// 순번
			$b = array();	// 약정금액
			$c = array();	// 대출이자
			$d = array();	// 적금이자
			$e = array();	// 이자합계
			$f = array();	// 월 납입금액
			$g = array();	// 총 납입금액
			$h = array();	// 적용이율(세전)
			$ii = array();	// 구좌 이용수수료 공제 후 실이자 지급액
			$j = array();	// 이자 소득세 차감 후 실이자 지급액
			$k = array();	// 적용이율(세후)
			$l = array();	// 실지급금액
			// 적금이자를 (인원수 - 1)로 나눈 값
			$modInterestRateMoney = $interestRateMoney / ($selPerson - 1);
			for ($iCnt=0;$iCnt<$selPerson;$iCnt++) {
				// 순번 = i + 1
				$a[$iCnt] = $iCnt+1;
				// 수령 예정금액 = 인원수 * 월 납입금액(선택된 값) * 10000(만원)
				$b[$iCnt] = $selPerson * $selDepositMoney * 10000;

				// 먼저 적금이자를 계산하고 대출이자를 계산한다.
				// 적금이자는 json에서 불러운값(interestRateMoney);
				if ($iCnt == 0) {
					$d[$iCnt] = 0;
					$c[$iCnt] = -round($interestRateMoney);
				} else if ($iCnt == 1) {
					$d[$iCnt] = round($modInterestRateMoney);
					$c[$iCnt] = -round($modInterestRateMoney * ($selPerson - ($iCnt+1)));
				} else if ($iCnt == ($selPerson -1)) {
					$c[$iCnt] = 0;
					$d[$iCnt] = $interestRateMoney;
				} else {
					$d[$iCnt] = round($modInterestRateMoney * $iCnt);
					$c[$iCnt] = -round($modInterestRateMoney * ($selPerson - ($iCnt+1)));
				}
				// 이자합계 = 대출이자 + 적금이자
				$e[$iCnt] = $c[$iCnt] + $d[$iCnt];
				// 월납입금액 = (수령예정금액 - 이자합계) / 인원수
				$f[$iCnt] = round(($b[$iCnt] - $e[$iCnt]) / $selPerson);
				// 총납입금액 = 월납입금액 * 인원수
				$g[$iCnt] = $f[$iCnt] * $selPerson;

				// 적용이율은 인원수 센터기준에 따라 달라집
				if ( $iCnt < round($selPerson/2)) {
					// 이자율 함수 적용 fnRate인원수, 월납입금액, -수령예정금액, 0(option:생략가능)) * 12개월 * 100
					$h[$iCnt] = fnRate($selPerson, $f[$iCnt], -$b[$iCnt], 0) * 12* 100;
				} else {
					// 이자합계, 월납입금액
					$h[$iCnt] = $e[$iCnt] / ($f[$iCnt] * (($selPerson-1)*($selPerson)/2)) * 12 * 100;
				}
				// 구좌 이용수수료 공제 후 실이자 지급액 = 이자합계 - (수령예정금액 * 0.01)
				$ii[$iCnt] = $e[$iCnt] - ($b[$iCnt] * 0.01);

				// 이자 소득세 차감 후 실이자 지급액(j)
				// 실지급금액 계산(l)
				if ($ii[$iCnt] > 0 ) {
					$m = floor($ii[$iCnt] * 0.25 / 10) * 10;
					$n=  floor($m * 0.1 / 10) * 10;
					$j[$iCnt] = $ii[$iCnt] - $m - $n;
					$l[$iCnt] = $g[$iCnt] + $j[$iCnt];
				} else {
					$j[$iCnt] = 0;
					$l[$iCnt] = $g[$iCnt] + $ii[$iCnt];
				}

				// 세후 이율 계산(k)
				if ( $iCnt < round($selPerson/2) -1) {
					$k[$iCnt] = - fnRate($selPerson, $f[$iCnt], -$l[$iCnt], 0) * 12* 100;
				} else if ( $iCnt == round($selPerson/2) - 1) {
					$k[$iCnt] = $ii[$iCnt]/ ($f[$iCnt] * (($selPerson-1)*($selPerson)/2)) * 12 * 100;
				} else {
					if ($ii[$iCnt] > 0) {
						$k[$iCnt] = $j[$iCnt] / ($f[$iCnt] * (($selPerson-1)*($selPerson)/2)) * 12 * 100;
					} else {
						$k[$iCnt] = $ii[$iCnt] / ($f[$iCnt] * (($selPerson-1)*($selPerson)/2)) * 12 * 100;
					}
				}
				//echo $a[$iCnt]." / ".$b[$iCnt]." / ".$c[$iCnt]." / ".$d[$iCnt]." / ".round($e[$iCnt])." / ".round($f[$iCnt])." / ".round($g[$iCnt])." / ".$h[$iCnt]." / ".$ii[$iCnt]." / ".$j[$iCnt]." / ".$k[$iCnt]." / ".$l[$iCnt]."<br>" ;
				$this->OriginalStageMoney=$this->StageMoney*10000;

				//스테이지 이율표 저장
				$this->sQuery="insert into tbl_stage_payment (ParentIdx,TurnNo,StageMoney,TotalStageMoney,TotalInterest,MonthPayment,TotalPayment,InterestRate,TotalPayments,LoanInterest,SavingInterest,RealInterest,InterestPayment,TexRate) values ('".$this->Idx."','".$a[$iCnt]."','".$this->OriginalStageMoney."','".$b[$iCnt]."','".round($e[$iCnt])."','".round($f[$iCnt])."','".round($g[$iCnt])."','".fnFixed($h[$iCnt])."','".round($l[$iCnt])."','".$c[$iCnt]."','".$d[$iCnt]."','".$ii[$iCnt]."','".$j[$iCnt]."','".$k[$iCnt]."')";
				$this->db->query($this->sQuery);
			}
			//새로운 이율표에 회원정보 매칭
			foreach ($arrData['arrResult'] as $row) {
				$this->sQuery="update tbl_stage_payment set UserIdx='".$row["UserIdx"]."' where ParentIdx='".$this->Idx."' and TurnNo='".$row["TurnNo"]."'";
				$this->db->query($this->sQuery);
			}
		}
		$this->sQuery="update tbl_stage set StageRate='".$this->StageRate."',CategoryIdx='".$this->CategoryIdx."',StageMoney='".$this->StageMoney."',Title='".$this->Title."',Summary='".$this->Summary."',Contents='".$this->Contents."',StageImage='".$this->StageImage."'".$this->sAddQuery." where Idx='".$this->Idx."'";
		$this->db->query($this->sQuery);
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() == FALSE) {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		} else {
			redirect(sSiteUrl."/systems/generalStageModify".$this->sParam,'refresh');
		}
	}
	//waitingStageList
	function waitingStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where State='R' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_generalStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,DATEDIFF(now(),tbl1.RegDate) as OverDate from cms_generalStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrDataSub= $this->db->query($this->sQuery)->result_array();
		$iCnt=0;
		foreach ($arrDataSub as $row) {
			$this->sQuery="select tbl1.UserIdx,tbl1.TurnNo from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$row["Idx"]."'  ";
			$arrDataSub02=$this->db->query($this->sQuery)->result_array();
			$arrDataSub[$iCnt]["ListData"]=$arrDataSub02;
			$iCnt++;
		}
		$arrData['arrResult']=$arrDataSub;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//waitingStageDelProc
	function waitingStageDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->DelReason=addslashes(trim($this->input->get('DelReason')));
		//참여자 체크
		$this->sQuery="select count(tbl1.Idx) as iCnt01 from tbl_stage_apply as tbl1 where tbl1.ParentIdx='".$this->Idx."'";
		$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		if ($this->iCnt01>1) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'개설자 이외의 참여자가 있는 스테이지는 삭제가 불가능합니다.');
		} else {

			$this->db->trans_start(); //트랜잭션 시작
			//삭제 스테이지 정보 저장
			$this->sQuery="insert into tbl_stage_del (Idx,StageCode,Type,State,SecretYN,SecretPWD,CategoryIdx,CategoryName,StageNum,StageMoney,StageRate,Title,Summary,Contents,StageImage,CreateUserIdx,NowTurn,NowReceiveTurn,JumpingCount,RecommendYN,DelReason,RegDate,StartDate,EndDate) select Idx,StageCode,Type,State,SecretYN,SecretPWD,CategoryIdx,CategoryName,StageNum,StageMoney,StageRate,Title,Summary,Contents,StageImage,CreateUserIdx,NowTurn,NowReceiveTurn,JumpingCount,RecommendYN,'".$this->DelReason."' as DelReason,RegDate,StartDate,EndDate from tbl_stage where Idx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			$this->sQuery="insert into tbl_stage_apply_del (Idx,ParentIdx,UserIdx,CompBank,CompAccount,CompOwner,UserBank,UserAccount,UserDepositor,PairIdx,MyTurn,ICSSSNEScore,RegDate) select Idx,ParentIdx,UserIdx,CompBank,CompAccount,CompOwner,UserBank,UserAccount,UserDepositor,PairIdx,MyTurn,ICSSSNEScore,RegDate from tbl_stage_apply where ParentIdx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			$this->sQuery="insert into tbl_stage_payment_del (Idx,ParentIdx,UserIdx,TurnNo,StageMoney,TotalStageMoney,TotalInterest,MonthPayment,TotalPayment,InterestRate,TotalPayments,LoanInterest,SavingInterest,RealInterest,InterestPayment,TexRate,RegDate) select Idx,ParentIdx,UserIdx,TurnNo,StageMoney,TotalStageMoney,TotalInterest,MonthPayment,TotalPayment,InterestRate,TotalPayments,LoanInterest,SavingInterest,RealInterest,InterestPayment,TexRate,RegDate from tbl_stage_payment where ParentIdx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			//참여자 ICSS 점수 복원
			$this->sQuery="select UserIdx from tbl_stage_apply where ParentIdx='".$this->Idx."'";
			$arrDataSub= $this->db->query($this->sQuery)->result_array();
			$this->sQuery="delete from tbl_stage where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			foreach ($arrDataSub as $row) {
				//회원 스테이지 가입 수,약정 대출 금액
				$this->sQuery="select tbl1.MyTurn,tbl2.NowTurn,tbl2.StageNum,(select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y') as DepositCnt,((tbl2.StageNum-tbl1.MyTurn)*(tbl2.StageMoney*10000)) - (if((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y')>tbl1.MyTurn,((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y')-tbl1.MyTurn)*(tbl2.StageMoney*10000),0)) as ICSSTotalMoney from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$row["UserIdx"]."'  and tbl2.State!='E'";
				$arrData['arrResult02']=$this->db->query($this->sQuery);
				$arrUserInfo["iCnt01"]=$arrData['arrResult02']->num_rows();
				$arrUserInfo["iCnt02"]=0;
				foreach ($arrData['arrResult02']->result_array() as $row2) {
					$arrUserInfo["iCnt02"]=$arrUserInfo["iCnt02"]+$row2["ICSSTotalMoney"];
				}
				//ICSS 평점 저장
				$UserICSSSNA=fnICSSSNAccumulate($row["UserIdx"]);
				$UserICSSCLA=(fnICSSCLA($arrUserInfo["iCnt01"],$arrUserInfo["iCnt02"])/100)*10000;
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($row["UserIdx"],"SNScore",$UserICSSSNA);
				fnICSS($row["UserIdx"],"CLAScore",$UserICSSCLA);
				//ICSS 히스토리 저정
				fnICSSHistory($row["UserIdx"]);
			}
			$this->db->trans_complete();//트랜잭션 끝
			if ($this->db->trans_status() == FALSE) {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
			} else {
				$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'스테이지 삭제가 완료되었습니다.');
			}
		}
		return json_encode($arrRetMessage);
	}
	//recommendYNProc
	function recommendYNProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->RecommendYN=addslashes(trim($this->input->get('RecommendYN')));
		$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage where Idx='".$this->Idx."'";
		$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
		if ($this->iCnt01!=0) {
			$this->sQuery="update tbl_stage set RecommendYN='".$this->RecommendYN."' where Idx='".$this->Idx."'";
			$arrData['arrResult']=$this->db->query($this->sQuery);
			if ($arrData['arrResult']) {
				$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'추천 변경이 완료되었습니다.');
			} else {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
			}
		}
		return json_encode($arrRetMessage);
	}
	//waitingStageView
	function waitingStageView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment as tbl1 left join tbl_stage_apply as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->result_array();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//startStageList
	function startStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 5;
		$this->iStepScale = 5;
		$this->sWhere="where State='R' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_startStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,DATEDIFF(now(),tbl1.RegDate) as OverDate from cms_startStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrDataSub= $this->db->query($this->sQuery)->result_array();
		$iCnt=0;
		foreach ($arrDataSub as $row) {
			$this->sQuery="select tbl1.UserIdx,tbl1.TurnNo from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$row["Idx"]."'  ";
			$arrDataSub02=$this->db->query($this->sQuery)->result_array();
			$arrDataSub[$iCnt]["ListData"]=$arrDataSub02;
			$iCnt++;
		}
		$arrData['arrResult']=$arrDataSub;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//startStageView
	function startStageView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment as tbl1 left join tbl_stage_apply as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->result_array();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//startStageProc
	function startStageProc() {
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where tbl1.State='R' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		$this->bHolidayCheck=false;
		//휴일 체크
		$this->sQuery="select tbl1.Holiday FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
		$arrDataHoliday = $this->db->query($this->sQuery)->row();
		if ($arrDataHoliday) {
			$this->arrHoliday=explode("\r\n",$arrDataHoliday->Holiday);
		}
		$this->sQuery="select tbl1.Idx,tbl1.CreateUserIdx,tbl1.Title from cms_startStageList as tbl1 ".$this->sWhere;
		//echo $this->sQuery;
		//exit;
		//$this->sQuery="select tbl1.Idx,tbl1.CreateUserIdx,tbl1.Title from cms_startStageList as tbl1 where tbl1.State='R' and tbl1.StageNum=(select count(Idx) as iCnt01 from tbl_stage_apply where ParentIdx=tbl1.Idx)";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->result();
		$this->db->trans_start(); //트랜잭션 시작
		$this->arrPayDate01=array("","+1 month","+2 month","+3 month","+4 month","+5 month","+6 month","+7 month","+8 month","+9 month","+10 month","+11 month","+12 month","+13 month");
		$dPayDate01 = date("Y-m-d"); //입금일
		$dPayDate02=date("Y-m-d",strtotime($dPayDate01."+3 days")); //지급일
		foreach($arrData['arrResult'] as $row) {
			$this->sQuery="select tbl1.TurnNo,tbl1.UserIdx,tbl1.MonthPayment,tbl1.TotalPayments from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$row->Idx."'  order by tbl1.TurnNo asc ";
			$arrDataSub = $this->db->query($this->sQuery)->result_array();

			$iCnt01=0;
			foreach($arrDataSub as $row02) {
				//입금,지급 예정일 계산
				if ($iCnt01!=0) {
					$dNowDate=date("Y-m-d",strtotime($dPayDate01.$this->arrPayDate01[$iCnt01]));
//					$dNowDate02=date("Y-m-d",strtotime($dPayDate02.$this->arrPayDate01[$iCnt01]));
				} else {
					$dNowDate=$dPayDate01;
//					$dNowDate02=$dPayDate02;
				}
				//입금일 휴일체크
				$bHolidayCheck=false;
				while(!$bHolidayCheck){
					if (is_array($this->arrHoliday)) {
						$bHolidayCheckSub=true;
						for ($iCnt=0; $iCnt<sizeof($this->arrHoliday); $iCnt++) {
							if ($dNowDate==$this->arrHoliday[$iCnt]) {
								$bHolidayCheckSub=false;
								$dNowDate=date("Y-m-d",strtotime($dNowDate."+1 days"));
								break;
							}
						}
						//매주 주말 체크
						if (date('w',strtotime($dNowDate))==0) {
							$bHolidayCheckSub=false;
							$dNowDate=date("Y-m-d",strtotime($dNowDate."+1 days"));
						}
						if (date('w',strtotime($dNowDate))==6) {
							$bHolidayCheckSub=false;
							$dNowDate=date("Y-m-d",strtotime($dNowDate."+2 days"));
						}
						if ($bHolidayCheckSub) {
							$bHolidayCheck=true;
						}
					} else {
						$bHolidayCheck=true;
					}
				}
				$iDatCnt = fnHolidayCheck($dNowDate,$this->arrHoliday);
				fnLogWrite($iDatCnt);
				$dNowDate02=date("Y-m-d",strtotime($dNowDate."+3 days"));
				if ($iDatCnt!=0) {
					$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+".$iDatCnt." days")); //지급일
				}
				//지급일 휴일체크
				$bHolidayCheck02=false;
				while(!$bHolidayCheck02){
					if (is_array($this->arrHoliday)) {
						$bHolidayCheckSub02=true;
						for ($iCnt=0; $iCnt<sizeof($this->arrHoliday); $iCnt++) {
							if ($dNowDate02==$this->arrHoliday[$iCnt]) {
								$bHolidayCheckSub02=false;
								$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+1 days"));
								break;
							}
						}
						//매주 주말 체크
						if (date('w',strtotime($dNowDate02))==0) {
							$bHolidayCheckSub02=false;
							$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+1 days"));
						}
						if (date('w',strtotime($dNowDate02))==6) {
							$bHolidayCheckSub02=false;
							$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+2 days"));
						}
						if ($bHolidayCheckSub02) {
							$bHolidayCheck02=true;
						}
					} else {
						$bHolidayCheck02=true;
					}
				}
				//입금데이터 저장
				foreach($arrDataSub as $row03) {
					$this->sQuery="insert into tbl_stage_deposit (ParentIdx,TurnNo,UserIdx,ScheduledDepositMoney,DefaultMoney,ControlDepositMoney,DepositState,DefaultDepositDate,ScheduledDepositDate) values ('".$row->Idx."','".$row02["TurnNo"]."','".$row03["UserIdx"]."','".$row03["MonthPayment"]."','".$row03["MonthPayment"]."','0','A','".$dNowDate."','".$dNowDate."')";
					$this->db->query($this->sQuery);
					if ($iCnt01==0) {
						//효력개시 알림 등록
						$this->sAlarmMessage="회원님이 참여하신 ".$row->Title." Stage의 효력이 개시되었습니다. 선택하신 입금 계좌로 1회차 월 납입금 ".number_format($row03["MonthPayment"])."원을 입금해 주세요. 1회차 납입일은 ".date("m",strtotime($dNowDate))."월 ".date("d",strtotime($dNowDate))."일 입니다.";
						$this->utilmodel->fnAlarm($row03["UserIdx"],$this->sAlarmMessage,"Y","S");
					}
				}
				//지급 데이터 저장
				$this->sQuery="insert into tbl_stage_receive (ParentIdx,TurnNo,UserIdx,ScheduledReceiveMoney,DefaultMoney,ScheduledReceiveDate,DefaultReceiveDate) values ('".$row->Idx."','".$row02["TurnNo"]."','".$row02["UserIdx"]."','".$row02["TotalPayments"]."','".$row02["TotalPayments"]."','".$dNowDate02."','".$dNowDate02."')";
				$this->db->query($this->sQuery);
			$iCnt01++;
			}
			$this->sQuery="update tbl_stage set State='S',StartDate=now(),NowTurn=1,NowReceiveTurn=1,EndDate='".$dNowDate02."' where Idx='".$row->Idx."'";
			$this->db->query($this->sQuery);
			//효력개시 점핑쿠폰 지급
			foreach($arrDataSub as $row04) {
				if ($row->CreateUserIdx==$row04["UserIdx"]) {
					$sQuery="SELECT Title,CouponCnt FROM tbl_jumping_coupon WHERE Idx='2'";
					$arrDataSub02= $this->db->query($sQuery)->row();
					if ($arrDataSub02) {
						//기존회원 쿠폰 카운트 조회
						$this->sQuery="SELECT ifnull(sum(tbl1.point),0) as NowTotalPoint FROM tbl_member_jumping_coupon as tbl1 where UserIdx='".$row04["UserIdx"]."'";
						$CouponContents=$arrDataSub02->Title;
						$CouponCnt=$arrDataSub02->CouponCnt;
						$NowTotalPoint= $this->db->query($this->sQuery)->row()->NowTotalPoint+$CouponCnt;
						$sQuery="insert into tbl_member_jumping_coupon (UserIdx,Contents,Point,NowTotalPoint) values ('".$row04["UserIdx"]."','".$CouponContents."','".$CouponCnt."','".$NowTotalPoint."')";
						$this->db->query($sQuery);
					}
				} else {
					$sQuery="SELECT Title,CouponCnt FROM tbl_jumping_coupon WHERE Idx='4'";
					$arrDataSub02= $this->db->query($sQuery)->row();
					if ($arrDataSub02) {
						//기존회원 쿠폰 카운트 조회
						$this->sQuery="SELECT ifnull(sum(tbl1.point),0) as NowTotalPoint FROM tbl_member_jumping_coupon as tbl1 where UserIdx='".$row04["UserIdx"]."'";
						$CouponContents=$arrDataSub02->Title;
						$CouponCnt=$arrDataSub02->CouponCnt;
						$NowTotalPoint= $this->db->query($this->sQuery)->row()->NowTotalPoint+$CouponCnt;
						$sQuery="insert into tbl_member_jumping_coupon (UserIdx,Contents,Point,NowTotalPoint) values ('".$row04["UserIdx"]."','".$CouponContents."','".$CouponCnt."','".$NowTotalPoint."')";
						$this->db->query($sQuery);
					}
				}
				//알림 등록
				$this->sAlarmMessage="쿠폰이 ".$CouponCnt."개가 변동되었습니다.";
				$this->utilmodel->fnAlarm($row04["UserIdx"],$this->sAlarmMessage,"N","C");
			}
			//ICSS SNE 적용
			foreach($arrDataSub as $row05) {
				//$this->sQuery="select count(DISTINCT tbl3.UserIdx) as iCnt01,count(tbl3.UserIdx) as iCnt02 from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage_payment as tbl3 on tbl2.Idx=tbl3.ParentIdx where tbl1.UserIdx='".$row05["UserIdx"]."' and tbl2.State in ('S','L','W') and tbl3.UserIdx in (select tbl4.friendIdx from tbl_friend as tbl4 where tbl4.UserIdx='".$row05["UserIdx"]."')";
				$this->sQuery="select tbl2.UserIdx from tbl_stage_apply as tbl1 left join tbl_stage_payment as tbl2 on tbl1.ParentIdx=tbl2.ParentIdx where tbl1.UserIdx='".$row05["UserIdx"]."' and tbl1.ParentIdx='".$row->Idx."' and tbl2.UserIdx in (select tbl3.friendIdx from tbl_friend as tbl3 where tbl3.UserIdx='".$row05["UserIdx"]."')";
				//fnLogWrite($this->sQuery);
				$arrDataSub03 = $this->db->query($this->sQuery)->result_array();
				$ICSSCnt01=0;
				foreach($arrDataSub03 as $row06) {
					//재매칭 체크
					$this->sQuery="select count(tbl1.Idx) as iCnt01 from tbl_stage_friends as tbl1 where tbl1.UserIdx='".$row05["UserIdx"]."' and tbl1.FriendIdx='".$row06["UserIdx"]."'";
					$iFriendCnt01 = $this->db->query($this->sQuery)->row_array()["iCnt01"];
					if ($iFriendCnt01!=0) {
						$ICSSCnt01++;
					}
				}
				foreach($arrDataSub03 as $row06) {
					//누적친구 저장
					$this->sQuery="select count(tbl1.Idx) as iCnt01 from tbl_stage_friends as tbl1 where tbl1.UserIdx='".$row05["UserIdx"]."' and tbl1.FriendIdx='".$row06["UserIdx"]."' ";
					$iFriendCnt02 = $this->db->query($this->sQuery)->row_array()["iCnt01"];
					if ($iFriendCnt02==0) {
						$this->sQuery="insert into tbl_stage_friends (UserIdx,FriendIdx) values ('".$row05["UserIdx"]."','".$row06["UserIdx"]."')";
						$this->db->query($this->sQuery);
					}
				}
				//SNE 평점 저장 (재매칭수=친구수 계산)
				$UserICSSSNE01=(fnICSSSNE02($ICSSCnt01,$ICSSCnt01)/100)*10000;
				$Test01="재매칭 횟수 : ".$ICSSCnt01." 친구수 : ".$ICSSCnt01." SNE값 : ".$UserICSSSNE01;
				//fnLogWrite($Test01);
				$this->sQuery="update tbl_stage_apply set ICSSSNEScore='".$UserICSSSNE01."' where ParentIdx='".$row->Idx."' and UserIdx='".$row05["UserIdx"]."'";
				$this->db->query($this->sQuery);
				$this->sQuery="select SNEScore from tbl_member_ICSS where UserIdx='".$row05["UserIdx"]."'";
				$UserICSSSNE02= $this->db->query($this->sQuery)->row_array()["SNEScore"];
				$UserICSSSNE02=$UserICSSSNE02-$UserICSSSNE01;
				/*
				if ($UserICSSSNE02<0) {
					$UserICSSSNE02=0;
				}
				*/
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($row05["UserIdx"],"SNEScore",$UserICSSSNE02);
				//ICSS 히스토리 저정
				fnICSSHistory($row05["UserIdx"]);
			}
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() == FALSE) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		} else {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'효력개시가 완료되었습니다.');
		}
		return json_encode($arrRetMessage);
	}
	//overdueStageList
	function overdueStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where tbl1.State in ('C','L','W') ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_generalStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,DATEDIFF(now(),tbl1.RegDate) as OverDate from cms_generalStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//StageStateChagneProc
	function StageStateChagneProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->ChangeState=addslashes(trim($this->input->get('ChangeState')));
		if ($this->Idx==""||$this->ChangeState=="R"||$this->ChangeState=="D"||$this->ChangeState=="E") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage where Idx='".$this->Idx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="update tbl_stage set State='".$this->ChangeState."' where Idx='".$this->Idx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'상태 변경이 완료되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			}
		}
		return json_encode($arrRetMessage);
	}
	//incompleteStageList
	function incompleteStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where State='R' ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_generalStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.*,DATEDIFF(now(),tbl1.RegDate) as OverDate from cms_generalStageList as tbl1 ".$this->sWhere." order by OverDate desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrDataSub= $this->db->query($this->sQuery)->result_array();
		$iCnt=0;
		foreach ($arrDataSub as $row) {
			$this->sQuery="select tbl1.UserIdx,tbl1.TurnNo from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$row["Idx"]."'  ";
			$arrDataSub02=$this->db->query($this->sQuery)->result_array();
			$arrDataSub[$iCnt]["ListData"]=$arrDataSub02;
			$iCnt++;
		}
		$arrData['arrResult']=$arrDataSub;
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//incompleteStageView
	function incompleteStageView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment as tbl1 left join tbl_stage_apply as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->result_array();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//incompleteStageDelProc
	function incompleteStageDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->DelReason=addslashes(trim($this->input->get('DelReason')));
		$this->DelCheck=false;
		//스테이지 경과일 체크
		$this->sQuery="select DATEDIFF(now(),tbl1.RegDate) as OverDate from cms_generalStageList as tbl1 where tbl1.Idx='".$this->Idx."'";
		$this->OverDate=$this->db->query($this->sQuery)->row_array()["OverDate"];
		if ($this->OverDate>30) {
			$this->DelCheck=true;
		} else {
			//참여자 체크
			$this->sQuery="select count(tbl1.Idx) as iCnt01 from tbl_stage_apply as tbl1 where tbl1.ParentIdx='".$this->Idx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
			if ($this->iCnt01>1) {
				$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'개설자 이외의 참여자가 있는 스테이지는 삭제가 불가능합니다.');
			} else {
				$this->DelCheck=true;
			}
		}
		if ($this->DelCheck) {
			$this->db->trans_start(); //트랜잭션 시작
			//삭제 스테이지 정보 저장
			$this->sQuery="insert into tbl_stage_del (Idx,StageCode,Type,State,SecretYN,SecretPWD,CategoryIdx,CategoryName,StageNum,StageMoney,StageRate,Title,Summary,Contents,StageImage,CreateUserIdx,NowTurn,NowReceiveTurn,JumpingCount,RecommendYN,DelReason,RegDate,StartDate,EndDate) select Idx,StageCode,Type,State,SecretYN,SecretPWD,CategoryIdx,CategoryName,StageNum,StageMoney,StageRate,Title,Summary,Contents,StageImage,CreateUserIdx,NowTurn,NowReceiveTurn,JumpingCount,RecommendYN,'".$this->DelReason."' as DelReason,RegDate,StartDate,EndDate from tbl_stage where Idx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			$this->sQuery="insert into tbl_stage_apply_del (Idx,ParentIdx,UserIdx,CompBank,CompAccount,CompOwner,UserBank,UserAccount,UserDepositor,PairIdx,MyTurn,ICSSSNEScore,RegDate) select Idx,ParentIdx,UserIdx,CompBank,CompAccount,CompOwner,UserBank,UserAccount,UserDepositor,PairIdx,MyTurn,ICSSSNEScore,RegDate from tbl_stage_apply where ParentIdx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			$this->sQuery="insert into tbl_stage_payment_del (Idx,ParentIdx,UserIdx,TurnNo,StageMoney,TotalStageMoney,TotalInterest,MonthPayment,TotalPayment,InterestRate,TotalPayments,LoanInterest,SavingInterest,RealInterest,InterestPayment,TexRate,RegDate) select Idx,ParentIdx,UserIdx,TurnNo,StageMoney,TotalStageMoney,TotalInterest,MonthPayment,TotalPayment,InterestRate,TotalPayments,LoanInterest,SavingInterest,RealInterest,InterestPayment,TexRate,RegDate from tbl_stage_payment where ParentIdx='".$this->Idx."' ";
			$this->db->query($this->sQuery);
			//참여자 ICSS 점수 복원
			$this->sQuery="select UserIdx from tbl_stage_apply where ParentIdx='".$this->Idx."'";
			$arrDataSub= $this->db->query($this->sQuery)->result_array();
			$this->sQuery="delete from tbl_stage where Idx='".$this->Idx."'";
			$this->db->query($this->sQuery);
			foreach ($arrDataSub as $row) {
				//회원 스테이지 가입 수,약정 대출 금액
				$this->sQuery="select tbl1.MyTurn,tbl2.NowTurn,tbl2.StageNum,(select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y') as DepositCnt,((tbl2.StageNum-tbl1.MyTurn)*(tbl2.StageMoney*10000)) - (if((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y')>tbl1.MyTurn,((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$row["UserIdx"]."' and DepositState='Y')-tbl1.MyTurn)*(tbl2.StageMoney*10000),0)) as ICSSTotalMoney from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$row["UserIdx"]."'  and tbl2.State!='E'";
				$arrData['arrResult02']=$this->db->query($this->sQuery);
				$arrUserInfo["iCnt01"]=$arrData['arrResult02']->num_rows();
				$arrUserInfo["iCnt02"]=0;
				foreach ($arrData['arrResult02']->result_array() as $row2) {
					$arrUserInfo["iCnt02"]=$arrUserInfo["iCnt02"]+$row2["ICSSTotalMoney"];
				}
				//ICSS 평점 저장
				$UserICSSSNA=fnICSSSNAccumulate($row["UserIdx"]);
				$UserICSSCLA=(fnICSSCLA($arrUserInfo["iCnt01"],$arrUserInfo["iCnt02"])/100)*10000;
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($row["UserIdx"],"SNScore",$UserICSSSNA);
				fnICSS($row["UserIdx"],"CLAScore",$UserICSSCLA);
				//ICSS 히스토리 저정
				fnICSSHistory($row["UserIdx"]);
			}
			$this->db->trans_complete();//트랜잭션 끝
			if ($this->db->trans_status() == FALSE) {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
			} else {
				$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'스테이지 삭제가 완료되었습니다.');
			}
		}
		return json_encode($arrRetMessage);
	}
	//cancelStageList
	function cancelStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchReason=addslashes(trim($this->input->get('sSearchReason')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
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
		if ($this->sSearchReason) {
			$this->sWhere.=" and tbl1.LeaveReason='".fnLeaveReason($this->sSearchReason)."' ";
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_cancelStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from cms_cancelStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchReason']=$this->sSearchReason;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}

	//cancelStageListExcel
	function cancelStageListExcel() {
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchReason=addslashes(trim($this->input->get('sSearchReason')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchReason) {
			$this->sWhere.=" and tbl1.LeaveReason='".fnLeaveReason($this->sSearchReason)."' ";
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_cancelStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* from cms_cancelStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		# 시트지정

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('스테이지 취소자 리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '스테이지명');
		$this->excel->getActiveSheet()->setCellValue('D1', '개설자');
		$this->excel->getActiveSheet()->setCellValue('E1', '이율');
		$this->excel->getActiveSheet()->setCellValue('F1', '인원수');
		$this->excel->getActiveSheet()->setCellValue('G1', '약정금액');
		$this->excel->getActiveSheet()->setCellValue('H1', '개설일');
		$this->excel->getActiveSheet()->setCellValue('I1', '취소자명');
		$this->excel->getActiveSheet()->setCellValue('J1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('K1', '취소이유');
		$this->excel->getActiveSheet()->setCellValue('L1', '취소일');

		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["Title"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["CreatUserNickName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["StageRate"]."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["StageNum"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row["StageMoney"]*$row["StageNum"]*10000,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["CreateRegDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row["LeaveUserNickName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row["UserTel"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row["LeaveReason"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row["LeaveDate"],PHPExcel_Cell_DataType::TYPE_STRING);

			$this->excel->getActiveSheet()->getStyle('A'.$n.':L'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName='스테이지_취소자_리스트';
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
	//cancelStageView
	function cancelStageView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($this->Idx);
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment as tbl1 left join tbl_stage_apply as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->result_array();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}


	/* Stage Manage */
	//donateStageList
	function donateStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));

		// 전체 나눔회원, 금월 나눔회원, 전월 나눔회원 카운트
		$previousMonth = date('Y-m', strtotime('first day of last month'));
		$nowMonth = date('Y-m', strtotime('first day of this month'));
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_donate_apply as tbl1";
		$this->totalMonthCnt=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iMonthTotalCnt']=$this->totalMonthCnt;
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_donate_apply as tbl1 Where RegDate like '".$previousMonth."%'";
		$this->previousMonthCnt=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iPreviousTotalCnt']=$this->previousMonthCnt;
		$this->sQuery="SELECT count(tbl1.idx) as iCnt FROM tbl_donate_apply as tbl1 Where RegDate like '".$nowMonth."%'";
		$this->nowMonthCnt=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iNowTotalCnt']=$this->nowMonthCnt;

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
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_donate as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		//echo "SELECT tbl1.* FROM tbl_donate as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//donateStageCreate
	function donateStageCreate() {
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//donateStageCreateProc
	function donateStageCreateProc() {
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->arrRetFile=$this->utilmodel->do_upload("StageImage",sUploadFolder02);
		$this->StageImage=$this->arrRetFile[0];
		$this->TargetMoney=addslashes($this->input->post('TargetMoney'));
		//$this->DonateMoney=addslashes($this->input->post('DonateMoney'));
		$this->StageStart=addslashes($this->input->post('StageStart'));
		$this->StageEnd=addslashes($this->input->post('StageEnd'));
		$this->BankAccount1=addslashes($this->input->post('BankAccount1'));
		$this->BankName1=addslashes($this->input->post('BankName1'));
		$this->BankDepositor1=addslashes($this->input->post('BankDepositor1'));
		$this->BankAccount2=addslashes($this->input->post('BankAccount2'));
		$this->BankName2=addslashes($this->input->post('BankName2'));
		$this->BankDepositor2=addslashes($this->input->post('BankDepositor2'));

		$this->arrRetFile=$this->utilmodel->do_upload("CompanyLogoImage",sUploadFolder02);
		$this->CompanyLogoImage=$this->arrRetFile[0];
		$this->CompanyName=addslashes($this->input->post('CompanyName'));
		$this->CompanyDamdang=addslashes($this->input->post('CompanyDamdang'));
		$this->CompanyTel=addslashes($this->input->post('CompanyTel'));
		$this->CompanyAddress=addslashes($this->input->post('CompanyAddress'));
		$this->CompanyHomepage=addslashes($this->input->post('CompanyHomepage'));

		$this->arrRetFile=$this->utilmodel->do_upload("DetailImage1",sUploadFolder02);
		$this->DetailImage1=$this->arrRetFile[0];
		$this->DetailMedia1=addslashes($this->input->post('DetailMedia1'));
		$this->DetailContent1=addslashes($this->input->post('DetailContent1'));
		$this->arrRetFile=$this->utilmodel->do_upload("DetailImage2",sUploadFolder02);
		$this->DetailImage2=$this->arrRetFile[0];
		$this->DetailMedia2=addslashes($this->input->post('DetailMedia2'));
		$this->DetailContent2=addslashes($this->input->post('DetailContent2'));
		$this->arrRetFile=$this->utilmodel->do_upload("DetailImage3",sUploadFolder02);
		$this->DetailImage3=$this->arrRetFile[0];
		$this->DetailMedia3=addslashes($this->input->post('DetailMedia3'));
		$this->DetailContent3=addslashes($this->input->post('DetailContent3'));
		$this->StatusYn=addslashes($this->input->post('StatusYn'));
		$this->DisplayYn=addslashes($this->input->post('DisplayYn'));

		//카테고리 코드 조회
		$this->CategoryCode="N";
		$this->SearchCode=$this->CategoryCode.fnStageCode();
		$this->sQuery="SELECT MAX(tbl1.StageCode) as StageCode FROM tbl_stage_code as tbl1 WHERE left(tbl1.StageCode,5)='".$this->SearchCode."' order by tbl1.StageCode desc";
		$arrData['arrResult']= $this->db->query($this->sQuery)->row();
		if ($arrData['arrResult']->StageCode) {
			$this->StageCode=$arrData['arrResult']->StageCode;
			$this->StageCode01=substr($this->StageCode,5,1);
			$this->StageCode02=substr($this->StageCode,6,2);
			if ($this->StageCode02=="99") {
				++$this->StageCode01;
				$this->StageCode02="1";
			} else {
				++$this->StageCode02;
			}
			$this->iRemainSpace=3-strlen($this->StageCode02);
			for ($iCnt=0;$iCnt<$this->iRemainSpace;$iCnt++) {
				$this->StageCode02="0".$this->StageCode02;
			}
			$this->StageCode=$this->SearchCode.$this->StageCode02;
		} else {
			$this->StageCode01=fnStageCode();
			$this->StageCode02="001";
			$this->StageCode=$this->CategoryCode.$this->StageCode01.$this->StageCode02;
		}
		//코드저장
		$this->sQuery="insert into tbl_stage_code (StageCode) values ('".$this->StageCode."')";
		$this->db->query($this->sQuery);

		$this->sQuery="insert into tbl_donate (StageCode,Title,Summary,StageImage,TargetMoney,StageStart,StageEnd,BankAccount1,BankName1,BankAccount2,BankName2,CompanyLogoImage,CompanyName,CompanyDamdang,CompanyTel,CompanyAddress,CompanyHomepage,DetailImage1,DetailMedia1,DetailContent1,DetailImage2,DetailMedia2,DetailContent2,DetailImage3,DetailMedia3,DetailContent3,StatusYn,DisplayYn,BankDepositor1,BankDepositor2) values ('".$this->StageCode."','".$this->Title."','".$this->Summary."','".$this->StageImage."','".$this->TargetMoney."','".$this->StageStart."','".$this->StageEnd."','".$this->BankAccount1."','".$this->BankName1."','".$this->BankAccount2."','".$this->BankName2."','".$this->CompanyLogoImage."','".$this->CompanyName."','".$this->CompanyDamdang."','".$this->CompanyTel."','".$this->CompanyAddress."','".$this->CompanyHomepage."','".$this->DetailImage1."','".$this->DetailMedia1."','".$this->DetailContent1."','".$this->DetailImage2."','".$this->DetailMedia2."','".$this->DetailContent2."','".$this->DetailImage3."','".$this->DetailMedia3."','".$this->DetailContent3."','".$this->StatusYn."','".$this->DisplayYn."','".$this->BankDepositor1."','".$this->BankDepositor2."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl.'/systems/donateStageList','refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//donateStageDelProc
	function donateStageDelProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="delete from tbl_donate where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'나눔스테이지 삭제가 완료되었습니다.');
		} else {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
		}
		return json_encode($arrRetMessage);
	}
	//donateStageInformation
	function donateStageInformation() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//donateStageApplicant
	function donateStageApplicant() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->ParentIdx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 where tbl1.Idx='".$this->ParentIdx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$this->sWhere="where ParentIdx='".$this->ParentIdx."' ";
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_donate_apply as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM tbl_donate_apply as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		$arrData['ParentIdx']=$this->ParentIdx;

		return $arrData;
	}
	//donateStageApplicantAjax
	function donateStageApplicantAjax() {
		$this->sPage02=addslashes(trim($this->input->get('sPage02')));
		$this->UserIdx=addslashes(trim($this->input->get('UserIdx')));
		$this->ParentIdx=addslashes(trim($this->input->get('ParentIdx')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where ParentIdx='".$this->ParentIdx."' ";
		if(!$this->sPage02){ $this->sPage02 = 1;}
		$this->iStart=($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_donate_apply as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage02-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from tbl_donate_apply as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['iPageScale']=$this->iPageScale;
		$arrData['iStepScale']=$this->iStepScale;
		$arrData['sPage02']=$this->sPage02;
		return json_encode($arrData);
	}
	//donateStageApplicantExcel
	function donateStageApplicantExcel() {
		$this->ParentIdx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 where tbl1.Idx='".$this->ParentIdx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$this->sWhere="where ParentIdx='".$this->ParentIdx."' ";
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_donate_apply as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM tbl_donate_apply as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		# 시트지정

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle($arrData['arrResult02']->Title.'_참여회원_리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(70);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '이름');
		$this->excel->getActiveSheet()->setCellValue('C1', '주민번호');
		$this->excel->getActiveSheet()->setCellValue('D1', '휴대전화');
		$this->excel->getActiveSheet()->setCellValue('E1', '주소');
		$this->excel->getActiveSheet()->setCellValue('F1', '나눔일');

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
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserPSNNo"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserTel"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["UserAddress01"].$row["UserAddress02"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["RegDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':F'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName=$arrData['arrResult02']->Title.'_참여회원_리스트';
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


	//donateStageStats
	function donateStageStats() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		$this->sYear=addslashes(trim($this->input->get('start2')));
		if (!$this->sYear) $this->sYear=date("Y");
		$arrData['sYear']=$this->sYear;
		$this->sQuery="SELECT date_format(RegDate, '%m') as mon, count(idx) FROM `tbl_donate_apply` Where RegDate like '".$this->sYear."-%'  group by date_format(RegDate, '%Y-%m')";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$rows = array();
		foreach ($arrData['arrResult'] as $row) {
		  $rows[] = array_values((array)$row);
		}
		$arrData['jsonResult'] = $rows;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();

		return $arrData;
	}
	//donateStageModify
	function donateStageModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_donate as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult']) { exit; }
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//donateStageModifyProc
	function donateStageModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->Title=addslashes($this->input->post('Title'));
		$this->Summary=addslashes($this->input->post('Summary'));
		$this->TargetMoney=addslashes($this->input->post('TargetMoney'));
		//$this->DonateMoney=addslashes($this->input->post('DonateMoney'));
		$this->StageStart=addslashes($this->input->post('StageStart'));
		$this->StageEnd=addslashes($this->input->post('StageEnd'));
		$this->BankAccount1=addslashes($this->input->post('BankAccount1'));
		$this->BankName1=addslashes($this->input->post('BankName1'));
		$this->BankDepositor1=addslashes($this->input->post('BankDepositor1'));
		$this->BankAccount2=addslashes($this->input->post('BankAccount2'));
		$this->BankName2=addslashes($this->input->post('BankName2'));
		$this->BankDepositor2=addslashes($this->input->post('BankDepositor2'));
		$this->CompanyName=addslashes($this->input->post('CompanyName'));
		$this->CompanyDamdang=addslashes($this->input->post('CompanyDamdang'));
		$this->CompanyTel=addslashes($this->input->post('CompanyTel'));
		$this->CompanyAddress=addslashes($this->input->post('CompanyAddress'));
		$this->CompanyHomepage=addslashes($this->input->post('CompanyHomepage'));
		$this->DetailMedia1=addslashes($this->input->post('DetailMedia1'));
		$this->DetailContent1=addslashes($this->input->post('DetailContent1'));
		$this->DetailMedia2=addslashes($this->input->post('DetailMedia2'));
		$this->DetailContent2=addslashes($this->input->post('DetailContent2'));
		$this->DetailMedia3=addslashes($this->input->post('DetailMedia3'));
		$this->DetailContent3=addslashes($this->input->post('DetailContent3'));
		$this->StatusYn=addslashes($this->input->post('StatusYn'));
		$this->DisplayYn=addslashes($this->input->post('DisplayYn'));

		$this->DetailImageDel2=addslashes($this->input->post('DetailImageDel2'));
		$this->DetailImageDel3=addslashes($this->input->post('DetailImageDel3'));
		$this->DetailMediaDel1=addslashes($this->input->post('DetailMediaDel1'));
		$this->DetailMediaDel2=addslashes($this->input->post('DetailMediaDel2'));
		$this->DetailMediaDel3=addslashes($this->input->post('DetailMediaDel3'));

		$StageImage = "";
		$CompanyLogoImage = "";
		$DetailImage1 = "";
		$DetailImage2 = "";
		$DetailImage3 = "";
		$DetailMedia1 = "";
		$DetailMedia2 = "";
		$DetailMedia3 = "";

		// file upload null check
		if ($_FILES['StageImage']['size'][0] > 0) {
			$this->arrRetFile=$this->utilmodel->do_upload("StageImage",sUploadFolder02);
			$this->NewStageImage=$this->arrRetFile[0];
			$StageImage = ",StageImage='".$this->NewStageImage."'";
		}

		if ($_FILES['CompanyLogoImage']['size'][0] > 0) {
			$this->arrRetFile=$this->utilmodel->do_upload("CompanyLogoImage",sUploadFolder02);
			$this->NewCompanyLogoImage=$this->arrRetFile[0];
			$CompanyLogoImage = ",CompanyLogoImage='".$this->NewCompanyLogoImage."'";
		}

		if ($_FILES['DetailImage1']['size'][0] > 0) {
			$this->arrRetFile=$this->utilmodel->do_upload("DetailImage1",sUploadFolder02);
			$this->NewDetailImage1=$this->arrRetFile[0];
			$DetailImage1 = ",DetailImage1='".$this->NewDetailImage1."'";
		}

		if ($this->DetailMedia1) {
			$DetailMedia1 = ",DetailMedia1='".$this->DetailMedia1."'";
		} else {
			if ($this->DetailMediaDel1 == 'Y') {
				$DetailMedia1 = ",DetailMedia1=''";
			}
		}

		if ($_FILES['DetailImage2']['size'][0] > 0) {
			$this->arrRetFile=$this->utilmodel->do_upload("DetailImage2",sUploadFolder02);
			$this->NewDetailImage2=$this->arrRetFile[0];
			$DetailImage2 = ",DetailImage2='".$this->NewDetailImage2."'";
		} else {
			if ($this->DetailImageDel2 == 'Y') {
				$DetailImage2 = ",DetailImage2=''";
			}
		}

		if ($this->DetailMedia2) {
			$DetailMedia2 = ",DetailMedia2='".$this->DetailMedia2."'";
		} else {
			if ($this->DetailMediaDel2 == 'Y') {
				$DetailMedia2 = ",DetailMedia2=''";
			}
		}

		if ($_FILES['DetailImage3']['size'][0] > 0) {
			$this->arrRetFile=$this->utilmodel->do_upload("DetailImage3",sUploadFolder02);
			$this->NewDetailImage3=$this->arrRetFile[0];
			$DetailImage3 = ",DetailImage3='".$this->NewDetailImage3."'";
		} else {
			if ($this->DetailImageDel3 == 'Y') {
				$DetailImage3 = ",DetailImage3=''";
			}
		}

		if ($this->DetailMedia3) {
			$DetailMedia3 = ",DetailMedia3='".$this->DetailMedia3."'";
		} else {
			if ($this->DetailMediaDel3 == 'Y') {
				$DetailMedia3 = ",DetailMedia3=''";
			}
		}

		$updateYnParam = $StageImage.$CompanyLogoImage.$DetailImage1.$DetailMedia1.$DetailImage2.$DetailMedia2.$DetailImage3.$DetailMedia3;

		$this->sQuery="update tbl_donate set Title='".$this->Title."',Summary='".$this->Summary."',TargetMoney='".$this->TargetMoney."',StageStart='".$this->StageStart."',StageEnd='".$this->StageEnd."',BankAccount1='".$this->BankAccount1."',BankName1='".$this->BankName1."',BankDepositor1='".$this->BankDepositor1."',BankAccount2='".$this->BankAccount2."',BankName2='".$this->BankName2."',BankDepositor2='".$this->BankDepositor2."',CompanyName='".$this->CompanyName."',CompanyDamdang='".$this->CompanyDamdang."',CompanyTel='".$this->CompanyTel."',CompanyAddress='".$this->CompanyAddress."',CompanyHomepage='".$this->CompanyHomepage."',DetailContent1='".$this->DetailContent1."',DetailContent2='".$this->DetailContent2."',DetailContent3='".$this->DetailContent3."',StatusYn='".$this->StatusYn."',DisplayYn='".$this->DisplayYn."'".$updateYnParam." where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);

		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/systems/donateStageModify".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}

	//iptResultItemModify
	function iptResultItemModify() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_IPT_contents as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData = $this->db->query($this->sQuery)->row();
		if (!$arrData) { exit; }
		echo json_encode($arrData);
	}
	//iptResultItemModifyProc
	function iptResultItemModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->sQuery="update tbl_IPT_contents set Contents='".$this->Contents."' where Idx='".$this->Idx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery);
		if ($arrData['arrResult']) {
			redirect(sSiteUrl."/systems/iptResultItem".$this->sParam,'refresh');
		} else {
			echo "알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.";
		}
	}
	//icssManage
	function icssManage() {
		$this->sQuery="SELECT tbl1.Idx,tbl1.ICSS,tbl1.LimitScore01,tbl1.LimitScore02,tbl1.LimitMinLoan,tbl1.LimitMaxLoan,tbl1.MonthLimitLoan FROM tbl_ICSS_score as tbl1 order by Idx asc";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		if (!$arrData['arrResult']) { fnAlertMsg("잘못된 접근입니다."); }
		return $arrData;
	}
	//icssUpdateProc
	function icssUpdateProc() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->LimitScore01=addslashes(trim($this->input->get('LimitScore01')));
		$this->LimitScore02=addslashes(trim($this->input->get('LimitScore02')));
		$this->LimitMinLoan=addslashes(trim($this->input->get('LimitMinLoan')));
		$this->LimitMaxLoan=addslashes(trim($this->input->get('LimitMaxLoan')));
		$this->MonthLimitLoan=addslashes(trim($this->input->get('MonthLimitLoan')));
		if ($this->Idx=="") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_ICSS_score where Idx='".$this->Idx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="update tbl_ICSS_score set LimitScore01='".$this->LimitScore01."',LimitScore02='".$this->LimitScore02."',LimitMinLoan='".$this->LimitMinLoan."',LimitMaxLoan='".$this->LimitMaxLoan."',MonthLimitLoan='".$this->MonthLimitLoan."' where Idx='".$this->Idx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'I-CSS 수정이 완료되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			} else {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
			}
		}
		echo json_encode($arrRetMessage);
	}
	//icssUpdateAllProc
	function icssUpdateAllProc() {
		$this->Idx=$this->input->post('Idx');
		$this->LimitScore01=$this->input->post('LimitScore01');
		$this->LimitScore02=$this->input->post('LimitScore02');
		$this->LimitMinLoan=$this->input->post('LimitMinLoan');
		$this->LimitMaxLoan=$this->input->post('LimitMaxLoan');
		$this->MonthLimitLoan=$this->input->post('MonthLimitLoan');
		$this->db->trans_start(); //트랜잭션 시작
		for ($iCnt=0; $iCnt<sizeof($this->Idx); $iCnt++){
			$this->sQuery="update tbl_ICSS_score set LimitScore01='".addslashes(trim($this->LimitScore01[$iCnt]))."',LimitScore02='".addslashes(trim($this->LimitScore02[$iCnt]))."',LimitMinLoan='".addslashes(trim($this->LimitMinLoan[$iCnt]))."',LimitMaxLoan='".addslashes(trim($this->LimitMaxLoan[$iCnt]))."',MonthLimitLoan='".addslashes(trim($this->MonthLimitLoan[$iCnt]))."' where Idx='".addslashes(trim($this->Idx[$iCnt]))."'";
			$this->db->query($this->sQuery);
		}
		$this->db->trans_complete();//트랜잭션 끝
		if ($this->db->trans_status() === FALSE) {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.');
		} else {
			$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'I-CSS 수정이 완료되었습니다.');
		}
		echo json_encode($arrRetMessage);
	}
	//stageWithdrawList
	function stageWithdrawList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchAdminIdx=addslashes(trim($this->input->get('sSearchAdminIdx')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
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
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchAdminIdx) { $this->sWhere.=" and tbl1.AdminIdx='".$this->sSearchAdminIdx."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_stageWithdrawList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from cms_stageWithdrawList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$this->sQuery="SELECT tbl1.Idx,tbl1.AdminName from tbl_admin as tbl1 order by tbl1.Idx desc ";
		$arrData['arrResult02']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchAdminIdx']=$this->sSearchAdminIdx;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//stageWithdrawModify
	function stageWithdrawModify() {
		$this->StageWithdrawIdx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.IncFile01,tbl1.State,tbl1.Contents,tbl1.SuccessionIdx,if (tbl1.SuccessionIdx!='',(select UserNickName from tbl_member where Idx=tbl1.SuccessionIdx),'') as SuccessionUserName ,tbl1.RegDate,if((tbl1.ApproveDate = '0000-00-00 00:00:00'),'',tbl1.ApproveDate) AS ApproveDate,tbl3.Title,tbl3.Idx as StageIdx,tbl4.AdminName FROM tbl_stage_withdraw as tbl1 left join tbl_stage_apply as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage as tbl3 on tbl2.ParentIdx=tbl3.Idx left join tbl_admin as tbl4 on tbl1.AdminIdx=tbl4.Idx where tbl1.Idx='".$this->StageWithdrawIdx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row_array();
		if (!$arrData['arrResult02']) { exit; }
		$arrData['arrResult01']=$this->generalStageInfo($arrData['arrResult02']["StageIdx"]);
		$arrData['Idx']=$this->StageWithdrawIdx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//stageWithdrawModifyProc
	function stageWithdrawModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->Contents=addslashes($this->input->post('Contents'));
		$this->State=addslashes($this->input->post('State'));
		$this->SuccessionIdx=addslashes($this->input->post('SuccessionIdx'));
		$this->sParam=addslashes($this->input->post('sParam'));
		$this->arrRetFile=$this->utilmodel->do_upload("IncFile01",sUploadFolder03);
		$this->IncFile01=$this->arrRetFile[0];
		if ($this->Idx==""||$this->State=="") {
			fnAlertMsg("잘못된 접근입니다.");
		}
		$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage_withdraw where Idx='".$this->Idx."'";
		$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
		if ($this->iCnt01!=0) {
			$this->db->trans_start(); //트랜잭션 시작
			$this->sAddQuery="";
			if ($this->IncFile01!="") {
				$this->sAddQuery=",IncFile01='".$this->IncFile01."' ";
			}
			if ($this->State=="3") {
				//스테이지 정보조회
				$this->sQuery="SELECT tbl1.UserIdx,tbl1.SuccessionIdx,tbl1.ParentIdx,tbl2.ICSSSNEScore,tbl3.Idx as StageIdx,tbl3.StageCode,tbl4.UserCode FROM tbl_stage_withdraw as tbl1 left join tbl_stage_apply as tbl2 on tbl1.ParentIdx=tbl2.Idx left join tbl_stage as tbl3 on tbl2.ParentIdx=tbl3.Idx left join tbl_member as tbl4 on tbl1.UserIdx=tbl4.Idx where tbl1.Idx='".$this->Idx."'";

				$arrData['arrApplyInfo']=$this->db->query($this->sQuery)->row_array();
				if ($arrData['arrApplyInfo']["SuccessionIdx"]!=0) {
					fnAlertMsg("이미 승계처리가 완료되었습니다.");
				}
				$this->sAddQuery.=",SuccessionIdx='".$this->SuccessionIdx."' ";
				//승계 회원이 해당 스테이지 가입 회원인지 체크
				$this->sQuery="SELECT count(Idx) as iCnt02 FROM tbl_stage_payment where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and UserIdx='".$this->SuccessionIdx."'";
				$this->iCnt02=$this->db->query($this->sQuery)->row_array()["iCnt02"];
				if ($this->iCnt02!=0) {
					fnAlertMsg("해당 승계회원은 현재 이 스테이지에 참여중입니다.");
				}
				//승계회원의 계좌정보 조회
				$this->sQuery="SELECT UserBank,UserAccount,UserDepositor FROM tbl_member_plus where ParentIdx='".$this->SuccessionIdx."'";
				$arrData['arrUserInfo']=$this->db->query($this->sQuery)->row_array();
				//기존회원의 입금,지급 내역 승계회원으로 변경처리
				$this->sQuery="update tbl_stage_apply set UserIdx='".$this->SuccessionIdx."',UserBank='".$arrData['arrUserInfo']["UserBank"]."',UserAccount='".$arrData['arrUserInfo']["UserAccount"]."',UserDepositor='".$arrData['arrUserInfo']["UserDepositor"]."' where Idx='".$arrData['arrApplyInfo']["ParentIdx"]."'";
				$this->db->query($this->sQuery);
				$this->sQuery="update tbl_stage_payment set UserIdx='".$this->SuccessionIdx."' where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and UserIdx='".$arrData['arrApplyInfo']["UserIdx"]."'";
				$this->db->query($this->sQuery);
				$this->sQuery="update tbl_stage_deposit set UserIdx='".$this->SuccessionIdx."' where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and UserIdx='".$arrData['arrApplyInfo']["UserIdx"]."'";
				$this->db->query($this->sQuery);
				$this->sQuery="update tbl_stage_receive set UserIdx='".$this->SuccessionIdx."' where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and UserIdx='".$arrData['arrApplyInfo']["UserIdx"]."'";
				$this->db->query($this->sQuery);
				//기존회원 페널티 (연체+1)
				$this->sQuery="insert into tbl_stage_overdue (StageCode,ParentIdx,TurnInfo,UserCode) values ('".$arrData['arrApplyInfo']["StageCode"]."','0','0','".$arrData['arrApplyInfo']["UserCode"]."')";
				$this->db->query($this->sQuery);
				//승계회원 ICSS SN 평점 변경
				$UserICSSSNA=fnICSSSNAccumulate($this->SuccessionIdx);
				fnICSS($this->SuccessionIdx,"SNScore",$UserICSSSNA);
				//ICSS 히스토리 저정
				fnICSSHistory($this->SuccessionIdx);
				//기존회원 ICSS SN 평점 변경
				$UserICSSSNA02=fnICSSSNAccumulate($arrData['arrApplyInfo']["UserIdx"]);
				fnICSS($arrData['arrApplyInfo']["UserIdx"],"SNScore",$UserICSSSNA02);
				//ICSS 히스토리 저정
				fnICSSHistory($arrData['arrApplyInfo']["UserIdx"]);
				//승계회원 ICSS CLA 평점 변경
				$UserICSSCLA=fnICSSCLAAccumulate($this->SuccessionIdx);
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($this->SuccessionIdx,"CLAScore",$UserICSSCLA);
				//ICSS 히스토리 저정
				fnICSSHistory($this->SuccessionIdx);
				//기존회원 ICSS CLA 평점 변경
				$UserICSSCLA=fnICSSCLAAccumulate($arrData['arrApplyInfo']["UserIdx"]);
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($arrData['arrApplyInfo']["UserIdx"],"CLAScore",$UserICSSCLA);
				//ICSS 히스토리 저정
				fnICSSHistory($arrData['arrApplyInfo']["UserIdx"]);
				//연체 히스토리를 통해 기존 회원의 ICSS OPR값 반영
				$this->sQuery="select count(tbl1.Idx) as iOverDueCnt,(select count(Idx) as iCnt01 from tbl_stage_deposit where DepositState!='A' and UserIdx=tbl2.Idx) as iDepositCnt,tbl2.Idx from tbl_stage_overdue as tbl1 left join tbl_member as tbl2 on tbl1.UserCode=tbl2.UserCode where tbl2.Idx='".$arrData['arrApplyInfo']["UserIdx"]."' group by tbl1.UserCode ";
				$this->arrResult=$this->db->query($this->sQuery)->row_array();
				//ICSS 평점 저장
				$UserICSSOPR=(fnICSSOPR($this->arrResult["iDepositCnt"],$this->arrResult["iOverDueCnt"])/100)*10000;
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($arrData['arrApplyInfo']["UserIdx"],"OPRScore",$UserICSSOPR);
				//ICSS 히스토리 저정
				fnICSSHistory($arrData['arrApplyInfo']["UserIdx"]);
				//스테이지 참여시 SNE 점수 체크 후 복원
				if ($arrData['arrApplyInfo']["ICSSSNEScore"]!=0) {
					$this->sQuery="select SNEScore from tbl_member_ICSS where UserIdx='".$arrData['arrApplyInfo']["UserIdx"]."'";
					$UserICSSSNE02= $this->db->query($this->sQuery)->row_array()["SNEScore"];
					$UserICSSSNE02=$UserICSSSNE02+$arrData['arrApplyInfo']["ICSSSNEScore"];
					// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
					fnICSS($arrData['arrApplyInfo']["UserIdx"],"SNEScore",$UserICSSSNE02);
					//ICSS 히스토리 저정
					fnICSSHistory($arrData['arrApplyInfo']["UserIdx"]);
				}
				//원리금 수취권 변경
				$this->sQuery="update tbl_stage_principal set DebtorIdx='".$this->SuccessionIdx."' where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and DebtorIdx='".$arrData['arrApplyInfo']["UserIdx"]."' ";
				$this->db->query($this->sQuery);
				$this->sQuery="update tbl_stage_principal set CreditorIdx='".$this->SuccessionIdx."' where ParentIdx='".$arrData['arrApplyInfo']["StageIdx"]."' and CreditorIdx='".$arrData['arrApplyInfo']["UserIdx"]."' ";
				$this->db->query($this->sQuery);

			} else {
				$this->sAddQuery.=",SuccessionIdx='' ";
			}
			$this->sQuery="update tbl_stage_withdraw set State='".$this->State."',Contents='".$this->Contents."',ApproveDate=now()".$this->sAddQuery." where Idx='".$this->Idx."'";
			$arrData['arrResult']=$this->db->query($this->sQuery);
			$this->db->trans_complete();//트랜잭션 끝
			if ($this->db->trans_status() == FALSE) {
				fnAlertMsg("작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.");
			} else {
				fnAlertMsgUrl("약정철회 변경이 완료되었습니다.","/systems/stageWithdrawModify".$this->sParam);
			}
		}
	}
	//stageWithdrawDelProc
	function stageWithdrawDelProc() {
		$this->Idx=addslashes($this->input->get('Idx'));
		if ($this->Idx=="") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage_withdraw where Idx='".$this->Idx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="delete from tbl_stage_withdraw where Idx='".$this->Idx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'약정철회 삭제가 완료되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			} else {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
			}
		}
		echo json_encode($arrRetMessage);
	}
	//memberSuccessionAjax
	function memberSuccessionAjax() {
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserCode,tbl1.UserNickName,tbl1.UserId,tbl2.ICSSGrade,tbl2.ICSSScore,if(tbl3.UserBank=''||tbl3.UserAccount=''||tbl3.UserDepositor='','N','Y') as AccountInfo from tbl_member as tbl1 left join tbl_member_ICSS as tbl2 on tbl1.Idx=tbl2.UserIdx left join tbl_member_plus as tbl3 on tbl1.Idx=tbl3.ParentIdx where tbl1.UserSuccessionYn='Y' order by Idx desc";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		return json_encode($arrData);
	}

	//individualScoreList
	function individualScoreList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		//$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' ) ";
		}
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_individualScoreList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_individualScoreList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}

	//individualScoreListExcel
	function individualScoreListExcel() {
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchWord) {
			$this->sWhere.=" and (tbl1.UserName like '%".$this->sSearchWord."%' or tbl1.UserNickName like '%".$this->sSearchWord."%' ) ";
		}
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_individualScoreList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_individualScoreList as tbl1 ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('개인평점관리리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('D1', '이름');
		$this->excel->getActiveSheet()->setCellValue('E1', 'I-CSS');
		$this->excel->getActiveSheet()->setCellValue('F1', '평점');
		$this->excel->getActiveSheet()->setCellValue('G1', '합계');
		$this->excel->getActiveSheet()->setCellValue('H1', 'NICE 등급');
		$this->excel->getActiveSheet()->setCellValue('I1', '신용대출금액');
		$this->excel->getActiveSheet()->setCellValue('J1', 'OPR');
		$this->excel->getActiveSheet()->setCellValue('K1', 'SN');
		$this->excel->getActiveSheet()->setCellValue('L1', 'CLA');
		$this->excel->getActiveSheet()->setCellValue('M1', 'POU');
		$this->excel->getActiveSheet()->setCellValue('N1', 'SNE');
		$this->excel->getActiveSheet()->setCellValue('O1', 'AR');
		$this->excel->getActiveSheet()->setCellValue('P1', 'DS');

		$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:P1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserNickName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["ICSSGrade"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["ICSSScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row["RISKScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["NiceGradeScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row["NiceMoneyScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row["OPRScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row["SNScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row["CLAScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row["POUScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row["SNEScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row["ARScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row["DSScore"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':P'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="개인평점관리리스트";
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
	//memberICSSInfo
	function memberICSSInfo() {
		$this->Idx=addslashes($this->input->get('Idx'));
		$this->sQuery="SELECT tbl1.UserIncome,tbl1.UserAssets FROM tbl_member_plus as tbl1 where ParentIdx='".$this->Idx."'";
		$arrData=$this->db->query($this->sQuery)->row_array();
		echo json_encode($arrData);
	}
	//ICSSDSModifyProc
	function ICSSDSModifyProc() {
		$this->Idx=addslashes($this->input->post('Idx'));
		$this->ICSSIdx=addslashes($this->input->post('ICSSIdx'));
		$this->UserIncome=addslashes($this->input->post('UserIncome'));
		$this->UserAssets=addslashes($this->input->post('UserAssets'));
		if ($this->Idx=="") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_member where Idx='".$this->Idx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="update tbl_member_plus set UserIncome='".$this->UserIncome."',UserAssets='".$this->UserAssets."' where ParentIdx='".$this->Idx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				//소득,재산세를 통한 ICSS DS값 반영
				$UserICSSDS01=(fnICSSSDS01($this->UserIncome)/100)*10000;
				$UserICSSDS02=(fnICSSSDS02($this->UserAssets)/100)*10000;
				$UserICSSDS=$UserICSSDS01+$UserICSSDS02;
				// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
				fnICSS($this->Idx,"DSScore",$UserICSSDS);
				//ICSS 히스토리 저정
				fnICSSHistory($this->Idx);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'DS적용이 완료되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			} else {
				$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
			}
		}
		echo json_encode($arrRetMessage);
	}
	//iptApplicantList
	function iptApplicantList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
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
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_iptApplicantList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_iptApplicantList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//iptApplicantListExcel
	function iptApplicantListExcel() {
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchUserGrade=addslashes(trim($this->input->get('sSearchUserGrade')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchUserGrade) {
			if ($this->sSearchUserGrade=="2") {
				$this->sWhere.=" and tbl1.UserNanumYn='Y' ";
			} else {
				$this->sWhere.=" and tbl1.UserGrade='".$this->sSearchUserGrade."' ";
			}
		}
		if ($this->dStartDate) { $this->sWhere.=" and tbl1.RegDate >'".$this->dStartDate." 00:00:00'"; }
		if ($this->dEndDate) { $this->sWhere.=" and tbl1.RegDate <='".$this->dEndDate." 23:59:59'"; }
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_iptApplicantList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.*,tbl2.Answer1,tbl2.Answer2,tbl2.Answer3,tbl2.Answer4,tbl2.Answer5,tbl2.Answer6,tbl2.Answer7,tbl2.Answer8,tbl2.Answer9,tbl2.Answer10,tbl2.Answer11,tbl2.Answer12,tbl2.Answer13,tbl2.Answer14,tbl2.Answer15,tbl2.Answer16,tbl2.Answer17,tbl2.Answer18,tbl2.Answer19,tbl2.Answer20,tbl2.Answer21,tbl2.Answer22,tbl2.Answer23,tbl2.Answer24,tbl2.Answer25,tbl2.Answer26,tbl2.Answer27,tbl2.Answer28,tbl2.Answer29,tbl2.Answer30,tbl2.Answer31,tbl2.Answer32,tbl2.Answer33 FROM cms_iptApplicantList as tbl1 left join tbl_IPT_answer as tbl2 on tbl1.UserIdx=tbl2.UserIdx ".$this->sWhere." order by tbl1.Idx desc ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result();
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchUserGrade']=$this->sSearchUserGrade;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('IPT_설문_참여자_리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AH')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AI')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AL')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AM')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AN')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AO')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('AP')->setWidth(10);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '등급');
		$this->excel->getActiveSheet()->setCellValue('D1', '이메일');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('G1', 'I-CSS');
		$this->excel->getActiveSheet()->setCellValue('H1', '점수');
		$this->excel->getActiveSheet()->setCellValue('I1', '설문일');
		$this->excel->getActiveSheet()->setCellValue('J1', 'Q1');
		$this->excel->getActiveSheet()->setCellValue('K1', 'Q2');
		$this->excel->getActiveSheet()->setCellValue('L1', 'Q3');
		$this->excel->getActiveSheet()->setCellValue('M1', 'Q4');
		$this->excel->getActiveSheet()->setCellValue('N1', 'Q5');
		$this->excel->getActiveSheet()->setCellValue('O1', 'Q6');
		$this->excel->getActiveSheet()->setCellValue('P1', 'Q7');
		$this->excel->getActiveSheet()->setCellValue('Q1', 'Q8');
		$this->excel->getActiveSheet()->setCellValue('R1', 'Q9');
		$this->excel->getActiveSheet()->setCellValue('S1', 'Q10');
		$this->excel->getActiveSheet()->setCellValue('T1', 'Q11');
		$this->excel->getActiveSheet()->setCellValue('U1', 'Q12');
		$this->excel->getActiveSheet()->setCellValue('V1', 'Q13');
		$this->excel->getActiveSheet()->setCellValue('W1', 'Q14');
		$this->excel->getActiveSheet()->setCellValue('X1', 'Q15');
		$this->excel->getActiveSheet()->setCellValue('Y1', 'Q16');
		$this->excel->getActiveSheet()->setCellValue('Z1', 'Q17');
		$this->excel->getActiveSheet()->setCellValue('AA1', 'Q18');
		$this->excel->getActiveSheet()->setCellValue('AB1', 'Q19');
		$this->excel->getActiveSheet()->setCellValue('AC1', 'Q20');
		$this->excel->getActiveSheet()->setCellValue('AD1', 'Q21');
		$this->excel->getActiveSheet()->setCellValue('AE1', 'Q22');
		$this->excel->getActiveSheet()->setCellValue('AF1', 'Q23');
		$this->excel->getActiveSheet()->setCellValue('AG1', 'Q24');
		$this->excel->getActiveSheet()->setCellValue('AH1', 'Q25');
		$this->excel->getActiveSheet()->setCellValue('AI1', 'Q26');
		$this->excel->getActiveSheet()->setCellValue('AJ1', 'Q27');
		$this->excel->getActiveSheet()->setCellValue('AK1', 'Q28');
		$this->excel->getActiveSheet()->setCellValue('AL1', 'Q29');
		$this->excel->getActiveSheet()->setCellValue('AM1', 'Q30');
		$this->excel->getActiveSheet()->setCellValue('AN1', 'Q31');
		$this->excel->getActiveSheet()->setCellValue('AO1', 'Q32');
		$this->excel->getActiveSheet()->setCellValue('AP1', 'Q33');

		$this->excel->getActiveSheet()->getStyle('A1:AP1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:AP1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:AP1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row->UserCode,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,fnMemberGrade02($row->UserGrade),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row->UserId,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row->UserName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row->UserNickName,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row->ICSSGrade,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row->ICSSScore,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row->RegDate,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row->Answer1,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row->Answer2,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->Answer3,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row->Answer4,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row->Answer5,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row->Answer6,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row->Answer7,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,$row->Answer8,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('R'.$n,$row->Answer9,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('S'.$n,$row->Answer10,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,$row->Answer11,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('U'.$n,$row->Answer12,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('V'.$n,$row->Answer13,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('W'.$n,$row->Answer14,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('X'.$n,$row->Answer15,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Y'.$n,$row->Answer16,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Z'.$n,$row->Answer17,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AA'.$n,$row->Answer18,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AB'.$n,$row->Answer19,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AC'.$n,$row->Answer20,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AD'.$n,$row->Answer21,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AE'.$n,$row->Answer22,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AF'.$n,$row->Answer23,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AG'.$n,$row->Answer24,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AH'.$n,$row->Answer25,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AI'.$n,$row->Answer26,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AJ'.$n,$row->Answer27,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AK'.$n,$row->Answer28,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AL'.$n,$row->Answer29,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AM'.$n,$row->Answer30,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AN'.$n,$row->Answer31,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AO'.$n,$row->Answer32,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AP'.$n,$row->Answer33,PHPExcel_Cell_DataType::TYPE_STRING);

			/* 선택한 번호가 아닌 선택한 번호에 따른 점수를 요구할때 대비
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row->Answer1,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,fnIPTReverse($row->Answer2),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row->Answer3,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,fnIPTReverse($row->Answer4),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row->Answer5,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,fnIPTReverse($row->Answer6),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row->Answer7,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,fnIPTReverse($row->Answer8),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('R'.$n,fnIPTReverse($row->Answer9),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('S'.$n,$row->Answer10,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,$row->Answer11,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('U'.$n,fnIPTReverse($row->Answer12),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('V'.$n,$row->Answer13,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('W'.$n,fnIPTReverse($row->Answer14),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('X'.$n,$row->Answer15,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Y'.$n,$row->Answer16,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Z'.$n,$row->Answer17,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AA'.$n,fnIPTReverse($row->Answer18),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AB'.$n,$row->Answer19,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AC'.$n,$row->Answer20,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AD'.$n,$row->Answer21,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AE'.$n,$row->Answer22,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AF'.$n,$row->Answer23,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AG'.$n,fnIPTReverse($row->Answer24),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AH'.$n,$row->Answer25,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AI'.$n,$row->Answer26,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AJ'.$n,$row->Answer27,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AK'.$n,fnIPTReverse($row->Answer28),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AL'.$n,fnIPTReverse($row->Answer29),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AM'.$n,$row->Answer30,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AN'.$n,$row->Answer31,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AO'.$n,$row->Answer32,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AP'.$n,$row->Answer33,PHPExcel_Cell_DataType::TYPE_STRING);
			*/

			$this->excel->getActiveSheet()->getStyle('A'.$n.':AP'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="IPT_설문_참여자_리스트";
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
	//iptApplicantView
	function iptApplicantView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM cms_iptApplicantList as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult03']) { exit; }
		$this->sQuery="SELECT tbl1.* FROM cms_memberView as tbl1 where tbl1.Idx='".$arrData['arrResult03']->UserIdx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt01 FROM tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$arrData['arrResult03']->UserIdx."' and (tbl2.State='R' or tbl2.State='S' or tbl2.State='L' or tbl2.State='W' or tbl2.State='C') ";
		$this->iCnt01=$this->db->query($this->sQuery)->row_array()["iCnt01"];
		$arrData['iCnt01']=$this->iCnt01;
		//검사기록 체크
		$this->sQuery="SELECT UserIdx,Answer1,Answer2,Answer3,Answer4,Answer5,Answer6,Answer7,Answer8,Answer9,Answer10,Answer11,Answer12,Answer13,Answer14,Answer15,Answer16,Answer17,Answer18,Answer19,Answer20,Answer21,Answer22,Answer23,Answer24,Answer25,Answer26,Answer27,Answer28,Answer29,Answer30,Answer31,Answer32,Answer33 from tbl_IPT_answer where UserIdx='".$arrData['arrResult03']->UserIdx."'";
		$arrData['arrResult']=$this->db->query($this->sQuery)->row_array();
		$arrData['arrReturnResult']=array();
		$this->iCnt=0;
		$this->sQuery="SELECT * from tbl_IPT_score order by Idx asc ";
		$arrData['arrResultScore']=$this->db->query($this->sQuery);
		foreach ($arrData['arrResultScore']->result() as $row) {
			$this->iAnswerScore=0;
			$this->iAnswerResultScore="";
			if ($row->Questions!="") {
				$this->arrQuestion=explode(",",$row->Questions);
				for ($iCnt=0;$iCnt<sizeof($this->arrQuestion);$iCnt++) {
//					echo $this->arrQuestion[$iCnt]." - ";
//					echo $arrData['arrResult']["Answer".$this->arrQuestion[$iCnt]]."<br>";
					if ($this->arrQuestion[$iCnt]=="2"||$this->arrQuestion[$iCnt]=="4"||$this->arrQuestion[$iCnt]=="6"||$this->arrQuestion[$iCnt]=="8"||$this->arrQuestion[$iCnt]=="9"||$this->arrQuestion[$iCnt]=="12"||$this->arrQuestion[$iCnt]=="14"||$this->arrQuestion[$iCnt]=="18"||$this->arrQuestion[$iCnt]=="24"||$this->arrQuestion[$iCnt]=="28"||$this->arrQuestion[$iCnt]=="29") {
						$this->iAnswerScore=$this->iAnswerScore+fnIPTReverse($arrData['arrResult']["Answer".$this->arrQuestion[$iCnt]]);
					} else {
						$this->iAnswerScore=$this->iAnswerScore+$arrData['arrResult']["Answer".$this->arrQuestion[$iCnt]];
					}

				}
				$this->iAnswerScore=$this->iAnswerScore/sizeof($this->arrQuestion);
				if ($this->iAnswerScore <=$row->LimitScore01) {
					//하
					$this->iAnswerResultScore="B";
				} else {
					if ($this->iAnswerScore <=$row->LimitScore02) {
						//중
						$this->iAnswerResultScore="M";
					} else {
						//상
						$this->iAnswerResultScore="T";
					}
				}
			}
			$arrData['arrReturnResult'][$this->iCnt]['ItemName']=$row->ItemName;
			$arrData['arrReturnResult'][$this->iCnt]['Score']=$this->iAnswerScore;
			$this->sQuery="SELECT Contents from tbl_IPT_contents where Score='".$this->iAnswerResultScore."' and ParentIdx='".$row->Idx."'";
			$arrData['arrReturnResult'][$this->iCnt]['Contents']=$this->db->query($this->sQuery)->row()->Contents;
			$this->iCnt=$this->iCnt+1;
		}

		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
	//delStageList
	function delStageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchState=addslashes(trim($this->input->get('sSearchState')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
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
		if ($this->sSearchState) { $this->sWhere.=" and tbl1.State='".$this->sSearchState."' "; }
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >'".$this->dStartDate." 00:00:00'"; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate." 23:59:59'"; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_delStageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* from cms_delStageList as tbl1 ".$this->sWhere." order by tbl1.Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery);
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchState']=$this->sSearchState;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//delStageView
	function delStageView() {
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.* FROM tbl_stage_del as tbl1 where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult02'] = $this->db->query($this->sQuery)->row();
		if (!$arrData['arrResult02']) { exit; }
		$this->sQuery="select tbl1.StageCode,tbl1.SecretYN,tbl1.CategoryIdx,tbl1.StageNum,tbl1.StageRate,tbl1.StageMoney,tbl1.RegDate,if((tbl1.StartDate = '0000-00-00 00:00:00'),'',tbl1.StartDate) AS StartDate,if((tbl1.EndDate = '0000-00-00 00:00:00'),'',tbl1.EndDate) AS EndDate,tbl1.State,tbl2.CategoryName,DATEDIFF(now(),tbl1.RegDate) as OverDate from tbl_stage_del as tbl1 left join tbl_category as tbl2 on tbl1.CategoryIdx=tbl2.Idx where tbl1.Idx='".$this->Idx."'";
		$arrData['arrResult01']=$this->db->query($this->sQuery)->row();
		$this->Idx=addslashes(trim($this->input->get('Idx')));
		$this->sQuery="SELECT tbl1.Idx,tbl1.UserIdx,tbl2.RegDate,tbl3.UserNickName,tbl4.ICSSGrade,tbl4.ICSSScore FROM tbl_stage_payment_del as tbl1 left join tbl_stage_apply_del as tbl2 on tbl1.UserIdx=tbl2.UserIdx and tbl1.ParentIdx=tbl2.ParentIdx left join tbl_member as tbl3 on tbl1.UserIdx=tbl3.Idx left join tbl_member_ICSS as tbl4 on tbl1.UserIdx=tbl4.UserIdx where tbl1.ParentIdx='".$this->Idx."' order by tbl1.TurnNo asc";
		$arrData['arrResult03'] = $this->db->query($this->sQuery)->result_array();
		$arrData['Idx']=$this->Idx;
		$arrData['sParam']=fnParam();
		$arrData['sParam02']=fnParam02();
		return $arrData;
	}
}
