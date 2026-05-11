@extends('adminlte::page')
@section('title', 'POS Sales')
@section('content_header')
<h1>Point of Sales</h1>
@stop 

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success')}}</div>
@endif 
<div class="card mb-3 col-md-4">
    <div class="card-body">
        <input type="text" id="searchProduct" class="form-control"
        placeholder="Search product by name..">
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Products</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3 mb-3 product-card">
                        <div class="card text-center border-primary">
                            <div class="card-body p-2">
                                <h6 class="product-name">{{ $product->name}}</h6>
                                <p class="text-success">${{ $product->price }}</p>
                                <small>Stock:{{ $product->stock}}</small>
                                <br>
                                <button class="btn btn-primary btn-sm mt-1" onclick="addToCart(this);" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add</button>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4>Cart</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cartItems"></tbody>
            </table>
            <hr>
            <h4>Total: $<span id="cartTotal">0.00</span></h4>
            <form action="/sales" method="POST" id="saleForm">
                @csrf 
                <input type="hidden" name="cart" id="cartData">
                <button type="button" class="btn btn-success btn-block" onclick="submitSale()">
                     Process Sale
                </button>
            </form>
            <button class="btn btn-danger btn-block mt-2" onclick="clearCart()">Clear Cart</button>

        </div>
    </div>
</div>
</div>


<script>
    var cart = [];
    function addToCart(btn) {
        var id = btn.getAttribute('data-id');
        var name = btn.getAttribute('data-name');
        var price = parseFloat(btn.getAttribute('data-price'));

        cart.push({id: id, name: name, price: price, quantity: 1});
        var tbody = document.getElementById('cartItems');
        var row = '<tr><td>' + name + '</td><td>1</td><td>$' + price.toFixed(2) + '</td></tr>';
        tbody.innerHTML += row;

        var totalEL = document.getElementById('cartTotal');
        var current = parseFloat(totalEL.innerText);
        totalEL.innerText = (current + price).toFixed(2);
    }
    function prepareCart() {
        if (cart.length == 0) {
            alert('Cart is empty!');
            return false
        }
    }
    function clearCart() {
        cart = [];
        document.getElementById('cartItems').innerHTML = '';
        document.getElementById('cartTotal').innerText = '0.00';
    }
    function submitSale() {
        if (cart.length== 0) {
            alert('Cart is empty!')
            return;
        }
        document.getElementById('cartData').value = JSON.stringify(cart);
        
        document.getElementById('saleForm').submit();
    }
    document.getElementById('searchProduct').addEventListener('keyup', function(){
        var search = this.value.toLowerCase();
        var cards =  document.querySelectorAll('.product-card');
        cards.forEach(function(card) {
            var nameElement = card.querySelector('.product-name');
            if (nameElement) {
                var name = nameElement.innerText.toLowerCase();
                if (name.includes(search)) {
                    card.style.display='block';
                }
                else {
                    card.style.display='none';
                }
            }
        });
});
       


   
</script>

@stop