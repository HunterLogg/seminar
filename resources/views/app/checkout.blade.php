@extends('app.layouts.header')
@section('contents')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12">
                    <div class="shopper-info">
                        <p>Shipping Information</p>
                        <form action="/checkout" method="POST">
                            @csrf
                            <input type="text" name="email" placeholder="Email*">
                            <input type="text" name="name" placeholder="Name* ">
                            <input type="text" name="address" placeholder="Address* ">
                            <input type="text" name="phone" placeholder="Phone*">
                            <select name="type">
                                <option value="Ship tận nhà" selected>Ship tận nhà</option>
                                <option value="Ship trong ngày">Ship trong ngày</option>
                                <option value="Ship hàng thu tiền hộ">Ship hàng thu tiền hộ</option>
                            </select>
                            <div class="order-message">
                                <p>Shipping Order</p>
                                <textarea name="note" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea>
                            </div>	
                            @if (Session::has('error'))
                                <p style="color: #F53718; !important">{{ Session::get('error') }}</p>
                            @endif
                            <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Send</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
