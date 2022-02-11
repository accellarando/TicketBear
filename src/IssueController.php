<?php

namespace Accellarando\TicketBear;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Accellarando\TicketBear\Issue;

class IssueController extends \App\Http\Controllers\Controller
{
    /***
     *
     */
    public function index(){
        $tickets = Issue::all();
        return view('accellarando.ticketbear.all', compact('tickets'));
    }

    public function view($id){
        return view('accellarando.ticketbear.view',compact('id'));
    }

    /***
     *
     */
    public function create(){
        //todo: this
        return view('accellarando.ticketbear.create');
    }

    /***
     *
     */
    public function update(){
        //todo: this
        return view('accellarando.ticketbear.update');
    }

    /***
     *
     */
    public function destroy(){
        //todo: this
        return view('accellarando.ticketbear.view');
    }
}
