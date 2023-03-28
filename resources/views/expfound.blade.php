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





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Expense Report of <strong>{{$monnamec}} {{$yearc}}</strong></div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row" align="right">
                        <div class="col-md-12">
                            <strong>Total Expenses: </strong>{{$texpc}}
                        </div>
                    </div>
                    {{$purcc->links()}}
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Date</th>
  <th>Description</th>
  <th>Amount</th>
 
    @foreach($purcc as $purc)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        <td>{{$purc->exp_date}}</td>
        <td style="position:relative;">{{$purc->descr}}
            <a href="expdel/{{{$purc->exp_id}}}" onclick="return confirmdel()">
          <img src="png/delt.png" style="position:absolute;right:7px;">
        </a>
        </td>
        
        
        <td>{{$purc->exp_amt}}</td>
        
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
