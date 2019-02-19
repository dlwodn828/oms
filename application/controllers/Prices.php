<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prices extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('pricesmodel');
	}
	public function index() {
		redirect('/prices/priceList','refresh');
	}

	public function priceList() {	
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		if($this->input->post('idx')){
			$arrData=$this->pricesmodel->modifySavePrice();
		}else if($this->input->post('saveprice')){
			$arrData=$this->pricesmodel->addSavePrice();
			// $this->pricesmodel->priceList();
		}else{
			$arrData=$this->pricesmodel->priceList();
		}
		$this->load->view('prices/priceList',$arrData);
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

	public function addPrice(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->pricesmodel->priceList();
		$this->load->view('prices/addPrice',$arrData);
		$this->load->view('include/incBottom');
	}

	public function deletePrice(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->pricesmodel->deletePrice();
		$this->load->view('prices/priceList',$arrData);
		$this->load->view('include/incBottom');
	}
}
