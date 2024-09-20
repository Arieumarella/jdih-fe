<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class NoFile extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
		$this->load->model('Mdl_fungsi');
    }

    function index($kode) {
		
        if($kode=="abstrak"){
			$data['tipe']="abstrak";
			$this->load->view("nofile", $data);
		}
        
    }
    
}

?>