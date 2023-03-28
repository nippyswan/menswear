@extends('layouts.app')

@section('content')
@if(Session::has('catgdel')) <div class="alert alert-success"> {{Session::get('catgdel')}} </div> @endif
@if(Session::has('catgntdel')) <div class="alert alert-warning"> {{Session::get('catgntdel')}} </div> @endif
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
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Categories</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row" align="right">
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-2">
                        <a href="catgnew">Add New</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Category Name</th>
  
    @foreach($catgc as $catg)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        
        <td style="position:relative;">{{$catg->cat_name}} 
        
            
               
        <a href="catgdel/{{{$catg->cat_name}}}" onclick="return confirmdel()">
          <img src="png/delt.png" style="position:absolute;right:7px;">
        </a>
        
             
  </td>
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
