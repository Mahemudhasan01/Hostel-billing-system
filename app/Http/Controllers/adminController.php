<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class adminController extends Controller
{
    function showLogin(){
        return view('admin_views.index');
    }

    function submitLogin(Request $request){
        $user = DB::table("user")->where("username", "=", $request->username)
                    ->where("password", "=", $request->password)->get();
        if(sizeof($user)){
            Session::put("username", $user[0]->username);
            Session::put("phone", $user[0]->phone);
            return redirect()->route('show.deshboard');
        }else{
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
        
    }

    function showDeshboard(){
        $total_revenue = DB::table('receipts')->sum('total_paid');

        $total_receipts = DB::table('receipts')->get('receipt');
        $total_receipts = $total_receipts->count();

        $total_room = DB::table('rooms')->get('id');
        $total_room = $total_room->count();

        $total_student = DB::table('students')->where('status', '=', 'Student')->get('id');
        $total_student = $total_student->count();

        $total_employee = DB::table('students')->where('status', '=', 'Employee')->get('id');
        $total_employee = $total_employee->count();

        $total_paid_bill = DB::table('receipts')->get('status')->where('status', '=', 'paid');
        $total_paid_bill = $total_paid_bill->count();

        $total_lefts = DB::table('students')->where('status', '=', 'left')->get('id');
        $total_lefts = $total_lefts->count();

        return view('admin_views.dashboard', ['total_paid_bill' => $total_paid_bill, 'total_student' => $total_student, 'total_revenue' => $total_revenue, 'total_receipts' => $total_receipts, 'total_room' => $total_room, 'total_employee' => $total_employee, 'total_lefts' => $total_lefts]);
    }

    function showPaidReceipt(){
        $receipts = null;
        return view('admin_views.search-list', ["receipts" => $receipts]);
    }

    // function showAllReceipts(){
    //     return view('admin_views.receipt');
    // }

    function logout(){
        // Expire all session data
        Session::flush();

        return redirect()->route("show.login");
    }

}
