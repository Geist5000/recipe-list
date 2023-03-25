<?php

use App\Http\Controllers\PictureController;
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

Route::redirect('/', url('/recipes'));


Route::resource('recipes', 'RecipeController');

Route::resource('tags', 'TagController');

Route::get('pictures/{picture}', [PictureController::class, "show"])
    ->name("pictures.show");
