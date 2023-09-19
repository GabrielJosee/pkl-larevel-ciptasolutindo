<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SystemUserGroupController;
use App\Http\Controllers\InvtItemController;
use App\Http\Controllers\InvtItemCategoryController;
use App\Http\Controllers\InvtItemReviewController;
use App\Http\Controllers\SystemUserSellerRequestController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesPaymentController;
use App\Http\Controllers\SalesScheduleController;
use App\Http\Controllers\CoreBannerController;
use App\Http\Controllers\JadwalKesehatanController;
use App\Http\Controllers\KategoriKesehatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanAbsensiController;
use App\Http\Controllers\PenilaianKesehatanController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\TimBasketController;
use App\Models\TrainingGround;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//*SYSTEMUSER
Route::get('/system-user', [SystemUserController::class, 'index'])->name('system-user');
Route::get('/system-user/add', [SystemUserController::class, 'addSystemUser'])->name('add-system-user');
Route::post('/system-user/process-add-system-user', [SystemUserController::class, 'processAddSystemUser'])->name('process-add-system-user');
Route::get('/system-user/edit/{user_id}', [SystemUserController::class, 'editSystemUser'])->name('edit-system-user');
Route::post('/system-user/process-edit-system-user', [SystemUserController::class, 'processEditSystemUser'])->name('process-edit-system-user');
Route::get('/system-user/delete-system-user/{user_id}', [SystemUserController::class, 'deleteSystemUser'])->name('delete-system-user');
Route::get('/system-user/change-password/{user_id}  ', [SystemUserController::class, 'changePassword'])->name('change-password');
Route::post('/system-user/process-change-password', [SystemUserController::class, 'processChangePassword'])->name('process-change-password');
Route::get('/system-user/detail-seller/{user_id}', [SystemUserController::class, 'detailSystemUserSeller'])->name('detail-system-user-seller');
Route::get('/system-user/detail-buyer/{user_id}', [SystemUserController::class, 'detailSystemUserBuyer'])->name('detail-system-user-buyer');
Route::post('/system-user/filter', [SystemUserController::class, 'filter'])->name('filter-system-user');
Route::get('/system-user/blokir/{user_id}', [SystemUserController::class, 'blokirSystemUser'])->name('blokir-system-user');
Route::get('/system-user/unblokir/{user_id}', [SystemUserController::class, 'unblokirSystemUser'])->name('unblokir-system-user');


//*SYSTEMUSERGROUP
Route::get('/system-user-group', [SystemUserGroupController::class, 'index'])->name('system-user-group');
Route::get('/system-user-group/add', [SystemUserGroupController::class, 'addSystemUserGroup'])->name('add-system-user-group');
Route::post('/system-user-group/process-add-system-user-group', [SystemUserGroupController::class, 'processAddSystemUserGroup'])->name('process-add-system-user-group');
Route::get('/system-user-group/edit/{user_id}', [SystemUserGroupController::class, 'editSystemUserGroup'])->name('edit-system-user-group');
Route::post('/system-user-group/process-edit-system-user-group', [SystemUserGroupController::class, 'processEditSystemUserGroup'])->name('process-edit-system-user-group');
Route::get('/system-user-group/delete-system-user-group/{user_id}', [SystemUserGroupController::class, 'deleteSystemUserGroup'])->name('delete-system-user-group');


//*INVTITEMCATEGORY
Route::get('/item-category', [InvtItemCategoryController::class, 'index'])->name('item-category');
Route::get('/item-category/add', [InvtItemCategoryController::class, 'addInvtItemCategory'])->name('add-item-category');
Route::post('/item-category/elements-add', [InvtItemCategoryController::class, 'addElementsInvtItemCategory'])->name('add-item-category-elements');
Route::get('/item-category/reset-add', [InvtItemCategoryController::class, 'addReset'])->name('add-reset-item-category');
Route::post('/item-category/process-add-item-category', [InvtItemCategoryController::class, 'processAddInvtItemCategory'])->name('process-add-item-category');
Route::get('/item-category/edit/{item_category_id}', [InvtItemCategoryController::class, 'editInvtItemCategory'])->name('edit-item-category');
Route::post('/item-category/process-edit-item-category', [InvtItemCategoryController::class, 'processEditInvtItemCategory'])->name('process-edit-item-category');
Route::get('/item-category/delete-item-category/{item_category_id}', [InvtItemCategoryController::class, 'deleteInvtItemCategory'])->name('delete-item-category');


//*SYSTEMUSERSELLERREQUEST
Route::get('/seller-request', [SystemUserSellerRequestController::class, 'index'])->name('seller-request');
Route::get('/seller-request/accept/{user_id}', [SystemUserSellerRequestController::class, 'acceptSystemUserSellerRequest'])->name('accept-seller-request');
Route::get('/seller-request/reject/{user_id}', [SystemUserSellerRequestController::class, 'rejectSystemUserSellerRequest'])->name('reject-seller-request');


//*INVTITEM
Route::get('/item', [InvtItemController::class, 'index'])->name('item');
Route::post('/item/filter', [InvtItemController::class, 'filter'])->name('filter-item');
Route::get('/item/detail/{item_id}', [InvtItemController::class, 'detailInvtItem'])->name('detail-item');
Route::get('/item/blokir/{item_id}', [InvtItemController::class, 'blokirInvtItem'])->name('blokir-item');
Route::get('/item/blokir-variant/{item_variant_id}', [InvtItemController::class, 'blokirInvtItemVariant'])->name('blokir-item-variant');
Route::get('/item/unblokir/{item_id}', [InvtItemController::class, 'unblokirInvtItem'])->name('unblokir-item');
Route::get('/item/unblokir-variant/{item_variant_id}', [InvtItemController::class, 'unblokirInvtItemVariant'])->name('unblokir-item-variant');


//*INVTITEMREVIEW
Route::get('/item-review', [InvtItemReviewController::class, 'index'])->name('item-review');
Route::post('/item-review/filter', [InvtItemReviewController::class, 'filter'])->name('filter-item-review');
Route::get('/item-review/attachment/{item_review_id}', [InvtItemReviewController::class, 'attachmentInvtItemReview'])->name('attachment-item-review');
Route::get('/item-review/delete/{item_review_id}', [InvtItemReviewController::class, 'deleteInvtItemReview'])->name('delete-item-review');


//*SALES
Route::get('/sales', [SalesController::class, 'index'])->name('sales');
Route::post('/sales/filter', [SalesController::class, 'filter'])->name('filter-sales');
Route::get('/sales/detail/{sales_id}', [SalesController::class, 'detailSales'])->name('detail-sales');


//*SALESPAYMENT
Route::get('/sales-payment', [SalesPaymentController::class, 'index'])->name('sales-payment');
Route::post('/sales-payment/filter', [SalesPaymentController::class, 'filter'])->name('filter-sales-payment');
Route::get('/sales-payment/detail/{sales_payment_id}', [SalesPaymentController::class, 'detailSalesPayment'])->name('detail-sales-payment');


//*SALESTIMELAPSE
Route::get('/sales-schedule', [SalesScheduleController::class, 'index'])->name('sales-schedule');
Route::post('/sales-schedule/filter', [SalesScheduleController::class, 'filter'])->name('filter-sales-schedule');
Route::get('/sales-schedule/detail/{seller_id}', [SalesScheduleController::class, 'detailSalesSchedule'])->name('detail-sales-schedule');


//*COREBANNER
Route::get('/banner', [CoreBannerController::class, 'index'])->name('banner');
Route::get('/banner/add', [CoreBannerController::class, 'addCoreBanner'])->name('add-banner');
Route::post('/banner/elements-add', [CoreBannerController::class, 'addElementsCoreBanner'])->name('add-banner-elements');
Route::get('/banner/reset-add', [CoreBannerController::class, 'addReset'])->name('add-reset-banner');
Route::post('/banner/process-add-banner', [CoreBannerController::class, 'processAddCoreBanner'])->name('process-add-banner');
Route::get('/banner/edit/{item_category_id}', [CoreBannerController::class, 'editCoreBanner'])->name('edit-banner');
Route::post('/banner/process-edit-banner', [CoreBannerController::class, 'processEditCoreBanner'])->name('process-edit-banner');
Route::get('/banner/delete/{item_category_id}', [CoreBannerController::class, 'deleteCoreBanner'])->name('delete-banner');


// PLAYER
Route::get('/player', [PlayerController::class, 'index'])->name('player');
Route::get('/player/tambah',[PlayerController::class, 'screenTambah']);
Route::post('/player/tambah/process',[PlayerController::class,'tambah']);
Route::get('/player/edit/{id_player}', [PlayerController::class, 'edit']);
Route::post('/player/edit/process/{id_player}', [PlayerController::class, 'update']);
Route::get('/player/hapus/{id_player}', [PlayerController::class, 'delete']);
Route::get('/player/detail/{id_player}', [PlayerController::class, 'detail']);
Route::get('/CetakPlayer', [PlayerController::class, 'CetakPlayer']);
Route::get('/cetak-player-excel', [PlayerController::class, 'CetakPlayerExcel']);
//END PLAYER

// Tim
Route::get('/timbasket', [TimBasketController::class, 'index'])->name('timbasket');
Route::get('/timbasket/tambah',[TimBasketController::class, 'screenTambah']);
Route::get('/timbasket/tambah/list',[TimBasketController::class, 'listSession'])->name('sessionListTim');
Route::get('/timbasket/tambah/hapus/{index}',[TimbasketController::class, 'deleteList']);
Route::get('/timbasket/tambah/process',[TimBasketController::class,'tambah']);
Route::get('/timbasket/detail/{id_team_play}', [TimBasketController::class, 'detail']);
Route::get('/timbasket/edit/{id_team_play}', [TimBasketController::class, 'edit']);
Route::post('/timbasket/edit/process/{id_team_play}', [TimBasketController::class, 'update']);
Route::get('/timbasket/hapus/{id_team_play}', [TimBasketController::class, 'delete']);
Route::get('/cetak-tim', [TimBasketController::class, 'CetakTim']);
Route::get('/cetak-timbasket-excel', [TimbasketController::class, 'CetakTimExcel']);

// TRAINING GROUND
Route::get('/training', [TrainingController::class, 'index'])->name('training');
Route::get('/training/tambah',[TrainingController::class, 'screenTambah']);
Route::post('/training/tambah/process',[TrainingController::class,'tambah']);
Route::get('/training/edit/{training_ground_id}', [TrainingController::class, 'edit']);
Route::post('/training/edit/process/{training_ground_id}', [TrainingController::class, 'update']);
Route::get('/training/detail/{training_ground_id}', [TrainingController::class, 'detail']);
Route::get('/training/hapus/{training_ground_id}', [TrainingController::class, 'delete']);
// END TRAINING GROUND

//JADWAL
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::get('/jadwal/tambah',[JadwalController::class, 'screenTambah']);
Route::get('/jadwal/absen/',[JadwalController::class, 'absen'])->name('absen');
Route::post('/jadwal/tambah/process/',[JadwalController::class,'tambah']);
Route::get('/jadwal/edit/{timetable_id}', [JadwalController::class, 'edit']);
Route::post('/jadwal/edit/process/{timetable_id}', [JadwalController::class, 'update']);
Route::get('/jadwal/detail/{timetable_id}', [JadwalController::class, 'detail']);
Route::get('/jadwal/hapus/{timetable_id}', [JadwalController::class, 'delete']);
Route::get('/CetakJadwal', [JadwalController::class, 'CetakJadwal']);
Route::get('/CetakExcel', [JadwalController::class, 'CetakJadwalExcel']);
//END JADWAL

//Absensi
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
Route::post('/absensi/absen', [AbsensiController::class, 'Absen']);
//End Absensi

//laporan
Route::get('/laporan-absensi-hadir', [LaporanAbsensiController::class, 'index'])->name('laporan-absensi-hadir');
Route::post('/laporan-absensi-filter', [LaporanAbsensiController::class, 'filter'])->name('laporan-absensi-filter');
Route::get('/laporan-absensi/cetak-pdf', [LaporanAbsensiController::class, 'CetakPDF']);
Route::get('/laporan-absensi/cetak-excel', [LaporanAbsensiController::class, 'CetakExcel']);
//end laporan

//start slide
Route::get('/slideshow',[SlideShowController::class,'index'])->name('slideshow');
Route::get('/slide/tambah',[SlideShowController::class, 'screenTambah']);
Route::post('/slide/tambah/process/',[SlideShowController::class,'tambah']);
Route::get('/slide/edit/{slide_id}', [SlideShowController::class, 'edit']);
Route::post('/slide/edit/process/{slide_id}', [SlideShowController::class, 'update']);
Route::get('/slide/hapus/{slide_id}', [SlideShowController::class, 'delete']);
Route::get('/slide/detail/{slide_id}', [SlideShowController::class, 'detail']);
//end slide

//KEGIATAN JADWAL LATIHAN
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
Route::get('/kegiatan/tambah',[KegiatanController::class, 'screenTambah']);
Route::post('/kegiatan/tambah/process', [KegiatanController::class, 'tambah']);
Route::get('/kegiatan/edit/{activity_id}', [KegiatanController::class, 'edit']);
Route::post('/kegiatan/edit/process/{activity_id}', [KegiatanController::class, 'update']);
Route::get('/kegiatan/hapus/{activity_id}', [KegiatanController::class, 'delete']);
Route::get('/CetakKegiatan', [KegiatanController::class, 'CetakKegiatan']);
Route::get('/CetakExcel', [KegiatanController::class, 'CetakKegiatanExcel']);
//END KEGIATAN


//Start Kategori Penilaian Kesehatan
Route::get('/kategorikesehatan',[KategoriKesehatanController::class, 'index'])->name('kategorikesehatan');
Route::get('/kategorikesehatan/tambah',[KategoriKesehatanController::class, 'screenTambah']);
Route::post('/kategorikesehatan/tambah/process',[KategoriKesehatanController::class,'tambah']);
Route::get('/kategorikesehatan/edit/{health_assessment_categories_id}', [KategoriKesehatanController::class, 'edit']);
Route::post('/kategorikesehatan/edit/process/{health_assessment_categories_id}', [KategoriKesehatanController::class, 'update']);
Route::get('/kategorikesehatan/hapus/{health_assessment_categories_id}', [KategoriKesehatanController::class, 'delete']);
//End Kategori Penilaian Kesehatan

//Start Jadwal Penilaian Kesehatan
Route::get('/jadwalkesehatan',[JadwalKesehatanController::class, 'index'])->name('jadwalkesehatan');
Route::get('/jadwalkesehatan/tambah',[JadwalKesehatanController::class, 'screenTambah']);
Route::post('/jadwalkesehatan/tambah/process',[JadwalKesehatanController::class,'tambah']);
Route::get('/jadwalkesehatan/edit/{health_assessment_schedule_id}', [JadwalKesehatanController::class, 'edit']);
Route::post('/jadwalkesehatan/edit/process/{health_assessment_schedule_id}', [JadwalKesehatanController::class, 'update']);
Route::get('/jadwalkesehatan/hapus/{health_assessment_schedule_id}', [JadwalKesehatanController::class, 'delete']);

// START PENILAIAN KESEHATAN
Route::get('/penilaiankesehatan',[PenilaianKesehatanController::class, 'index'])->name('penilaiankesehatan');
Route::get('/penilaiankesehatan/tambah',[PenilaianKesehatanController::class, 'screenTambah']);
Route::post('/penilaiankesehatan/tambah/process',[PenilaianKesehatanController::class,'tambah']);
Route::get('/penilaiankesehatan/edit/{health_assessment_id}', [PenilaianKesehatanController::class, 'edit']);
Route::post('/penilaiankesehatan/edit/process/{health_assessment_id}', [PenilaianKesehatanController::class, 'update']);
Route::get('/penilaiankesehatan/hapus/{health_assessment_id}', [PenilaianKesehatanController::class, 'delete']);
Route::get('/CetakPenilaianKesehatan', [PenilaianKesehatanController::class, 'CetakPenilaianKesehatan']);
Route::get('/CetakPenilaianExcel', [PenilaianKesehatanController::class, 'CetakPenilaianExcel']);
//END PENILAIAN KESEHATAN