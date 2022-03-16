<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Shipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $orders = Order::join('users', 'orders.user_id', '=','users.id')->select('orders.*','users.name')->orderBy('orders.id','ASC')->paginate(5);
        $users = User::all();
        if($request->query('search_product') || $request->query('search_user')){
            $orders = Order::join('users', 'orders.user_id', '=','users.id')->select('orders.*','users.name')->where('users.id','=', $request->search_user)->orderBy('orders.id','ASC')->paginate(5);
        }
        return view('admin.manage_order')->with(['orders' => $orders,'users' => $users,  'title' => 'List Order']);
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
        return view('admin.vieworder')->with(['listOrders' => $listOrder,  'title' => 'List Order']);
    }

    public function shipping(Request $request,$id){
        $input = $request->all();
        $ship = Shipping::find($input['shipping_id']);
        $ship->type = $input['value'];
        $ship->save();
        $order = Order::find($id);
        $order->order_status = $input['value'];
        $order->save();
        if($input['ok']){
            $orders = OrderDetail::join('orders','orders.id','=','order_details.order_id')->select('orders.*', 'order_details.*')->where('orders.id','=',$id)->get();
            $products = Product::all();
            foreach ($orders as $key => $order) {
                foreach ($products as $key => $product) {
                    if($order->product_id == $product->id){
                        $product->quantity = $product->quantity - $order->product_quantity;
                        $product->save();
                    }
                }
            }
            
        }
        return true;
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
        $orders = DB::table('orders')->join('users', 'orders.user_id', '=','users.id')->select('orders.*','users.name')->where('orders.id','=',$id)->orderBy('orders.id','ASC')->get();
        return $orders;

    }

    // Generate PDF
    public function createPDF(Request $request) {
        // retreive all records from db
        if($request->id){
            $data = ['listOrders' => Order::join('users', 'orders.user_id', '=','users.id')
            ->join('shippings','orders.shipping_id','=','shippings.id')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->select('orders.*','users.*','shippings.*','order_details.*', DB::raw('order_details.product_price * order_details.product_quantity as total'))
            ->where('orders.id','=',$request->id)
            ->orderBy('orders.id','ASC')->get()];
            $name = $data['listOrders'][0]['id'].'.pdf';
            // share data to view
    
            $pdf = PDF::loadView('admin.pdf_view', $data);
      
            // download PDF file with download method
            return $pdf->download($name);
        }
        else {
            return redirect('/admin/order');
        }
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
    }
}
