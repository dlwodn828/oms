<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('authmodel');
		$this->load->model('utilmodel');
	}
	public function index() {
	}
	//download
	public function download() {
		$this->utilmodel->download();
	}
}
?>