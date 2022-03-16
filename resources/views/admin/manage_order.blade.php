@extends('admin.layouts.sidebar')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
     <div class="panel-heading">
      {{ $title }}
     </div>
     <div class="row w3-res-tb">
      <div class="col-sm-7 m-b-xs">
        <form action="/admin/order" method="GET">
        <select class="input-sm form-control w-sm inline v-middle" name='search_user'>
          <option value="">Search for user</option>
          @foreach ($users as $user)
          <option value="{{$user->id}}" {{app('request')->input('search_user') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-default">Apply</button>    
        </form>            
      </div>
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <form action="/admin/order/pdf" method="POST">
          @csrf
          <div class="input-group">
            <select class="input-sm form-control w-sm inline v-middle" name='id'>
              <option value="">Choose one to export</option>
              @foreach ($orders as $key => $order)
              <option value="{{$order->id}}" >{{$order->id}}</option>
              @endforeach
            </select>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm btn-success">Export PDF</button>
            </span>
          </div>
          </form>
      </div>
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
             <th>Customer Name</th>
             <th>Total Price</th>
             <th>Status</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($orders as $key => $order)
           <tr data-expanded="true">
             <td>{{ app('request')->input('page') == null ? $key + 1 : (5 * (app('request')->input('page') - 1)) + $key + 1   }}</td>
             
             <td><a href="/admin/vieworder/{{ $order->id }}" style="color: rgb(41, 238, 100)">{{ $order->name }}</a></td>
             <td>{{ number_format($order->order_total) }} VND</td>
             <td>{{ $order->order_status }} </td>
             <td>
               @if ($order->order_status === 'Đang chờ xử lý')
                <button class="btn btn-primary" onclick="shipping({{$order->shipping_id}},'Vận chuyển', '','/admin/order/shipping/{{ $order->id }}')">Vận chuyển </button>
               @endif
               @if ($order->order_status === 'Vận chuyển')
                <button class="btn btn-success" onclick="shipping({{ $order->shipping_id }}, 'Đã giao', 'Ok' ,'/admin/order/shipping/{{ $order->id }}')">Đã giao hoàn tất </button>
               @endif

                <button class="btn" onclick="viewOrder('/admin/vieworder/{{ $order->id }}')"><i class="fa fa-eye text-success text-active"></i></button>
                <button class="btn" onclick="removeOrder('{{ $order->id }}', '/admin/order/{{ $order->id }}')"><i class="fa fa-trash-o text-danger text"></i></button>
                <button class="btn" onclick="detailOrder('/admin/order/{{ $order->id }}')"><i class="fa fa-info-circle text-warning text"></i></button>
            </td>
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
            <div>{{ $orders->links() }}</div>
          </div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection