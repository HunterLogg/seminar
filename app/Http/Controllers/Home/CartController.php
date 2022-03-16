<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index(){
        $subtotal = 0;
        $carts = [];
        $cart_count = 0 ;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get()->count();
            $carts = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->paginate(5);
            $items = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get();
            foreach($items as $item){
                $subtotal += $item->price * $item->qty;
            }
        }
        return view('app.cart')->with(['carts' => $carts,'subTotal' => $subtotal,'cart_count' => $cart_count]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $product = Product::find($input['product_id']);
        $data['qty'] = $input['qty'];
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $product->id;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['image'] = $product ->image;
        $data['status'] = 0;
        $check = Cart::where('status','!=', 1)->where('user_id', Auth::user()->id)->where('name', $product->name)->first();
        if($check)
        {
            $check->qty += $data['qty'];
            $check->save();
        }else {
            Cart::create($data);
        }
        return redirect('/cart');

    }

    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $cart = Cart::find($input['id']);
        $cart['qty'] = $input['qty'];
        if($input['qty'] > 0){
            $cart->save();
        }
        else {
            $cart->delete();
        }
        $carts = Cart::all();
        return $carts;
        
    }

    public function destroy($id)
    {
        //
        $cart = Cart::find($id);
        if(!$cart){
            return Response('Category does not exist.', 404);
        }
        $cart->delete();

        return true;

    }
}
