@extends('app.layouts.header')
@section('contents')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">View Order</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <div class="panel-heading">
                Infor User
             </div>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td>Customer Name</td>
                        <td>Phone Number</td>
                        <td>Address</td>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($listOrders as $key => $order)
                    <tr data-expanded="true">
                        <td class="cart_product">{{ $order->name }}</td>
                        <td class="cart_description">{{ $order->phone }}</td>
                        <td  class="cart_price ">{{ $order->address }}</td>
                        <?php break; ?>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive cart_info">
            <div class="panel-heading">
                Infor of shipping
            </div>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Method</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($listOrders as $key => $order)
                    <tr data-expanded="true">
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->type }}</td>
                        <td>{{ $order->note }}</td>
                     <?php break; ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td data-breakpoints="xs">Serial</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Product Price</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($listOrders as $key => $order)
                    <tr data-expanded="true">
                      <td>{{ app('request')->input('page') == null ? $key + 1 : (5 * (app('request')->input('page') - 1)) + $key + 1   }}</td>
                      
                      <td>{{ $order->product_name }}</td>
                      <td>{{ $order->product_quantity }} </td>
                      <td>{{ number_format($order->product_price) }} VND</td>
                      <td>{{ number_format($order->total) }} VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center text-center-xs">                
                <div class="text-center text-center-xs"> 
                    <div>{{ $listOrders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
