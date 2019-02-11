<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statistics extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('statisticsmodel');
	}
	public function index() {
//		redirect(sSiteUrl.'/settings/mainPage','refresh');
	}
	//dayMemberStatistics
	public function dayMemberStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->dayMemberStatistics();
		$this->load->view('statistics/dayMemberStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//dayMemberStatisticsExcel
	public function dayMemberStatisticsExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->statisticsmodel->dayMemberStatisticsExcel();
	}
	//monthMemberStatistics
	public function monthMemberStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->monthMemberStatistics();
		$this->load->view('statistics/monthMemberStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//monthMemberStatisticsExcel
	public function monthMemberStatisticsExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->statisticsmodel->monthMemberStatisticsExcel();
	}
	//dayStageStatistics
	public function dayStageStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->dayStageStatistics();
		$this->load->view('statistics/dayStageStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//dayStageStatisticsExcel01
	public function dayStageStatisticsExcel01() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->statisticsmodel->dayStageStatisticsExcel01();
	}
	//dayStageStatisticsExcel02
	public function dayStageStatisticsExcel02() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->statisticsmodel->dayStageStatisticsExcel02();
	}
	//monthStageStatistics
	public function monthStageStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->monthStageStatistics();
		$this->load->view('statistics/monthStageStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//monthStageStatisticsExcel01
	public function monthStageStatisticsExcel01() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->statisticsmodel->monthStageStatisticsExcel01();
	}
	//monthStageStatisticsExcel02
	public function monthStageStatisticsExcel02() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->statisticsmodel->monthStageStatisticsExcel02();
	}
	//dayDonateStatistics
	public function dayDonateStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->dayDonateStatistics();
		$this->load->view('statistics/dayDonateStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//dayDonateStatisticsExcel
	public function dayDonateStatisticsExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-1","N");
		$this->statisticsmodel->dayDonateStatisticsExcel();
	}
	//monthDonateStatistics
	public function monthDonateStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->monthDonateStatistics();
		$this->load->view('statistics/monthDonateStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//monthDonateStatisticsExcel
	public function monthDonateStatisticsExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-2","N");
		$this->statisticsmodel->monthDonateStatisticsExcel();
	}
	//itemsStatistics5
	public function itemsStatistics5() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->itemsStatistics5();
		$this->load->view('statistics/itemsStatistics5',$arrData);
		$this->load->view('include/incBottom');
	}
	//itemsStatistics5Excel
	public function itemsStatistics5Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->statisticsmodel->itemsStatistics5Excel();
	}
	//itemsStatistics7
	public function itemsStatistics7() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->itemsStatistics7();
		$this->load->view('statistics/itemsStatistics7',$arrData);
		$this->load->view('include/incBottom');
	}
	//itemsStatistics7Excel
	public function itemsStatistics7Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->statisticsmodel->itemsStatistics7Excel();
	}
	//itemsStatistics9
	public function itemsStatistics9() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->itemsStatistics9();
		$this->load->view('statistics/itemsStatistics9',$arrData);
		$this->load->view('include/incBottom');
	}
	//itemsStatistics9Excel
	public function itemsStatistics9Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->statisticsmodel->itemsStatistics9Excel();
	}
	//itemsStatistics13
	public function itemsStatistics13() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->itemsStatistics13();
		$this->load->view('statistics/itemsStatistics13',$arrData);
		$this->load->view('include/incBottom');
	}
	//itemsStatistics13Excel
	public function itemsStatistics13Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-3","N");
		$this->statisticsmodel->itemsStatistics13Excel();
	}
	//statusStatistics
	public function statusStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-4","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->statusStatistics();
		$this->load->view('statistics/statusStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//statusStatisticsExcel
	public function statusStatisticsExcel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-4","N");
		$this->statisticsmodel->statusStatisticsExcel();
	}
	//waitingTurnStatistics
	public function waitingTurnStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-5","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->waitingTurnStatistics();
		$this->load->view('statistics/waitingTurnStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitingTurnStatisticsExcel01
	public function waitingTurnStatisticsExcel01() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-5","N");
		$this->statisticsmodel->waitingTurnStatisticsExcel01();
	}
	//waitingTurnStatisticsExcel02
	public function waitingTurnStatisticsExcel02() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-5","N");
		$this->statisticsmodel->waitingTurnStatisticsExcel02();
	}
	//waitingTurnStatisticsExcel03
	public function waitingTurnStatisticsExcel03() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-5","N");
		$this->statisticsmodel->waitingTurnStatisticsExcel03();
	}
	//waitingTurnStatisticsExcel04
	public function waitingTurnStatisticsExcel04() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-5","N");
		$this->statisticsmodel->waitingTurnStatisticsExcel04();
	}
	//distributionStatistics
	public function distributionStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-6","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->distributionStatistics();
		$this->load->view('statistics/distributionStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//icssMemberStatistics
	public function icssMemberStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-7","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->icssMemberStatistics();
		$this->load->view('statistics/icssMemberStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//icssStageStatistics
	public function icssStageStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-8","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->icssStageStatistics();
		$this->load->view('statistics/icssStageStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//categoryMemberStatistics
	public function categoryMemberStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-9","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->categoryMemberStatistics();
		$this->load->view('statistics/categoryMemberStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueMemberStatistics
	public function overdueMemberStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-10","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->overdueMemberStatistics();
		$this->load->view('statistics/overdueMemberStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//manageMoneyStatistics
	public function manageMoneyStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-11","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->manageMoneyStatistics();
		$this->load->view('statistics/manageMoneyStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueTermStatistics5
	function overdueTermStatistics5() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->overdueTermStatistics5();
		$this->load->view('statistics/overdueTermStatistics5',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueTermStatistics5Excel
	public function overdueTermStatistics5Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->statisticsmodel->overdueTermStatistics5Excel();
	}
	//overdueTermStatistics7
	function overdueTermStatistics7() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->overdueTermStatistics7();
		$this->load->view('statistics/overdueTermStatistics7',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueTermStatistics7Excel
	public function overdueTermStatistics7Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->statisticsmodel->overdueTermStatistics7Excel();
	}
	//overdueTermStatistics9
	function overdueTermStatistics9() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->overdueTermStatistics9();
		$this->load->view('statistics/overdueTermStatistics9',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueTermStatistics9Excel
	public function overdueTermStatistics9Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->statisticsmodel->overdueTermStatistics9Excel();
	}
	//overdueTermStatistics13
	function overdueTermStatistics13() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->overdueTermStatistics13();
		$this->load->view('statistics/overdueTermStatistics13',$arrData);
		$this->load->view('include/incBottom');
	}
	//overdueTermStatistics13Excel
	public function overdueTermStatistics13Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-13","N");
		$this->statisticsmodel->overdueTermStatistics13Excel();
	}

	//waitTermStatistics5
	function waitTermStatistics5() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->waitTermStatistics5();
		$this->load->view('statistics/waitTermStatistics5',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitTermStatistics5Excel
	public function waitTermStatistics5Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->statisticsmodel->waitTermStatistics5Excel();
	}
	//waitTermStatistics7
	function waitTermStatistics7() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->waitTermStatistics7();
		$this->load->view('statistics/waitTermStatistics7',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitTermStatistics7Excel
	public function waitTermStatistics7Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->statisticsmodel->waitTermStatistics7Excel();
	}
	//waitTermStatistics9
	function waitTermStatistics9() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->waitTermStatistics9();
		$this->load->view('statistics/waitTermStatistics9',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitTermStatistics9Excel
	public function waitTermStatistics9Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->statisticsmodel->waitTermStatistics9Excel();
	}
	//waitTermStatistics13
	function waitTermStatistics13() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->waitTermStatistics13();
		$this->load->view('statistics/waitTermStatistics13',$arrData);
		$this->load->view('include/incBottom');
	}
	//waitTermStatistics13Excel
	public function waitTermStatistics13Excel() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-12","N");
		$this->statisticsmodel->waitTermStatistics13Excel();
	}
	//mainStatistics
	function mainStatistics() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-14","N");
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->statisticsmodel->mainStatistics();
		$this->load->view('statistics/mainStatistics',$arrData);
		$this->load->view('include/incBottom');
	}
	//mainStatisticsModifyProc
	public function mainStatisticsModifyProc() {
		$this->authmodel->checkLogin01();
		$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"15-14","N");
		$this->statisticsmodel->mainStatisticsModifyProc();
	}
}
?>

