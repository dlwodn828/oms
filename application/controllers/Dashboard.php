<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel'); // ''로 바로 model에 접근할 수 있게 함
		$this->load->model('dashboardmodel');
	}
	//index
	public function index() { // 기본페이지
		//$sSideBar = $this->authmodel->checkLogin01();
		//$this->load->view('include/incTop',$sSideBar);
		//$arrData = $this->dashboardmodel->dashboard();
		//$this->load->view('dashboard/dashboard',$arrData);
		//$this->load->view('include/incBottom');
	}
	public function dash(){
		$sSideBar = $this->authmodel->checkLogin01();
		//$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"4-2","N");
		$this->load->view('include/incTop',$sSideBar);
		//$this->load->view('dashboard/dash');
		//$this->load->view('include/incBottom');
		$this->load->view('dashboard/dash');
		$this->load->view('include/incBottom');
	}
}
?>