<?php
use Accellarando\TicketBear\IssueController;
use Accellarando\TicketBear\SettingsController;
require(__DIR__."/../config.php");
//You need to be authenticated to use these routes
Route::group(['middleware' => ['web','auth']], function(){
    Route::get(TB_ROOT.'all', [IssueController::class, 'all']);
    Route::get(TB_ROOT.'view/{id}', [IssueController::class, 'view']);
    Route::post(TB_ROOT.'assign', [IssueController::class, 'assign']);
    Route::post(TB_ROOT.'update', [IssueController::class, 'update']);

    Route::get(TB_ROOT.'settings', [SettingsController::class, 'index']);
    Route::post(TB_ROOT."resetPass", [SettingsController::class, 'resetPass']);
    Route::post(TB_ROOT."editPrivileges", [SettingsController::class, 'promote']);
});

//Public form to submit new tickets
Route::view(TB_ROOT.'create', 'accellarando.ticketbear.form',['categories' => CATEGORIES]);
Route::post(TB_ROOT.'create', [IssueController::class, 'create']);
?>
