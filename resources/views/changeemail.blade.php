@extends('layouts.app')

@section('content')
@if(Session::has('wrongpass')) <div class="alert alert-warning"> {{Session::get('wrongpass')}} </div> @endif
@if(Session::has('wrongmail')) <div class="alert alert-warning"> {{Session::get('wrongmail')}} </div> @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Change Email</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form  method="POST" action="changeemail">
                        {{ csrf_field() }}

                         <div class="form-group{{ $errors->has('curpass') ? ' has-error' : '' }} row">
                            <label for="curpass" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="curpass" type="password" class="form-control" name="curpass" required autofocus>

                                @if ($errors->has('curpass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('curpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 control-label">New Email</label>

                            <div class="col-md-6">
                                <input id="email" type="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Email
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
