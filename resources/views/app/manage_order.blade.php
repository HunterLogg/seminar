@extends('app.layouts.header')
@section('contents')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Order</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td data-breakpoints="xs">Serial</td>
                        <td>Customer Name</td>
                        <td>Total Price</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($orders as $key => $order)
                    <tr>
                        <td class="cart_product">
                            {{ app('request')->input('page') == null ? $key + 1 : (5 * (app('request')->input('page') - 1)) + $key + 1   }}
                        </td>
                        <td class="cart_description">
                            <a href="/vieworder/{{ $order->id }}" style="color: rgb(41, 238, 100)">{{ $order->name }}</a>
                        </td>
                        <td class="cart_price ">
                            <p class="cart_price">{{ number_format($order->order_total) }} VND</p>
                        </td>
                        <td class="cart_quantity">
                            {{ $order->order_status }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @guest
            @else
            <div class="text-center text-center-xs">                
                <div class="text-center text-center-xs">                
                  <div>{{ $orders->links() }}</div>
                </div>
            </div>
            @endguest
        </div>
    </div>
</section>
@endsection
