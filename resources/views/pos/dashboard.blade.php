@extends('adminlte::page')
@section('title', 'Mall POS Dashboard')
@section('content_header')
<h1>Welcome to Mall POS System</h1> 
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h4>Total Sales Today</h4>
                <h2>${{ number_format($totalSalesToday ?? 0, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4>Total Products</h4>
                <h2>{{ $totalProducts ?? 0}}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h4>Transactions Today</h4>
                <h2>{{ $totalTransaction ?? 0 }}</h2>
            </div>
        </div>
    </div>

</div>