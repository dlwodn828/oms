<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Systems extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('systemsmodel');
	}
	public function index() {
		redirect(sSiteUrl.'/systems/memberList','refresh');
	}
	//memberList
	public function memberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->memberList();
		$this->load->view('systems/memberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//memberView
	public function memberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->memberView();
		$this->load->view('systems/memberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//memberSuccessionChange
	public function memberSuccessionChange() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$arrData=$this->systemsmodel->memberSuccessionChange();
		echo $arrData;
	}
	//memberModifyProc
	public function memberModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$arrData=$this->systemsmodel->memberModifyProc();
		echo $arrData;
	}
	//successionMemberList
	public function successionMemberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->successionMemberList();
		$this->load->view('systems/successionMemberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//successionMemberView
	public function successionMemberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->successionMemberView();
		$this->load->view('systems/successionMemberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//successionMemberModifyProc
	public function successionMemberModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$arrData=$this->systemsmodel->successionMemberModifyProc();
		echo $arrData;
	}
	//withdrawMemberList
	public function withdrawMemberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->withdrawMemberList();
		$this->load->view('systems/withdrawMemberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//withdrawMemberView
	public function withdrawMemberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->withdrawMemberView();
		$this->load->view('systems/withdrawMemberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//memberListExcel
	public function memberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->memberListExcel();
	}
	//successionMemberListExcel
	public function successionMemberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->successionMemberListExcel();
	}
	//withdrawMemberListExcel
	public function withdrawMemberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->withdrawMemberListExcel();
	}
	//jumpingCouponList
	public function jumpingCouponList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponList();
		$this->load->view('systems/jumpingCouponList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponUseList
	public function jumpingCouponUseList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponUseList();
		$this->load->view('systems/jumpingCouponUseList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponIssueList
	public function jumpingCouponIssueList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponIssueList();
		$this->load->view('systems/jumpingCouponIssueList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponIssueModify
	public function jumpingCouponIssueModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->jumpingCouponIssueModify();
	}
	//jumpingCouponIssueModifyProc
	public function jumpingCouponIssueModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->jumpingCouponIssueModifyProc();
	}
	//jumpingCouponUseCreateProc
	public function jumpingCouponUseCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
		$this->systemsmodel->jumpingCouponUseCreateProc();
	}

	/********************* Stage Manage ***********************/
	//generalStagelist
	public function generalStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageEdit
	public function generalStageEdit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageEdit',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageInformation
	public function generalStageInformation() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageInformation',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageApplicant
	public function generalStageApplicant() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageApplicant',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageDeposit
	public function generalStageDeposit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageDeposit',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStagePayment
	public function generalStagePayment() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStagePayment',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageRate
	public function generalStageRate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/generalStageRate',$arrData);
		$this->load->view('include/incBottom');
	}

	//waitingStageList
	public function waitingStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/waitingStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitingStageView
	public function waitingStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/waitingStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueStageList
	public function overdueStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/overdueStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//incompleteStageList
	public function incompleteStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/incompleteStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//incompleteStageView
	public function incompleteStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/incompleteStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//cancelStageList
	public function cancelStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/cancelStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageList
	public function donateStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageCreate
	public function donateStageCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageEdit
	public function donateStageEdit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageEdit',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageInformation
	public function donateStageInformation() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageInformation',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageApplicant
	public function donateStageApplicant() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageApplicant',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageStats
	public function donateStageStats() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/donateStageStats',$arrData);
		$this->load->view('include/incBottom');
	}
	//stageWithdrawList
	public function stageWithdrawList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/stageWithdrawList',$arrData);
		$this->load->view('include/incBottom');
	}
	//stageWithdrawEdit
	public function stageWithdrawEdit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/stageWithdrawEdit',$arrData);
		$this->load->view('include/incBottom');
	}

	/********************* I-CSS/IPT/NICE ***********************/
	//icssTable
	public function icssTable() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/icssTable',$arrData);
		$this->load->view('include/incBottom');
	}
	//icssManage
	public function icssManage() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/icssManage',$arrData);
		$this->load->view('include/incBottom');
	}
	//individualScore
	public function individualScore() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/individualScore',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptApplicantList
	public function iptApplicantList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/iptApplicantList',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptApplicantView
	public function iptApplicantView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/iptApplicantView',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptResultItem
	public function iptResultItem() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/iptResultItem',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptResultItemEdit
	public function iptResultItemEdit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/iptResultItemEdit',$arrData);
		$this->load->view('include/incBottom');
	}
	//niceCredit
	public function niceCredit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/niceCredit',$arrData);
		$this->load->view('include/incBottom');
	}

}
