<?php

use App\Livewire\Categories\Lists as CategoriesLists;
use App\Livewire\Products\Lists;
use Illuminate\Support\Facades\Route;

Route::get('/', Lists::class)->name('products.lists');
Route::get('/categories', CategoriesLists::class)->name('categories.lists');
