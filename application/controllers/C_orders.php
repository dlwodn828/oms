<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_orders extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('c_ordersmodel');
	}
	public function index() {
		redirect('/c_orders/c_ordering','refresh');
	}

	public function c_ordering() {	
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		if($this->input->get('pidx')){
			$arrData=$this->ordersmodel->saveOrder();
			// $arrData=$this->ordersmodel->modifySavePrice();
		}else if($this->input->get('idx')){
			
			// $this->pricesmodel->priceList();
		}else{
			$arrData=$this->c_ordersmodel->c_ordering();
		}
		$this->load->view('c_orders/c_ordering',$arrData);//
		$this->load->view('include/incBottom');
	}

	public function c_orderList(){
		$sSideBar=$this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->c_ordersmodel->c_orderList();
		$this->load->view('c_orders/c_orderList',$arrData);
		$this->load->view('include/incBottom');
	}


	// public function modifyPrice(){
	// 	$sSideBar = $this->authmodel->checkLogin01();
	// 	$this->load->view('include/incTop',$sSideBar);
	// 	$arrData=$this->pricesmodel->modifyPrice();
	// 	$this->load->view('prices/modifyPrice',$arrData);
	// 	$this->load->view('include/incBottom');
	// }

	// public function modifySavePrice(){
	// 	$sSideBar = $this->authmodel->checkLogin01();
	// 	$this->load->view('include/incTop',$sSideBar);
	// 	$arrData=$this->pricesmodel->modifySavePrice();
	// 	$this->load->view('prices/priceList',$arrData);
	// 	$this->load->view('include/incBottom');
	// }

	public function sendEmail(){
		$this->authmodel->checkLogin01();
		$arrData=$this->c_ordersmodel->sendEmail();
		echo $arrData;
	}

	// public function addPrice(){
	// 	$sSideBar = $this->authmodel->checkLogin01();
	// 	$this->load->view('include/incTop',$sSideBar);
	// 	$arrData=$this->pricesmodel->priceList();
	// 	$this->load->view('prices/addPrice',$arrData);
	// 	$this->load->view('include/incBottom');
	// }

	// public function deletePrice(){
	// 	$sSideBar = $this->authmodel->checkLogin01();
	// 	$this->load->view('include/incTop',$sSideBar);
	// 	$arrData=$this->pricesmodel->deletePrice();
	// 	$this->load->view('prices/priceList',$arrData);
	// 	$this->load->view('include/incBottom');
	// }
}
