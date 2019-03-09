<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller{
    public function __construct() {
		parent::__construct();
		$this->load->database();
        $this->load->model('customersmodel');
	}

    // send email when stockquantity is lower than stock target
    public function below_target_email() {
        if(!$this->input->is_cli_request()) {
            echo "This script can only be accessed via the command line" . PHP_EOL;
            return;
        } else {
            echo "accessed via cli";
        }
        $this->sQuery="SELECT count(Idx) as iCnt01 FROM tbl_stock";
        $this->iCnt01=$this->db->query($this->sQuery)->row()->iCnt01;
        if ($this->iCnt01!=0) {
            //$this->sQuery="SELECT * from tbl_stock where stockquantity <= stockalarmtarget";
            $this->sQuery="SELECT c.companyname 업체명, w.warehousename 창고명, s.scaleid 저울ID, s.productname 품명, s.material 재질, s.plated 도금, s.size1 굵기, s.size2 길이,  s.size3 피치, s.stockquantity 현재재고수량 from tbl_company as c join tbl_warehouse as w on c.idx=w.cid join tbl_stock as s on w.idx=s.wid where s.stockquantity <= s.stockalarmtarget group by c.companyname, w.warehousename, s.scaleid, s.productname, s.material, s.plated, s.size1, s.size2,  s.size3, s.stockquantity;";
            $arrData['arrResult'] = $this->db->query($this->sQuery)->result_array();
            if (empty($arrData['arrResult'])) {
                echo "all company have suffient stock! no email sent";
            } else {
                $data['arrItem'] = $arrData['arrResult'];
                //sendmail 진행
                //Load email library
                $this->load->library('email');
                //SMTP & mail configuration
                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'dlwodn828@gmail.com',
                    'smtp_pass' => 'dl94585854',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                //Email content
                $htmlContent = $this->load->view('Cronjob/below_target_email_table', $data, TRUE);
                echo $htmlContent;
                $this->email->to('dlwodn828@gmail.com');
                $this->email->from('allt@allt.kr','ALLT');
                $this->email->subject('재고 부족 알람 메시지입니다.');
                $this->email->message($htmlContent);
                //Send email
                if (!$this->email->send(TRUE)) {
                    echo "error when sending email";
                }
            }
        } else {
            echo "no row in tbl_stock fund in database";
        }
    }
}
