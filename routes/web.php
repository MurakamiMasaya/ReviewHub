<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\OtherController;

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

//phpの設定確認用
// Route::get('/phpinfo', function(){
//     phpinfo();
// });

//個人情報保護方針
Route::get('/privacy_policy', function(){
    return view('privacy-policy');
    });

Route::controller(OtherController::class)->group(function(){
    //サイトマップ
    Route::get('/sitemap', 'sitemap')->name('sitemap');

    Route::middleware(['verified', 'auth'])->group(function(){   
        //お問い合わせ
        Route::get('/contact', 'contact')->name('contact');
        Route::post('/contact/confilm', 'confilmContact')->name('contact.confilm');
        Route::post('/contact/register', 'registContact')->name('contact.register');
        
        Route::get('/report', 'createReport')->name('report');
        Route::post('/report/port', 'postReport')->name('report.post');
        Route::get('/report/review', 'createReviewReport')->name('review.report');
        Route::post('/report/port/review', 'postReviewReport')->name('review.report.post');
    });
});

Route::controller(GoogleLoginController::class)->group(function(){
    Route::get('/auth/redirect', 'getGoogleAuth')->name('google.login');
    Route::get('/login/callback', 'authGoogleCallback');
});


//企業
Route::controller(CompanyController::class)
    ->prefix('company')->name('company.')->group(function(){
        Route::get('/top/{period?}', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::get('/tech/{target}', 'tech')->name('tech');
        Route::get('/condition/{target}', 'condition')->name('condition');
        Route::get('/detail/{id}', 'detail')->name('detail');
        
        Route::middleware(['verified', 'auth'])->group(function(){
        // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/review/{detail}', 'review')->name('review');
            Route::post('/review/confilm/{company}', 'confilmReview')->name('review.confilm');
            Route::post('/review/register/{company}', 'registerReview')->name('review.register');
            Route::post('/review/delete/{id}', 'deleteReview')->name('review.delete');

            //いいね機能
            Route::get('/gr/{id}', 'gr')->name('gr');
            Route::get('/gr/delete/{id}', 'deleteGr')->name('gr.delete');
            Route::get('/review/gr/{id}', 'grReview')->name('review.gr');
            Route::get('/review/gr/delete/{id}', 'deleteGrReview')->name('review.gr.delete');
        });
    });

//スクール
Route::controller(SchoolController::class)
    ->prefix('school')->name('school.')->group(function(){
        Route::get('/top/{period?}', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        Route::get('/detail/{id}', 'detail')->name('detail');

        Route::middleware(['verified', 'auth'])->group(function(){
        // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/review/{detail}', 'review')->name('review');
            Route::post('/review/confilm/{school}', 'confilmReview')->name('review.confilm');
            Route::post('/review/register/{school}', 'registerReview')->name('review.register');
            Route::post('/review/delete/{id}', 'deleteReview')->name('review.delete');

            //いいね機能
            Route::get('/gr/{id}', 'gr')->name('gr');
            Route::get('/gr/delete/{id}', 'deleteGr')->name('gr.delete');
            Route::get('/review/gr/{id}', 'grReview')->name('review.gr');
            Route::get('/review/gr/delete/{id}', 'deleteGrReview')->name('review.gr.delete');

        });
    });

//イベント
Route::controller(EventController::class)
->prefix('event')->name('event.')->group(function(){
    Route::get('/top/{period?}', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
        
        Route::middleware(['verified', 'auth'])->group(function(){
            // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::get('/create', 'createEvent')->name('create');
            Route::post('/register/confilm', 'confilmEvent')->name('confilm');
            Route::post('/register', 'registEvent')->name('register');
            Route::post('/delete/{event}', 'deleteEvent')->name('delete');

            Route::post('/review', 'review')->name('review');
            Route::post('/review/delete/{id}', 'deleteReview')->name('review.delete');

            //いいね機能
            Route::get('/gr/{id}', 'gr')->name('gr');
            Route::get('/gr/delete/{id}', 'deleteGr')->name('gr.delete');
            Route::get('/review/gr/{id}', 'grReview')->name('review.gr');
            Route::get('/review/gr/delete/{id}', 'deleteGrReview')->name('review.gr.delete');

        });
    });

//特集記事
Route::controller(ArticleController::class)
    ->prefix('article')->name('article.')->group(function(){
        Route::get('/top/{period?}', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
        
        Route::middleware(['verified', 'auth'])->group(function(){
            // #TODO: ログインにリダイレクトはUXが低下しそう。updateみたいにモーダルでログインを促したい。
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::get('/create', 'createArticle')->name('create');
            Route::post('/register/confilm', 'confilmArticle')->name('confilm');
            Route::post('/register', 'registArticle')->name('register');
            Route::post('/delete/{article}', 'deleteArticle')->name('delete');

            Route::post('/review', 'review')->name('review');
            Route::post('/review/delete/{id}', 'deleteReview')->name('review.delete');

            //いいね機能
            Route::get('/gr/{id}', 'gr')->name('gr');
            Route::get('/gr/delete/{id}', 'deleteGr')->name('gr.delete');
            Route::get('/review/gr/{id}', 'grReview')->name('review.gr');
            Route::get('/review/gr/delete/{id}', 'deleteGrReview')->name('review.gr.delete');

        });
    });

//マイページ
Route::controller(MypageController::class)
    ->prefix('mypage')->name('mypage.')->middleware(['verified', 'auth'])->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/review', 'review')->name('review');

        Route::get('/event', 'event')->name('event');
        Route::get('/event/edit/{event}', 'editEvent')->name('event.edit');
        Route::post('/event/confilm', 'confilmEvent')->name('event.confilm');
        Route::post('/event/register', 'registerEvent')->name('event.register');

        Route::get('/article', 'article')->name('article');
        Route::get('/article/edit/{article}', 'editArticle')->name('article.edit');
        Route::post('/article/confilm', 'confilmArticle')->name('article.confilm');
        Route::post('/article/register', 'registerArticle')->name('article.register');

        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile', 'registProfile')->name('profile.register');
        Route::post('/delete', 'deleteAcount')->name('delete');
    });

Route::controller(AdminController::class)
    ->prefix('admin')->name('admin.')->middleware(['verified', 'auth'])->group(function(){
        Route::get('/company', 'showCompany')->name('company');
        Route::get('/company/search', 'searchCompany')->name('company.search');
        Route::get('/company/edit/{company}', 'editCompany')->name('company.edit');
        Route::get('/company/create', 'createCompany')->name('company.create');
        Route::post('/company/confilm', 'confilmCompany')->name('company.confilm');
        Route::post('/company/register', 'registCompany')->name('company.register');
        Route::post('/company/delete', 'deleteCompany')->name('company.delete');

        Route::get('/school', 'showSchool')->name('school');
        Route::get('/school/search', 'searchSchool')->name('school.search');
        Route::get('/school/edit/{school}', 'editSchool')->name('school.edit');
        Route::get('/school/create', 'createSchool')->name('school.create');
        Route::post('/school/confilm', 'confilmSchool')->name('school.confilm');
        Route::post('/school/register', 'registSchool')->name('school.register');
        Route::post('/school/delete', 'deleteSchool')->name('school.delete');

        Route::get('/event', 'showEvent')->name('event');
        Route::get('/event/search', 'searchEvent')->name('event.search');
        Route::get('/event/confilm/{event}', 'confilmEvent')->name('event.confilm');
        Route::post('/event/delete', 'deleteEvent')->name('event.delete');

        Route::get('/article', 'showArticle')->name('article');
        Route::get('/article/search', 'searchArticle')->name('article.search');
        Route::get('/article/confilm/{article}', 'confilmArticle')->name('article.confilm');
        Route::post('/article/delete', 'deleteArticle')->name('article.delete');

        Route::get('/user', 'showUser')->name('user');
        Route::get('/user/search', 'searchUser')->name('user.search');
        Route::get('/user/confilm/{user}', 'confilmUser')->name('user.confilm');
        Route::post('/user/delete', 'deleteUser')->name('user.delete');
    });

require __DIR__.'/auth.php';
