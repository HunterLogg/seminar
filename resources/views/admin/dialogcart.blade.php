@extends('admin.layouts.sidebar')
@section('content')
<div class="form-w3layouts">
    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            @if (isset($cart))
                            <form action="/admin/cart/{{ $cart->id }}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Quantity</label>
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Product Name" value="{{$cart->qty}}" >
                                </div>
                                <div class="form-group">
                                    <label for="description">User</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter Category Description" value="{{ $cart->user_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" placeholder="Enter Category Description" value="{{ $cart->status }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Select Product</label>
                                    <select class="form-control m-bot15" id="product" name="product">
                                        @foreach ($products as $key => $product)
                                            <option value="{{ $product->id }}" {{ $product->id == $cart->id ? 'selected' : "" }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="_method" value="patch">
                                <a href="/admin/cart" class="btn btn-success">Back To List</a>

                            @else
                            <form role="form" action="/admin/cart" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Quantity</label>
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Product Name" >
                                </div>
                                <div class="form-group">
                                    <label for="description">User</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter Product Description">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Select Product</label>
                                    <select class="form-control m-bot15" id="product" name="product">
                                        <option selected>Select Product</option>
                                        @foreach ($products as $key => $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            
                            @if (Session::has('error'))
				                <p style="color: #F53718; !important">{{ Session::get('error') }}</p>
			                @endif
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            @csrf
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        
    </div>
    <!-- page end-->
    </div>
@endsection