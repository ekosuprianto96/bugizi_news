<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $comment = new Comment;
        $avatarMale = [
            'avatar-male5.png',
            'avatar-male6.png',
            'avatar-male7.png',
            'avatar-male8.png',
            'avatar-male10.png',
            'avatar-male12.png',
            'avatar-male13.png',
            'avatar-male15.png',

        ];
        $avatarFamale = [
            'avatar-famale1.png',
            'avatar-famale2.png',
            'avatar-famale3.png',
            'avatar-famale4.png',
            'avatar-famale9.png',
            'avatar-famale11.png',
            'avatar-famale14.png',
            'avatar-famale16.png',
        ];
        if ($request->gendre === 'famale') {
            $comment->image = $avatarFamale[mt_rand(0, 7)];
        }
        if ($request->gendre === 'male') {
            $comment->image = $avatarMale[mt_rand(0, 7)];
        }
        $post = Post::where('slug', $request->slug_post)->get()->first();
        $comment->gendre = $request->gendre;
        $comment->username = $request->name;
        $comment->content = $request->content;
        $comment->email = $request->email;
        // $comment->image = ;
        $comment->post_news_id = $post->id;
        $comment->save();

        return redirect()->back();
    }
}
