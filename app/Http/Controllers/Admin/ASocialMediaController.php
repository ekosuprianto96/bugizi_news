<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class ASocialMediaController extends Controller
{
    public function show()
    {

        return view('admin.socialmedia.social-media', [
            'title' => 'Social Media',
            'socialmedia' => SocialMedia::all()
        ]);
    }
    public function update(Request $request)
    {
        if (isset($request->url_social)) {
            if ($request->id_social !== null) {
                $social = SocialMedia::find($request->id_social);

                $social->url = $request->url_social;
                $social->save();

                return redirect()->back()->with('success', 'Berhasil Mengupdate Social Media');
            }
        }

        return redirect()->back()->with('Error', 'Gagal Mengupdate Social Media');
    }
}
