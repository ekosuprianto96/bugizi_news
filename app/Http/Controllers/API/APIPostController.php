<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class APIPostController extends Controller
{
    public function show($value)
    {
        $post = Post::where('body', 'LIKE', '%' . $value . '%')
            ->orWhere('title', 'LIKE', '%' . $value . '%')
            ->paginate(10)->toArray();
        if ($post === null) {
            return response()->json([
                'message' => false
            ], 400);
        }
        return response()->json([
            'message' => true,
            'data' => $post
        ], 200, [
            'Cache-Control' => 'max-age=3600'
        ]);
    }
}
