@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">View/Update Ticket</div>
            <div class="card-body">
                <form action="../update" method="POST" class="flexform">
                    @csrf
                    <input type="hidden" name="id" value="{{$ticket->id}}">
                <label>
                    <p>Name:</p>
                    <input type="text" value="{{$ticket->name}}" name="name">
                </label>
                

                <label>
                    <p>Description:</p>
                    <textarea name="description" style='width:50%;'>{{$ticket->description}}</textarea>
                </label>
                

                <label>
                    <p>Status:</p>
                    <select name="status">
                        @foreach($statuses as $status)
                            <option 
                            @if($ticket->status == $status)
                                selected
                            @endif
                            >{{$status}}</option>
                        @endforeach
                    </select>
                </label>
                

                <label>
                   <p>Category:</p>
                    <select name="category">
                        @foreach($categories as $category)
                            <option 
                            @if($ticket->category == $category)
                                selected
                            @endif
                            >{{$category}}</option>
                        @endforeach
                    </select>
                </label>
                

                <label>
                    <p>Customer email:</p>
                    <input type="text" name="email" value="{{$ticket->email}}">
                </label>
                

                <label>
                    <p>Priority:</p>
                    <select name="priority">
                        @foreach($priorities as $priority)
                            <option
                                @if($ticket->priority == $priority)
                                    selected
                                @endif
                                >{{$priority}}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    <p>Last updated:</p>
                    <input class="form-control" readonly value="{{$ticket->updated_at}}"> <!-- might wanna format this date differently? -->
                </label>

                <label>
                    <p>Assigned to:</p>
                    <input class="form-control" readonly value="{{$assignedTo->name}}">
                </label>

                <label>
                    <p>Comments:</p>
                    <div class='comments'>
                        @foreach($comments as $comment)
                            <div class="author">{{$comment->user}}:</div>
                            <div class="comment">{{$comment->comment}}</div>
                        @endforeach
                    <input type="text" class="form-control-sm" name="addComment" placeholder="Add comment...">
                    </div>
                </label>

                <input type="submit" class="btn btn-primary form-control" value="Submit" style="width:10%; margin:0 auto;">
                
                <!--
                {{$ticket->assigned}}
                
                {{$ticket->created_at}}
                
                {{$ticket->updated_at}}
                -->
                <!-- Display comments -->
                <!-- Form field: add comment -->
            </div>
        </div>
    </div>
@endsection
