@extends('layouts.public')

@section('header')
    <!-- Put your logo here, or whatever else you'd like -->
    <h1> Report an Issue </h1>
@endsection

@section('content')
    <form method="POST" action="{{$_SERVER['PHP_SELF']}}">
        @csrf
        <label>
            Name
            <input type="text" name="name">
        </label><br>
        <label>
            Description of Problem
            <textarea name="description"></textarea>
        </label><br>
        <label>
            Category
            <select name='category'>
                @foreach(array_keys($categories) as $category)
                    <option>{{$category}}</option>
                @endforeach
            </select>
        </label><br>
        <label>
            Email Address
            <input type="email" name="email">
        </label><br>
        <button type="submit" name="submit">Submit</button>
    </form>
@endsection
