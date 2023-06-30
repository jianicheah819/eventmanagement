<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
    Route::get('/create', [EventController::class, 'create'])->name('create');
    Route::post('store', [EventController::class, 'store'])->name('store');
    Route::get('/show', [EventController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [EventController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::delete('/{event}/destroy', [EventController::class, 'destroy'])->name('destroy');
    Route::get('generatePdf', [EventController::class, 'generatePdf'])->name('generatePdf');
  
});

Route::middleware(['auth', 'isRoleUser'])->prefix('user')->as('user.')->group(function () {
    Route::get('generatePdf', [EventController::class, 'generatePdf'])->name('generatePdf');
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('viewReport', [UserController::class, 'viewReport'])->name('viewReport');
        Route::get('/show', [UserController::class, 'show'])->name('show');
     
    });
});

Route::middleware(['auth', 'isRoleMember'])->prefix('member')->as('member.')->group(function () {
    Route::get('generatePdf', [EventController::class, 'generatePdf'])->name('generatePdf');
    Route::controller(MemberController::class)->group(function () {
        Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
        Route::get('viewReport', [MemberController::class, 'viewReport'])->name('viewReport');
        Route::get('/show', [MemberController::class, 'show'])->name('show');
     
    });
});

Route::middleware(['auth', 'isRoleAdmin'])->prefix('admin')->as('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('viewReport', [AdminController::class, 'viewReport'])->name('viewReport');
        // Route::get('viewPdf', [AdminController::class, 'viewPdf'])->name('viewPdf');
    }); 
        Route::get('generatePdf', [EventController::class, 'generatePdf'])->name('generatePdf');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('store', [EventController::class, 'store'])->name('store');
        Route::get('/show', [EventController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::delete('/{event}/destroy', [EventController::class, 'destroy'])->name('destroy'); 
});
