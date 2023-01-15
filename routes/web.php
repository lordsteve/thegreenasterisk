<?php

use App\Http\Controllers\SessionController;
use App\Models\User;
use App\View\Components\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [SessionController::class, 'show']);
Route::get('/auth/redirect/{service}', [SessionController::class, 'create']);
Route::get('/auth/callback/{service}', [SessionController::class, 'store']);
Route::get('/logout', [SessionController::class, 'destroy']);
