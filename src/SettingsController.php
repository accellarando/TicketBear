<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;

/***
 * Controller for the "Control panel" page in TicketBear.
 * Todo:
 *  Add employee
 *  Add admin?
 *  Manage categories/priorities??
 */
class SettingsController extends Controller
{
    private $user;
    public function __construct(){
        require(__DIR__."/../config.php");

        //Need this to check clearance, but middleware hasn't run yet
        // so we can't just Auth::user() in the main __construct().
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user->tb_clearance !== "admin")
                abort(403);
            return $next($request);
        });
    }

    public function index(){
        return view("accellarando.ticketbear.settings");
    }
}
