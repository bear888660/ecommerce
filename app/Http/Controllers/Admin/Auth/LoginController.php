<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('dashboard')->logout();
        return redirect('/admin/login');
    }




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest:dashboard')->except('logout');

    }
}
