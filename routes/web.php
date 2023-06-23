<?php

use App\Http\Controllers\Admin\ACategoryController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\APostController;
use App\Http\Controllers\Admin\ASocialMediaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingWebsiteController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\ContactController;
use App\Http\Controllers\Blog\IndexController;
use App\Http\Controllers\Blog\SubscriberController;
use App\Http\Controllers\HistoryController;
use App\Models\AdsWebsite;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/')->name('admin.')->middleware('auth')->group(function () {
    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // post
    Route::get('post/show', [APostController::class, 'show'])->name('post-show');
    Route::get('post/list-post', [APostController::class, 'list_post'])->name('list-post');
    Route::post('post/create', [APostController::class, 'create'])->name('post-create');
    Route::get('post/edit/{slug}', [APostController::class, 'edit'])->name('post-edit');
    Route::post('post/update', [APostController::class, 'update'])->name('post-update');
    Route::get('post/delete/{slug}', [APostController::class, 'delete'])->name('post-delete');

    // category
    // Route::get('category/show', [ACategoryController::class, 'show'])->name('category-show');
    Route::get('category/lis-category', [ACategoryController::class, 'list_category'])->name('list-category');
    Route::post('category/create', [ACategoryController::class, 'create'])->name('category-create');
    Route::get('category/get/{slug}', [ACategoryController::class, 'getCategory'])->name('category-get');
    Route::post('category/update', [ACategoryController::class, 'update'])->name('category-update');
    Route::get('category/delete/{slug}', [ACategoryController::class, 'delete'])->name('category-delete');

    // socialmedia
    Route::get('socialmedia', [ASocialMediaController::class, 'show'])->name('socialmedia-show');
    Route::post('update-social', [ASocialMediaController::class, 'update'])->name('update-social');

    // route history
    Route::get('back', [HistoryController::class, 'back'])->name('history-back');

    // route setting website
    Route::get('setting-website', [SettingWebsiteController::class, 'show'])->name('setting-show');
    Route::post('setting-profile-admin', [SettingWebsiteController::class, 'set_pofile_admin'])->name('set-profile-admin');
    Route::post('setting-website', [SettingWebsiteController::class, 'set_website'])->name('sett-website');

    // route setting ads
    Route::get('ads', [AdsController::class, 'index'])->name('ads-show');
    Route::post('ads', [AdsController::class, 'update'])->name('update-ads');
});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('post/{slug}/{category}', [IndexController::class, 'single_post'])->name('post.single-post');
Route::get('posts/all-posts', [IndexController::class, 'all_posts'])->name('post.all-posts');
Route::get('category/{slug}', [IndexController::class, 'single_category'])->name('category.single-category');
Route::get('contact', [IndexController::class, 'contact'])->name('contact');
Route::post('post/comment', [CommentController::class, 'postComment'])->name('post.comment');
Route::post('contact/send', [ContactController::class, 'store'])->name('contact.send');
Route::post('subscribe/store', [SubscriberController::class, 'store'])->name('subscribe.store');

Route::get('admin/login', [LoginController::class, 'show'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
// Route::get('admin/register', [LoginController::class, 'reg_show'])->name('admin.show');
// Route::post('admin/register', [LoginController::class, 'store'])->name('admin.register-store');
