<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class APISocialMediaController extends Controller
{
    public function update(Request $request)
    {
        $social = SocialMedia::find($request->id_social);
        $social->isSelected = $request->value;
        $social->save();
        if ($social->save()) {
            return response()->json([
                'message' => 'success',
                'value' => $social->isSelected
            ], 200);
        }
        return response()->json([
            'message' => 'Error'
        ], 400);
    }
}
