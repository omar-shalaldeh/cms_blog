<?php

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

use App\Http\Controllers\Blog\PostsController;
use Illuminate\Support\Facades\Auth;

Route::get('/','WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{show}',[PostsController::class,'show'])->name('post.show');
Route::get('/blog/category/{category}',[PostsController::class,'category'])->name('blog.category');
Route::get('/blog/tags/{tag}',[PostsController::class,'tag'])->name('blog.tag');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function (){
    Route::resource('/categories','CategoriesController');
    Route::resource('/posts','PostsController');
    Route::resource('/tags','TagController');
    Route::get('trsh_post','PostsController@Trash')->name('post.trash');
    Route::get('restore/{id}','PostsController@restore')->name('posts.restore');
    Route::put('user/profile','UsersController@update')->name('users.update');

    Route::get('/user/edit-profile','UsersController@edit_profile')->name('users.edit-profile');
});



Route::group(['middleware'=>['auth','admin']],function (){


    Route::get('/users','UsersController@index')->name('users.index');

   Route::post('/users/{user}/edit','UsersController@make_admin')->name('users.make_admin');

});
