@extends('app.layouts.header')
@section('contents')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Payment</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($carts as $index => $cart)
                    <tr>
                        <td class="cart_product">
                            <img src="http://127.0.0.1:9000/product/image/{{ $cart->image }}" alt="" style="width: 50px">
                        </td>
                        <td class="cart_description">
                            <h4><span href="" onclick="viewProduct('/detail/{{ $cart->product_id }}')">{{$cart->name}}</span></h4>
                            <p>Web ID: {{$cart->product_id}}</p>
                        </td>
                        <td class="cart_price ">
                            <p class="cart_price">{{number_format($cart->price)}}VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="btn cart_quantity_down" onclick="preqty({{$cart->id}})"> - </a>
                                <input class="cart_quantity_input qty-{{$cart->id}}" type="text" name="" value="{{ $cart->qty }}" autocomplete="off" size="2" disabled>
                                <a class="btn cart_quantity_up" onclick="nextqty({{$cart->id}})"> + </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price cart_total_price_{{$cart->id}}">{{number_format($cart->price * $cart->qty)}} VND</p>
                        </td>
                        <td class="cart_delete" style="padding-right: 5px">
                            <a class="cart_quantity_delete" onclick="removeCart('{{ $cart->id }}', '/cart/{{ $cart->id }}')" ><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tbody><tr>
                                    <td>Cart Sub Total</td>
                                    <td>{{number_format($subTotal)}} VND</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>{{number_format($subTotal * 0.02)}} VND</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>{{number_format($subTotal + $subTotal * 0.02)}} VND</span></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center text-center-xs">                
                <div class="text-center text-center-xs">                
                  <div>{{ $carts->links() }}</div>
                </div>
            </div>
        </div>
        <div class="payment-options">
            <h4>Select a payment method </h4>
            <form action="/payment" method="POST">
                @csrf
                <select name="method">
                    <option value="Direct Bank Transfer" selected>Direct Bank Transfer</option>
                    <option value="Get cash">Get cash</option>
                    <option value="Debit card ">Debit card </option>
                </select>
                <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Order</button>
            </form>
        </div>
    </div>
</section>

@endsection
