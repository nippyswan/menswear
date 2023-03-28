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
                <div class="card-header">Return From Bill No. {{$billc}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/menswear/public/custfound">
                        @csrf
                        <input type="hidden" name="billno" value="{{$billc}}"/>

                        <div class="form-group form-row">
                            
                            <div class="col-md-3">
                                <strong>Bill Date: </strong>{{$datec}}
                            </div>
                            <div class="col-md-3">
                                <strong>Sold By: </strong>{{$soldbyc}}
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            
                                <th>Code</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Total SP</th>
                                <th>Return Qty</th>
                            
                        @foreach($codec as $pos=>$code)
                        @if($qtyc[$pos]>0)
                        <tr>
                        
                              <td>  {{$code}}</td>                            
                            
                              <td>  {{$brsnc[$pos]}} {{$catsnc[$pos]}}</td>
                            
                              <td>  {{$qtyc[$pos]}}</td>
                            
                              <td>  {{$spc[$pos]}}</td>
                            
                             <td>   <input type="number" value="0" min="0" max="{{$qtyc[$pos]}}" class="form-control form-control-sm" name="qty[]">
                                <input type="hidden" name="code[]" value="{{$code}}"/>
                                <input type="hidden" name="sp[]" value="{{$spc[$pos]}}"/>
                                <input type="hidden" name="qtyc[]" value="{{$qtyc[$pos]}}"/>
                               
                            </td>

                            
                        </tr>
                        @else
                        <tr>
                        
                              <td>  {{$code}}</td>                            
                            
                              <td>  {{$brsnc[$pos]}} {{$catsnc[$pos]}}</td>
                            
                              <td>  All Returned</td>
                            
                              <td>  NA</td>
                              <td>  NA</td>

                        @endif
                        @endforeach
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
