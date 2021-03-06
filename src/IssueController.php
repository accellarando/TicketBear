<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use accellarando\ticketbear\Issue;
use Auth;
use App\Models\User;
use accellarando\ticketbear\TbComment;

class IssueController extends Controller
{

    public function __construct(){
        require(__DIR__."/../config.php");
    }

    public function all(){
        $clearance = Auth::user()->tb_clearance;
        $users = User::all();
        $myId = Auth::user()->id;
        $mine = Issue::mine($myId);
        if($clearance === "admin"){
            $all = Issue::selectAndJoin()->get();
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
        $statuses = STATUSES;
        $categories = array_keys(CATEGORIES);
        $priorities = range(1,MAX_PRIORITY);
        $assignedTo = User::find($ticket->assigned_to) ?? "";
        $comments = TbComment::selectAndJoin($id);
        $users = User::all();
        return view('accellarando.ticketbear.view',compact('ticket','statuses','categories','priorities','assignedTo','comments','users'));
    }

    public function create(Request $request){
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
        $issue->status = STATUSES[1] ?? "Assigned";
        $issue->save();
        //Should we send out an email, letting customer know that their ticket is claimed?
        return self::all();
    }

    public function update(Request $request){
        $issue = Issue::find($request->input("id"));

        $issue->name = $request->name;
        $issue->description = $request->description;
        $issue->status = $request->status;
        $issue->category = $request->category;
        $issue->priority = $request->priority;
        $issue->email = $request->email;
        if(in_array($request->status,COMPLETE_STATUSES))
            $issue->completed=1;
        $issue->assigned_to = $request->assign;
        $issue->save();

        if(!empty($request->input("addComment"))){
            $comment = new TbComment;
            $comment->author = Auth::user()->id;
            $comment->issue = $request->input("id");
            $comment->comment = $request->input("addComment");
            $comment->save();
        }


        return redirect(TB_ROOT."view/".$request->input("id"));
    }

    public function sendMail($customerEmail){
        //fill this in lmao
    }
}
