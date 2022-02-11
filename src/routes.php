<?php
require(__DIR__."/../config.php");
Route::resource(TB_ROOT.'/view', 'Accellarando\TicketBear\IssueController');
?>
