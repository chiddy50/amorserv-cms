<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;

use App\Http\Controllers\Website\HomeController;

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


Route::group(['middleware' => 'auth'], function() {

    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');

        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

        // User routes
        Route::controller(PostController::class)->group(function () {
            Route::post('/publish-post', 'publish')->name('posts.publish');
            Route::get('/view-posts', 'viewPosts')->name('posts.view');
            Route::post('/add-post', 'addPost')->name('posts.store');
            Route::get('/edit-posts/{id}', 'editPost')->name('posts.edit');
            Route::post('/update-post', 'update')->name('posts.update');
            Route::delete('/delete-post/{id}', 'destroy')->name('post.destroy');
        });

        // User routes
        Route::controller(UserController::class)->group(function () {
            Route::get('/view-users', 'viewUsers')->name('users.view');
            Route::post('/toggle-activaton', 'toggleActivation')->name('users.toggleactivation');
            Route::post('/add-user', 'store')->name('users.store');
            Route::get('/edit-user/{id}', 'editUser')->name('users.edit');
            Route::post('/update-user', 'update')->name('users.update');
            Route::delete('/delete-user/{id}', 'destroy')->name('users.destroy');
        });

        // Page routes
        Route::controller(PageController::class)->group(function () {
            Route::post('/publish-page', 'publish')->name('pages.publish');
            Route::get('/add-page', 'viewCreatePageForm')->name('page.add');
            Route::post('/add-page', 'store')->name('pages.store');
            Route::get('/edit-page/{id}', 'viewEditPageForm')->name('pages.edit');
            Route::post('/update-page', 'update')->name('pages.update');
            Route::delete('/delete-page/{id}', 'destroy')->name('pages.destroy');
        });

        // Category routes
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/view-categories', 'view')->name('categories.view');
            Route::post('/add-category', 'store')->name('categories.store');
            Route::get('/edit-category/{id}', 'viewEditCategoryForm')->name('categories.edit');
            Route::post('/update-category', 'update')->name('categories.update');
            Route::delete('/delete-category/{id}', 'destroy')->name('categories.destroy');
        });

        // Tag routes
        Route::controller(TagController::class)->group(function () {
            Route::get('/view-tags', 'view')->name('tags.view');
            Route::post('/add-tag', 'store')->name('tags.store');
            Route::get('/edit-tag/{id}', 'viewEditTagForm')->name('tags.edit');
            Route::post('/update-tag', 'update')->name('tags.update');
            Route::delete('/delete-tag/{id}', 'destroy')->name('tags.destroy');
        });
    });


});

Route::group(['middleware' => 'guest'], function() {

    Route::prefix('admin')->group(function () {

        Route::post('/login', [AuthController::class, 'login'])->name('login');

        Route::get('/login', function () {
            return view('auth.login');
        })->name('admin.login');
    });


});


Route::get('/web/{slug}', [PageController::class, 'show'])->name('dynamic.pages');

Route::get('/', [HomeController::class, 'home']);
Route::get('/blog/{id}', [HomeController::class, 'singleBlog'])->name(('singleBlog'));



