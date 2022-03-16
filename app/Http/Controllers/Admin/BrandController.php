<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $brands = Brand::paginate(5);
        if($request->search){
            $brands = Brand::where('name','like', '%'.$request->search.'%')->paginate(5);
        }
        $count = $brands->count();
        $all = Brand::all()->count();
        return view('admin.brand')->with(['brandlist'=> $brands, 'count' => $count,'all' => $all , 'title' => 'List Brand']);
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
        return view('admin.dialogbrand')->with(['title' => 'Create Brand', 'categories' => $category]);
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
            'content' => 'required'
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Category was create fail!');
            return redirect()->back();
        }
        $check = Brand::where('name', '=', $input['name'])->first();
        if($check){
            $request->session()->flash('error', 'Category was exits.');
            return redirect()->back();
        }
        Brand::create($input);

        return redirect('/admin/brand');

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
        $brand = Brand::find($id);
        
        return $brand;

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
        $brand = Brand::where('id', '=', $id)->first();
        $category = Category::all();
        return view('admin.dialogbrand')->with(['brand' => $brand, 'title' => 'Edit Brand', 'categories' => $category]);
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
        $brand = Brand::find($id);
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Category was edit fail!');
            return redirect()->back();
        }
        $brand->name = $input['name'];
        $brand->description = $input['description'];
        $brand->content = $input['content'];
        $brand->category_id = $input['category_id'];
        $brand->active = $input['active'];

        $brand->save();

        return redirect('/admin/brand');
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
        $brand = Brand::find($id);
        if(!$brand){
            return Response('Category does not exist.', 404);
        }
        $brand->delete();

        return TRUE;
    }
}
