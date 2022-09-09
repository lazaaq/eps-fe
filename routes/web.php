<?php

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

Route::get('/', function () {
    return view('landingpage');
})->name('home');
Route::get('/foo', function () {
Artisan::call('storage:link');
});
// Authentication Routes...
Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth','role:user']], function () {
    // Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('beranda');
    // Route::get('/notif', [App\Http\Controllers\HomeController::class, 'notification'])->name('notification');

    // profil
    Route::group(['prefix'=> 'profil'], function() {
        Route::get('/', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil.index');
        Route::post('/update', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');
        Route::get('/password', [App\Http\Controllers\ProfilController::class, 'indexUpdatePassword'])->name('profil.indexUpdatePassword');
        Route::post('/password', [App\Http\Controllers\ProfilController::class, 'updatePassword'])->name('profil.updatePassword');
    });

    // try out
    Route::group(['prefix'=> 'try-out'], function() {
        Route::get('/', [App\Http\Controllers\TryOutController::class, 'index'])->name('tryout.index');
        Route::get('/perbarui-data/{id}', [App\Http\Controllers\TryOutController::class, 'updateData'])->name('tryout.update-data');
        Route::post('/simpan-jawaban/{id}', [App\Http\Controllers\TryOutController::class, 'storeAnswer'])->name('tryout.store-answer');
        Route::get('/{id}/data', [App\Http\Controllers\TryOutController::class, 'data'])->name('tryout.data');
        Route::post('/cek-user', [App\Http\Controllers\TryOutController::class, 'checkUser'])->name('tryout.check-user');
        Route::post('/submit', [App\Http\Controllers\TryOutController::class, 'submit'])->name('tryout.submit');
    });

    // hasil try out
    Route::group(['prefix'=> 'hasil-tryout'], function() {
        Route::get('/', [App\Http\Controllers\HasilTryoutController::class, 'index'])->name('hasil-tryout.index');
        Route::get('/{id}', [App\Http\Controllers\HasilTryoutController::class, 'show'])->name('hasil-tryout.show');
        Route::get('/{id}/pdf', [App\Http\Controllers\HasilTryoutController::class, 'generatePDF'])->name('hasil-tryout.pdf');
    });

    // topik
    Route::group(['prefix'=> '/'], function() {
        Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('paket-saya.index');
        Route::get('/beranda/{namaPaket}', [App\Http\Controllers\HomeController::class, 'show'])->name('paket-saya.show');
        Route::get('/beranda/premium/{namaPaket}', [App\Http\Controllers\HomeController::class, 'premium'])->name('paket-saya.premium');
        Route::post('/beranda/filter', [App\Http\Controllers\HomeController::class, 'filter'])->name('paket-saya.filter');
        Route::get('/beranda/quiz/{id}', [App\Http\Controllers\HomeController::class, 'opening'])->name('paket-saya.opening');
    });

});
