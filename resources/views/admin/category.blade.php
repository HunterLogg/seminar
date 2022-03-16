@extends('admin.layouts.sidebar')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
     <div class="panel-heading">
      {{ $title }}
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
             <th>Category name</th>
             <th>Category description</th>
             <th>Category content</th>
             <th data-breakpoints="xs">Category Status</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($categoryList as $key => $cate)
             
           <tr data-expanded="true">
             <td>{{ $cate->id }}</td>
             <td>{{ $cate->name }}</td>
             <td>{{ $cate->description }}</td>
             <td>{{ $cate->content }}</td>
             <td>{{ ($cate->active == '1') ? 'Active' : 'No Active' }}</td>
             
             <td>
              <button class="btn" onclick="editCategory('/admin/category/{{ $cate->id }}/edit')"><i class="fa fa-pencil-square-o text-success text-active"></i></button>
              <button class="btn" onclick="removeCategory('{{ $cate->id }}', '/admin/category/{{ $cate->id }}')"><i class="fa fa-trash-o text-danger text"></i></button>
              <button class="btn" onclick="detailCategory('{{ $cate->id }}', '/admin/category/{{ $cate->id }}')"><i class="fa fa-info-circle text-warning text"></i></button>
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
          <div>{{ $categoryList->links() }}</div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection