@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-header">Sales Return Report</div>

               <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" name="purchase" action="/menswear/public/salesretrepfound">
                        
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <select class="form-control form-control-sm" name="month"  >
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control form-control-sm" name="year"  >
                            <option >2019</option>
                            <option >2020</option>
                            <option >2021</option>
                            <option >2022</option>
                            <option >2023</option>
                            <option >2024</option>
                            <option >2025</option>
                            <option >2026</option>
                            <option >2027</option>
                            <option >2028</option>
                            <option >2029</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Search
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
