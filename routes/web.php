<?php

use App\Models\Category;

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

// Route::get('/', function () {
//    return view('welcome');
// });

// Route::get('/home', function () {
// //    return view('home.welcomecopy');
//    return 'hola';
// });

// Route::get('/category/{id}', function ($id) {
//    return "Id: " . $id;
// });

// // Parametre opcional.
// Route::get('/category/{id}/{name?}', function ($id, $name="pepe") {
//    return 'Id y nombre: ' . $id . ' y ' . $name;
// });

// // Directiva que restringe que el id sea digitos.
// Route::get('/category/{id}', function ($id) {
//    return 'Id: ' . $id;
// })->where('id', '\d+');

// -----------------

// Welcome
Route::view('/', 'welcome', ['name' => 'PROVEN', 'year' => '2019'])->name('root');

// Home
Route::view('/home', 'home')->name('home');

// List
Route::get('/category/list', 'CategoryController@listAll')->name('category-list');
Route::get('/product/list', 'ProductController@listAll')->name('product-list');
Route::get('/catalog/show', 'CatalogController@show')->name('catalog-show');

// Create
Route::view('/category/create', 'category.create')->name('category-create');
Route::post('/category/create', 'CategoryController@create');

// Route::view('/product/create', 'product.create', ['categories' => \App\Models\Category::all()])->name('product-create');
Route::get('/product/create', function() {
    $categories = Category::pluck('name', 'id')->prepend('-', '');
    // $categories = Category::pluck('id', 'name')->prepend('', '-');
    return view('product.create', ['categories' => $categories]);
})->name('product-create');
Route::post('/product/create', 'ProductController@create');


// Find
Route::view('/category/find', 'category.find')->name('category-find');
Route::post('/category/find', 'CategoryController@find');
Route::view('/product/find', 'product.find')->name('product-find');
Route::post('/product/find', 'ProductController@find');

// Edit
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category-edit');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product-edit');
Route::get('/catalog/edit/{id}', 'CatalogController@edit')->name('movie-edit');

// Modify = Update or Delete
Route::post('/category/modify', 'CategoryController@modify');
Route::post('/product/modify', 'ProductController@modify');
Route::post('/catalog/update', 'CatalogController@update');
