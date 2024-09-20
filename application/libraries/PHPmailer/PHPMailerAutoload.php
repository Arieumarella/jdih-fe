<?php

/**
 * PHPMailer SPL autoloader.
 * PHP Version 7.4+
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 */

/**
 * PHPMailer SPL autoloader.
 * @param string $classname The name of the class to load
 */
function PHPMailerAutoload($classname)
{
    $filename = __DIR__ . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

// Register autoloader
spl_autoload_register('PHPMailerAutoload');
