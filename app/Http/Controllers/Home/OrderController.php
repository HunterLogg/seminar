<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $orders = Order::join('users', 'orders.user_id', '=','users.id')->select('orders.*','users.name')->where('users.id','=', Auth::user()->id)->orderBy('orders.id','ASC')->paginate(5);
        $users = User::all();
        return view('app.manage_order')->with(['orders' => $orders,'users' => $users,  'title' => 'List Order']);
    }

    public function listOrder($id)
    {
        //
        $listOrder = Order::join('users', 'orders.user_id', '=','users.id')
        ->join('shippings','orders.shipping_id','=','shippings.id')
        ->join('order_details','orders.id','=','order_details.order_id')
        ->select('orders.*','users.*','shippings.*','order_details.*', DB::raw('order_details.product_price * order_details.product_quantity as total'))
        ->where('orders.id','=',$id)
        ->orderBy('orders.id','ASC')->paginate(5);
        return view('app.vieworder')->with(['listOrders' => $listOrder,  'title' => 'List Order']);
    }
}
