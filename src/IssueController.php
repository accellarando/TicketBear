<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Accellarando\TicketBear\Issue;
use Auth;
use App\Models\User;

class IssueController extends Controller
{

    public function all(){
        require(__DIR__."/../config.php");
        $clearance = Auth::user()->tb_clearance;
        $users = User::all();
        $myId = Auth::user()->id;
        $mine = Issue::mine($myId);
        if($clearance === "admin"){
            //mvc violation? who she
            $all = Issue::select('issues.*','users.name AS assigned')
                ->leftJoin('users','assigned_to','=','users.id')
                ->get();
            $incoming = Issue::incoming(AGENT_MAX+1,MAX_PRIORITY);
            $done = Issue::allDone();
        }
        else{
            $all = []; //gotta pass something I guess
            $incoming = Issue::incoming(0,AGENT_MAX);  
            $done = Issue::myDone($myId);
        }
        return view('accellarando.ticketbear.all', compact('mine','incoming','clearance','users','all','done','myId'));
    }

    public function view($id){
        $ticket = Issue::find($id);
        return view('accellarando.ticketbear.view',compact('ticket'));
    }

    /***
     *
     */
    public function create(Request $request){
        require(__DIR__."/../config.php");
        self::sendMail($request->email);
        $ticket = new Issue;
        $ticket->name = $request->name;
        $ticket->description = $request->description;
        $ticket->category = $request->category;
        $ticket->priority = CATEGORIES[$request->category]; //defined in config.php
        $ticket->email = $request->email;
        $ticket->save();
        return view('accellarando.ticketbear.success');
    }

    public function assign(Request $request){
        $issue = Issue::find($request->input('ticket'));
        $issue->assigned_to = $request->input('agent');
        $issue->save();
        //Should we send out an email, letting customer know that their ticket is claimed?
    }

    /***
     *
     */
    public function update(){
        //todo: this
        return view('accellarando.ticketbear.update');
    }

    public function sendMail($customerEmail){

    }
}
