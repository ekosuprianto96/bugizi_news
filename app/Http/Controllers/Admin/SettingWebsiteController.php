<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DetailWebsite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SettingWebsiteController extends Controller
{
    public function show()
    {
        $detailWeb = DetailWebsite::find(1);
        return view('admin.setting_website.setting-website', [
            'title' => 'Setting Website',
            'detail' => $detailWeb
        ]);
    }
    public function set_profile_admin(Request $request)
    {
        $user = User::first();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_handphone = $request->no_handphone;
        $user->save();

        return redirect()->back();
    }
    public function set_website(Request $request)
    {
        $detail_web = DetailWebsite::find(1);
        $detail_web->app_name = $request->application_name;
        $detail_web->save();
        return redirect()->back()->with('success', 'Berhasil Mengupate Data');
    }
}
