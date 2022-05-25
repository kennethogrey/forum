<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/',[FrontendController::class,'index']);
Route::get('/category/overview/{id}',[FrontendController::class,'categoryOverview'])->name('category.overview');
Route::get('/forum/overview/{id}',[FrontendController::class,'forumOverview'])->name('forum.overview');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard/home',[DashboardController::class,'home']);
//category routes
Route::get('dashboard/category/new',[CategoryController::class,'create'])->name('category.new');
Route::post('dashboard/category/new',[CategoryController::class,'store'])->name('category.store');
Route::get('dashboard/categories',[CategoryController::class,'index'])->name('categories');
Route::get('dashboard/categories/{id}',[CategoryController::class,'show'])->name('category');
Route::get('dashboard/categories/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::get('dashboard/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('dashboard/categories/edit/{id}',[CategoryController::class,'update'])->name('category.update');

//forums routes
Route::get('dashboard/forum/new',[ForumController::class,'create'])->name('forum.new');
Route::post('dashboard/forum/new',[ForumController::class,'store'])->name('forum.store');
Route::get('dashboard/forums',[ForumController::class,'index'])->name('forums');
Route::get('dashboard/forums/{id}',[ForumController::class,'show'])->name('forum');
Route::get('dashboard/forums/delete/{id}',[ForumController::class,'destroy'])->name('forum.destroy');
Route::get('dashboard/forums/edit/{id}',[ForumController::class,'edit'])->name('forum.edit');
Route::post('dashboard/forums/edit/{id}',[ForumController::class,'update'])->name('forum.update');

//topics routes
Route::get('client/topic/new/{id}',[TopicController::class,'create'])->name('topic.new');
Route::post('client/topic/new',[TopicController::class,'store'])->name('topic.store');
Route::post('client/topic/reply/{id}',[TopicController::class,'reply'])->name('topic.reply');
Route::get('client/topic/{id}',[TopicController::class,'show'])->name('topic');
Route::get('/topic/reply/delete/{id}',[TopicController::class,'destroy'])->name('reply.delete');
// Route::get('client/topics/delete/{id}',[TopicController::class,'destroy'])->name('topic.destroy');
// Route::get('client/topics/edit/{id}',[TopicController::class,'edit'])->name('topic.edit');
// Route::post('client/topics/edit/{id}',[TopicController::class,'update'])->name('topic.update');
Route::get('/updates',[TopicController::class,'updates']);
//updating the user profile
Route::post('user/update/{id}',[UserController::class,'update'])->name('user.update');
