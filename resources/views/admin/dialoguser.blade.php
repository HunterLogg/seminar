@extends('admin.layouts.sidebar')
@section('content')
<div class="form-w3layouts">
    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            @if (isset($users))
                            <form action="/admin/user/{{ $users->id }}" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $users->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Category Description" value="{{ $users->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Category Content" >
                                </div>
                                <div class="form-group">
                                    <label for="active">Role</label>
                                    <select class="form-control m-bot15" id="role" name="role">
                                        <option value="0" {{ $users->role == 0 ? 'selected' : ''}}>Customer</option>
                                        <option value="1" {{ $users->role == 1 ? 'selected' : ''}}>Admin</option>
                                    </select>
                                </div>
                                <input type="hidden" name="_method" value="patch">

                                
                            @else
                            <form action="/admin/user" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Category Description">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Category Content">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Re-Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Category Content">
                                </div>
                                <div class="form-group">
                                    <label for="active">Role</label>
                                    <select class="form-control m-bot15" id="role" name="role">
                                        <option value="0" selected>Customer</option>
                                        <option value="1" >Admin</option>
                                    </select>
                                </div>
                            @endif
                            
                            @if (Session::has('error'))
				                <p style="color: #F53718; !important">{{ Session::get('error') }}</p>
			                @endif
                            
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="/admin/category" class="btn btn-info">Back To List</a>
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        
    </div>
    


    <!-- page end-->
    </div>
@endsection