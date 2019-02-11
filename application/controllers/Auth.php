<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
	}
	//index(login)
	public function index() {
		$this->authmodel->checkLogin02();
		$arrData = $this->authmodel->index();
		$this->load->view('auth/login',$arrData);
	}
	//loginProc
	public function loginProc() {
		$retValue = $this->authmodel->loginProc();
		echo $retValue;
	}
	//logoutProc
	public function logoutProc() {
		$this->authmodel->logOutProc();
	}
}
?>
