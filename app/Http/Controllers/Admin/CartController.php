<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->query('search_product') || $request->query('search_user')){
            if($request->query('search_product') && $request->query('search_user') ){
                $carts = Cart::where([['product_id','=',$request->query('search_product')], ['user_id','=',$request->query('search_user')]])->paginate(5);
            }else if($request->query('search_product') && !$request->query('search_user')) {
                $carts = Cart::where('product_id','=',$request->query('search_product'))->paginate(5);
            }else if(!$request->query('search_product')&& $request->query('search_user')){
                $carts = Cart::where('user_id','=',$request->query('search_user'))->paginate(5);
            }
            $carts->appends(['search_product' => $request->query('search_product'),'search_user' => $request->query('search_user')]);
            $user = User::all();
            $products = Product::all();
            return view('admin.cart')->with(['carts' => $carts, 'users' => $user,'products' => $products, 'title' => 'List Cart']);
        }
        $carts = Cart::paginate(5);
        if($request->query('search')){
            $user = User::where('name', 'like', '%'.$request->query('search').'%')->first();
            $carts = Cart::query()->where('name','like','%'.$request->query('search').'%')->orWhere('user_id','=',$user->id)->paginate(5);
        }
        $users = User::all();
        $products = Product::all();
        return view('admin.cart')->with(['carts' => $carts, 'users' => $users,'products' => $products, 'title' => 'List Cart']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        return view('admin.dialogcart')->with(['title' => 'Create Cart','products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'qty' => 'required',
            'user_id' => 'required',
            'product' => 'required',
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Cart was create fail!');
            return redirect()->back();
        }
        $checkered = User::find($input['user_id']);
        if(!$checkered){
            $request->session()->flash('error', 'User do not exits!!');
            return redirect()->back();
        }
        $check_product = Product::find($input['product']);
        if(!$check_product){
            $request->session()->flash('error', 'Product do not exits!!');
            return redirect()->back();
        }
        $data['qty'] = $input['qty'];
        $data['user_id'] = $input['user_id'];
        $data['product_id'] = $check_product['id'];
        $data['name'] = $check_product['name'];
        $data['price'] = $check_product['price'];
        $data['image'] = $check_product['image'];
        $data['status'] = 0 ;
        Cart::create($data);

        return redirect('/admin/cart');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cart = Cart::find($id);

        return $cart;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = Product::all();
        $cart = Cart::find($id);
        return view('admin.dialogcart')->with(['title' => 'Create Cart','cart' => $cart,'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $cart = Cart::find($id);
        $validator = Validator::make($input, [
            'qty' => 'required',
            'user_id' => 'required',
            'product' => 'required',
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Cart was create fail!');
            return redirect()->back();
        }
        $checkered = User::find($input['user_id']);
        if(!$checkered){
            $request->session()->flash('error', 'User do not exits!!');
            return redirect()->back();
        }
        $check_product = Product::find($input['product']);
        if(!$check_product){
            $request->session()->flash('error', 'Product do not exits!!');
            return redirect()->back();
        }
        if($check_product['id'] == $cart['product_id']){
            $data['qty'] = $input['qty'];
            $cart->save();
            return redirect('/admin/cart');
        }
        $cart->qty = $input['qty'];
        $cart->user_id = $input['user_id'];
        $cart->product_id = $check_product['id'];
        $cart->name = $check_product['name'];
        $cart->price = $check_product['price'];
        $cart->image = $check_product['image'];
        $cart->status = $input['status'] ;
        $cart->save();

        return redirect('/admin/cart');
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

        $cart = Cart::find($id);
        if(!$cart){
            return Response('Category does not exist.', 404);
        }
        $cart->delete();

        return TRUE;
        
    }
}
