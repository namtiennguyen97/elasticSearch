<?php

use App\Http\Controllers\BlogController;
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
    return view('app');
});

//blogs
Route::group(['prefix' => 'blogs'], function (){
   Route::get('/',[BlogController::class, 'index'])->name('blog.index');
   Route::get('/create',[BlogController::class, 'create'])->name('blog.create');
   Route::post('/create',[BlogController::class, 'store'])->name('blog.store');
   Route::get('/{id}',[BlogController::class, 'show'])->name('blog.show');
   Route::get('/delete/{id}',[BlogController::class, 'destroy'])->name('blog.delete');
   Route::post('/search',[BlogController::class, 'searchBlog'])->name('blog.search');
});
