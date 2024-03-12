<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    function showLogin(){
        return view('admin_views.index');
    }

    function showDeshboard(){
        $total_revenue = DB::table('receipts')->sum('total_paid');

        $total_receipts = DB::table('receipts')->get('receipt');
        $total_receipts = $total_receipts->count();

        $total_room = DB::table('rooms')->get('id');
        $total_room = $total_room->count();

        $total_student = DB::table('students')->get('id');
        $total_student = $total_student->count();

        $total_paid_bill = DB::table('receipts')->get('status')->where('status', '=', 'paid');
        $total_paid_bill = $total_paid_bill->count();



        return view('admin_views.dashboard', ['total_paid_bill' => $total_paid_bill, 'total_student' => $total_student, 'total_revenue' => $total_revenue, 'total_receipts' => $total_receipts, 'total_room' => $total_room]);
    }

    function showPaidReceipt(){
        $receipts = null;
        return view('admin_views.search-list', ["receipts" => $receipts]);
    }

    function showAllReceipts(){
        return view('admin_views.receipt');
    }

}
