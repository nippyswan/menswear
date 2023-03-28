@extends('layouts.app')

@section('content')
<script type="text/javascript">
    function confirmret(){
        var cnf=confirm("Confirm Purchase?");
        if(cnf==true)
            return true;
        else 
            return false;
    }

    </script>


@if(Session::has('itemadded')) <div class="alert alert-success"> {{Session::get('itemadded')}} </div> @endif

@if(Session::has('itemnotadded')) <div class="alert alert-warning"> {{Session::get('itemnotadded')}} </div> @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add/Purchase Item</div>

                <div class="card-body">
                    <form method="POST" action="/menswear/public/additem">
                        @csrf

                        <div class="form-group form-row">
                            <div class="col-md-6">
                            <label for="code">Item Code</label>

                               <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                                                    
                       </div>
                       
                             <div class="col-md-3">
                            <label for="cp">Cost Price (CP)</label>
                         
                          
                                <input id="cp" type="number" min="1" class="form-control{{ $errors->has('cp') ? ' is-invalid' : '' }}" name="cp" value="{{ old('cp') }}" required>

                                @if ($errors->has('cp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cp') }}</strong>
                                    </span>
                                @endif
                       
                             </div>

                        
                            <div class="col-md-3">
                            <label for="mp" >Marked Price (MP)</label>
                            
                           
                                <input id="mp" type="number" min="1" class="form-control{{ $errors->has('mp') ? ' is-invalid' : '' }}" name="mp" required>

                                @if ($errors->has('mp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mp') }}</strong>
                                    </span>
                                @endif
                         
                        </div>
                        </div>
                    

                        <div class="form-group form-row">
                            <div class="col-md-2">
                                <label for="qty" >Qty</label>

                          
                                    <input id="qty" type="number" min="1" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}" name="qty" value="{{ old('qty') }}" required>

                                    @if ($errors->has('qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('qty') }}</strong>
                                        </span>
                                    @endif
                            </div>
                       
                            <div class="col-md-5">
                        
                                <label for="brand" >Brand</label>

                                
                                <select id="brand" class="form-control"  name="brand" >
                                          @foreach($brandc as $brand)
                                          
                                          <option >{{$brand->br_name}}</option>
                                          
                                         
                                          @endforeach
                                                                         
                                         
                                </select>
                                <a href="brandnd">Add/Remove Brand</a>
                            </div>
                            <div class="col-md-5">  
                        
                                <label for="catg" >Category</label>

                                    
                                <select id="catg" class="form-control" name="catg" >
                                    @foreach($catgc as $catg)
                                          
                                    <option >{{$catg->cat_name}}</option>
                                                                           
                                    @endforeach  
                                                                                                                                    
                                     
                                </select>  
                                <a href="catgnd">Add/Remove Category</a>
                                
                            </div>  
                        </div> 
                        <div class="form-group form-row">  
                            <div class="col-md-9">
                                <label for="desc" >Description</label>
                                <input type="text" name="desc" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <div class="col-md-6" class="form-control">
                                <button type="submit" onclick="return confirmret()" class="btn btn-primary">
                                    Add
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
