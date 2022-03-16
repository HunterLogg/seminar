<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::paginate(5);
        if($request->search){
            $products = Product::where('name','like', '%'.$request->search.'%')->paginate(5);
        }
        $count = $products->count();
        $category = Category::all();
        $brand = Brand::all();
        $all = Product::all()->count();
        return view('admin.product')->with(['products'=> $products, 'count' => $count,'all' => $all ,'categories' => $category, 'brands' => $brand, 'title' => 'List Product']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.dialogproduct')->with(['title' => 'Create Product', 'categories' => $category, 'brands' => $brand]);
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Product was create fail!');
            return redirect()->back();
        }
        $check = Product::where('name', '=', $input['name'])->first();
        if($check){
            $request->session()->flash('error', 'Product was exits.');
            return redirect()->back();
        }
        if ($files = $request->file('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/products'), $imageName);
            $input['image'] = $imageName;
        }
        
        Product::create($input);

        return redirect('/admin/product');
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
        $product = Product::find($id);

        return $product;
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
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::find($id);
        return view('admin.dialogproduct')->with(['title' => 'Create Product','product' => $product, 'categories' => $category, 'brands' => $brand]);
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
        $product = Product::find($id);
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Category was edit fail!');
            return redirect()->back();
        }
        if ($files = $request->file('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/products'), $imageName);
            $input['image'] = $imageName;
        }
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->price = $input['price'];
        $product->quantity = $input['quantity'];
        $product->category_id = $input['category_id'];
        $product->brand_id = $input['brand_id'];
        $product->active = $input['active'];

        $product->save();

        return redirect('/admin/product');

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
        $product = Product::find($id);
        if(!$product){
            return Response('Category does not exist.', 404);
        }
        $product->delete();

        return TRUE;
    }
}
