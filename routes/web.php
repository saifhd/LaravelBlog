<?php
use App\Tag;
use App\Post;
use App\Category;
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

Route::get('/','WellcomeController@index')->name('welcome');
Route::get('blog/posts/{post}','Blog\PostsController@show')->name('blog.show');
Route::get('blog/categories/{category}','Blog\PostsController@category')->name('blog.category');
Route::get('blog/tags/{tag}','Blog\PostsController@tag')->name('blog.tag');
Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoriesController');
    Route::resource('/posts','PostsController');
    Route::resource('/tags','TagsController');
    Route::get('/trashed','PostsController@trash');
    Route::put('/restoretrashed/{post}','PostsController@restore');

});


Route::middleware(['auth','admin'])->group(function(){
    Route::get('/users/profile','UsersController@edit')->name('users.edit-profile');
    Route::put('/users/profile','UsersController@update')->name('users.update-profile');
    Route::get('/users','UsersController@index');
    Route::put('/users/{id}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
});


Route::get('/many',function(){
    return view('welcome')->with('categories',Category::all())
    ->with('tags',Tag::all())
    ->with('posts',Post::all());
});