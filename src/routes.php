<?php
use App\Http\Controllers\IssueController;
use accellarando\ticketbear\SettingsController;
if(!file_exists(base_path()."/config/ticketbear.php")){
    echo "TicketBear not installed correctly! Please run php artisan ticketbear:install.".PHP_EOL;
    require(base_path()."/vendor/accellarando/ticketbear/src/files/config.php");
}
else
    require(base_path()."/config/ticketbear.php");
//You need to be authenticated to use these routes
Route::group(['middleware' => ['web','auth']], function(){
    Route::get(TB_ROOT.'all', [IssueController::class, 'all']);
    Route::get(TB_ROOT.'view/{id}', [IssueController::class, 'view']);
    Route::post(TB_ROOT.'assign', [IssueController::class, 'assign']);
    Route::post(TB_ROOT.'update', [IssueController::class, 'update']);

    Route::get(TB_ROOT.'settings', [SettingsController::class, 'index']);
    Route::post(TB_ROOT."resetPass", [SettingsController::class, 'resetPass']);
    Route::post(TB_ROOT."editPrivileges", [SettingsController::class, 'promote']);
    Route::post(TB_ROOT."delete", [SettingsController::class, 'delete']);
});

//Public form to submit new tickets
Route::view(TB_ROOT.'create', 'accellarando.ticketbear.form',['categories' => CATEGORIES]);
Route::post(TB_ROOT.'create', [IssueController::class, 'create']);
?>
