<?php

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
    $page = \App\Models\Page::where('slug', '')->first();
    $menu = \App\Models\Page::where('is_menu', 1)
    ->where('parent_id', 0)
    ->where('active', 1)
    ->orderBy('position')
    ->get();
    
    return view('content', ['page' => $page, 'menu' => $menu]);
})->name('home');

Route::get('/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)->first();
    if (!$page) {
        abort(404);
    }

    $menu = \App\Models\Page::where('is_menu', 1)
        ->where('parent_id', 0)
        ->where('active', 1)
        ->orderBy('position')
        ->get();

    return view('content', ['page' => $page, 'menu' => $menu]);
})->name('page');
