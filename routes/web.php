<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\ownerController;


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

Route::get('/', [authController::class, 'loginView'])->name('login');
Route::get('/login', [authController::class, 'loginView']);
Route::post('/login', [authController::class, 'login']);

Route::middleware(['auth','admin:admin'])->group(function () {
    
    Route::get('/admin/home', [adminController::class, 'adminHome']);
    Route::get('/admin/logout', [authController::Class, 'logout']);
    
    Route::get('/admin/paket', [adminController::class, 'paketView']);
    Route::get('/admin/paket/tambah', [adminController::class, 'tambahPaketView']);
    Route::post('/admin/paket/tambah', [adminController::class, 'tambahPaket']);
    Route::get('/admin/paket/hapus/{id}', [adminController::class, 'hapusPaket']);
    Route::get('/admin/paket/edit/{id}', [adminController::class, 'editPaketView']);
    Route::post('/admin/paket/edit/{id}', [adminController::class, 'editPaket']);
    
    
    Route::get('/admin/outlet', [adminController::class, 'outletView']);
    Route::get('/admin/outlet/tambah', [adminController::class, 'tambahOutletView']);
    Route::post('/admin/outlet/tambah', [adminController::class, 'tambahOutlet']);
    Route::get('/admin/outlet/hapus/{id}', [adminController::class, 'hapusOutlet']);
    Route::get('/admin/outlet/edit/{id}', [adminController::class, 'editOutletView']);
    Route::post('/admin/outlet/edit/{id}', [adminController::class, 'editOutlet']);
    
    Route::get('/admin/member', [adminController::class, 'memberView']);
    Route::get('/admin/member/tambah', [adminController::class, 'tambahMemberView']);
    Route::post('/admin/member/tambah', [adminController::class, 'tambahMember']);
    Route::get('/admin/member/edit/{id}', [adminController::class, 'editMemberView']);
    Route::post('/admin/member/edit/{id}', [adminController::class, 'editMember']);
    Route::get('/admin/member/hapus/{id}', [adminController::class, 'hapusMember']);
    
    Route::get('/admin/user/', [adminController::class, 'userView']);
    Route::get('/admin/user/tambah', [adminController::class, 'tambahUserView']);
    Route::get('/admin/user/edit/{id}', [adminController::class, 'editUserView']);
    Route::post('/admin/user/tambah', [adminController::class, 'tambahUser']);
    Route::post('/admin/user/edit/{id}', [adminController::class, 'editUser']);
    Route::get('/admin/user/hapus/{id}', [adminController::class, 'hapusUser']);
    
    Route::get('/admin/transaksi', [adminController::class, 'transaksiView']);
    Route::get('/admin/transaksi/tambah', [adminController::class, 'tambahTransaksiView']);
    Route::post('/admin/transaksi/tambah', [adminController::class, 'tambahTransaksi']);
    Route::get('/admin/transaksi/konfirmasi/{id}', [adminController::class, 'konfirmasi']);
    Route::post('/admin/transaksi/konfirmasi/{id}', [adminController::class, 'konfirmasiPesan']);
    Route::get('/admin/transaksi/proses/{id}', [adminController::class, 'prosesPesanan']);
});


