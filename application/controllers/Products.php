<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('productsmodel');
	}
	public function index() {
		redirect('/products/productList','refresh');
	}

	public function productList() {
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		if($this->idx=$this->input->post('delete')){
			$arrData=$this->productsmodel->deleteProduct();
		}
		else if($this->idx=$this->input->post('save')){
			$arrData=$this->productsmodel->modifySaveProduct();
		}
		else{
			$arrData=$this->productsmodel->productList();
		}
		$this->load->view('products/productList',$arrData);
		$this->load->view('include/incBottom');
	}

	public function modifyProduct(){
		$sSideBar = $this->authmodel->checkLogin01();
		$this->load->view('include/incTop',$sSideBar);
		$arrData=$this->productsmodel->modifyProduct();
		$this->load->view('products/modifyProduct',$arrData);
		$this->load->view('include/incBottom');
	}

}
