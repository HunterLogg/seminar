<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('id','!=',Auth::user()->id)->paginate(5);
        return view('admin.user')->with([ 'users' => $users, 'title' => 'List User']);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dialoguser')->with(['title' => 'Create User']);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'User was create fail!');
            return redirect()->back();
        }
        $check = User::where('email', '=', $input['email'])->first();
        if($check){
            $request->session()->flash('error', 'Email was exits!');
            return redirect()->back();
        }
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return redirect('/admin/user');
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
        $users = User::find($id);
        return view('admin.dialoguser')->with(['title' => 'Edit User', 'users' => $users]);

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
        $user = User::find($id);
        $check = User::where([['email', '=', $input['email']],['id', '!=', $id]])->first();
        if($check){
            $request->session()->flash('error', 'Email was exits!');
            return redirect()->back();
        }
        if($input['name']){
            $user->name = $input['name'];
        }
        if($input['email']){
            $user->email = $input['email'];
        }
        if($input['name']){
            $user->role = $input['role'];
        }
        if($input['password']){
            $user->password = Hash::make($input['password']);
        }
        $user->save();
        return redirect('/admin/user');
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
