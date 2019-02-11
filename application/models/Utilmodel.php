<?php
class Utilmodel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
//		$this->load->database();
		$this->load->helper(array('form', 'url'));
	}
	public function do_upload($sValue01,$sValue02) {
		$files=$_FILES;
		if (isset($_FILES[$sValue01])) {
			$cpt = count($_FILES[$sValue01]['name']);
			$arrRetValue=array();
			for($i=0; $i<$cpt; $i++) {
				$_FILES[$sValue01]['name']= $files[$sValue01]['name'][$i];
				$_FILES[$sValue01]['type']= $files[$sValue01]['type'][$i];
				$_FILES[$sValue01]['tmp_name']= $files[$sValue01]['tmp_name'][$i];
				$_FILES[$sValue01]['error']= $files[$sValue01]['error'][$i];
				$_FILES[$sValue01]['size']= $files[$sValue01]['size'][$i];
				//파일 이름 재정의
				$sCurrentTime= time();
				$sTimeInfo= getdate($sCurrentTime);
				$sFileName=$sTimeInfo["year"].$sTimeInfo["mon"].$sTimeInfo["mday"].$sTimeInfo["seconds"].$sTimeInfo["minutes"].$sTimeInfo["hours"];
				//오리지널 파일 이름.확장자
				$sExt = substr(strrchr($_FILES[$sValue01]['name'],"."),1);
				$sExt = strtolower($sExt);
				$sFileName = $sFileName.".".$sExt;
				$this->upload->initialize($this->set_upload_options($sValue02,$sFileName));
				$retValue = $this->upload->do_upload($sValue01);
				if (!$retValue) {
	//				var_dump($this->upload->display_errors());
	//				exit;
					$arrRetValue[$i]="";
				} else {
					$arrRetValue[$i]= $this->upload->data('file_name');
					if ($this->upload->data('is_image')) {
						$config['image_library']='gd2';
						$config['source_image'] =$this->upload->data('full_path');
						$config['create_thumb'] = TRUE;
						$config['thumb_marker'] ="";
						$config['new_image'] = $sValue02."/thumbnail/";
						$config['maintain_ratio'] = TRUE;
						$config['quality'] ="100%";
						$config['width'] = 80;
						$config['height'] = 80;
						$this->load->library('image_lib',$config);
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$this->image_lib->clear();
						$config02['image_library']='gd2';
						$config02['source_image'] =$this->upload->data('full_path');
						$config02['create_thumb'] = TRUE;
						$config02['thumb_marker'] ="";
						$config02['new_image'] = $sValue02."/medium/";
						$config02['maintain_ratio'] = TRUE;
						$config02['quality'] ="100%";
						$config02['width'] = 350;
						$this->load->library('image_lib',$config02);
						$this->image_lib->initialize($config02);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}

				}
			}
			return $arrRetValue;
		}
	}
	public function set_upload_options($sValue01,$sValue02) {
		//upload an image options
		$config=array();
		$config['upload_path']=$sValue01;
		$config['file_name']=$sValue02;
		$config['remove_spaces']=true;
		$config['detect_mime']=true;
		$config['allowed_types']='*';
		$config['max_size']='55360';
		$config['overwrite']=false;
		$config['mod_mime_fix']=false;
		return $config;
	}
	function fnPaging($iNum,$iPageScale,$iStepScale,$iPage) {
		$iLastPage = $iNum/$iPageScale + ($iNum%$iPageScale==0?0:1);
//		$iStepScale = 5;
		$iStepStart = (intval(($iPage-1)/$iStepScale))*$iStepScale+1;
		$iStepEnd = $iStepStart + $iStepScale;
		$iStepValue = $iStepStart-$iStepScale;
		$sResult="<script language='javascript' type='text/javascript'>".chr(13);
		$sResult.="<!--".chr(13);
		$sResult.="	$(document).ready(function(){".chr(13);
		$sResult.="		$('#actForm').submit(function(e) {".chr(13);
		$sResult.="			e.preventDefault();".chr(13);
		$sResult.="			fnResetForm();".chr(13);
		$sResult.="		});".chr(13);
		$sResult.="	});".chr(13);
		$sResult.="	function fnGotoPage(sPage) {".chr(13);
		$sResult.="		document.getElementById('sPage').value = sPage;".chr(13);
		$sResult.="		document.getElementById('actForm').submit();".chr(13);
		$sResult.="	}".chr(13);
		$sResult.="	function fnResetForm() {".chr(13);
		$sResult.="		document.getElementById('sPage').value ='';".chr(13);
		$sResult.="		document.getElementById('actForm').submit();".chr(13);
		$sResult.="	}".chr(13);
		$sResult.="//-->".chr(13);
		$sResult.="</script> ".chr(13);
		$sResult.="<ul class='pagination'>";
		if(($iStepValue)>0){
			$sResult.="<li><a class='paginate_button ' href=\"javascript:fnGotoPage('".$iStepValue."');\" aria-controls='data-table' tabindex='0'>Previous</a><li>";
		} else {
			$sResult.="<li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Previous</a></li>";

		}
		for ($i=$iStepStart; ($i<=$iLastPage && $i<$iStepEnd); $i++){
			if($iPage==$i){
				$sResult.="<li class='active'><a class='paginate_button active' aria-controls='data-table' tabindex='0'>".$i."</a></li>";
			}else{
				$sResult.="<li><a href=\"javascript:fnGotoPage('".$i."');\">".$i."</a></li>";
			}//if end
		} //for end
		if($iStepEnd<=$iLastPage){
			$sResult.="<li><a href=\"javascript:fnGotoPage('".$iStepEnd."');\"  rel='next'>Next</a></li>";
		} else {
			$sResult.="<li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Next</a></li>";
		}
		$sResult.="</ul>";
		return $sResult;
	}

	function fnPaging02($iNum,$iPageScale,$iStepScale,$iPage) {
		$iLastPage = $iNum/$iPageScale + ($iNum%$iPageScale==0?0:1);
//		$iStepScale = 5;
		$iStepStart = (intval(($iPage-1)/$iStepScale))*$iStepScale+1;
		$iStepEnd = $iStepStart + $iStepScale;
		$iStepValue = $iStepStart-$iStepScale;
		$sResult="<script language='javascript' type='text/javascript'>".chr(13);
		$sResult.="<!--".chr(13);
		$sResult.="	$(document).ready(function(){".chr(13);
		$sResult.="		$('#actForm').submit(function(e) {".chr(13);
		$sResult.="			e.preventDefault();".chr(13);
		$sResult.="			fnResetForm();".chr(13);
		$sResult.="		});".chr(13);
		$sResult.="	});".chr(13);
		$sResult.="	function fnGotoPage(sPage02) {".chr(13);
		$sResult.="		document.getElementById('sPage02').value = sPage02;".chr(13);
		$sResult.="		document.getElementById('actForm').submit();".chr(13);
		$sResult.="	}".chr(13);
		$sResult.="	function fnResetForm() {".chr(13);
		$sResult.="		document.getElementById('sPage02').value ='';".chr(13);
		$sResult.="		document.getElementById('actForm').submit();".chr(13);
		$sResult.="	}".chr(13);
		$sResult.="//-->".chr(13);
		$sResult.="</script> ".chr(13);
		$sResult.="<ul class='pagination'>";
		if(($iStepValue)>0){
			$sResult.="<li><a class='paginate_button ' href=\"javascript:fnGotoPage('".$iStepValue."');\" aria-controls='data-table' tabindex='0'>Previous</a><li>";
		} else {
			$sResult.="<li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Previous</a></li>";

		}
		for ($i=$iStepStart; ($i<=$iLastPage && $i<$iStepEnd); $i++){
			if($iPage==$i){
				$sResult.="<li class='active'><a class='paginate_button active' aria-controls='data-table' tabindex='0'>".$i."</a></li>";
			}else{
				$sResult.="<li><a href=\"javascript:fnGotoPage('".$i."');\">".$i."</a></li>";
			}//if end
		} //for end
		if($iStepEnd<=$iLastPage){
			$sResult.="<li><a href=\"javascript:fnGotoPage('".$iStepEnd."');\"  rel='next'>Next</a></li>";
		} else {
			$sResult.="<li class='disabled'><a class='paginate_button ' aria-controls='data-table' tabindex='0'>Next</a></li>";
		}
		$sResult.="</ul>";
		return $sResult;
	}
	public function download() {
		$this->FilePath=addslashes($this->input->get('FilePath'));
		force_download('/home/src/imin/upload/'.$this->FilePath, NULL);
	}
	public function fnAlarm($UserIdx,$Contents,$SmsYn,$AlarmType) {
		$this->sQuery="insert into tbl_member_alarm (UserIdx,Contents,SmsYN,AlarmType) values ('".$UserIdx."','".$Contents."','".$SmsYn."','".$AlarmType."')";
		$arrData['arrResult']= $this->db->query($this->sQuery);
		if ($SmsYn=="Y") {
			$Contents=$Contents."[아임인]";
			$this->fnSendSMS($UserIdx,$Contents);
		}
	}
	//SMS 발송
	public function fnSendSMS($sValue01,$sValue02) { //수신자 고유번호,메세지
		if ($sValue01==""||$sValue02=="") {
		} else {
			$this->sQuery="SELECT UserTel FROM tbl_member_plus where ParentIdx='".$sValue01."'";
			$this->UserTel=$this->db->query($this->sQuery)->row_array()["UserTel"];
			if ($this->UserTel!="") {
				$ch = curl_init();
				/*
				* message	: 받을 문자 내용 최대 2000바이트.
				* username : directsend 발급 ID
				* recipients : 발송 할 고객 번호 , 로 구분함. (ex. 01012341234,0101555123,010303040123)
				* key : directsend 발급 api key
				*
				* 각 번호가 유효하지않을 경우에는 발송이 되지 않습니다.
				*/
				/* 여기서부터 수정해주시기 바랍니다. */
				$message = $sValue02;
				$sender = "025839442";
				$username = "twave";
				$recipients = $this->UserTel;
				$key = "KRhCOwMCQG4UFAu";
				/* 여기까지 수정해주시기 바랍니다. */
				/* Server의 인코딩이 utf-8일때 다음 구문을 사용하세요*/
				/* UTF-8 */
				$message = base64_encode(iconv("utf-8","euc-kr",$message));
				/* Server의 인코딩이 euc-kr일때 사용하세요. */
				/* EUC-KR	*/
				//$message = base64_encode($message);
				$postvars = "message=" . urlencode($message)
				. "&sender=" . urlencode($sender)
				. "&username=" . urlencode($username)
				. "&recipients=" . urlencode($recipients)
				. "&key=" . urlencode($key);
				$url = "https://directsend.co.kr/index.php/api/v1/sms";
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, true);
				curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
				curl_setopt($ch,CURLOPT_TIMEOUT, 20);
				$response = curl_exec($ch);
				/*
				* response의 실패
				*	{"status":101}
				*/

				/*
				* response 성공
				* {"status":0}
				* 성공 코드번호.
				*/

				/*
				** status code
					0	: 정상발송
					100 : POST validation 실패
					101 : sender 유효한 번호가 아님
					102 : recipient 유효한 번호가 아님
					103 : api key or user is invalid
					104 : recipient count = 0
					105 : message length = 0
					106 : message validation 실패
					205 : 잔액부족
					999 : Internal Error.
				**
				*/
				$this->sQuery="insert into tbl_send_sms (SendTel,UserTel,UserIdx,Mesage,ReturnCode) values ('".$sender."','".$this->UserTel."','".$sValue01."','".$sValue02."','".$response."')";
				$this->db->query($this->sQuery);
				curl_close ($ch);
			}
		}
	}
}
