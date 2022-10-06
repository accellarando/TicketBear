<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use accellarando\ticketbear\Issue;
use Auth;
use App\Models\User;
use accellarando\ticketbear\TbComment;

class IssueControllerBase extends Controller
{
    protected static $replyTo;
    protected static $fromName;
    public function __construct(){
        if(!file_exists(base_path()."/config/ticketbear.php"))
            echo "TicketBear not installed correctly! Please run php artisan ticketbear:install.".PHP_EOL;
        else
            require(base_path()."/config/ticketbear.php");
    }

    public function all(){
        $clearance = Auth::user()->tb_clearance;
        $users = User::all();
        $myId = Auth::user()->id;
        $mine = Issue::mine($myId);
        $all = Issue::selectAndJoin()->get();
        $incoming = Issue::incoming(0,3);
        $done = Issue::allDone();
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
        $myId = Auth::user()->id;
        return view('accellarando.ticketbear.view',compact('ticket','statuses','categories','priorities','assignedTo','comments','users','myId'));
    }

    public function create(Request $request){
        $ticket = new Issue;
        $ticket->name = $request->name;
        $ticket->summary = "";
        $ticket->description = $request->description;
        $ticket->category = $request->category;
        $ticket->priority = $request->critical ? 2 : 4;
        $ticket->email = $request->email;

        return $ticket;
    }

    public function assign(Request $request){
        $issue = Issue::find($request->input('ticket'));
        $issue->assigned_to = $request->input('agent');
        $issue->status = STATUSES[1] ?? "Assigned";
        $issue->save();


        return $issue;
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
        if($request->status == "New")
            $issue->assigned_to = null;
        if($request->assigned_to != -1 && $request->status != "New"){
            $issue->assigned_to = $request->assign;
            if($issue->status == "New"){
                $issue->status = "Assigned";
            }
        }

        if(!empty($request->input("addComment"))){
            $comment = new TbComment;
            $comment->author = Auth::user()->id;
            $comment->issue = $request->input("id");
            $comment->comment = $request->input("addComment");
            $comment->save();
        }

        return $issue;
    }

    public function sendMail($customerEmails,$subject,$body){
        if(!SEND_EMAILS)
            return false;
        require(MAILER_PATH);
        require(base_path()."/../info/Libraries/mail_security_check.php");

        $mail = new \PHPMailer(true);

        $mail->From = self::$replyTo;
        $mail->FromName = self::$fromName;
        $mail->WordWrap = 50;
        $mail->IsHtml(true);
        $mail->Subject = $subject;

        foreach($customerEmails as $email){
            $mail->AddAddress($email);
        }


        $mail->Body = $body;

        if(!$mail->Send())
            echo "The email did not send correctly, but your ticket has still been opened.";

    }
}
