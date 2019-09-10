<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user());
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3'],
        ]);
        if($validator->failed()) return back()->withErrors($validator->errors()->getMessages());

        $credentials = $validator->validated();
        if(!Auth::attempt($credentials, false)){
            return redirect()->back()->withErrors('error', 'Invalid Credentials');
        }
        if(auth()->user()->role_id !== 1) {
            auth()->logout();
            return redirect()->back()->withErrors('error', 'Invalid Account type');
        }

        return redirect()->back();
    }

    public function logout()
    {
        if (Auth::check()) Auth::logout();
    }
}
