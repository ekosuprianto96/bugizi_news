<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailWebsite;
use Illuminate\Support\Facades\File;

class UploadImageAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->hasFile('image_admin')) {
            $adminImage = User::get()->first();
            if ($adminImage->image !== null) {
                File::delete(public_path('assets/admin/img/admin_img/' . $adminImage->image));
            }
            $file = $request->file('image_admin');
            $name = $file->getClientOriginalName();
            $newName = Str::random(100) . '-' . $name;
            $file->move('assets/admin/img/admin_img', $newName);
            $adminImage->image = $newName;
            $adminImage->save();
            // $adminImage->save();
            return response()->json([
                'image' => $adminImage->image,
                'status' => true
            ], 200);
        }
        return response()->json([
            'status' => false
        ], 400);
    }
}
