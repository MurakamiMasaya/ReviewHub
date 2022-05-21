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
    ->prefix('company')->name('company.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::get('/tech/{target}', 'tech')->name('tech');
        Route::get('/condition/{target}', 'condition')->name('condition');
        Route::get('/detail/{company}', 'detail')->name('detail');
        
        Route::middleware('auth')->group(function(){
        // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/review/{detail}', 'review')->name('review');
            Route::post('/review/confilm/{company}', 'reviewConfilm')->name('review.confilm');
            Route::post('/review/register/{company}', 'reviewRegister')->name('review.register');
        });
    });

//スクール
Route::controller(SchoolController::class)
    ->prefix('school')->name('school.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::get('/detail/{school}', 'detail')->name('detail');

        Route::middleware('auth')->group(function(){
        // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/review/{detail}', 'review')->name('review');
            Route::post('/review/confilm/{school}', 'reviewConfilm')->name('review.confilm');
            Route::post('/review/register/{school}', 'reviewRegister')->name('review.register');
        });
    });

//イベント
Route::controller(EventController::class)
    ->prefix('event')->name('event.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        
        Route::middleware('auth')->group(function(){
            // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/detail/{event}', 'detail')->name('detail');
            Route::get('/register', 'showRegister')->name('register');
            Route::post('/register/confilm', 'confilmRegister')->name('confilm');
            Route::post('/register', 'completeRegister')->name('register');

            Route::post('/review', 'review')->name('review');
        });
    });

//特集記事
Route::controller(ArticleController::class)
    ->prefix('article')->name('article.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        
        Route::middleware('auth')->group(function(){
            // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/detail/{article}', 'detail')->name('detail');
            Route::get('/register', 'showRegister')->name('register');
            Route::post('/register/confilm', 'confilmRegister')->name('confilm');
            Route::post('/register', 'completeRegister')->name('register');

            Route::post('/review', 'review')->name('review');
        });
    });

require __DIR__.'/auth.php';
