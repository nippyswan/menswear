@extends('layouts.app')

@section('content')

@if(Session::has('newbr')) <div class="alert alert-success"> {{Session::get('newbr')}} </div> @endif
@if(Session::has('brexi')) <div class="alert alert-warning"> {{Session::get('brexi')}} </div> @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Add New Brand</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form  method="POST" action="/menswear/public/brandnew">
                        {{ csrf_field() }}

                       
                     
                        <div class="form-group row">
                            <div class="col-md-8">
                            <label for="br_name" >Brand Name</label>

                            
                                <input id="br_name" type="text" class="form-control{{ $errors->has('br_name') ? ' is-invalid' : '' }}" name="br_name" required autofocus>

                                @if ($errors->has('br_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('br_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            
                           <div class="col-md-6">
                           </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Add Brand
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
