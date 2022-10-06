<?php
/***
 * This extends the IssueControllerBase class, defined in TicketBear's vendor directory.
 * It ties everything together and allows you to run custom code.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use accellarando\ticketbear\Issue;
use accellarando\ticketbear\IssueControllerBase;
use Auth;
use App\Models\User;
use accellarando\ticketbear\TbComment;

class IssueController extends IssueControllerBase 
{
    public function __construct(){
		self::$replyTo = "noreply@example.com";
		self::$fromName = "IT Department";
		parent::__construct();
	}
    
    public function create(Request $request){
        $ticket = parent::create($request);

        //Get ready to send emails out
        $body = "Submission details:<br>";
        $body .= "Form submitted by: ".$request->name."<br>";
        $body .= "Reply to: ".$request->email."<br>";
        $body .= "Problem: ".$request->description."<br>";
        $body .= "Category: ".$request->category."<br>";

        $emails = ['admin@example.com',$request->email]; //change this to the ucs it list eventually
        if($ticket->save()){
            $body = "<h1>IT ticket opened!</h1> Expect to hear from us regarding your issue shortly.<br>".$body;
            parent::sendMail($emails,"New IT Ticket Created",$body);
        }
        else{
            if(!(in_array("admin@example.com",$emails)))
                $emails[] = "emoss@campusstore.utah.edu";
            $body = "<h1>IT ticket creation failed!</h1> The issue has been reported, as well as your original issue.<br>".$body;
            parent::sendMail($emails,"IT ticket creation failed!",$body);
        }
        return view('accellarando.ticketbear.success',compact('ticket'));
    }

    public function assign(Request $request){
        $issue = parent::assign($request);

        $agentEmail = [User::find($request->input('agent'))->email];
        $subject = "You have been assigned an IT task";
        $body = "<h1> You've been assigned a ticket! </h1>
            <a href='https://www.info.campusstore.utah.edu/ITTickets'>Log in</a> to view.<br>
            Ticket submitted by: ".$issue->name."<br>
            Problem: ".$issue->description."<br>
            Priority: ".$issue->priority;
        parent::sendMail($agentEmail,$subject,$body);

        return parent::all();
    }

    public function update(Request $request){
        $ticket = parent::update($request);
        $ticket->serial = $request->serial;

        $ticket->save();

        return redirect(TB_ROOT."view/".$request->input("id"));
    }
}
