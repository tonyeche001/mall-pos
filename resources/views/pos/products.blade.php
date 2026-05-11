@extends('adminlte::page')
@section('title', 'products')
@section('content_header')
<h1>Products Management</h1>
@stop 
@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }} </div>
@endif

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Add New Product</h4>
    </div>
    <div class="card-body">
        <form action="/products" method="POST">
            @csrf 
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>

                </div>
                <div class="col-md-3">
                    <input type="text" name="category" class="form-control" placeholder="Category" required>

                </div>
                <div class="col-md-2">
                    <input type="number" name="price" class="form-control" placeholder="Price" required>

                </div>
                <div class="col-md-2">
                    <input type="number" name="stock" class="form-control" placeholder="Stock" required>

                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">Add Product </button>

                </div>
                

            </div>
        </form>
    </div>
</div>


<div class="card mt-4">
    <div class="card-header bg-dark text-white">
        <h4>All Products</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                     <td>{{ $product->name}}</td>
                      <td>{{ $product->category}}</td>
                       <td>${{ number_format($product->price, 2)}}</td>
                        <td>{{ $product->stock}}</td>
                        <td>
                            <form action="/products/{{ $product->id}}" method="POST"
                            style="display:inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick=
                            "return confirm('Delete this product?')">Delete</button>
                            <td> 

                            <button type="button" class="btn btn-warning btn-sm"
                            data-toggle="modal" data-target="#editModal{{$product->id}}">Edit</button>

                            <form action="/products/ {{$product->id}}" method="POST" style="display:inline">
                                @csrf 
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this product ?')">Delete</button>
                            </form>
                            </td>

                        </form>
                        </td>
                </tr>
                
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@foreach($products as $product)
                <div class="modal fade" id="editModal{{ $product->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">Edit Product</h5>
                            </div>
                            <form action="/products/{{ $product->id}}" method="POST">
                                @csrf 
                                @method('PUT')
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control mb-2"
                                    value="{{$product->name}}" required>
                                    <input type="text" name="category" class="form-control mb-2"
                                    value="{{$product->category}}" required>
                                    <input type="number" name="price" class="form-control mb-2"
                                    value="{{$product->price}}" required>
                                    <input type="number" name="stock" class="form-control mb-2"
                                    value="{{$product->stock}}" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                     <button type="button" class="btn btn-secondary"
                                     data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

@stop