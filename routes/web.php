<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\MenuDashboard;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', Home::class)->name('home.page');
Route::get('/menu', MenuDashboard::class)->name('menu.page');
