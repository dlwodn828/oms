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
		redirect('/systems/memberList','refresh');
	}
	//memberList
	public function memberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		//$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),9,"1-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->memberList();
		$this->load->view('systems/memberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//memberView
	public function memberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->memberView();
		$this->load->view('systems/memberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//memberSuccessionChange
	public function memberSuccessionChange() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$arrData=$this->systemsmodel->memberSuccessionChange();
		echo $arrData;
	}
	//memberModifyProc
	public function memberModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$arrData=$this->systemsmodel->memberModifyProc();
		echo $arrData;
	}
	//memberListExcel
	public function memberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->systemsmodel->memberListExcel();
	}
	//successionMemberList
	public function successionMemberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->successionMemberList();
		$this->load->view('systems/successionMemberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//successionMemberView
	public function successionMemberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->successionMemberView();
		$this->load->view('systems/successionMemberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//successionMemberModifyProc
	public function successionMemberModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-2","N");
		$arrData=$this->systemsmodel->successionMemberModifyProc();
		echo $arrData;
	}
	//successionMemberListExcel
	public function successionMemberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-2","N");
		$this->systemsmodel->successionMemberListExcel();
	}
	//successionMemberChange
	public function successionMemberChange() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-2","N");
		$arrData=$this->systemsmodel->successionMemberChange();
		echo $arrData;
	}
	//withdrawMemberList
	public function withdrawMemberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->withdrawMemberList();
		$this->load->view('systems/withdrawMemberList',$arrData);
		$this->load->view('include/incBottom');
	}
	//withdrawMemberView
	public function withdrawMemberView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->withdrawMemberView();
		$this->load->view('systems/withdrawMemberView',$arrData);
		$this->load->view('include/incBottom');
	}
	//withdrawMemberListExcel
	public function withdrawMemberListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-3","N");
		$this->systemsmodel->withdrawMemberListExcel();
	}
	//jumpingCouponList
	public function jumpingCouponList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponList();
		$this->load->view('systems/jumpingCouponList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponUseList
	public function jumpingCouponUseList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponUseList();
		$this->load->view('systems/jumpingCouponUseList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponIssueList
	public function jumpingCouponIssueList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->jumpingCouponIssueList();
		$this->load->view('systems/jumpingCouponIssueList',$arrData);
		$this->load->view('include/incBottom');
	}
	//jumpingCouponIssueModify
	public function jumpingCouponIssueModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->systemsmodel->jumpingCouponIssueModify();
	}
	//jumpingCouponIssueModifyProc
	public function jumpingCouponIssueModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->systemsmodel->jumpingCouponIssueModifyProc();
	}
	//jumpingCouponUseCreateProc
	public function jumpingCouponUseCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-4","N");
		$this->systemsmodel->jumpingCouponUseCreateProc();
	}
	//adMemberList
	public function adMemberList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->adMemberList();
		$this->load->view('systems/adMemberList',$arrData);
		$this->load->view('include/incBottom');
	}
        //adMemberCreate
        public function adMemberCreate() {
                $sSideBar = $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-5","N");
                $this->load->view('include/incTop',$sSideBar);
                $arrData = $this->systemsmodel->adMemberCreate();;
                $this->load->view('systems/adMemberCreate',$arrData);
                $this->load->view('include/incBottom');

        }
        //adMemberCreateProc
        public function adMemberCreateProc() {
                $this->authmodel->checkLogin01();
                $this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"1-5","N");
                $this->systemsmodel->adMemberCreateProc();
        }

	/********************* Stage Manage ***********************/
	//generalStagelist
	public function generalStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageList();
		$this->load->view('systems/generalStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageModify
	public function generalStageModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageModify();
		$this->load->view('systems/generalStageModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageModifyProc
	public function generalStageModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$arrData=$this->systemsmodel->generalStageModifyProc();
		echo $arrData;
	}
	//generalStageInformation
	public function generalStageInformation() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageInformation();
		$this->load->view('systems/generalStageInformation',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageApplicant
	public function generalStageApplicant() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageApplicant();
		$this->load->view('systems/generalStageApplicant',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageDeposit
	public function generalStageDeposit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageDeposit();
		$this->load->view('systems/generalStageDeposit',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStagePayment
	public function generalStagePayment() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStagePayment();
		$this->load->view('systems/generalStagePayment',$arrData);
		$this->load->view('include/incBottom');
	}
	//generalStageRate
	public function generalStageRate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->generalStageRate();
		$this->load->view('systems/generalStageRate',$arrData);
		$this->load->view('include/incBottom');
	}

	//waitingStageList
	public function waitingStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->waitingStageList();
		$this->load->view('systems/waitingStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitingStageDelProc
	public function waitingStageDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-2","N");
		$arrData=$this->systemsmodel->waitingStageDelProc();
		echo $arrData;
	}
	//recommendYNProc
	public function recommendYNProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-2","N");
		$arrData=$this->systemsmodel->recommendYNProc();
		echo $arrData;
	}
	//waitingStageView
	public function waitingStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->waitingStageView();
		$this->load->view('systems/waitingStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//startStageList
	public function startStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->startStageList();
		$this->load->view('systems/startStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//startStageView
	public function startStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->startStageView();
		$this->load->view('systems/startStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//startStageProc
	public function startStageProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-3","N");
		$arrData=$this->systemsmodel->startStageProc();
		echo $arrData;
	}
	//overdueStageList
	public function overdueStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->overdueStageList();
		$this->load->view('systems/overdueStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//StageStateChagneProc
	public function StageStateChagneProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-4","N");
		$arrData=$this->systemsmodel->StageStateChagneProc();
		echo $arrData;
	}
	//incompleteStageList
	public function incompleteStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->incompleteStageList();
		$this->load->view('systems/incompleteStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//incompleteStageView
	public function incompleteStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->incompleteStageView();
		$this->load->view('systems/incompleteStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//incompleteStageDelProc
	public function incompleteStageDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-5","N");
		$arrData=$this->systemsmodel->incompleteStageDelProc();
		echo $arrData;
	}
	//cancelStageList
	public function cancelStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->cancelStageList();
		$this->load->view('systems/cancelStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//cancelStageListExcel
	public function cancelStageListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-6","N");
		$this->systemsmodel->cancelStageListExcel();
	}
	//cancelStageView
	public function cancelStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->cancelStageView();
		$this->load->view('systems/cancelStageView',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageList
	public function donateStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->donateStageList();
		$this->load->view('systems/donateStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageCreate
	public function donateStageCreate() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->donateStageCreate();
		$this->load->view('systems/donateStageCreate',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageCreateProc
	public function donateStageCreateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->systemsmodel->donateStageCreateProc();
	}
	//donateStageDelProc
	public function donateStageDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$arrData=$this->systemsmodel->donateStageDelProc();
		echo $arrData;
	}
	//donateStageModify
	public function donateStageModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->donateStageModify();
		$this->load->view('systems/donateStageModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageModifyProc
	public function donateStageModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->systemsmodel->donateStageModifyProc();
	}
	//donateStageInformation
	public function donateStageInformation() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->donateStageInformation();
		$this->load->view('systems/donateStageInformation',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageApplicant
	public function donateStageApplicant() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->donateStageApplicant();
		$this->load->view('systems/donateStageApplicant',$arrData);
		$this->load->view('include/incBottom');
	}
	//donateStageApplicantAjax
	public function donateStageApplicantAjax() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$arrData=$this->systemsmodel->donateStageApplicantAjax();
		echo $arrData;
	}
	//donateStageApplicantExcel
	public function donateStageApplicantExcel() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$arrData = $this->systemsmodel->donateStageApplicantExcel();
	}
	//donateStageStats
	public function donateStageStats() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->donateStageStats();
		$this->load->view('systems/donateStageStats',$arrData);
		$this->load->view('include/incBottom');
	}
	//stageWithdrawList
	public function stageWithdrawList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-8","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->stageWithdrawList();
		$this->load->view('systems/stageWithdrawList',$arrData);
		$this->load->view('include/incBottom');
	}
	//stageWithdrawModify
	public function stageWithdrawModify() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-8","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->stageWithdrawModify();
		$this->load->view('systems/stageWithdrawModify',$arrData);
		$this->load->view('include/incBottom');
	}
	//stageWithdrawModifyProc
	public function stageWithdrawModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-8","N");
		$this->systemsmodel->stageWithdrawModifyProc();
	}
	//stageWithdrawDelProc
	public function stageWithdrawDelProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-8","N");
		$this->systemsmodel->stageWithdrawDelProc();
	}
	//memberSuccessionAjax
	public function memberSuccessionAjax() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-8","N");
		$arrData=$this->systemsmodel->memberSuccessionAjax();
		echo $arrData;
	}

	/********************* I-CSS/IPT/NICE ***********************/
	//icssTable
	public function icssTable() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-1","N");
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
		$arrData = $this->systemsmodel->icssManage();
		$this->load->view('systems/icssManage',$arrData);
		$this->load->view('include/incBottom');
	}
	//icssUpdateProc
	public function icssUpdateProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->systemsmodel->icssUpdateProc();
	}
	//icssUpdateAllProc
	public function icssUpdateAllProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-2","N");
		$this->systemsmodel->icssUpdateAllProc();
	}
	//individualScoreList
	public function individualScoreList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->individualScoreList();
		$this->load->view('systems/individualScoreList',$arrData);
		$this->load->view('include/incBottom');
	}
	//individualScoreListExcel
	public function individualScoreListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-3","N");
		$this->systemsmodel->individualScoreListExcel();
	}
	//memberICSSInfo
	public function memberICSSInfo() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-3","N");
		$this->systemsmodel->memberICSSInfo();
	}
	//ICSSDSModifyProc
	public function ICSSDSModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-3","N");
		$arrData=$this->systemsmodel->ICSSDSModifyProc();
		echo $arrData;
	}
	//iptApplicantList
	public function iptApplicantList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->iptApplicantList();
		$this->load->view('systems/iptApplicantList',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptApplicantListExcel
	public function iptApplicantListExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-4","N");
		$this->systemsmodel->iptApplicantListExcel();
	}

	//iptApplicantView
	public function iptApplicantView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->systemsmodel->iptApplicantView();
		$this->load->view('systems/iptApplicantView',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptResultItem
	public function iptResultItem() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/iptResultItem',$arrData);
		$this->load->view('include/incBottom');
	}
	//iptResultItemModify
	public function iptResultItemModify() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-5","N");
		$this->systemsmodel->iptResultItemModify();
	}
	//iptResultItemModifyProc
	public function iptResultItemModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-5","N");
		$this->systemsmodel->iptResultItemModifyProc();
		echo $arrData;
	}
	//niceCredit
	public function niceCredit() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"3-6","N");
		//var_dump($sSideBar);
		$this->load->view('include/incTop',$sSideBar);
		$arrData = '';
		$this->load->view('systems/niceCredit',$arrData);
		$this->load->view('include/incBottom');
	}
	//delStageList
	public function delStageList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->delStageList();
		$this->load->view('systems/delStageList',$arrData);
		$this->load->view('include/incBottom');
	}
	//delStageView
	public function delStageView() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"2-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->systemsmodel->delStageView();
		$this->load->view('systems/delStageView',$arrData);
		$this->load->view('include/incBottom');
	}
}
