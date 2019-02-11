<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('settingsmodel');
	}
	public function index() {
		redirect(sSiteUrl.'/settings/mainPage','refresh');
	}
	//managerValid
	public function managerValid() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$sRetValue=$this->settingsmodel->managerValid();
		echo $sRetValue;
	}
	//managerList
	public function managerList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->managerList();
		$this->load->view('settings/managerList',$arrData);
		$this->load->view('include/incBottom');
	}
	//managerCreate
	public function managerCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->managerCreate();
		$this->load->view('settings/managerCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//managerCreateProc
	public function managerCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$this->settingsmodel->managerCreateProc();
	}
	//managerDelProc
	public function managerDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$arrData=$this->settingsmodel->managerDelProc();
		echo $arrData;
	}
	//managerModify
	public function managerModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->managerModify();
		$this->load->view('settings/managerModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//managerModifyProc
	public function managerModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"9-1","N");
//		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"","Y");
		$this->settingsmodel->managerModifyProc();
	}
	//mainPage
	public function mainPage() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainPage();
		$this->load->view('settings/mainPage',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainPageModify
	public function mainPageModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainPageModify();
		$this->load->view('settings/mainPageModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainPageModifyProc
	public function mainPageModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-1","N");
		$this->settingsmodel->mainPageModifyProc();
	}
	/*
	//agreementList
	public function agreementList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->agreementList();
		$this->load->view('settings/agreementList',$arrData);
		$this->load->view('include/incBottom');
	}
	//agreementCreate
	public function agreementCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->agreementCreate();
		$this->load->view('settings/agreementCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//agreementCreateProc
	public function agreementCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->settingsmodel->agreementCreateProc();
	}
	//agreementModify
	public function agreementModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->agreementModify();
		$this->load->view('settings/agreementModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//agreementModifyProc
	public function agreementModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->settingsmodel->agreementModifyProc();
	}
	//agreementDelProc
	public function agreementDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$arrData=$this->settingsmodel->agreementDelProc();
		echo $arrData;
	}
	*/
	//categoryList
	public function categoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->categoryList();
		$this->load->view('settings/categoryList',$arrData);
		$this->load->view('include/incBottom');
	}
	//categoryCreate
	public function categoryCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->categoryCreate();
		$this->load->view('settings/categoryCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//categoryCreateProc
	public function categoryCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->settingsmodel->categoryCreateProc();
	}
	//categorySortValid
	public function categorySortValid() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->settingsmodel->categorySortValid();
	}
	//categoryModify
	public function categoryModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->categoryModify();
		$this->load->view('settings/categoryModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//categoryModifyProc
	public function categoryModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->settingsmodel->categoryModifyProc();
	}
	//categoryDelProc
	public function categoryDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$arrData=$this->settingsmodel->categoryDelProc();
		echo $arrData;
	}
	//categoryFileDelProc
	public function categoryFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-2","N");
		$this->settingsmodel->categoryFileDelProc();
	}
	//registItemList
	public function registItemList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->registItemList();
		$this->load->view('settings/registItemList',$arrData);
		$this->load->view('include/incBottom');
	}
	//registItemCreateProc
	public function registItemCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemCreateProc();
	}
	//registItemDelProc
	public function registItemDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$arrData=$this->settingsmodel->registItemDelProc();
		echo $arrData;
	}
	//registItemModify
	public function registItemModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemModify();
	}
	//registItemModifyProc
	public function registItemModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemModifyProc();
	}
	//registItemSub
	public function registItemSub() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->registItemSub();
		$this->load->view('settings/registItemSub',$arrData);
		$this->load->view('include/incBottom');
	}
	//registItemSortValid
	public function registItemSortValid() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemSortValid();
	}
	//registItemSubCreateProc
	public function registItemSubCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemSubCreateProc();
	}
	//registItemSubDelProc
	public function registItemSubDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$arrData=$this->settingsmodel->registItemSubDelProc();
		echo $arrData;
	}
	//registItemSubModify
	public function registItemSubModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemSubModify();
	}
	//registItemSubModifyProc
	public function registItemSubModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-3","N");
		$this->settingsmodel->registItemSubModifyProc();
	}
	//bannerList
	public function bannerList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->bannerList();
		$this->load->view('settings/bannerList',$arrData);
		$this->load->view('include/incBottom');
	}
	//bannerCreate
	public function bannerCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->bannerCreate();
		$this->load->view('settings/bannerCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//bannerCreateProc
	public function bannerCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$this->settingsmodel->bannerCreateProc();
	}
	//bannerModify
	public function bannerModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->bannerModify();
		$this->load->view('settings/bannerModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//bannerDelProc
	public function bannerDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$arrData=$this->settingsmodel->bannerDelProc();
		echo $arrData;
	}
	//bannerModifyProc
	public function bannerModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-4","N");
		$this->settingsmodel->bannerModifyProc();
	}
	//popupList
	public function popupList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->popupList();
		$this->load->view('settings/popupList',$arrData);
		$this->load->view('include/incBottom');
	}
	//popupCreate
	public function popupCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->popupCreate();
		$this->load->view('settings/popupCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//popupCreateProc
	public function popupCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$this->settingsmodel->popupCreateProc();
	}
	//popupDelProc
	public function popupDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$arrData=$this->settingsmodel->popupDelProc();
		echo $arrData;
	}
	//popupModify
	public function popupModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->popupModify();
		$this->load->view('settings/popupModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//popupModifyProc
	public function popupModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-5","N");
		$this->settingsmodel->popupModifyProc();
	}
	//holiday
	public function holiday() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->holiday();
		$this->load->view('settings/holiday',$arrData);
		$this->load->view('include/incBottom');
	}
	//holidayModifyProc
	public function holidayModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-6","N");
		$this->settingsmodel->holidayModifyProc();
	}
	//bankAccount
	public function bankAccount() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->bankAccount();
		$this->load->view('settings/bankAccount',$arrData);
		$this->load->view('include/incBottom');
	}
	//bankAccountCreateProc
	public function bankAccountCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-7","N");
		$this->settingsmodel->bankAccountCreateProc();
	}
	//bankAccountModify
	public function bankAccountModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-7","N");
		$this->settingsmodel->bankAccountModify();
	}
	//bankAccountModifyProc
	public function bankAccountModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-7","N");
		$this->settingsmodel->bankAccountModifyProc();
	}
	//bankAccountDelProc
	public function bankAccountDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"10-7","N");
		$arrData=$this->settingsmodel->bankAccountDelProc();
		echo $arrData;
	}
	//inquiryList
	public function inquiryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->inquiryList();
		$this->load->view('settings/inquiryList',$arrData);
		$this->load->view('include/incBottom');
	}
	//inquiryDelProc
	public function inquiryDelProc() {
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-1","N");
		$this->authmodel->checkLogin01();
		$this->settingsmodel->inquiryDelProc();
	}
	//inquiryReply
	public function inquiryReply() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->inquiryReply();
		$this->load->view('settings/inquiryReply',$arrData);
		$this->load->view('include/incBottom');
	}
	//inquiryReplyProc
	public function inquiryReplyProc() {
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-1","N");
		$this->authmodel->checkLogin01();
		$this->settingsmodel->inquiryReplyProc();
	}
	//noticeList
	public function noticeList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->noticeList();
		$this->load->view('settings/noticeList',$arrData);
		$this->load->view('include/incBottom');
	}
	//noticeCreate
	public function noticeCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->noticeCreate();
		$this->load->view('settings/noticeCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//noticeCreateProc
	public function noticeCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->settingsmodel->noticeCreateProc();
	}
	//noticeDelProc
	public function noticeDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->settingsmodel->noticeDelProc();
	}
	//noticeModify
	public function noticeModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->noticeModify();
		$this->load->view('settings/noticeModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//noticeModifyProc
	public function noticeModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->settingsmodel->noticeModifyProc();
	}
	//noticeFileDelProc
	public function noticeFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-2","N");
		$this->settingsmodel->noticeFileDelProc();
	}
	//insightList
	public function insightList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->insightList();
		$this->load->view('settings/insightList',$arrData);
		$this->load->view('include/incBottom');
	}
	//insightCreate
	public function insightCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->insightCreate();
		$this->load->view('settings/insightCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//insightCreateProc
	public function insightCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->settingsmodel->insightCreateProc();
	}
	//insightDelProc
	public function insightDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$arrData=$this->settingsmodel->insightDelProc();
		echo $arrData;
	}
	//insightModify
	public function insightModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->insightModify();
		$this->load->view('settings/insightModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//insightModifyProc
	public function insightModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->settingsmodel->insightModifyProc();
	}
	//insightFileDelProc
	public function insightFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-3","N");
		$this->settingsmodel->insightFileDelProc();
	}
	//insightCategoryList
	public function insightCategoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->insightCategoryList();
		$this->load->view('settings/insightCategoryList',$arrData);
		$this->load->view('include/incBottom');
	}
	//insightCategorySortValid
	public function insightCategorySortValid() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$this->settingsmodel->insightCategorySortValid();
	}
	//insightCategoryCreateProc
	public function insightCategoryCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$this->settingsmodel->insightCategoryCreateProc();
	}
	//insightCategoryModify
	public function insightCategoryModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$this->settingsmodel->insightCategoryModify();
	}
	//insightCategoryModifyProc
	public function insightCategoryModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$this->settingsmodel->insightCategoryModifyProc();
	}
	//insightCategoryDelProc
	public function insightCategoryDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-4","N");
		$arrData=$this->settingsmodel->insightCategoryDelProc();
		echo $arrData;
	}
	//pressList
	public function pressList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->pressList();
		$this->load->view('settings/pressList',$arrData);
		$this->load->view('include/incBottom');
	}
	//pressCreate
	public function pressCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->pressCreate();
		$this->load->view('settings/pressCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//pressCreateProc
	public function pressCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$this->settingsmodel->pressCreateProc();
	}
	//pressModify
	public function pressModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->pressModify();
		$this->load->view('settings/pressModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//pressModifyProc
	public function pressModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$this->settingsmodel->pressModifyProc();
	}
	//pressDelProc
	public function pressDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-5","N");
		$arrData=$this->settingsmodel->pressDelProc();
		echo $arrData;
	}
	//faqList
	public function faqList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->faqList();
		$this->load->view('settings/faqList',$arrData);
		$this->load->view('include/incBottom');
	}
	//faqCreate
	public function faqCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->faqCreate();
		$this->load->view('settings/faqCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//faqSortValid
	public function faqSortValid() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->settingsmodel->faqSortValid();
	}
	//faqCreateProc
	public function faqCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->settingsmodel->faqCreateProc();
	}
	//faqDelProc
	public function faqDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$arrData=$this->settingsmodel->faqDelProc();
		echo $arrData;
	}
	//faqModify
	public function faqModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->faqModify();
		$this->load->view('settings/faqModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//faqModifyProc
	public function faqModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->settingsmodel->faqModifyProc();
	}
	//faqFileDelProc
	public function faqFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-6","N");
		$this->settingsmodel->faqFileDelProc();
	}
	//event01List
	public function event01List() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->event01List();
		$this->load->view('settings/event01List',$arrData);
		$this->load->view('include/incBottom');
	}
	//event01DelProc
	public function event01DelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-7","N");
		$arrData=$this->settingsmodel->event01DelProc();
	}
	//event01Modify
	public function event01Modify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->event01Modify();
		$this->load->view('settings/event01Modify',$arrData);
		$this->load->view('include/incBottom');
	}
	//event01FileDelProc
	public function event01FileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-7","N");
		$this->settingsmodel->event01FileDelProc();
	}
	//event01ModifyProc
	public function event01ModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-7","N");
		$this->settingsmodel->event01ModifyProc();
	}
	//smsSearchList
	public function smsSearchList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->smsSearchList();
		$this->load->view('settings/smsSearchList',$arrData);
		$this->load->view('include/incBottom');
	}
	//smsSearchListExcel
	public function smsSearchListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-1","N");
		$this->settingsmodel->smsSearchListExcel();
	}

	//smsHistoryList
	public function smsHistoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->smsHistoryList();
		$this->load->view('settings/smsHistoryList',$arrData);
		$this->load->view('include/incBottom');
	}
	//mailSearchList
	public function mailSearchList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mailSearchList();
		$this->load->view('settings/mailSearchList',$arrData);
		$this->load->view('include/incBottom');
	}
	//mailSearchListExcel
	public function mailSearchListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-3","N");
		$this->settingsmodel->mailSearchListExcel();
	}
	//mailHistoryList
	public function mailHistoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"12-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mailHistoryList();
		$this->load->view('settings/mailHistoryList',$arrData);
		$this->load->view('include/incBottom');
	}
	//alarmScheduleList01
	public function alarmScheduleList01() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"13-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->alarmScheduleList01();
		$this->load->view('settings/alarmScheduleList01',$arrData);
		$this->load->view('include/incBottom');
	}
	//alarmScheduleList02
	public function alarmScheduleList02() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"13-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->alarmScheduleList02();
		$this->load->view('settings/alarmScheduleList02',$arrData);
		$this->load->view('include/incBottom');
	}
	//alarmScheduleList03
	public function alarmScheduleList03() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"13-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->alarmScheduleList03();
		$this->load->view('settings/alarmScheduleList03',$arrData);
		$this->load->view('include/incBottom');
	}
	//alarmScheduleList04
	public function alarmScheduleList04() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"13-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->alarmScheduleList04();
		$this->load->view('settings/alarmScheduleList04',$arrData);
		$this->load->view('include/incBottom');
	}
	//메인관리 권한 수정필요
	//mainBannerList
	public function mainBannerList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerList();
		$this->load->view('settings/mainBannerList',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerCreate
	public function mainBannerCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerCreate();
		$this->load->view('settings/mainBannerCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerCreateProc
	public function mainBannerCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$this->settingsmodel->mainBannerCreateProc();
	}
	//mainBannerDelProc
	public function mainBannerDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$arrData=$this->settingsmodel->mainBannerDelProc();
		echo $arrData;
	}
	//mainBannerModify
	public function mainBannerModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerModify();
		$this->load->view('settings/mainBannerModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerModifyProc
	public function mainBannerModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-1","N");
		$this->settingsmodel->mainBannerModifyProc();
	}
	//mainBannerMobileList
	public function mainBannerMobileList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerMobileList();
		$this->load->view('settings/mainBannerMobileList',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerMobileCreate
	public function mainBannerMobileCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerMobileCreate();
		$this->load->view('settings/mainBannerMobileCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerMobileCreateProc
	public function mainBannerMobileCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$this->settingsmodel->mainBannerMobileCreateProc();
	}
	//mainBannerMobileDelProc
	public function mainBannerMobileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$arrData=$this->settingsmodel->mainBannerMobileDelProc();
		echo $arrData;
	}
	//mainBannerMobileModify
	public function mainBannerMobileModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainBannerMobileModify();
		$this->load->view('settings/mainBannerMobileModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainBannerMobileModifyProc
	public function mainBannerMobileModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-2","N");
		$this->settingsmodel->mainBannerMobileModifyProc();
	}
	//mainPressList
	public function mainPressList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainPressList();
		$this->load->view('settings/mainPressList',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainPressCreate
	public function mainPressCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainPressCreate();
		$this->load->view('settings/mainPressCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainPressCreateProc
	public function mainPressCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$this->settingsmodel->mainPressCreateProc();
	}
	//mainPressDelProc
	public function mainPressDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$arrData=$this->settingsmodel->mainPressDelProc();
		echo $arrData;
	}
	//mainPressModify
	public function mainPressModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainPressModify();
		$this->load->view('settings/mainPressModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainPressModifyProc
	public function mainPressModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-3","N");
		$this->settingsmodel->mainPressModifyProc();
	}
	//mainMedia
	public function mainMedia() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainMedia();
		$this->load->view('settings/mainMedia',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainMediaModifyProc
	public function mainMediaModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-4","N");
		$this->settingsmodel->mainMediaModifyProc();
	}

	//mainUseInfo1
	public function mainUseInfo1() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainUseInfo1();
		$this->load->view('settings/mainUseInfo1',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainUseInfo2
	public function mainUseInfo2() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainUseInfo2();
		$this->load->view('settings/mainUseInfo2',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainUseInfo3
	public function mainUseInfo3() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->mainUseInfo3();
		$this->load->view('settings/mainUseInfo3',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainUseInfoModifyProc
	public function mainUseInfoModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-5","N");
		$this->settingsmodel->mainUseInfoModifyProc();
	}
        //mainSectionImage
        public function mainSectionImage() {
                $sSideBar = $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-8","N");
                $this->load->view('include/incTop',$sSideBar);
                $arrData = $this->settingsmodel->mainSectionImage();
                $this->load->view('settings/mainSectionImage',$arrData);
                $this->load->view('include/incBottom');
        }
        //mainSectionImageMobile
        public function mainSectionImageMobile() {
                $sSideBar = $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-9","N");
                $this->load->view('include/incTop',$sSideBar);
                $arrData = $this->settingsmodel->mainSectionImageMobile();
                $this->load->view('settings/mainSectionImageMobile',$arrData);
                $this->load->view('include/incBottom');
        }
        //mainSectionImageModify
        public function mainSectionImageModify() {
                $sSideBar = $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-8","N");
                $this->load->view('include/incTop',$sSideBar);
                $arrData = $this->settingsmodel->mainSectionImageModify();
                $this->load->view('settings/mainSectionImageModify',$arrData);
                $this->load->view('include/incBottom');
        }
        //mainSectionImageModifyProc
        public function mainSectionImageModifyProc() {
                $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"14-8","N");
                $this->settingsmodel->mainSectionImageModifyProc();
        }
	//guideList
	public function guideList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->guideList();
		$this->load->view('settings/guideList',$arrData);
		$this->load->view('include/incBottom');
	}
	//guideCreate
	public function guideCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->guideCreate();
		$this->load->view('settings/guideCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//guideCreateProc
	public function guideCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->settingsmodel->guideCreateProc();
	}
	//guideDelProc
	public function guideDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$arrData=$this->settingsmodel->guideDelProc();
		echo $arrData;
	}
	//guideModify
	public function guideModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->guideModify();
		$this->load->view('settings/guideModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//guideModifyProc
	public function guideModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->settingsmodel->guideModifyProc();
	}
	//guideFileDelProc
	public function guideFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-8","N");
		$this->settingsmodel->guideFileDelProc();
	}
	//aramList
	public function aramList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->aramList();
		$this->load->view('settings/aramList',$arrData);
		$this->load->view('include/incBottom');
	}
	//aramCreate
	public function aramCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->aramCreate();
		$this->load->view('settings/aramCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//aramCreateProc
	public function aramCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->settingsmodel->aramCreateProc();
	}
	//aramDelProc
	public function aramDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$arrData=$this->settingsmodel->aramDelProc();
		echo $arrData;
	}
	//aramModify
	public function aramModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->settingsmodel->aramModify();
		$this->load->view('settings/aramModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//aramModifyProc
	public function aramModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->settingsmodel->aramModifyProc();
	}
	//aramFileDelProc
	public function aramFileDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"11-9","N");
		$this->settingsmodel->aramFileDelProc();
	}
}
?>
