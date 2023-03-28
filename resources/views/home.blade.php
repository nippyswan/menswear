@extends('layouts.app')

@section('content')
@if(Session::has('qtydsc')) <div class="alert alert-warning"> {{Session::get('qtydsc')}} </div> @endif





<script src="/menswear/public/js/homeshow.js"></script>


<script src="/menswear/public/js/moreitem.js"></script>

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
                <div class="card-header">Billing</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form name="bill" method="POST" action="/menswear/public/savePrint">
                        @csrf
                        

                       <div id="one0">
                        <div class="form-group form-row" id="0"><div class="col-md-2"><label for="code">Item Code</label><input id="code0" type="text" class="form-control form-control-sm" name="code[]" oninput="showItem(0)" required autofocus autocomplete="off"></div><div class="col-md-3"><div class="form-group form-row"><div class="col-md-5"><label for="qty" >Qty</label><input id="qty0" type="number" min="1" class="form-control form-control-sm" name="qty[]" required oninput="showItem(0)"></div><div class="col-md-7"><label for="dsc" >Discount</label><input id="dsc0" min="0" type="number" class="form-control form-control-sm" name="dsc[]" required oninput="showItem(0)"></div></div></div><div class="col-md-1">  <label for="ty" >Type</label><select id="ty0" class="form-control form-control-sm" name="ty[]" onchange="showItem(0)" ><option >.0</option><option >%</option></select> <input type="hidden" name="sps[]" id="sps0" /></div>  <div class="col-md-3" id="txtItem0"></div><div class="col-md-3"><span id="sptag0"></span><span id="sp0"></span></div></div>
                    
                            
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
