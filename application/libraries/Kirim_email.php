<?php
class Kirim_email
{
    function __construct()
    {
        require_once APPPATH.'/libraries/class.smtp.php';
		require_once APPPATH.'/libraries/class.phpmailer.php';
    }
}
?>