<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdsWebsite;
use Illuminate\Http\Request;

class APIGetAdsController extends Controller
{
    public function get_ads($type)
    {
        $ads = AdsWebsite::where('type', $type)->get()->first();

        return response()->json([
            'status' => true,
            'ads' => $ads
        ], 200);
    }
    public function update_status(Request $request)
    {
        $ads = AdsWebsite::where('type', $request->type_ads)->get()->first();
        if (isset($request->type_ads)) {
            $ads->status = $request->value;
            $ads->save();

            if ($ads->save()) {
                return response()->json([
                    'status' => true,
                    'value' => $ads->status
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'value' => $ads->status
                ], 400);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi Masalah, Silahkan Coba Lagi!',
            'value' => $ads->status
        ], 400);
    }
}
