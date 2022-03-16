<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Product;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wishlist = Wishlist::join('products','wishlists.product_id','=','products.id')
        ->select('products.*','wishlists.*')->paginate(4);
        $category = Category::all();
        $brand = Brand::all();
        return view('app.wishlist')->with(['wishlists'=> $wishlist ,'categories' => $category, 'brands' => $brand, 'title' => 'List Product' ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $input['user_id'] = Auth::user()->id;
        $input['product_id'] = $id;
        $input['status'] = 0;
        $check = Wishlist::where('user_id' ,'=',Auth::user()->id)->where('product_id','=',$id)->where('status','!=',1)->first();
        if($check){
            return redirect('/wishlist');
        }
        Wishlist::create($input);
        return redirect('/wishlist');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input = $request->all();
        $wishlist = Wishlist::find($input['wishlist_id']);
        $wishlist->status = 1;
        $wishlist->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $wishlist = Wishlist::find($id);
        if(!$wishlist){
            return Response('Category does not exist.', 404);
        }
        $wishlist->delete();

        return redirect('/wishlist');
    }
}
