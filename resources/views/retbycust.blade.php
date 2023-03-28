@extends('layouts.app')

@section('content')
@if(Session::has('retbycust')) <div class="alert alert-warning"> {{Session::get('retbycust')}} </div> @endif
@if(Session::has('returned')) <div class="alert alert-success"> {{Session::get('returned')}} </div> @endif






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Sales Return</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" name="retbycust" action="/menswear/public/custfound">
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-1">
                                Bill No.
                            </div>
                            <div class="col-md-4">  
                                
                                <input id="billnum" class="form-control form-control-sm" name="billnum" autofocus required>
                                    
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
