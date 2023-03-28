@extends('layouts.app')

@section('content')

@if(Session::has('sales')) <div class="alert alert-success"> {{Session::get('sales')}} </div> @endif




<script src="/menswear/public/js/print.js">
 

</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Billing</div>

                <div class="card-body">
                   
                    <div id="elem">
                        <div class="row">
                            <div class="col-md-12" align="left">
                                Bill No.: {{$bidc}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p align="center" style="font-size: 160%;"><strong>Men's Wear</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                        
                                <p align="center" style="font-size: 90%;">Belbari-1, Morang</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" align="left" style="font-size: 80%;">Date: {{date("Y/m/d")}}</div>
                          <div class="col-md-1">
                          </div>
                            <div class="col-md-4" align="center" style="font-size: 80%;">Phn no. 021-5454066</div>
                            <div class="col-md-1">
                          </div>
                            <div class="col-md-3" align="right" style="font-size: 80%;">fb@menswear</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">  
                                <p align="center"><strong><ins>Invoice</ins></strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                       <div class="table" align="center">
                    <table class="table table-sm table-borderless">
  <th><div align="center">S.N.</div></th>
  <th>Code</th>
  <th>Description</th>
  <th>MP</th>
  <th>Qty</th>
  <th>Disc.</th>
  <th>Total SP</th>
  @foreach($codec as $pos => $codeval)
  <tr> 
  <td><div align="center">{{$loop->iteration}}</div></td>
  <td>{{$codeval}}</td>
  <td>{{$brsnc[$pos]}} {{$catsnc[$pos]}} {{$descsc[$pos]}}</td>
  <td>{{$mpsc[$pos]}}</td>
  <td>{{$qtyc[$pos]}}</td>
  <td>{{$dscc[$pos]}}{{$tyc[$pos]}}</td>
  <td>{{$spsc[$pos]}}</td>
  
  </tr>
 @endforeach
</table>
</div>
</div>
</div>
                        <hr>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3" align="right">
                            <strong>Total Amt:</strong>
                            {{$tspc}}
                        </div>

                        </div>
                        <br>
                        <div class="row" id="hid1">
                            <div class="col-md-8"></div>
                            <div class="col-md-1">
                                <a style="color:white;" onclick="PrintDoc()" class="btn btn-primary">
                                    Print
                                </a>
                           </div>
                           <div class="col-md-1"></div>
                           <div class="col-md-1">
                                <a style="color:white;" href="/menswear/public/" class="btn btn-primary">
                                    Close
                                </a>
                           </div>
                           <div class="col-md-1"></div>
                        </div>



                    </div>                  
                  
                   
                </div>
          </div>
        </div>
    </div>
</div>

@endsection
