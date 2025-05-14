@extends('admin.includes.layout')
@section('page-title', 'Dashboard')
@section('admin-content')
    <div class="row">
        <div class="col-lg-4 col-md-6 m-b-3">
            <div class="widget-info bg-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <p>Total Balance</p>
                            <h2 class="font-weight-bold">$15,859</h2>
                            <a href="#">View Statement</a>
                        </div>
                        <div class="col-md-6 m-t-2 text-right"> <span id="spa-bar"></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 m-b-3">
            <div class="widget-info bg-aqua">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <p>Online Revenue</p>
                            <h2 class="font-weight-bold">$8,859</h2>
                            <a href="#">View Statement</a>
                        </div>
                        <div class="col-md-6 m-t-2 text-right"> <span id="spa-line"></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 m-b-3">
            <div class="widget-info bg-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <p>Total Profit</p>
                            <h2 class="font-weight-bold">$85,085</h2>
                            <a href="#">View Statement</a>
                        </div>
                        <div class="col-md-6 m-t-2 text-right"> <span id="spa-pie"></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
