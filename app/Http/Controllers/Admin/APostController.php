<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use App\Mail\SubsriberNotif;
use Illuminate\Http\Request;
use Faker\Provider\UserAgent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class APostController extends Controller
{
    public function show()
    {

        return view('admin.post.new-post', [
            'title' => 'New Post',
            'categorys' => Category::all()
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6|max:150',
            'category_id' => 'required',
            'slug' => 'required',
            'thumb_post' => 'required|mimes:jpg,jpeg,png,svg',
            'body' => 'required',
            'excerpt' => 'required|max:250'
        ]);
        $post = new Post();
        if ($request->hasFile('thumb_post')) {
            $file = $request->file('thumb_post');
            $name = $file->getClientOriginalName();
            $newName = Str::random(12) . '-' . $name;
            $file->move('assets/blog/img/thumb_post', $newName);
            $post->thumbnail_post = $newName;
        }
        $post->category_id = $request->category_id;
        $post->title = str()->title($request->title);
        $post->slug = $request->slug;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->post_by = Auth::user()->name;
        $post->save();
        $post->tag($request->tags);
        $subs = [];
        foreach (Subscriber::all() as $item) {
            $subs[] = $item['email'];
        }
        if ($post->save()) {
            foreach ($subs as $email) {
                Mail::to($email)->send(new SubsriberNotif($request->all(), $post->category->name));
            }
        }

        return redirect()->route('admin.list-post')->with('success', 'Postingan Berhasil Ditambah!');
    }
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->get()->first();
        return view('admin.post.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categorys' => Category::all()
        ]);
    }
    public function update(Request $request)
    {

        $post = Post::where('slug', $request->slug_post)->get()->first();
        if ($request->hasFile('thumb_post')) {
            File::delete(public_path('assets/admin/img/thumb_post') . $post->thumbnail_post);
            $file = $request->file('thumb_post');
            $name = $file->getClientOriginalName();
            $newName = Str::random(12) . '-' . $name;
            $file->move('assets/admin/img/thumb_post', $newName);
            $post->thumbnail_post = $newName;
        }
        if (isset($request->category_id)) {
            $post->category_id = $request->category_id;
        }
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->save();
        if ($request->tags !== null) {
            $post->tag($request->tags);
        }

        return redirect()->back()->with('success', 'Postingan Berhasil Ditambah!');
    }
    public function delete($slug)
    {
        $post = Post::where('slug', $slug)->get()->first();
        if ($post->thumbnail_post !== null) {
            File::delete(public_path('assets/admin/img/thumb_post') . $post->thumbnail_post);
        }
        $post->delete();

        return redirect()->back()->with('success', 'Post Berhasil Di Delete!');
    }
    public function list_post()
    {
        // $dd = Post::where('is_slider', 1)->get();
        // dd($dd);
        $posts = Post::with('comments')->with('category')->latest();
        $posts_views = DB::table('post_news')->select('views')->sum('views');
        return view('admin.post.list-of-post', [
            'title' => 'List of post',
            'posts' => $posts->get(),

            'posts_pagin' => $posts->paginate(10),
            'post_count' => $posts->count(),
            'views' => $posts_views
        ]);
    }
}
