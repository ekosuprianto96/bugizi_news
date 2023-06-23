<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DetailWebsite;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UploadLogoWebController extends Controller
{
    public function index(Request $request)
    {
        if ($request->hasFile('logo')) {
            $logo_web = DetailWebsite::find(1);
            if ($logo_web->logo_web !== null) {
                File::delete(public_path('assets/admin/img/logo_img/' . $logo_web->logo_web));
            }
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            $newName = Str::random(100) . '-' . $name;
            $file->move('assets/admin/img/logo_img', $newName);
            $logo_web->logo_web = $newName;
            $logo_web->save();
            return response()->json([
                'image' => $newName,
                'status' => true
            ], 200);
        }
        return response()->json([
            'status' => false
        ], 400);
    }
    public function delete()
    {
        $logo = DetailWebsite::get()->first();

        File::delete(public_path('assets/admin/img/logo_img/' . $logo->logo_web));
        $logo->logo_web = null;
        $logo->save();

        return response()->json([
            'status' => true
        ], 200);
    }
}
