<?php
$inject = '<?php 
require(__DIR__."/../vendor/accellarando/ticketbear/src/helpers.php");';
$app = __DIR__."/../../../bootstrap/app.php";
$contents = file($app);
unset($contents[0]);
file_put_contents($app,$inject.implode("\n",$contents));
