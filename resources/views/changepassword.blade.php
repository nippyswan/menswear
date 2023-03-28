@extends('layouts.app')

@section('content')
@if(Session::has('matchmessage')) <div class="alert alert-warning"> {{Session::get('matchmessage')}} </div> @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Change Password</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form  method="POST" action="changepassword">
                        {{ csrf_field() }}

                        

                        <div class="form-group{{ $errors->has('curpassword') ? ' has-error' : '' }} row">
                            <label for="curpassword" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="curpassword" type="password" class="form-control" name="curpassword" required autofocus>

                                @if ($errors->has('curpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('curpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} row">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
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
