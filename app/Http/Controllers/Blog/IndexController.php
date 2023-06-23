<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use App\Models\Category;
use Jorenvh\Share\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdsWebsite;
use App\Models\ViewsPost;
use App\Models\Visitor;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public $posts;
    public $categorys;
    public function __construct()
    {
        $this->posts = new Post();
        $this->categorys = new Category();
    }
    public function index(Request $request)
    {
        if (Cookie::get('visitor') !== null) {
            $cookie = Cookie::get('visitor');
            $visitor = json_decode($cookie);
            $views = ViewsPost::create([
                'visitor_id' => $visitor->id,
                'device' => $request->header('User-Agent'),
                'page_url' => $request->path()
            ]);
        } else {
            $visitor = Visitor::create([
                'ip_visitor' => $request->ip(),
                'device_visitor' => $request->header('User-Agent'),
            ]);
            $user = [
                'id' => $visitor->id,
                'device' => $visitor->device_visitor,
                'ip' => $visitor->ip_visitor
            ];

            Cookie::queue('visitor', json_encode($user), 43800);
        }

        return view('blog.index', [
            'title' => 'Home',
            'posts' => $this->posts->with(['category'])->latest()->get(),
            'categorys' => Category::with(['posts'])->get(),
            'ads' => AdsWebsite::all()->where('status', 1)
        ]);
    }
    public function single_post($slug, $category, Request $request)
    {
        // dd($request->getAcceptableContentTypes());
        // $cookie = Cookie::
        $post = $this->posts->with('category')->where('slug', $slug)->get()->first();
        if (Cookie::get('visitor') !== null) {
            $cookie = Cookie::get('visitor');
            $visitor = json_decode($cookie);
            $views = ViewsPost::create([
                'post_id' => $post->id,
                'visitor_id' => $visitor->id,
                'device' => $request->header('User-Agent'),
                'page_url' => $request->path()
            ]);
        } else {
            $visitor = Visitor::create([
                'ip_visitor' => $request->ip(),
                'device_visitor' => $request->header('User-Agent'),
            ]);
            $user = [
                'id' => $visitor->id,
                'device' => $visitor->device_visitor,
                'ip' => $visitor->ip_visitor
            ];

            Cookie::queue('visitor', json_encode($user), 43800);
        }
        $share = new Share;
        $shareSocial = $share->page('http://jorenvanhocht.be', 'Share title')
            ->facebook()
            ->twitter()
            ->linkedin('Extra linkedin summary can be passed here')
            ->whatsapp();

        $post->views = ViewsPost::all()->where('post_id', $post->id)->count();
        $post->save();
        return view('blog.single_post', [
            'title' => $post->title,
            'post' => $post,
            'posts' => $this->posts->latest()->get(),
            'shareSocial' => $shareSocial,
            'ads' => AdsWebsite::all()->where('status', 1)
        ],);
    }
    public function single_category($slug, Request $request)
    {
        if (Cookie::get('visitor') !== null) {
            $cookie = Cookie::get('visitor');
            $visitor = json_decode($cookie);
            $views = ViewsPost::create([
                'visitor_id' => $visitor->id,
                'device' => $request->header('User-Agent'),
                'page_url' => $request->path()
            ]);
        } else {
            $visitor = Visitor::create([
                'ip_visitor' => $request->ip(),
                'device_visitor' => $request->header('User-Agent'),
            ]);
            $user = [
                'id' => $visitor->id,
                'device' => $visitor->device_visitor,
                'ip' => $visitor->ip_visitor
            ];

            Cookie::queue('visitor', json_encode($user), 43800);
        }
        $category = $this->categorys->with('posts')->where('slug', $slug)->get()->first();
        return view('blog.single_categori', [
            'title' => $category->name,
            'category' => $category,
            'posts' => $category->posts()->paginate(8),
            'latest_post' => $this->posts->latest()->get(),
            'ads' => AdsWebsite::all()->where('status', 1)
        ]);
    }
    public function all_posts()
    {
        return view('blog.all-posts', [
            'title' => 'All Posts',
            'category' => $this->categorys->all(),
            'posts' => $this->posts->latest()->get(),
            'ads' => AdsWebsite::all()->where('status', 1)
        ]);
    }
    public function contact(Request $request)
    {
        if (Cookie::get('visitor') !== null) {
            $cookie = Cookie::get('visitor');
            $visitor = json_decode($cookie);
            $views = ViewsPost::create([
                'visitor_id' => $visitor->id,
                'device' => $request->header('User-Agent'),
                'page_url' => $request->path()
            ]);
        } else {
            $visitor = Visitor::create([
                'ip_visitor' => $request->ip(),
                'device_visitor' => $request->header('User-Agent'),
            ]);
            $user = [
                'id' => $visitor->id,
                'device' => $visitor->device_visitor,
                'ip' => $visitor->ip_visitor
            ];

            Cookie::queue('visitor', json_encode($user), 43800);
        }
        return view('blog.contact', [
            'title' => 'Contact',
            'posts' => $this->posts->latest()->get()
        ]);
    }
}
