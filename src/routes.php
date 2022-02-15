<?php
use Accellarando\TicketBear\IssueController;
require(__DIR__."/../config.php");
//You need to be authenticated to use these routes
Route::group(['middleware' => ['web','auth']], function(){
    Route::get(TB_ROOT.'all', [IssueController::class, 'all']);
    Route::get(TB_ROOT.'view/{id}', [IssueController::class, 'view']);
});

//Public form to submit new tickets
Route::view(TB_ROOT.'create', 'accellarando.ticketbear.form',['categories' => CATEGORIES]);
Route::post(TB_ROOT.'create', [IssueController::class, 'create']);
?>
