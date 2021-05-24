@extends('layouts.master')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card">

                    <div class="card-body">
                        <div>
                            <img src="{{ asset('img/hudumalogo2.png') }}" alt="Logo" style="display: block;margin-left: auto;margin-right: auto;">
                        </div>
                        <hr style="border: 2px solid darkgreen; border-radius: 5px;">
                        <h4 class="text-center" style="font-weight: bold;">
                            <font style="color:#000;">Internship</font>
                            <font style="color:#fa3333;">Management</font>
                            <font style="color:#009933;">System</font>
                        </h4>
                        <div class="my-4">
                            @yield('auth')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
