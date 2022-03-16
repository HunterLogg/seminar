<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.index');
    }


    public function login(Request $request)
    {
        //
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',

        ]);
        if(auth()->attempt($loginData,$request->input('remember'))) {
            return redirect('/admin');
        }

        $request->session()->flash('error', 'Email or password was wrong');
        
        return redirect()->back();
    }

    public function loginpage()
    {
        //
        return view('admin.login');
    }

    public function registerpage()
    {
        //
        return view('admin.register');
        
    }

    public function register(Request $request)
    {
        //
        $input = $request->all();
        $validator = validator::make($input,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Email or password was exits');
            return redirect()->back();
        }
        $input['role'] = 1;
        $input['password'] = bcrypt($request->password);

        $user = User::create($input);
        auth::login($user, true);
        return view('admin.index');

    }

}
