@extends('adminlte::page')
@section('title', 'Sales History')
@section('content_header')
<h1>Sales History</h1>
@stop 
@section('content')

<div class="card mb-3">
    <div class="card-body">
        <form action="/sales-history" method="GET">
            <div class="row">
                <div class="col-md-4"> 
                <select name="month" class="form-control">
                    <option value="">All Months</option>
                    <option value="1" {{ request('month') == 1 ? 'selected' : ''}}>January</option>
                    <option value="2" {{ request('month') == 2 ? 'selected' : ''}}>February</option>
                    <option value="3" {{ request('month') == 3 ? 'selected' : ''}}>March</option>
                    <option value="4" {{ request('month') == 4 ? 'selected' : ''}}>April</option>
                    <option value="5" {{ request('month') == 5 ? 'selected' : ''}}>May</option>
                    <option value="6" {{ request('month') == 6 ? 'selected' : ''}}>June</option>
                    <option value="7" {{ request('month') == 7 ? 'selected' : ''}}>July</option>
                    <option value="8" {{ request('month') == 8 ? 'selected' : ''}}>August</option>
                    <option value="9" {{ request('month') == 9 ? 'selected' : ''}}>September</option>
                    <option value="10" {{ request('month') == 10 ? 'selected' : ''}}>October</option>
                    <option value="11" {{ request('month') == 11 ? 'selected' : ''}}>November</option>
                    <option value="12" {{ request('month') == 12 ? 'selected' : ''}}>December</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="year" class="form-control">
                    <option value="">All Years</option>
                    <option value="2025" {{ request('year') == 2025 ? 'selected' : ''}}>2025</option>
                     <option value="2026" {{ request('year') == 2026 ? 'selected' : ''}}>2026</option>
                      <option value="2027" {{ request('year') == 2027 ? 'selected' : ''}}>2027</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="/sales-history" class="btn btn-secondary">Clear</a>
            </div>
            </div>
        </form>
    </div>

</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h4>All Sales</h4>
    </div>
    <div class="card-body">
        <table class="table table-bprdered table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                
                <tr>
                    <td>{{ $sale->id}}</td>
                    <td>{{ $sale->created_at->format('M d, Y H:i')}}</td>
                    <td>
                        @foreach($sale->saleItems as $item)
                        <small>{{ $item->product->name ?? 'N/A'}} x{{ $item->quantity}}</small><br>
                        @endforeach
                    </td>
                    <td>${{ number_format($sale->total_amount, 2)}}</td>

                     
               

                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->created_at->format('M d, Y H:i')}}</td>
                    <td>
                        @foreach($sale->saleItems as $item)
                        <small>{{ $item->product->name ?? 'N/A'}} x{{ $item->quantity}}</small><br>
                        @endforeach
                    </td>
                    <td>${{ number_format($sale->total_amount, 2)}}</td>
                    <td>
                        <a href="/sales/{{ $sale->id }}/receipt" class="btn btn-info btn-sm">
                            Receipt
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop