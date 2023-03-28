@extends('layouts.app')

@section('content')
@if(Session::has('wrongpass')) <div class="alert alert-warning"> {{Session::get('wrongpass')}} </div> @endif

@if(Session::has('qtydsc')) <div class="alert alert-warning"> {{Session::get('qtydsc')}} </div> @endif




<script src="/menswear/public/js/shareshow.js"></script>


<script src="/menswear/public/js/sharemoreitem.js"></script>

<script type="text/javascript">
    function confirmdel(){
        var cnf=confirm("Confirm Sale?");
        //var totalsp=document.getElementById("total").innerHTML;
        var j;
        var c=0;
        var same=0;
        for(j=0;j<=id;j++)
          {
            var child=document.getElementById("sp"+j);
            var chk=document.getElementById("one0").contains(child);
            if(chk==true)
            {
            var pr=document.getElementById("sp"+j).innerHTML;
            if(pr==="")
                break;
            else
                c++;
            }
            else 
                c++;

          }
          for(j=0;j<id;j++)
        {
            var childcodej=document.getElementById("code"+j);
            var chkcodej=document.getElementById("one0").contains(childcodej);
            for(k=j+1;k<=id;k++)
            {
               var childcodek=document.getElementById("code"+k);
               var chkcodek=document.getElementById("one0").contains(childcodek); 
               if(chkcodej==true&&chkcodek==true)
                   {
                        var codej=document.getElementById("code"+j).value;
                        var codek=document.getElementById("code"+k).value;
                        if(codej===codek)
                            same=1;
                   }
            }

        }
var childoo=document.getElementById("oos");
            var chkoo=document.getElementById("one0").contains(childoo);
            if(cnf===true)
            {
            if(chkoo===true)
            {
            alert('One or More Item is Out of Stock! Please check Once Again!');
return false;

}
else if(c<=id)
{
    alert('One or More Item is Invalid ! Please check Once Again!');
return false;
}
else if(same===1)
{
    alert('One or More Item is Repeated! Please check Once Again!');
return false;
}

else
return true;
}
else
return false;

    }
</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Sell To Shareholder</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form name="bill" method="POST" action="/menswear/public/sellshare">
                        @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">  
                                <label for="shareun" >Shareholder</label>
                                <select id="shareun" class="form-control form-control-sm" name="shareun" autofocus>
                                    @foreach($shareholderc as $shareholder)
                                    <option>
                                        {{$shareholder->username}}
                                    </option>
                                    @endforeach                               
                                </select> 
                            </div> 
                            
                            

                            <div class="col-md-4">
                                <label for="sharepassword">Shareholder's Password</label>
                                <input id="sharepassword" type="password" class="form-control form-control-sm" name="sharepassword" required>

                                @if ($errors->has('sharepassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sharepassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                        </div>
                        <hr>
                       <div id="one0">
                        <div class="form-group form-row" id="0">
                            <div class="col-md-2">
                                <label for="code">Item Code</label>
                                <input id="code0" type="text" class="form-control form-control-sm" name="code[]" oninput="showItem(0)" required autofocus autocomplete="off">
                            </div>
                            
                                    <div class="col-md-1">
                                        <label for="qty" >Qty</label>
                                        <input id="qty0" type="number" min="1" class="form-control form-control-sm" name="qty[]" required oninput="showItem(0)">
                                    </div>
                                    <input type="hidden" name="sps[]" id="sps0" />
                            
                            
                            <div class="col-md-3" id="txtItem0">
                                
                            </div>
                            <div class="col-md-3">
                                <span id="sptag0"></span>
                                <span id="sp0"></span>
                            </div>
                        </div>
                    
                            
                    </div>
                    <div class="form-group form-row">
                           <div class="col-md-2">
                                <a style="color:white;"onclick="addItem()" class="btn btn-primary">
                                    More Item
                                </a>
                           </div>

                        <div class="col-md-5" id="total">
                            
                        </div>  
                        
                            <div class="col-md-2" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-primary" onclick="return confirmdel()">
                                    Save & Print
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
