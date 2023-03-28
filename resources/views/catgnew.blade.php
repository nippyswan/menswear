@extends('layouts.app')

@section('content')

@if(Session::has('newcat')) <div class="alert alert-success"> {{Session::get('newcat')}} </div> @endif
@if(Session::has('catexi')) <div class="alert alert-warning"> {{Session::get('catexi')}} </div> @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Add New Category</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form  method="POST" action="/menswear/public/catgnew">
                        {{ csrf_field() }}

                       
                     
                        <div class="form-group row">
                            <div class="col-md-8">
                            <label for="cat_name" >Category Name</label>

                            
                                <input id="cat_name" type="text" class="form-control{{ $errors->has('cat_name') ? ' is-invalid' : '' }}" name="cat_name" required autofocus>

                                @if ($errors->has('cat_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cat_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            
                           <div class="col-md-6">
                           </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Add Category
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
