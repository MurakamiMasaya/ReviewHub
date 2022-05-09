<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::controller(TopController::class)->group(function(){
    Route::get('/', 'index')->name('top');
});

//phpの設定確認する際にコメントを外す
// Route::get('/phpinfo', function(){
//     phpinfo();
// });

//個人情報保護方針
Route::get('/privacy_policy', function(){
    return view('privacy-policy');
    });

//企業
Route::controller(CompanyController::class)
    ->name('company.')->group(function(){
        Route::get('/company', 'index')->name('index');
        Route::post('/company/search', 'search')->name('search');
    });

//スクール
Route::controller(SchoolController::class)
    ->name('school.')->group(function(){
        Route::get('/school', 'index')->name('index');
        Route::post('/school/search', 'search')->name('search');
    });

//イベント
Route::controller(EventController::class)
    ->name('event.')->group(function(){
        Route::get('/event', 'index')->name('index');
        Route::post('/event/search', 'search')->name('search');
    });

//特集記事
Route::controller(ArticleController::class)
    ->name('article.')->group(function(){
        Route::get('/article', 'index')->name('index');
        Route::post('/article/search', 'search')->name('search');
    });

require __DIR__.'/auth.php';
