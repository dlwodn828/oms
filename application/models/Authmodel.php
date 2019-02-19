<?php
class Authmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
	}
	function index() {
		$this->AdminId=$this->input->cookie('AdminId',TRUE);
		if ($this->AdminId!="") {
			$arrData=array('AdminId'=>$this->AdminId,'SaveAdmin'=>'Y');
		} else {
			$arrData=array('AdminId'=>$this->AdminId,'SaveAdmin'=>'N');
		}
		return $arrData;
	}
	// function checkSession(){
	// 	$savedUserdata = $this->session->userdata("AdminLoginYn");
	// 	$this->sQuery="SELECT userid FROM tbl_company WHERE userid='".$this->
	// }
	function loginProc() {
		$this->AdminId=addslashes(trim($this->input->post('AdminId')));
		$this->AdminPwd=addslashes(trim($this->input->post('AdminPwd')));
		$this->sQuery="SELECT idx,userid,userpwd,companyname FROM ".sTableName01." where userid='".$this->AdminId."'";
		$oResult = $this->db->query($this->sQuery)->row();
		if ($oResult) {
			if ($oResult->userpwd==$this->AdminPwd) { //로그인시
						$newdata = array('AdminLoginYn' =>true,'AdminIdx'=>$oResult->idx,'AdminName'=>$oResult->companyname,'AdminId'=>$this->AdminId);
						$this->session->set_userdata($newdata);
					  $arrRetMessage=array('sRetCode'=>'01','sMessage'=>' 로그인이 완료되었습니다.','sRetUrl'=>'/prices');
				} else {
				$arrRetMessage=array('sRetCode'=>'03','sMessage'=>'비밀번호가 틀립니다.');
			}
		} else { //회원이 아닐때
		$arrRetMessage=array('sRetCode'=>'02','sMessage'=>'회원정보를 찾을 수 없습니다.');
		}
		return json_encode($arrRetMessage);
	}
	function logOutProc() {
		$this->session->sess_destroy();
		redirect('/auth','refresh');
	}
	function checkLogin01() {
		if (!$this->session->userdata("AdminLoginYn")) {
			redirect('/auth','refresh');
		}
		$this->arrSidebar = $this->fnSideBar();
		return $this->arrSidebar;
	}
	function checkLogin02() {
		if ($this->session->userdata("AdminLoginYn")) { 
			redirect('/prices','refresh');
		}else{
			redirect('/c_orders','refresh');
		}
	}
	function fnSideBar() {
		$arrPageNavi=array(
			// array("/prices/pricelist","1","","1"),
			array("/customers/consulthistorylist","1","","1"),
			array("/products/productlist","2","","2"),
			// array("/customers/alltRfidBackup","2","","3"),
		);
		$arrPageNavi_modify=array(
			array("/customers/modifycompany","1","","1"),
			array("/products/modifyproduct","2","","2"),
			// array("/customers/alltRfidBackup","2","","3"),
		);
		$sNowPage=$_SERVER["REQUEST_URI"];
		$sSideBar01="";
		$sSideBar02="";
		$sSideBar03="";
		//페이지 추출
		$sNowPage02=explode("?",$sNowPage);
		if(is_array($sNowPage02)) {$sNowPage=$sNowPage02[0]; }
		for( $iCnt=0; $iCnt<sizeof($arrPageNavi); $iCnt++ ){
			if ((strtolower($sNowPage)==$arrPageNavi[$iCnt][0]) || strtolower($sNowPage)==$arrPageNavi_modify[$iCnt][0]) {
				$sSideBar01=$arrPageNavi[$iCnt][1]; //1		2
				$sSideBar02=$arrPageNavi[$iCnt][2]; //""	""
				$sSideBar03=$arrPageNavi[$iCnt][3]; //1		2
			}
		}
		$arrTopNaviClass01=array_fill(0,22,"");
		$arrTopNaviClass02=array_fill(0,10,"");
		$arrTopNaviClass03=array_fill(0,100,"");
		$arrTopNaviClass01[$sSideBar01]="active";
		$arrTopNaviClass02[$sSideBar02]="active";
		$arrTopNaviClass03[$sSideBar03]="active";
//		if ($iNowPageRole>$iAdminRole) {
			// fnAlertMsg03("접근권한이 없습니다.","/auth");
//		} else {
//		}
		$arrData['sidebar01']=$arrTopNaviClass01;
		$arrData['sidebar02']=$arrTopNaviClass02;
		$arrData['sidebar03']=$arrTopNaviClass03;
		return $arrData;
	}
	function fnSideBar1() {
		$arrPageNavi=array(
			array("/customers/consultHistorylist","1","","1"),
			array("/products/productList","2","","2"),
			// array("/orders/alltRfidBackup","2","","3"),
			// array("/dashboard/dashboard","2","","3"),
		);
		$sNowPage=$_SERVER["REQUEST_URI"];
		$sSideBar01="";
		$sSideBar02="";
		$sSideBar03="";
		//페이지 추출
		$sNowPage02=explode("?",$sNowPage);
		if(is_array($sNowPage02)) {$sNowPage=$sNowPage02[0]; }// /customer/~~~
		for( $iCnt=0; $iCnt<sizeof($arrPageNavi); $iCnt++ ){
			if ((strtolower($sNowPage)==$arrPageNavi[$iCnt][0])) {
				$sSideBar01=$arrPageNavi[$iCnt][1]; //1
				$sSideBar02=$arrPageNavi[$iCnt][2]; //""
				$sSideBar03=$arrPageNavi[$iCnt][3]; //1
			}
		}
		$arrTopNaviClass01=array_fill(0,22,"");
		$arrTopNaviClass02=array_fill(0,10,"");
		$arrTopNaviClass03=array_fill(0,100,"");
		$arrTopNaviClass01[$sSideBar01]="active"; // atc01의 두번째에 active
		$arrTopNaviClass02[$sSideBar02]="active"; // atc02의 ""에 active
		$arrTopNaviClass03[$sSideBar03]="active"; // atc03의 두번째에 active
//		if ($iNowPageRole>$iAdminRole) {
			// fnAlertMsg03("접근권한이 없습니다.","/auth");
//		} else {
//		}
		$arrData['sidebar01']=$arrTopNaviClass01; // sideboar01 => "","active", "","","","",""....
		$arrData['sidebar02']=$arrTopNaviClass02;
		$arrData['sidebar03']=$arrTopNaviClass03;
		return $arrData;
	}
	function fnAdminAuthCheck($iAdminIdx,$iAdminRole,$sAdminPermission,$sSuperAdminCheck) {
		if ($iAdminRole=="9") {
		} else {
			if ($sSuperAdminCheck=="Y") {
				if ($this->session->userdata("AdminLoginYn")) {
					fnAlertMsg("접근권한이 없습니다.");
				} else {
					fnAlertMsgUrl("접근권한이 없습니다.","/auth");
				}
			} else {
				$this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_admin where Idx='".$iAdminIdx."' and AdminPermission like '%".$sAdminPermission."%'";
				$this->iCnt01= $this->db->query($this->sQuery)->row()->iCnt01;
				if ($this->iCnt01==0) {
					fnAlertMsgUrl("접근권한이 없습니다.","/auth");
				}
			}
		}
	}
}
?>
