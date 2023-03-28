@extends('layouts.app')

@section('content')
<script type="text/javascript">
    function confirmclose(){
        var cnf=confirm("Notice: You Cannot Edit Any Record Of This Month After This Action. CONFIRM CLOSE This Month?");
if(cnf)
return true;
else
return false;
    }
</script>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Profit of <strong>{{$monnamec}} {{$yearc}}</strong></div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                 <div class="row">   
                    <div class=col-md-4 align="center">
                       <div class=col-md-10> 
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                      <div class="card-header">Items Sold</div>
                      <div class="card-body">
                        <h2 class="card-title">{{$qtysoldc}}</h2>
                        <p class="card-text"></p>
                      </div>
                    </div>
                </div>
                </div>
                <div class=col-md-4 align="center">
                    <div class=col-md-10> 
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                      <div class="card-header">Gross Profit</div>
                      <div class="card-body">
                        <h2 class="card-title">{{$grossprofitc}}</h2>
                        <p class="card-text"></p>
                      </div>
                    </div>
                </div>
                </div>
                <div class=col-md-4 align="center">
                    <div class=col-md-10> 
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                      <div class="card-header">Net Profit</div>
                      <div class="card-body">
                        <h2 class="card-title">{{$netprofitc}}</h2>
                        <p class="card-text"></p>
                      </div>
                    </div>
                </div>
                </div>
            </div>

                    <form method="POST" name="profit" action="/menswear/public/profitfound">
                        @csrf

                <div class="form-group form-row">
                    <div class="col-md-6" align="left" >
                        
                                <a style="color:white;" onclick="return confirmclose()" class="btn btn-primary btn-sm" href="closemonth/{{{$monnamec.' '.$yearc}}}">
                                    Close Month
                                </a>
                            
                            </div>   
                   
                    <div class="col-md-6" align="right" >
                        
                                <button type="submit" class="btn btn-primary btn-sm" >
                                    Go Home
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
