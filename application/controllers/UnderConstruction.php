<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class UnderConstruction extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
    }

    function index() {
        $this->load->view("under_construction");
    }
}