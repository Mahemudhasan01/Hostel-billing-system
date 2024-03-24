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
Route::get("/",[adminController::class, 'showLogin'])->name('show.login');
Route::post("/submitLogin", [adminController::class, 'submitLogin'])->name("submit.login");
Route::get("/logout", [adminController::class, 'logout'])->name("logout");
// Addmin Controller
Route::group(['middleware' => 'checksession', 'prefix' => '/receipts'], function(){
    Route::get("/deshboard",[adminController::class, 'showDeshboard'])->name('show.deshboard');
    // Room's Route
});

//Student Controller
Route::group(['middleware' => 'checksession', 'prefix' => '/admin'], function(){
    // Student Route
    Route::post('addstudent/{sid}', [StudentController::class, 'addStudent'])->name('add.student');
    Route::get("showStudent/",[StudentController::class, 'showAddStudent'])->name('show.add.student');
    Route::get("managestudent/{romid?}",[StudentController::class, 'showManageStudent'])->name('show.manage.student');
    Route::get("manageemployee/{romid?}",[StudentController::class, 'showManageEmployee'])->name('show.manage.employee');
    Route::get("editStudent/{sid}", [StudentController::class, 'editStudent'])->name("edit.student");
    Route::get("deleteStudent/{sid}", [StudentController::class, 'deleteStudent'])->name("delete.student");

    // Room's Route
    Route::get("rooms/",[RoomController::class, 'showRooms'])->name('show.rooms');
    Route::post('addroom/{editId}', [RoomController::class, 'addRoom'])->name('add.room');
    Route::get("manageroom/",[RoomController::class, 'showManageRoom'])->name('show.manage.room');
    Route::get("editRomm/{id}", [RoomController::class, 'editRoom'])->name('edit.room');
    Route::get("deleteRoom/{id}", [RoomController::class, 'deleteRoom'])->name('delete.room');

    //Receipt Routes
    Route::get("createreceipt/",[ReceiptController::class, 'showCreateReceipt'])->name('show.Create.Receipt');
    Route::get("/findReciept/{fromMonth}/{toMonth}/{roomNo?}/{studntName?}", [ReceiptController::class, 'findRecieptDetails'])->name('find.reciept.details');
    Route::get("/findRecieptByRoomNo", [ReceiptController::class, 'findRecieptByRoomNo'])->name("find.receiptByRoomNo");
    Route::get("managerecipt/",[ReceiptController::class, 'showManageReceipt'])->name('show.manage.receipt');
    Route::get("manageemployeerecipt/",[ReceiptController::class, 'showEmployeeReceipt'])->name('show.employee.manage.receipt');
    // Route::get('existingstudent/', [ReceiptController::class, 'getExistingStudent'])->name('get.existing.student');
    Route::post('insertreceipt/', [ReceiptController::class, 'insertNewReceipt'])->name('insert.new.receipt');
    Route::get('pdf/', [ReceiptController::class, 'generatPDF']);
    Route::get("paidreceipt/",[adminController::class, 'showPaidReceipt'])->name('show.paid.receipt');
    Route::get("receipt/", [adminController::class, 'showAllReceipts'])->name('show.all.receipt');

    // AJAX Apis
    Route::get("/findReceiptByRoomNo", [ReceiptController::class, 'getReceiptsByRoomNo'])->name('get.receiptsbyRoom');

    //Lefts Students 
    Route::get("leftStudent/", [StudentController::class, 'showLeftStudent'])->name("show.lefts");
    Route::get("showLeftsDtls/{sid}", [StudentController::class, 'showLeftStudentDtl'])->name("left.student");
    Route::post("pushInLeftList/{sid}", [StudentController::class, 'pushInLeftList'])->name("make.left");
});