<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $products = Product::paginate(9);
        if($request->search){
            $products = Product::where('name','like', '%'.$request->search.'%')->paginate(9);
        }
        $count = $products->count();
        $category = Category::all();
        $brand = Brand::all();
        $all = Product::all()->count();
        $cart_count = 0 ;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get()->count();
        }
        return view('app.products')->with(['products'=> $products, 'count' => $count,'all' => $all ,'categories' => $category, 'brands' => $brand, 'title' => 'List Product','cart_count' => $cart_count ]);
    }

    public function show($id)
    {
        //
        $cart_count = 0 ;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get()->count();
        }
        $brand_id = Brand::where('name', 'like', $id)->where('content','like','Laptop PC')->first();
        if($brand_id){
            $products = Product::where('brand_id', '=' , $brand_id['id'])->paginate(9);
            $count = $products->count();
            $category = Category::all();
            $brand = Brand::all();
            $all = Product::all()->count();
            return view('app.products')->with(['products'=> $products, 'count' => $count,'all' => $all ,'categories' => $category, 'brands' => $brand, 'title' => 'List Product','cart_count' => $cart_count]);
        }
        else{
            $brand_id = Brand::where('name', 'like', $id)->first();
            $product = Product::where('brand_id', 'like', $brand_id['id'])->first();
            $recommend = Product::all()->random(6);
            $category = Category::all();
            $brand = Brand::all();
            return view('app.detail')->with(['product'=> $product, 'categories' => $category, 'brands' => $brand, 'title' => 'List Product', 'recommend' => $recommend,'cart_count' => $cart_count]);
        }
        
    }
}
