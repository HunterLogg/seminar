@extends('app.layouts.layout')
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">WishList Items</h2>
        @foreach ($wishlists as $key => $product)
        @if ($product->status == 1)
            <?php continue; ?>
        @endif
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="http://127.0.0.1:9000/product/image/{{ $product->image }}" alt="" />
                                <p>{{ $product->name }}</p>
                                <h2>{{ number_format($product->price ) }}đ</h2>
                                <form action="/wishlist" method="POST">
                                    @csrf
                                <input type="hidden" name="wishlist_id" value="{{$product->id}}" style="margin-bottom: 5px">
                                <input type="hidden" name="qty" value="1" style="margin-bottom: 5px">
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                <button type="submit" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                                </form>
                            </div>
                            
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="/wishlist/destroy/{{$product->id}}"><i class="fa fa-plus-square"></i>Delete wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-center text-center-xs col-sm-12">                
            <div class="text-center text-center-xs">                
              <div>{{ $wishlists->links() }}</div>
            </div>
        </div>
        
    </div><!--features_items-->
</div>
@endsection