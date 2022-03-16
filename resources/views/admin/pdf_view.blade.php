<!DOCTYPE html>
<html>
<head>
    <title>PDF</title>
</head>
<body>
  <h1>Order info of @foreach($listOrders as $key => $order)
     {{ $order->name }}
     <?php break; ?>
    </tr>
    @endforeach </h1>
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
              </tr>
               <?php break; ?>
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
              </tr>
               <?php break; ?>
              @endforeach
              
            </tr>
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
         <h1 class="col-sm-5 text-center">
            Total bill : <span>@foreach ($listOrders as $key => $order)
                {{ number_format($order->order_total) }} VND
                 <?php break; ?>
                @endforeach</span>
         </h1>
         
       </div>
     </footer>
    </div>
  
   </div>
</body>
</html>