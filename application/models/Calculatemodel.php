<?php
class Calculatemodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->model('utilmodel');
	}
	//depositManageList
	function depositManageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		//스테이지중 진행상태가 S(진행) 나 L(연체), W(부실) 인 스테이지의 현재 회차 입금 내역
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositManageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_depositManageList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//depositManageListExcel
	function depositManageListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		//스테이지중 진행상태가 S(진행) 나 L(연체), W(부실) 인 스테이지의 현재 회차 입금 내역
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositManageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_depositManageList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		//휴일 체크
		$this->sQuery="select tbl1.Holiday FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
		$arrDataHoliday = $this->db->query($this->sQuery)->row();
		if ($arrDataHoliday) {
			$this->arrHoliday=explode("\r\n",$arrDataHoliday->Holiday);
		}
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('입금리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '이율');
		$this->excel->getActiveSheet()->setCellValue('D1', '월납입금액');
		$this->excel->getActiveSheet()->setCellValue('E1', '총납입금액');
		$this->excel->getActiveSheet()->setCellValue('F1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('G1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('H1', '이름');

		$this->excel->getActiveSheet()->setCellValue('I1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('J1', '입금예정일');
		$this->excel->getActiveSheet()->setCellValue('K1', '입금은행');
		$this->excel->getActiveSheet()->setCellValue('L1', '계좌번호');
		$this->excel->getActiveSheet()->setCellValue('M1', '순번');
		$this->excel->getActiveSheet()->setCellValue('N1', '회차');
		$this->excel->getActiveSheet()->setCellValue('O1', '입금 예정액');
		$this->excel->getActiveSheet()->setCellValue('P1', '초기 입금 예정액');
		$this->excel->getActiveSheet()->setCellValue('Q1', '입금액');
		$this->excel->getActiveSheet()->setCellValue('R1', '조정납입액');
		$this->excel->getActiveSheet()->setCellValue('S1', '실 입금일');
		$this->excel->getActiveSheet()->setCellValue('T1', '연체 경과일');
		$this->excel->getActiveSheet()->setCellValue('U1', '미납액');
		$this->excel->getActiveSheet()->setCellValue('V1', '연체이자');
		$this->excel->getActiveSheet()->setCellValue('W1', '상태');
		$this->excel->getActiveSheet()->setCellValue('X1', '스테이지 상태');
		$this->excel->getActiveSheet()->setCellValue('Y1', '입금 데이터 고유번호');
		$this->excel->getActiveSheet()->setCellValue('Z1', '회원 고유번호');
		$this->excel->getActiveSheet()->setCellValue('AA1', '초기 입금예정일');
		$this->excel->getActiveSheet()->setCellValue('AB1', '복구여부');

		$this->excel->getActiveSheet()->getStyle('A1:AB1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:AB1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:AB1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["StageRate"]."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["StageMoney"]*10000,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["StageMoney"]*$row["StageNum"]*10000,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row["UserNickName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row["UserTel"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row["ScheduledDepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row["CompBank"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row["CompAccount"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row["MyTurn"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row["DepositTurnNo"]." / ".$row["StageNum"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row["ScheduledDepositMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row["DefaultMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			/*
			if ($row["DepositState"]=="N"||$row["DepositState"]=="H") {
				$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,$row["DepositMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			} else {
				$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			}
			*/
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			//$this->excel->getActiveSheet()->setCellValueExplicit('R'.$n,$row["ControlDepositMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('R'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('S'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,fnDateDiff($row["DefaultDepositDate"],$this->arrHoliday),PHPExcel_Cell_DataType::TYPE_STRING);
			/*
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,$row["OverDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('U'.$n,$row["NonpaymentMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('V'.$n,$row["OverdueInterest"],PHPExcel_Cell_DataType::TYPE_STRING);
			*/
			$this->excel->getActiveSheet()->setCellValueExplicit('U'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('V'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('W'.$n,$row["DepositState"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('X'.$n,fnStageState($row["StageState"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Y'.$n,$row["DepositIdx"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Z'.$n,$row["UserIdx"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AA'.$n,$row["DefaultDepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('AB'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':AB'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="입금리스트";
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
	//depositManageListExcelUpload
	function depositManageListExcelUpload() {
		$this->arrRetFile=$this->utilmodel->do_upload("ExcelFile",sUploadFolder04);
		$this->arrStageRestore=array();
		$this->ExcelFile=$this->arrRetFile[0];
		if ($this->ExcelFile!="") {
			$this->ExcelFilePath=sUploadFolder04.$this->ExcelFile;
			//엑셀파일 체크
			$this->arrFileInfo=fnFileInfo($this->ExcelFilePath);
			if (strtolower($this->arrFileInfo["extension"])=="xlsx"||strtolower($this->arrFileInfo["extension"])=="xls") {
				$objPHPExcel = new PHPExcel();
				try {
					// 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
					$objReader = PHPExcel_IOFactory::createReaderForFile($this->ExcelFilePath);
					// 읽기전용으로 설정
					$objReader->setReadDataOnly(true);
					// 엑셀파일을 읽는다
					$objExcel = $objReader->load($this->ExcelFilePath);
					// 첫번째 시트를 선택
					$objExcel->setActiveSheetIndex(0);
					$objWorksheet = $objExcel->getActiveSheet();
					$rowIterator = $objWorksheet->getRowIterator();
					$maxRow = $objWorksheet->getHighestRow();

					$this->bHolidayCheck=false;
					//휴일 체크
					$this->sQuery="select tbl1.Holiday FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
					$arrDataHoliday = $this->db->query($this->sQuery)->row();
					if ($arrDataHoliday) {
						$this->arrHoliday=explode("\r\n",$arrDataHoliday->Holiday);
					}
					//입금예정일 휴일체크
					$dNowDate02=date("Y-m-d");
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
								$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+1 days"));
							}
							if ($bHolidayCheckSub02) {
								$bHolidayCheck02=true;
							}
						} else {
							$bHolidayCheck02=true;
						}
					}

					$this->db->trans_start(); //트랜잭션 시작
					for ($i = 2 ; $i <= $maxRow ; $i++) { // 두번째 행부터 읽는다
						$ScheduledDepositMoney=fnEraser($objWorksheet->getCell('O' . $i)->getValue()); // 입금예정액
						$DepositMoney= fnEraser($objWorksheet->getCell('Q' . $i)->getValue()); // 입금액
						$ControlDepositMoney= fnEraser($objWorksheet->getCell('R' . $i)->getValue()); // 조정납입금
						$DepositState=strtoupper($objWorksheet->getCell('W' . $i)->getValue()); // 입금상태
						$DepositIdx= $objWorksheet->getCell('Y' . $i)->getValue(); // 입금데이터 고유번호
						$StageCode=$objWorksheet->getCell('B' . $i)->getValue(); //스테이지 코드
						$UserCode=$objWorksheet->getCell('F' . $i)->getValue(); // 회원 코드
						$UserTurn=$objWorksheet->getCell('M' . $i)->getValue(); // 회원 순번
						$TurnInfo=$objWorksheet->getCell('N' . $i)->getValue(); // 현재회차 / 총회차
						$UserIdx=$objWorksheet->getCell('Z' . $i)->getValue(); // 회원 고유번호
						$OriScheduledDepositMoney=$objWorksheet->getCell('J' . $i)->getValue(); // 최종 입금예정일
						$OriScheduledDepositMoney=PHPExcel_Style_NumberFormat::toFormattedString($OriScheduledDepositMoney,'YYYY-MM-DD');
						$DepositDate=$objWorksheet->getCell('S' . $i)->getValue(); // 실입금일
						$DepositDate=PHPExcel_Style_NumberFormat::toFormattedString($DepositDate,'YYYY-MM-DD');
						$NonpaymentMoney=$objWorksheet->getCell('U' . $i)->getValue(); // 미납액
						$OverdueInterest=$objWorksheet->getCell('V' . $i)->getValue(); // 연체이자
						$DefaultDepositDate=$objWorksheet->getCell('AA' . $i)->getValue(); // 초기 입금예정일
						$DefaultDepositDate=PHPExcel_Style_NumberFormat::toFormattedString($DefaultDepositDate,'YYYY-MM-DD');
						$DepositRestore=strtoupper($objWorksheet->getCell('AB' . $i)->getValue()); // 복구여부
						if ($DepositRestore=="R") {
							//해당 스테이지가 완료된 상태면 복구 불가
							$this->sQuery="select State,NowTurn from tbl_stage where StageCode='".$StageCode."'";
							$arrData['arrResult01']= $this->db->query($this->sQuery)->row_array();
							if ($arrData['arrResult01']["State"]=="S"||$arrData['arrResult01']["State"]=="W"||$arrData['arrResult01']["State"]=="L"||$arrData['arrResult01']["State"]=="C") {
								//복구하려는 상태의 회차값과 스테이지 회차값 비교
								$this->sQuery="select TurnNo from tbl_stage_deposit where Idx='".$DepositIdx."'";
								$RestoreTurn=$this->db->query($this->sQuery)->row_array()["TurnNo"];
								$RestoreTurnGap=$arrData['arrResult01']["NowTurn"]-$RestoreTurn;
								//이전회차까지만 복구 가능, 복구 후 스테이지 회차 복구
								if ($RestoreTurnGap==0||$RestoreTurnGap==1) {
									//해당 회차의 연체기록이 존재시 연체기록 삭제
									$this->sQuery="delete from tbl_stage_overdue where ParentIdx='".$DepositIdx."'";
									$this->db->query($this->sQuery);

									$this->sQuery="select count(tbl1.Idx) as iOverDueCnt,(select count(Idx) as iCnt01 from tbl_stage_deposit where DepositState!='A' and UserIdx='".$UserIdx."') as iDepositCnt from tbl_stage_overdue as tbl1 where tbl1.UserCode='".$UserCode."' ";
									$this->arrResult=$this->db->query($this->sQuery)->row_array();
									//ICSS 평점 저장
									$UserICSSOPR=(fnICSSOPR($this->arrResult["iDepositCnt"],$this->arrResult["iOverDueCnt"])/100)*10000;
									// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
									fnICSS($UserIdx,"OPRScore",$UserICSSOPR);
									//ICSS 히스토리 저정
									fnICSSHistory($UserIdx);
									//입금상태 복구
									$this->sQuery="update tbl_stage_deposit set DepositState='A',ControlDepositMoney='0',DepositMoney='0',ScheduledDepositMoney=DefaultMoney,ScheduledDepositDate=DefaultDepositDate,DepositDate='',NonpaymentMoney='',OverdueInterest='' where Idx='".$DepositIdx."' ";
									$this->db->query($this->sQuery);
									//회원 스테이지 가입 수,약정 대출 금액
									$this->sQuery="select tbl1.MyTurn,tbl2.NowTurn,tbl2.StageNum,(select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y') as DepositCnt,((tbl2.StageNum-tbl1.MyTurn)*(tbl2.StageMoney*10000)) - (if((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y')>tbl1.MyTurn,((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y')-tbl1.MyTurn)*(tbl2.StageMoney*10000),0)) as ICSSTotalMoney from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$UserIdx."' and tbl2.State!='E'";
									fnLogWrite($this->sQuery);
									$arrData['arrResult02']=$this->db->query($this->sQuery);
									$arrUserInfo["iCnt01"]=$arrData['arrResult02']->num_rows();
									$arrUserInfo["iCnt02"]=0;
									foreach ($arrData['arrResult02']->result_array() as $row2) {
										$arrUserInfo["iCnt02"]=$arrUserInfo["iCnt02"]+$row2["ICSSTotalMoney"];
									}
									//ICSS 평점 저장
									$UserICSSCLA=(fnICSSCLA($arrUserInfo["iCnt01"],$arrUserInfo["iCnt02"])/100)*10000;
									// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
									fnICSS($UserIdx,"CLAScore",$UserICSSCLA);
									//ICSS 히스토리 저정
									fnICSSHistory($UserIdx);
								}
								if ($RestoreTurnGap==1) {
									if (count($this->arrStageRestore)==0) {
										$this->arrStageRestore[count($this->arrStageRestore)]=$StageCode;
									} else {
										$StageRestoreCheck=false;
										for( $iCnt02=0;$iCnt02<count($this->arrStageRestore);$iCnt02++){
											if (($StageCode==$this->arrStageRestore[$iCnt02])) {
												$StageRestoreCheck=true;
											}
										}
										if (!$StageRestoreCheck) {
											$this->arrStageRestore[count($this->arrStageRestore)]=$StageCode;
										}
									}
								}
							}
						} else {
							$this->sAddQuery="";
							if ($DepositState=="Y"||$DepositState=="N"||$DepositState=="H") {
								//조정금액이 존재하면 입금예정금액은 조정금으로 변경됨.
								$this->sAddQuery.=",ScheduledDepositMoney='".$ControlDepositMoney."'";
								$this->sAddQuery.=",ControlDepositMoney='".$ControlDepositMoney."'";
								//상태값 A일때 입금액은 0
								if ($DepositState=="A"&&$DepositMoney!="") {
									$DepositMoney=0;
								}
								//상태값이 연체라면 연체 기록 체크
								if ($DepositState=="N"||$DepositState=="H") {
									if ($DepositDate!="") {
										$dNowDate=date("Y-m-d",strtotime($DepositDate."+1 days"));
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
									} else {
										$dDateGap= strtotime($DefaultDepositDate)-strtotime($dNowDate02);
										if ($dDateGap>0) {
											$dNowDate=$DefaultDepositDate;
										} else {
											$dNowDate=$dNowDate02;
										}
									}
									//해당 회차의 연체기록이 없을시 연체기록 남김
									$this->sQuery="select count(Idx) as iOverCnt from tbl_stage_overdue where ParentIdx='".$DepositIdx."'";
									$this->iOverCnt=$this->db->query($this->sQuery)->row_array()["iOverCnt"];
									if ($this->iOverCnt==0) {
										$this->sQuery="insert into tbl_stage_overdue (StageCode,ParentIdx,TurnInfo,UserCode,MyTurn) values ('".$StageCode."','".$DepositIdx."','".$TurnInfo."','".$UserCode."','".$UserTurn."')";
										$this->db->query($this->sQuery);
									}
									//연체일 경우 입금 예정일을 엑셀 업로드 날짜로 변경
									$this->sAddQuery.=",ScheduledDepositDate='".$dNowDate."'";
								}
								//입금 상태가 Y,N,H면 입금일 추가
								if ($DepositState!="A") {
									$this->sAddQuery.=",DepositDate='".$DepositDate."'";
								}
								//정책에 의해 입금예정일이 변화됨. Y일시 실입금일 존새지 입금예정일 = 실입금일, 없으면 입금예정일=최종 입금 예정일(같은의미이나 엑셀 데이터 다시 업데이트 요청)
								if ($DepositState=="Y") {
									if ($DepositDate=="") {
										$this->sAddQuery.=",ScheduledDepositDate='".$OriScheduledDepositMoney."'";
									} else {
										$this->sAddQuery.=",ScheduledDepositDate='".$DepositDate."'";
									}

								}
								//입금 상태가 H면 기타값 저장
								/*
								if ($DepositState=="H") {
									$this->sAddQuery.=",NonpaymentMoney='".$NonpaymentMoney."',OverdueInterest='".$OverdueInterest."'";
								}
								*/
								//입금상태 업데이트
								$this->sQuery="update tbl_stage_deposit set DepositState='".$DepositState."',DepositMoney='".$DepositMoney."'".$this->sAddQuery." where Idx='".$DepositIdx."' and DepositState!='Y'";
								$this->db->query($this->sQuery);
								fnLogWrite($this->sQuery);
								//CLA 반영
								if ($DepositState!="A") {
									//회원 스테이지 가입 수,약정 대출 금액
									$this->sQuery="select tbl1.MyTurn,tbl2.NowTurn,tbl2.StageNum,(select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y') as DepositCnt,((tbl2.StageNum-tbl1.MyTurn)*(tbl2.StageMoney*10000)) - (if((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y')>tbl1.MyTurn,((select count(Idx) as iCnt01 from tbl_stage_deposit where ParentIdx=tbl2.Idx and UserIdx='".$UserIdx."' and DepositState='Y')-tbl1.MyTurn)*(tbl2.StageMoney*10000),0)) as ICSSTotalMoney from tbl_stage_apply as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.UserIdx='".$UserIdx."' and tbl2.State!='E'";
									fnLogWrite($this->sQuery);
									$arrData['arrResult02']=$this->db->query($this->sQuery);
									$arrUserInfo["iCnt01"]=$arrData['arrResult02']->num_rows();
									$arrUserInfo["iCnt02"]=0;
									foreach ($arrData['arrResult02']->result_array() as $row2) {
										$arrUserInfo["iCnt02"]=$arrUserInfo["iCnt02"]+$row2["ICSSTotalMoney"];
									}
									//ICSS 평점 저장
									$UserICSSCLA=(fnICSSCLA($arrUserInfo["iCnt01"],$arrUserInfo["iCnt02"])/100)*10000;
									// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
									fnICSS($UserIdx,"CLAScore",$UserICSSCLA);
									//ICSS 히스토리 저정
									fnICSSHistory($UserIdx);
								}
							}
						}
					}
					//상태값 R 스테이지 회차 복구
					for( $iCnt02=0;$iCnt02<count($this->arrStageRestore);$iCnt02++){
						$this->sQuery="update tbl_stage set NowTurn=NowTurn-1 where StageCode='".$this->arrStageRestore[$iCnt02]."'";
						$this->db->query($this->sQuery);
					}
					//진행중인 스테이지(S,L,W,C)의 입금 상태에 대기(A)가 없는 경우 해당 스테이지를 다음회차로 넘김.
					$this->sQuery="select tbl1.Idx,tbl1.StageNum,tbl2.DepositState from tbl_stage as tbl1 left join tbl_stage_deposit as tbl2 on tbl1.Idx=tbl2.ParentIdx and tbl1.NowTurn=tbl2.TurnNo where tbl2.DepositState!='' and (tbl1.State='S' or tbl1.State='L' or tbl1.State='W' or tbl1.State='C') order by tbl1.Idx asc ";
					$this->arrResult= $this->db->query($this->sQuery)->result_array();
					//$this->BeforeIdx="";
					$this->iStateCnt=0;
					$this->iRowCnt=0;
					foreach($this->arrResult as $row) {
						//대기 상태가 있으면 iStateCnt 카운트+1
						if ($row["DepositState"]=="A") {
							$this->iStateCnt=$this->iStateCnt+1;
						}
						$this->iRowCnt++;
//						echo "iRowCnt : ".$this->iRowCnt." - iStateCnt : ".$this->iStateCnt."<br>";
						if ($this->iRowCnt==$row["StageNum"]) {
							if ($this->iStateCnt==0) {
								//대기 상태가 없으면 다음 차로 넘김
								$this->sQuery="update tbl_stage set NowTurn=NowTurn+1 where Idx='".$row["Idx"]."' and NowTurn<'".$row["StageNum"]."'";
								$this->db->query($this->sQuery);
							}
							$this->iStateCnt=0;
							$this->iRowCnt=0;
						}
//						echo $this->iStateCnt;
					}

					//입금예정 리스트에서 연체가 하나라도 있으면 해당 스테이지 상태값을 연체로 변경
					$this->sQuery="update tbl_stage as tbl1 set tbl1.State='S' where tbl1.State in ('L','W','C') ";
					$this->db->query($this->sQuery);
					$this->sQuery="update tbl_stage as tbl1 set tbl1.State='C' where tbl1.State='S' and tbl1.Idx in (select ParentIdx as Idx from tbl_stage_deposit where DepositState='N' or DepositState='H')";
					$this->db->query($this->sQuery);
					$this->sQuery="update tbl_stage as tbl1 set tbl1.State='L' where tbl1.State='C' and tbl1.Idx in (select ParentIdx as Idx from tbl_stage_deposit where (DepositState='N' or DepositState='H') and (DATEDIFF(now(),DefaultDepositDate) > 3))";
					$this->db->query($this->sQuery);
					$this->sQuery="update tbl_stage as tbl1 set tbl1.State='W' where tbl1.State='L' and tbl1.Idx in (select ParentIdx as Idx from tbl_stage_deposit where (DepositState='N' or DepositState='H') and (DATEDIFF(now(),DefaultDepositDate) > 15))";
					$this->db->query($this->sQuery);

					//연체 히스토리를 통해 회원의 ICSS OPR값 반영
					$this->sQuery="select count(tbl1.Idx) as iOverDueCnt,(select count(Idx) as iCnt01 from tbl_stage_deposit where DepositState!='A' and UserIdx=tbl2.Idx) as iDepositCnt,tbl2.Idx from tbl_stage_overdue as tbl1 left join tbl_member as tbl2 on tbl1.UserCode=tbl2.UserCode group by tbl1.UserCode";
					$this->arrResult=$this->db->query($this->sQuery)->result_array();
					foreach($this->arrResult as $row) {
						//ICSS 평점 저장
						$UserICSSOPR=(fnICSSOPR($row["iDepositCnt"],$row["iOverDueCnt"])/100)*10000;
						// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
						fnICSS($row["Idx"],"OPRScore",$UserICSSOPR);
						//ICSS 히스토리 저정
						fnICSSHistory($row["Idx"]);
					}
					//엑셀 업로드 히스토리 저장
					$this->sQuery="insert into tbl_stage_deposit_history (AdminIdx,AdminName,FileName) values ('".$this->session->userdata("AdminIdx")."','".$this->session->userdata("AdminName")."','".$this->ExcelFile."')";
					$this->db->query($this->sQuery);
					$this->db->trans_complete();//트랜잭션 끝
					if ($this->db->trans_status() === FALSE) {
						fnAlertMsg("알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.");
					} else {
						redirect(sSiteUrl.'/calculate/depositManageList','refresh');
					}
				}
				catch (exception $e) {
					echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
				}
			} else {
				fnAlertMsg("엑셀 파일만 등록 가능합니다.");
			}
		}
	}
	//depositCalculateList
	function depositCalculateList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositCalculateList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_depositCalculateList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$this->sQuery="SELECT sum(tbl1.ScheduledDepositMoney) as TotalScheduledDepositMoney,sum(tbl1.DepositMoney) as TotalDepositMoney,sum(tbl1.ControlDepositMoney) as TotalControlDepositMoney,sum(tbl1.NonpaymentMoney) as TotalNonpaymentMoney FROM cms_depositCalculateList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult02']= $this->db->query($this->sQuery)->row_array();

		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//depositCalculateListExcel
	function depositCalculateListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositCalculateList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_depositCalculateList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('입금리스트');
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
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '이율');
		$this->excel->getActiveSheet()->setCellValue('D1', '월납입금액');
		$this->excel->getActiveSheet()->setCellValue('E1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('F1', '닉네임 / 이름');
		$this->excel->getActiveSheet()->setCellValue('G1', '입금예정일');
		$this->excel->getActiveSheet()->setCellValue('H1', '입금 예정액');
		$this->excel->getActiveSheet()->setCellValue('I1', '입금액');
		$this->excel->getActiveSheet()->setCellValue('J1', '순번');
		$this->excel->getActiveSheet()->setCellValue('K1', '회차');
		$this->excel->getActiveSheet()->setCellValue('L1', '입금일');
		$this->excel->getActiveSheet()->setCellValue('M1', '조정납입액');
		$this->excel->getActiveSheet()->setCellValue('N1', '상태');

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
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["StageRate"]."%",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,number_format($row["StageMoney"]*10000)."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["UserNickName"]." / ".$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row["ScheduledDepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["ScheduledDepositMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row["DepositMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row["MyTurn"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row["DepositTurnNo"]." / ".$row["StageNum"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row["DepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);

			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,number_format($row["ControlDepositMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,fnStageState($row["DepositState"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':N'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="입금정산리스트";
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
	//depositAdjustList
	function depositAdjustList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		//스테이지중 진행상태가 S(진행) 나 L(연체), W(부실) 인 스테이지의 현재 회차 입금 내역
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositAdjustList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_depositAdjustList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//depositAdjustListExcel
	function depositAdjustListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_depositAdjustList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_depositAdjustList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('입금리스트');
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
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('D1', '닉네임 / 이름');
		$this->excel->getActiveSheet()->setCellValue('E1', '입금예정일');
		$this->excel->getActiveSheet()->setCellValue('F1', '입금 예정액');
		$this->excel->getActiveSheet()->setCellValue('G1', '입금액');
		$this->excel->getActiveSheet()->setCellValue('H1', '입금일');
		$this->excel->getActiveSheet()->setCellValue('I1', '조정납입액');
		$this->excel->getActiveSheet()->setCellValue('J1', '상태');

		$this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserNickName"]." / ".$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["ScheduledDepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,number_format($row["ScheduledDepositMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,number_format($row["DepositMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["DepositDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,number_format($row["ControlDepositMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,fnStageState($row["StageState"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':J'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="입금정산금액조정리스트";
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
	//depositAdjustUpdateProc
	function depositAdjustUpdateProc() {
		$this->Depositidx=addslashes(trim($this->input->get('Depositidx')));
		$this->ControlDepositMoney=fnEraser(addslashes(trim($this->input->get('ControlDepositMoney'))));
		if ($this->Depositidx==""||$this->ControlDepositMoney=="") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage_deposit where Idx='".$this->Depositidx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="update tbl_stage_deposit set ScheduledDepositMoney='".$this->ControlDepositMoney."',ControlDepositMoney='".$this->ControlDepositMoney."' where Idx='".$this->Depositidx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'조정금액이 변경되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			}
		}
		return json_encode($arrRetMessage);
	}
	//depositHistoryList
	function depositHistoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stage_deposit_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_stage_deposit_history as tbl1 ".$this->sWhere."  order by Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//paymentsManageList
	function paymentsManageList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsManageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsManageList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//paymentsManageListExcel
	function paymentsManageListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsManageList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsManageList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		//휴일 체크
		$this->sQuery="select tbl1.Holiday FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
		$arrDataHoliday = $this->db->query($this->sQuery)->row();
		if ($arrDataHoliday) {
			$this->arrHoliday=explode("\r\n",$arrDataHoliday->Holiday);
		}


		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('지급리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('D1', '닉네임');
		$this->excel->getActiveSheet()->setCellValue('E1', '이름');
		$this->excel->getActiveSheet()->setCellValue('F1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('G1', '지급예정일');
		$this->excel->getActiveSheet()->setCellValue('H1', '지급은행');
		$this->excel->getActiveSheet()->setCellValue('I1', '계좌번호');
		$this->excel->getActiveSheet()->setCellValue('J1', '예금주명');
		$this->excel->getActiveSheet()->setCellValue('K1', '순번');
		$this->excel->getActiveSheet()->setCellValue('L1', '지급 예정액');
		$this->excel->getActiveSheet()->setCellValue('M1', '개인상태');
		$this->excel->getActiveSheet()->setCellValue('N1', '지급상태');
		$this->excel->getActiveSheet()->setCellValue('O1', '실 지급일');
		$this->excel->getActiveSheet()->setCellValue('P1', '지급금액');
		$this->excel->getActiveSheet()->setCellValue('Q1', '조정지급액');
		$this->excel->getActiveSheet()->setCellValue('R1', '미지급금액');
		$this->excel->getActiveSheet()->setCellValue('S1', '미지급 원금');
		$this->excel->getActiveSheet()->setCellValue('T1', '지연이자');
		$this->excel->getActiveSheet()->setCellValue('U1', '미지급 경과일');
		$this->excel->getActiveSheet()->setCellValue('V1', '지급 데이터 고유번호');
		$this->excel->getActiveSheet()->setCellValue('W1', '초기 지급 예정일');
		$this->excel->getActiveSheet()->setCellValue('X1', '초기 지급 예정액');
		$this->excel->getActiveSheet()->setCellValue('Y1', '복구여부');
		$this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserNickName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);

			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,$row["UserTel"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,$row["ScheduledReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["UserBank"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,$row["UserAccount"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,$row["UserDepositor"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,$row["MyTurn"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,$row["ScheduledReceiveMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,$row["ReceiveState"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,$row["ReceiveYN"],PHPExcel_Cell_DataType::TYPE_STRING);

			/*
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row["ReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row["ReceiveMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,$row["ControlReceiveMoney"],PHPExcel_Cell_DataType::TYPE_STRING);

			$this->excel->getActiveSheet()->setCellValueExplicit('S'.$n,$row["NonpaymentDefaultMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,$row["DelayInterest"],PHPExcel_Cell_DataType::TYPE_STRING);
			*/
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Q'.$n,$row["ControlReceiveMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('R'.$n,$row["NonpaymentMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('S'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('T'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('U'.$n,fnDateDiff($row["DefaultReceiveDate"],$this->arrHoliday),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('V'.$n,$row["ReceiveIdx"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('W'.$n,$row["DefaultReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('X'.$n,$row["DefaultMoney"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('Y'.$n,"",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':Y'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="지급리스트";
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
	//paymentsManageListExcelUpload
	function paymentsManageListExcelUpload() {
		$this->arrStageRestore=array();
		$this->arrRetFile=$this->utilmodel->do_upload("ExcelFile",sUploadFolder04);
		$this->ExcelFile=$this->arrRetFile[0];
		if ($this->ExcelFile!="") {
			$this->ExcelFilePath=sUploadFolder04.$this->ExcelFile;
			//엑셀파일 체크
			$this->arrFileInfo=fnFileInfo($this->ExcelFilePath);
			if (strtolower($this->arrFileInfo["extension"])=="xlsx"||strtolower($this->arrFileInfo["extension"])=="xls") {
				$objPHPExcel = new PHPExcel();
				try {
					// 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
					$objReader = PHPExcel_IOFactory::createReaderForFile($this->ExcelFilePath);
					// 읽기전용으로 설정
					$objReader->setReadDataOnly(true);
					// 엑셀파일을 읽는다
					$objExcel = $objReader->load($this->ExcelFilePath);
					// 첫번째 시트를 선택
					$objExcel->setActiveSheetIndex(0);
					$objWorksheet = $objExcel->getActiveSheet();
					$rowIterator = $objWorksheet->getRowIterator();
					$maxRow = $objWorksheet->getHighestRow();

					$this->bHolidayCheck=false;
					//휴일 체크
					$this->sQuery="select tbl1.Holiday FROM tbl_holiday as tbl1 where tbl1.Idx='1'";
					$arrDataHoliday = $this->db->query($this->sQuery)->row();
					if ($arrDataHoliday) {
						$this->arrHoliday=explode("\r\n",$arrDataHoliday->Holiday);
					}

					//입금예정일 휴일체크
					$dNowDate02=date("Y-m-d");
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
								$dNowDate02=date("Y-m-d",strtotime($dNowDate02."+1 days"));
							}
							if ($bHolidayCheckSub02) {
								$bHolidayCheck02=true;
							}
						} else {
							$bHolidayCheck02=true;
						}
					}

					$this->db->trans_start(); //트랜잭션 시작
					for ($i = 2 ; $i <= $maxRow ; $i++) { // 두번째 행부터 읽는다
						$ReceiveIdx= $objWorksheet->getCell('V'.$i)->getValue(); // 지급데이터 고유번호
						$ReceiveState= strtoupper($objWorksheet->getCell('M'.$i)->getValue()); // 개인상태
						$ReceiveYn= strtoupper($objWorksheet->getCell('N'.$i)->getValue());  // 지급상태
						$StageCode= $objWorksheet->getCell('B'.$i)->getValue(); //스테이지 코드
						$UserCode= $objWorksheet->getCell('C'.$i)->getValue(); // 회원코드
						$TurnNo= $objWorksheet->getCell('K'.$i)->getValue(); // 지급순번
						$OriScheduledReceiveDate=$objWorksheet->getCell('G' . $i)->getValue(); // 최종입금지금일
						$OriScheduledReceiveDate=PHPExcel_Style_NumberFormat::toFormattedString($OriScheduledReceiveDate,'YYYY-MM-DD');
						$OriScheduledReceiveDate02=$objWorksheet->getCell('W' . $i)->getValue(); // 초기입금지금일
						$OriScheduledReceiveDate02=PHPExcel_Style_NumberFormat::toFormattedString($OriScheduledReceiveDate02,'YYYY-MM-DD');
						$ScheduledReceiveMoney=fnEraser($objWorksheet->getCell('L'.$i)->getValue()); // 지급예정액
						$ReceiveMoney=fnEraser($objWorksheet->getCell('P'.$i)->getValue()); // 지급액
						$ControlReceiveMoney=fnEraser($objWorksheet->getCell('Q'.$i)->getValue()); // 조정지급액

						$NonpaymentMoney=fnEraser($objWorksheet->getCell('R'.$i)->getValue()); // 미지급금액
						$NonpaymentDefaultMoney=fnEraser($objWorksheet->getCell('S'.$i)->getValue()); // 미지급 원금
						$DelayInterest=fnEraser($objWorksheet->getCell('T'.$i)->getValue()); // 지연이자
						$ReceiveDate=$objWorksheet->getCell('O' . $i)->getValue(); // 실지급일
						$ReceiveDate=PHPExcel_Style_NumberFormat::toFormattedString($ReceiveDate,'YYYY-MM-DD');

						//$NonpaymentDate=fnEraser($objWorksheet->getCell('U'.$i)->getValue()); // 미지급 경과일
						$ReceiveRestore=strtoupper($objWorksheet->getCell('Y'.$i)->getValue()); // 복구여부
						if ($ReceiveRestore=="R") {
							//해당 스테이지가 완료된 상태면 복구 불가
							$this->sQuery="select Idx,State,NowReceiveTurn from tbl_stage where StageCode='".$StageCode."'";
							$arrData['arrResult01']= $this->db->query($this->sQuery)->row_array();
							if ($arrData['arrResult01']["State"]=="S"||$arrData['arrResult01']["State"]=="W"||$arrData['arrResult01']["State"]=="L") {
								//복구하려는 상태의 회차값과 스테이지 지급 회차값 비교
								$this->sQuery="select TurnNo from tbl_stage_receive where Idx='".$ReceiveIdx."'";
								$RestoreTurn=$this->db->query($this->sQuery)->row_array()["TurnNo"];
								$RestoreTurnGap=$arrData['arrResult01']["NowReceiveTurn"]-$RestoreTurn;
								//이전회차까지만 복구 가능, 복구 후 스테이지 회차 복구
								if ($RestoreTurnGap==0||$RestoreTurnGap==1) {
									//지급상태 복구
									$this->sQuery="update tbl_stage_receive set ReceiveYN='N',ReceiveState='Y',ControlReceiveMoney='0',ReceiveMoney='0',ScheduledReceiveMoney=DefaultMoney,ScheduledReceiveDate=DefaultReceiveDate,ReceiveDate='',NonpaymentMoney='',NonpaymentDefaultMoney='',DelayInterest='' where Idx='".$ReceiveIdx."' ";
									$this->db->query($this->sQuery);
									//원리금 수취권 삭제
									$this->sQuery="select Idx from tbl_member where UserCode='".$UserCode."'";
									$UserIdx=$this->db->query($this->sQuery)->row_array()["Idx"];
									$this->sQuery="delete from tbl_stage_principal where ParentIdx='".$arrData['arrResult01']["Idx"]."' and DebtorIdx='".$UserIdx."' ";
									$this->db->query($this->sQuery);
								}

								if ($RestoreTurnGap==1) {
									if (count($this->arrStageRestore)==0) {
										$this->arrStageRestore[count($this->arrStageRestore)]=$StageCode;
									} else {
										$StageRestoreCheck=false;
										for( $iCnt02=0;$iCnt02<count($this->arrStageRestore);$iCnt02++){
											if (($StageCode==$this->arrStageRestore[$iCnt02])) {
												$StageRestoreCheck=true;
											}
										}
										if (!$StageRestoreCheck) {
											$this->arrStageRestore[count($this->arrStageRestore)]=$StageCode;
										}
									}
								}
							}
						} else {
							$this->sAddQuery="";
							//지급 상태가 Y면 지급일 추가
							if ($ReceiveYn=="Y") {
								//해당 지급 데이터의 상태값 체크
								$this->sQuery="select tbl1.ReceiveYN,tbl2.Title from tbl_stage_receive as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.Idx='".$ReceiveIdx."'";
								$BeforeReceiveYN = $this->db->query($this->sQuery)->row_array()["ReceiveYN"];
								$StageTitle = $this->db->query($this->sQuery)->row_array()["Title"];
								if ($BeforeReceiveYN!="Y") {
									//지급상태 업데이트
									if ($ReceiveDate=="") {
										$this->sQuery="update tbl_stage_receive set ReceiveYN='".$ReceiveYn."',ReceiveMoney='".$ReceiveMoney."',NonpaymentMoney='".$NonpaymentMoney."',ScheduledReceiveDate='".$OriScheduledReceiveDate."',ReceiveDate='".$ReceiveDate."'".$this->sAddQuery." where Idx='".$ReceiveIdx."' and ReceiveYn!='Y'";
									} else {
										$this->sQuery="update tbl_stage_receive set ReceiveYN='".$ReceiveYn."',ReceiveMoney='".$ReceiveMoney."',NonpaymentMoney='".$NonpaymentMoney."',ScheduledReceiveDate='".$ReceiveDate."',ReceiveDate='".$ReceiveDate."'".$this->sAddQuery." where Idx='".$ReceiveIdx."' and ReceiveYn!='Y'";
									}
									$this->db->query($this->sQuery);

									$this->sQuery="select Idx from tbl_member where UserCode='".$UserCode."'";
									$UserIdx=$this->db->query($this->sQuery)->row_array()["Idx"];
									//약정금액 지급 알림 등록
									$this->sAlarmMessage="회원님이 가입하신 ".$StageTitle." Stage의 ".$TurnNo."번 실 지급금액이 ".date("Y")."년 ".date("m")."월 ".date("d")."일 지급 되었습니다. 입금 여부를 확인 부탁드립니다.";
									$this->utilmodel->fnAlarm($UserIdx,$this->sAlarmMessage,"Y","S");
									//원리금 수취권 생성
									fnPrincipal($UserCode,$TurnNo,$StageCode,$ReceiveMoney,$ReceiveDate);
								}
							}
							if ($ReceiveDate!="") {
								$dNowDate=date("Y-m-d",strtotime($ReceiveDate."+1 days"));
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
							} else {
								$dDateGap= strtotime($OriScheduledReceiveDate02)-strtotime($dNowDate02);
								if ($dDateGap>0) {
									$dNowDate=$OriScheduledReceiveDate02;
								} else {
									$dNowDate=$dNowDate02;
								}
							}
							if ($ReceiveYn=="H") {
								$this->sQuery="select tbl2.Title from tbl_stage_receive as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.Idx='".$ReceiveIdx."'";
								$StageTitle = $this->db->query($this->sQuery)->row_array()["Title"];
								$this->sQuery="select Idx from tbl_member where UserCode='".$UserCode."'";
								$UserIdx=$this->db->query($this->sQuery)->row_array()["Idx"];
								//약정금액 지급 알림 등록
								$this->sAlarmMessage="회원님이 가입하신 ".$StageTitle." Stage의 ".$TurnNo."번 실 지급금액이 ".date("Y")."년 ".date("m")."월 ".date("d")."일 지급 되었습니다. 입금 여부를 확인 부탁드립니다.";
								$this->utilmodel->fnAlarm($UserIdx,$this->sAlarmMessage,"Y","S");

								//해당 지급 데이터의 상태값 체크
								$this->sQuery="select tbl1.ReceiveYN from tbl_stage_receive as tbl1 where tbl1.Idx='".$ReceiveIdx."'";
								$BeforeReceiveYN = $this->db->query($this->sQuery)->row_array()["ReceiveYN"];
								if ($BeforeReceiveYN!="Y") {
									$this->sQuery="update tbl_stage_receive set ReceiveYN='".$ReceiveYn."',ReceiveMoney='".$ReceiveMoney."',NonpaymentMoney='".$NonpaymentMoney."',ScheduledReceiveDate='".$dNowDate."',ReceiveDate='".$ReceiveDate."'".$this->sAddQuery." where Idx='".$ReceiveIdx."' and ReceiveYn!='Y'";
									$this->db->query($this->sQuery);
									//원리금 수취권 생성
									fnPrincipal2($UserCode,$TurnNo,$StageCode,$ReceiveMoney,$ReceiveDate);
								}
							}
							if ($ReceiveYn=="N") {
								$this->sQuery="select tbl2.Title from tbl_stage_receive as tbl1 left join tbl_stage as tbl2 on tbl1.ParentIdx=tbl2.Idx where tbl1.Idx='".$ReceiveIdx."'";
								$StageTitle = $this->db->query($this->sQuery)->row_array()["Title"];
								$this->sQuery="select Idx from tbl_member where UserCode='".$UserCode."'";
								$UserIdx=$this->db->query($this->sQuery)->row_array()["Idx"];
								//약정금액 지급 알림 등록
								$this->sAlarmMessage="회원님이 가입하신 ".$StageTitle." Stage의 ".$TurnNo."번 실 지급금액이 ".date("Y")."년 ".date("m")."월 ".date("d")."일 지급 되었습니다. 입금 여부를 확인 부탁드립니다.";
								$this->utilmodel->fnAlarm($UserIdx,$this->sAlarmMessage,"Y","S");

								//해당 지급 데이터의 상태값 체크
								$this->sQuery="select tbl1.ReceiveYN from tbl_stage_receive as tbl1 where tbl1.Idx='".$ReceiveIdx."'";
								$BeforeReceiveYN = $this->db->query($this->sQuery)->row_array()["ReceiveYN"];
								if ($BeforeReceiveYN!="Y") {
									//지급상태 업데이트
									$this->sQuery="update tbl_stage_receive set ReceiveYN='".$ReceiveYn."',ReceiveMoney='".$ReceiveMoney."',NonpaymentMoney='".$NonpaymentMoney."',ScheduledReceiveDate='".$dNowDate."',ReceiveDate='".$ReceiveDate."'".$this->sAddQuery." where Idx='".$ReceiveIdx."' and ReceiveYn!='Y'";
									$this->db->query($this->sQuery);
								}
							}

						}
					}
					//상태값 R 스테이지 회차 복구
					for($iCnt02=0;$iCnt02<count($this->arrStageRestore);$iCnt02++){
						$this->sQuery="update tbl_stage set NowReceiveTurn=NowReceiveTurn-1 where StageCode='".$this->arrStageRestore[$iCnt02]."'";
						$this->db->query($this->sQuery);
					}
					//진행중인 스테이지(S,L,W)의 지금 상태에 Y 갯수로 지급 차수 처리.
					$this->sQuery="select tbl1.Idx,tbl1.StageNum,tbl1.Title,(select count(Idx) from tbl_stage_receive where ReceiveYN='Y' and ParentIdx=tbl1.Idx) as iReceiveCnt01 from tbl_stage as tbl1 where (tbl1.State='S' or tbl1.State='L' or tbl1.State='W' or tbl1.State='C') order by tbl1.Idx asc ";
					$this->arrResult= $this->db->query($this->sQuery)->result_array();
					foreach($this->arrResult as $row) {
						if ($row["StageNum"]==$row["iReceiveCnt01"]) {
							//스테이지 마감처리
							$NowReceiveTurn=$row["iReceiveCnt01"];
							$this->sAddQuery=",State='E',EndDate=now() ";
						} else {
							$NowReceiveTurn=$row["iReceiveCnt01"]+1;
							$this->sAddQuery="";
						}
						//지급회차 적용
						$this->sQuery="update tbl_stage set NowReceiveTurn='".$NowReceiveTurn."'".$this->sAddQuery." where Idx='".$row["Idx"]."'";
						$this->db->query($this->sQuery);
						//스테이지의 ICSS POU 적용
						$this->sQuery="select tbl1.UserIdx from tbl_stage_payment as tbl1 where tbl1.ParentIdx='".$row["Idx"]."'";
						$this->arrResultSub= $this->db->query($this->sQuery)->result_array();
						foreach($this->arrResultSub as $row02) {
							//ICSS 평점 저장
							$UserICSSPOU=(fnICSSPOUAccumulate($row02["UserIdx"])/100)*10000;
							// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
							fnICSS($row02["UserIdx"],"POUScore",$UserICSSPOU);
							//ICSS 히스토리 저정
							fnICSSHistory($row02["UserIdx"]);
						}
						if ($row["StageNum"]==$row["iReceiveCnt01"]) {
							foreach($this->arrResultSub as $row02) {
								//스테이지 마감 알림 등록
								$this->sAlarmMessage=$row["Title"]." Stage의 약정 기간이 만료되었습니다. 앞으로도 아임인을 많이 이용해 주시기 바랍니다. 보다 나은 서비스를 회원님에게 제공해드리기 위해 항상 노력하는 아임인이 되겠습니다.[아임인]";
								$this->utilmodel->fnAlarm($row02["UserIdx"],$this->sAlarmMessage,"Y","S");
							}
							//ICSS SN,SNE 적용
							$this->sQuery="select tbl1.ICSSSNEScore,tbl1.UserIdx from tbl_stage_apply as tbl1 where tbl1.ParentIdx='".$row["Idx"]."'";
							$this->arrResultSub02= $this->db->query($this->sQuery)->result_array();
							foreach($this->arrResultSub02 as $row04) {
								$this->sQuery="select SNEScore from tbl_member_ICSS where UserIdx='".$row04["UserIdx"]."'";
								$UserICSSSNE02= $this->db->query($this->sQuery)->row_array()["SNEScore"];
								$UserICSSSNE02=$UserICSSSNE02+$row04["ICSSSNEScore"];
								// 회원 고유번호,ICSS 컬럼명,ICSS 변경점수
								fnICSS($row04["UserIdx"],"SNEScore",$UserICSSSNE02);
								$UserICSSSNA=fnICSSSNAccumulate($row04["UserIdx"]);
								fnICSS($row04["UserIdx"],"SNScore",$UserICSSSNA);
								//ICSS 히스토리 저정
								fnICSSHistory($row04["UserIdx"]);
							}
						}
					}
					//엑셀 업로드 히스토리 저장
					$this->sQuery="insert into tbl_stage_receive_history (AdminIdx,AdminName,FileName) values ('".$this->session->userdata("AdminIdx")."','".$this->session->userdata("AdminName")."','".$this->ExcelFile."')";
					$this->db->query($this->sQuery);
					$this->db->trans_complete();//트랜잭션 끝
					if ($this->db->trans_status() === FALSE) {
						fnAlertMsg("알수없는 오류가 발생했습니다. 해당 문제가 지속될시 관리자에게 연락주세요.");
					} else {
						redirect(sSiteUrl.'/calculate/paymentsManageList','refresh');
					}
				}
				catch (exception $e) {
					echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
				}
			} else {
				fnAlertMsg("엑셀 파일만 등록 가능합니다.");
			}
		}
	}
	//paymentsCalculateList
	function paymentsCalculateList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsCalculateList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsCalculateList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		$this->sQuery="SELECT sum(tbl1.ScheduledReceiveMoney) as TotalScheduledReceiveMoney,sum(tbl1.ReceiveMoney) as TotalReceiveMoney,sum(tbl1.ControlReceiveMoney) as TotalControlReceiveMoney,sum(tbl1.NonpaymentMoney) as TotalNonpaymentMoney FROM cms_paymentsCalculateList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult02']= $this->db->query($this->sQuery)->row_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//paymentsCalculateListExcel
	function paymentsCalculateListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsCalculateList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsCalculateList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();

		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('지급정산리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);

		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('D1', '닉네임 / 이름');
		$this->excel->getActiveSheet()->setCellValue('E1', '지급예정일');
		$this->excel->getActiveSheet()->setCellValue('F1', '지급 예정액');
		$this->excel->getActiveSheet()->setCellValue('G1', '지급액');
		$this->excel->getActiveSheet()->setCellValue('H1', '지급일');
		$this->excel->getActiveSheet()->setCellValue('I1', '조정입금액');
		$this->excel->getActiveSheet()->setCellValue('J1', '미지급금액');
		$this->excel->getActiveSheet()->setCellValue('K1', '지급상태');
		$this->excel->getActiveSheet()->setCellValue('L1', '총납입금액');
		$this->excel->getActiveSheet()->setCellValue('M1', '실이자');
		$this->excel->getActiveSheet()->setCellValue('N1', '실이자 지급액');
		$this->excel->getActiveSheet()->setCellValue('O1', '연락처');
		$this->excel->getActiveSheet()->setCellValue('P1', '주민등록번호');

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
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserNickName"]." / ".$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["ScheduledReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,number_format($row["ScheduledReceiveMoney"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,number_format($row["ReceiveMoney"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,$row["ReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,number_format($row["ControlReceiveMoney"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('J'.$n,number_format($row["NonpaymentMoney"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('K'.$n,fnReceiveState04($row["ReceiveYN"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('L'.$n,number_format($row["TotalPayment"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('M'.$n,number_format($row["RealInterest"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('N'.$n,number_format($row["InterestPayment"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('O'.$n,$row["UserTel"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('P'.$n,$row["UserPSNNo"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':P'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="지급정산리스트";
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
	//paymentsAdjustList
	function paymentsAdjustList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
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
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsAdjustList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsAdjustList as tbl1 ".$this->sWhere." LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sSearchType']=$this->sSearchType;
		$arrData['sSearchWord']=$this->sSearchWord;
		$arrData['sSearchDateType']=$this->sSearchDateType;
		$arrData['dStartDate']=$this->dStartDate;
		$arrData['dEndDate']=$this->dEndDate;
		$arrData['sParam']=fnParam();
		return $arrData;
	}
	//paymentsAdjustUpdateProc
	function paymentsAdjustUpdateProc() {
		$this->Receiveidx=addslashes(trim($this->input->get('Receiveidx')));
		$this->ControlReceiveMoney=fnEraser(addslashes(trim($this->input->get('ControlReceiveMoney'))));
		if ($this->Receiveidx==""||$this->ControlReceiveMoney=="") {
			$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'잘못된 접근입니다.');
		} else {
			$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stage_receive where Idx='".$this->Receiveidx."'";
			$this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
			if ($this->iCnt01!=0) {
				$this->sQuery="update tbl_stage_receive set ControlReceiveMoney='".$this->ControlReceiveMoney."' where Idx='".$this->Receiveidx."'";
				$arrData['arrResult']=$this->db->query($this->sQuery);
				if ($arrData['arrResult']) {
					$arrRetMessage=array('sRetCode'=>'01','sMessage'=>'조정지급액이 변경되었습니다.');
				} else {
					$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'작업 중 오류가 발생하였습니다. 해당 문제가 지속될시 관리자에게 문의주세요.');
				}
			}
		}
		return json_encode($arrRetMessage);
	}
	//paymentsAdjustListExcel
	function paymentsAdjustListExcel() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->sSearchType=addslashes(trim($this->input->get('sSearchType')));
		$this->sSearchWord=addslashes(trim($this->input->get('sSearchWord')));
		$this->sSearchDateType=addslashes(trim($this->input->get('sSearchDateType')));
		$this->dStartDate=addslashes(trim($this->input->get('dStartDate')));
		$this->dEndDate=addslashes(trim($this->input->get('dEndDate')));
		$this->sWhere="where 1=1 ";
		if ($this->sSearchType) {
			if ($this->sSearchWord) {
				$this->sWhere.=" and tbl1.".$this->sSearchType." like '%".$this->sSearchWord."%' ";
			}
		}
		if ($this->sSearchDateType) {
			if ($this->dStartDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." >='".$this->dStartDate."' "; }
			if ($this->dEndDate) { $this->sWhere.=" and tbl1.".$this->sSearchDateType." <='".$this->dEndDate."' "; }
		}
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM cms_paymentsAdjustList as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$this->sQuery="SELECT tbl1.* FROM cms_paymentsAdjustList as tbl1 ".$this->sWhere." ";
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		# 시트지정
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('지급정산금액조정리스트');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		# cell 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', '스테이지 코드');
		$this->excel->getActiveSheet()->setCellValue('C1', '회원코드');
		$this->excel->getActiveSheet()->setCellValue('D1', '닉네임 / 이름');
		$this->excel->getActiveSheet()->setCellValue('E1', '지급예정일');
		$this->excel->getActiveSheet()->setCellValue('F1', '지급 예정액');
		$this->excel->getActiveSheet()->setCellValue('G1', '미지급 금액');
		$this->excel->getActiveSheet()->setCellValue('H1', '조정지급액');
		$this->excel->getActiveSheet()->setCellValue('I1', '지급상태');

		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
		# cell 병합
		//$this->excel->getActiveSheet()->mergeCells('A1:AB1');
		# 헤더 컬럼 가운데 정렬
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		# cell 데이터 출력
		$n=2;
		foreach($arrData['arrResult'] as $row):
			$this->excel->getActiveSheet()->setCellValueExplicit('A'.$n,$arrData['iTotalCnt']--,PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('B'.$n,$row["StageCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('C'.$n,$row["UserCode"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('D'.$n,$row["UserNickName"]." / ".$row["UserName"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('E'.$n,$row["ScheduledReceiveDate"],PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('F'.$n,number_format($row["ScheduledReceiveMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('G'.$n,number_format($row["ControlReceiveMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('H'.$n,number_format($row["NonpaymentMoney"])."원",PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->setCellValueExplicit('I'.$n,fnReceiveState04($row["ReceiveYN"]),PHPExcel_Cell_DataType::TYPE_STRING);
			$this->excel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$n++;
		endforeach;

		$sFileName="지급정산금액조정리스트";
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
	//paymentsHistoryList
	function paymentsHistoryList() {
		$this->sPage=addslashes(trim($this->input->get('sPage')));
		$this->iPageScale = 10;
		$this->iStepScale = 5;
		$this->sWhere="where 1=1 ";
		if(!$this->sPage){ $this->sPage = 1;}
		$this->iStart=($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT count(tbl1.Idx) as iCnt FROM tbl_stage_receive_history as tbl1 ".$this->sWhere;
		$this->iNum=$this->db->query($this->sQuery)->row()->iCnt;
		$arrData['iTotalCnt']=$this->iNum;
		$arrData['iNum']=$this->iNum-($this->sPage-1)*$this->iPageScale;
		$this->sQuery="SELECT tbl1.* FROM tbl_stage_receive_history as tbl1 ".$this->sWhere." order by Idx desc LIMIT ".$this->iStart.", ".$this->iPageScale;
		$arrData['arrResult']= $this->db->query($this->sQuery)->result_array();
		$arrData['sPage']=$this->sPage;
		$arrData['sPaging']=$this->utilmodel->fnPaging($arrData['iTotalCnt'],$this->iPageScale,$this->iStepScale,$this->sPage);
		$arrData['sParam']=fnParam();
		return $arrData;
	}


}
