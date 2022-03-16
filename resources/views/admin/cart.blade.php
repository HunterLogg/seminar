@extends('admin.layouts.sidebar')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
     <div class="panel-heading">
      {{ $title }}
     </div>
     <div class="row w3-res-tb">
      <div class="col-sm-7 m-b-xs">
        <form action="/admin/cart">
        <select class="input-sm form-control w-sm inline v-middle" name='search_product'>
          <option value="">Search for product</option>
          @foreach ($products as $product)
          <option value="{{$product->id}}" {{app('request')->input('search_product') == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
          @endforeach
        </select>
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
        <form action="/admin/cart">
        <div class="input-group">
          <input name="search" type="text" class="input-sm form-control" placeholder="Search" value="{{app('request')->input('search')}}">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-sm btn-default">Search</button>
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
             <th>User</th>
             <th>Product Name</th>
             <th>Image</th>
             <th>Price</th>
             <th>Quantity</th>
             <th data-breakpoints="xs">total</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($carts as $key => $cart)
             
           <tr data-expanded="true">
             <td>{{ app('request')->input('page') == null ? $key + 1 : (5 * (app('request')->input('page') - 1)) + $key + 1   }}</td>
             @foreach ($users as $item)
                 @if ($item['id'] == $cart['user_id'])
                    <td>{{ $item['name'] }}</td>
                 @endif
             @endforeach
             <td>{{ $cart->name }}</td>
             @if ($cart->image)
              <td><img src="http://127.0.0.1:9000/product/image/{{ $cart->image }}" alt="" width="100px" height="100px"></td>
             @endif
             <td>{{ number_format($cart->price) }} VND</td>
             <td>{{ $cart->qty }} </td>
             <td>{{ number_format($cart->price * $cart->qty) }} VND</td>
             <td>
                <button class="btn" onclick="editCart('/admin/cart/{{ $cart->id }}/edit')"><i class="fa fa-pencil-square-o text-success text-active"></i></button>
                <button class="btn" onclick="removeCart('{{ $cart->id }}', '/admin/cart/{{ $cart->id }}')"><i class="fa fa-trash-o text-danger text"></i></button>
                <button class="btn" onclick="detailCart('{{ $cart->id }}', '/admin/cart/{{ $cart->id }}')"><i class="fa fa-info-circle text-warning text"></i></button>
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
            <div>{{ $carts->appends(['search_product' => app('request')->input('search_product'),'search' => app('request')->input('search'),'search_user' => app('request')->input('search_user')])->links() }}</div>
          </div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection