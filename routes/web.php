<?php

use Illuminate\Support\Facades\Route;

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


Route::any('/test', \App\Http\Controllers\TestController::class);
Route::get('/welcome', function () {
    return view('welcome');
});
//需要登录才可以访问的路由
Route::middleware('auth')->group(function () {
    //登录后，博客相关路由
    Route::prefix('blog')->name('blog.')->group(function () {
        //改变博客状态，发布与不发布
        Route::patch('/{blog}/status', [\App\Http\Controllers\BlogController::class, 'status'])->name('status');
        //评论路由
        Route::post('/{blog}/comment', \App\Http\Controllers\CommentController::class)->name('comment');
    });


    //个人中心相关路由组
    Route::prefix('user')->name('user.')->group(function () {
        //个人中心-修改个人信息-页面
        Route::get('/', [\App\Http\Controllers\UserController::class, 'infoPage'])->name('info');

        //个人中心-修改个人信息-更新数据
        Route::put('/', [\App\Http\Controllers\UserController::class, 'infoUpdate'])->name('info.update');

        //个人中心-更换头像-页面
        Route::get('/avatar', [\App\Http\Controllers\UserController::class, 'avatarPage'])->name('avatar');

        //个人中心-更换头像-更新数据
        Route::put('/avatar', [\App\Http\Controllers\UserController::class, 'avatarUpdate'])->name('avatar.update');

        //个人中心-我的博客
        Route::get('/blog', [\App\Http\Controllers\UserController::class, 'blog'])->name('blog');
    });
});

//博客资源路由
Route::resource('blog', \App\Http\Controllers\BlogController::class)->except([
    'index'
]);

//博客首页资源路由
Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
