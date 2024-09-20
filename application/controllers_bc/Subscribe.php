<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Subscribe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
        $this->load->model('Mdl_fungsi');
    }

    function stop()
    {
        $email = $this->input->get('email', TRUE);
        $token = $this->input->get('token', TRUE);
        $data['res'] = $this->Mdl_fungsi->StopSubs($email, base64_decode($token));
        $this->load->view("stop_subscribe", $data);
    }
}
