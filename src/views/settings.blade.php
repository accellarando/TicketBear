@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!empty($status))
                <div class="alert alert-success">
                    {{$status}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <ul class="pagination">
                        <li class="page-item active" onclick="show(this,'new-user','card-body');">
                            <a class="page-link" href="#">Add User</a>
                        </li>
                        <li class="page-item" onclick="show(this,'reset-password','card-body');">
                            <a class="page-link" href="#">Reset Password</a>
                        </li>
                        <li class="page-item" onclick="show(this,'edit-privileges','card-body');">
                            <a class="page-link" href="#">Edit Clearance</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body new-user">
                    <form method="POST" action="{{route("register")}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Temporary Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Temp Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="clearance" class="col-md-4 col-form-label text-md-end">Clearance</label>

                            <div class="col-md-6">
                                <select id="clearance" class="form-control" name="clearance" required>
                                    <option selected>Agent</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body reset-password d-none">
                    <form method="POST" action="resetPass">
                        @csrf
                        <div class="row mb-3">
                            <label for="username-reset" class="col-md-4 col-form-label text-md-end">
                                Username
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" required id='username-reset'>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for='password-reset' class='col-md-4 col-form-label text-md-end'>
                                New temporary password
                            </label>
                            <div class='col-md-6'>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required id='password-reset'>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for='password-conf-reset' class='col-md-4 col-form-label text-md-end'>
                                Confirm
                            </label>
                            <div class="col-md-6">

                                <input type="password" name="password_confirmation" class="form-control" required id='password-conf-reset'>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="card-body edit-privileges d-none">
                    <form method="POST" action="editPrivileges">
                        @csrf

                        <div class="row mb-3">
                            <label for="privileges-username" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="privileges-username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edit-clearance" class="col-md-4 col-form-label text-md-end">New Clearance</label>

                            <div class="col-md-6">
                                <select id="edit-clearance" class="form-control" name="clearance" required>
                                    <option selected>Agent</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
