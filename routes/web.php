<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('admin_views.dashboard');
});
// Addmin Controller
Route::group(['prefix' => '/'], function(){
    Route::get("login/",[adminController::class, 'showLogin'])->name('show.login');
    Route::get("/",[adminController::class, 'showDeshboard'])->name('show.deshboard');
    Route::get("paidreceipt/",[adminController::class, 'showPaidReceipt'])->name('show.paid.receipt');
    Route::get("receipt/", [adminController::class, 'showAllReceipts'])->name('show.all.receipt');
    // Room's Route
    Route::get("rooms/",[adminController::class, 'showRooms'])->name('show.rooms');
    Route::get("manageroom/",[adminController::class, 'showManageRoom'])->name('show.manage.room');
    
});

//Student Controller
Route::group(['prefix' => '/admin'], function(){
    // Student Route
    Route::post('addstudent/', [StudentController::class, 'addStudent'])->name('add.student');
    // Route::get('students/', [StudentController::class, 'showStudentList'])->name('show.student.list');
    Route::get("addstudent/",[StudentController::class, 'showAddStudent'])->name('show.add.student');
    Route::get("managestudent/",[StudentController::class, 'showManageStudent'])->name('show.manage.student');
    Route::get("manageemployee/",[StudentController::class, 'showManageEmployee'])->name('show.manage.employee');

    // Room's Route
    Route::get("rooms/",[RoomController::class, 'showRooms'])->name('show.rooms');
    Route::post('addroom/', [RoomController::class, 'addRoom'])->name('add.room');
    Route::get("manageroom/",[RoomController::class, 'showManageRoom'])->name('show.manage.room');

    //Receipt Routes
    Route::get("createreceipt/",[ReceiptController::class, 'showCreateReceipt'])->name('show.Create.Receipt');
    Route::get("/findReciept/{fromMonth}/{toMonth}/{roomNo?}/{studntName?}", [ReceiptController::class, 'findRecieptDetails'])->name('find.reciept.details');
    Route::get("/findRecieptByRoomNo", [ReceiptController::class, 'findRecieptByRoomNo'])->name("find.receiptByRoomNo");
    Route::get("managerecipt/",[ReceiptController::class, 'showManageReceipt'])->name('show.manage.receipt');
    Route::get("manageemployeerecipt/",[ReceiptController::class, 'showEmployeeReceipt'])->name('show.employee.manage.receipt');
    // Route::get('existingstudent/', [ReceiptController::class, 'getExistingStudent'])->name('get.existing.student');
    Route::post('insertreceipt/', [ReceiptController::class, 'insertNewReceipt'])->name('insert.new.receipt');
    Route::get('pdf/', [ReceiptController::class, 'generatPDF']);

    // AJAX Apis
    Route::get("/findReceiptByRoomNo", [ReceiptController::class, 'getReceiptsByRoomNo'])->name('get.receiptsbyRoom');
});