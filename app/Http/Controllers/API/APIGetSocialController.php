<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class APIGetSocialController extends Controller
{
    public function get_social($id)
    {
        $social = SocialMedia::find($id);

        return response()->json([
            'social' => $social
        ], 200);
    }
}
