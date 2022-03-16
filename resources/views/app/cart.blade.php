@extends('app.layouts.header')
@section('contents')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Shopping Cart</li>
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
                </tbody>
            </table>
            @guest
            @else
            <div class="text-center text-center-xs">                
                <div class="text-center text-center-xs">                
                  <div>{{ $carts->links() }}</div>
                </div>
            </div>
            @endguest
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            {{-- <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p> --}}
        </div>
        {{-- <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping &amp; Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div> --}}
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>{{number_format($subTotal)}} VND</span></li>
                        <li>Eco Tax <span>{{number_format($subTotal * 0.02)}} VND</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{number_format($subTotal + $subTotal * 0.02)}} VND</span></li>
                    </ul>
                        <a class="btn btn-default check_out" href="/checkout">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
