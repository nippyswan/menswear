@extends('layouts.app')

@section('content')
@if(Session::has('notfound')) <div class="alert alert-warning"> {{Session::get('notfound')}} </div> @endif
@if(Session::has('foundret')) <div class="alert alert-success"> {{Session::get('foundret')}} </div> @endif






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Purchase Return</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" name="retbycust" action="/menswear/public/wholefound">
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-1">
                                Code
                            </div>
                            <div class="col-md-4">  
                                
                                <input id="code" class="form-control form-control-sm" type="text" name="code" autofocus required>
                                    
                            </div> 
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Search
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
