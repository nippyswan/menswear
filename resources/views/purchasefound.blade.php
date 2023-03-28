@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Purchase Report of <strong>{{$monnamec}} {{$yearc}}</strong></div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    {{$purcc->links()}}
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Date</th><th>Code</th><th>Description</th>
  <th>Qty</th><th>CP</th><th>Total CP</th>
 
    @foreach($purcc as $purc)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        <td>{{$purc->date}}</td>
        
        <td style="position:relative;">{{$purc->code}} </td>
        <td>
            {{$purc->br_name}} {{$purc->cat_name}} {{$purc->descr}}
        </td>
        <td>
            
            {{$purc->qty}}
        </td>
        <td>{{$purc->cp}}</td>
        <td>{{$purc->qty*$purc->cp}}</td>
    </tr>
   
  @endforeach
 
</table>




</div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
