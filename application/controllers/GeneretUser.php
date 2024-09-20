<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class GeneretUser extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form', 'html'));
		$this->load->library('session');
		$this->load->model('M_usergeneret');
	}

	public function index()
	{
		$dataDept = $this->M_usergeneret->getDataDept();

		foreach ($dataDept as $key => $val) {
			
			$dataInsert = array(
				'group_id' => '3',
				'dept_id' => $val->dept_id,
				'username' => str_replace(" ", "_", $val->deptcode),
				'password' => md5(str_replace(" ", "_", $val->deptcode)),
				'status' => '1',
				'fullname' => $val->deptname,
				'created_by' => '1',
				'tgl_buat' => date('Y-m-d H:i:s'),
				'aktivasi_status' => 'Y'
			);

			$this->M_usergeneret->save('ppj_users', $dataInsert);
		}

		echo 'Selesai';

	}

}