@extends('layouts.app')

@section('content')
<script type="text/javascript">
    function confirmret(){
        var cnf=confirm("Confirm Return?");
        if(cnf==true)
            return true;
        else 
            return false;
    }

    </script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Return Item: {{$codec}} To Wholesaler</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/menswear/public/wholefound">
                        @csrf
                        

                       
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            
                                <th>Code</th>
                                <th>Description</th>
                                <th>Qty Left</th>
                                <th>CP</th>
                                <th>Return Qty</th>
                            
                        
                        @if($qtyc>0)
                        <tr>
                        
                              <td>  {{$codec}}</td>                            
                            
                              <td>  {{$brsnc}} {{$catsnc}} {{$descrc}}</td>
                            
                              <td>  {{$qtyc}}</td>
                            
                              <td>  {{$cpc}}</td>
                            
                             <td>   <input type="number" value="0" min="0" max="{{$qtyc}}" class="form-control form-control-sm" name="qty">
                                
                            <input type="hidden" name="code" value="{{$codec}}"/>
                            <input type="hidden" name="qtyc" value="{{$qtyc}}"/>
                               
                            </td>

                            
                        </tr>
                        @else
                        <tr>
                        
                              <td>  {{$codec}}</td>                            
                            
                              <td>  {{$brsnc}} {{$catsnc}} {{$descrc}}</td>
                            
                              <td>Zero Stock</td>
                            
                              <td>  NA</td>
                              <td>  NA</td>

                        @endif
                       
                    </table>
                </div>
                        

                        <div class="form-group form-row">
                            <div class="col-md-10">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" onclick="return confirmret()" class="btn btn-primary btn-sm">
                                    Return
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
