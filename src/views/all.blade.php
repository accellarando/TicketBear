<?php /* Change this to your app layout*/ ?>
@extends('layouts.app');
@section('content')
    <table class="table table-bordered table-striped">
        <!-- todo: sorts and filters -->
        <tr>
            <th>Customer Name</th>
            <th>Description of Issue</th>
            <th>Ticket Status</th>
            <th>Issue Category</th>
            <th>Customer Email</th>
            <th>Issue Priority</th>
            <th>Assigned To</th>
            <th>Completed</th>
            <th>Date Added</th>
            <th>Date Last Updated</th>
        </tr>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{$ticket->name}}</td>
                <td>{{$ticket->description}}</td>
                <td>{{$ticket->status}}</td>
                <td>{{$ticket->category}}</td>
                <td>{{$ticket->email}}</td>
                <td>{{$ticket->priority}}</td>
                <td>{{$ticket->assigned_to}}</td>
                <td>{{$ticket->completed == 1 ? "Yes" : "No"}}</td>
                <td>{{$ticket->created_at}}</td>
                <td>{{$ticket->updated_at}}</td>
            </tr>
        @endforeach
    </table>
@endsection
