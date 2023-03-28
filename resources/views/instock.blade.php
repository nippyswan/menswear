@extends('layouts.app')

@section('content')


<script type="text/javascript">
    function confirmdel(){
        var cnf=confirm("Confirm Delete ?");
if(cnf)
return true;
else
return false;
    }
</script>
@if(Session::has('stockdel')) <div class="alert alert-success"> {{Session::get('stockdel')}} </div> @endif
@if(Session::has('stockntdel')) <div class="alert alert-warning"> {{Session::get('stockntdel')}} </div> @endif



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Stock</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    <div class="col-md-12" align="right">
    <strong>Net Worth: Rs. </strong>{{$tot}}
    </div>
</div>
                    

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Code</th><th>Description</th>
  <th>Qty</th><th>CP</th><th>Total CP</th>
 
    @foreach($stockc as $pos=>$stock)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        
        <td style="position:relative;">{{$stock->code}} 
            <a href="stockdel/{{{$stock->code}}}" onclick="return confirmdel()">
          <img src="png/delt.png" style="position:absolute;right:7px;">
        </a>
        </td>
        <td>
            @foreach($brandc as $brand)
            @if($brand->br_id===$stock->br_id)
            {{$brand->br_name}}
            @endif
            @endforeach
            @foreach($categoryc as $category)
            @if($category->cat_id===$stock->cat_id)
            {{$category->cat_name}} {{$stock->descr}}
            @endif
            @endforeach
        </td>
        <td>
            <strong>
            @if($stock->qty===0)
            <span style="color:red;">
            {{$stock->qty}}
            </span>
            @else
            <span style="color:#00dd00;">
            {{$stock->qty}}
            </span>
            @endif
            </strong>
        </td>
        <td>{{$stock->cp}}</td>
        <td>{{$stock->qty*$stock->cp}}</td>
    </tr>
   
  @endforeach
  {{ $stockc->links() }}
</table>


</div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
