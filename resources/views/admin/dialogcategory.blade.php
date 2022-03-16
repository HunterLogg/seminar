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
                            @if (isset($category))
                            <form action="/admin/category/{{ $category->id }}" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Category description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description" value="{{ $category->description }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Category Content</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Enter Category Content" value="{{ $category->content }}">
                                </div>
                                <input type="hidden" name="_method" value="patch">

                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" {{ ($category->active == '1') ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="flexRadioDefault1">
                                           Yes
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0" {{ ($category->active == '1') ? '' : 'checked' }}>
                                        <label class="form-check-label text-danger" for="flexRadioDefault2">
                                           No
                                        </label>
                                      </div>
                                </div>
                            @else
                            <form action="/admin/category" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" >
                                </div>
                                <div class="form-group">
                                    <label for="description">Category description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description">
                                </div>
                                <div class="form-group">
                                    <label for="content">Category Content</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Enter Category Content">
                                </div>
                                <div class="form-group">
                                    <label for="active">Active</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" checked>
                                        <label class="form-check-label text-success" for="flexRadioDefault1">
                                           Yes
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0">
                                        <label class="form-check-label text-danger" for="flexRadioDefault2">
                                           No
                                        </label>
                                      </div>
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