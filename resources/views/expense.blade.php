@extends('layouts.app')

@section('content')

@if(Session::has('saved')) <div class="alert alert-success"> {{Session::get('saved')}} </div> @endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Add Expense</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form  method="POST" action="/menswear/public/expense">
                        {{ csrf_field() }}

                       
                        <div class="row">
                        <div class="form-group col-md-7">
                            <label for="descr" class="col-form-label text-md-right">Description</label>

                            
                                <input id="descr" type="text" class="form-control{{ $errors->has('descr') ? ' is-invalid' : '' }}" name="descr" required autofocus>

                                @if ($errors->has('descr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descr') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group col-md-5">
                            <div class="col-md-4">
                            <label for="amt" class="col-form-label text-md-right">Amount</label>
                            </div>
                             <div class="col-md-8">
                                <input id="amt" type="number" min="1" max="9999999"class="form-control{{ $errors->has('amt') ? ' is-invalid' : '' }}" name="amt" required>

                                @if ($errors->has('amt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                                          
                        <div class="form-group row">
                            
                           <div class="col-md-8">
                           </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit 
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
