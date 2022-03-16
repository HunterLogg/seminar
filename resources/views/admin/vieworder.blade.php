@extends('admin.layouts.sidebar')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
     <div class="panel-heading">
        Infor User
     </div>
    <div class="table-responsive">
       <table class="table" ui-jq="footable" ui-options="{
         &quot;paging&quot;: {
           &quot;enabled&quot;: true
         },
         &quot;filtering&quot;: {
           &quot;enabled&quot;: true
         },
         &quot;sorting&quot;: {
           &quot;enabled&quot;: true
         }}">
         <thead>
           <tr>
             <th>Customer Name</th>
             <th>Phone Number</th>
             <th>Address</th>

           </tr>
         </thead>
         <tbody>
            @foreach($listOrders as $key => $order)
            <tr data-expanded="true">
             <td>{{ $order->name }}</td>
             <td>{{ $order->phone }}</td>
             <td>{{ $order->address }}</td>
             <?php break; ?>
            </tr>
            @endforeach
         </tbody>
       </table>
     </div>
   </div>
    <br>
   <div class="panel panel-default">
    <div class="panel-heading">
      Infor of shipping
    </div>
   <div class="table-responsive">
      <table class="table" ui-jq="footable" ui-options="{
        &quot;paging&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;filtering&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;sorting&quot;: {
          &quot;enabled&quot;: true
        }}">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Method</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
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
  </div>
  <br>
  <div class="panel panel-default">
    <div class="panel-heading">
      Infor of order
    </div>
   <div class="table-responsive">
      <table class="table" ui-jq="footable" ui-options="{
        &quot;paging&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;filtering&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;sorting&quot;: {
          &quot;enabled&quot;: true
        }}">
        <thead>
          <tr>
            <th data-breakpoints="xs">Serial</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Product Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
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
    </div>
    <footer class="panel-footer">
     <div class="row">
       
       <div class="col-sm-5 text-center">
         <small class="text-muted inline m-t-sm m-b-sm">showing  items</small>
       </div>
       <div class="col-sm-7 text-right text-center-xs">                
         <div class="col-sm-7 text-right text-center-xs">                
           <div>{{ $listOrders->links() }}</div>
         </div>
       </div>
     </div>
   </footer>
  </div>

 </div>
@endsection