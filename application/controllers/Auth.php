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
		$retValue = $this->authmodel->loginProc(); // 로그인 여부만 메세지로 알려주는 느낌
		echo $retValue;
	}
	//logoutProc
	public function logoutProc() {
		$this->authmodel->logOutProc();
	}
}
?>
