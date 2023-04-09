<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('post', PostController::class);

    Route::post('/post/{post}/comment', [PostController::class, 'storeComment'])->name('post.comment.store');
    Route::delete('/post/{post}/comment', [PostController::class, 'deleteComment'])->name('post.comment.delete');
    Route::put('/post/{post}/comment', [PostController::class, 'updateComment'])->name('post.comment.update');

});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware'=>'guest'], function (){
    Route::get('/auth/{social}/redirect', [AuthController::class, 'redirect']);
    Route::get('/auth/{social}/callback', [AuthController::class, 'callback']);
});

require __DIR__.'/auth.php';
