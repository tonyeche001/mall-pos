@extends('adminlte::page')
@section('title', 'Receipt')
@section('content_header')
<h1>Receipt</h1>
@stop 
@section('content')
@push('css')
<style>
    @media print{
        .btn, .main-footer, .main-sidebar, .content-header {
            display:none !important;
        }
        .card{
            border:none !important;
        }
        body {
            background-color: white !important;
        }
    }
    </style>
    @endpush
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h2><strong>Mall POS System</strong></h2>
                <p>123 Mall Street, City</p>
                <p>Tel: +1 234 567 890</p>
                <p>Email: mall@pos.com</p>
                <hr>
                <p>Receipt #{{ $sale->id}}</p>
                <p>Date: {{ $sale->created_at->format('M d, Y H:i')}}</p>
                <p>Cashier: Admin</p>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->saleItems as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'N/A'}}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>{{ number_format($item->price, 2) }}
                                <td>#{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <p>Subtotal: ${{ number_format($sale->total_amount, 2) }}</p>
                 <p>Tax(10%): ${{ number_format($sale->total_amount * 0.1, 2) }}</p>
                <h3>Total: ${{ number_format($sale->total_amount * 1.1, 2) }}</h3>
                <hr>
                <p><small>No refund after 24 hours</small></p>
                <p>Thank you for shopping with us!</p>
                <button class="btn btn-primary" onclick="window.print()">Print Receipt</button>
                <a href="/sales-history" class="btn btn-secondary">Back</a>



            </div>
        </div>
    </div>
</div>