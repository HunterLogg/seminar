@extends('admin.layouts.sidebar')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
     <div class="panel-heading">
      {{ $title }}
     </div>
     <div class="row w3-res-tb">
      <div class="col-sm-7 m-b-xs">
            
      </div>
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <form action="/admin/product">
        <div class="input-group">
          <input name="search" type="text" class="input-sm form-control" placeholder="Search" value="{{app('request')->input('search')}}">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-sm btn-default">Search</button>
          </span>
        </div>
        </form>

      </div>
    </div>
     <div>
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
             <th>Product Description</th>
             <th>Product Price</th>
             <th>Product Quantity</th>
             <th>Category Name</th>
             <th>Brand Name</th>
             <th>Image</th>
             <th data-breakpoints="xs">Status</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($products as $key => $product)
             
           <tr data-expanded="true">
             <td>{{ app('request')->input('page') == null ? $key + 1 : (5 * app('request')->input('page')) + $key + 1   }}</td>
             <td>{{ $product->name }}</td>
             <td>{{ $product->description }}</td>
             <td>{{ number_format($product->price) }} VND</td>
             <td>{{ $product->quantity }}</td>
             @foreach ($categories as $key => $cate)
                @if ($cate->id == $product->category_id)
                  <td>{{ $cate->name }}</td>
                  <?php break; ?>
                @endif               
             @endforeach
             @foreach ($brands as $key => $brand)
                @if ($brand->id == $product->brand_id)
                  <td>{{ $brand->name }}</td>
                  <?php break; ?>
                @endif               
             @endforeach
             @if ($product->image)
              <td><img src="http://127.0.0.1:9000/product/image/{{ $product->image }}" alt="" width="100px" height="100px"></td>
             @endif
             <td>{{ ($product->active == '1') ? 'Active' : 'No Active' }}</td>
             
             <td>

              <button class="btn" onclick="editProduct('/admin/product/{{ $product->id }}/edit')"><i class="fa fa-pencil-square-o text-success text-active"></i></button>
              <button class="btn" onclick="removeProduct('{{ $product->id }}', '/admin/product/{{ $product->id }}')"><i class="fa fa-trash-o text-danger text"></i></button>
              <button class="btn" onclick="detailProduct('{{ $product->id }}', '/admin/product/{{ $product->id }}')"><i class="fa fa-info-circle text-warning text"></i></button>
            </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{ $count }} of {{ $all }} items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <div class="col-sm-7 text-right text-center-xs">                
            <div>{{ $products->appends(['search' => app('request')->input('search')])->links() }}</div>
          </div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection