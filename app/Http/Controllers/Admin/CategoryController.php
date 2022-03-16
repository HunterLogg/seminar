<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::paginate(5);
        $count = $categories->count();
        $all = Category::all()->count();
        return view('admin.category')->with(['categoryList'=> $categories, 'count' => $count,'all' => $all , 'title' => 'Category List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dialogcategory')->with('title' , 'Create New Category');
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
        $check = Category::where('name', '=', $input['name'])->first();
        if($check){
            $request->session()->flash('error', 'Category was exits.');
            return redirect()->back();
        }
        Category::create($input);

        return redirect('/admin/category');

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
        $category = Category::find($id);

        return $category;

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
        $category = Category::where('id', '=', $id)->first();

        return view('admin.dialogcategory')->with(['category' => $category , 'title' => 'Edit Category']);

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
        $Cate = Category::find($id);
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Category was edit fail!');
            return redirect()->back();
        }
        $Cate->name = $input['name'];
        $Cate->description = $input['description'];
        $Cate->content = $input['content'];
        $Cate->active = $input['active'];

        $Cate->save();

        return redirect('/admin/category');
        
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
        $category = Category::find($id);
        if(!$category){
            return Response('Category does not exist.', 404);
        }
        $category->delete();

        return TRUE;

    }
}
