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
             <th>User name</th>
             <th>Email</th>
             <th>role</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach ($users as $key => $user)
             
           <tr data-expanded="true">
             <td>{{ $user->id }}</td>
             <td>{{ $user->name }}</td>
             <td>{{ $user->email }}</td>
             <td>{{ ($user->role == '1') ? 'Admin' : 'Customer' }}</td>
             <td>
              <button class="btn" onclick="editUser('/admin/user/{{ $user->id }}/edit')"><i class="fa fa-pencil-square-o text-success text-active"></i></button>
            </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing </small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <div>{{ $users->links() }}</div>
        </div>
      </div>
    </footer>
   </div>
 </div>
@endsection