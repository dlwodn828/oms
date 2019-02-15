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

	// url이 바뀌는 페이지만 새로운 함수가 필요함!!

	public function consultHistoryList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		if($this->input->post('idx2')){//delete
			$arrData=$this->customersmodel->deleteCompany();
		}
		else if($this->input->post('save1')){
			$arrData=$this->customersmodel->modifySaveCompany();
		}
		else if($this->input->post('save2')){
			$arrData=$this->customersmodel->addSaveCompany();
		}
		else{
			$arrData=$this->customersmodel->consultHistoryList();
		}
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

	public function addCompany(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$this->load->view('customers/addCompany');
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
