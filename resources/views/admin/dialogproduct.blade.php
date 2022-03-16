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
                            @if (isset($product))
                            <form action="/admin/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $product->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Category Description" value="{{ $product->description }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Category Content" value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Product Price" value="{{ $product->quantity }}">
                                </div>
                                <label for="category_id">Select Category</label>
                                <select class="form-control m-bot15" id="category_id" name="category_id">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $key => $cate)
                                        <option value="{{ $cate->id }}" {{ $product->category_id == $cate->id ? 'selected' : "" }}>{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand_id">Select Brand</label>
                                <select class="form-control m-bot15" id="brand_id" name="brand_id">
                                    <option value="" selected>Select Brand</option>
                                    @foreach ($brands as $key => $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : "" }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="image">
                                </div>
                                <img id="img_review" src="" alt="">
                                <input type="hidden" name="_method" value="patch">
                                <div class="form-group">
                                    <label for="active">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault1" value="1" {{ ($product->active == '1') ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="flexRadioDefault1">
                                           Active
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="flexRadioDefault2" value="0" {{ ($product->active == '1') ? '' : 'checked' }}>
                                        <label class="form-check-label text-danger" for="flexRadioDefault2">
                                           No Active
                                        </label>
                                      </div>
                                </div>
                                

                                <a href="/admin/product" class="btn btn-success">Back To List</a>

                            @else
                            <form role="form" action="/admin/product" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" >
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Product Description">
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Product Price">
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Product Price">
                                </div>
                                <label for="category_id">Select Category</label>
                                <select class="form-control m-bot15" id="category_id" name="category_id">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand_id">Select Brand</label>
                                <select class="form-control m-bot15" id="brand_id" name="brand_id">
                                    <option value="" selected>Select Brand</option>
                                    @foreach ($brands as $key => $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <label for="images">Image</label>
                                    <input type="file"id="images" name="image">
                                </div>
                                <img id="img_review" src="" alt="">
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
                            @csrf
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        
    </div>
    <!-- page end-->
    </div>
    <script>
    $(document).ready(function (e) {

        $(function() {
            $("#images").change(function() {
                console.log(this.files[0])
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $("#images").css("color","red");
                    $('#img_review').css("display", "none");
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $("#images").css("color","green");
            $('#img_review').css("display", "block");
            $('#img_review').attr('src', e.target.result);
            $('#img_review').attr('width', '250px');
            $('#img_review').attr('height', '240px');
        };
    })
    </script>
@endsection