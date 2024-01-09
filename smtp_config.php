<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$smtpConfig = [
    'host' => 'sandbox.smtp.mailtrap.io',
    'port' => 2525,
    'username' => '0fa37e0cd97cb2',
    'password' => 'f7e19f605e5b3f',
];

$mail = new PHPMailer(true);

?>