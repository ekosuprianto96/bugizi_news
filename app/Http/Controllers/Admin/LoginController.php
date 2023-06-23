<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DetailWebsite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            $name = Auth::user()->name;
            $appName = DetailWebsite::first()->app_name;
            return redirect()->intended('admin/dashboard')->with('message', "Halo {$name}, Selamat Datang Di Dashboard {$appName}!");
        }
        return redirect()->back()->with('message', 'Login Failed!');
    }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back();
    }
    public function reg_show()
    {
        return view('admin.register');
    }
}
