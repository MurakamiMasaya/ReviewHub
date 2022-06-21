<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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

// Route::controller(CompanyController::class)
//     ->prefix('company')->name('company.')->group(function(){
        
//         Route::middleware(['verified', 'auth'])->group(function(){

//             Route::post('/gr/{id}', 'gr')->name('gr');
//             Route::post('/gr/delete/{id}', 'deleteGr')->name('gr.delete');
//             Route::get('/review/gr/{id}', 'grReview')->name('review.gr');
//             Route::get('/review/gr/delete/{id}', 'deleteGrReview')->name('review.gr.delete');
//         });
//     });