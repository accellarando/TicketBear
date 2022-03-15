{{-- Change this to your app layout --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="pagination">
                    <li class="page-item active" onclick="show(this,'mine','ticket');">
                        <a class="page-link" href="#">My tasks</a>
                    </li>
                    <li class="page-item" onclick="show(this,'incoming','ticket');">
                        @if($clearance=="admin")
                            <a class="page-link" href="#">New admin tasks</a>
                        @else
                            <a class="page-link" href="#">New tasks</a>
                        @endif
                    </li>
                    <li class="page-item" onclick="show(this,'done','ticket');">
                        <a class="page-link" href="#">Completed tasks</a>
                    </li>
                    @if($clearance=="admin")
                        <li class="page-item" onclick="show(this,'all','ticket');">
                            <a class="page-link" href="#">All tasks</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Customer Name</th>
                        <th>Description of Issue</th>
                        <th>Ticket Status</th>
                        <th>Issue Category</th>
                        <th>Customer Email</th>
                        <th>Issue Priority</th>
                        @if($clearance === "admin")
                            <th>Assigned To</th>
                        @endif
                        <th>Completed</th>
                        <th>Date Added</th>
                        <th>Date Last Updated</th>
                        @if($clearance === "admin")
                            <th>Assign To</th>
                        @endif
                    </tr>
                    @foreach($mine as $ticket)
                        <tr class="ticket mine" aria-label="{{$ticket->id}}">
                            {{printTicket($ticket,$users,$clearance)}}
                        </tr>
                    @endforeach
                    @foreach($incoming as $ticket)
                        <tr class="ticket incoming d-none" aria-label="{{$ticket->id}}">
                            {{printTicket($ticket,$users,$clearance)}}
                            <td><a href="#" onclick="assign({{$ticket->id}},{{$myId}})">Claim</a></td>
                        </tr>
                    @endforeach
                    @foreach($done as $ticket)
                        <tr class="ticket done d-none" aria-label="{{$ticket->id}}">
                            {{printTicket($ticket,$users,$clearance)}}
                        </tr>
                    @endforeach
                    @if($clearance=="admin")
                        @foreach($all as $ticket)
                            <tr class="ticket all d-none" aria-label="{{$ticket->id}}">
                                {{printTicket($ticket,$users,$clearance)}}
                            </tr>
                        @endforeach
                    @endif

                </table>
            </div>
        </div>
    </div>
@endsection
