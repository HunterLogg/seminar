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
        <form action="/admin/brand" method="GET">
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
             <th>Brand name</th>
             <th>Brand description</th>
             <th>Brand content</th>
             <th data-breakpoints="xs">Status</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($brandlist as $key => $brand)
             
           <tr data-expanded="true">
             <td>{{ $brand->id }}</td>
             <td>{{ $brand->name }}</td>
             <td>{{ $brand->description }}</td>
             <td>{{ $brand->content }}</td>
             <td>{{ ($brand->active == '1') ? 'Active' : 'No Active' }}</td>
             
             <td>
              <button class="btn" onclick="editCategory('/admin/brand/{{ $brand->id }}/edit')"><i class="fa fa-pencil-square-o text-success text-active"></i></button>
              <button class="btn" onclick="removeCategory('{{ $brand->id }}', '/admin/brand/{{ $brand->id }}')"><i class="fa fa-trash-o text-danger text"></i></button>
              <button class="btn" onclick="detailCategory('{{ $brand->id }}', '/admin/brand/{{ $brand->id }}')"><i class="fa fa-info-circle text-warning text"></i></button>
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
          <div>{{ $brandlist->appends(['search' => app('request')->input('search')])->links() }}</div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection