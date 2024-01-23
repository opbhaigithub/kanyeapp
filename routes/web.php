<?php

use App\Http\Controllers\KanyeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-page', [KanyeController::class, 'user_login'])->name('user.userloginpage');
Route::post('/login_hello', [KanyeController::class, 'userSubmit'])->name('user.userlogin');

Route::group(['middleware' => 'user'], function () {
    Route::get('/', [KanyeController::class, 'index'])->name('home.page');
    Route::post('/api/fetch-quotes', [KanyeController::class, 'fetchQuotes'])->name('get-quotes-data');
});
