<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Userontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;


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
//     return view('welcome');
// });
// Auth::routes();
Route::get('add', [AdminController::class, 'create'])->name('admin.create');
Route::post('store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
// Route::get('/pengirim', [AdminController::class, 'pengirim'])->name('admin.pengirim');
Route::post('update/{id}', [AdminController::class,'update'])->name('admin.update');
Route::get('delete/{id}', [AdminController::class,'delete'])->name('admin.delete');
Route::post('soft/{id}', [AdminController::class, 'soft'])->name('admin.soft');

Route::get('/pengirim', [SupController::class, 'index'])->name('pengirim.index');
Route::get('/pengirim/add', [SupController::class, 'create'])->name('pengirim.create');
Route::post('/pengirim/store', [SupController::class, 'store'])->name('pengirim.store');
Route::get('/pengirim/edit/{id}', [SupController::class, 'edit'])->name('pengirim.edit');
Route::post('/pengirim/update/{id}', [SupController::class,'update'])->name('pengirim.update');
Route::get('/pengirim/delete/{id}', [SupController::class,'delete'])->name('pengirim.delete');
Route::post('/pengirim/soft/{id}', [SupController::class, 'soft'])->name('pengirim.soft');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', [LoginController::class, 'login'])->name('login');
// Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
