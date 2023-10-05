@extends('company.master')

@section('title', 'All Projects| ' . env('APP_NAME'))




@section('content')
    {{-- id	name	image		price	duration	status	category_id --}}
    <div class="container">
        @if (session('msg'))
        <div class="alert alert-danger">
            {{session('msg')}}
        </div>

        @endif
        <div class="card">
            <!-- Button trigger modal -->


            <!-- Modal -->

            <div class="card-header  ">
                Pay <b class="text-danger">{{$project->price}}</b> to <b class="text-primary">{{$project->name}}</b>
            </div>
            <div class="card-body">
                <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$id}}"></script>
                <form action="{{route('company.projects.payment',$project)}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

            <div id="ttt" class="warp-content">

            </div>
            </div>
        </div>
    </div>



@endsection


