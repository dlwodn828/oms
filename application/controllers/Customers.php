<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('customersmodel');
	}
	public function index() {
		redirect('/customers/consultHistoryList','refresh');
	}

	public function consultHistoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		//$this->authmodel->fnAdminAuthCheck($this->session->userdata("AdminIdx"),$this->session->userdata("AdminRole"),"4-2","N");
		// $this->authmodel->checkSession();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->customersmodel->consultHistoryList();
		$this->load->view('customers/consultHistoryList',$arrData);
		$this->load->view('include/incBottom');
	}

	public function modifyCompany(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->customersmodel->modifyCompany();
		$this->load->view('customers/modifyCompany',$arrData);
		$this->load->view('include/incBottom');
	}

	public function modifySaveCompany(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->customersmodel->modifySaveCompany();
		$this->load->view('customers/consultHistoryList',$arrData);
		$this->load->view('include/incBottom');
	}

	public function deleteCompany(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->customersmodel->deleteCompany();
		$this->load->view('customers/consultHistoryList',$arrData);
		$this->load->view('include/incBottom');
	}

	//alltRfidList
	public function alltRfidList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData = $this->customersmodel->alltRfidList();
		$this->load->view('customers/alltRfidList',$arrData);
		$this->load->view('include/incBottom');
	}

	//mailWithdrawal
	public function mailWithdrawal() {
		$this->load->view('customers/mailWithdrawal');
	}
	public function printOrder() {
		$arrData = $this->customersmodel->printOrder();
		echo $arrData;
	}
}
