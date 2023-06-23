<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Charts\PostChart;
use Illuminate\Http\Request;
use App\Charts\AnalitycsWebsite;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(AnalitycsWebsite $chart, PostChart $lineChart)
    {
        $populer = Post::withCount('comments')->withCount('views_post')->orderBy('comments_count', 'desc')->orderBy('views_post_count', 'desc')->limit(10)->get();
        return view('admin.index', [
            'post_populer' => $populer,
            'title' => 'Dashboard',
            'chart' => $chart->build(),
            'lineChart' => $lineChart->build()
        ]);
    }
}
