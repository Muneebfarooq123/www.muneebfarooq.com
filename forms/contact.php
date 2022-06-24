<?php
require '../vendor/autoload.php'; // If you're using Composer (recommended)
define('SG_API', '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');

$sub = (@$_POST['subject']) ? $_POST['subject'] : 'No subject';
$name = (@$_POST['name']) ? $_POST['name'] : 'Send Grid SMTP';

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("waqar.tek@gmail.com", $name);
$email->addTo("rehanhussain071@gmail.com", 'Rehan Hussain');
$email->setSubject($sub);

$msg = '';
foreach ($_POST as $k => $v) { 
  $k = ucwords(str_replace(['_','-'], ' ', $k));
  $msg .= "$k : $v <br>";
}

$email->addContent("text/html", $msg);
$sendgrid = new \SendGrid( SG_API );
try {
    $response = $sendgrid->send($email);
    echo "OK";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}