<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class APISliderPost extends Controller
{
    public function update(Request $request)
    {
        $posts = Post::where('is_slider', 1)->get();
        $post = Post::where('slug', $request->slug)->first();
        if ($request->value == 0) {
            $post->is_slider = $request->value;
            $post->save();
            return response()->json([
                'message' => 'success',
                'result' => $post->is_slider
            ], 200);
        } else {

            if ($posts->count() > 9) {
                return response()->json([
                    'message' => 'error'
                ], 400);
            } else {
                $post->is_slider = $request->value;
                $post->save();
                return response()->json([
                    'message' => 'success',
                    'result' => $post->is_slider
                ], 200);
            }
        }
    }
    public function all_post()
    {
        $posts = Post::where('is_slider', 1)->get();

        return response()->json([
            'data' => $posts
        ], 200);
    }
}
