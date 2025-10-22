<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TimController;
use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\RincianController;


use App\Models\PegawaiModel;

Route::get('/', function () {
    return redirect()->route('default');
});

// Route::get('/register', [AuthController::class,'registerlihat'])->name('register.lihat');
Route::middleware(['auth'])->group( function () {
    Route::get('/user',[UserController::class,'index']);

    Route::prefix('master')->group(function () {
    Route::view('/pegawai', 'master.pegawaii');
        Route::post('/pegawai/store', function () {
            // sementara untuk testing
            return back()->with('success', 'Data pegawai berhasil disimpan!');
        });
    });
    Route::get('/home', [AuthController::class, 'default'])->name('default');

    Route::get('/master/pegawai', [MasterController::class, 'pegawai'])->name('master.pegawai');
    Route::get('/master/tim', [MasterController::class, 'tim'])->name('master.tim');
    Route::get('/master/transportasi', [MasterController::class, 'transportasi'])->name('master.transportasi');
    // Route::get('/perjalanan',[])->name('perjalanan');
    Route::resource('/jenis', JenisController::class);
    Route::get('modal-add-transport',[JenisController::class,'modalAdd'])->name('modal.add.transport');
    Route::resource('/tim', TimController::class);
    Route::get('modal-add-tim', [TimController::class,'modalAddTim'])->name('modal.add.tim');
    Route::resource('/pegawaii', PegawaiController::class);
    Route::get('modal-add-pegawai', [PegawaiController::class,'modalAddPegawai'])->name('modal.add.pegawai');
    Route::get('modal-add-usser',[PegawaiController::class,'modalAddUser'])->name('modal.add.user');
    Route::post('simpan-user',[PegawaiController::class,'saveUser'])->name("user.pegawai.store");

    Route::prefix('perjalanan')->group(function () {
    Route::get('/', [PerjalananController::class, 'index'])->name('perjalanan.index');
    Route::get('/create', [PerjalananController::class, 'create'])->name('perjalanan.create');
    Route::post('/store', [PerjalananController::class, 'store'])->name('perjalanan.store');
    Route::get('/{id}', [PerjalananController::class, 'show'])->name('perjalanan.show');
    Route::delete('/{id}', [PerjalananController::class, 'destroy'])->name('perjalanan.destroy');

    Route::post('/{id}/rincian', [RincianController::class, 'store'])->name('rincian.store');
    Route::get('/{id}/rincian', [RincianController::class, 'show'])->name('rincian.show');
    Route::delete('/rincian/{rincian_id}', [RincianController::class, 'destroy'])->name('rincian.destroy');
});

});



//     Route::get('/perjalanan', [PerjalananController::class, 'index'])->name('perjalanan.index');
// Route::post('/perjalanan', [PerjalananController::class, 'store'])->name('perjalanan.store');
// Route::delete('/perjalanan/{id}', [PerjalananController::class, 'destroy'])->name('perjalanan.destroy');


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // arahkan ke login setelah logout
})->name('logout');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginSubmit'])->name('login.post');
// Route::post('/register/submit',[AuthController::class,'registersubmit'])->name('register.submit');


