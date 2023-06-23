<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|unique:subscribers'
        ]);

        $subs = new Subscriber();

        $subs->email = $request->email;
        $subs->save();

        return redirect()->back();
    }
}
