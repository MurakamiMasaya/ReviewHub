<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::controller(UserController::class)->group(function(){
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

require __DIR__.'/auth.php';
