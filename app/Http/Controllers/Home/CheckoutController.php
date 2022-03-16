<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function checkout(){
        $user = Auth::user();
        $check = Shipping::where('user_id' ,'=', Auth::user()->id)->first();
        if($check){
            return redirect('/payment');
        }
        return view('app.checkout')->with('user', $user);
    }
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'type' => 'required',
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Some one was required');
            return redirect()->back();
        }
        $input['user_id'] = Auth::user()->id;
        $check = Shipping::where('user_id' ,'=', Auth::user()->id)->first();
        if($check){
            return redirect('/payment');
        }
        Shipping::create($input);
        return redirect('/payment');
    }

    public function payment(){
        $subtotal = 0;
        $carts = [];
        $cart_count = 0 ;
        if(Auth::user()){
            $cart_count = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get()->count();
            if($cart_count == null){
                return redirect('home');
            }
            $carts = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->paginate(5);
            $items = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get();
            foreach($items as $item){
                $subtotal += $item->price * $item->qty;
            }
        }
        return view('app.payment')->with(['carts' => $carts,'subTotal' => $subtotal,'cart_count' => $cart_count]);
    }
    public function order_place(Request $request)
    {
        //
        $carts = Cart::where([['user_id', '=' , Auth::user()->id],['status' , '=' ,'0']])->get();
        $input = $request->all();
        $input['status'] = 'Đang chờ xử lý';
        $payment = Payment::create($input);
        $subtotal = 0;
        foreach($carts as $item){
            if($item->status == 0){
                $subtotal += $item->price * $item->qty;
            }
        }
        $shipping = Shipping::where('user_id' ,'=', Auth::user()->id)->first();
        $data['user_id'] = Auth::user()->id;
        $data['shipping_id'] = $shipping['id'];
        $data['payment_id'] = $payment['id'];
        $data['order_total'] = $subtotal * 1.2;
        $data['order_status'] = 'Đang chờ xử lý';
        $order = Order::create($data);

        foreach($carts as $item){
            if($item->status == 0){
                $subtotal += $item->price * $item->qty;
                $item->status = 1; // đã qua check out
                OrderDetail::create([
                    'order_id' => $order['id'],
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_price' => $item->price,
                    'product_quantity' => $item->qty,
                ]);
                $item->save();
            }
        }
        return view('app.thank');
    }
}
