<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('ordersmodel');
	}
	public function index() {
		redirect('/orders/orderList','refresh');
	}

	public function orderList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->ordersmodel->orderList();
		$this->load->view('orders/orderList', $arrData);
		$this->load->view('include/incBottom');
	}

	public function modifyOrder(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->ordersmodel->modifyOrder();
		$this->load->view('orders/modifyOrder',$arrData);
		$this->load->view('include/incBottom');
	}

	public function modifySaveOrder(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->ordersmodel->modifySaveOrder();
		$this->load->view('orders/orderList',$arrData);
		$this->load->view('include/incBottom');
	}

	public function deleteOrder(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->ordersmodel->deleteOrder();
		$this->load->view('orders/orderList',$arrData);
		$this->load->view('include/incBottom');
	}
}
