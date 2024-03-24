<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class ReceiptController extends Controller
{
    public function generatPDF()
    {
        // return view('admin_views.receipt');

        $data = date("d/m/Y");


            $pdf = [
                'name' => "Mahemudhasan Vadhaniya",
                'villege' => "Haidarpura",
                'district' => "Patan",
                'phone' => "7043506247",
                'receipt' => 53,
                'data' => $data,
                'room_no' => "A1",
                'start_month' => "January",
                'end_month' => "March",
                'fees' => "600",
                'total_paid' => "1800"
            ];
            // return $pdf->download('receipt.pdf');

            // dd($pdf->name);

        return view('admin_views.receiptPdf', [
            'name' => "Mahemudhasan Vadhaniya",
            'villege' => "Haidarpura",
            'district' => "Patan",
            'phone' => "7043506247",
            'receipt' => 53,
            'data' => $data,
            'room_no' => "A1",
            'start_month' => "January",
            'end_month' => "March",
            'fees' => "600",
            'total_paid' => "1800"
        ]);
    }

    function showCreateReceipt()
    {
        $existingStd = DB::table('students')->get();
        $existingRooms = DB::table('rooms')->get();
        $receiptNumber = DB::table('receipts')->latest('id')->pluck('id');
        if (isset($receiptNumber['0'])) {
            $num = $receiptNumber['0'];
        } else {
            $num = 0;
        }

        if ($num == 0) {
            $num = 1;
        } else {
            $num++;
        }
        
        return view('admin_views.receipt-create', ['students' => $existingStd, 'existingRooms' => $existingRooms, 'receiptNumber' => $num]);
    }

    //*** Show Student Receipt ***
    function showManageReceipt()
    {
        $receipts = DB::table('receipts')
            ->join('store_students', 'receipts.receipt', '=', 'store_students.receipt_no')
            ->select('receipts.*', 'store_students.name', 'store_students.room_no', 'store_students.villege', 'store_students.district', 'store_students.status', 'store_students.phone')
            ->where('store_students.status', '=', 'Student')
            ->get();

        $i = 1;
        return view('admin_views.receipt-list', ['receipts' => $receipts, 'i' => $i]);
    }

    function showEmployeeReceipt()
    {
        $receipts = DB::table('receipts')
            ->join('store_students', 'receipts.receipt', '=', 'store_students.receipt_no')
            ->select('receipts.*', 'store_students.name', 'store_students.room_no', 'store_students.villege', 'store_students.district', 'store_students.status', 'store_students.phone')
            ->where('store_students.status', '=', 'Employee')
            ->orWhere('store_students.status', '=', 'Other')
            ->get();

        $i = 1;
        return view('admin_views.employee-r-list', ['receipts' => $receipts, 'i' => $i]);
    }

    function insertNewReceipt(Request $request)
    {
        
        $mes = Validator::make(
            $request->all(),
            [
                'student_id' => 'required   ',
                'student_name' => 'required',
                'villege' => 'required',
                'district' => 'required',
                'phone' => 'required| numeric| min:10',
                'start_month' => 'required',
                'end_month' => 'required_with:start_month|required|gt:start_month',
                'room_name' => 'required',
                'room_fees' => 'required',
            ]

        );
        if ($mes->fails()) {
            // Failed
            return back()->with('errors', $mes->errors());
        } else {
            //Create Receipt
            $total_month = ($request->end_month - $request->start_month) + 1;

            $data = date("d/m/Y");

            $pdf = Pdf::loadView('admin_views.receiptPdf', [
                'name' => $request->student_name,
                'villege' => $request->villege,
                'district' => $request->district,
                'phone' => $request->phone,
                'receipt' => $request->invoice_id,
                'data' => $data,
                'room_no' => $request->room_name,
                'start_month' => $request->start_month,
                'end_month' => $request->end_month,
                'total_month' => ($request->end_month - $request->start_month) + 1,
                'fees' => $request->room_fees,
                'total_paid' => ($total_month * $request->room_fees),
            ]);
            // Save the PDF to a directory
            $pdfPath = public_path('receiptsPDF'); // Change this path as per your requirement
            if (!file_exists($pdfPath)) {
                mkdir($pdfPath, 0777, true); // Create directory if it doesn't exist
            }
            $pdfFileName = $request->room_name . '' . $request->student_name . '-' .$request->invoice_id . '.pdf'; // Generate a unique filename
            $pdf->save($pdfPath . '/' . $pdfFileName);

            //Stored Receipt Data
            DB::table('receipts')->insert([
                'student_id' => $request->student_id,
                'receipt' => $request->invoice_id,
                'email' => "Null",
                'start_month' => $request->start_month,
                'end_month' => $request->end_month,
                'fees' => $request->room_fees,
                'total_paid' => ($total_month * $request->room_fees),
                'note' => $request->notes,
                'status' => $request->invoice_status,
                'total_months' => ($request->end_month - $request->start_month) + 1,
                'receiptPDF' => $pdfPath . '/' . $pdfFileName,
                'created_at' => date('Y-m-d'),
            ]);

            //Stored Data
            DB::table('store_students')->insert([
                'name' => $request->student_name,
                'villege' => $request->villege,
                'district' => $request->district,
                'status' => $request->status,
                'room_no' => $request->room_name,
                'receipt_no' => $request->invoice_id,
                'phone' => $request->phone,
                'created_at' =>  date('Y-m-d'),
            ]);
            
            return $pdf->download($request->room_name . '' . $request->student_name . '-' .$request->invoice_id . '.pdf');

            // return redirect()->back()->with('sucess', 'Receipt Create Successfuly');
        }
    }

    function findRecieptDetails($fromMonth, $toMonth, $roomNo = "null", $stdName = "null", Request $request){
        if($roomNo == "null"){
            $response = DB::table("receipts")
            ->join("students", "receipts.student_id", "=", "students.id")
            ->join("store_students", "store_students.receipt_no", "=", "receipts.id")
            ->select('receipts.*', 'store_students.*', 'students.*')
            ->where(function ($query) use ($fromMonth, $toMonth) {
                $query->whereBetween("receipts.start_month", [$fromMonth, $toMonth])
                      ->whereBetween("receipts.end_month", [$fromMonth, $toMonth]);
            })
            ->get();
        }else{
            $response = DB::table("receipts")->join("students", "receipts.student_id", "=", "students.id")
            ->join("store_students", "store_students.receipt_no", "=", "receipts.id")
            ->select('receipts.*', 'store_students.*', 'students.*')
            ->OrWhere("store_students.room_no", 'LIKE', '%' .$roomNo . '%')
            ->get();
        }
        if($stdName != "null"){
            $response = DB::table("receipts")->join("students", "receipts.student_id", "=", "students.id")
            ->join("store_students", "store_students.receipt_no", "=", "receipts.id")
            ->select('receipts.*', 'store_students.*', 'students.*')
            ->where("store_students.name", 'LIKE', '%' .$stdName . '%')
            ->get();
        }
       return response()->json($response);
    }

    function getReceiptsByRoomNo(Request $request){
        $response = DB::table("receipts")->join("students", "receipts.student_id", "=", "students.id")
                    ->join("store_students", "store_students.receipt_no", "=", "receipts.id")
                    ->select()
                    ->where("receipts.start_month", "=", $request->fromMonth)
                    ->orWhere("receipts.end_month", "=", $request->toMonth)->get();
        $i = 1;
        // dd($response);
        return  view('admin_views.search-list', ["receipts" => $response, "i" => $i]);
    }
}
