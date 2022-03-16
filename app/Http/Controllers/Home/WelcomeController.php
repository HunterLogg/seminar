<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        //
        $products = Product::all()->random(6);
        $recommend = Product::all()->random(6);
        $category = Category::all()->where('active', '=' , 1);
        $brand = Brand::all()->where('active', '=' , 1);
        $cart_count = 0;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id] ,['status' , '=' ,'0']])->get()->count();
        }
        return view('app.welcome')->with(['products'=> $products, 'categories' => $category, 'brands' => $brand, 'title' => 'List Product', 'recommend' => $recommend,'cart_count' => $cart_count ]);
    }

    public function detailProduct($id)
    {
        //
        $product = Product::find($id);
        $recommend = Product::all()->random(6);
        $category = Category::all();
        $brand = Brand::all();
        $cart_count = 0 ;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id] ,['status' , '=' ,'0']])->get()->count();
        }
        return view('app.detail')->with(['product'=> $product, 'categories' => $category, 'brands' => $brand, 'title' => 'List Product', 'recommend' => $recommend,'cart_count' => $cart_count ]);
    }
}
