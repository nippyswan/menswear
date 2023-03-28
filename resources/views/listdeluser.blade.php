@extends('layouts.app')

@section('content')
@if(Session::has('udel')) <div class="alert alert-success"> {{Session::get('udel')}} </div> @endif
@if(Session::has('untdel')) <div class="alert alert-warning"> {{Session::get('untdel')}} </div> @endif


@if(Session::has('wrongpassdel')) <div class="alert alert-warning"> {{Session::get('wrongpassdel')}} </div> @endif



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Users</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
  <th><div align="center">S.N.</div></th><th>Username</th><th>Email</th>
  
    @foreach($userc as $user)
    <tr>
    <td><div align="center">{{$loop->iteration}}</div></td>
        
        <td style="position:relative;">{{$user->username}} 
        @foreach($sharec as $share) 
        @if($share->username===$user->username)
        <span style="color:orange;">(shareholder)</span>
        @endif
        @endforeach 
        @if($user->username!=="admin")  
        
        <a href="deluser/{{{$user->username}}}">
          <img src="png/delt.png" style="position:absolute;right:7px;">
        </a>
        
        @endif
       
  </td>
    <td>{{$user->email}}</td>
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
