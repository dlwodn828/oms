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

	public function sendEmail(){
		$this->authmodel->checkLogin01();
		$arrData=$this->c_ordersmodel->sendEmail();
		echo $arrData;
	}

}
