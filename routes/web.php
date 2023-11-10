<?php

use App\Livewire\BlogPost;
use App\Livewire\PostView;
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
})->name('welcome');

Route::get('blog/{year}', function(){
    return redirect()->route('welcome');
});

Route::prefix('blog')->group(function(){
    Route::get('/', function(){
        return redirect()->route('welcome');
    });

    Route::get('{year}/{slug}', BlogPost::class)->name('blog.view');
    Route::get('{year}', function(){
        return redirect()->route('welcome');
    });

});