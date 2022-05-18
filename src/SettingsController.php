<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\Models\User;

/***
 * Controller for the "Control panel" page in TicketBear.
 * Todo:
 *  Promote/demote agents to admins, etc
 *  Error handling on "Reset Password" tab (in the view)
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
        $users = User::all();
        return view("accellarando.ticketbear.settings")->with(compact('users'));
    }

    /***
     * Password changer and helpers
     */
    public function resetPass(){
        $this->validator(request()->all())->validate();
        $this->update(request()->all());
        return view("accellarando.ticketbear.settings")
            ->with("status","Password changed!");
    }
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'exists:users,name'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }
    protected function update(array $data){
        $user = User::where('name','=',$data['username'])->first();
        $user->password = Hash::make($data['password']);
        $user->temp_pass = 1;
        $user->save();
    }

    /***
     * Clearance changer
     */
    public function promote(){
        //Validate
        \Validator::make(request()->all(), [
            'username' => ['required', 'string', 'max:255', 'exists:users,name'],
            'clearance' => ['required', 'in:Agent,Admin']
        ])->validate();

        $user = User::where('name','=',request()->input('username'))->first();
        $user->tb_clearance = request()->input('clearance');
        $user->save();

        return view("accellarando.ticketbear.settings")->with("status","Clearance updated!");
    }

    /***
     * Delete a user
     */
    public function delete(Request $request){
        if(Auth::user()->tb_clearance !== "admin")
            abort(403);
        else{
            $user = User::find($request->id);
            $user->delete();
        }

        return view("accellarando.ticketbear.settings")->with("status","User deleted!");
    }

}
