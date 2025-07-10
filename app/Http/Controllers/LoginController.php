<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // return $request;
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        Alert::error('EITS', 'salah bang');


        return back()->onlyInput('email');
    }

    static function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
