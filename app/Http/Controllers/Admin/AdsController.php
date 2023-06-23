<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function index()
    {
        $ads = AdsWebsite::all();
        return view('admin.ads.ads', [
            'title' => 'Ads',
            'ads' => $ads
        ]);
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $ads = AdsWebsite::where('type', $request->type)->get()->first();
            File::delete(public_path('assets/blog/img/ads/') . $ads->thumb);
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move('assets/blog/img/ads', $fileName);
            $ads->thumb = $fileName;
            $ads->save();

            return response()->json([
                'status' => true
            ], 200);
        }

        return response()->json([
            'status' => $request->hasFile('file')
        ], 400);
    }

    public function update(Request $request)
    {
        $ads = AdsWebsite::where('type', $request->type_ads)->get()->first();

        if (isset($request->link) || isset($request->title)) {
            $ads->title = $request->title;
            $ads->link = $request->link;
            $ads->save();

            return redirect()->back()->with('success', 'Berhasil Mengupdate Ads');
        }

        return redirect()->back()->with('Error', 'Gagal Mengupdate Ads!');
    }
}
