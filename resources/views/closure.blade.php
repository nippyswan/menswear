@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-header" align="center">Day Closure</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-sales-tab" data-toggle="tab" href="#nav-sales" role="tab" aria-controls="nav-sales" aria-selected="true">Sales</a>
    <a class="nav-item nav-link" id="nav-salesret-tab" data-toggle="tab" href="#nav-salesret" role="tab" aria-controls="nav-salesret" aria-selected="false">Sales Return</a>
    <a class="nav-item nav-link" id="nav-purc-tab" data-toggle="tab" href="#nav-purc" role="tab" aria-controls="nav-purc" aria-selected="false">Purchase</a>
    <a class="nav-item nav-link" id="nav-purcret-tab" data-toggle="tab" href="#nav-purcret" role="tab" aria-controls="nav-purcret" aria-selected="false">Purchase Return</a>
    <a class="nav-item nav-link" id="nav-exp-tab" data-toggle="tab" href="#nav-exp" role="tab" aria-controls="nav-exp" aria-selected="false">Expense</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Sales: </strong>{{$tsalesc}}
                        </div>
                    </div>
      <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Bill No.</th><th>Code</th><th>Description</th>
  <th>Qty</th><th>SP</th><th>Total SP</th><th>Sold By</th>
 
    @foreach($salesc as $sales)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
               <td>{{$sales->billno}}
                 @foreach($shc as $sh)
            @if($sh->billno===$sales->billno)
            <p style="color:blue;">({{$sh->username}})</p>
            @break
            @endif
            @endforeach
               </td>
        
        <td>{{$sales->code}} </td>
        <td>
            {{$sales->br_name}} {{$sales->cat_name}} {{$sales->descr}}
        </td>
        <td>
            
            {{$sales->qty}}
        </td>
        <td>{{$sales->sp/$sales->qty}}</td>
        <td>{{$sales->sp}}</td>
        <td>{{$sales->soldby}}</td>
    </tr>
   
  @endforeach
 
</table>
</div>
  </div>
  <div class="tab-pane fade" id="nav-salesret" role="tabpanel" aria-labelledby="nav-salesret-tab">
    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Sales Return: </strong>{{$tsalesretc}}
                        </div>
                    </div>
      <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Bill No.</th><th>Code</th><th>Description</th>
  <th>Qty</th><th>SP</th><th>Total SP</th><th>Returned By</th>
 
    @foreach($salesretc as $srt)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
              <td>{{$srt->ref_billno}}
                 @foreach($shc as $sh)
            @if($sh->billno===$srt->ref_billno)
            <p style="color:blue;">({{$sh->username}})</p>
            @break
            @endif
            @endforeach
              </td>
        
        <td>{{$srt->code}} </td>
        <td>
            {{$srt->br_name}} {{$srt->cat_name}} {{$srt->descr}}
        </td>
        <td>
            
            {{$srt->qty}}
        </td>
        <td>{{$srt->sp/$srt->qty}}</td>
        <td>{{$srt->sp}}</td>
        <td>{{$srt->retby}}</td>
    </tr>
   
  @endforeach
 
</table>
</div>
  </div>
  <div class="tab-pane fade" id="nav-purc" role="tabpanel" aria-labelledby="nav-purc-tab">
    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Purchase: </strong>{{$tpurcc}}
                        </div>
                    </div>
      <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Code</th><th>Description</th>
  <th>Qty</th><th>CP</th><th>Total CP</th>
 
    @foreach($purcc as $purc)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
               
        <td >{{$purc->code}} </td>
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
  <div class="tab-pane fade" id="nav-purcret" role="tabpanel" aria-labelledby="nav-purcret-tab">
    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Purchase Return: </strong>{{$tpuretc}}
                        </div>
                    </div>
      <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Code</th><th>Description</th>
  <th>Qty</th><th>CP</th><th>Total CP</th>
 
    @foreach($puretc as $puret)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        
        
        <td>{{$puret->code}} </td>
        <td>
            {{$puret->br_name}} {{$puret->cat_name}} {{$puret->descr}}
        </td>
        <td>
            
            {{$puret->qty}}
        </td>
        <td>{{$puret->cp}}</td>
        <td>{{$puret->qty*$puret->cp}}</td>
    </tr>
   
  @endforeach
 
</table>

</div>

  </div>
  <div class="tab-pane fade" id="nav-exp" role="tabpanel" aria-labelledby="nav-exp-tab">
    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Expense: </strong>{{$texpc}}
                        </div>
                    </div>
      <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th>
  <th>Description</th>
  <th>Amount</th>
 
    @foreach($expc as $exp)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
                <td>{{$exp->descr}}</td>
        
        
        <td>{{$exp->exp_amt}}</td>
        
    </tr>
   
  @endforeach
 
</table>
</div>


  </div>
</div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
