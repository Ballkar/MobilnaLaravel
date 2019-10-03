<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only(['showLoginForm', 'login']);
        $this->middleware('admin')->except(['showLoginForm', 'login']);
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function showLoginForm()
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
            return redirect()->back()->withErrors(['Invalid Credentials']);
        }
        if(auth()->user()->role_id !== 1) {
            auth()->logout();
            return redirect()->back()->withErrors(['Invalid Account type']);
        }

        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        if (Auth::check()) Auth::logout();
        return redirect('/');
    }
}
