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
                            @if (isset($brand))
                            <form action="/admin/brand/{{ $brand->id }}" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Brand Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $brand->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Brand description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description" value="{{ $brand->description }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Brand Content</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Enter Category Content" value="{{ $brand->content }}">
                                </div>
                                <label for="category_id">Select Category</label>
                                <select class="form-control m-bot15" id="category_id" name="category_id">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $key => $cate)
                                        <option value="{{ $cate->id }}" {{ $brand->category_id == $cate->id ? 'selected' : "" }}>{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <label for="active">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" {{ ($brand->active == '1') ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="flexRadioDefault1">
                                           Active
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0" {{ ($brand->active == '1') ? '' : 'checked' }}>
                                        <label class="form-check-label text-danger" for="flexRadioDefault2">
                                           No Active
                                        </label>
                                      </div>
                                </div>
                                <input type="hidden" name="_method" value="patch">

                                <a href="/admin/brand" class="btn btn-success">Back To List</a>

                            @else
                            <form action="/admin/brand" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Brand Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" >
                                </div>
                                <div class="form-group">
                                    <label for="description">Brand description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description">
                                </div>
                                <div class="form-group">
                                    <label for="content">Brand Content</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Enter Category Content">
                                </div>
                                <label for="category_id">Select Category</label>
                                <select class="form-control m-bot15" id="category_id" name="category_id">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <label for="active">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" checked>
                                        <label class="form-check-label text-success" for="flexRadioDefault1">
                                           Active
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0">
                                        <label class="form-check-label text-danger" for="flexRadioDefault2">
                                           No Active
                                        </label>
                                      </div>
                                </div>
                            @endif
                            
                            @if (Session::has('error'))
				                <p style="color: #F53718; !important">{{ Session::get('error') }}</p>
			                @endif
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        
    </div>
    


    <!-- page end-->
    </div>
@endsection