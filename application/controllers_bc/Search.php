<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
 
class Users extends \Restserver\Libraries\REST_Controller
{
    public function __construct() {
        parent::__construct();
        // Load User Model
        $this->load->model('Mdl_fungsi');
        $this->load->model('Mdl_home');
    }

	public function pencarian_cepat_post(){
		 header("Access-Control-Allow-Origin: *");
		  $_POST = $this->security->xss_clean($_POST);
		  $tcari=$this->security->xss_clean($_REQUEST[$tcari]);
		  $this->load->library('Authorization_Token');
		  $user_token = $this->authorization_token->generateToken($tcari);
				$return_data = [
                    'cari'=>'ok',
                    'token' => $user_token,
                ];

                // Login Success
                $message = [
                    'status' => true,
                    'data' => $return_data,
                    'message' => "User login successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
	}
}