<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\API\APIGetAdsController;
use App\Http\Controllers\API\APIGetSocialController;
use App\Http\Controllers\API\APIPostController;
use App\Http\Controllers\API\APIRekomendasiPostinganController;
use App\Http\Controllers\API\APISliderPost;
use App\Http\Controllers\API\APISocialMediaController;
use App\Http\Controllers\API\UploadImageAdminController;
use App\Http\Controllers\API\UploadLogoWebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::name('admin.')->group(function () {
    Route::post('socialmedia', [APISocialMediaController::class, 'update'])->name('api-socialmedia');
    // Route::get('admin/post/{value}', [APIPostController::class, 'show']);
    Route::post('admin/slider-post', [APISliderPost::class, 'update'])->name('api-slider-post');
    Route::get('admin/all-post', [APISliderPost::class, 'all_post'])->name('api-all-post');
    Route::post('admin/rekomen-post', [APIRekomendasiPostinganController::class, 'update'])->name('api-rekomen-post');
    Route::get('admin/all-post-rekomen', [APIRekomendasiPostinganController::class, 'all_post'])->name('api-all-post-rekomen');
    Route::post('admin/upload-logo', [UploadLogoWebController::class, 'index'])->name('api-upload-logo');
    Route::get('admin/delete-logo', [UploadLogoWebController::class, 'delete'])->name('api-delete-logo');
    Route::post('admin/upload-image-admin', [UploadImageAdminController::class, 'index'])->name('api-upload-profile-admin');
    Route::get('admin/get-social/{id}', [APIGetSocialController::class, 'get_social'])->name('api-get-social');
    Route::post('admin/upload-tuhmb-ads', [AdsController::class, 'upload'])->name('api-upload-thumb-ads');
    Route::get('admin/get-ads/{type}', [APIGetAdsController::class, 'get_ads'])->name('api-get-social');
    Route::post('admin/update-status-ads', [APIGetAdsController::class, 'update_status'])->name('api-update-status-ads');
});
